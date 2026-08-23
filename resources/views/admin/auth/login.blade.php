@extends('admin.layouts.auth')

@section('title', __('admin.login.title') . ' | ' . __('admin.panel_name'))

@section('auth_content')
  <main class="login-page">
    <style>
      .login-page {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        position: relative;
      }

      .login-split-row {
        display: flex;
        min-height: 100vh;
      }

      .login-image-side {
        flex: 1 1 60%;
        background-image: url('{{ asset("admin/assets/images/auth/login-illustration.jpeg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
      }

      .login-image-side::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0.35));
      }

      .login-form-side {
        flex: 1 1 40%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 2rem;
      }

      @media (max-width: 991.98px) {
        .login-split-row {
          flex-direction: column;
        }

        .login-image-side {
          min-height: 220px;
        }
      }
    </style>

    <div class="login-split-row">
      {{-- Image side --}}
      <div class="login-image-side d-none d-lg-block" role="img"
        aria-label="{{ __('admin.panel_name') }}"></div>

      {{-- Form side --}}
      <div class="login-form-side">
        <div class="row justify-content-center w-100">
          <div class="col-xl-8 col-lg-10 col-md-9 col-12">
            <div class="text-center mb-6">
              <a href="{{ route('admin.login') }}" class="d-flex align-items-center justify-content-center mb-6">
                <img src="{{ asset('admin/assets/images/brand/logo/tcar-logo.svg') }}" alt="{{ __('admin.panel_name') }}" class="auth-logo-img" />
              </a>
              <h1 class="mb-1">{{ __('admin.login.welcome') }}</h1>
              <p class="mb-0">{{ __('admin.login.subtitle') }}</p>
            </div>

            <div class="card card-lg mb-6">
              <div class="card-body p-6">
                {{-- AJAX error alert --}}
                <div id="loginAlert" class="alert alert-danger alert-dismissible d-none mb-4" role="alert">
                  <span id="loginAlertMessage"></span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <form id="adminLoginForm" method="POST" action="{{ route('admin.login.attempt') }}" novalidate>
                  @csrf
                  <div class="mb-3">
                    <label for="signinEmailInput" class="form-label">
                      {{ __('admin.login.email') }}
                      <span class="text-danger">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                      class="form-control @error('email') is-invalid @enderror" id="signinEmailInput"
                      placeholder="admin@tcar.com" required autofocus autocomplete="username" />
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @else
                      <div class="invalid-feedback">{{ __('admin.validation.email') }}</div>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="signinPasswordInput" class="form-label">
                      {{ __('admin.login.password') }}
                      <span class="text-danger">*</span>
                    </label>
                    <div class="password-field position-relative">
                      <input type="password" name="password" class="form-control fakePassword" id="signinPasswordInput"
                        placeholder="********" required autocomplete="current-password" />
                      <span><i class="ti ti-eye-off passwordToggler"></i></span>
                      <div class="invalid-feedback">{{ __('admin.validation.password') }}</div>
                    </div>
                  </div>

                  <div class="mb-4 d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="rememberMeCheckbox" />
                      <label class="form-check-label" for="rememberMeCheckbox">{{ __('admin.login.remember_me') }}</label>
                    </div>
                  </div>

                  <div class="d-grid">
                    <button class="btn btn-primary" type="submit" id="loginSubmitBtn">
                      <span class="btn-text">{{ __('admin.login.sign_in') }}</span>
                      <span class="btn-loading d-none">
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        {{ __('admin.login.signing_in') }}
                      </span>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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
@endsection

@push('scripts')
  <script src="{{ asset('admin/assets/js/vendors/password.js') }}"></script>
@endpush
