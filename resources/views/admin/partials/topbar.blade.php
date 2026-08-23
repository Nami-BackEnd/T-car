{{-- Top navbar --}}
<div class="navbar-glass navbar navbar-expand-lg px-0 px-lg-4">
  <div class="container-fluid px-lg-0">
    <div class="d-flex align-items-center gap-4">
      {{-- Mobile offcanvas toggle --}}
      <div class="d-block d-lg-none">
        <a class="text-inherit" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
          <i class="ti ti-menu-2 fs-3"></i>
        </a>
      </div>
      {{-- Desktop sidebar collapse --}}
      <div class="d-none d-lg-block">
        <a class="sidebar-toggle d-flex texttooltip p-3" href="javascript:void(0)" data-template="collapseMessage">
          <span class="collapse-mini">
            <i class="ti ti-arrow-bar-left fs-3 text-secondary" style="font-size:20px"></i>
          </span>
          <span class="collapse-expanded">
            <i class="ti ti-arrow-bar-right text-secondary" style="font-size:20px"></i>
            <div id="collapseMessage" class="d-none">
              <span class="small">{{ __('admin.common.collapse') }}</span>
            </div>
          </span>
        </a>
      </div>
    </div>

    {{-- Right side actions --}}
    <ul class="list-unstyled d-flex align-items-center mb-0 gap-2">
      {{-- Search --}}
    
      {{-- Language switcher --}}
      <li>
        <div class="dropdown">
          <button class="btn btn-ghost btn-icon rounded-circle d-flex align-items-center" type="button"
            data-bs-toggle="dropdown" aria-expanded="false" aria-label="{{ __('admin.common.language') }}"
            data-bs-title="{{ __('admin.common.language') }}" data-bs-toggle-tooltip="tooltip">
            <i class="ti ti-world lh-1 fs-5"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow">
            <li>
              <button type="button"
                class="dropdown-item d-flex align-items-center {{ app()->getLocale() === 'ar' ? 'active' : '' }}"
                data-lang-switch="ar">
                <span class="me-2">🇪🇬</span> العربية
              </button>
            </li>
            <li>
              <button type="button"
                class="dropdown-item d-flex align-items-center {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                data-lang-switch="en">
                <span class="me-2">🇬🇧</span> English
              </button>
            </li>
          </ul>
        </div>
      </li>

      {{-- Light / Dark mode --}}
      <li>
        <div class="dropdown">
          <button class="btn btn-ghost btn-icon rounded-circle d-flex align-items-center" type="button"
            aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <i class="ti theme-icon-active lh-1 fs-5"><i class="ti theme-icon ti-sun"></i></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow">
            <li>
              <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="true">
                <i class="ti theme-icon ti ti-sun"></i>
                <span class="ms-2 me-2">{{ __('admin.common.light') }}</span>
              </button>
            </li>
            <li>
              <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                <i class="ti theme-icon ti-moon-stars"></i>
                <span class="ms-2 me-2">{{ __('admin.common.dark') }}</span>
              </button>
            </li>
            <li>
              <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
                <i class="ti theme-icon ti-circle-half-2"></i>
                <span class="ms-2 me-2">{{ __('admin.common.auto') }}</span>
              </button>
            </li>
          </ul>
        </div>
      </li>

      {{-- Notifications bell --}}
      <li>
        <a class="position-relative btn-icon btn-ghost btn rounded-circle" data-bs-toggle="offcanvas"
          href="#offcanvasNotification" role="button" aria-controls="offcanvasNotification">
          <i class="ti ti-bell" style="font-size:20px"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2 ms-n2">
            2
            <span class="visually-hidden">unread messages</span>
          </span>
        </a>
      </li>

      {{-- Profile dropdown --}}
      <li class="ms-3 dropdown">
        <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          @if (auth('admin')->user()?->image)
            <img src="{{ asset('storage/' . auth('admin')->user()->image) }}" alt="" class="avatar avatar-sm rounded-circle" />
          @else
            <img src="{{ asset('admin/assets/images/avatar/avatar.jpg') }}" alt="" class="avatar avatar-sm rounded-circle" />
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-0">
          <div>
            <div class="d-flex gap-3 align-items-center border-dashed border-bottom px-4 py-4">
              @if (auth('admin')->user()?->image)
                <img src="{{ asset('storage/' . auth('admin')->user()->image) }}" alt="" class="avatar avatar-md rounded-circle" />
              @else
                <img src="{{ asset('admin/assets/images/avatar/avatar.jpg') }}" alt="" class="avatar avatar-md rounded-circle" />
              @endif
              <div>
                <h4 class="mb-0 fs-5">{{ auth('admin')->user()?->name }}</h4>
                <p class="mb-0 text-secondary small">{{ auth('admin')->user()?->email }}</p>
              </div>
            </div>
            <div class="p-3 d-flex flex-column gap-1">
              <a href="#!" class="dropdown-item d-flex align-items-center gap-2">
                <span><i class="ti ti-user-circle" style="font-size:20px"></i></span>
                <span>{{ __('admin.common.profile') }}</span>
              </a>
              <a href="#!" class="dropdown-item d-flex align-items-center gap-2">
                <span><i class="ti ti-settings" style="font-size:20px"></i></span>
                <span>{{ __('admin.common.settings') }}</span>
              </a>
            </div>
            <div class="border-dashed border-top mb-4 pt-4 px-6">
              <a href="#" class="text-secondary d-flex align-items-center gap-2" data-admin-logout
                data-url="{{ route('admin.logout') }}">
                <span>
                  <i class="ti ti-logout-2" style="font-size:20px"></i>
                </span>
                <span>{{ __('admin.common.logout') }}</span>
              </a>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>

