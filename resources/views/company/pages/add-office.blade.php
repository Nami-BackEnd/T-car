@extends('company.layouts.master')

@section('title', 'T-Car — إضافة فرع')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.467') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span> {{ __('company.common.220') }}</span>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('company.branches') }}"> {{ __('company.common.220') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current"> {{ __('company.common.87') }}</span>
              </nav>
            </div>
          </div>

          
          <div class="eo-quicknav-wrap">
            <ul class="eo-quicknav" id="eoQuickNav">
              <li>
                <a href="#sec-info" class="is-active"
                  ><i class="bi bi-building"></i> {{ __('company.common.542') }}</a
                >
              </li>
              <li>
                <a href="#sec-location"><i class="bi bi-geo-alt"></i> {{ __('company.common.242') }}</a>
              </li>
              <li>
                <a href="#sec-work-hours"><i class="bi bi-clock"></i> {{ __('company.common.416') }}</a>
              </li>
              <li>
                <a href="#sec-notes"><i class="bi bi-file-earmark-text"></i> {{ __('company.common.236') }}</a>
              </li>
              <li>
                <a href="#sec-services"><i class="bi bi-plus-circle"></i> {{ __('company.common.170') }}</a>
              </li>
              <li>
                <a href="#sec-holidays"><i class="bi bi-calendar-x"></i> {{ __('company.common.144') }}</a>
              </li>
            </ul>
          </div>

          <form id="editOfficeForm">
            
            <div class="edit-office-card" id="sec-info">
              <div class="edit-office-card__header">
                <h5 class="edit-office-card__title">
                  <i class="bi bi-pencil-square"></i>
                  {{ __('company.common.316') }}</h5>
              </div>
              <div class="edit-office-card__body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-field">
                      <label class="form-field__label">{{ __('company.common.573') }}</label>
                      <div class="radio-group radio-group--cards">
                        <label class="radio-option">
                          <input type="radio" name="branchType" value="branch" checked />
                          
                          <span class="radio-label">{{ __('company.common.457') }}</span>
                        </label>
                        <label class="radio-option">
                          <input type="radio" name="branchType" value="withdrawal" />
                          
                          <span class="radio-label">{{ __('company.common.465') }}</span>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-field">
                      <label class="form-field__label">{{ __('company.common.136') }}</label>
                      <input type="text" class="form-field__input"  placeholder="{{ __('company.common.53') }}" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-field">
                      <label class="form-field__label">{{ __('company.common.137') }}</label>
                      <input
                        type="text"
                        class="form-field__input"
                         placeholder="{{ __('company.common.54') }}"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-field">
                      <label class="form-field__label">{{ __('company.common.134') }}</label>
                      <input
                        type="text                                                                   "
                        class="form-field__input"
                         placeholder="{{ __('company.common.52') }}"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-field">
                      <label class="form-field__label">{{ __('company.common.250') }}</label>
                      <input type="text" class="form-field__input"  placeholder="{{ __('company.common.58') }}" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-field">
                      <label class="form-field__label">{{ __('company.common.394') }}</label>
                      <div class="phone-input-group">
                        <div class="phone-input-group__code">
                          <div class="custom-dropdown" id="countryCodeDropdown">
                            <select id="countryCodeSelect" style="display: none">
                              <option value="966+" selected>966+</option>
                              <option value="971+">971+</option>
                              <option value="965+">965+</option>
                              <option value="974+">974+</option>
                              <option value="973+">973+</option>
                              <option value="968+">968+</option>
                              <option value="20+">20+</option>
                              <option value="1+">1+</option>
                            </select>
                            <button
                              type="button"
                              class="custom-dropdown__trigger filter-dropdown-btn"
                              aria-expanded="false"
                            >
                              <span class="custom-dropdown__selected">
                                <span class="custom-dropdown__text">966+</span>
                              </span>
                              <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                            </button>
                            <div class="custom-dropdown__menu dropdown-menu">
                              <div class="custom-dropdown__options">
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="966+"
                                  data-selected="true"
                                >
                                  <span class="custom-dropdown__option-text">966+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="971+"
                                >
                                  <span class="custom-dropdown__option-text">971+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="965+"
                                >
                                  <span class="custom-dropdown__option-text">965+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="974+"
                                >
                                  <span class="custom-dropdown__option-text">974+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="973+"
                                >
                                  <span class="custom-dropdown__option-text">973+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="968+"
                                >
                                  <span class="custom-dropdown__option-text">968+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="20+"
                                >
                                  <span class="custom-dropdown__option-text">20+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="1+"
                                >
                                  <span class="custom-dropdown__option-text">1+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <input
                          type="text"
                          class="form-field__input ltr-num"
                           placeholder="{{ __('company.common.59') }}"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-field">
                      <label class="form-field__label">{{ __('company.common.395') }}</label>
                      <div class="phone-input-group">
                        <div class="phone-input-group__code">
                          <div class="custom-dropdown" id="countryCodeGeneralDropdown">
                            <select id="countryCodeGeneralSelect" style="display: none">
                              <option value="966+" selected>966+</option>
                              <option value="971+">971+</option>
                              <option value="965+">965+</option>
                              <option value="974+">974+</option>
                              <option value="973+">973+</option>
                              <option value="968+">968+</option>
                              <option value="20+">20+</option>
                              <option value="1+">1+</option>
                            </select>
                            <button
                              type="button"
                              class="custom-dropdown__trigger filter-dropdown-btn"
                              aria-expanded="false"
                            >
                              <span class="custom-dropdown__selected">
                                <span class="custom-dropdown__text">966+</span>
                              </span>
                              <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                            </button>
                            <div class="custom-dropdown__menu dropdown-menu">
                              <div class="custom-dropdown__options">
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="966+"
                                  data-selected="true"
                                >
                                  <span class="custom-dropdown__option-text">966+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="971+"
                                >
                                  <span class="custom-dropdown__option-text">971+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="965+"
                                >
                                  <span class="custom-dropdown__option-text">965+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="974+"
                                >
                                  <span class="custom-dropdown__option-text">974+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="973+"
                                >
                                  <span class="custom-dropdown__option-text">973+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="968+"
                                >
                                  <span class="custom-dropdown__option-text">968+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="20+"
                                >
                                  <span class="custom-dropdown__option-text">20+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="1+"
                                >
                                  <span class="custom-dropdown__option-text">1+</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <input
                          type="text"
                          class="form-field__input ltr-num"
                           placeholder="{{ __('company.common.60') }}"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="edit-office-card" id="sec-location">
              <div class="edit-office-card__header">
                <h5 class="edit-office-card__title">
                  <i class="bi bi-geo-alt"></i>
                  {{ __('company.common.242') }}</h5>
              </div>
              <div class="edit-office-card__body">
                <div class="form-field">
                  <label class="form-field__label"
                    >{{ __('company.common.217') }}<span class="text-danger">*</span></label
                  >
                  <input
                    type="text"
                    class="form-field__input"
                    id="officeAddressInput"
                    value="طريق الامام سعود بن فيصل، العقيق، الرياض 13515، السعودية"
                  />
                </div>

                <div class="checkbox-grid mb-3">
                  <label class="checkbox-option">
                    <input
                      type="checkbox"
                      name="location_type"
                      value="airport_office"
                      id="airportOfficeCheckbox"
                    />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.458') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input
                      type="checkbox"
                      name="location_type"
                      value="train_station"
                      id="trainStationCheckbox"
                    />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.505') }}</span>
                  </label>
                </div>

                
                <div class="form-field mb-3" id="airportOfficeAmenity">
                  <label class="form-field__label"
                    >{{ __('company.common.234') }}<span class="text-danger">*</span></label
                  >
                  <div class="branch-select dropdown">
                    <button
                      type="button"
                      class="branch-select__trigger dropdown-toggle"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                      id="airportSelectTrigger"
                    >
                      <span id="airportSelectLabel">{{ __('company.common.114') }}</span>
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <div
                      class="dropdown-menu branch-select__menu"
                      aria-labelledby="airportSelectTrigger"
                    >
                      <div class="branch-select__search">
                        <input type="text"  placeholder="{{ __('company.common.100') }}" id="airportSearchInput" />
                      </div>
                      <label class="branch-select__option is-all">
                        <input type="checkbox" id="airportSelectAll" /> {{ __('company.common.480') }}</label>
                      <div id="airportOptionsList">
                        <label class="branch-select__option"
                          ><input type="checkbox" value="ruh" /> {{ __('company.common.533') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="jed" /> {{ __('company.common.534') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="dmm" /> {{ __('company.common.535') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="med" /> {{ __('company.common.531') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="aha" /> {{ __('company.common.529') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="taif" /> {{ __('company.common.532') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="ela" /> {{ __('company.common.530') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="tuu" /> {{ __('company.common.536') }}</label
                        >
                      </div>
                    </div>
                  </div>
                </div>

                
                <div class="form-field mb-3" id="trainStationAmenity">
                  <label class="form-field__label"
                    >{{ __('company.common.498') }}<span class="text-danger">*</span></label
                  >
                  <div class="branch-select dropdown">
                    <button
                      type="button"
                      class="branch-select__trigger dropdown-toggle"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                      id="trainSelectTrigger"
                    >
                      <span id="trainSelectLabel">{{ __('company.common.121') }}</span>
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <div
                      class="dropdown-menu branch-select__menu"
                      aria-labelledby="trainSelectTrigger"
                    >
                      <div class="branch-select__search">
                        <input type="text"  placeholder="{{ __('company.common.99') }}" id="trainSearchInput" />
                      </div>
                      <label class="branch-select__option is-all">
                        <input type="checkbox" id="trainSelectAll" /> {{ __('company.common.479') }}</label>
                      <div id="trainOptionsList">
                        <label class="branch-select__option"
                          ><input type="checkbox" value="riyadh" /> {{ __('company.common.500') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="jeddah" /> {{ __('company.common.504') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="makkah" /> {{ __('company.common.507') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="madinah" /> {{ __('company.common.502') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="kaec" /> {{ __('company.common.506') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="dammam" /> {{ __('company.common.499') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="hofuf" /> {{ __('company.common.503') }}</label
                        >
                        <label class="branch-select__option"
                          ><input type="checkbox" value="qassim" /> {{ __('company.common.501') }}</label
                        >
                      </div>
                    </div>
                  </div>
                </div>

                
                <input type="hidden" id="officeLat" name="office_lat" />
                <input type="hidden" id="officeLng" name="office_lng" />

                
                <div class="map-wrapper" id="officeMapWrapper" data-lat="24.78" data-lng="46.68">
                  <div id="officeLocationMap" style="height: 320px; border-radius: 12px"></div>
                </div>
                <p class="service-hint mt-2">
                  <i class="bi bi-info-circle"></i>
                  {{ __('company.common.130') }}</p>
              </div>
            </div>

            
            <div class="edit-office-card mt-4" id="sec-work-hours">
              <div class="edit-office-card__header">
                <h5 class="edit-office-card__title">
                  <i class="bi bi-clock"></i>
                  {{ __('company.common.416') }}</h5>
              </div>
              <div class="edit-office-card__body">
                <div class="schedule-table" id="workHoursTable"></div>
                
              </div>
            </div>

            
            <div class="edit-office-card mt-4" id="sec-delivery-hours">
              <div class="edit-office-card__header">
                <h5 class="edit-office-card__title">
                  <i class="bi bi-clock"></i>
                  {{ __('company.common.415') }}</h5>
              </div>
              <div class="edit-office-card__body">
                <div class="schedule-table" id="deliveryHoursTable"></div>
                
              </div>
            </div>

            
            <div class="row g-4 mt-0" id="sec-notes">
              <div class="col-lg-6">
                <div class="edit-office-card mb-0">
                  <div class="edit-office-card__header">
                    <h5 class="edit-office-card__title">
                      <i class="bi bi-file-earmark-text"></i>
                      {{ __('company.common.551') }}</h5>
                  </div>
                  <div class="edit-office-card__body">
                    <div class="text-editor">
                      <div class="text-editor__toolbar">
                        <button type="button" class="text-editor__btn" title="Bold">
                          <i class="bi bi-type-bold"></i>
                        </button>
                        <button type="button" class="text-editor__btn" title="Italic">
                          <i class="bi bi-type-italic"></i>
                        </button>
                        <button type="button" class="text-editor__btn" title="Underline">
                          <i class="bi bi-type-underline"></i>
                        </button>
                        <div class="text-editor__divider"></div>
                        <button type="button" class="text-editor__btn" title="Unordered List">
                          <i class="bi bi-list-ul"></i>
                        </button>
                        <button type="button" class="text-editor__btn" title="Ordered List">
                          <i class="bi bi-list-ol"></i>
                        </button>
                        <div class="text-editor__divider"></div>
                        <button type="button" class="text-editor__btn" title="Link">
                          <i class="bi bi-link-45deg"></i>
                        </button>
                        <button type="button" class="text-editor__btn" title="Image">
                          <i class="bi bi-image"></i>
                        </button>
                      </div>
                      <div
                        class="text-editor__content"
                        contenteditable="true"
                         placeholder="{{ __('company.common.56') }}"
                      ></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="edit-office-card mb-0">
                  <div class="edit-office-card__header">
                    <h5 class="edit-office-card__title">
                      <i class="bi bi-file-earmark-text"></i>
                      {{ __('company.common.552') }}</h5>
                  </div>
                  <div class="edit-office-card__body">
                    <div class="text-editor">
                      <div class="text-editor__toolbar">
                        <button type="button" class="text-editor__btn" title="Bold">
                          <i class="bi bi-type-bold"></i>
                        </button>
                        <button type="button" class="text-editor__btn" title="Italic">
                          <i class="bi bi-type-italic"></i>
                        </button>
                        <button type="button" class="text-editor__btn" title="Underline">
                          <i class="bi bi-type-underline"></i>
                        </button>
                        <div class="text-editor__divider"></div>
                        <button type="button" class="text-editor__btn" title="Unordered List">
                          <i class="bi bi-list-ul"></i>
                        </button>
                        <button type="button" class="text-editor__btn" title="Ordered List">
                          <i class="bi bi-list-ol"></i>
                        </button>
                        <div class="text-editor__divider"></div>
                        <button type="button" class="text-editor__btn" title="Link">
                          <i class="bi bi-link-45deg"></i>
                        </button>
                        <button type="button" class="text-editor__btn" title="Image">
                          <i class="bi bi-image"></i>
                        </button>
                      </div>
                      <div
                        class="text-editor__content"
                        contenteditable="true"
                         placeholder="{{ __('company.common.57') }}"
                      ></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="edit-office-card mt-4" id="sec-services">
              <div class="edit-office-card__header">
                <h5 class="edit-office-card__title">
                  <i class="bi bi-plus-circle"></i>
                  {{ __('company.common.170') }}</h5>
              </div>
              <div class="edit-office-card__body">
                
                <div class="additional-service-item">
                  <label class="checkbox-option">
                    <input type="checkbox" id="driverService" checked />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.407') }}</span>
                  </label>
                  <div class="service-action" id="driverServiceAction">
                    <div class="pricing-tiers">
                      <div>
                        <label class="form-field__label"
                          >{{ __('company.common.426') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" value="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                      <div>
                        <label class="form-field__label"
                          >{{ __('company.common.424') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" value="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                      <div>
                        <label class="form-field__label"
                          >{{ __('company.common.425') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" value="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                
                <div class="additional-service-item">
                  <label class="checkbox-option">
                    <input type="checkbox" id="childSeatService" checked />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.476') }}</span>
                  </label>
                  <div class="service-action" id="childSeatServiceAction">
                    <div class="pricing-tiers">
                      <div>
                        <label class="form-field__label"
                          >{{ __('company.common.198') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" value="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                      <div>
                        <label class="form-field__label"
                          >{{ __('company.common.193') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" value="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                      <div>
                        <label class="form-field__label"
                          >{{ __('company.common.195') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" value="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                
                <div class="additional-service-item">
                  <label class="checkbox-option">
                    <input type="checkbox" id="airportDelivery" checked />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.348') }}</span>
                  </label>
                  <div class="service-action" id="airportDeliveryAction">
                    <label class="form-field__label"
                      >{{ __('company.common.191') }}<span class="text-danger">*</span></label
                    >
                    <div class="price-input-wrapper" style="max-width: 280px">
                      <input type="text" class="form-field__input ltr-num" value="20" />
                      <span class="price-suffix">{{ __('company.common.406') }}</span>
                    </div>
                  </div>
                </div>

                
                <div class="additional-service-item">
                  <label class="checkbox-option">
                    <input type="checkbox" id="deliveryOnlyService" checked />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.349') }}</span>
                  </label>
                  <p class="service-hint">{{ __('company.common.231') }}</p>

                  <div class="service-action" id="deliveryOnlyServiceAction">
                    <div class="distance-pricing-table" id="distancePricingTable">
                      <div class="distance-pricing-table__head">
                        <span>{{ __('company.common.522') }}</span>
                        <span>{{ __('company.common.427') }}</span>
                        <span></span>
                      </div>

                      <div class="distance-pricing-row">
                        <input type="text" class="form-field__input ltr-num" value="2" readonly />
                        <input type="text" class="form-field__input ltr-num" value="15" />
                      </div>
                      <div class="distance-pricing-row">
                        <input type="text" class="form-field__input ltr-num" value="5" readonly />
                        <input type="text" class="form-field__input ltr-num" value="20" />
                      </div>
                      <div class="distance-pricing-row">
                        <input type="text" class="form-field__input ltr-num" value="7" readonly />
                        <input type="text" class="form-field__input ltr-num" value="30" />
                      </div>
                      <div class="distance-pricing-row">
                        <input type="text" class="form-field__input ltr-num" value="10" readonly />
                        <input type="text" class="form-field__input ltr-num" value="50" />
                      </div>
                      <div class="distance-pricing-row">
                        <input type="text" class="form-field__input ltr-num" value="15" readonly />
                        <input type="text" class="form-field__input ltr-num" value="55" />
                      </div>
                      <div class="distance-pricing-row">
                        <input type="text" class="form-field__input ltr-num" value="20" readonly />
                        <input type="text" class="form-field__input ltr-num" value="60" />
                      </div>
                    </div>
                  </div>
                </div>

                
                <div class="additional-service-item">
                  <label class="checkbox-option">
                    <input type="checkbox" id="additionalService1" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.379') }}</span>
                  </label>
                  <div class="service-action" id="additionalService1Action" style="display: none">
                    <div style="display: flex; gap: 12px; align-items: flex-start; flex-wrap: wrap">
                      <div>
                        <label class="form-field__label">{{ __('company.common.191') }}</label>
                        <div class="price-input-wrapper" style="max-width: 180px">
                          <input type="text" class="form-field__input ltr-num" placeholder="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                      <div>
                        <label class="form-field__label">{{ __('company.common.562') }}</label>
                        <div
                          class="custom-dropdown"
                          id="privateDeliveryRangeDropdown"
                          style="max-width: 180px"
                        >
                          <select id="privateDeliveryRange" style="display: none">
                            <option value="">{{ __('company.common.117') }}</option>
                            <option value="25">{{ __('company.common.17') }}</option>
                            <option value="26">{{ __('company.common.18') }}</option>
                            <option value="27">{{ __('company.common.19') }}</option>
                            <option value="28">{{ __('company.common.20') }}</option>
                            <option value="29">{{ __('company.common.21') }}</option>
                            <option value="30">{{ __('company.common.23') }}</option>
                            <option value="31">{{ __('company.common.25') }}</option>
                            <option value="32">{{ __('company.common.26') }}</option>
                            <option value="33">{{ __('company.common.27') }}</option>
                            <option value="34">{{ __('company.common.28') }}</option>
                            <option value="35">{{ __('company.common.29') }}</option>
                            <option value="36">{{ __('company.common.30') }}</option>
                            <option value="37">{{ __('company.common.31') }}</option>
                            <option value="38">{{ __('company.common.32') }}</option>
                            <option value="39">{{ __('company.common.33') }}</option>
                            <option value="40">{{ __('company.common.36') }}</option>
                          </select>
                          <button
                            type="button"
                            class="custom-dropdown__trigger"
                            aria-expanded="false"
                          >
                            <span class="custom-dropdown__selected">
                              <span class="custom-dropdown__text">{{ __('company.common.117') }}</span>
                            </span>
                            <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                          </button>
                          <div class="custom-dropdown__menu">
                            <div class="custom-dropdown__search">
                              <i class="bi bi-search"></i>
                              <input
                                type="text"
                                 placeholder="{{ __('company.common.262') }}"
                                class="custom-dropdown__search-input"
                              />
                            </div>
                            <div class="custom-dropdown__options">
                              <button type="button" class="custom-dropdown__option" data-value="">
                                <span class="custom-dropdown__option-text">{{ __('company.common.117') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="25">
                                <span class="custom-dropdown__option-text">{{ __('company.common.17') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="26">
                                <span class="custom-dropdown__option-text">{{ __('company.common.18') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="27">
                                <span class="custom-dropdown__option-text">{{ __('company.common.19') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="28">
                                <span class="custom-dropdown__option-text">{{ __('company.common.20') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="29">
                                <span class="custom-dropdown__option-text">{{ __('company.common.21') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="30">
                                <span class="custom-dropdown__option-text">{{ __('company.common.23') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="31">
                                <span class="custom-dropdown__option-text">{{ __('company.common.25') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="32">
                                <span class="custom-dropdown__option-text">{{ __('company.common.26') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="33">
                                <span class="custom-dropdown__option-text">{{ __('company.common.27') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="34">
                                <span class="custom-dropdown__option-text">{{ __('company.common.28') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="35">
                                <span class="custom-dropdown__option-text">{{ __('company.common.29') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="36">
                                <span class="custom-dropdown__option-text">{{ __('company.common.30') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="37">
                                <span class="custom-dropdown__option-text">{{ __('company.common.31') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="38">
                                <span class="custom-dropdown__option-text">{{ __('company.common.32') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="39">
                                <span class="custom-dropdown__option-text">{{ __('company.common.33') }}</span>
                              </button>
                              <button type="button" class="custom-dropdown__option" data-value="40">
                                <span class="custom-dropdown__option-text">{{ __('company.common.36') }}</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            

            
            <div class="edit-office-card mt-4" id="sec-holidays">
              <div class="edit-office-card__header">
                <h5 class="edit-office-card__title">
                  <i class="bi bi-calendar-x"></i>
                  {{ __('company.common.144') }}</h5>
              </div>
              <div class="edit-office-card__body">
                <p class="edit-office-card__desc mb-3">
                  {{ __('company.common.178') }}</p>

                <div class="holiday-row">
                  <label class="checkbox-option">
                    <input type="checkbox" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.74') }}</span>
                  </label>
                  <div class="holiday-row__dates">
                    <span class="holiday-row__date"
                      ><i class="bi bi-calendar-event"></i> {{ __('company.common.555') }}<b class="ltr-num">2025-03-20</b></span
                    >
                    <span class="holiday-row__date"
                      ><i class="bi bi-calendar-x"></i> {{ __('company.common.96') }}<b class="ltr-num">2025-03-25</b></span
                    >
                  </div>
                </div>

                <div class="holiday-row">
                  <label class="checkbox-option">
                    <input type="checkbox" checked />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.73') }}</span>
                  </label>
                  <div class="holiday-row__dates">
                    <span class="holiday-row__date"
                      ><i class="bi bi-calendar-event"></i> {{ __('company.common.555') }}<b class="ltr-num">2026-05-26</b></span
                    >
                    <span class="holiday-row__date"
                      ><i class="bi bi-calendar-x"></i> {{ __('company.common.96') }}<b class="ltr-num">2026-06-01</b></span
                    >
                  </div>
                </div>

                <div class="holiday-row">
                  <label class="checkbox-option">
                    <input type="checkbox" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.72') }}</span>
                  </label>
                  <div class="holiday-row__dates">
                    <span class="holiday-row__date"
                      ><i class="bi bi-calendar-event"></i> {{ __('company.common.555') }}<b class="ltr-num">2024-09-23</b></span
                    >
                    <span class="holiday-row__date"
                      ><i class="bi bi-calendar-x"></i> {{ __('company.common.96') }}<b class="ltr-num">2024-09-23</b></span
                    >
                  </div>
                </div>

                <div class="holiday-row">
                  <label class="checkbox-option">
                    <input type="checkbox" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.75') }}</span>
                  </label>
                  <div class="holiday-row__dates">
                    <span class="holiday-row__date"
                      ><i class="bi bi-calendar-event"></i> {{ __('company.common.555') }}<b class="ltr-num">2024-09-23</b></span
                    >
                    <span class="holiday-row__date"
                      ><i class="bi bi-calendar-x"></i> {{ __('company.common.96') }}<b class="ltr-num">2024-09-23</b></span
                    >
                  </div>
                </div>
              </div>
            </div>

            
            <div class="eo-savebar">
              <button type="button" class="btn btn-outline">
                <i class="bi bi-x-lg"></i> {{ __('company.common.95') }}</button>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check2-circle"></i>
                {{ __('company.common.376') }}</button>
            </div>
          </form>
@endsection

@push('modals')
</main>
        
      

    
@endpush

@push('libs')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
      document.addEventListener('DOMContentLoaded', function () {
        /* ============================================================
         Quick-nav: smooth scroll + scrollspy
      ============================================================= */
        var navLinks = Array.from(document.querySelectorAll('#eoQuickNav a'));
        var sections = navLinks.map(function (a) {
          return document.querySelector(a.getAttribute('href'));
        });

        navLinks.forEach(function (link) {
          link.addEventListener('click', function (e) {
            e.preventDefault();
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
              var y = target.getBoundingClientRect().top + window.pageYOffset - 84;
              window.scrollTo({ top: y, behavior: 'smooth' });
            }
          });
        });

        function updateActiveNav() {
          var currentIndex = 0;
          sections.forEach(function (sec, i) {
            if (sec && sec.getBoundingClientRect().top - 100 <= 0) currentIndex = i;
          });
          navLinks.forEach(function (l, i) {
            l.classList.toggle('is-active', i === currentIndex);
          });
        }
        window.addEventListener('scroll', updateActiveNav, { passive: true });
        updateActiveNav();

        /* ============================================================
         Custom Dropdown Menus (Country Code)
      ============================================================= */
        document.querySelectorAll('.custom-dropdown').forEach(function (dropdown) {
          var trigger = dropdown.querySelector('.custom-dropdown__trigger');
          var menu = dropdown.querySelector('.custom-dropdown__menu');
          var select = dropdown.querySelector('select');
          var options = dropdown.querySelectorAll('.custom-dropdown__option');

          // Toggle dropdown
          trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            var isOpen = menu.classList.contains('is-visible');

            // Close all other dropdowns
            document.querySelectorAll('.custom-dropdown__menu.is-visible').forEach(function (m) {
              if (m !== menu) {
                m.classList.remove('is-visible');
                m.closest('.custom-dropdown')
                  .querySelector('.custom-dropdown__trigger')
                  .setAttribute('aria-expanded', 'false');
                m.closest('.custom-dropdown')
                  .querySelector('.custom-dropdown__trigger')
                  .classList.remove('is-open');
              }
            });

            menu.classList.toggle('is-visible');
            trigger.setAttribute('aria-expanded', !isOpen);
            trigger.classList.toggle('is-open', !isOpen);
          });

          // Select option
          options.forEach(function (option) {
            option.addEventListener('click', function (e) {
              e.stopPropagation();
              var value = this.getAttribute('data-value');
              var text = this.querySelector('.custom-dropdown__option-text').textContent;

              // Update select value
              select.value = value;

              // Update trigger display
              dropdown.querySelector('.custom-dropdown__text').textContent = text;

              // Update selected state
              options.forEach(function (opt) {
                opt.removeAttribute('data-selected');
              });
              this.setAttribute('data-selected', 'true');

              // Close dropdown
              menu.classList.remove('is-visible');
              trigger.setAttribute('aria-expanded', 'false');
              trigger.classList.remove('is-open');
            });
          });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function () {
          document.querySelectorAll('.custom-dropdown__menu.is-visible').forEach(function (menu) {
            menu.classList.remove('is-visible');
            menu
              .closest('.custom-dropdown')
              .querySelector('.custom-dropdown__trigger')
              .setAttribute('aria-expanded', 'false');
            menu
              .closest('.custom-dropdown')
              .querySelector('.custom-dropdown__trigger')
              .classList.remove('is-open');
          });
        });

        /* ============================================================
         Custom time-picker dropdown (replaces native <select>)
         — real open/close + selection logic, one open at a time
      ============================================================= */
        function buildTimePicker(selectedValue, iconClass) {
          var items = '';
          for (var h = 0; h < 24; h++) {
            for (var m = 0; m < 60; m += 15) {
              var hh = String(h).padStart(2, '0');
              var mm = String(m).padStart(2, '0');
              var val = hh + ':' + mm;
              items +=
                '<li data-value="' +
                val +
                '"' +
                (val === selectedValue ? ' class="is-selected"' : '') +
                '>' +
                val +
                '</li>';
            }
          }
          return (
            '<div class="time-picker">' +
            '<button type="button" class="time-picker__trigger">' +
            '<i class="bi ' +
            iconClass +
            '"></i>' +
            '<span class="time-picker__value">' +
            selectedValue +
            '</span>' +
            '<i class="bi bi-chevron-down time-picker__chevron"></i>' +
            '</button>' +
            '<div class="time-picker__panel"><ul class="time-picker__list">' +
            items +
            '</ul></div>' +
            '</div>'
          );
        }

        function closeAllTimePickers(except) {
          document.querySelectorAll('.time-picker.is-open').forEach(function (tp) {
            if (tp !== except) {
              tp.classList.remove('is-open');
              var row = tp.closest('.schedule-row');
              if (row) row.classList.remove('has-open-picker');
            }
          });
        }

        // Event delegation on <main> so dynamically-added rows work automatically
        var mainContent = document.getElementById('main-content');

        mainContent.addEventListener('click', function (e) {
          var trigger = e.target.closest('.time-picker__trigger');
          if (trigger) {
            var picker = trigger.closest('.time-picker');
            var wasOpen = picker.classList.contains('is-open');
            closeAllTimePickers();
            if (!wasOpen) {
              picker.classList.add('is-open');
              var row = picker.closest('.schedule-row');
              if (row) row.classList.add('has-open-picker');
              var selected = picker.querySelector('.time-picker__list li.is-selected');
              if (selected) selected.scrollIntoView({ block: 'nearest' });
            }
            e.stopPropagation();
            return;
          }

          var option = e.target.closest('.time-picker__list li');
          if (option) {
            var pickerEl = option.closest('.time-picker');
            pickerEl.querySelectorAll('li').forEach(function (li) {
              li.classList.remove('is-selected');
            });
            option.classList.add('is-selected');
            pickerEl.querySelector('.time-picker__value').textContent =
              option.getAttribute('data-value');
            pickerEl.classList.remove('is-open');
            var parentRow = pickerEl.closest('.schedule-row');
            if (parentRow) parentRow.classList.remove('has-open-picker');
            e.stopPropagation();
            return;
          }

          // click anywhere else closes any open picker
          closeAllTimePickers();
        });

        /* ============================================================
         Generate the 7-day schedule rows (working + delivery hours)
      ============================================================= */
        var DAYS = [
          { key: 'sun', label: 'Sun' },
          { key: 'mon', label: 'Mon' },
          { key: 'tue', label: 'Tue' },
          { key: 'wed', label: 'Wed' },
          { key: 'thu', label: 'Thu' },
          { key: 'fri', label: 'Fri' },
          { key: 'sat', label: 'Sat' },
        ];

        function buildScheduleRow(day, fromVal, toVal, enabled) {
          var row = document.createElement('div');
          row.className = 'schedule-row' + (enabled ? '' : ' is-off');
          row.setAttribute('data-day', day.key);
          row.innerHTML =
            '<div class="day-toggle">' +
            '<label class="day-toggle__switch"><input type="checkbox" ' +
            (enabled ? 'checked' : '') +
            ' data-day-toggle><span class="day-toggle__track"></span></label>' +
            '<span class="day-badge">' +
            day.label +
            '</span>' +
            '</div>' +
            '<div class="schedule-row__time"><label>من</label>' +
            buildTimePicker(fromVal, 'bi-sun') +
            '</div>' +
            '<span class="schedule-row__sep"><i class="bi bi-arrow-left"></i></span>' +
            '<div class="schedule-row__time"><label>إلى</label>' +
            buildTimePicker(toVal, 'bi-moon-stars') +
            '</div>' +
            '<div class="schedule-row__actions">' +
            '<button type="button" class="schedule-icon-btn" data-add-range title="إضافة فترة إضافية لهذا اليوم"><i class="bi bi-plus-lg"></i></button>' +
            '</div>';
          return row;
        }

        function wireAddRange(container) {
          container.querySelectorAll('[data-add-range]').forEach(function (btn) {
            if (btn.dataset.wired) return;
            btn.dataset.wired = '1';
            btn.addEventListener('click', function () {
              var parentRow = this.closest('.schedule-row');
              var extra = document.createElement('div');
              extra.className = 'schedule-row schedule-extra-row';
              extra.innerHTML =
                '<div class="schedule-row__time"><label>من</label>' +
                buildTimePicker('14:00', 'bi-sun') +
                '</div>' +
                '<span class="schedule-row__sep"><i class="bi bi-arrow-left"></i></span>' +
                '<div class="schedule-row__time"><label>إلى</label>' +
                buildTimePicker('18:00', 'bi-moon-stars') +
                '</div>' +
                '<div class="schedule-row__actions">' +
                '<button type="button" class="schedule-icon-btn schedule-icon-btn--danger" data-remove-range title="حذف هذه الفترة"><i class="bi bi-dash-lg"></i></button>' +
                '</div>';
              parentRow.insertAdjacentElement('afterend', extra);
              extra.querySelector('[data-remove-range]').addEventListener('click', function () {
                extra.remove();
              });
            });
          });
        }

        var workHoursTable = document.getElementById('workHoursTable');
        var workDefaults = {
          sun: ['08:00', '22:45'],
          mon: ['08:00', '22:45'],
          tue: ['08:00', '22:45'],
          wed: ['08:00', '22:45'],
          thu: ['08:00', '22:45'],
          fri: ['15:15', '22:45'],
          sat: ['08:00', '22:45'],
        };
        DAYS.forEach(function (day) {
          workHoursTable.appendChild(
            buildScheduleRow(day, workDefaults[day.key][0], workDefaults[day.key][1], true),
          );
        });
        wireAddRange(workHoursTable);

        var deliveryHoursTable = document.getElementById('deliveryHoursTable');
        if (deliveryHoursTable) {
          var deliveryDefaults = {
            sun: ['09:00', '22:00'],
            mon: ['09:00', '22:00'],
            tue: ['09:00', '22:00'],
            wed: ['09:00', '22:00'],
            thu: ['09:00', '22:00'],
            fri: ['09:00', '17:00'],
            sat: ['09:00', '22:00'],
          };
          DAYS.forEach(function (day) {
            deliveryHoursTable.appendChild(
              buildScheduleRow(
                day,
                deliveryDefaults[day.key][0],
                deliveryDefaults[day.key][1],
                true,
              ),
            );
          });
          wireAddRange(deliveryHoursTable);
        }

        /* Day on/off toggle dims the row and disables its pickers */
        mainContent.addEventListener('change', function (e) {
          if (e.target.matches('[data-day-toggle]')) {
            e.target.closest('.schedule-row').classList.toggle('is-off', !e.target.checked);
          }
        });

        /* ============================================================
         Additional service checkboxes show/hide their action block
      ============================================================= */
        var serviceCheckboxes = document.querySelectorAll(
          '.additional-service-item > .checkbox-option > input[type="checkbox"]',
        );
        serviceCheckboxes.forEach(function (checkbox) {
          var actionDiv = checkbox
            .closest('.additional-service-item')
            .querySelector('.service-action');
          if (checkbox.checked && actionDiv) actionDiv.style.display = 'block';
          checkbox.addEventListener('change', function () {
            if (actionDiv) actionDiv.style.display = this.checked ? 'block' : 'none';
            // Clear private delivery range when service is disabled
            if (!this.checked && this.id === 'additionalService1') {
              var rangeSelect = document.getElementById('privateDeliveryRange');
              var rangeDropdown = document.getElementById('privateDeliveryRangeDropdown');
              if (rangeSelect) rangeSelect.value = '';
              if (rangeDropdown) {
                var triggerText = rangeDropdown.querySelector('.custom-dropdown__text');
                if (triggerText) triggerText.textContent = 'اختر النطاق';
                var options = rangeDropdown.querySelectorAll('.custom-dropdown__option');
                options.forEach(function (opt) {
                  opt.removeAttribute('data-selected');
                });
                var firstOption = rangeDropdown.querySelector(
                  '.custom-dropdown__option[data-value=""]',
                );
                if (firstOption) firstOption.setAttribute('data-selected', 'true');
              }
            }
          });
        });

        /* ============================================================
         Distance pricing rows: delete + add
      ============================================================= */
        var distanceTable = document.getElementById('distancePricingTable');

        function wireDeleteRow(row) {
          row.querySelector('.distance-pricing-row__delete').addEventListener('click', function () {
            row.remove();
          });
        }
        distanceTable.querySelectorAll('.distance-pricing-row').forEach(wireDeleteRow);

        /* ============================================================
         "Same as company" collapsible blocks (bank + logo)
      ============================================================= */
        document.querySelectorAll('[data-collapse-target]').forEach(function (toggle) {
          var block = document.getElementById(toggle.getAttribute('data-collapse-target'));
          function sync() {
            block.classList.toggle('is-collapsed', toggle.checked);
          }
          sync();
          toggle.addEventListener('change', sync);
        });

        /* ============================================================
         Office logo dropzone preview (click + drag & drop)
      ============================================================= */
        var officeLogoInput = document.getElementById('officeLogoUpload');
        var officeLogoDropzone = document.getElementById('officeLogoDropzone');
        var officeLogoPreview = document.getElementById('officeLogoPreview');
        var officeLogoFileName = document.getElementById('officeLogoFileName');

        if (officeLogoInput && officeLogoDropzone && officeLogoPreview && officeLogoFileName) {
          var setOfficeLogo = function (file) {
            if (!file) return;
            officeLogoFileName.textContent = file.name;
            var reader = new FileReader();
            reader.onload = function (e) {
              officeLogoPreview.innerHTML =
                '<img src="' + e.target.result + '" alt="logo preview">';
            };
            reader.readAsDataURL(file);
          };
          officeLogoInput.addEventListener('change', function () {
            setOfficeLogo(this.files[0]);
          });
          ['dragover', 'dragleave', 'drop'].forEach(function (evt) {
            officeLogoDropzone.addEventListener(evt, function (e) {
              e.preventDefault();
              this.style.borderColor = evt === 'dragover' ? 'var(--secondary)' : '';
              if (evt === 'drop' && e.dataTransfer.files.length) {
                officeLogoInput.files = e.dataTransfer.files;
                setOfficeLogo(e.dataTransfer.files[0]);
              }
            });
          });
        }

        /* ============================================================
         Commercial register file replace + preview/remove actions
      ============================================================= */
        var crInput = document.getElementById('crFileUpload');
        var crFileNameLabel = document.getElementById('crFileNameLabel');
        var crPreview = document.getElementById('crFilePreview');
        crInput.addEventListener('change', function () {
          var file = this.files[0];
          if (!file) return;
          crFileNameLabel.textContent = file.name;
          if (file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function (e) {
              crPreview.innerHTML = '<img src="' + e.target.result + '" alt="cr preview">';
            };
            reader.readAsDataURL(file);
          }
        });

        document.querySelector('.file-action-link--remove').addEventListener('click', function () {
          crInput.value = '';
          crFileNameLabel.textContent = 'لم يتم اختيار أي ملف';
          crPreview.innerHTML = '<i class="bi bi-file-earmark-pdf"></i>';
        });

        document.querySelector('.file-action-link--view').addEventListener('click', function () {
          if (crInput.files[0]) {
            window.open(URL.createObjectURL(crInput.files[0]), '_blank');
          }
        });

        /* ============================================================
         فرع التأجير في المطار / محطة القطار: إظهار قائمة اختيار متعددة
         بالمطارات/المحطات المتاحة عند تفعيل الخيار المقابل
      ============================================================= */
        function initLocationAmenitySelect(cfg) {
          var checkbox = document.getElementById(cfg.checkboxId);
          var panel = document.getElementById(cfg.panelId);
          var allCheckbox = document.getElementById(cfg.allId);
          var list = document.getElementById(cfg.listId);
          var label = document.getElementById(cfg.labelId);
          var searchInput = document.getElementById(cfg.searchId);
          if (!checkbox || !panel || !list || !label) return;

          function syncPanelVisibility() {
            panel.style.display = checkbox.checked ? '' : 'none';
          }
          checkbox.addEventListener('change', syncPanelVisibility);
          syncPanelVisibility();

          var optionCheckboxes = Array.prototype.slice.call(
            list.querySelectorAll('input[type="checkbox"]'),
          );

          function updateLabel() {
            var checked = optionCheckboxes.filter(function (cb) {
              return cb.checked;
            });
            if (checked.length === 0) {
              label.textContent = cfg.emptyLabel;
            } else if (checked.length === optionCheckboxes.length) {
              label.textContent = cfg.allLabel;
            } else if (checked.length === 1) {
              label.textContent = checked[0].closest('.branch-select__option').textContent.trim();
            } else {
              label.textContent = checked.length + ' ' + cfg.countSuffix;
            }
          }

          if (allCheckbox) {
            allCheckbox.addEventListener('change', function () {
              optionCheckboxes.forEach(function (cb) {
                cb.checked = allCheckbox.checked;
              });
              updateLabel();
            });
          }

          optionCheckboxes.forEach(function (cb) {
            cb.addEventListener('change', function () {
              if (allCheckbox) {
                allCheckbox.checked = optionCheckboxes.every(function (c) {
                  return c.checked;
                });
              }
              updateLabel();
            });
          });

          if (searchInput) {
            searchInput.addEventListener('input', function () {
              var q = searchInput.value.trim().toLowerCase();
              list.querySelectorAll('.branch-select__option').forEach(function (opt) {
                var text = opt.textContent.trim().toLowerCase();
                opt.style.display = text.indexOf(q) !== -1 ? '' : 'none';
              });
            });
          }

          // منع إغلاق الـ dropdown عند الضغط جوه القائمة (بحث/تشك بوكسات)
          var menu = list.closest('.branch-select__menu');
          if (menu) {
            menu.addEventListener('click', function (e) {
              e.stopPropagation();
            });
          }

          updateLabel();
        }

        initLocationAmenitySelect({
          checkboxId: 'airportOfficeCheckbox',
          panelId: 'airportOfficeAmenity',
          allId: 'airportSelectAll',
          listId: 'airportOptionsList',
          labelId: 'airportSelectLabel',
          searchId: 'airportSearchInput',
          emptyLabel: 'اختر المطارات',
          allLabel: 'كل المطارات',
          countSuffix: 'مطارات محددة',
        });

        initLocationAmenitySelect({
          checkboxId: 'trainStationCheckbox',
          panelId: 'trainStationAmenity',
          allId: 'trainSelectAll',
          listId: 'trainOptionsList',
          labelId: 'trainSelectLabel',
          searchId: 'trainSearchInput',
          emptyLabel: 'اختر محطات القطار',
          allLabel: 'كل المحطات',
          countSuffix: 'محطات محددة',
        });

        /* ============================================================
         خريطة موقع الفرع — Pin قابل للسحب + Reverse Geocoding
         يعرض علامة على موقع الفرع المحفوظ (data-lat / data-lng على
         officeMapWrapper). سحب العلامة أو الضغط على الخريطة يحدّث
         حقل العنوان تلقائيًا، ويحدّث الحقول المخفية officeLat/officeLng
         التي تُرسَل مع الفورم عند الحفظ.
      ============================================================= */
        (function initOfficeLocationMap() {
          var wrapper = document.getElementById('officeMapWrapper');
          var mapEl = document.getElementById('officeLocationMap');
          var addressInput = document.getElementById('officeAddressInput');
          var latField = document.getElementById('officeLat');
          var lngField = document.getElementById('officeLng');
          if (!wrapper || !mapEl || typeof L === 'undefined') return;

          // TODO: هذه القيم الافتراضية لازم تتغير من الباك إند بإحداثيات
          // الفرع الفعلية المحفوظة، بدل القيم الثابتة دي.
          var savedLat = parseFloat(wrapper.getAttribute('data-lat')) || 24.7136;
          var savedLng = parseFloat(wrapper.getAttribute('data-lng')) || 46.6753;

          var map = L.map(mapEl).setView([savedLat, savedLng], 15);

          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution:
              '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
          }).addTo(map);

          var marker = L.marker([savedLat, savedLng], { draggable: true }).addTo(map);

          var geocodeTimeout = null;
          function reverseGeocode(lat, lng) {
            if (!addressInput) return;
            clearTimeout(geocodeTimeout);
            addressInput.classList.add('is-loading');

            geocodeTimeout = setTimeout(function () {
              fetch(
                'https://nominatim.openstreetmap.org/reverse?format=json&lat=' +
                  lat +
                  '&lon=' +
                  lng +
                  '&accept-language=ar',
              )
                .then(function (res) {
                  return res.json();
                })
                .then(function (data) {
                  if (data && data.display_name) {
                    addressInput.value = data.display_name;
                  }
                })
                .catch(function () {
                  /* تجاهل الخطأ، خلي العنوان الحالي زي ما هو */
                })
                .finally(function () {
                  addressInput.classList.remove('is-loading');
                });
            }, 400);
          }

          function moveMarkerTo(latlng) {
            marker.setLatLng(latlng);
            wrapper.setAttribute('data-lat', latlng.lat);
            wrapper.setAttribute('data-lng', latlng.lng);
            if (latField) latField.value = latlng.lat;
            if (lngField) lngField.value = latlng.lng;
            reverseGeocode(latlng.lat, latlng.lng);
          }

          marker.on('dragend', function () {
            moveMarkerTo(marker.getLatLng());
          });

          map.on('click', function (e) {
            moveMarkerTo(e.latlng);
          });

          // الخريطة جوه form-field مخفي جزئيًا وقت التحميل (لسه ماتلفتش
          // فوكس المستخدم للقسم)، فبنعمل invalidateSize بعد شوية عشان
          // Leaflet يحسب أبعادها صح.
          setTimeout(function () {
            map.invalidateSize();
          }, 200);

          // لو تغيّر حجم الشاشة أو انفتح/اتقفل السايدبار، تأكدي إن
          // الخريطة اتظبطت برضه.
          window.addEventListener('resize', function () {
            map.invalidateSize();
          });
        })();

        /* ============================================================
         Form submit (demo only)
      ============================================================= */
        document.getElementById('editOfficeForm').addEventListener('submit', function (e) {
          e.preventDefault();
        });
      });
    </script>
@endpush

