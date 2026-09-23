{{-- Shared runtime config + libs --}}
<script>
  window.COMPANY_CONFIG = {
    locale: '{{ app()->getLocale() }}',
    routes: {
      loginAttempt: '{{ route('company.login.attempt') }}',
      langSwitch: '{{ route('company.lang.switch') }}',
      @auth('company')
      logout: '{{ route('company.logout') }}',
      @endauth
      dashboard: '{{ route('company.dashboard') }}',
    },
    messages: {
      sessionExpired: @json(__('company.messages.session_expired')),
      loggingIn: @json(__('company.messages.logging_in')),
      error: @json(__('company.messages.error')),
    },
  };
</script>

{{-- Libs --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.11/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.11/js/dataTables.bootstrap5.min.js"></script>

{{-- Page-specific external libs (apexcharts, leaflet, fancybox, xlsx) --}}
@stack('libs')

{{-- App JS --}}
<script src="{{ asset('company/js/script.js') }}?v=66"></script>

{{-- Language switch integration --}}
<script>
  (function () {
    var langSwitch = document.getElementById('langSwitch');
    if (!langSwitch) return;

    langSwitch.addEventListener('click', function (e) {
      var btn = e.target.closest('button[data-lang]');
      if (!btn) return;

      var lang = btn.getAttribute('data-lang');
      var body = new URLSearchParams({ locale: lang });

      fetch(window.COMPANY_CONFIG.routes.langSwitch, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: body,
      })
        .then(function (r) {
          return r.json();
        })
        .then(function (res) {
          if (res.data && res.data.redirect) {
            window.location.href = res.data.redirect;
          } else {
            window.location.reload();
          }
        })
        .catch(function () {
          window.location.reload();
        });
    });
  })();
</script>

@stack('scripts')

<footer class="app-footer">
  <span>© {{ date('Y') }} {{ __('company.panel_name') }}</span>
</footer>