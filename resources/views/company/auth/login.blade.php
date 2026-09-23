@extends('company.layouts.auth')

@section('title', __('company.auth.login_title'))

@section('auth_content')
  <div class="auth-card">
    <div class="auth-card__logo-mobile">
      <img src="{{ asset('company/img/logo.svg') }}" alt="T-Car" />
    </div>

    <h1 class="auth-card__title">{{ __('company.auth.login_title') }}</h1>
    <p class="auth-card__subtitle">{{ __('company.auth.login_subtitle') }}</p>

    @if ($errors->any())
      <div class="alert alert-danger py-2 small mb-3">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form id="companyLoginForm" novalidate>
      <div class="auth-field">
        <label class="auth-field__label" for="email">{{ __('company.auth.email') }}</label>
        <div class="auth-field__control">
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="example@t-car.com" autocomplete="username" required />
        </div>
      </div>

      <div class="auth-field">
        <label class="auth-field__label" for="password">{{ __('company.auth.password') }}</label>
        <div class="auth-field__control auth-field__control--icon">
          <input type="password" id="password" name="password" placeholder="••••••••" autocomplete="current-password" required />
          <button type="button" class="auth-field__toggle" id="togglePassword" aria-label="Show password">
            <i class="bi bi-eye"></i>
          </button>
        </div>
      </div>

      <div class="auth-row">
        <label class="auth-remember">
          <input type="checkbox" name="remember" /> {{ __('company.auth.remember') }}
        </label>
      </div>

      <button type="submit" class="auth-submit" id="loginSubmitBtn">
        <i class="bi bi-box-arrow-in-right"></i>
        <span class="auth-submit__label">{{ __('company.auth.login_btn') }}</span>
      </button>
    </form>
  </div>
@endsection

@push('scripts')
  <script>
    window.COMPANY_CONFIG = {
      routes: {
        loginAttempt: '{{ route('company.login.attempt') }}',
        dashboard: '{{ route('company.dashboard') }}',
      },
      messages: {
        loggingIn: @json(__('company.messages.logging_in')),
        error: @json(__('company.messages.error')),
      },
    };
  </script>
  <script>
    (function () {
      const form = document.getElementById('companyLoginForm');
      const submitBtn = document.getElementById('loginSubmitBtn');
      const label = submitBtn.querySelector('.auth-submit__label');
      const toggleBtn = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('password');

      toggleBtn.addEventListener('click', function () {
        const isHidden = passwordInput.type === 'password';
        passwordInput.type = isHidden ? 'text' : 'password';
        toggleBtn.innerHTML = isHidden ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
      });

      form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (!form.checkValidity()) {
          form.reportValidity();
          return;
        }

        label.textContent = window.COMPANY_CONFIG.messages.loggingIn;
        submitBtn.disabled = true;

        const data = new URLSearchParams(new FormData(form));

        fetch(window.COMPANY_CONFIG.routes.loginAttempt, {
          method: 'POST',
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: data,
        })
          .then(function (r) {
            return r.json().then(function (j) {
              return { ok: r.ok, body: j };
            });
          })
          .then(function (res) {
            if (res.ok && res.body.data && res.body.data.redirect) {
              window.location.href = res.body.data.redirect;
              return;
            }
            throw new Error((res.body && res.body.message) || window.COMPANY_CONFIG.messages.error);
          })
          .catch(function (err) {
            label.textContent = window.COMPANY_CONFIG.messages.login_btn;
            submitBtn.disabled = false;
            alert(err.message);
          });
      });
    })();
  </script>
@endpush