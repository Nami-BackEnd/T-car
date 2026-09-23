{{-- Required meta tags --}}
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="csrf-token" content="{{ csrf_token() }}" />

{{-- Favicon --}}
<link rel="shortcut icon" href="{{ asset('company/img/fav.svg') }}" type="image/x-icon" />
<link rel="icon" type="image/svg+xml" href="{{ asset('company/img/fav.svg') }}" />

{{-- Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Alexandria:wght@300;400;500;600;700;800&display=swap"
  rel="stylesheet"
/>

{{-- Bootstrap Icons --}}
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
/>

{{-- Bootstrap 5 --}}
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
/>

{{-- DataTables (Bootstrap 5 build) --}}
<link
  rel="stylesheet"
  href="https://cdn.datatables.net/1.13.11/css/dataTables.bootstrap5.min.css"
/>

{{-- Custom compiled SCSS --}}
<link rel="stylesheet" href="{{ asset('company/css/style.css') }}?v=63" />

@stack('styles')