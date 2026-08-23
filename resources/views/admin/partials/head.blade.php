{{-- Required meta tags --}}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Favicon icons --}}
<link rel="icon" type="image/svg+xml" href="{{ asset('admin/assets/images/brand/logo/tcar-title-logo.svg') }}?v=1">
<link rel="shortcut icon" href="{{ asset('admin/assets/images/brand/logo/tcar-title-logo.svg') }}?v=1">
<link rel="apple-touch-icon" href="{{ asset('admin/assets/images/brand/logo/tcar-title-logo.svg') }}?v=1">
<meta name="theme-color" content="#ffffff">

{{-- Color modes --}}
<script src="{{ asset('admin/assets/js/vendors/color-modes.js') }}"></script>
<script>
  if (localStorage.getItem('sidebarExpanded') === 'false') {
    document.documentElement.classList.add('collapsed');
    document.documentElement.classList.remove('expanded');
  } else {
    document.documentElement.classList.remove('collapsed');
    document.documentElement.classList.add('expanded');
  }
</script>

{{-- Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap">
@if (app()->getLocale() === 'ar')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap">
@endif

{{-- Libs CSS --}}
<link rel="stylesheet" href="{{ asset('admin/libs/simplebar/simplebar.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/libs/tabler-icons/tabler-icons.min.css') }}">

{{-- Theme CSS --}}
@if (app()->getLocale() === 'ar')
<link rel="stylesheet" href="{{ asset('admin/assets/css/theme.rtl.css?v=2') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/admin-rtl.css') }}">
@else
<link rel="stylesheet" href="{{ asset('admin/assets/css/theme.css?v=2') }}">
@endif

{{-- CKEditor dark mode --}}
<link rel="stylesheet" href="{{ asset('admin/assets/css/ckeditor-dark.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/admin.css?v=1') }}">
