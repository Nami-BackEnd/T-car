@extends('company.layouts.master')

@section('title', 'T-Car — Create Booking')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.97') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.167') }}</span>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('company.reservations') }}">{{ __('company.common.471') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.common.97') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
              <a href="{{ route('company.reservations') }}" class="btn btn-outline"
                ><i class="bi bi-arrow-right"></i> {{ __('company.pages.create-booking.0') }}</a
              >
            </div>
          </div>

          
          <form class="create-booking-form" id="createBookingForm">
            
            <div class="form-section">
              <h2 class="form-section__title">{{ __('company.common.315') }}</h2>

              <div class="form-section__subtitle">{{ __('company.pages.create-booking.1') }}</div>

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">{{ __('company.common.401') }}<span class="required">*</span></label>
                  <input type="text" class="form-control"  placeholder="{{ __('company.pages.create-booking.52') }}" />
                </div>
                
                <div class="col-md-6">
                  <label class="form-label"
                    >{{ __('company.pages.create-booking.2') }}<span class="required">*</span></label
                  >
                  <input
                    type="text"
                    class="form-control ltr-num"
                     placeholder="{{ __('company.pages.create-booking.53') }}"
                  />
                </div>
                
                <div class="col-md-6">
                  <label class="form-label">{{ __('company.pages.create-booking.3') }}<span class="required">*</span></label>
                  <div class="input-with-icon">
                    <input type="date" class="form-control ltr-num" />
                    <i class="bi bi-calendar input-icon"></i>
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">{{ __('company.common.435') }}<span class="required">*</span></label>
                  <div class="file-upload-wrapper">
                    <input type="file" class="form-control" id="licenseImage" />
                    <label for="licenseImage" class="file-upload-label">
                      <i class="bi bi-paperclip"></i>
                      <span id="licenseFileName">{{ __('company.pages.create-booking.4') }}</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="form-section">
              <h2 class="form-section__title">{{ __('company.common.570') }}</h2>

              <div class="radio-group">
                <label class="radio-option">
                  <input type="radio" name="serviceType" value="pickup" checked />
                  <span class="radio-custom"></span>
                  <span class="radio-label">{{ __('company.common.129') }}</span>
                </label>
                <label class="radio-option">
                  <input type="radio" name="serviceType" value="delivery" />
                  <span class="radio-custom"></span>
                  <span class="radio-label">{{ __('company.pages.create-booking.5') }}</span>
                </label>
              </div>
            </div>

            
            <div class="form-section">
              <h2 class="form-section__title">{{ __('company.pages.create-booking.6') }}</h2>

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label" for="rentalTypeSelect"
                    >{{ __('company.pages.create-booking.6') }}<span class="required">*</span></label
                  >
                  <div class="custom-dropdown" data-rental-type-dropdown>
                    <select style="display: none" id="rentalTypeSelect" data-rental-type-select>
                      <option value="daily" selected>{{ __('company.pages.create-booking.7') }}</option>
                      <option value="monthly">{{ __('company.pages.create-booking.8') }}</option>
                      <option value="airport">{{ __('company.pages.create-booking.9') }}</option>
                      <option value="station">{{ __('company.pages.create-booking.10') }}</option>
                      <option value="international">{{ __('company.pages.create-booking.11') }}</option>
                    </select>
                    <button
                      type="button"
                      class="btn btn-outline custom-dropdown__trigger"
                      aria-expanded="false"
                    >
                      <span class="custom-dropdown__text">{{ __('company.pages.create-booking.7') }}</span>
                      <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                    </button>
                    <div class="custom-dropdown__menu">
                      <div class="custom-dropdown__options">
                        <button type="button" class="custom-dropdown__option" data-value="daily">
                          <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.7') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button type="button" class="custom-dropdown__option" data-value="monthly">
                          <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.8') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button type="button" class="custom-dropdown__option" data-value="airport">
                          <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.9') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button type="button" class="custom-dropdown__option" data-value="station">
                          <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.10') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button
                          type="button"
                          class="custom-dropdown__option"
                          data-value="international"
                        >
                          <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.11') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="form-section">
              <h2 class="form-section__title">{{ __('company.pages.create-booking.12') }}</h2>

              
              <div class="form-group" id="pickupAddressGroup" data-booking-map="pickup">
                <label class="form-label" for="pickupAddressInput"
                  >{{ __('company.common.451') }}<span class="required">*</span></label
                >
                <div class="input-with-custom-ui">
                  <input
                    type="text"
                    class="form-control"
                    id="pickupAddressInput"
                     placeholder="{{ __('company.pages.create-booking.54') }}"
                  />
                  <button
                    type="button"
                    class="btn-link map-btn"
                    id="showMapBtn2"
                    data-map-toggle
                    aria-controls="mapContainer2"
                    aria-expanded="false"
                  >
                    <i class="bi bi-map"></i>
                    <span>{{ __('company.pages.create-booking.13') }}</span>
                  </button>
                </div>
                <div class="map-container" id="mapContainer2" data-map-container aria-hidden="true">
                  <div id="pickupBookingMap" class="booking-map" data-map-canvas></div>
                </div>
              </div>

              
              <div class="form-group" id="pickupAirportGroup" hidden>
                <label class="form-label" for="pickupAirportSelect"
                  >{{ __('company.pages.create-booking.14') }}<span class="required">*</span></label
                >
                <div class="custom-dropdown" data-airport-dropdown>
                  <select style="display: none" id="pickupAirportSelect" data-airport-select>
                    <option value="">{{ __('company.pages.create-booking.15') }}</option>
                    <option value="مطار الملك خالد الدولي - الرياض">
                      {{ __('company.pages.create-booking.16') }}</option>
                    <option value="مطار الملك عبدالعزيز الدولي - جدة">
                      {{ __('company.pages.create-booking.17') }}</option>
                    <option value="مطار الملك فهد الدولي - الدمام">
                      {{ __('company.pages.create-booking.18') }}</option>
                    <option value="مطار الأمير محمد بن عبدالعزيز - المدينة المنورة">
                      {{ __('company.pages.create-booking.19') }}</option>
                    <option value="مطار الطائف الإقليمي">{{ __('company.common.532') }}</option>
                    <option value="مطار الأمير عبدالمحسن بن عبدالعزيز - ينبع">
                      {{ __('company.pages.create-booking.20') }}</option>
                    <option value="مطار أبها الإقليمي">{{ __('company.pages.create-booking.21') }}</option>
                    <option value="مطار الأحساء الدولي">{{ __('company.pages.create-booking.22') }}</option>
                  </select>
                  <button
                    type="button"
                    class="btn btn-outline custom-dropdown__trigger"
                    aria-expanded="false"
                  >
                    <span class="custom-dropdown__text">{{ __('company.pages.create-booking.15') }}</span>
                    <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                  </button>
                  <div class="custom-dropdown__menu">
                    <div class="custom-dropdown__search">
                      <i class="bi bi-search custom-dropdown__search-icon"></i>
                      <input
                        type="text"
                        class="custom-dropdown__search-input"
                         placeholder="{{ __('company.pages.create-booking.55') }}"
                         aria-label="{{ __('company.pages.create-booking.56') }}"
                      />
                    </div>
                    <div class="custom-dropdown__options">
                      <button type="button" class="custom-dropdown__option" data-value="">
                        <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.15') }}</span>
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="مطار الملك خالد الدولي - الرياض"
                      >
                        <span class="custom-dropdown__option-text"
                          >{{ __('company.pages.create-booking.16') }}</span
                        >
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="مطار الملك عبدالعزيز الدولي - جدة"
                      >
                        <span class="custom-dropdown__option-text"
                          >{{ __('company.pages.create-booking.17') }}</span
                        >
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="مطار الملك فهد الدولي - الدمام"
                      >
                        <span class="custom-dropdown__option-text"
                          >{{ __('company.pages.create-booking.18') }}</span
                        >
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="مطار الأمير محمد بن عبدالعزيز - المدينة المنورة"
                      >
                        <span class="custom-dropdown__option-text"
                          >{{ __('company.pages.create-booking.19') }}</span
                        >
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="مطار الطائف الإقليمي"
                      >
                        <span class="custom-dropdown__option-text">{{ __('company.common.532') }}</span>
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="مطار الأمير عبدالمحسن بن عبدالعزيز - ينبع"
                      >
                        <span class="custom-dropdown__option-text"
                          >{{ __('company.pages.create-booking.20') }}</span
                        >
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="مطار أبها الإقليمي"
                      >
                        <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.21') }}</span>
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="مطار الأحساء الدولي"
                      >
                        <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.22') }}</span>
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              
              <div class="form-group" id="pickupStationGroup" hidden>
                <label class="form-label" for="pickupStationSelect"
                  >{{ __('company.pages.create-booking.23') }}<span class="required">*</span></label
                >
                <div class="custom-dropdown" data-station-dropdown>
                  <select style="display: none" id="pickupStationSelect" data-station-select>
                    <option value="">{{ __('company.pages.create-booking.24') }}</option>
                    <option value="محطة قطار الرياض">{{ __('company.pages.create-booking.25') }}</option>
                    <option value="محطة قطار الدمام">{{ __('company.pages.create-booking.26') }}</option>
                    <option value="محطة قطار الأحساء - الهفوف">{{ __('company.pages.create-booking.27') }}</option>
                    <option value="محطة قطار القصيم - بريدة">{{ __('company.pages.create-booking.28') }}</option>
                    <option value="محطة قطار الحرمين - مكة المكرمة">
                      {{ __('company.pages.create-booking.29') }}</option>
                    <option value="محطة قطار الحرمين - المدينة المنورة">
                      {{ __('company.pages.create-booking.30') }}</option>
                    <option value="محطة قطار الحرمين - جدة">{{ __('company.pages.create-booking.31') }}</option>
                    <option value="محطة قطار الحرمين - مدينة الملك عبدالله الاقتصادية">
                      {{ __('company.pages.create-booking.32') }}</option>
                  </select>
                  <button
                    type="button"
                    class="btn btn-outline custom-dropdown__trigger"
                    aria-expanded="false"
                  >
                    <span class="custom-dropdown__text">{{ __('company.pages.create-booking.24') }}</span>
                    <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                  </button>
                  <div class="custom-dropdown__menu">
                    <div class="custom-dropdown__search">
                      <i class="bi bi-search custom-dropdown__search-icon"></i>
                      <input
                        type="text"
                        class="custom-dropdown__search-input"
                         placeholder="{{ __('company.pages.create-booking.57') }}"
                         aria-label="{{ __('company.pages.create-booking.58') }}"
                      />
                    </div>
                    <div class="custom-dropdown__options">
                      <button type="button" class="custom-dropdown__option" data-value="">
                        <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.24') }}</span>
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="محطة قطار الرياض"
                      >
                        <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.25') }}</span>
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="محطة قطار الدمام"
                      >
                        <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.26') }}</span>
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="محطة قطار الأحساء - الهفوف"
                      >
                        <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.27') }}</span>
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="محطة قطار القصيم - بريدة"
                      >
                        <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.28') }}</span>
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="محطة قطار الحرمين - مكة المكرمة"
                      >
                        <span class="custom-dropdown__option-text"
                          >{{ __('company.pages.create-booking.29') }}</span
                        >
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="محطة قطار الحرمين - المدينة المنورة"
                      >
                        <span class="custom-dropdown__option-text"
                          >{{ __('company.pages.create-booking.30') }}</span
                        >
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="محطة قطار الحرمين - جدة"
                      >
                        <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.31') }}</span>
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                      <button
                        type="button"
                        class="custom-dropdown__option"
                        data-value="محطة قطار الحرمين - مدينة الملك عبدالله الاقتصادية"
                      >
                        <span class="custom-dropdown__option-text"
                          >{{ __('company.pages.create-booking.32') }}</span
                        >
                        <i class="bi bi-check2 custom-dropdown__option-check"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="text-smaller text-muted mt-1" id="pickupLocationSummary" hidden>
                <i class="bi bi-geo-alt"></i>
                <span id="pickupLocationSummaryText"></span>
              </div>

              
              <div class="form-group mt-3" data-booking-map="dropoff">
                <label class="form-label" for="dropoffAddressInput"
                  >{{ __('company.common.452') }}<span class="required">*</span></label
                >
                <div class="input-with-custom-ui">
                  <input
                    type="text"
                    class="form-control"
                    id="dropoffAddressInput"
                     placeholder="{{ __('company.pages.create-booking.59') }}"
                  />
                  <button
                    type="button"
                    class="btn-link map-btn"
                    id="showMapBtn"
                    data-map-toggle
                    aria-controls="mapContainer"
                    aria-expanded="false"
                  >
                    <i class="bi bi-map"></i>
                    <span>{{ __('company.pages.create-booking.13') }}</span>
                  </button>
                </div>
                <div class="map-container" id="mapContainer" data-map-container aria-hidden="true">
                  <div id="dropoffBookingMap" class="booking-map" data-map-canvas></div>
                </div>
              </div>
            </div>

            
            <div class="form-section">
              <h2 class="form-section__title">{{ __('company.pages.create-booking.33') }}</h2>

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">{{ __('company.common.284') }}<span class="required">*</span></label>
                  <div class="input-with-icon">
                    <input type="date" class="form-control ltr-num" />
                    <i class="bi bi-calendar input-icon"></i>
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">{{ __('company.common.587') }}<span class="required">*</span></label>
                  <div class="input-with-icon">
                    <input type="time" class="form-control ltr-num" />
                    <i class="bi bi-clock input-icon"></i>
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">{{ __('company.common.287') }}<span class="required">*</span></label>
                  <div class="input-with-icon">
                    <input type="date" class="form-control ltr-num" />
                    <i class="bi bi-calendar input-icon"></i>
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">{{ __('company.common.588') }}<span class="required">*</span></label>
                  <div class="input-with-icon">
                    <input type="time" class="form-control ltr-num" />
                    <i class="bi bi-clock input-icon"></i>
                  </div>
                </div>
              </div>

              <div class="rental-duration">
                <span class="duration-label">{{ __('company.pages.create-booking.34') }}</span>
                <span class="duration-value">{{ __('company.pages.create-booking.35') }}</span>
              </div>

              <div class="form-note">
                <i class="bi bi-info-circle"></i>
                {{ __('company.pages.create-booking.36') }}</div>
            </div>

            
            <div class="form-section">
              <h2 class="form-section__title">{{ __('company.pages.create-booking.37') }}</h2>

              <p class="form-section__desc">{{ __('company.pages.create-booking.38') }}</p>

              <div class="custom-dropdown" data-car-dropdown>
                <select style="display: none" data-car-select>
                  <option value="">{{ __('company.pages.create-booking.39') }}</option>
                  <option value="1">{{ __('company.common.355') }}</option>
                  <option value="2">{{ __('company.pages.create-booking.40') }}</option>
                  <option value="3">{{ __('company.pages.create-booking.41') }}</option>
                  <option value="4">{{ __('company.common.576') }}</option>
                  <option value="5">{{ __('company.pages.create-booking.42') }}</option>
                </select>
                <button
                  type="button"
                  class="btn btn-outline custom-dropdown__trigger"
                  aria-expanded="false"
                >
                  
                  <span class="custom-dropdown__text">{{ __('company.pages.create-booking.43') }}</span>
                  <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                </button>
                <div class="custom-dropdown__menu">
                  <div class="custom-dropdown__search">
                    <i class="bi bi-search custom-dropdown__search-icon"></i>
                    <input
                      type="text"
                      class="custom-dropdown__search-input"
                       placeholder="{{ __('company.common.255') }}"
                       aria-label="{{ __('company.pages.create-booking.60') }}"
                    />
                  </div>
                  <div class="custom-dropdown__options">
                    <button type="button" class="custom-dropdown__option" data-value="1">
                      <span class="custom-dropdown__option-text">{{ __('company.common.355') }}</span>
                      <i class="bi bi-check2 custom-dropdown__option-check"></i>
                    </button>
                    <button type="button" class="custom-dropdown__option" data-value="2">
                      <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.40') }}</span>
                      <i class="bi bi-check2 custom-dropdown__option-check"></i>
                    </button>
                    <button type="button" class="custom-dropdown__option" data-value="3">
                      <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.41') }}</span>
                      <i class="bi bi-check2 custom-dropdown__option-check"></i>
                    </button>
                    <button type="button" class="custom-dropdown__option" data-value="4">
                      <span class="custom-dropdown__option-text">{{ __('company.common.576') }}</span>
                      <i class="bi bi-check2 custom-dropdown__option-check"></i>
                    </button>
                    <button type="button" class="custom-dropdown__option" data-value="5">
                      <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.42') }}</span>
                      <i class="bi bi-check2 custom-dropdown__option-check"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="form-section">
              <h2 class="form-section__title">{{ __('company.pages.create-booking.44') }}</h2>

              <p class="form-section__desc">
                {{ __('company.pages.create-booking.45') }}</p>

              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label">{{ __('company.common.229') }}<span class="required">*</span></label>
                  <div class="custom-dropdown" data-city-dropdown>
                    <select style="display: none" data-city-select>
                      <option value="">{{ __('company.common.113') }}</option>
                      <option value="riyadh">{{ __('company.common.183') }}</option>
                      <option value="jeddah">{{ __('company.common.357') }}</option>
                      <option value="dammam">{{ __('company.common.174') }}</option>
                    </select>
                    <button
                      type="button"
                      class="btn btn-outline custom-dropdown__trigger"
                      aria-expanded="false"
                    >
                      <span class="custom-dropdown__text">{{ __('company.common.113') }}</span>
                      <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                    </button>
                    <div class="custom-dropdown__menu">
                      <div class="custom-dropdown__options">
                        <button type="button" class="custom-dropdown__option" data-value="">
                          <span class="custom-dropdown__option-text">{{ __('company.common.113') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button type="button" class="custom-dropdown__option" data-value="riyadh">
                          <span class="custom-dropdown__option-text">{{ __('company.common.183') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button type="button" class="custom-dropdown__option" data-value="jeddah">
                          <span class="custom-dropdown__option-text">{{ __('company.common.357') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button type="button" class="custom-dropdown__option" data-value="dammam">
                          <span class="custom-dropdown__option-text">{{ __('company.common.174') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <label class="form-label">{{ __('company.pages.create-booking.46') }}<span class="required">*</span></label>
                  <div class="custom-dropdown" data-company-dropdown>
                    <select style="display: none" data-company-select>
                      <option value="">{{ __('company.pages.create-booking.47') }}</option>
                      <option value="n2">N2</option>
                    </select>
                    <button
                      type="button"
                      class="btn btn-outline custom-dropdown__trigger"
                      aria-expanded="false"
                    >
                      <span class="custom-dropdown__text">{{ __('company.pages.create-booking.47') }}</span>
                      <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                    </button>
                    <div class="custom-dropdown__menu">
                      <div class="custom-dropdown__options">
                        <button type="button" class="custom-dropdown__option" data-value="">
                          <span class="custom-dropdown__option-text">{{ __('company.pages.create-booking.47') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button type="button" class="custom-dropdown__option" data-value="n2">
                          <span class="custom-dropdown__option-text">N2</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <label class="form-label">{{ __('company.common.235') }}<span class="required">*</span></label>
                  <div class="custom-dropdown" data-office-dropdown>
                    <select style="display: none" data-office-select>
                      <option value="">{{ __('company.common.115') }}</option>
                      <option value="tuwaiq">N2 - Tuwaiq</option>
                      <option value="almarwa">N2 Rental Car - Riyadh - Almarwa</option>
                      <option value="rawdah">N2 Rental Car - Rawdah</option>
                    </select>
                    <button
                      type="button"
                      class="btn btn-outline custom-dropdown__trigger"
                      aria-expanded="false"
                    >
                      <span class="custom-dropdown__text">{{ __('company.common.115') }}</span>
                      <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                    </button>
                    <div class="custom-dropdown__menu">
                      <div class="custom-dropdown__options">
                        <button type="button" class="custom-dropdown__option" data-value="">
                          <span class="custom-dropdown__option-text">{{ __('company.common.115') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button type="button" class="custom-dropdown__option" data-value="tuwaiq">
                          <span class="custom-dropdown__option-text">N2 - Tuwaiq</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button type="button" class="custom-dropdown__option" data-value="almarwa">
                          <span class="custom-dropdown__option-text"
                            >N2 Rental Car - Riyadh - Almarwa</span
                          >
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button type="button" class="custom-dropdown__option" data-value="rawdah">
                          <span class="custom-dropdown__option-text">N2 Rental Car - Rawdah</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="form-section">
              <h2 class="form-section__title">{{ __('company.common.437') }}</h2>

              <label class="checkbox-option">
                <input type="checkbox" id="sendPaymentLink" checked />
                <span class="checkbox-custom"></span>
                <span class="checkbox-label">{{ __('company.pages.create-booking.48') }}</span>
              </label>

              <p class="payment-note">{{ __('company.pages.create-booking.49') }}</p>
            </div>

            
            <div class="form-actions">
              <a href="{{ route('company.reservations') }}" class="btn btn-outline btn-lg">
                <i class="bi bi-x-lg"></i>
                {{ __('company.common.95') }}</a>
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check2-circle"></i>
                {{ __('company.pages.create-booking.50') }}</button>
            </div>
          </form>
@endsection

@push('modals')
</main>
        
      

    
    <div
      class="modal fade"
      id="successModal"
      tabindex="-1"
      aria-labelledby="successModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center py-5">
            <div class="success-icon mb-4">
              <i class="bi bi-check-circle-fill"></i>
            </div>
            <h3 class="modal-title mb-3" id="successModalLabel">{{ __('company.pages.create-booking.51') }}</h3>
          </div>
        </div>
      </div>
    </div>

    
@endpush

@push('libs')
<script
      src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
      integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
      crossorigin=""
    ></script>
@endpush

@push('scripts')
<script>
      (function () {
        const rentalTypeSelect = document.getElementById('rentalTypeSelect');
        if (!rentalTypeSelect) return;

        const pickupAddressGroup = document.getElementById('pickupAddressGroup');
        const pickupAirportGroup = document.getElementById('pickupAirportGroup');
        const pickupStationGroup = document.getElementById('pickupStationGroup');
        const pickupAirportSelect = document.getElementById('pickupAirportSelect');
        const pickupStationSelect = document.getElementById('pickupStationSelect');
        const pickupAddressInput = document.getElementById('pickupAddressInput');
        const pickupLocationSummary = document.getElementById('pickupLocationSummary');
        const pickupLocationSummaryText = document.getElementById('pickupLocationSummaryText');
        const pickupMapContainer = document.getElementById('mapContainer2');
        const pickupMapButton = document.getElementById('showMapBtn2');

        // Map toggles and Leaflet instances live in script.js and are exposed
        // by location name through window.BookingMaps.

        // Custom dropdown initialization for all custom dropdowns
        function initCustomDropdowns() {
          var openDropdowns = [];

          document
            .querySelectorAll(
              '[data-rental-type-dropdown], [data-airport-dropdown], [data-station-dropdown], [data-city-dropdown], [data-company-dropdown], [data-office-dropdown]',
            )
            .forEach(function (wrapper) {
              var trigger = wrapper.querySelector('.custom-dropdown__trigger');
              var menu = wrapper.querySelector('.custom-dropdown__menu');
              var textEl = wrapper.querySelector('.custom-dropdown__text');
              var select = wrapper.querySelector('select');
              var options = wrapper.querySelectorAll('.custom-dropdown__option');
              var searchInput = wrapper.querySelector('.custom-dropdown__search-input');

              if (!trigger || !menu) return;

              function closeDropdown() {
                menu.classList.remove('is-visible');
                trigger.classList.remove('is-open');
                trigger.setAttribute('aria-expanded', 'false');
                var idx = openDropdowns.indexOf(closeDropdown);
                if (idx !== -1) openDropdowns.splice(idx, 1);
              }

              function openDropdown() {
                openDropdowns.slice().forEach(function (close) {
                  close();
                });

                menu.classList.add('is-visible');
                trigger.classList.add('is-open');
                trigger.setAttribute('aria-expanded', 'true');
                openDropdowns.push(closeDropdown);
              }

              trigger.addEventListener('click', function (e) {
                e.stopPropagation();
                if (menu.classList.contains('is-visible')) {
                  closeDropdown();
                } else {
                  openDropdown();
                }
              });

              options.forEach(function (opt) {
                opt.addEventListener('click', function () {
                  var value = opt.getAttribute('data-value');
                  var labelEl = opt.querySelector('.custom-dropdown__option-text');
                  var label = labelEl ? labelEl.textContent.trim() : '';

                  options.forEach(function (o) {
                    o.removeAttribute('data-selected');
                  });
                  opt.setAttribute('data-selected', 'true');

                  if (textEl) textEl.textContent = label;
                  if (select) select.value = value;

                  closeDropdown();

                  // Trigger change event for rental type to update UI
                  if (select && select.id === 'rentalTypeSelect') {
                    var event = new Event('change', { bubbles: true });
                    select.dispatchEvent(event);
                  }

                  // Trigger change event to update pickup summary for airport/station
                  if (
                    select &&
                    (select.id === 'pickupAirportSelect' || select.id === 'pickupStationSelect')
                  ) {
                    var event = new Event('change', { bubbles: true });
                    select.dispatchEvent(event);
                  }
                });
              });

              // Search functionality
              if (searchInput) {
                searchInput.addEventListener('input', function () {
                  var query = searchInput.value.trim().toLowerCase();
                  options.forEach(function (opt) {
                    var text = opt.textContent.trim().toLowerCase();
                    opt.style.display = text.indexOf(query) !== -1 ? '' : 'none';
                  });
                });
              }

              menu.addEventListener('click', function (e) {
                e.stopPropagation();
              });
            });

          document.addEventListener('click', function () {
            openDropdowns.slice().forEach(function (close) {
              close();
            });
          });
        }

        // Collapse the pickup map (if open) whenever it's not relevant,
        // e.g. switching away from the free-text address field.
        function hideMapIfOpen() {
          if (window.BookingMaps && window.BookingMaps.pickup) {
            window.BookingMaps.pickup.hide();
            return;
          }

          // Fallback if script.js did not wire the map on this page.
          if (pickupMapContainer) {
            pickupMapContainer.classList.remove('is-visible');
            pickupMapContainer.setAttribute('aria-hidden', 'true');
          }
          if (pickupMapButton) {
            pickupMapButton.classList.remove('is-active');
            pickupMapButton.setAttribute('aria-expanded', 'false');
            var mapBtnIcon = pickupMapButton.querySelector('i');
            var mapBtnSpan = pickupMapButton.querySelector('span');
            if (mapBtnIcon) mapBtnIcon.className = 'bi bi-map';
            if (mapBtnSpan) mapBtnSpan.textContent = 'إظهار الخريطة';
          }
        }

        function updatePickupSummary(text) {
          if (!pickupLocationSummary || !pickupLocationSummaryText) return;
          if (text) {
            pickupLocationSummary.hidden = false;
            pickupLocationSummaryText.textContent = 'موقع الاستلام: ' + text;
          } else {
            pickupLocationSummary.hidden = true;
            pickupLocationSummaryText.textContent = '';
          }
        }

        function setRequired(el, isRequired) {
          if (!el) return;
          el.required = isRequired;
        }

        function applyRentalType() {
          const type = rentalTypeSelect.value;

          // Reset visibility of the three mutually-exclusive pickup controls.
          if (pickupAddressGroup) pickupAddressGroup.hidden = true;
          if (pickupAirportGroup) pickupAirportGroup.hidden = true;
          if (pickupStationGroup) pickupStationGroup.hidden = true;

          setRequired(pickupAddressInput, false);
          setRequired(pickupAirportSelect, false);
          setRequired(pickupStationSelect, false);

          if (type === 'airport') {
            if (pickupAirportGroup) pickupAirportGroup.hidden = false;
            setRequired(pickupAirportSelect, true);
            hideMapIfOpen();
            updatePickupSummary(pickupAirportSelect ? pickupAirportSelect.value : '');
          } else if (type === 'station') {
            if (pickupStationGroup) pickupStationGroup.hidden = false;
            setRequired(pickupStationSelect, true);
            hideMapIfOpen();
            updatePickupSummary(pickupStationSelect ? pickupStationSelect.value : '');
          } else {
            // Daily / Monthly / International — regular free-text address.
            if (pickupAddressGroup) pickupAddressGroup.hidden = false;
            setRequired(pickupAddressInput, true);
            updatePickupSummary('');
          }
        }

        rentalTypeSelect.addEventListener('change', applyRentalType);

        if (pickupAirportSelect) {
          pickupAirportSelect.addEventListener('change', function () {
            updatePickupSummary(this.value);
          });
        }

        if (pickupStationSelect) {
          pickupStationSelect.addEventListener('change', function () {
            updatePickupSummary(this.value);
          });
        }

        // Initialize custom dropdowns
        initCustomDropdowns();

        // Set initial selected state for rental type dropdown
        var rentalTypeWrapper = document.querySelector('[data-rental-type-dropdown]');
        if (rentalTypeWrapper) {
          var rentalTypeText = rentalTypeWrapper.querySelector('.custom-dropdown__text');
          var rentalTypeOptions = rentalTypeWrapper.querySelectorAll('.custom-dropdown__option');
          var initialValue = rentalTypeSelect.value;

          rentalTypeOptions.forEach(function (opt) {
            if (opt.getAttribute('data-value') === initialValue) {
              opt.setAttribute('data-selected', 'true');
              var labelEl = opt.querySelector('.custom-dropdown__option-text');
              if (rentalTypeText && labelEl) {
                rentalTypeText.textContent = labelEl.textContent.trim();
              }
            }
          });
        }

        // Initialize all custom dropdowns including office dropdowns
        var allDropdownConfigs = [
          { selector: '[data-rental-type-dropdown]', selectAttr: 'data-rental-type-select' },
          { selector: '[data-city-dropdown]', selectAttr: 'data-city-select' },
          { selector: '[data-company-dropdown]', selectAttr: 'data-company-select' },
          { selector: '[data-office-dropdown]', selectAttr: 'data-office-select' },
        ];

        allDropdownConfigs.forEach(function (config) {
          var wrapper = document.querySelector(config.selector);
          if (!wrapper) return;

          var select = wrapper.querySelector('[' + config.selectAttr + ']');
          var textEl = wrapper.querySelector('.custom-dropdown__text');
          var options = wrapper.querySelectorAll('.custom-dropdown__option');

          if (!select || !textEl) return;

          options.forEach(function (opt) {
            if (opt.getAttribute('data-value') === select.value) {
              opt.setAttribute('data-selected', 'true');
              var labelEl = opt.querySelector('.custom-dropdown__option-text');
              if (labelEl) {
                textEl.textContent = labelEl.textContent.trim();
              }
            }
          });
        });

        // Initial state
        applyRentalType();
      })();
    </script>
@endpush

