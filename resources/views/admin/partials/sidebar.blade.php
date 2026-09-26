{{-- Vertical Sidebar --}}
<div id="miniSidebar">
  <div class="brand-logo">
    <a class="d-none d-md-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
      <img src="{{ asset('admin/assets/images/brand/logo/tcar-logo.svg') }}" alt="{{ __('admin.panel_name') }}" class="brand-logo-img" />
    </a>
  </div>

  @php
    $sections = [
      'items' => [
        ['label' => __('admin.common.dashboard'), 'icon' => 'ti-layout-dashboard', 'route' => 'admin.dashboard', 'active' => request()->routeIs('admin.dashboard')],
      ],
    ];
    $userItems = [
      ['label' => __('admin.nav.users'), 'icon' => 'ti-users', 'route' => 'admin.users.index', 'active' => request()->routeIs('admin.users.*')],
      ['label' => __('admin.nav.sliders'), 'icon' => 'ti-carousel-horizontal', 'route' => 'admin.sliders.index', 'active' => request()->routeIs('admin.sliders.*')],
      ['label' => __('admin.nav.join_requests'), 'icon' => 'ti-inbox', 'route' => 'admin.join-us.index', 'active' => request()->routeIs('admin.join-us.*')],
    ];
    $branchItems = [
      ['label' => __('admin.nav.branch_requests'), 'icon' => 'ti-building', 'route' => 'admin.branches.index', 'active' => request()->routeIs('admin.branches.*')],
    ];
    $companyItems = [
      ['label' => __('admin.nav.warranty'), 'icon' => 'ti-shield-check', 'route' => 'admin.warranties.index', 'active' => request()->routeIs('admin.warranties.*')],
      ['label' => __('admin.nav.alerts'), 'icon' => 'ti-bell', 'route' => 'admin.alrts.index', 'active' => request()->routeIs('admin.alrts.*')],
    ];

    $isLookupActive = function (string $slug): bool {
      return request()->routeIs('admin.lookups.*') && request()->route('entity') === $slug;
    };

    $locationItems = [
      ['label' => __('admin.lookups.countries'), 'icon' => 'ti-world', 'route' => 'admin.lookups.index', 'params' => ['countries'], 'active' => $isLookupActive('countries')],
      ['label' => __('admin.lookups.cities'), 'icon' => 'ti-map-pin', 'route' => 'admin.lookups.index', 'params' => ['cities'], 'active' => $isLookupActive('cities')],
      ['label' => __('admin.lookups.airports'), 'icon' => 'ti-plane', 'route' => 'admin.lookups.index', 'params' => ['airports'], 'active' => $isLookupActive('airports')],
      ['label' => __('admin.lookups.train_stations'), 'icon' => 'ti-train', 'route' => 'admin.lookups.index', 'params' => ['train-stations'], 'active' => $isLookupActive('train-stations')],
    ];
    $carItems = [
      ['label' => __('admin.lookups.brands'), 'icon' => 'ti-tags', 'route' => 'admin.lookups.index', 'params' => ['brands'], 'active' => $isLookupActive('brands')],
      ['label' => __('admin.lookups.car_types'), 'icon' => 'ti-layout-grid', 'route' => 'admin.lookups.index', 'params' => ['car-types'], 'active' => $isLookupActive('car-types')],
      ['label' => __('admin.lookups.models'), 'icon' => 'ti-car', 'route' => 'admin.lookups.index', 'params' => ['car-models'], 'active' => $isLookupActive('car-models')],
      ['label' => __('admin.lookups.features'), 'icon' => 'ti-star', 'route' => 'admin.lookups.index', 'params' => ['features'], 'active' => $isLookupActive('features')],
    ];
    $companyDataItems = [
      ['label' => __('admin.lookups.vacations'), 'icon' => 'ti-calendar', 'route' => 'admin.lookups.index', 'params' => ['vacations'], 'active' => $isLookupActive('vacations')],
      ['label' => __('admin.lookups.banks'), 'icon' => 'ti-building-bank', 'route' => 'admin.lookups.index', 'params' => ['banks'], 'active' => $isLookupActive('banks')],
      ['label' => __('admin.lookups.company_services'), 'icon' => 'ti-tools', 'route' => 'admin.lookups.index', 'params' => ['company-services'], 'active' => $isLookupActive('company-services')],
    ];
    $paymentItems = [
      ['label' => __('admin.lookups.payment_methods'), 'icon' => 'ti-credit-card', 'route' => 'admin.lookups.index', 'params' => ['payment-methods'], 'active' => $isLookupActive('payment-methods')],
    ];
    $settingItems = [
      ['label' => __('admin.nav.settings'), 'icon' => 'ti-settings', 'route' => 'admin.settings.index', 'active' => request()->routeIs('admin.settings.*')],
      ['label' => __('admin.nav.faqs'), 'icon' => 'ti-help-circle', 'route' => 'admin.faqs.index', 'active' => request()->routeIs('admin.faqs.*')],
      ['label' => __('admin.nav.terms'), 'icon' => 'ti-file-text', 'route' => 'admin.terms.index', 'active' => request()->routeIs('admin.terms.*')],
      ['label' => __('admin.nav.about_us'), 'icon' => 'ti-info-circle', 'route' => 'admin.about-us.index', 'active' => request()->routeIs('admin.about-us.*')],
      ['label' => __('admin.nav.privacy'), 'icon' => 'ti-shield-lock', 'route' => 'admin.privacy-policy.index', 'active' => request()->routeIs('admin.privacy-policy.*')],
      ['label' => __('admin.nav.client_instructions'), 'icon' => 'ti-clipboard-text', 'route' => 'admin.client-instructions.index', 'active' => request()->routeIs('admin.client-instructions.*')],
      ['label' => __('admin.nav.contact_msgs'), 'icon' => 'ti-mail', 'route' => 'admin.contact-us.index', 'active' => request()->routeIs('admin.contact-us.*')],
    ];

    if (!function_exists('adminSidebarItem')) {
      function adminSidebarItem(array $item): string
      {
        $href = isset($item['route']) && \Illuminate\Support\Facades\Route::has($item['route'])
          ? route($item['route'], $item['params'] ?? [])
          : '#!';
        $active = !empty($item['active']) ? ' active' : '';

        return '<li class="nav-item">'
          . '<a class="nav-link' . $active . '" href="' . $href . '">'
          . '<span class="nav-icon"><i class="ti ' . e($item['icon']) . '" style="font-size:20px"></i></span>'
          . '<span class="text">' . e($item['label']) . '</span>'
          . '</a></li>';
      }
    }

    if (!function_exists('adminSidebarHeading')) {
      function adminSidebarHeading(string $label): string
      {
        return '<li class="nav-item">'
          . '<div class="nav-heading">' . e($label) . '</div>'
          . '<hr class="mx-5 nav-line mb-1" />'
          . '</li>';
      }
    }

    if (!function_exists('adminDropdown')) {
      function adminDropdown(string $label, string $icon, array $items, bool $open): string
      {
        $html = '<li class="nav-item dropdown' . ($open ? ' show' : '') . '">'
          . '<a href="#" class="nav-link dropdown-toggle' . ($open ? ' active' : '') . '" role="button" data-bs-toggle="dropdown"'
          . ' aria-expanded="' . ($open ? 'true' : 'false') . '">'
          . '<span class="nav-icon"><i class="ti ' . e($icon) . '" style="font-size:20px"></i></span>'
          . '<span class="text">' . e($label) . '</span>'
          . '</a>'
          . '<div class="dropdown-menu' . ($open ? ' show' : '') . '">';

        foreach ($items as $item) {
          $href = isset($item['route']) && \Illuminate\Support\Facades\Route::has($item['route'])
            ? route($item['route'], $item['params'] ?? [])
            : '#!';
          $active = !empty($item['active']) ? ' active' : '';

          $html .= '<a class="nav-link' . $active . '" href="' . $href . '">'
            . '<span class="nav-icon"><i class="ti ' . e($item['icon']) . '" style="font-size:18px"></i></span>'
            . '<span class="text">' . e($item['label']) . '</span>'
            . '</a>';
        }

        return $html . '</div></li>';
      }
    }

    $setupOpen = request()->routeIs('admin.lookups.*');
    $entity = $setupOpen ? request()->route('entity') : null;

    $locationOpen = $setupOpen && in_array($entity, ['countries', 'cities', 'airports', 'train-stations'], true);
    $carOpen = $setupOpen && in_array($entity, ['brands', 'car-types', 'car-models', 'features'], true);
    $companyDataOpen = $setupOpen && in_array($entity, ['vacations', 'banks', 'company-services'], true);
    $paymentOpen = $setupOpen && in_array($entity, ['payment-methods'], true);

    $setupDropdown =
      adminDropdown(__('admin.nav.locations'), 'ti-map-pin', $locationItems, $locationOpen)
      . adminDropdown(__('admin.nav.car_lists'), 'ti-car', $carItems, $carOpen)
      . adminDropdown(__('admin.nav.company_data'), 'ti-building-bank', $companyDataItems, $companyDataOpen)
      . adminDropdown(__('admin.nav.payments'), 'ti-credit-card', $paymentItems, $paymentOpen);
  @endphp

  <ul class="navbar-nav flex-column">
    {!! adminSidebarItem($sections['items'][0]) !!}

    {!! adminSidebarHeading(__('admin.nav.users')) !!}
    @foreach ($userItems as $item)
      {!! adminSidebarItem($item) !!}
    @endforeach

    {!! adminSidebarHeading(__('admin.nav.companies')) !!}
    {!! adminDropdown(__('admin.nav.branch_management'), 'ti-building', $branchItems, request()->routeIs('admin.branches.*')) !!}
    @foreach ($companyItems as $item)
      {!! adminSidebarItem($item) !!}
    @endforeach

    {!! adminSidebarHeading(__('admin.nav.setup')) !!}

    {!! $setupDropdown !!}

    {!! adminSidebarHeading(__('admin.common.settings')) !!}
    @foreach ($settingItems as $item)
      {!! adminSidebarItem($item) !!}
    @endforeach

    {{-- Admin card --}}
 
  </ul>
</div>

{{-- Mobile Offcanvas Sidebar --}}
<div class="offcanvasNav offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <a class="d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
      <img src="{{ asset('admin/assets/images/brand/logo/tcar-logo.svg') }}" alt="{{ __('admin.panel_name') }}" class="brand-logo-img" />
    </a>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body p-0">
    <ul class="navbar-nav flex-column">
      {!! adminSidebarItem($sections['items'][0]) !!}

      {!! adminSidebarHeading(__('admin.nav.users')) !!}
      @foreach ($userItems as $item)
        {!! adminSidebarItem($item) !!}
      @endforeach

      {!! adminSidebarHeading(__('admin.nav.companies')) !!}
      {!! adminDropdown(__('admin.nav.branch_management'), 'ti-building', $branchItems, request()->routeIs('admin.branches.*')) !!}
      @foreach ($companyItems as $item)
        {!! adminSidebarItem($item) !!}
      @endforeach

      {!! adminSidebarHeading(__('admin.nav.setup')) !!}

      {!! $setupDropdown !!}

      {!! adminSidebarHeading(__('admin.common.settings')) !!}
      @foreach ($settingItems as $item)
        {!! adminSidebarItem($item) !!}
      @endforeach
    </ul>
  </div>
</div>