{{-- Notifications offcanvas --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNotification" aria-labelledby="offcanvasNotificationLabel">
  <div class="sticky-top bg-white">
    <div class="offcanvas-header gap-4">
      <div class="d-flex justify-content-between w-100">
        <h5 class="mb-0" id="offcanvasNotificationLabel">{{ __('admin.common.notifications') }}</h5>
        <div class="d-flex gap-3 align-items-center">
          <a href="#" class="link-primary" data-bs-toggle="tooltip" data-bs-placement="bottom"
            data-bs-title="{{ __('admin.common.mark_all_read') }}">
            <i class="ti ti-checks" style="font-size:24px"></i>
          </a>
        </div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="mt-2">
      <ul class="nav nav-line-bottom" id="pills-tab-notifications" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active px-4 py-2" id="pills-all-tab" data-bs-toggle="pill"
            data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">
            {{ __('admin.common.all') }}
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link px-4 py-2" id="pills-archive-tab" data-bs-toggle="pill"
            data-bs-target="#pills-archive" type="button" role="tab" aria-controls="pills-archive" aria-selected="false">
            {{ __('admin.common.archive') }}
          </button>
        </li>
      </ul>
    </div>
  </div>

  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
      <div data-simplebar style="height: 800px">
        <div class="list-group list-group-flush">
          <a href="#" class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
            <div class="d-flex justify-content-between">
              <div class="d-flex gap-4 align-items-center">
                <div class="icon-shape icon-md bg-primary-subtle text-primary-emphasis rounded-circle">
                  <i class="ti ti-inbox" style="font-size:20px"></i>
                </div>
                <div class="d-flex flex-column gap-1">
                  <div>{{ __('admin.nav.join_requests') }} — 3</div>
                  <small class="text-secondary">{{ __('admin.common.minutes_ago', ['minutes' => 5]) }}</small>
                </div>
              </div>
              <div><i class="ti ti-circle-filled text-info" style="font-size:10px"></i></div>
            </div>
          </a>
          <a href="#" class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
            <div class="d-flex justify-content-between">
              <div class="d-flex gap-4 align-items-center">
                <div class="icon-shape icon-md bg-info-subtle text-info-emphasis rounded-circle">
                  <i class="ti ti-user-plus" style="font-size:20px"></i>
                </div>
                <div class="d-flex flex-column gap-1">
                  <div>{{ __('admin.nav.users') }} — +12</div>
                  <small class="text-secondary">{{ __('admin.common.hours_ago', ['hours' => 1]) }}</small>
                </div>
              </div>
              <div><i class="ti ti-circle-filled text-info" style="font-size:10px"></i></div>
            </div>
          </a>
          <a href="#" class="list-group-item list-group-item-action p-5 border-dashed border-bottom">
            <div class="d-flex justify-content-between">
              <div class="d-flex gap-4 align-items-center">
                <div class="icon-shape icon-md bg-danger-subtle text-danger-emphasis rounded-circle">
                  <i class="ti ti-mail" style="font-size:20px"></i>
                </div>
                <div class="d-flex flex-column gap-1">
                  <div>{{ __('admin.nav.contact_msgs') }} — 2</div>
                  <small class="text-secondary">{{ __('admin.common.hours_ago', ['hours' => 2]) }}</small>
                </div>
              </div>
              <div><i class="ti ti-circle-filled text-info" style="font-size:10px"></i></div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="pills-archive" role="tabpanel" aria-labelledby="pills-archive-tab" tabindex="0">
      <div data-simplebar style="height: 800px">
        <div class="list-group list-group-flush text-center py-5 text-secondary">
          {{ __('admin.common.archive') }}
        </div>
      </div>
    </div>
  </div>

  <div class="px-5 py-3 text-center bg-white position-absolute bottom-0 border-top border-dashed w-100">
    <a href="#!" class="text-inherit">{{ __('admin.common.view_all') }}</a>
  </div>
</div>

{{-- Search modal --}}
<div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <input type="search" class="form-control border-0 rounded-0 ps-0 form-focus-none" id="globalSearchInput"
          placeholder="{{ __('admin.common.search') }}" aria-label="{{ __('admin.common.search') }}">
        <button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal" aria-label="Close">Esc</button>
      </div>
      <div class="modal-body pt-0">
        <ul class="list-group list-group-flush">
          <li class="list-group-item px-0">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2 text-inherit py-2">
              <i class="ti ti-layout-dashboard"></i> {{ __('admin.common.dashboard') }}
            </a>
          </li>
          <li class="list-group-item px-0">
            <a href="#!" class="d-flex align-items-center gap-2 text-inherit py-2">
              <i class="ti ti-users"></i> {{ __('admin.nav.users') }}
            </a>
          </li>
          <li class="list-group-item px-0">
            <a href="#!" class="d-flex align-items-center gap-2 text-inherit py-2">
              <i class="ti ti-steering-wheel"></i> {{ __('admin.nav.drivers') }}
            </a>
          </li>
          <li class="list-group-item px-0">
            <a href="#!" class="d-flex align-items-center gap-2 text-inherit py-2">
              <i class="ti ti-help-circle"></i> {{ __('admin.nav.faqs') }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
