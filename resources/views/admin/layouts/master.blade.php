<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
  @include('admin.partials.head')
  <title>@yield('title')</title>
</head>

<body data-locale="{{ app()->getLocale() }}">
  <div>
    @include('admin.partials.sidebar')

    {{-- Main Content --}}
    <div id="content" class="position-relative h-100">
      @include('admin.partials.topbar')

      <div class="custom-container">
        @yield('content')
      </div>
    </div>
  </div>

  @include('admin.partials.confirm-modal')

  @include('admin.partials.scripts')
</body>

</html>
