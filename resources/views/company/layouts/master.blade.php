<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'en' ? 'ltr' : 'rtl' }}">
  <head>
    @include('company.partials.head')
    <title>@yield('title', __('company.panel_name'))</title>
  </head>

  <body>
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <div class="app-shell" id="appShell">
      @include('company.partials.sidebar')

      <div class="main-wrapper">
        @include('company.partials.topbar')

        <main class="main-content dashboard-ar @yield('main_class')" id="main-content">
          @yield('content')
        </main>
      </div>
    </div>

    @stack('modals')

    @include('company.partials.scripts')
  </body>
</html>