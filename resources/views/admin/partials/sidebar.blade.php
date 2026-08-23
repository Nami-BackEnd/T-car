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
    $managementItems = [
      ['label' => __('admin.nav.users'), 'icon' => 'ti-users', 'route' => 'admin.users.index', 'active' => request()->routeIs('admin.users.*')],
      ['label' => __('admin.nav.drivers'), 'icon' => 'ti-steering-wheel'],
      ['label' => __('admin.nav.companies'), 'icon' => 'ti-building'],
      ['label' => __('admin.nav.join_requests'), 'icon' => 'ti-inbox'],
      ['label' => __('admin.nav.wallet'), 'icon' => 'ti-wallet'],
      ['label' => __('admin.nav.alerts'), 'icon' => 'ti-bell', 'route' => 'admin.alrts.index', 'active' => request()->routeIs('admin.alrts.*')],
    ];
    $contentItems = [
      ['label' => __('admin.nav.faqs'), 'icon' => 'ti-help-circle', 'route' => 'admin.faqs.index', 'active' => request()->routeIs('admin.faqs.*')],
      ['label' => __('admin.nav.terms'), 'icon' => 'ti-file-text', 'route' => 'admin.terms.index', 'active' => request()->routeIs('admin.terms.*')],
      ['label' => __('admin.nav.about_us'), 'icon' => 'ti-info-circle', 'route' => 'admin.about-us.index', 'active' => request()->routeIs('admin.about-us.*')],
      ['label' => __('admin.nav.privacy'), 'icon' => 'ti-shield-lock', 'route' => 'admin.privacy-policy.index', 'active' => request()->routeIs('admin.privacy-policy.*')],
      ['label' => __('admin.nav.contact_msgs'), 'icon' => 'ti-mail', 'route' => 'admin.contact-us.index', 'active' => request()->routeIs('admin.contact-us.*')],
    ];

    if (!function_exists('adminSidebarItem')) {
      function adminSidebarItem(array $item): string
      {
        $href = isset($item['route']) && \Illuminate\Support\Facades\Route::has($item['route'])
          ? route($item['route'])
          : '#!';
        $active = !empty($item['active']) ? ' active' : '';

        return '<li class="nav-item">'
          . '<a class="nav-link' . $active . '" href="' . $href . '">'
          . '<span class="nav-icon"><i class="ti ' . e($item['icon']) . '" style="font-size:20px"></i></span>'
          . '<span class="text">' . e($item['label']) . '</span>'
          . '</a></li>';
      }
    }
  @endphp

  <ul class="navbar-nav flex-column">
    {!! adminSidebarItem($sections['items'][0]) !!}

    <li class="nav-item">
      <div class="nav-heading">{{ __('admin.nav.management') }}</div>
      <hr class="mx-5 nav-line mb-1" />
    </li>
    @foreach ($managementItems as $item)
      {!! adminSidebarItem($item) !!}
    @endforeach

    <li class="nav-item">
      <div class="nav-heading">{{ __('admin.nav.content') }}</div>
      <hr class="mx-5 nav-line mb-1" />
    </li>
    @foreach ($contentItems as $item)
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

      <li class="nav-item">
        <div class="nav-heading">{{ __('admin.nav.management') }}</div>
        <hr class="mx-5 nav-line mb-1" />
      </li>
      @foreach ($managementItems as $item)
        {!! adminSidebarItem($item) !!}
      @endforeach

      <li class="nav-item">
        <div class="nav-heading">{{ __('admin.nav.content') }}</div>
        <hr class="mx-5 nav-line mb-1" />
      </li>
      @foreach ($contentItems as $item)
        {!! adminSidebarItem($item) !!}
      @endforeach
    </ul>
  </div>
</div>
