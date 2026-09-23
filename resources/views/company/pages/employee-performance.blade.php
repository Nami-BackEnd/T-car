@extends('company.layouts.master')

@section('title', 'T-Car — أداء السائقين')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.employee-performance.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.pages.employee-performance.0') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
              <div class="dropdown">
                <button
                  class="btn btn-outline dropdown-toggle"
                  type="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="bi bi-download"></i> {{ __('company.common.301') }}</button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="#" id="exportExcel"
                      ><i class="bi bi-file-earmark-excel"></i> {{ __('company.common.302') }}</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>

          
          <div class="table-card mb-4">
            <div class="table-filter-bar">
              <div class="table-filter-bar__left">
                <button
                  type="button"
                  class="filter-btn js-date-trigger"
                  data-field-key="pickupDate"
                >
                  <span class="js-date-trigger-label">{{ __('company.common.284') }}</span>
                  <i class="bi bi-chevron-down"></i>
                </button>

                

                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    {{ __('company.common.235') }}<i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>
                    <li><a class="dropdown-item" href="#">{{ __('company.common.223') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('company.pages.employee-performance.1') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('company.pages.employee-performance.2') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('company.pages.employee-performance.3') }}</a></li>
                  </ul>
                </div>
              </div>

              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="employeeSearchInput"  placeholder="{{ __('company.common.253') }}" />
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="data-table" id="employeeTable">
                <thead>
                  <tr>
                    <th>{{ __('company.pages.employee-performance.4') }}</th>
                    <th>{{ __('company.pages.employee-performance.5') }}</th>
                    <th>{{ __('company.pages.employee-performance.6') }}</th>
                    <th>{{ __('company.pages.employee-performance.7') }}</th>
                    <th>{{ __('company.common.162') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="5">
                      <div class="empty-state">
                        <i class="bi bi-inbox empty-state__icon"></i>
                        <span>{{ __('company.pages.employee-performance.8') }}</span>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="table-pagination table-pagination-dt">
              <div class="table-pagination__size-select">
                <label for="pageSizeSelect">{{ __('company.common.212') }}</label>
                <select id="pageSizeSelect">
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50" selected>50</option>
                </select>
              </div>
              <div class="table-pagination__pages">
                <button class="table-pagination__page-btn" disabled>
                  <i class="bi bi-chevron-right"></i>
                </button>
                <button class="table-pagination__page-btn is-active">1</button>
                <button class="table-pagination__page-btn" disabled>
                  <i class="bi bi-chevron-left"></i>
                </button>
              </div>
            </div>
          </div>

          
          <div
            class="modal fade"
            id="dateRangeModal"
            tabindex="-1"
            aria-hidden="true"
            aria-labelledby="dateRangeModalLabel"
          >
            <div class="modal-dialog modal-dialog-centered daterange-modal-dialog">
              <div class="modal-content daterange-modal">
                
                <span class="visually-hidden" id="dateRangeModalLabel">{{ __('company.common.124') }}</span>
                <div class="daterange-modal__body">
                  <div class="daterange-presets">
                    <button type="button" class="daterange-presets__item" data-quick="today">
                      {{ __('company.common.249') }}</button>
                    <button type="button" class="daterange-presets__item" data-quick="yesterday">
                      {{ __('company.common.68') }}</button>
                    <button type="button" class="daterange-presets__item" data-quick="thisWeek">
                      {{ __('company.common.147') }}</button>
                    <button type="button" class="daterange-presets__item" data-quick="lastWeek">
                      {{ __('company.common.142') }}</button>
                    <button
                      type="button"
                      class="daterange-presets__item is-active"
                      data-quick="thisMonth"
                    >
                      {{ __('company.common.209') }}</button>
                    <button type="button" class="daterange-presets__item" data-quick="lastMonth">
                      {{ __('company.common.210') }}</button>
                    <div class="daterange-presets__days">
                      <label for="daysBeforeInput">{{ __('company.common.143') }}</label>
                      <input type="number" id="daysBeforeInput" min="1" value="1" />
                    </div>
                  </div>

                  <div class="daterange-modal__main">
                    <div class="daterange-inputs">
                      <input type="text" class="ltr-num" id="dateFromField" readonly />
                      <input type="text" class="ltr-num is-active" id="dateToField" readonly />
                    </div>

                    <div class="daterange-calendars">
                      <div class="daterange-calendars__year">
                        <div class="dropdown">
                          <button
                            class="year-select-btn dropdown-toggle"
                            type="button"
                            id="yearSelectBtn"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          ></button>
                          <ul class="dropdown-menu" id="yearSelectMenu"></ul>
                        </div>
                      </div>

                      <div class="daterange-calendars__grid">
                        <div class="calendar-month">
                          <div class="calendar-month__header">
                            <button
                              type="button"
                              class="calendar-nav"
                              id="calPrevBtn"
                               aria-label="{{ __('company.common.210') }}"
                            >
                              <i class="bi bi-chevron-right"></i>
                            </button>
                            <span class="calendar-month__title" id="calTitleRight"></span>
                            <span class="calendar-month__spacer"></span>
                          </div>
                          <div class="calendar-month__weekdays">
                            <span>{{ __('company.common.420') }}</span><span>{{ __('company.common.51') }}</span><span>{{ __('company.common.103') }}</span><span>{{ __('company.common.356') }}</span
                            ><span>{{ __('company.common.63') }}</span><span>{{ __('company.common.383') }}</span><span>{{ __('company.common.361') }}</span>
                          </div>
                          <div class="calendar-month__days" id="calDaysRight"></div>
                        </div>

                        <div class="calendar-month">
                          <div class="calendar-month__header">
                            <span class="calendar-month__spacer"></span>
                            <span class="calendar-month__title" id="calTitleLeft"></span>
                            <button
                              type="button"
                              class="calendar-nav"
                              id="calNextBtn"
                               aria-label="{{ __('company.common.208') }}"
                            >
                              <i class="bi bi-chevron-left"></i>
                            </button>
                          </div>
                          <div class="calendar-month__weekdays">
                            <span>{{ __('company.common.420') }}</span><span>{{ __('company.common.51') }}</span><span>{{ __('company.common.103') }}</span><span>{{ __('company.common.356') }}</span
                            ><span>{{ __('company.common.63') }}</span><span>{{ __('company.common.383') }}</span><span>{{ __('company.common.361') }}</span>
                          </div>
                          <div class="calendar-month__days" id="calDaysLeft"></div>
                        </div>
                      </div>
                    </div>

                    <div class="daterange-modal__actions">
                      <button type="button" class="btn btn-primary btn-sm" id="dateRangeConfirmBtn">
                        {{ __('company.common.566') }}</button>
                      <button type="button" class="btn btn-outline btn-sm" data-bs-dismiss="modal">
                        {{ __('company.common.95') }}</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('modals')
</main>
        
      

    
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        // Export CSV
        document.getElementById('exportCsv').addEventListener('click', function (e) {
          e.preventDefault();
          exportTableAsCSV('employee_performance.csv');
        });

        // Export Excel
        document.getElementById('exportExcel').addEventListener('click', function (e) {
          e.preventDefault();
          exportTableAsCSV('employee_performance.xls');
        });

        // Export PDF
        document.getElementById('exportPdf').addEventListener('click', function (e) {
          e.preventDefault();
          alert('سيتم تصدير الملف بصيغة PDF');
          // PDF export would require a library like jsPDF or html2pdf
        });

        function exportTableAsCSV(filename) {
          var table = document.getElementById('employeeTable');
          var rows = table.querySelectorAll('tbody tr');

          // Create CSV content
          var csvContent = [];
          var headers = [];
          table.querySelectorAll('thead th').forEach(function (th) {
            headers.push(th.textContent.trim());
          });
          csvContent.push(headers.join(','));

          rows.forEach(function (row) {
            var rowData = [];
            row.querySelectorAll('td').forEach(function (td) {
              rowData.push(td.textContent.trim());
            });
            csvContent.push(rowData.join(','));
          });

          // Create download link
          var csvString = csvContent.join('\n');
          var blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
          var link = document.createElement('a');
          var url = URL.createObjectURL(blob);

          link.setAttribute('href', url);
          link.setAttribute('download', filename);
          link.style.visibility = 'hidden';
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        }

        // Filter buttons active state
        document.querySelectorAll('.filter-btn').forEach(function (btn) {
          btn.addEventListener('click', function () {
            // Remove is-active from all filter buttons
            document.querySelectorAll('.filter-btn').forEach(function (b) {
              b.classList.remove('is-active');
            });
            // Add is-active to clicked button
            this.classList.add('is-active');
          });
        });

        // Dropdown items active state
        document.querySelectorAll('.dropdown-item').forEach(function (item) {
          item.addEventListener('click', function (e) {
            e.preventDefault();
            var dropdown = this.closest('.dropdown');
            var btn = dropdown.querySelector('.filter-btn');
            var itemText = this.textContent.trim();

            // Remove is-active from all dropdown items in this dropdown
            dropdown.querySelectorAll('.dropdown-item').forEach(function (i) {
              i.classList.remove('is-active');
            });
            // Add is-active to clicked item
            this.classList.add('is-active');

            // Update button text with selected option
            if (btn) {
              btn.classList.add('is-active');
              // Keep the icon if exists, update text
              var icon = btn.querySelector('i');
              if (icon) {
                btn.innerHTML = itemText + ' <i class="bi bi-chevron-down"></i>';
              } else {
                btn.textContent = itemText;
              }
            }
          });
        });
      });
    </script>
@endpush

