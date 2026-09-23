<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'en' ? 'ltr' : 'rtl' }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', __('company.panel_name'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Alexandria:wght@300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="shortcut icon" href="{{ asset('company/img/fav.svg') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('company/css/style.css') }}?v=63" />
  </head>

  <body>
    <div class="auth-shell">
      <aside class="auth-brand">
        <div class="auth-brand__glow"></div>

        <div class="auth-brand__top">
          <div class="auth-brand__logo">
            <img src="{{ asset('company/img/logo.svg') }}" alt="T-Car" />
          </div>
        </div>

        <div class="auth-brand__art">
          <div class="auth-brand__car-icon">
            <img src="{{ asset('company/img/favW.svg') }}" alt="Car" />
          </div>
        </div>

        <div class="auth-brand__bottom">
          <h2 class="auth-brand__title">{{ __('company.auth.brand_title') }}</h2>
          <p class="auth-brand__subtitle">@yield('brand_subtitle', __('company.auth.brand_subtitle'))</p>
        </div>
      </aside>

      <main class="auth-panel">
        @yield('auth_content')
      </main>
    </div>

    @stack('scripts')
  </body>
</html>