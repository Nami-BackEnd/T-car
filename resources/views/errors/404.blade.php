@php
  $locale = in_array(session('admin_locale'), ['ar', 'en'], true) ? session('admin_locale') : config('app.locale');
  app()->setLocale($locale);
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">

<head>
  @include('admin.partials.head')
  <title>{{ __('admin.errors.not_found_title') }} | {{ __('admin.panel_name') }}</title>
</head>

<body>
  <main class="vh-100 d-flex align-items-center justify-content-center">
    <section class="container">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="text-center">
            <div>
              <img src="{{ asset('admin/assets/images/svg/404.svg') }}" alt="404" class="img-fluid" />
            </div>
            <h1 class="display-4">{{ __('admin.errors.not_found_title') }}</h1>
            <p class="mb-6 fs-5">{{ __('admin.errors.not_found_text') }}</p>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg">{{ __('admin.errors.back_home') }}</a>
          </div>
        </div>
      </div>
    </section>

    <div class="position-absolute end-0 bottom-0 m-4">
      <div class="dropdown">
        <button class="btn btn-light btn-icon rounded-circle d-flex align-items-center" type="button"
          aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
          <i class="bi theme-icon-active lh-1"><i class="bi theme-icon bi-sun-fill"></i></i>
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
    </div>
  </main>

  @include('admin.partials.scripts')
</body>

</html>
