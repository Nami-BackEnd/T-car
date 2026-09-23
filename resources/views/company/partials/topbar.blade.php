<header class="topbar">
  <div class="topbar__toggle-dock">
    <button class="toggle-btn" id="sidebarToggleBtn" type="button" aria-label="Toggle sidebar" aria-controls="sidebar">
      <i class="bi bi-list"></i>
    </button>
  </div>

  <div class="topbar__left">
    <div class="header-search" role="search">
      <i class="bi bi-search"></i>
      <input type="search" placeholder="{{ __('company.common.search') }}" aria-label="Search" />
    </div>
  </div>

  <div class="topbar__right">
    {{-- Language switch --}}
    <div class="lang-switch" id="langSwitch">
      <span class="lang-switch__pill" id="langPill"></span>
      <button type="button" data-lang="en" class="{{ app()->getLocale() === 'en' ? 'is-active' : '' }}">
        <span class="lang-label-full">English</span>
        <span class="lang-label-short">EN</span>
      </button>
      <button type="button" data-lang="ar" class="{{ app()->getLocale() === 'ar' ? 'is-active' : '' }}">
        <span class="lang-label-full">العربية</span>
        <span class="lang-label-short">AR</span>
      </button>
    </div>

    <span class="topbar__divider"></span>

    {{-- Account switch --}}
    <div class="dropdown account-switch">
      <button class="btn-account dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="account-dot"></span>
        <span>{{ auth('company')->user()?->name ?? __('company.common.company') }}</span>
        <i class="bi bi-chevron-down"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li class="dropdown-header">{{ __('company.common.switch_account') }}</li>
        <li>
          <a class="dropdown-item active" href="#"><i class="bi bi-building"></i> {{ auth('company')->user()?->name ?? __('company.common.company') }}</a>
        </li>
      </ul>
    </div>

    {{-- Profile --}}
    <div class="dropdown">
      <button class="profile-trigger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="avatar">@php $name = auth('company')->user()?->name ?? 'T-Car'; echo mb_substr($name, 0, 2); @endphp</span>
        <span class="profile-meta">
          <span class="name">{{ auth('company')->user()?->name ?? __('company.common.company') }}</span>
          <span class="role">{{ __('company.common.company') }}</span>
        </span>
        <i class="bi bi-chevron-down profile-chevron"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item" href="{{ route('company.edit-profile') }}"><i class="bi bi-pencil-square"></i> {{ __('company.common.edit_profile') }}</a>
        </li>
        <li>
          <hr class="dropdown-divider" />
        </li>
        <li>
          <a class="dropdown-item text-danger" href="{{ route('company.logout') }}" onclick="event.preventDefault(); document.getElementById('company-logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> {{ __('company.common.logout') }}
          </a>
          <form id="company-logout-form" action="{{ route('company.logout') }}" method="POST" class="d-none">@csrf</form>
        </li>
      </ul>
    </div>
  </div>
</header>