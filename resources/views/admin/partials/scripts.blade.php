{{-- URLs + i18n config for admin.js --}}
<script>
  window.ADMIN_CONFIG = {
    locale: '{{ app()->getLocale() }}',
    routes: {
      langSwitch: '{{ route('admin.lang.switch') }}',
      @auth('admin')
      logout: '{{ route('admin.logout') }}',
      @endauth
    },
    messages: {
      sessionExpired: @json(__('admin.messages.session_expired')),
      networkError: @json(__('admin.common.network_error')),
    },
  };
</script>

{{-- Libs JS --}}
<script src="{{ asset('admin/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/libs/simplebar/simplebar.min.js') }}"></script>

{{-- Theme JS --}}
<script src="{{ asset('admin/assets/js/vendors/sidebarnav.js') }}"></script>
<script src="{{ asset('admin/assets/js/main.js') }}"></script>
<script src="{{ asset('admin/assets/js/admin.js?v=5') }}"></script>
<script src="{{ asset('admin/assets/js/admin-confirm.js') }}"></script>

@stack('scripts')

<footer class="text-center py-4">
  <span class="text-secondary small">© {{ date('Y') }} {{ __('admin.panel_name') }}</span>
</footer>
