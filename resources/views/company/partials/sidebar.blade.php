<aside class="sidebar" id="sidebar" aria-label="Primary navigation">
  <div class="sidebar__brand">
    <a class="sidebar__brand-logo" href="{{ route('company.dashboard') }}">
      <img src="{{ asset('company/img/logo.svg') }}" alt="T-Car" class="logo-full" />
      <img src="{{ asset('company/img/fav.svg') }}" alt="T-Car" class="logo-fav" />
    </a>
  </div>

  @php
    $isActive = static function (string $pattern): string {
      return request()->routeIs($pattern) ? ' is-active' : '';
    };
    $isOpen = static function (string $pattern): string {
      return request()->routeIs($pattern) ? ' is-open is-active' : '';
    };
    $sublinkActive = static function (string $pattern): string {
      return request()->routeIs($pattern) ? ' is-active' : '';
    };
  @endphp

  <nav class="sidebar__nav">
    <div class="sidebar__section-label">{{ __('company.nav.home') }}</div>
    <ul class="nav-menu">
      <li class="nav-menu__item{{ $isActive('company.dashboard') }}">
        <a href="{{ route('company.dashboard') }}" class="nav-menu__link" @if(request()->routeIs('company.dashboard')) aria-current="page" @endif>
          <span class="nav-menu__link-main">
            <span class="nav-menu__icon"><i class="bi bi-speedometer2"></i></span>
            <span class="nav-menu__text">{{ __('company.nav.dashboard') }}</span>
          </span>
          <span class="nav-menu__tooltip">{{ __('company.nav.dashboard') }}</span>
        </a>
      </li>

      <li class="nav-menu__item has-children{{ $isOpen('company.reservations*') }}">
        <a href="#" class="nav-menu__link" data-submenu-toggle
          aria-expanded="{{ request()->routeIs('company.reservations*') ? 'true' : 'false' }}">
          <span class="nav-menu__link-main">
            <span class="nav-menu__icon"><i class="bi bi-calendar-check"></i></span>
            <span class="nav-menu__text">{{ __('company.nav.reservations') }}</span>
          </span>
          <i class="bi bi-chevron-right nav-menu__caret"></i>
          <span class="nav-menu__tooltip">{{ __('company.nav.reservations') }}</span>
        </a>
        <ul class="nav-menu__submenu">
          <li>
            <a href="{{ route('company.reservations') }}" class="nav-menu__sublink{{ $sublinkActive('company.reservations') }}">{{ __('company.nav.reservations_list') }}</a>
          </li>
          <li>
            <a href="{{ route('company.late-delivery') }}" class="nav-menu__sublink{{ $sublinkActive('company.late-delivery') }}">{{ __('company.nav.late_delivery') }}</a>
          </li>
          <li>
            <a href="{{ route('company.delivery-reservations') }}" class="nav-menu__sublink{{ $sublinkActive('company.delivery-reservations') }}">{{ __('company.nav.delivery_reservations') }}</a>
          </li>
          <li>
            <a href="{{ route('company.pending-reservations') }}" class="nav-menu__sublink{{ $sublinkActive('company.pending-reservations') }}">{{ __('company.nav.pending_reservations') }}</a>
          </li>
          <li>
            <a href="{{ route('company.scheduled-reservations') }}" class="nav-menu__sublink{{ $sublinkActive('company.scheduled-reservations') }}">{{ __('company.nav.scheduled_reservations') }}</a>
          </li>
          <li>
            <a href="{{ route('company.return-reservations') }}" class="nav-menu__sublink{{ $sublinkActive('company.return-reservations') }}">{{ __('company.nav.return_reservations') }}</a>
          </li>
        </ul>
        <div class="nav-menu__flyout">
          <div class="nav-menu__flyout-title">{{ __('company.nav.reservations') }}</div>
          <a href="{{ route('company.reservations') }}">{{ __('company.nav.reservations_list') }}</a>
          <a href="{{ route('company.late-delivery') }}">{{ __('company.nav.late_delivery') }}</a>
          <a href="{{ route('company.delivery-reservations') }}">{{ __('company.nav.delivery_reservations') }}</a>
          <a href="{{ route('company.pending-reservations') }}">{{ __('company.nav.pending_reservations') }}</a>
          <a href="{{ route('company.scheduled-reservations') }}">{{ __('company.nav.scheduled_reservations') }}</a>
          <a href="{{ route('company.return-reservations') }}">{{ __('company.nav.return_reservations') }}</a>
        </div>
      </li>

      <li class="nav-menu__item{{ $isActive('company.invoices') }}">
        <a href="{{ route('company.invoices') }}" class="nav-menu__link">
          <span class="nav-menu__link-main">
            <span class="nav-menu__icon"><i class="bi bi-receipt"></i></span>
            <span class="nav-menu__text">{{ __('company.nav.invoices') }}</span>
          </span>
          <span class="nav-menu__tooltip">{{ __('company.nav.invoices') }}</span>
        </a>
      </li>
      <li class="nav-menu__item{{ $isActive('company.order-updates*') }}">
        <a href="{{ route('company.order-updates') }}" class="nav-menu__link">
          <span class="nav-menu__link-main">
            <span class="nav-menu__icon"><i class="bi bi-pencil"></i></span>
            <span class="nav-menu__text">{{ __('company.nav.order_updates') }}</span>
          </span>
          <span class="nav-menu__tooltip">{{ __('company.nav.order_updates') }}</span>
        </a>
      </li>
      <li class="nav-menu__item{{ $isActive('company.subscriptions') }}">
        <a href="{{ route('company.subscriptions') }}" class="nav-menu__link">
          <span class="nav-menu__link-main">
            <span class="nav-menu__icon"><i class="bi bi-repeat"></i></span>
            <span class="nav-menu__text">{{ __('company.nav.subscriptions') }}</span>
          </span>
          <span class="nav-menu__tooltip">{{ __('company.nav.subscriptions') }}</span>
        </a>
      </li>

      <li class="nav-menu__item has-children{{ $isOpen('company.discounts*') }}">
        <a href="#" class="nav-menu__link" data-submenu-toggle
          aria-expanded="{{ request()->routeIs('company.discounts*') ? 'true' : 'false' }}">
          <span class="nav-menu__link-main">
            <span class="nav-menu__icon"><i class="bi bi-percent"></i></span>
            <span class="nav-menu__text">{{ __('company.nav.offers') }}</span>
          </span>
          <i class="bi bi-chevron-right nav-menu__caret"></i>
          <span class="nav-menu__tooltip">{{ __('company.nav.offers') }}</span>
        </a>
        <ul class="nav-menu__submenu">
          <li><a href="{{ route('company.discounts') }}" class="nav-menu__sublink{{ $sublinkActive('company.discounts') }}">{{ __('company.nav.discounts') }}</a></li>
          <li><a href="{{ route('company.trending') }}" class="nav-menu__sublink{{ $sublinkActive('company.trending') }}">{{ __('company.nav.trending') }}</a></li>
          <li><a href="{{ route('company.special-offers') }}" class="nav-menu__sublink{{ $sublinkActive('company.special-offers') }}">{{ __('company.nav.special_offers') }}</a></li>
        </ul>
        <div class="nav-menu__flyout">
          <div class="nav-menu__flyout-title">{{ __('company.nav.offers') }}</div>
          <a href="{{ route('company.discounts') }}">{{ __('company.nav.discounts') }}</a>
          <a href="{{ route('company.trending') }}">{{ __('company.nav.trending') }}</a>
          <a href="{{ route('company.special-offers') }}">{{ __('company.nav.special_offers') }}</a>
        </div>
      </li>

      <li class="nav-menu__item{{ $isActive('company.employee-performance') }}">
        <a href="{{ route('company.employee-performance') }}" class="nav-menu__link">
          <span class="nav-menu__link-main">
            <span class="nav-menu__icon"><i class="bi bi-bar-chart-line"></i></span>
            <span class="nav-menu__text">{{ __('company.nav.employee_performance') }}</span>
          </span>
          <span class="nav-menu__tooltip">{{ __('company.nav.employee_performance') }}</span>
        </a>
      </li>

      <li class="nav-menu__item has-children{{ $isOpen('company.branches*') }}">
        <a href="#" class="nav-menu__link" data-submenu-toggle
          aria-expanded="{{ request()->routeIs('company.branches*') ? 'true' : 'false' }}">
          <span class="nav-menu__link-main">
            <span class="nav-menu__icon"><i class="bi bi-buildings"></i></span>
            <span class="nav-menu__text">{{ __('company.nav.branches') }}</span>
          </span>
          <i class="bi bi-chevron-right nav-menu__caret"></i>
          <span class="nav-menu__tooltip">{{ __('company.nav.branches') }}</span>
        </a>
        <ul class="nav-menu__submenu">
          <li>
            <a href="{{ route('company.branches') }}" class="nav-menu__sublink{{ $sublinkActive('company.branches') }}">{{ __('company.nav.branches') }}</a>
          </li>
          <li>
            <a href="{{ route('company.official-holidays') }}" class="nav-menu__sublink{{ $sublinkActive('company.official-holidays') }}">{{ __('company.nav.holidays') }}</a>
          </li>
        </ul>
        <div class="nav-menu__flyout">
          <div class="nav-menu__flyout-title">{{ __('company.nav.branches') }}</div>
          <a href="{{ route('company.branches') }}">{{ __('company.nav.branches') }}</a>
          <a href="{{ route('company.official-holidays') }}">{{ __('company.nav.holidays') }}</a>
        </div>
      </li>

      <li class="nav-menu__item has-children{{ $isOpen('company.car-availability*') }}">
        <a href="#" class="nav-menu__link" data-submenu-toggle
          aria-expanded="{{ request()->routeIs('company.car-availability*') ? 'true' : 'false' }}">
          <span class="nav-menu__link-main">
            <span class="nav-menu__icon"><i class="bi bi-car-front"></i></span>
            <span class="nav-menu__text">{{ __('company.nav.cars') }}</span>
          </span>
          <i class="bi bi-chevron-right nav-menu__caret"></i>
          <span class="nav-menu__tooltip">{{ __('company.nav.cars') }}</span>
        </a>
        <ul class="nav-menu__submenu">
          <li>
            <a href="{{ route('company.car-availability') }}" class="nav-menu__sublink{{ $sublinkActive('company.car-availability') }}">{{ __('company.nav.car_availability') }}</a>
          </li>
          <li>
            <a href="{{ route('company.license-plates') }}" class="nav-menu__sublink{{ $sublinkActive('company.license-plates') }}">{{ __('company.nav.car_list') }}</a>
          </li>
        </ul>
        <div class="nav-menu__flyout">
          <div class="nav-menu__flyout-title">{{ __('company.nav.cars') }}</div>
          <a href="{{ route('company.car-availability') }}">{{ __('company.nav.car_availability') }}</a>
          <a href="{{ route('company.license-plates') }}">{{ __('company.nav.car_list') }}</a>
        </div>
      </li>

      <li class="nav-menu__item has-children{{ $isOpen('company.managers-employees*') }}">
        <a href="#" class="nav-menu__link" data-submenu-toggle
          aria-expanded="{{ request()->routeIs('company.managers-employees*') ? 'true' : 'false' }}">
          <span class="nav-menu__link-main">
            <span class="nav-menu__icon"><i class="bi bi-people"></i></span>
            <span class="nav-menu__text">{{ __('company.nav.users') }}</span>
          </span>
          <i class="bi bi-chevron-right nav-menu__caret"></i>
          <span class="nav-menu__tooltip">{{ __('company.nav.users') }}</span>
        </a>
        <ul class="nav-menu__submenu">
          <li>
            <a href="{{ route('company.managers-employees') }}" class="nav-menu__sublink{{ $sublinkActive('company.managers-employees') }}">{{ __('company.nav.company_managers') }}</a>
          </li>
          <li>
            <a href="{{ route('company.drivers') }}" class="nav-menu__sublink{{ $sublinkActive('company.drivers') }}">{{ __('company.nav.drivers') }}</a>
          </li>
        </ul>
        <div class="nav-menu__flyout">
          <div class="nav-menu__flyout-title">{{ __('company.nav.users') }}</div>
          <a href="{{ route('company.managers-employees') }}">{{ __('company.nav.company_managers') }}</a>
          <a href="{{ route('company.drivers') }}">{{ __('company.nav.drivers') }}</a>
        </div>
      </li>
    </ul>

    <div class="sidebar__section-label">{{ __('company.nav.system') }}</div>
    <ul class="nav-menu">
      <li class="nav-menu__item{{ $isActive('company.settings') }}">
        <a href="{{ route('company.settings') }}" class="nav-menu__link">
          <span class="nav-menu__link-main">
            <span class="nav-menu__icon"><i class="bi bi-gear"></i></span>
            <span class="nav-menu__text">{{ __('company.nav.settings') }}</span>
          </span>
          <span class="nav-menu__tooltip">{{ __('company.nav.settings') }}</span>
        </a>
      </li>
      <li class="nav-menu__item{{ $isActive('company.support') }}">
        <a href="{{ route('company.support') }}" class="nav-menu__link">
          <span class="nav-menu__link-main">
            <span class="nav-menu__icon"><i class="bi bi-headset"></i></span>
            <span class="nav-menu__text">{{ __('company.nav.support') }}</span>
          </span>
          <span class="nav-menu__tooltip">{{ __('company.nav.support') }}</span>
        </a>
      </li>
    </ul>
  </nav>

  <div class="sidebar__footer">
    <button class="sidebar-collapse-btn" id="desktopCollapseBtn" type="button" aria-label="Collapse sidebar">
      <i class="bi bi-layout-sidebar-inset"></i>
    </button>
  </div>
</aside>
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>