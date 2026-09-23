@extends('company.layouts.master')

@section('title', 'T-Car — إعدادات الشركة')

@section('content')

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
              <span class="settings-savemeta"
                ><i class="bi bi-check-circle-fill"></i> {{ __('company.pages.settings.1') }}</span
              >
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

          <form id="settingsForm">
            
            <div class="settings-card" id="sec-company">
              <div class="settings-card__header">
                <div class="settings-card__header-main">
                  <span class="settings-card__icon"><i class="bi bi-building"></i></span>
                  <div>
                    <p class="settings-card__title">{{ __('company.pages.settings.2') }}</p>
                    <p class="settings-card__desc">
                      {{ __('company.pages.settings.5') }}</p>
                  </div>
                </div>
              </div>
              <div class="settings-card__body">
                <div class="form-grid">
                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.135') }}<span class="req">*</span></label>
                    <input
                      type="text"
                      class="form-field__input form-field__input--bold"
                      value="N2"
                    />
                  </div>

                  <div class="form-field">
                    <label class="form-field__label"
                      >{{ __('company.pages.settings.6') }}<span class="req">*</span></label
                    >
                    <input
                      type="text"
                      class="form-field__input form-field__input--bold"
                      value="N2"
                    />
                  </div>

                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.pages.settings.7') }}<span class="req">*</span></label>
                    <input
                      type="text"
                      class="form-field__input form-field__input--bold"
                      value="محمد الشافعي"
                    />
                  </div>

                  <div class="form-field">
                    <label class="form-field__label">
                      {{ __('company.pages.settings.8') }}<span class="req">*</span></label
                    >
                    <input
                      type="text"
                      class="form-field__input form-field__input--bold"
                      value="mohamed@example.com"
                    />
                  </div>

                  <div class="form-field">
                    <label class="form-field__label"
                      >{{ __('company.common.543') }}<span class="req">*</span></label
                    >
                    <div class="dropdown">
                      <button
                        type="button"
                        class="form-field__input dropdown-toggle"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        id="areaCodeBtn"
                      >
                        +966 <i class="bi bi-chevron-down"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <div class="dropdown-search">
                            <i class="bi bi-search"></i>
                            <input type="search"  placeholder="{{ __('company.common.264') }}" />
                          </div>
                        </li>
                        <li>
                          <a class="dropdown-item" href="#" data-code="+966">{{ __('company.common.5') }}</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="#" data-code="+971">{{ __('company.common.7') }}</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="#" data-code="+965">{{ __('company.common.4') }}</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="#" data-code="+974">{{ __('company.common.9') }}</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="#" data-code="+973">{{ __('company.common.8') }}</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="#" data-code="+968">{{ __('company.common.6') }}</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="#" data-code="+20">{{ __('company.common.1') }}</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="#" data-code="+962">{{ __('company.common.3') }}</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="#" data-code="+961">{{ __('company.common.2') }}</a>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div class="form-field form-grid--full">
                    <label class="form-field__label">{{ __('company.common.394') }}<span class="req">*</span></label>
                    <input
                      type="text"
                      class="form-field__input form-field__input--mono"
                      value="533443472"
                    />
                  </div>

                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.pages.settings.9') }}</label>
                    <select class="form-field__input" id="companyScope" name="companyScope">
                      <option value="riyadh" selected>{{ __('company.common.183') }}</option>
                      <option value="all-regions">{{ __('company.pages.settings.10') }}</option>
                    </select>
                  </div>

                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.pages.settings.11') }}</label>
                    <input
                      type="text"
                      class="form-field__input"
                      id="companyLicenseCategory"
                      name="companyLicenseCategory"
                       placeholder="{{ __('company.pages.settings.48') }}"
                    />
                  </div>

                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.pages.settings.12') }}</label>
                    <input
                      type="number"
                      class="form-field__input form-field__input--mono"
                      id="branchCount"
                      name="branchCount"
                      min="1"
                      step="1"
                      value="1"
                    />
                  </div>

                  <div class="form-field form-grid--full">
                    <label class="form-field__label">{{ __('company.pages.settings.13') }}</label>
                    <input
                      type="number"
                      class="form-field__input form-field__input--mono"
                      value="2"
                    />
                  </div>
                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.pages.settings.14') }}</label>
                    <select class="form-field__input" id="insurancePolicy" name="insurancePolicy">
                      <option value="comprehensive" selected>{{ __('company.pages.settings.15') }}</option>
                      <option value="deductible">{{ __('company.pages.settings.16') }}</option>
                    </select>
                  </div>

                  <div
                    class="form-field insurance-deductible-field"
                    id="insuranceDeductibleField"
                    hidden
                  >
                    <label class="form-field__label" for="insuranceDeductible">
                      {{ __('company.pages.settings.17') }}</label>
                    <input
                      type="number"
                      class="form-field__input form-field__input--mono"
                      id="insuranceDeductible"
                      name="insuranceDeductible"
                      min="0"
                      max="100"
                      step="0.01"
                       placeholder="{{ __('company.pages.settings.49') }}"
                      disabled
                    />
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
                    <label class="form-field__label">{{ __('company.common.217') }}<span class="req">*</span></label>
                    <input
                      type="text"
                      id="addressInput"
                      class="form-field__input"
                      value="RQ44+XC2، قرطبة، الرياض 13245، السعودية"
                    />
                  </div>

                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.229') }}<span class="req">*</span></label>
                    <input
                      type="text"
                      id="cityInput"
                      class="form-field__input form-field__input--bold"
                      value="الرياض"
                    />
                  </div>

                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.pages.settings.19') }}<span class="req">*</span></label>
                    <input
                      type="text"
                      id="countryInput"
                      class="form-field__input"
                      value="المملكة العربية السعودية"
                    />
                  </div>
                </div>

                <div class="map-wrapper">
                  <iframe
                    id="companyMapFrame"
                    src="https://maps.google.com/maps?q=24.72,46.7&z=15&output=embed"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                     title="{{ __('company.pages.settings.50') }}"
                  >
                  </iframe>
                </div>
                <div class="map-actions">
                  <div class="map-search">
                    <i class="bi bi-search" id="mapSearchIcon"></i>
                    <input
                      type="text"
                      id="mapSearchInput"
                       placeholder="{{ __('company.pages.settings.51') }}"
                    />
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
                    <p class="settings-card__desc">
                      {{ __('company.pages.settings.22') }}</p>
                  </div>
                </div>
              </div>
              <div class="settings-card__body">
                <label class="dropzone" for="logoUpload" id="logoDropzone">
                  <span class="dropzone__preview" id="logoPreview"
                    ><i class="bi bi-image"></i
                  ></span>
                  <span class="dropzone__text">
                    <p class="dropzone__title">{{ __('company.pages.settings.23') }}</p>
                    <p class="dropzone__sub" id="logoFileName">{{ __('company.pages.settings.24') }}</p>
                  </span>
                  <span class="dropzone__btn"><i class="bi bi-cloud-arrow-up"></i> {{ __('company.common.125') }}</span>
                  <input type="file" id="logoUpload" accept="image/png, image/jpeg" hidden />
                </label>
                <button
                  type="button"
                  class="dropzone__remove"
                  id="logoRemoveBtn"
                  style="display: none"
                >
                  <i class="bi bi-trash3"></i> {{ __('company.pages.settings.25') }}</button>
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
                <span class="verified-pill"><i class="bi bi-patch-check-fill"></i> {{ __('company.pages.settings.28') }}</span>
              </div>
              <div class="settings-card__body">
                <div class="form-grid" style="margin-bottom: 18px">
                  <div class="form-field form-grid--full" style="max-width: 340px">
                    <label class="form-field__label"
                      >{{ __('company.pages.settings.29') }}<span class="req">*</span></label
                    >
                    <input
                      type="text"
                      class="form-field__input form-field__input--bold form-field__input--mono"
                      value="1010792746"
                      readonly
                    />
                  </div>
                </div>
                <label class="dropzone" for="crUpload" id="crDropzone">
                  <span class="dropzone__preview" id="crPreview"
                    ><i class="bi bi-file-earmark-pdf"></i
                  ></span>
                  <span class="dropzone__text">
                    <p class="dropzone__title">{{ __('company.pages.settings.30') }}</p>
                    <p class="dropzone__sub" id="crFileName">commercial-registration.pdf</p>
                  </span>
                  <span class="dropzone__btn"
                    ><i class="bi bi-cloud-arrow-up"></i> {{ __('company.pages.settings.31') }}</span
                  >
                  <input type="file" id="crUpload" accept="application/pdf, image/*" hidden />
                </label>
              </div>
            </div>
            
            <div class="settings-card" id="sec-cr">
              <div class="settings-card__header">
                <div class="settings-card__header-main">
                  <span class="settings-card__icon"><i class="bi bi-file-earmark-text"></i></span>
                  <div>
                    <p class="settings-card__title">{{ __('company.pages.settings.32') }}</p>
                    <p class="settings-card__desc">{{ __('company.pages.settings.27') }}</p>
                  </div>
                </div>
                <span class="verified-pill"><i class="bi bi-patch-check-fill"></i> {{ __('company.pages.settings.28') }}</span>
              </div>
              <div class="settings-card__body">
                <div class="form-grid" style="margin-bottom: 18px">
                  <div class="form-field form-grid--full" style="max-width: 340px">
                    <label class="form-field__label">{{ __('company.pages.settings.32') }}<span class="req">*</span></label>
                    <input
                      type="text"
                      class="form-field__input form-field__input--bold form-field__input--mono"
                      value="1010792746"
                      readonly
                    />
                  </div>
                </div>
                <label class="dropzone" for="crUpload" id="crDropzone">
                  <span class="dropzone__preview" id="crPreview"
                    ><i class="bi bi-file-earmark-pdf"></i
                  ></span>
                  <span class="dropzone__text">
                    <p class="dropzone__title">{{ __('company.pages.settings.33') }}</p>
                    <p class="dropzone__sub" id="crFileName">commercial-registration.pdf</p>
                  </span>
                  <span class="dropzone__btn"
                    ><i class="bi bi-cloud-arrow-up"></i> {{ __('company.pages.settings.31') }}</span
                  >
                  <input type="file" id="crUpload" accept="application/pdf, image/*" hidden />
                </label>
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
                    <label class="form-field__label"
                      >{{ __('company.pages.settings.35') }}<span class="req">*</span></label
                    >
                    <input
                      type="text"
                      class="form-field__input form-field__input--bold"
                      value="شركة انتي لتأجير السيارات"
                    />
                  </div>

                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.132') }}<span class="req">*</span></label>
                    <input
                      type="text"
                      class="form-field__input form-field__input--bold"
                      value="بنك البلاد"
                    />
                  </div>

                  <div class="form-field mask-field">
                    <label class="form-field__label">{{ __('company.pages.settings.36') }}<span class="req">*</span></label>
                    <input
                      type="password"
                      class="form-field__input form-field__input--mono"
                      value="SA6135000440137935350007"
                      readonly
                    />
                    <button type="button" class="mask-toggle" data-mask-toggle  title="{{ __('company.common.90') }}">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>

                  <div class="form-field mask-field">
                    <label class="form-field__label">{{ __('company.pages.settings.37') }}<span class="req">*</span></label>
                    <input
                      type="password"
                      class="form-field__input form-field__input--mono"
                      value="440137935350007"
                      readonly
                    />
                    <button type="button" class="mask-toggle" data-mask-toggle  title="{{ __('company.common.90') }}">
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
                
                <div class="service-item js-service" data-service>
                  <div class="service-item__header">
                    <div class="service-item__header-main">
                      <span class="service-item__icon"><i class="bi bi-check2-square"></i></span>
                      <span class="service-item__title">{{ __('company.pages.settings.39') }}</span>
                    </div>
                    <div class="toggle-switch">
                      <input
                        type="checkbox"
                        id="serviceTam"
                        class="toggle-switch__input"
                        checked
                        data-service-toggle
                      />
                      <label for="serviceTam" class="toggle-switch__label">
                        <span class="toggle-switch__slider"></span>
                      </label>
                    </div>
                  </div>
                  <div class="service-item__body">
                    <div class="segmented" data-billing-group>
                      <input type="radio" name="tam-billing" id="tam-free" />
                      <label for="tam-free">{{ __('company.pages.settings.40') }}</label>
                      <input type="radio" name="tam-billing" id="tam-paid" checked />
                      <label for="tam-paid">{{ __('company.pages.settings.41') }}</label>
                    </div>
                    <div class="form-field">
                      <label class="form-field__label">{{ __('company.common.191') }}<span class="req">*</span></label>
                      <div class="price-field">
                        <input type="number" class="price-field__input" value="5.00" />
                        <span class="price-field__suffix">{{ __('company.common.406') }}</span>
                      </div>
                    </div>
                  </div>
                </div>

                
                <div class="service-item js-service" data-service>
                  <div class="service-item__header">
                    <div class="service-item__header-main">
                      <span class="service-item__icon"><i class="bi bi-person-plus"></i></span>
                      <span class="service-item__title">{{ __('company.pages.settings.42') }}</span>
                    </div>
                    <div class="toggle-switch">
                      <input
                        type="checkbox"
                        id="serviceDriver"
                        class="toggle-switch__input"
                        checked
                        data-service-toggle
                      />
                      <label for="serviceDriver" class="toggle-switch__label">
                        <span class="toggle-switch__slider"></span>
                      </label>
                    </div>
                  </div>
                  <div class="service-item__body">
                    <div class="segmented" data-billing-group>
                      <input type="radio" name="driver-billing" id="driver-free" />
                      <label for="driver-free">{{ __('company.pages.settings.40') }}</label>
                      <input type="radio" name="driver-billing" id="driver-paid" checked />
                      <label for="driver-paid">{{ __('company.pages.settings.41') }}</label>
                    </div>
                    <div class="form-field">
                      <label class="form-field__label">{{ __('company.common.191') }}<span class="req">*</span></label>
                      <div class="price-field">
                        <input type="number" class="price-field__input" value="200.00" />
                        <span class="price-field__suffix">{{ __('company.common.406') }}</span>
                      </div>
                    </div>
                  </div>
                </div>

                
                <div class="service-item js-service" data-service>
                  <div class="service-item__header">
                    <div class="service-item__header-main">
                      <span class="service-item__icon"><i class="bi bi-airplane"></i></span>
                      <span class="service-item__title"
                        >{{ __('company.pages.settings.43') }}</span
                      >
                    </div>
                    <div class="toggle-switch">
                      <input
                        type="checkbox"
                        id="serviceTravel"
                        class="toggle-switch__input"
                        checked
                        data-service-toggle
                      />
                      <label for="serviceTravel" class="toggle-switch__label">
                        <span class="toggle-switch__slider"></span>
                      </label>
                    </div>
                  </div>
                  <div class="service-item__body">
                    <div class="segmented" data-billing-group>
                      <input type="radio" name="travel-billing" id="travel-free" />
                      <label for="travel-free">{{ __('company.pages.settings.40') }}</label>
                      <input type="radio" name="travel-billing" id="travel-paid" checked />
                      <label for="travel-paid">{{ __('company.pages.settings.41') }}</label>
                    </div>
                    <div class="form-field">
                      <label class="form-field__label">{{ __('company.common.191') }}<span class="req">*</span></label>
                      <div class="price-field">
                        <input type="number" class="price-field__input" value="200.00" />
                        <span class="price-field__suffix">{{ __('company.common.406') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
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
                <div class="toggle-row">
                  <span class="toggle-row__label">
                    <span class="toggle-row__icon"><i class="bi bi-cash-stack"></i></span>
                    {{ __('company.pages.settings.45') }}</span>
                  <div class="toggle-switch">
                    <input type="checkbox" id="paymentCash" class="toggle-switch__input" />
                    <label for="paymentCash" class="toggle-switch__label">
                      <span class="toggle-switch__slider"></span>
                    </label>
                  </div>
                </div>
                <div class="toggle-row">
                  <span class="toggle-row__label">
                    <span class="toggle-row__icon"><i class="bi bi-credit-card-2-front"></i></span>
                    {{ __('company.pages.settings.46') }}</span>
                  <div class="toggle-switch">
                    <input type="checkbox" id="paymentCard" class="toggle-switch__input" checked />
                    <label for="paymentCard" class="toggle-switch__label">
                      <span class="toggle-switch__slider"></span>
                    </label>
                  </div>
                </div>

                <div class="toggle-row">
                  <span class="toggle-row__label">
                    <span class="toggle-row__icon"><i class="bi bi-apple"></i></span>
                    Apple Pay
                  </span>
                  <div class="toggle-switch">
                    <input type="checkbox" id="paymentApple" class="toggle-switch__input" />
                    <label for="paymentApple" class="toggle-switch__label">
                      <span class="toggle-switch__slider"></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="settings-savebar">
              <span class="settings-savebar__msg" id="savebarMsg" style="visibility: hidden">
                <i class="bi bi-exclamation-circle-fill"></i> {{ __('company.pages.settings.47') }}</span>
              <div class="settings-savebar__actions">
                <button class="btn btn-outline" type="button" id="cancelBtn">{{ __('company.common.95') }}</button>
                <button class="btn btn-primary" type="submit" id="saveBtn">
                  <i class="bi bi-check2-circle"></i>
                  {{ __('company.common.376') }}</button>
              </div>
            </div>
          </form>
@endsection

@push('modals')
</main>
@endpush

@push('libs')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        /* ---- Quick-nav smooth scroll + scrollspy ---- */
        const navLinks = Array.from(document.querySelectorAll('#settingsQuickNav a'));
        const sections = navLinks.map((a) => document.querySelector(a.getAttribute('href')));

        navLinks.forEach((link) => {
          link.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
              const y = target.getBoundingClientRect().top + window.pageYOffset - 84;
              window.scrollTo({ top: y, behavior: 'smooth' });
            }
          });
        });

        function updateActiveNav() {
          let currentIndex = 0;
          sections.forEach((sec, i) => {
            if (sec && sec.getBoundingClientRect().top - 100 <= 0) currentIndex = i;
          });
          navLinks.forEach((l, i) => l.classList.toggle('is-active', i === currentIndex));
        }
        window.addEventListener('scroll', updateActiveNav, { passive: true });
        updateActiveNav();

        /* ---- Insurance deductible field ---- */
        const insurancePolicy = document.getElementById('insurancePolicy');
        const insuranceDeductibleField = document.getElementById('insuranceDeductibleField');
        const insuranceDeductible = document.getElementById('insuranceDeductible');

        function syncInsuranceDeductible() {
          const isDeductible = insurancePolicy.value === 'deductible';
          insuranceDeductibleField.hidden = !isDeductible;
          insuranceDeductible.disabled = !isDeductible;
          insuranceDeductible.required = isDeductible;
          if (!isDeductible) insuranceDeductible.value = '';
        }

        insurancePolicy.addEventListener('change', syncInsuranceDeductible);
        syncInsuranceDeductible();

        /* ---- Service item enable/disable ---- */
        document.querySelectorAll('[data-service-toggle]').forEach((toggle) => {
          toggle.addEventListener('change', function () {
            this.closest('.js-service').classList.toggle('is-off', !this.checked);
          });
        });

        /* ---- Masked bank fields reveal ---- */
        document.querySelectorAll('[data-mask-toggle]').forEach((btn) => {
          btn.addEventListener('click', function () {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            if (input.type === 'password') {
              input.type = 'text';
              icon.className = 'bi bi-eye-slash';
            } else {
              input.type = 'password';
              icon.className = 'bi bi-eye';
            }
          });
        });

        /* ---- Logo dropzone preview ---- */
        const logoInput = document.getElementById('logoUpload');
        const logoPreview = document.getElementById('logoPreview');
        const logoFileName = document.getElementById('logoFileName');
        const logoRemoveBtn = document.getElementById('logoRemoveBtn');
        const logoDropzone = document.getElementById('logoDropzone');

        function setLogoFile(file) {
          if (!file) return;
          logoFileName.textContent = file.name;
          const reader = new FileReader();
          reader.onload = (e) => {
            logoPreview.innerHTML = '<img src="' + e.target.result + '" alt="logo preview">';
          };
          reader.readAsDataURL(file);
          logoRemoveBtn.style.display = 'inline-flex';
        }

        logoInput.addEventListener('change', function () {
          setLogoFile(this.files[0]);
        });

        ['dragover', 'dragleave', 'drop'].forEach((evt) => {
          logoDropzone.addEventListener(evt, function (e) {
            e.preventDefault();
            this.classList.toggle('is-dragover', evt === 'dragover');
            if (evt === 'drop' && e.dataTransfer.files.length) {
              logoInput.files = e.dataTransfer.files;
              setLogoFile(e.dataTransfer.files[0]);
            }
          });
        });

        logoRemoveBtn.addEventListener('click', function (e) {
          e.preventDefault();
          logoInput.value = '';
          logoPreview.innerHTML = '<i class="bi bi-image"></i>';
          logoFileName.textContent = 'لم يتم اختيار أي ملف بعد';
          this.style.display = 'none';
        });

        /* ---- CR file replace name ---- */
        const crInput = document.getElementById('crUpload');
        const crFileName = document.getElementById('crFileName');
        crInput.addEventListener('change', function () {
          if (this.files[0]) crFileName.textContent = this.files[0].name;
        });

        /* ---- Unsaved changes indicator ---- */
        const form = document.getElementById('settingsForm');
        const savebarMsg = document.getElementById('savebarMsg');
        form.addEventListener(
          'input',
          function () {
            savebarMsg.style.visibility = 'visible';
          },
          true,
        );
        form.addEventListener(
          'change',
          function () {
            savebarMsg.style.visibility = 'visible';
          },
          true,
        );

        form.addEventListener('submit', function (e) {
          e.preventDefault();
          savebarMsg.style.visibility = 'hidden';
        });

        /* ═══════════════════════════════════════
           خريطة الموقع: بحث + تحديد الموقع الحالي
        ═══════════════════════════════════════ */
        const mapFrame = document.getElementById('companyMapFrame');
        const mapSearchInput = document.getElementById('mapSearchInput');
        const mapSearchIcon = document.getElementById('mapSearchIcon');
        const locateBtn = document.getElementById('mapLocateBtn');

        function updateMapSrc(query) {
          if (!mapFrame) return;
          mapFrame.src =
            'https://maps.google.com/maps?q=' + encodeURIComponent(query) + '&z=15&output=embed';
        }

        // زر "استخدام موقعي الحالي"
        if (locateBtn) {
          locateBtn.addEventListener('click', function (e) {
            e.preventDefault();

            if (!navigator.geolocation) {
              alert('المتصفح الحالي لا يدعم تحديد الموقع الجغرافي');
              return;
            }

            const originalHTML = locateBtn.innerHTML;
            locateBtn.disabled = true;
            locateBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> جاري تحديد موقعك...';

            navigator.geolocation.getCurrentPosition(
              function (pos) {
                const { latitude, longitude } = pos.coords;
                updateMapSrc(latitude + ',' + longitude);
                if (mapSearchInput) {
                  mapSearchInput.value = latitude.toFixed(6) + ', ' + longitude.toFixed(6);
                }
                locateBtn.disabled = false;
                locateBtn.innerHTML = originalHTML;
                if (savebarMsg) savebarMsg.style.visibility = 'visible';
              },
              function (err) {
                let msg = 'تعذر الحصول على موقعك الحالي.';
                if (err.code === err.PERMISSION_DENIED) {
                  msg =
                    'تم رفض إذن الوصول للموقع. الرجاء السماح بالوصول للموقع من إعدادات المتصفح.';
                } else if (err.code === err.POSITION_UNAVAILABLE) {
                  msg = 'معلومات الموقع غير متاحة حاليًا.';
                } else if (err.code === err.TIMEOUT) {
                  msg = 'انتهت مهلة تحديد الموقع، حاول مرة أخرى.';
                }
                alert(msg);
                locateBtn.disabled = false;
                locateBtn.innerHTML = originalHTML;
              },
              {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0,
              },
            );
          });
        }

        // حقل البحث عن عنوان / رابط
        function runMapSearch() {
          if (!mapSearchInput) return;
          const val = mapSearchInput.value.trim();
          if (!val) return;
          updateMapSrc(val);
          if (savebarMsg) savebarMsg.style.visibility = 'visible';
        }

        if (mapSearchInput) {
          mapSearchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
              e.preventDefault();
              runMapSearch();
            }
          });
        }
        if (mapSearchIcon) {
          mapSearchIcon.addEventListener('click', runMapSearch);
          mapSearchIcon.style.cursor = 'pointer';
        }
      });
    </script>
@endpush

