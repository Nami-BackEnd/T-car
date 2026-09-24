@extends('admin.layouts.master')

@section('title', $config['entity'] . ' | ' . __('admin.panel_name'))

@php
  $toggles = [
    'daily_booking_showing'         => __('admin.settings.field_daily_booking'),
    'monthly_booking_showing'       => __('admin.settings.field_monthly_booking'),
    'station_booking_showing'       => __('admin.settings.field_station_booking'),
    'airport_booking_showing'       => __('admin.settings.field_airport_booking'),
    'international_booking_showing' => __('admin.settings.field_international_booking'),
    'rewards_screen_showing'        => __('admin.settings.field_rewards_screen'),
  ];
@endphp

@section('content')
  <form action="{{ route($config['routeBase'] . '.update') }}" method="POST" id="settingsForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Booking types visibility --}}
    <div class="card mb-4">
      <div class="card-header border-bottom">
        <h5 class="mb-0 d-flex align-items-center gap-2">
          <i class="ti {{ $config['icon'] }}"></i>
          <span>{{ $config['entity'] }}</span>
        </h5>
      </div>

      <div class="card-body d-flex flex-column gap-4">
        <div>
          <h6 class="mb-1">{{ __('admin.settings.booking_visibility_title') }}</h6>
          <div class="text-secondary small d-flex align-items-center gap-2">
            <i class="ti ti-info-circle"></i>
            <span>{{ __('admin.settings.booking_visibility_hint') }}</span>
          </div>
        </div>

        <div class="row g-3">
          @foreach ($toggles as $field => $label)
            <div class="col-md-4 col-lg-4">
              <label class="form-check form-switch m-0 p-0 d-flex align-items-center justify-content-between gap-2 border rounded p-3">
                <span class="fw-semibold">{{ $label }}</span>
                <input type="hidden" name="{{ $field }}" value="0">
                <input type="checkbox" name="{{ $field }}" value="1" class="form-check-input m-0 flex-shrink-0"
                  @checked(old($field, $setting->{$field}))>
              </label>
              @error($field)
                <div class="invalid-feedback d-block" data-error-for="{{ $field }}">{{ $message }}</div>
              @enderror
            </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Branding --}}
    <div class="card mb-4">
      <div class="card-header border-bottom">
        <h6 class="mb-0 d-flex align-items-center gap-2">
          <i class="ti ti-brand"></i>
          <span>{{ __('admin.settings.branding_title') }}</span>
        </h6>
      </div>

      <div class="card-body">
        <div class="row g-4 align-items-center">
          <div class="col-md-6 col-lg-4">
            <label class="form-label" for="settingLogo">{{ __('admin.settings.field_logo') }}</label>
            <input type="file" name="logo" id="settingLogo" accept=".jpg,.jpeg,.png,.webp,.svg"
              class="form-control @error('logo') is-invalid @enderror">
            @error('logo')
              <div class="invalid-feedback d-block" data-error-for="logo">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-6 col-lg-4">
            <label class="form-label">{{ __('admin.settings.current_logo') }}</label>
            <div class="border rounded d-flex align-items-center justify-content-center p-3 bg-light" style="min-height: 80px;">
              <img id="settingLogoPreview" src="{{ $setting->logo_url ?: asset('admin/assets/images/brand/logo/tcar-logo.svg') }}"
                alt="{{ __('admin.settings.current_logo') }}" style="max-height: 56px; max-width: 160px; object-fit: contain;">
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Cancellation & refund --}}
    <div class="card mb-4">
      <div class="card-header border-bottom">
        <h6 class="mb-0 d-flex align-items-center gap-2">
          <i class="ti ti-calendar-cancel"></i>
          <span>{{ __('admin.settings.cancellation_title') }}</span>
        </h6>
      </div>

      <div class="card-body">
        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <label class="form-label" for="freeCancellationTime">
              {{ __('admin.settings.field_free_cancellation_time') }}
            </label>
            <div class="input-group">
              <input type="number" name="free_cancellation_time" id="freeCancellationTime" min="0" step="1"
                value="{{ old('free_cancellation_time', $setting->free_cancellation_time) }}"
                class="form-control @error('free_cancellation_time') is-invalid @enderror"
                placeholder="0">
              <span class="input-group-text">{{ __('admin.settings.hint_hours') }}</span>
            </div>
            @error('free_cancellation_time')
              <div class="invalid-feedback d-block" data-error-for="free_cancellation_time">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6 col-lg-3">
            <label class="form-label" for="partialCancellationTime">
              {{ __('admin.settings.field_partial_cancellation_time') }}
            </label>
            <div class="input-group">
              <input type="number" name="partial_cancellation_time" id="partialCancellationTime" min="0" step="1"
                value="{{ old('partial_cancellation_time', $setting->partial_cancellation_time) }}"
                class="form-control @error('partial_cancellation_time') is-invalid @enderror"
                placeholder="0">
              <span class="input-group-text">{{ __('admin.settings.hint_hours') }}</span>
            </div>
            @error('partial_cancellation_time')
              <div class="invalid-feedback d-block" data-error-for="partial_cancellation_time">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6 col-lg-3">
            <label class="form-label" for="partialCancellationPercentage">
              {{ __('admin.settings.field_partial_cancellation_percentage') }}
            </label>
            <div class="input-group">
              <input type="number" name="partial_cancellation_percentage" id="partialCancellationPercentage" min="0"
                max="100" step="0.01"
                value="{{ old('partial_cancellation_percentage', $setting->partial_cancellation_percentage) }}"
                class="form-control @error('partial_cancellation_percentage') is-invalid @enderror"
                placeholder="0.00">
              <span class="input-group-text">%</span>
            </div>
            @error('partial_cancellation_percentage')
              <div class="invalid-feedback d-block" data-error-for="partial_cancellation_percentage">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6 col-lg-3">
            <label class="form-label" for="numberDaysOfRefund">
              {{ __('admin.settings.field_number_days_of_refund') }}
            </label>
            <div class="input-group">
              <input type="number" name="number_days_of_refund" id="numberDaysOfRefund" min="0" step="1"
                value="{{ old('number_days_of_refund', $setting->number_days_of_refund) }}"
                class="form-control @error('number_days_of_refund') is-invalid @enderror"
                placeholder="0">
              <span class="input-group-text">{{ __('admin.settings.hint_days') }}</span>
            </div>
            @error('number_days_of_refund')
              <div class="invalid-feedback d-block" data-error-for="number_days_of_refund">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>
    </div>

    {{-- Financial --}}
    <div class="card mb-4">
      <div class="card-header border-bottom">
        <h6 class="mb-0 d-flex align-items-center gap-2">
          <i class="ti ti-cash"></i>
          <span>{{ __('admin.settings.financial_title') }}</span>
        </h6>
      </div>

      <div class="card-body">
        <div class="row g-4">
          <div class="col-md-6 col-lg-4">
            <label class="form-label" for="taxValue">{{ __('admin.settings.field_tax_value') }}</label>
            <div class="input-group">
              <input type="number" name="tax_value" id="taxValue" min="0" max="100" step="0.01"
                value="{{ old('tax_value', $setting->tax_value) }}"
                class="form-control @error('tax_value') is-invalid @enderror"
                placeholder="0.00">
              <span class="input-group-text">%</span>
            </div>
            @error('tax_value')
              <div class="invalid-feedback d-block" data-error-for="tax_value">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6 col-lg-4">
            <label class="form-label" for="riyalToPointsConversion">
              {{ __('admin.settings.field_riyal_to_points') }}
            </label>
            <div class="input-group">
              <input type="number" name="riyal_to_points_conversion" id="riyalToPointsConversion" min="0" step="0.01"
                value="{{ old('riyal_to_points_conversion', $setting->riyal_to_points_conversion) }}"
                class="form-control @error('riyal_to_points_conversion') is-invalid @enderror"
                placeholder="0.00">
              <span class="input-group-text"><i class="ti ti-currency-riyall"></i> → <i class="ti ti-star"></i></span>
            </div>
            @error('riyal_to_points_conversion')
              <div class="invalid-feedback d-block" data-error-for="riyal_to_points_conversion">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6 col-lg-4">
            <label class="form-label" for="driverRewordValue">
              {{ __('admin.settings.field_driver_reword_value') }}
            </label>
            <div class="input-group">
              <input type="number" name="driver_reword_value" id="driverRewordValue" min="0" step="0.01"
                value="{{ old('driver_reword_value', $setting->driver_reword_value) }}"
                class="form-control @error('driver_reword_value') is-invalid @enderror"
                placeholder="0.00">
              <span class="input-group-text"><i class="ti ti-currency-riyall"></i></span>
            </div>
            @error('driver_reword_value')
              <div class="invalid-feedback d-block" data-error-for="driver_reword_value">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <div class="card-footer bg-transparent border-top d-flex flex-wrap justify-content-end gap-2 py-4">
        <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2" id="settingsSaveBtn">
          <i class="ti ti-device-floppy"></i>
          <span>{{ __('admin.content.save') }}</span>
        </button>
      </div>
    </div>
  </form>

  @include('admin.partials.flash')
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('settingsForm');
      const saveBtn = document.getElementById('settingsSaveBtn');
      if (!form || !saveBtn) return;

      const i18n = {
        networkError: @json(__('admin.common.network_error')),
        sessionExpired: @json(__('admin.messages.session_expired')),
        saving: @json(__('admin.common.saving')),
      };

      const logoInput = document.getElementById('settingLogo');
      const logoPreview = document.getElementById('settingLogoPreview');
      if (logoInput && logoPreview) {
        logoInput.addEventListener('change', () => {
          const file = logoInput.files?.[0];
          if (file) logoPreview.src = URL.createObjectURL(file);
        });
      }

      function clearErrors() {
        form.querySelectorAll('[data-error-for]').forEach((el) => { el.textContent = ''; });
        form.querySelectorAll('.is-invalid').forEach((el) => el.classList.remove('is-invalid'));
      }

      function showErrors(errors) {
        Object.entries(errors || {}).forEach(([field, messages]) => {
          const feedback = form.querySelector(`[data-error-for="${field}"]`);
          if (!feedback) return;
          feedback.textContent = Array.isArray(messages) ? messages[0] : String(messages);
          feedback.classList.add('d-block');
          const input = form.querySelector(`[name="${field}"]`);
          if (input) input.classList.add('is-invalid');
        });
      }

      async function requestJson(url, options = {}) {
        const response = await fetch(url, options);
        const payload = await response.json().catch(() => null);
        return { ok: response.ok, status: response.status, payload };
      }

      form.addEventListener('submit', async function (event) {
        event.preventDefault();
        clearErrors();

        const btnLabel = saveBtn.querySelector('span');
        saveBtn.disabled = true;
        btnLabel.textContent = i18n.saving;

        try {
          const { ok, status, payload } = await requestJson(form.action, {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
            body: new FormData(form),
          });

          if (status === 401) {
            if (window.adminToast) window.adminToast(i18n.sessionExpired, 'danger');
            return;
          }
          if (status === 422 && payload?.errors) {
            showErrors(payload.errors);
            if (window.adminToast) window.adminToast(payload?.message || '', 'danger');
            return;
          }
          if (ok && window.adminToast) {
            window.adminToast(payload?.message || 'OK', 'success');
          } else if (!ok && window.adminToast) {
            window.adminToast(payload?.message || i18n.networkError, 'danger');
          }
        } catch (e) {
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        } finally {
          saveBtn.disabled = false;
          btnLabel.textContent = '{{ __('admin.content.save') }}';
        }
      });

      ['input', 'change'].forEach((evt) =>
        form.addEventListener(evt, () => {
          form.querySelectorAll('.is-invalid').forEach((el) => el.classList.remove('is-invalid'));
        })
      );
    });
  </script>
@endpush
