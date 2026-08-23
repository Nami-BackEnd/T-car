'use strict';

(function () {
  const i18n = window.DASHBOARD_I18N || {};
  const isRTL = !!i18n.rtl;

  const cssVar = (name) => getComputedStyle(document.documentElement).getPropertyValue(name).trim();

  const theme = {
    primary: '#009688',
    secondary: '#263238',
    success: '#0d99ff',
    info: '#00b8d9',
    warning: '#fdbc3d',
    danger: '#e5484d',
    gray300: cssVar('--ds-gray-300') || '#dee2e6',
    gray600: cssVar('--ds-gray-600') || '#6c757d',
  };

  const fontFamily = isRTL ? 'Cairo, Public Sans, serif' : 'Public Sans, serif';

  const baseAreaOptions = (seriesName, data, color) => ({
    series: [{ name: seriesName, data }],
    labels: i18n.months || ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    chart: {
      height: 350,
      type: 'area',
      toolbar: { show: false },
      fontFamily,
      foreColor: theme.gray600,
    },
    dataLabels: { enabled: false },
    markers: {
      size: 5,
      hover: { size: 6, sizeOffset: 3 },
    },
    colors: [color],
    stroke: { curve: 'smooth', width: 2 },
    grid: {
      show: true,
      borderColor: theme.gray300,
      strokeDashArray: 2,
    },
    xaxis: {
      labels: {
        show: true,
        style: { fontSize: '12px', fontWeight: 400, colors: theme.gray600, fontFamily },
      },
      axisBorder: { show: false },
      axisTicks: { show: false },
    },
    yaxis: {
      labels: {
        formatter: (v) => v + 'k',
        style: { fontSize: '12px', fontWeight: 400, colors: theme.gray600, fontFamily },
      },
    },
    legend: { show: false },
    tooltip: { theme: 'light' },
  });

  if (document.getElementById('totalIncomeChart')) {
    new ApexCharts(
      document.querySelector('#totalIncomeChart'),
      baseAreaOptions(i18n.incomeSeries || 'Total Income', [31, 40, 28, 51, 42, 109, 100], theme.success)
    ).render();
  }

  if (document.getElementById('totalExpensesChart')) {
    new ApexCharts(
      document.querySelector('#totalExpensesChart'),
      baseAreaOptions(i18n.expensesSeries || 'Total Expenses', [11, 32, 45, 32, 34, 52, 41], theme.warning)
    ).render();
  }

  // Trips by city donut
  if (document.getElementById('totalSale')) {
    const options = {
      series: [40, 30, 20, 10],
      labels: (i18n.cities && i18n.cities.labels) || ['City A', 'City B', 'City C', 'City D'],
      colors: ['#0d99ff', '#fdbc3d', '#00b8d9', '#e5484d'],
      chart: {
        type: 'donut',
        height: 377,
        fontFamily,
        foreColor: theme.gray600,
      },
      legend: { position: isRTL ? 'left' : 'right' },
      dataLabels: {
        enabled: true,
        dropShadow: { blur: 0, opacity: 0 },
      },
      plotOptions: {
        pie: {
          donut: { size: '65%' },
        },
      },
      stroke: { width: 0 },
      responsive: [
        {
          breakpoint: 1400,
          options: {
            chart: { type: 'donut', width: 290, height: 330 },
          },
        },
      ],
      tooltip: { theme: 'light' },
    };
    new ApexCharts(document.querySelector('#totalSale'), options).render();
  }

  // Users by gender radial bar
  if (document.getElementById('salesBygender')) {
    const genderLabels = (i18n.genders && i18n.genders.labels) || ['Male', 'Female'];
    const options = {
      series: [55, 45],
      chart: {
        height: 350,
        type: 'radialBar',
        fontFamily,
        foreColor: theme.gray600,
      },
      colors: ['#74C6FF', '#FFE9D5'],
      plotOptions: {
        radialBar: {
          dataLabels: {
            name: { fontSize: '22px' },
            value: { fontSize: '16px' },
            total: { show: false },
          },
          hollow: {
            margin: 3,
            size: '40%',
            background: 'transparent',
          },
          track: {
            show: true,
            background: theme.gray300,
            strokeWidth: '45%',
            opacity: 1,
            margin: 5,
          },
        },
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          type: 'vertical',
          gradientToColors: ['#0B77CC', '#FFAC82'],
          stops: [0, 100],
        },
      },
      stroke: { lineCap: 'round' },
      labels: genderLabels,
      tooltip: { theme: 'light' },
    };
    new ApexCharts(document.querySelector('#salesBygender'), options).render();
  }

  // World map
  if (document.getElementById('map-world') && typeof jsVectorMap !== 'undefined') {
    const map = new jsVectorMap({
      selector: '#map-world',
      map: 'world',
      backgroundColor: 'transparent',
      regionStyle: {
        initial: {
          fill: theme.gray300,
          stroke: theme.gray300,
          strokeWidth: 2,
        },
      },
      zoomOnScroll: false,
      zoomButtons: false,
      visualizeData: {
        scale: ['#fcfdfd', '#c4cdd5', '#ff0000'],
        values: {
          EG: 3100,
          SA: 434,
          AE: 239,
          KW: 117,
          QA: 126,
        },
      },
    });

    window.addEventListener('resize', () => {
      map.updateSize();
    });
  }
})();
