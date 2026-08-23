<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
  @include('admin.partials.head')
  <title>@yield('title', __('admin.panel_name'))</title>
</head>

<body data-locale="{{ app()->getLocale() }}">
  @yield('auth_content')

  @include('admin.partials.scripts')
</body>

</html>
