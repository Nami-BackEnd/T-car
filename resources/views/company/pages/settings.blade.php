@extends('company.layouts.master')

@section('title', __('company.pages.settings.0'))

@section('content')
  @include('company.partials.flash')

  <div class="page-header">
    <div>
      <h1 class="page-header__title">{{ __('company.pages.settings.0') }}</h1>
      <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
        <i class="bi bi-chevron-right"></i>
        <span class="current">{{ __('company.pages.settings.0') }}</span>
      </nav>
    </div>
    <div class="page-header__actions">
      <span class="settings-savemeta">
        <i class="bi bi-check-circle-fill"></i>
        {{ __('company.settings.last_saved', ['time' => $company->updated_at?->diffForHumans() ?? '—']) }}
      </span>
    </div>
  </div>

  <div class="settings-quicknav-wrap">
    <ul class="settings-quicknav" id="settingsQuickNav">
      <li>
        <a href="#sec-company" class="is-active"
          ><i class="bi bi-building"></i> {{ __('company.pages.settings.2') }}</a
        >
      </li>
      <li>
        <a href="#sec-location"><i class="bi bi-geo-alt"></i> {{ __('company.common.242') }}</a>
      </li>
      <li>
        <a href="#sec-logo"><i class="bi bi-image"></i> {{ __('company.pages.settings.3') }}</a>
      </li>
      <li>
        <a href="#sec-cr"><i class="bi bi-file-earmark-text"></i> {{ __('company.pages.settings.26') }}</a>
      </li>
      <li>
        <a href="#sec-tax"><i class="bi bi-receipt"></i> {{ __('company.pages.settings.32') }}</a>
      </li>
      <li>
        <a href="#sec-bank"><i class="bi bi-bank"></i> {{ __('company.common.540') }}</a>
      </li>
      <li>
        <a href="#sec-services"><i class="bi bi-stars"></i> {{ __('company.common.378') }}</a>
      </li>
      <li>
        <a href="#sec-payment"><i class="bi bi-credit-card"></i> {{ __('company.pages.settings.4') }}</a>
      </li>
    </ul>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger d-none" aria-hidden="true"></div>
  @endif

  <form id="settingsForm"
        method="POST"
        action="{{ route('company.settings.update') }}"
        enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="settings-card" id="sec-company">
      <div class="settings-card__header">
        <div class="settings-card__header-main">
          <span class="settings-card__icon"><i class="bi bi-building"></i></span>
          <div>
            <p class="settings-card__title">{{ __('company.pages.settings.2') }}</p>
            <p class="settings-card__desc">{{ __('company.pages.settings.5') }}</p>
          </div>
        </div>
      </div>
      <div class="settings-card__body">
        <div class="form-grid">
          <div class="form-field">
            <label class="form-field__label" for="companyNameAr"
              >{{ __('company.common.135') }}<span class="req">*</span></label
            >
            <input
              type="text"
              class="form-field__input form-field__input--bold"
              id="companyNameAr"
              name="company_name_ar"
              value="{{ old('company_name_ar', $company->company_name_ar) }}"
              required
            />
          </div>

          <div class="form-field">
            <label class="form-field__label" for="companyNameEn"
              >{{ __('company.pages.settings.6') }}<span class="req">*</span></label
            >
            <input
              type="text"
              class="form-field__input form-field__input--bold"
              id="companyNameEn"
              name="company_name_en"
              value="{{ old('company_name_en', $company->company_name_en) }}"
              required
            />
          </div>

          <div class="form-field">
            <label class="form-field__label" for="adminName"
              >{{ __('company.pages.settings.7') }}<span class="req">*</span></label
            >
            <input
              type="text"
              class="form-field__input form-field__input--bold"
              id="adminName"
              name="admin_name"
              value="{{ old('admin_name', $company->admin_name) }}"
              required
            />
          </div>

          <div class="form-field">
            <label class="form-field__label" for="companyEmail"
              >{{ __('company.pages.settings.8') }}<span class="req">*</span></label
            >
            <input
              type="email"
              class="form-field__input form-field__input--bold"
              id="companyEmail"
              name="email"
              value="{{ old('email', $company->email) }}"
              required
            />
          </div>

          <div class="form-field">
            <label class="form-field__label" for="phoneCode"
              >{{ __('company.common.543') }}<span class="req">*</span></label
            >
            <select class="form-field__input" id="phoneCode" name="phone_code" required>
              <option value="">{{ __('company.settings.select_country') }}</option>
              @foreach ($countries as $country)
                <option
                  value="{{ $country->phone_code }}"
                  data-country-id="{{ $country->id }}"
                  @selected(old('phone_code', $company->phone_code) === $country->phone_code)>
                  {{ $country->phone_code }} — {{ $country->localizedTitle() }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-field">
            <label class="form-field__label" for="companyPhone"
              >{{ __('company.common.394') }}<span class="req">*</span></label
            >
            <input
              type="text"
              class="form-field__input form-field__input--mono"
              id="companyPhone"
              name="phone"
              value="{{ old('phone', $company->phone) }}"
              required
            />
          </div>

          <div class="form-field">
            <label class="form-field__label" for="licenseCategory"
              >{{ __('company.pages.settings.11') }}</label
            >
            <input
              type="text"
              class="form-field__input"
              id="licenseCategory"
              name="license_category"
              value="{{ old('license_category', $company->license_category) }}"
              placeholder="{{ __('company.pages.settings.48') }}"
            />
          </div>

          <div class="form-field">
            <label class="form-field__label" for="branchCount"
              >{{ __('company.pages.settings.12') }}<span class="req">*</span></label
            >
            <input
              type="number"
              class="form-field__input form-field__input--mono"
              id="branchCount"
              name="branch_count"
              min="1"
              step="1"
              value="{{ old('branch_count', $company->branch_count ?? 1) }}"
              required
            />
          </div>

          <div class="form-field">
            <label class="form-field__label" for="lateHours"
              >{{ __('company.pages.settings.13') }}<span class="req">*</span></label
            >
            <input
              type="number"
              class="form-field__input form-field__input--mono"
              id="lateHours"
              name="max_late_hours_allowed"
              min="0"
              step="1"
              value="{{ old('max_late_hours_allowed', $company->max_late_hours_allowed ?? 0) }}"
              required
            />
          </div>

          <div class="form-field">
            <label class="form-field__label" for="insurancePolicy"
              >{{ __('company.pages.settings.14') }}<span class="req">*</span></label
            >
            <select class="form-field__input" id="insurancePolicy" name="insurance_policy_type" required>
              @foreach (['comprehensive', 'deductible'] as $type)
                <option
                  value="{{ $type }}"
                  @selected(old('insurance_policy_type', $company->insurance_policy_type) === $type)>
                  {{ $type === 'comprehensive' ? __('company.pages.settings.15') : __('company.pages.settings.16') }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-field insurance-deductible-field" id="insuranceDeductibleField" hidden>
            <label class="form-field__label" for="insuranceDeductible"
              >{{ __('company.pages.settings.17') }}<span class="req">*</span></label
            >
            <input
              type="number"
              class="form-field__input form-field__input--mono"
              id="insuranceDeductible"
              name="insurance_policy_value"
              min="0"
              max="100"
              step="0.01"
              value="{{ old('insurance_policy_value', $company->insurance_policy_value) }}"
              placeholder="{{ __('company.pages.settings.49') }}"
            />
          </div>

          <div class="form-field form-grid--full">
            <label class="form-field__label" for="scopeCitiesSearch"
              >{{ __('company.pages.settings.9') }}<span class="req">*</span></label
            >
            <input
              type="search"
              class="form-field__input"
              id="scopeCitiesSearch"
              placeholder="{{ __('company.settings.search') }}"
              autocomplete="off" />
            <select
              class="form-field__input"
              id="scopeCities"
              name="cities[]"
              multiple
              size="6"
              required>
              @foreach ($cities as $city)
                <option
                  value="{{ $city->id }}"
                  data-country-id="{{ $city->country_id }}"
                  data-search="{{ $city->title_ar }} {{ $city->title_en }} {{ $city->country?->title_ar }} {{ $city->country?->title_en }}"
                  @selected(in_array($city->id, old('cities', $scopeCityIds)))>
                  {{ $city->localizedTitle() }}{{ $city->country ? ' — ' . $city->country->localizedTitle() : '' }}
                </option>
              @endforeach
            </select>
            <small class="form-field__hint">{{ __('company.settings.scope_hint') }}</small>
          </div>
        </div>
      </div>
    </div>

    <div class="settings-card" id="sec-location">
      <div class="settings-card__header">
        <div class="settings-card__header-main">
          <span class="settings-card__icon"><i class="bi bi-geo-alt"></i></span>
          <div>
            <p class="settings-card__title">{{ __('company.common.242') }}</p>
            <p class="settings-card__desc">{{ __('company.pages.settings.18') }}</p>
          </div>
        </div>
      </div>
      <div class="settings-card__body">
        <div class="form-grid" style="margin-bottom: 18px">
          <div class="form-field form-grid--full">
            <label class="form-field__label" for="addressInput"
              >{{ __('company.common.217') }}<span class="req">*</span></label
            >
            <input
              type="text"
              id="addressInput"
              class="form-field__input"
              name="address"
              value="{{ old('address', $company->address) }}"
              required
            />
          </div>

          <div class="form-field">
            <label class="form-field__label" for="citySelect"
              >{{ __('company.common.229') }}<span class="req">*</span></label
            >
            <select class="form-field__input" id="citySelect" name="city_id" required>
              <option value="">{{ __('company.settings.select_city') }}</option>
              @foreach ($cities as $city)
                <option
                  value="{{ $city->id }}"
                  data-country-id="{{ $city->country_id }}"
                  data-latitude="{{ $city->latitude }}"
                  data-longitude="{{ $city->longitude }}"
                  @selected((int) old('city_id', $company->city_id) === $city->id)>
                  {{ $city->localizedTitle() }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-field">
            <label class="form-field__label" for="countrySelect"
              >{{ __('company.pages.settings.19') }}<span class="req">*</span></label
            >
            <select class="form-field__input" id="countrySelect" name="country_id" required>
              <option value="">{{ __('company.settings.select_country') }}</option>
              @foreach ($countries as $country)
                <option value="{{ $country->id }}" @selected((int) old('country_id', $company->country_id) === $country->id)>
                  {{ $country->localizedTitle() }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude', $company->latitude) }}" />
        <input
          type="hidden"
          id="longitude"
          name="longitude"
          value="{{ old('longitude', $company->longitude) }}" />

        <div class="map-wrapper">
          <iframe
            id="companyMapFrame"
            src="https://maps.google.com/maps?q={{ $company->latitude && $company->longitude ? $company->latitude . ',' . $company->longitude : '24.72,46.7' }}&z=15&output=embed"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="{{ __('company.pages.settings.50') }}"></iframe>
        </div>
        <div class="map-actions">
          <div class="map-search">
            <i class="bi bi-search" id="mapSearchIcon"></i>
            <input
              type="text"
              id="mapSearchInput"
              placeholder="{{ __('company.pages.settings.51') }}" />
          </div>
          <button type="button" class="map-locate-btn" id="mapLocateBtn">
            <i class="bi bi-crosshair"></i> {{ __('company.pages.settings.20') }}</button>
        </div>
      </div>
    </div>

    <div class="settings-card" id="sec-logo">
      <div class="settings-card__header">
        <div class="settings-card__header-main">
          <span class="settings-card__icon"><i class="bi bi-image"></i></span>
          <div>
            <p class="settings-card__title">{{ __('company.pages.settings.21') }}</p>
            <p class="settings-card__desc">{{ __('company.pages.settings.22') }}</p>
          </div>
        </div>
      </div>
      <div class="settings-card__body">
        <label class="dropzone" for="logoUpload" id="logoDropzone">
          <span class="dropzone__preview" id="logoPreview">
            @if ($company->logoUrl())
              <img src="{{ $company->logoUrl() }}" alt="" />
            @else
              <i class="bi bi-image"></i>
            @endif
          </span>
          <span class="dropzone__text">
            <p class="dropzone__title">{{ __('company.pages.settings.23') }}</p>
            <p class="dropzone__sub" id="logoFileName">
              {{ $company->logo ? basename($company->logo) : __('company.pages.settings.24') }}
            </p>
          </span>
          <span class="dropzone__btn"
            ><i class="bi bi-cloud-arrow-up"></i> {{ __('company.common.125') }}</span
          >
          <input type="file" id="logoUpload" name="logo" accept="image/png, image/jpeg, image/webp" hidden />
        </label>
        <input type="hidden" name="remove_logo" id="removeLogoFlag" value="0" />
        <button
          type="button"
          class="dropzone__remove"
          id="logoRemoveBtn"
          style="display: {{ $company->logo ? 'inline-flex' : 'none' }}">
          <i class="bi bi-trash3"></i> {{ __('company.settings.remove_logo') }}</button>
      </div>
    </div>

    <div class="settings-card" id="sec-cr">
      <div class="settings-card__header">
        <div class="settings-card__header-main">
          <span class="settings-card__icon"><i class="bi bi-file-earmark-text"></i></span>
          <div>
            <p class="settings-card__title">{{ __('company.pages.settings.26') }}</p>
            <p class="settings-card__desc">{{ __('company.pages.settings.27') }}</p>
          </div>
        </div>
        <span class="verified-pill"
          ><i class="bi bi-patch-check-fill"></i> {{ __('company.pages.settings.28') }}</span
        >
      </div>
      <div class="settings-card__body">
        <div class="form-grid" style="margin-bottom: 18px">
          <div class="form-field form-grid--full" style="max-width: 340px">
            <label class="form-field__label" for="commercialRecord"
              >{{ __('company.pages.settings.29') }}<span class="req">*</span></label
            >
            <input
              type="text"
              class="form-field__input form-field__input--bold form-field__input--mono"
              id="commercialRecord"
              name="commercial_record"
              value="{{ old('commercial_record', $company->commercial_record) }}"
              required
            />
          </div>
        </div>
        <label class="dropzone" for="crUpload" id="crDropzone">
          <span class="dropzone__preview" id="crPreview">
            @if ($company->commercialImageUrl())
              <img src="{{ $company->commercialImageUrl() }}" alt="" />
            @else
              <i class="bi bi-file-earmark-pdf"></i>
            @endif
          </span>
          <span class="dropzone__text">
            <p class="dropzone__title">{{ __('company.pages.settings.30') }}</p>
            <p class="dropzone__sub" id="crFileName">
              {{ $company->commercial_image ? basename($company->commercial_image) : __('company.settings.no_file') }}
            </p>
          </span>
          <span class="dropzone__btn"
            ><i class="bi bi-cloud-arrow-up"></i> {{ __('company.pages.settings.31') }}</span
          >
          <input type="file" id="crUpload" name="commercial_image" accept="application/pdf, image/*" hidden />
        </label>
        <input type="hidden" name="remove_commercial_image" id="removeCrFlag" value="0" />
      </div>
    </div>

    <div class="settings-card" id="sec-tax">
      <div class="settings-card__header">
        <div class="settings-card__header-main">
          <span class="settings-card__icon"><i class="bi bi-receipt"></i></span>
          <div>
            <p class="settings-card__title">{{ __('company.pages.settings.32') }}</p>
            <p class="settings-card__desc">{{ __('company.pages.settings.27') }}</p>
          </div>
        </div>
        <span class="verified-pill"
          ><i class="bi bi-patch-check-fill"></i> {{ __('company.pages.settings.28') }}</span
        >
      </div>
      <div class="settings-card__body">
        <div class="form-grid" style="margin-bottom: 18px">
          <div class="form-field form-grid--full" style="max-width: 340px">
            <label class="form-field__label" for="taxNumber"
              >{{ __('company.pages.settings.32') }}<span class="req">*</span></label
            >
            <input
              type="text"
              class="form-field__input form-field__input--bold form-field__input--mono"
              id="taxNumber"
              name="tax_number"
              value="{{ old('tax_number', $company->tax_number) }}"
              required
            />
          </div>
        </div>
        <label class="dropzone" for="taxUpload" id="taxDropzone">
          <span class="dropzone__preview" id="taxPreview">
            @if ($company->taxImageUrl())
              <img src="{{ $company->taxImageUrl() }}" alt="" />
            @else
              <i class="bi bi-file-earmark-pdf"></i>
            @endif
          </span>
          <span class="dropzone__text">
            <p class="dropzone__title">{{ __('company.pages.settings.33') }}</p>
            <p class="dropzone__sub" id="taxFileName">
              {{ $company->tax_image ? basename($company->tax_image) : __('company.settings.no_file') }}
            </p>
          </span>
          <span class="dropzone__btn"
            ><i class="bi bi-cloud-arrow-up"></i> {{ __('company.pages.settings.31') }}</span
          >
          <input type="file" id="taxUpload" name="tax_image" accept="application/pdf, image/*" hidden />
        </label>
        <input type="hidden" name="remove_tax_image" id="removeTaxFlag" value="0" />
      </div>
    </div>

    <div class="settings-card" id="sec-bank">
      <div class="settings-card__header">
        <div class="settings-card__header-main">
          <span class="settings-card__icon"><i class="bi bi-bank"></i></span>
          <div>
            <p class="settings-card__title">{{ __('company.common.540') }}</p>
            <p class="settings-card__desc">{{ __('company.pages.settings.34') }}</p>
          </div>
        </div>
      </div>
      <div class="settings-card__body">
        <div class="form-grid">
          <div class="form-field">
            <label class="form-field__label" for="accountOwner"
              >{{ __('company.pages.settings.35') }}<span class="req">*</span></label
            >
            <input
              type="text"
              class="form-field__input form-field__input--bold"
              id="accountOwner"
              name="account_owner_name"
              value="{{ old('account_owner_name', $bank?->account_owner_name) }}"
              required
            />
          </div>

          <div class="form-field">
            <label class="form-field__label" for="bankSelect"
              >{{ __('company.common.132') }}<span class="req">*</span></label
            >
            <input
              type="text"
              class="form-field__input form-field__input--bold"
              id="bankSelect"
              name="bank_name"
              list="bankOptions"
              value="{{ old('bank_name', $bank?->bank_name) }}"
              required
            />
            <datalist id="bankOptions">
              @foreach ($banks as $bankOption)
                <option value="{{ $bankOption->title_en }}">{{ $bankOption->title_ar }}</option>
              @endforeach
            </datalist>
          </div>

          <div class="form-field mask-field">
            <label class="form-field__label" for="ibanNumber"
              >{{ __('company.pages.settings.36') }}<span class="req">*</span></label
            >
            <input
              type="password"
              class="form-field__input form-field__input--mono"
              id="ibanNumber"
              name="iban_number"
              value="{{ old('iban_number', $bank?->iban_number) }}"
              required
            />
            <button
              type="button"
              class="mask-toggle"
              data-mask-toggle
              aria-controls="ibanNumber"
              title="{{ __('company.common.90') }}">
              <i class="bi bi-eye"></i>
            </button>
          </div>

          <div class="form-field mask-field">
            <label class="form-field__label" for="accountNumber"
              >{{ __('company.pages.settings.37') }}<span class="req">*</span></label
            >
            <input
              type="password"
              class="form-field__input form-field__input--mono"
              id="accountNumber"
              name="account_number"
              value="{{ old('account_number', $bank?->account_number) }}"
              required
            />
            <button
              type="button"
              class="mask-toggle"
              data-mask-toggle
              aria-controls="accountNumber"
              title="{{ __('company.common.90') }}">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="settings-card" id="sec-services">
      <div class="settings-card__header">
        <div class="settings-card__header-main">
          <span class="settings-card__icon"><i class="bi bi-stars"></i></span>
          <div>
            <p class="settings-card__title">{{ __('company.common.378') }}</p>
            <p class="settings-card__desc">{{ __('company.pages.settings.38') }}</p>
          </div>
        </div>
      </div>
      <div class="settings-card__body">
        @forelse ($additionalServices as $service)
          @php($setting = $serviceSettings->get($service->id))
          <div class="service-item js-service @if (! $setting) is-off @endif" data-service>
            <input type="hidden" name="services[{{ $service->id }}][id]" value="{{ $service->id }}" data-service-id @disabled(! $setting) />

            <div class="service-item__header">
              <div class="service-item__header-main">
                <span class="service-item__icon"
                  ><i class="bi {{ $service->icon ?: 'bi-check2-square' }}"></i></span
                >
                <span class="service-item__title">{{ $service->localizedTitle() }}</span>
              </div>
              <div class="toggle-switch">
                <input
                  type="checkbox"
                  id="service-{{ $service->id }}"
                  class="toggle-switch__input"
                  data-service-toggle
                  @checked((bool) $setting) />
                <label for="service-{{ $service->id }}" class="toggle-switch__label">
                  <span class="toggle-switch__slider"></span>
                </label>
              </div>
            </div>

            <div class="service-item__body">
              <div class="segmented" data-billing-group>
                <input
                  type="radio"
                  name="services[{{ $service->id }}][pricing_type]"
                  id="service-{{ $service->id }}-free"
                  value="free"
                  @checked(old("services.{$service->id}.pricing_type", $setting?->pricing_type ?? 'payed') === 'free') />
                <label for="service-{{ $service->id }}-free">{{ __('company.settings.services.free') }}</label>
                <input
                  type="radio"
                  name="services[{{ $service->id }}][pricing_type]"
                  id="service-{{ $service->id }}-paid"
                  value="payed"
                  @checked(old("services.{$service->id}.pricing_type", $setting?->pricing_type ?? 'payed') === 'payed') />
                <label for="service-{{ $service->id }}-paid">{{ __('company.settings.services.paid') }}</label>
              </div>
              <div class="form-field">
                <label class="form-field__label" for="service-{{ $service->id }}-price"
                  >{{ __('company.settings.services.price') }}<span class="req">*</span></label
                >
                <div class="price-field">
                  <input
                    type="number"
                    class="price-field__input"
                    id="service-{{ $service->id }}-price"
                    name="services[{{ $service->id }}][price]"
                    min="0"
                    step="0.01"
                    value="{{ old("services.{$service->id}.price", $setting?->price) }}" />
                  <span class="price-field__suffix">{{ __('company.common.406') }}</span>
                </div>
              </div>
            </div>
          </div>
        @empty
          <p class="form-field__hint">{{ __('company.cars.empty_options') }}</p>
        @endforelse
      </div>
    </div>

    <div class="settings-card" id="sec-payment">
      <div class="settings-card__header">
        <div class="settings-card__header-main">
          <span class="settings-card__icon"><i class="bi bi-credit-card"></i></span>
          <div>
            <p class="settings-card__title">{{ __('company.pages.settings.4') }}</p>
            <p class="settings-card__desc">{{ __('company.pages.settings.44') }}</p>
          </div>
        </div>
      </div>
      <div class="settings-card__body">
        @forelse ($paymentMethods as $method)
          <div class="toggle-row">
            <span class="toggle-row__label">
              <span class="toggle-row__icon"><i class="bi {{ $method->icon ?: 'bi-credit-card' }}"></i></span>
              {{ $method->localizedTitle() }}
            </span>
            <div class="toggle-switch">
              <input
                type="checkbox"
                id="payment-{{ $method->id }}"
                class="toggle-switch__input"
                name="payment_methods[]"
                value="{{ $method->id }}"
                @checked(in_array($method->id, old('payment_methods', $selectedPaymentMethodIds))) />
              <label for="payment-{{ $method->id }}" class="toggle-switch__label">
                <span class="toggle-switch__slider"></span>
              </label>
            </div>
          </div>
        @empty
          <p class="form-field__hint">{{ __('company.cars.empty_options') }}</p>
        @endforelse
      </div>
    </div>

    <div class="settings-savebar">
      <span class="settings-savebar__msg" id="savebarMsg" style="visibility: hidden">
        <i class="bi bi-exclamation-circle-fill"></i> {{ __('company.pages.settings.47') }}</span>
      <div class="settings-savebar__actions">
        <button class="btn btn-outline" type="reset" id="cancelBtn">{{ __('company.settings.undo') }}</button>
        <button class="btn btn-primary" type="submit" id="saveBtn">
          <i class="bi bi-check2-circle"></i>
          {{ __('company.common.376') }}</button>
      </div>
    </div>
  </form>
@endsection

@push('libs')
  <script>
    window.SETTINGS_I18N = {{ Illuminate\Support\Js::from([
      'noFile' => __('company.settings.no_file'),
      'geolocationUnsupported' => __('company.settings.geolocation_unsupported'),
      'geolocationDenied' => __('company.settings.geolocation_denied'),
      'geolocationUnavailable' => __('company.settings.geolocation_unavailable'),
      'geolocationTimeout' => __('company.settings.geolocation_timeout'),
      'geolocationFailed' => __('company.settings.geolocation_failed'),
      'locating' => __('company.settings.locating'),
      'locateLabel' => __('company.pages.settings.20'),
      'locateIcon' => 'bi-crosshair',
    ]) }};
  </script>
@endpush

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const i18n = window.SETTINGS_I18N || {};
      const form = document.getElementById('settingsForm');
      const savebarMsg = document.getElementById('savebarMsg');
      const saveBtn = document.getElementById('saveBtn');

      const markDirty = () => {
        if (savebarMsg) savebarMsg.style.visibility = 'visible';
      };

      form.addEventListener('input', markDirty, true);
      form.addEventListener('change', markDirty, true);

      /* ---- Reset button: drop unsaved changes, restore server state ---- */
      const cancelBtn = document.getElementById('cancelBtn');
      if (cancelBtn) {
        cancelBtn.addEventListener('click', function () {
          form.reset();
          form.dispatchEvent(new Event('change', { bubbles: true }));
          syncServiceToggles();
          syncInsuranceDeductible();
          syncScopeCities();
          if (savebarMsg) savebarMsg.style.visibility = 'hidden';
        });
      }

      /* ---- Submit: real navigation, no preventDefault ---- */
      form.addEventListener('submit', function () {
        if (savebarMsg) savebarMsg.style.visibility = 'hidden';
        if (saveBtn) saveBtn.disabled = true;
      });

      /* ================= Quick nav: smooth scroll + scrollspy ================= */
      const navLinks = Array.from(document.querySelectorAll('#settingsQuickNav a'));
      const sections = navLinks
        .map((link) => document.querySelector(link.getAttribute('href')))
        .filter(Boolean);

      navLinks.forEach((link) => {
        link.addEventListener('click', function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (!target) return;
          const y = target.getBoundingClientRect().top + window.pageYOffset - 84;
          window.scrollTo({ top: y, behavior: 'smooth' });
        });
      });

      function updateActiveNav() {
        let currentIndex = 0;
        sections.forEach((section, index) => {
          if (section.getBoundingClientRect().top - 100 <= 0) currentIndex = index;
        });
        navLinks.forEach((link, index) => link.classList.toggle('is-active', index === currentIndex));
      }

      window.addEventListener('scroll', updateActiveNav, { passive: true });
      updateActiveNav();

      /* ================= Insurance deductible ================= */
      const insurancePolicy = document.getElementById('insurancePolicy');
      const insuranceField = document.getElementById('insuranceDeductibleField');
      const insuranceInput = document.getElementById('insuranceDeductible');

      function syncInsuranceDeductible() {
        const isDeductible = insurancePolicy.value === 'deductible';
        insuranceField.hidden = !isDeductible;
        insuranceInput.disabled = !isDeductible;
        insuranceInput.required = isDeductible;
        if (!isDeductible) insuranceInput.value = '';
      }

      insurancePolicy.addEventListener('change', syncInsuranceDeductible);
      syncInsuranceDeductible();

      /* ================= Services: toggle + free/paid ================= */
      function syncServiceToggles() {
        document.querySelectorAll('[data-service-toggle]').forEach((toggle) => {
          const item = toggle.closest('.js-service');
          item.classList.toggle('is-off', !toggle.checked);

          const freeRadio = item.querySelector('input[value="free"]');
          const paidRadio = item.querySelector('input[value="payed"]');
          const priceInput = item.querySelector('.price-field__input');
          const idInput = item.querySelector('[data-service-id]');

          freeRadio.disabled = !toggle.checked;
          paidRadio.disabled = !toggle.checked;
          priceInput.disabled = !toggle.checked || paidRadio.checked === false;
          if (idInput) {
            idInput.disabled = !toggle.checked;
          }

          if (!toggle.checked) {
            freeRadio.checked = true;
            paidRadio.checked = false;
          }
        });
      }

      document.querySelectorAll('[data-service-toggle]').forEach((toggle) => {
        toggle.addEventListener('change', syncServiceToggles);
      });

      document.querySelectorAll('[data-billing-group]').forEach((group) => {
        group.addEventListener('change', function (e) {
          if (e.target.value !== 'payed') return;
          const item = this.closest('.js-service');
          const priceInput = item.querySelector('.price-field__input');
          priceInput.disabled = false;
        });
      });

      syncServiceToggles();

      /* ================= Masked bank fields ================= */
      document.querySelectorAll('[data-mask-toggle]').forEach((btn) => {
        btn.addEventListener('click', function () {
          const input = document.getElementById(this.getAttribute('aria-controls'));
          const icon = this.querySelector('i');
          const reveal = input.type === 'password';

          input.type = reveal ? 'text' : 'password';
          icon.className = reveal ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
      });

      /* ================= Dropzones ================= */
      function wireDropzone(config) {
        const { zoneId, inputId, previewId, fileNameId, removeBtnId, removeFlagId, icon } = config;
        const zone = document.getElementById(zoneId);
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        const fileName = document.getElementById(fileNameId);
        const removeBtn = removeBtnId ? document.getElementById(removeBtnId) : null;
        const removeFlag = removeFlagId ? document.getElementById(removeFlagId) : null;

        function showImage(src) {
          preview.innerHTML = '';
          const img = document.createElement('img');
          img.src = src;
          img.alt = '';
          preview.appendChild(img);
        }

        function showPlaceholder() {
          preview.innerHTML = '';
          const glyph = document.createElement('i');
          glyph.className = icon;
          preview.appendChild(glyph);
        }

        function accept(file) {
          if (!file) return;
          if (removeFlag) removeFlag.value = '0';
          fileName.textContent = file.name;
          if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => showImage(e.target.result);
            reader.readAsDataURL(file);
          } else {
            showPlaceholder();
          }
          if (removeBtn) removeBtn.style.display = 'inline-flex';
          markDirty();
        }

        input.addEventListener('change', function () {
          accept(this.files[0]);
        });

        ['dragover', 'dragleave', 'drop'].forEach((evt) => {
          zone.addEventListener(evt, function (e) {
            e.preventDefault();
            this.classList.toggle('is-dragover', evt === 'dragover');
            if (evt === 'drop' && e.dataTransfer.files.length) {
              input.files = e.dataTransfer.files;
              accept(e.dataTransfer.files[0]);
            }
          });
        });

        if (removeBtn) {
          removeBtn.addEventListener('click', function (e) {
            e.preventDefault();
            input.value = '';
            if (removeFlag) removeFlag.value = '1';
            showPlaceholder();
            fileName.textContent = i18n.noFile;
            this.style.display = 'none';
            markDirty();
          });
        }
      }

      wireDropzone({
        zoneId: 'logoDropzone',
        inputId: 'logoUpload',
        previewId: 'logoPreview',
        fileNameId: 'logoFileName',
        removeBtnId: 'logoRemoveBtn',
        removeFlagId: 'removeLogoFlag',
        icon: 'bi-image',
      });

      wireDropzone({
        zoneId: 'crDropzone',
        inputId: 'crUpload',
        previewId: 'crPreview',
        fileNameId: 'crFileName',
        removeFlagId: 'removeCrFlag',
        icon: 'bi-file-earmark-pdf',
      });

      wireDropzone({
        zoneId: 'taxDropzone',
        inputId: 'taxUpload',
        previewId: 'taxPreview',
        fileNameId: 'taxFileName',
        removeFlagId: 'removeTaxFlag',
        icon: 'bi-file-earmark-pdf',
      });

      /* ================= Country <-> area code / city filtering ================= */
      const countrySelect = document.getElementById('countrySelect');
      const phoneCodeSelect = document.getElementById('phoneCode');
      const citySelect = document.getElementById('citySelect');
      const scopeCities = document.getElementById('scopeCities');

      function filterCitiesByCountry(select, countryId) {
        Array.from(select.options).forEach((option) => {
          if (!option.value) return;
          const matches = !countryId || option.dataset.countryId === String(countryId);
          option.hidden = !matches;
          option.disabled = !matches;
        });
      }

      const scopeSearch = document.getElementById('scopeCitiesSearch');

      function filterScopeCities() {
        const term = (scopeSearch.value || '').trim().toLowerCase();
        const countryId = countrySelect.value;

        Array.from(scopeCities.options).forEach((option) => {
          if (!option.value) return;

          const matchesCountry = !countryId || option.dataset.countryId === String(countryId);
          const matchesTerm = !term || option.dataset.search.toLowerCase().includes(term);

          option.hidden = !(matchesCountry && matchesTerm);
          option.disabled = !(matchesCountry && matchesTerm);
        });
      }

      if (scopeSearch) {
        scopeSearch.addEventListener('input', filterScopeCities);
      }

      function syncScopeCities() {
        filterScopeCities();
      }

      countrySelect.addEventListener('change', function () {
        const countryId = this.value;
        filterCitiesByCountry(citySelect, countryId);
        syncScopeCities();

        const match = phoneCodeSelect.querySelector('option[data-country-id="' + countryId + '"]');
        if (match) phoneCodeSelect.value = match.value;
      });

      citySelect.addEventListener('change', function () {
        const option = this.options[this.selectedIndex];
        if (!option || !option.dataset.latitude) return;

        latitudeInput.value = option.dataset.latitude;
        longitudeInput.value = option.dataset.longitude;
        updateMapSrc(option.dataset.latitude + ',' + option.dataset.longitude);
      });

      syncScopeCities();

      /* ================= Map: search + geolocation ================= */
      const mapFrame = document.getElementById('companyMapFrame');
      const mapSearchInput = document.getElementById('mapSearchInput');
      const mapSearchIcon = document.getElementById('mapSearchIcon');
      const locateBtn = document.getElementById('mapLocateBtn');
      const latitudeInput = document.getElementById('latitude');
      const longitudeInput = document.getElementById('longitude');

      function updateMapSrc(query) {
        if (!mapFrame) return;
        mapFrame.src =
          'https://maps.google.com/maps?q=' + encodeURIComponent(query) + '&z=15&output=embed';
      }

      function setCoords(lat, lng) {
        latitudeInput.value = Number(lat).toFixed(7);
        longitudeInput.value = Number(lng).toFixed(7);
      }

      function runMapSearch() {
        const value = mapSearchInput.value.trim();
        if (!value) return;
        updateMapSrc(value);
        markDirty();
      }

      if (mapSearchInput) {
        mapSearchInput.addEventListener('keydown', function (e) {
          if (e.key !== 'Enter') return;
          e.preventDefault();
          runMapSearch();
        });
      }

      if (mapSearchIcon) {
        mapSearchIcon.style.cursor = 'pointer';
        mapSearchIcon.addEventListener('click', runMapSearch);
      }

      if (locateBtn) {
        locateBtn.addEventListener('click', function () {
          if (!navigator.geolocation) {
            alert(i18n.geolocationUnsupported);
            return;
          }

          const originalHTML = this.innerHTML;
          this.disabled = true;
          this.innerHTML = '<i class="bi bi-hourglass-split"></i> ' + i18n.locating;

          navigator.geolocation.getCurrentPosition(
            function (pos) {
              const { latitude, longitude } = pos.coords;
              setCoords(latitude, longitude);
              updateMapSrc(latitude + ',' + longitude);
              mapSearchInput.value = latitude.toFixed(6) + ', ' + longitude.toFixed(6);
              locateBtn.disabled = false;
              locateBtn.innerHTML = originalHTML;
              markDirty();
            },
            function (err) {
              const messages = {
                1: i18n.geolocationDenied,
                2: i18n.geolocationUnavailable,
                3: i18n.geolocationTimeout,
              };
              alert(messages[err.code] || i18n.geolocationFailed);
              locateBtn.disabled = false;
              locateBtn.innerHTML = originalHTML;
            },
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 },
          );
        });
      }
    });
  </script>
@endpush
