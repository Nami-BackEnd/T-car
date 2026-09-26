@extends('company.layouts.master')

@section('title', 'T-Car — إضافة سيارة')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.85') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('company.office-cars', request()->only('branch')) }}">{{ __('company.cars.list_title') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.common.85') }}</span>
              </nav>
            </div>
          </div>

          
          <div class="eo-quicknav-wrap">
            <ul class="eo-quicknav" id="ecQuickNav">
              <li>
                <a href="#sec-car-details" class="is-active"
                  ><i class="bi bi-car-front"></i> {{ __('company.common.314') }}</a
                >
              </li>
              <li>
                <a href="#sec-pricing"><i class="bi bi-tags"></i> {{ __('company.common.158') }}</a>
              </li>
              <li>
                <a href="#sec-monthly-driver"><i class="bi bi-person-badge"></i> {{ __('company.common.211') }}</a>
              </li>
              <li>
                <a href="#sec-subscription"><i class="bi bi-repeat"></i> {{ __('company.common.151') }}</a>
              </li>
              <li>
                <a href="#sec-specs"><i class="bi bi-list-check"></i> {{ __('company.common.240') }}</a>
              </li>
              <li>
                <a href="#sec-details"><i class="bi bi-file-earmark-text"></i> {{ __('company.common.311') }}</a>
              </li>
            </ul>
          </div>

          <form
            id="editCarForm"
            data-car-form
            data-options-url="{{ route('company.add-car.options') }}"
            data-store-url="{{ route('company.add-car.store') }}"
            data-show-url="{{ route('company.edit-car.show', ['car' => 0]) }}"
            data-update-url="{{ route('company.edit-car.update', ['car' => 0]) }}"
            enctype="multipart/form-data"
          >
            
            <div class="edit-car-card" id="sec-car-details">
              <div class="edit-car-card__header">
                <h5 class="edit-car-card__title"><i class="bi bi-car-front"></i> {{ __('company.common.314') }}</h5>
              </div>
              <div class="edit-car-card__body">
                <div class="form-grid">
                  <div class="form-field car-image-field">
                    <label class="form-field__label" for="carImageInput">{{ __('company.common.436') }}</label>
                    <div
                      class="car-image-uploader"
                      data-car-image-uploader
                      data-car-image-key="new-car-draft"
                    >
                      <div class="car-image-uploader__preview-wrap">
                        <img
                          class="car-image-uploader__preview"
                          data-car-image-preview
                          src="{{ asset('company/img/car.png') }}"
                           alt="{{ __('company.pages.add-car.1') }}"
                        />
                        <div class="car-image-uploader__actions">
                          <label
                            class="car-image-uploader__icon-btn car-image-uploader__icon-btn--add"
                            for="carImageInput"
                            data-car-image-add
                             title="{{ __('company.common.86') }}"
                             aria-label="{{ __('company.common.86') }}"
                          >
                            <i class="bi bi-plus-lg"></i>
                          </label>
                          <label
                            class="car-image-uploader__icon-btn car-image-uploader__icon-btn--edit"
                            for="carImageInput"
                            data-car-image-edit
                             title="{{ __('company.common.310') }}"
                             aria-label="{{ __('company.common.310') }}"
                          >
                            <i class="bi bi-pencil"></i>
                          </label>
                          <button
                            type="button"
                            class="car-image-uploader__icon-btn car-image-uploader__icon-btn--delete"
                            data-car-image-remove
                             title="{{ __('company.common.371') }}"
                             aria-label="{{ __('company.common.371') }}"
                          >
                            <i class="bi bi-trash"></i>
                          </button>
                        </div>
                      </div>
                      <div class="car-image-uploader__content">
                        
                      </div>
                      <input
                        id="carImageInput"
                        type="file"
                        accept="image/png,image/jpeg,image/webp"
                        data-car-image-input
                        hidden
                      />
                    </div>
                  </div>

                  <div class="form-field">
                    <label class="form-field__label"
                      >{{ __('company.common.221') }}<span class="text-danger">*</span></label
                    >
                    <div class="custom-dropdown" id="branchesDropdown">
                      <select id="branchesSelect" name="branch_ids[]" style="display: none" multiple>
                        <option value="all" selected>{{ __('company.common.223') }}</option>
                      </select>
                      <button type="button" class="custom-dropdown__trigger" aria-expanded="false">
                        <span class="custom-dropdown__selected">
                          <span class="custom-dropdown__icon"><i class="bi bi-buildings"></i></span>
                          <span class="custom-dropdown__text">{{ __('company.common.223') }}</span>
                        </span>
                        <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                      </button>
                      <div class="custom-dropdown__menu">
                        <div class="custom-dropdown__search">
                          <i class="bi bi-search"></i>
                          <input
                            type="text"
                             placeholder="{{ __('company.common.258') }}"
                            class="custom-dropdown__search-input"
                          />
                        </div>
                        <div class="custom-dropdown__options" data-branch-options>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="all"
                            data-selected="true"
                          >
                            <span class="custom-dropdown__option-text">{{ __('company.common.223') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-field">
                    <label class="form-field__label"
                      >{{ __('company.common.207') }}<span class="text-danger">*</span></label
                    >
                    <div class="custom-dropdown" id="makeDropdown">
                      <select id="makeSelect" name="car_brand_id" style="display: none" required>
                        <option value="">{{ __('company.common.108') }}</option>
                      </select>
                      <button type="button" class="custom-dropdown__trigger" aria-expanded="false">
                        <span class="custom-dropdown__selected">
                          <span class="custom-dropdown__icon"
                            ><i class="bi bi-car-front-fill"></i
                          ></span>
                          <span class="custom-dropdown__text">{{ __('company.common.108') }}</span>
                        </span>
                        <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                      </button>
                      <div class="custom-dropdown__menu">
                        <div class="custom-dropdown__search">
                          <i class="bi bi-search"></i>
                          <input
                            type="text"
                             placeholder="{{ __('company.common.256') }}"
                            class="custom-dropdown__search-input"
                          />
                        </div>
                        <div class="custom-dropdown__options" data-options="brands">
                          <span class="custom-dropdown__loading">{{ __('company.messages.loading') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-field">
                    <label class="form-field__label"
                      >{{ __('company.common.571') }}<span class="text-danger">*</span></label
                    >
                    <div class="custom-dropdown" id="carTypeDropdown">
                      <select id="carTypeSelect" style="display: none" required></select>
                      <button type="button" class="custom-dropdown__trigger" aria-expanded="false">
                        <span class="custom-dropdown__selected">
                          <span class="custom-dropdown__icon"><i class="bi bi-tag"></i></span>
                          <span class="custom-dropdown__text">{{ __('company.pages.add-car.0') }}</span>
                        </span>
                        <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                      </button>
                      <div class="custom-dropdown__menu">
                        <div class="custom-dropdown__search">
                          <i class="bi bi-search"></i>
                          <input
                            type="text"
                             placeholder="{{ __('company.common.263') }}"
                            class="custom-dropdown__search-input"
                          />
                        </div>
                        <div class="custom-dropdown__options" data-options="car_types">
                          <span class="custom-dropdown__loading">{{ __('company.messages.loading') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-field">
                    <label class="form-field__label"
                      >{{ __('company.common.241') }}<span class="text-danger">*</span></label
                    >
                    <div class="custom-dropdown" id="modelDropdown">
                      <select id="modelSelect" name="car_model_id" style="display: none" required>
                        <option value="">{{ __('company.common.116') }}</option>
                      </select>
                      <button type="button" class="custom-dropdown__trigger" aria-expanded="false">
                        <span class="custom-dropdown__selected">
                          <span class="custom-dropdown__icon"><i class="bi bi-car-front"></i></span>
                          <span class="custom-dropdown__text">{{ __('company.common.474') }}</span>
                        </span>
                        <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                      </button>
                      <div class="custom-dropdown__menu">
                        <div class="custom-dropdown__search">
                          <i class="bi bi-search"></i>
                          <input
                            type="text"
                             placeholder="{{ __('company.common.261') }}"
                            class="custom-dropdown__search-input"
                          />
                        </div>
                        <div class="custom-dropdown__options" data-options="car_models">
                          <span class="custom-dropdown__loading">{{ __('company.messages.loading') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.201') }}</label>
                    <div class="custom-dropdown" id="yearDropdown">
                      <select id="yearSelect" name="year" style="display: none">
                        <option value="" selected>{{ __('company.common.107') }}</option>
                      </select>
                      <button type="button" class="custom-dropdown__trigger" aria-expanded="false">
                        <span class="custom-dropdown__selected">
                          <span class="custom-dropdown__icon"><i class="bi bi-calendar3"></i></span>
                          <span class="custom-dropdown__text">{{ __('company.common.107') }}</span>
                        </span>
                        <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                      </button>
                      <div class="custom-dropdown__menu">
                        <div class="custom-dropdown__search">
                          <i class="bi bi-search"></i>
                          <input
                            type="text"
                             placeholder="{{ __('company.common.254') }}"
                            class="custom-dropdown__search-input"
                          />
                        </div>
                        <div class="custom-dropdown__options" data-options="years">
                          <span class="custom-dropdown__loading">{{ __('company.messages.loading') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="edit-car-card" id="sec-pricing">
              <div class="edit-car-card__header">
                <h5 class="edit-car-card__title"><i class="bi bi-tags"></i> {{ __('company.common.158') }}</h5>
              </div>
              <div class="edit-car-card__body">
                <div class="price-toggle-row">
                  <label class="checkbox-option">
                    <input type="checkbox" id="dailyWeeklyToggle" checked />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.319') }}</span>
                  </label>
                </div>

                <div id="dailyWeeklyBlocks">
                  
                  <div class="price-block">
                    <h6 class="price-block__title">{{ __('company.common.197') }}</h6>
                    <div class="price-block__grid">
                      <div class="form-field">
                        <label class="form-field__label"
                          >{{ __('company.common.191') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" data-pricing="day_price" placeholder="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                      <div class="form-field">
                        <label class="form-field__label"
                          >{{ __('company.common.196') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" data-pricing="day_lowest_price" value="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  
                  <div class="price-block">
                    <h6 class="price-block__title">{{ __('company.common.192') }}</h6>
                    <div class="price-block__grid">
                      <div class="form-field">
                        <label class="form-field__label"
                          >{{ __('company.common.191') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" data-pricing="week_price" placeholder="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                      <div class="form-field">
                        <label class="form-field__label"
                          >{{ __('company.common.196') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" data-pricing="week_lowest_price" value="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  
                  <div class="price-block">
                    <h6 class="price-block__title">{{ __('company.cars.free_km') }}</h6>
                    <div class="price-block__grid">
                      <div class="form-field">
                        <label class="form-field__label"
                          >{{ __('company.cars.free_km') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" data-pricing="free_km" value="0" />
                          <span class="price-suffix">{{ __('company.cars.unit_km') }}</span>
                        </div>
                      </div>
                      <div class="form-field">
                        <label class="form-field__label"
                          >{{ __('company.cars.free_km_price') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" data-pricing="free_km_price" value="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="edit-car-card" id="sec-monthly-driver">
              <div class="col-lg-12">
                <div class="edit-car-card mb-0 h-100">
                  <div class="edit-car-card__header">
                    <h5 class="edit-car-card__title">
                      <i class="bi bi-calendar3"></i> {{ __('company.common.194') }}</h5>
                  </div>
                  <div class="edit-car-card__body">
                    <div class="price-block" style="padding-top: 0; border-bottom: none">
                      <div class="price-block__grid">
                        <div class="form-field">
                          <label class="form-field__label"
                            >{{ __('company.common.191') }}<span class="text-danger">*</span></label
                          >
                          <div class="price-input-wrapper">
                            <input type="text" class="form-field__input ltr-num" data-pricing="month_price" placeholder="0" />
                            <span class="price-suffix">{{ __('company.common.406') }}</span>
                          </div>
                        </div>
                        <div class="form-field">
                          <label class="form-field__label"
                            >{{ __('company.common.196') }}<span class="text-danger">*</span></label
                          >
                          <div class="price-input-wrapper">
                            <input type="text" class="form-field__input ltr-num" data-pricing="month_lowest_price" value="0" />
                            <span class="price-suffix">{{ __('company.common.406') }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div id="sec-subscription">
              
              <div class="edit-car-card">
                <div class="edit-car-card__header">
                  <h5 class="edit-car-card__title"><i class="bi bi-repeat"></i> {{ __('company.common.318') }}</h5>
                </div>
                <div class="edit-car-card__body">
                  <label class="checkbox-option">
                    <input type="checkbox" id="subscriptionToggle" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.567') }}</span>
                  </label>
                  

                  <p class="subscription-note">
                    <i class="bi bi-info-circle"></i>
                    {{ __('company.common.450') }}</p>

                  <div id="subscriptionTiersWrap" style="display: none">
                    <div id="subscriptionTiersList">
                      
                      <div class="subscription-tier-row" data-tier-row>
                        <div class="form-field subscription-tier-row__duration">
                          <label class="form-field__label"
                            >{{ __('company.common.511') }}<span class="text-danger">*</span></label
                          >
                          <div class="custom-dropdown" data-duration-dropdown>
                            <select style="display: none" data-duration-select>
                              <option value="">{{ __('company.common.112') }}</option>
                            </select>
                            <button
                              type="button"
                              class="custom-dropdown__trigger"
                              aria-expanded="false"
                            >
                              <span class="custom-dropdown__selected">
                                <span class="custom-dropdown__icon"
                                  ><i class="bi bi-calendar3-range"></i
                                ></span>
                                <span class="custom-dropdown__text">{{ __('company.common.112') }}</span>
                              </span>
                              <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                            </button>
                            <div class="custom-dropdown__menu">
                              <div class="custom-dropdown__options" data-duration-options>
                                <span class="custom-dropdown__loading">{{ __('company.messages.loading') }}</span>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-field subscription-tier-row__price">
                          <label class="form-field__label"
                            >{{ __('company.common.191') }}<span class="text-danger">*</span></label
                          >
                          <div class="price-input-wrapper">
                            <input type="text" class="form-field__input ltr-num" placeholder="0" />
                            <span class="price-suffix">{{ __('company.common.406') }}</span>
                          </div>
                        </div>

                        <div class="form-field subscription-tier-row__price">
                          <label class="form-field__label"
                            >{{ __('company.common.196') }}<span class="text-danger">*</span></label
                          >
                          <div class="price-input-wrapper">
                            <input type="text" class="form-field__input ltr-num" value="0" />
                            <span class="price-suffix">{{ __('company.common.406') }}</span>
                          </div>
                        </div>

                        <button
                          type="button"
                          class="tier-remove-btn"
                          data-remove-tier
                           aria-label="{{ __('company.common.372') }}"
                        >
                          <i class="bi bi-trash"></i>
                        </button>
                      </div>
                    </div>

                    <button type="button" class="btn-add-tier" id="addSubscriptionTierBtn">
                      <i class="bi bi-plus-circle"></i> {{ __('company.common.88') }}</button>
                  </div>
                </div>
              </div>

              
              <div class="edit-car-card mt-4">
                <div class="edit-car-card__header">
                  <h5 class="edit-car-card__title">
                    <i class="bi bi-plus-circle"></i> {{ __('company.common.378') }}</h5>
                </div>
                <div class="edit-car-card__body">
                  <div class="form-grid">
                    <div class="form-field">
                      <label class="form-field__label">{{ __('company.common.484') }}</label>
                      <input type="text" class="form-field__input ltr-num" placeholder="0" />
                    </div>
                    <div class="form-field">
                      <label class="form-field__label">{{ __('company.common.200') }}</label>
                      <div class="price-input-wrapper">
                        <input type="text" class="form-field__input ltr-num" placeholder="0" />
                        <span class="price-suffix">{{ __('company.common.406') }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="checkbox-list" data-car-services>
                    <span class="custom-dropdown__loading">{{ __('company.messages.loading') }}</span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="edit-car-card mt-4" id="sec-specs">
              <div class="edit-car-card__header">
                <h5 class="edit-car-card__title">
                  <i class="bi bi-list-check"></i> {{ __('company.common.557') }}</h5>
              </div>
              <div class="edit-car-card__body">
                <div class="form-grid">
                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.213') }}</label>
                    <div class="custom-dropdown" id="fuelDropdown">
                      <select id="fuelSelect" name="power" style="display: none">
                        <option value="">{{ __('company.common.386') }}</option>
                      </select>
                      <button type="button" class="custom-dropdown__trigger" aria-expanded="false">
                        <span class="custom-dropdown__selected">
                          <span class="custom-dropdown__icon"
                            ><i class="bi bi-fuel-pump-fill"></i
                          ></span>
                          <span class="custom-dropdown__text">{{ __('company.common.386') }}</span>
                        </span>
                        <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                      </button>
                      <div class="custom-dropdown__menu">
                        <div class="custom-dropdown__options" data-options="power_labels">
                          <span class="custom-dropdown__loading">{{ __('company.messages.loading') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.440') }}</label>
                    <div class="custom-dropdown" id="doorsDropdown">
                      <select id="doorsSelect" name="door_count" style="display: none">
                        <option value="">{{ __('company.common.440') }}</option>
                      </select>
                      <button type="button" class="custom-dropdown__trigger" aria-expanded="false">
                        <span class="custom-dropdown__selected">
                          <span class="custom-dropdown__icon"
                            ><i class="bi bi-door-closed-fill"></i
                          ></span>
                          <span class="custom-dropdown__text">{{ __('company.common.440') }}</span>
                        </span>
                        <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                      </button>
                      <div class="custom-dropdown__menu">
                        <div class="custom-dropdown__options" data-options="door_counts">
                          <span class="custom-dropdown__loading">{{ __('company.messages.loading') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="checkbox-list">
                  <label class="checkbox-option">
                    <input type="checkbox" name="has_navigation" value="1" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.549') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" name="has_bluetooth" value="1" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.270') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" name="has_panorama" value="1" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.252') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" name="has_usp" value="1" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.593') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" name="has_background_camera" value="1" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.475') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" name="has_sensors" value="1" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.373') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" name="has_apple_play" value="1" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.101') }}</span>
                  </label>
                </div>
              </div>
            </div>

            
            <div class="edit-car-card" id="sec-details">
              <div class="edit-car-card__header">
                <h5 class="edit-car-card__title"><i class="bi bi-file-earmark-text"></i> {{ __('company.common.311') }}</h5>
              </div>
              <div class="edit-car-card__body">
                
                <div class="branch-units">
                  <div class="branch-units__title">
                    <i class="bi bi-buildings"></i>
                    {{ __('company.common.443') }}</div>

                  <div class="branch-units__list" data-branch-units-list></div>

                  <div class="branch-units__empty" data-branch-units-empty hidden>
                    {{ __('company.common.120') }}</div>
                </div>

                <div class="form-field total-units-field" style="max-width: 340px">
                  <label class="form-field__label" for="totalAvailableCars"
                    >{{ __('company.common.442') }}<span class="text-danger">*</span></label
                  >
                  <input
                    type="text"
                    class="form-field__input ltr-num"
                    id="totalAvailableCars"
                    name="available_cars_total"
                    data-branch-units-total
                    value="0"
                    readonly
                  />
                  <span class="form-field__hint">
                    {{ __('company.common.146') }}</span>
                </div>

                <div class="form-grid">
                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.237') }}</label>
                    <textarea
                      class="form-field__input"
                      rows="3"
                      name="note_en"
                      placeholder="{{ __('company.cars.note_en_placeholder') }}"
                    ></textarea>
                  </div>
                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.238') }}</label>
                    <textarea
                      class="form-field__input"
                      rows="3"
                      name="note_ar"
                      placeholder="{{ __('company.cars.note_ar_placeholder') }}"
                    ></textarea>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="eo-savebar">
              <button
                type="button"
                class="btn btn-outline"
                style="--x: 43.46250915527344px; --y: 20.949951171875px"
              >
                <i class="bi bi-x-lg"></i> {{ __('company.common.95') }}</button>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check2-circle"></i> {{ __('company.common.375') }}</button>
            </div>
          </form>
@endsection

@include('company.partials.success-modal')

@push('modals')
</main>
@endpush

@push('libs')
<script src="{{ asset('company/js/car-images.js?v=3') }}"></script>
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        /* Quick-nav: smooth scroll + scrollspy */
        var navLinks = Array.from(document.querySelectorAll('#ecQuickNav a'));
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

        /* Custom select-field: sync visible label with the real <select> */
        document.querySelectorAll('[data-select]').forEach(function (wrap) {
          var select = wrap.querySelector('select');
          var valueEl = wrap.querySelector('.select-field__value');

          function sync() {
            var opt = select.options[select.selectedIndex];
            valueEl.textContent = opt ? opt.textContent : '';
            wrap.classList.toggle('select-field--placeholder', !select.value);
          }
          sync();
          select.addEventListener('change', sync);
          select.addEventListener('focus', function () {
            wrap.classList.add('is-focused');
          });
          select.addEventListener('blur', function () {
            wrap.classList.remove('is-focused');
          });
        });

        /* Enable/disable the daily+weekly pricing blocks with the toggle */
        var dwToggle = document.getElementById('dailyWeeklyToggle');
        var dwBlocks = document.getElementById('dailyWeeklyBlocks');
        if (dwToggle && dwBlocks) {
          function syncDW() {
            dwBlocks.style.display = dwToggle.checked ? '' : 'none';
          }
          dwToggle.addEventListener('change', syncDW);
          syncDW();
        }

        /* Custom Dropdown Menus (Manufacturer / Model / Year / Subscription duration...) */
        function initCustomDropdown(dropdown) {
          if (dropdown.dataset.ddInit === '1') return; // avoid double-binding
          dropdown.dataset.ddInit = '1';

          var trigger = dropdown.querySelector('.custom-dropdown__trigger');
          var menu = dropdown.querySelector('.custom-dropdown__menu');
          var searchInput = dropdown.querySelector('.custom-dropdown__search-input');

          if (!trigger || !menu) return;

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

          // Search — queried at event time so options filled from the API are covered too
          if (searchInput) {
            searchInput.addEventListener('input', function () {
              var searchTerm = this.value.toLowerCase();
              dropdown.querySelectorAll('.custom-dropdown__option').forEach(function (option) {
                var node = option.querySelector('.custom-dropdown__option-text');
                var text = node ? node.textContent.toLowerCase() : '';
                option.style.display = text.indexOf(searchTerm) !== -1 ? 'flex' : 'none';
              });
            });

            searchInput.addEventListener('click', function (e) {
              e.stopPropagation();
            });

            searchInput.addEventListener('focus', function (e) {
              e.stopPropagation();
            });

            var searchContainer = dropdown.querySelector('.custom-dropdown__search');
            if (searchContainer) {
              searchContainer.addEventListener('click', function (e) {
                e.stopPropagation();
              });
            }
          }
        }

        document.querySelectorAll('.custom-dropdown').forEach(initCustomDropdown);

        /* ============================================================
         عدد السيارات المتاحة لكل فرع
         - صف لكل فرع مختار + حقل عدد خاص به (الافتراضي 0)
         - «عدد السيارات المتاحة الآن» = مجموع أعداد الفروع (للقراءة فقط)
      ============================================================= */
        var BranchUnits = (function () {
          var ALL_VALUE = 'all';
          var state = {}; // { branchId: count }
          var listEl = document.querySelector('[data-branch-units-list]');
          var emptyEl = document.querySelector('[data-branch-units-empty]');
          var totalInput = document.querySelector('[data-branch-units-total]');
          var dropdownEl = document.getElementById('branchesDropdown');
          var selectEl = document.getElementById('branchesSelect');

          function toCount(value) {
            var number = parseInt(String(value).replace(/[^\d-]/g, ''), 10);
            if (isNaN(number) || number < 0) return 0;
            return number;
          }

          function getSelectedBranches() {
            var branches = [];

            // المصدر الأساسي: أزرار الدروب داون (حالة العرض الفعلية)
            if (dropdownEl) {
              dropdownEl
                .querySelectorAll('.custom-dropdown__option[data-selected]')
                .forEach(function (option) {
                  var id = option.getAttribute('data-value');
                  if (!id || id === ALL_VALUE) return;
                  var textEl = option.querySelector('.custom-dropdown__option-text');
                  branches.push({ id: id, name: textEl ? textEl.textContent.trim() : id });
                });
              if (branches.length) return branches;
            }

            // مصدر احتياطي: <select> المخفي
            if (selectEl) {
              Array.prototype.forEach.call(selectEl.options, function (option) {
                if (!option.selected || option.value === ALL_VALUE) return;
                branches.push({ id: option.value, name: option.textContent.trim() });
              });
            }

            return branches;
          }

          function getValues() {
            var values = {};
            Object.keys(state).forEach(function (id) {
              values[id] = toCount(state[id]);
            });
            return values;
          }

          function getTotal() {
            return Object.keys(state).reduce(function (sum, id) {
              return sum + toCount(state[id]);
            }, 0);
          }

          function updateTotal() {
            var total = getTotal();
            if (totalInput) totalInput.value = String(total);
            document.dispatchEvent(
              new CustomEvent('branchUnitsChanged', {
                detail: { values: getValues(), total: total },
              }),
            );
            return total;
          }

          function readRowsIntoState() {
            if (!listEl) return;
            listEl.querySelectorAll('[data-branch-unit-row]').forEach(function (row) {
              var input = row.querySelector('[data-branch-unit-input]');
              if (input) state[row.dataset.branchId] = toCount(input.value);
            });
          }

          function buildRow(branch) {
            var row = document.createElement('div');
            row.className = 'branch-units__row';
            row.setAttribute('data-branch-unit-row', '');
            row.dataset.branchId = branch.id;

            var name = document.createElement('span');
            name.className = 'branch-units__name';
            name.innerHTML = '<i class="bi bi-buildings"></i>';
            name.appendChild(document.createTextNode(' ' + branch.name));

            var field = document.createElement('div');
            field.className = 'branch-units__field';

            var input = document.createElement('input');
            input.type = 'number';
            input.min = '0';
            input.step = '1';
            input.inputMode = 'numeric';
            input.className = 'form-field__input ltr-num branch-units__input';
            input.setAttribute('data-branch-unit-input', '');
            input.name = 'branch_units[' + branch.id + ']';
            input.value = String(toCount(state[branch.id]));
            input.setAttribute(
              'aria-label',
              @json(__('company.cars.branch_stock_aria')).replace(':branch', branch.name),
            );

            var suffix = document.createElement('span');
            suffix.className = 'branch-units__suffix';
            suffix.textContent = @json(__('company.cars.unit_car'));

            field.appendChild(input);
            field.appendChild(suffix);
            row.appendChild(name);
            row.appendChild(field);
            return row;
          }

          function render() {
            if (!listEl) return;

            readRowsIntoState();

            var branches = getSelectedBranches();
            var selectedIds = branches.map(function (branch) {
              return branch.id;
            });

            // إزالة أعداد الفروع التي لم تعد مختارة
            Object.keys(state).forEach(function (id) {
              if (selectedIds.indexOf(id) === -1) delete state[id];
            });

            // الفرع الجديد يبدأ بصفر
            selectedIds.forEach(function (id) {
              if (typeof state[id] === 'undefined') state[id] = 0;
            });

            listEl.innerHTML = '';
            branches.forEach(function (branch) {
              listEl.appendChild(buildRow(branch));
            });

            if (emptyEl) emptyEl.hidden = branches.length > 0;
            listEl.hidden = branches.length === 0;

            updateTotal();
          }

          function init() {
            if (!listEl) return;

            if (totalInput) {
              totalInput.readOnly = true;
              totalInput.setAttribute('aria-readonly', 'true');
              totalInput.tabIndex = -1;
            }

            listEl.addEventListener('input', function (event) {
              var input = event.target.closest('[data-branch-unit-input]');
              if (!input) return;
              var row = input.closest('[data-branch-unit-row]');
              state[row.dataset.branchId] = toCount(input.value);
              updateTotal();
            });

            // تنظيف القيمة عند الخروج من الحقل (فارغ/غير صالح → 0)
            listEl.addEventListener(
              'blur',
              function (event) {
                var input =
                  event.target.closest && event.target.closest('[data-branch-unit-input]');
                if (!input) return;
                var row = input.closest('[data-branch-unit-row]');
                var count = toCount(input.value);
                input.value = String(count);
                state[row.dataset.branchId] = count;
                updateTotal();
              },
              true,
            );

            // أي تغيير في اختيار الفروع يظهر كتغيّر في data-selected
            if (dropdownEl) {
              new MutationObserver(function () {
                render();
              }).observe(dropdownEl, {
                subtree: true,
                attributes: true,
                attributeFilter: ['data-selected'],
              });
            }
            if (selectEl) selectEl.addEventListener('change', render);

            render();
          }

          init();

          return {
            // لتعبئة الأعداد المحفوظة في صفحة تعديل السيارة:
            // BranchUnits.setValues({ branch1: 4, branch2: 2 });
            setValues: function (values) {
              Object.keys(values || {}).forEach(function (id) {
                state[id] = toCount(values[id]);
              });
              render();
            },
            getValues: getValues,
            getTotal: getTotal,
            refresh: render,
          };
        })();

        window.TCarBranchUnits = BranchUnits;

        /* ============================================================
         Subscription tiers (الاشتراكات): show/hide + add/remove rows
      ============================================================= */
        var subToggle = document.getElementById('subscriptionToggle');
        var subTiersWrap = document.getElementById('subscriptionTiersWrap');
        var subTiersList = document.getElementById('subscriptionTiersList');
        var addTierBtn = document.getElementById('addSubscriptionTierBtn');

        function syncSubscriptionVisibility() {
          subTiersWrap.style.display = subToggle.checked ? '' : 'none';
        }
        subToggle.addEventListener('change', syncSubscriptionVisibility);
        syncSubscriptionVisibility();

        function syncTierRemoveButtons() {
          var rows = subTiersList.querySelectorAll('[data-tier-row]');
          rows.forEach(function (row) {
            var removeBtn = row.querySelector('[data-remove-tier]');
            removeBtn.disabled = rows.length <= 1; // keep at least one tier row
          });
        }

        function bindTierRow(row) {
          // Re-init its (freshly cloned) custom dropdown
          var dd = row.querySelector('[data-duration-dropdown]');
          if (dd) {
            initCustomDropdown(dd);
            // Options are cloned after they were bound, so rebind them too
            if (window.TCarForm) window.TCarForm.bindSingleOptions(dd);
          }

          var removeBtn = row.querySelector('[data-remove-tier]');
          removeBtn.addEventListener('click', function () {
            if (subTiersList.querySelectorAll('[data-tier-row]').length <= 1) return;
            row.remove();
            syncTierRemoveButtons();
          });
        }

        // Bind the initial template row
        subTiersList.querySelectorAll('[data-tier-row]').forEach(bindTierRow);
        syncTierRemoveButtons();

        addTierBtn.addEventListener('click', function () {
          var templateRow = subTiersList.querySelector('[data-tier-row]');
          var newRow = templateRow.cloneNode(true);

          // Reset the cloned row's inputs to defaults
          var clonedDropdown = newRow.querySelector('[data-duration-dropdown]');
          delete clonedDropdown.dataset.ddInit; // allow re-init on the cloned dropdown
          clonedDropdown.querySelectorAll('.custom-dropdown__option').forEach(function (opt) {
            opt.removeAttribute('data-selected');
            delete opt.dataset.ddBound; // re-bind the copied options
          });
          clonedDropdown
            .querySelector('.custom-dropdown__text')
            .textContent = @json(__('company.cars.months_placeholder'));
          var clonedSelect = clonedDropdown.querySelector('select');
          if (clonedSelect) clonedSelect.value = '';

          var priceInputs = newRow.querySelectorAll('.form-field__input');
          priceInputs.forEach(function (input, idx) {
            input.value = idx === 1 ? '0' : ''; // السعر فارغ / السعر المخفض 0
          });

          subTiersList.appendChild(newRow);
          bindTierRow(newRow);
          syncTierRemoveButtons();
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
         Car form: every dropdown is filled from the API, never hardcoded.
         Source: GET company.add-car.options (or company.edit-car.show
         when a car id is present in the query string).
      ============================================================= */
        var CarForm = (function () {
          var form = document.querySelector('[data-car-form]');
          if (!form) return null;

          var csrf = document.querySelector('meta[name="csrf-token"]');
          var carId = new URLSearchParams(window.location.search).get('car');
          // Only the edit page ships data-update-url, so it is edit-only.
          var editOnly = !form.dataset.storeUrl;

          if (editOnly && !carId) {
            var lockButton = form.querySelector('button[type="submit"]');
            if (lockButton) lockButton.disabled = true;
            window.alert(@json(__('company.cars.missing_car')));
            return null;
          }

          var i18n = {
            loadError: @json(__('company.cars.load_error')),
            saveError: @json(__('company.cars.save_error')),
            empty: @json(__('company.cars.empty_options')),
            allBranches: @json(__('company.cars.all_branches')),
            branchesCount: @json(__('company.cars.branches_count')),
            noneSelected: @json(__('company.cars.no_branches_selected')),
            unit: @json(__('company.cars.unit_car')),
            months: @json(__('company.cars.months_placeholder')),
          };

          var ALL = 'all';
          var options = {};
          var car = null;

          /* ---------- generic helpers ---------- */

          function toItems(list, valueKey) {
            if (Array.isArray(list)) {
              return list.map(function (row) {
                if (typeof row === 'object' && row !== null) {
                  return {
                    value: String(row[valueKey] !== undefined ? row[valueKey] : row.id),
                    label: row.title || row.label || row.value || String(row[valueKey]),
                  };
                }
                return { value: String(row), label: String(row) };
              });
            }
            return Object.keys(list || {}).map(function (key) {
              return { value: String(key), label: String(list[key]) };
            });
          }

          function fillSelect(select, items, placeholder) {
            if (!select) return;
            select.innerHTML = '';

            if (placeholder !== null) {
              var blank = document.createElement('option');
              blank.value = '';
              blank.textContent = placeholder;
              select.appendChild(blank);
            }

            items.forEach(function (item) {
              var option = document.createElement('option');
              option.value = item.value;
              option.textContent = item.label;
              select.appendChild(option);
            });
          }

          function fillOptions(host, items) {
            if (!host) return;
            host.innerHTML = '';

            if (!items.length) {
              var empty = document.createElement('span');
              empty.className = 'custom-dropdown__loading';
              empty.textContent = i18n.empty;
              host.appendChild(empty);
              return;
            }

            items.forEach(function (item) {
              var button = document.createElement('button');
              button.type = 'button';
              button.className = 'custom-dropdown__option';
              button.setAttribute('data-value', item.value);

              var text = document.createElement('span');
              text.className = 'custom-dropdown__option-text';
              text.textContent = item.label;
              button.appendChild(text);

              var check = document.createElement('i');
              check.className = 'bi bi-check2 custom-dropdown__option-check';
              button.appendChild(check);

              host.appendChild(button);
            });
          }

          function selectInDropdown(dropdown, value) {
            if (!dropdown || value === null || value === undefined || value === '') return;
            var button = dropdown.querySelector(
              '.custom-dropdown__option[data-value="' + value + '"]',
            );
            if (button) button.click();
          }

          /* ---------- option click behaviour ----------
             Options are rendered from the API, so they are bound after
             they land in the DOM instead of at dropdown init time. */

          function bindSingleOptions(dropdown) {
            if (!dropdown) return;

            var menu = dropdown.querySelector('.custom-dropdown__menu');
            var trigger = dropdown.querySelector('.custom-dropdown__trigger');
            var select = dropdown.querySelector('select');

            dropdown.querySelectorAll('.custom-dropdown__option').forEach(function (option) {
              if (option.dataset.ddBound === '1') return;
              option.dataset.ddBound = '1';

              option.addEventListener('click', function (e) {
                e.stopPropagation();

                var value = option.getAttribute('data-value');
                var node = option.querySelector('.custom-dropdown__option-text');
                var iconNode = option.querySelector('.custom-dropdown__option-icon');

                if (select) select.value = value;

                var label = dropdown.querySelector('.custom-dropdown__text');
                if (label) label.textContent = node ? node.textContent : value;

                var icon = dropdown.querySelector('.custom-dropdown__icon');
                if (icon && iconNode) icon.innerHTML = iconNode.innerHTML;

                dropdown.querySelectorAll('.custom-dropdown__option').forEach(function (opt) {
                  opt.removeAttribute('data-selected');
                });
                option.setAttribute('data-selected', 'true');

                if (menu) menu.classList.remove('is-visible');
                if (trigger) {
                  trigger.setAttribute('aria-expanded', 'false');
                  trigger.classList.remove('is-open');
                }
              });
            });
          }

          function branchSummary() {
            var dropdown = document.getElementById('branchesDropdown');
            if (!dropdown) return;

            var label = dropdown.querySelector('.custom-dropdown__text');
            if (!label) return;

            var total = dropdown.querySelectorAll(
              '.custom-dropdown__option[data-selected]',
            ).length;
            var hasAll = !!dropdown.querySelector(
              '.custom-dropdown__option[data-value="' + ALL + '"][data-selected]',
            );
            var count = dropdown.querySelectorAll(
              '.custom-dropdown__option:not([data-value="' + ALL + '"])[data-selected]',
            ).length;

            if (hasAll) label.textContent = i18n.allBranches;
            else if (count) label.textContent = i18n.branchesCount.replace(':count', count);
            else label.textContent = i18n.noneSelected;
          }

          function bindBranchOptions() {
            var dropdown = document.getElementById('branchesDropdown');
            if (!dropdown) return;

            var select = dropdown.querySelector('select');

            dropdown.querySelectorAll('.custom-dropdown__option').forEach(function (option) {
              if (option.dataset.ddBound === '1') return;
              option.dataset.ddBound = '1';

              option.addEventListener('click', function (e) {
                e.stopPropagation();

                var value = option.getAttribute('data-value');
                var isAll = value === ALL;

                if (isAll) {
                  var allSelected = option.hasAttribute('data-selected');
                  dropdown.querySelectorAll('.custom-dropdown__option').forEach(function (opt) {
                    if (allSelected) opt.removeAttribute('data-selected');
                    else opt.setAttribute('data-selected', 'true');
                  });
                } else {
                  if (option.hasAttribute('data-selected')) {
                    option.removeAttribute('data-selected');
                  } else {
                    option.setAttribute('data-selected', 'true');
                  }
                  dropdown
                    .querySelector('.custom-dropdown__option[data-value="' + ALL + '"]')
                    .removeAttribute('data-selected');
                }

                if (select) {
                  dropdown.querySelectorAll('.custom-dropdown__option').forEach(function (opt) {
                    var match = select.querySelector(
                      'option[value="' + opt.getAttribute('data-value') + '"]',
                    );
                    if (match) match.selected = opt.hasAttribute('data-selected');
                  });
                }

                branchSummary();
              });
            });
          }

          /* ---------- branches (multi select) ---------- */

          function renderBranches(items) {
            var host = document.querySelector('[data-branch-options]');
            var select = document.getElementById('branchesSelect');

            if (select) {
              Array.prototype.slice.call(select.options).forEach(function (option) {
                if (option.value !== ALL) select.removeChild(option);
              });
            }

            if (host) {
              host.innerHTML = '';

              var all = document.createElement('button');
              all.type = 'button';
              all.className = 'custom-dropdown__option';
              all.setAttribute('data-value', ALL);
              all.setAttribute('data-selected', 'true');

              var allText = document.createElement('span');
              allText.className = 'custom-dropdown__option-text';
              allText.textContent = i18n.allBranches;
              all.appendChild(allText);

              var allCheck = document.createElement('i');
              allCheck.className = 'bi bi-check2 custom-dropdown__option-check';
              all.appendChild(allCheck);
              host.appendChild(all);

              items.forEach(function (item) {
                var button = document.createElement('button');
                button.type = 'button';
                button.className = 'custom-dropdown__option';
                button.setAttribute('data-value', item.value);

                var text = document.createElement('span');
                text.className = 'custom-dropdown__option-text';
                text.textContent = item.label;
                button.appendChild(text);

                var check = document.createElement('i');
                check.className = 'bi bi-check2 custom-dropdown__option-check';
                button.appendChild(check);

                host.appendChild(button);

                if (select) {
                  var option = document.createElement('option');
                  option.value = item.value;
                  option.textContent = item.label;
                  select.appendChild(option);
                }
              });
            }
          }

          /* ---------- additional services ---------- */

          function renderServices(items) {
            var host = document.querySelector('[data-car-services]');
            if (!host) return;

            host.innerHTML = '';

            if (!items.length) {
              var empty = document.createElement('span');
              empty.className = 'custom-dropdown__loading';
              empty.textContent = i18n.empty;
              host.appendChild(empty);
              return;
            }

            items.forEach(function (item) {
              var wrap = document.createElement('div');
              wrap.className = 'checkbox-option-wrap';

              var label = document.createElement('label');
              label.className = 'checkbox-option';

              var input = document.createElement('input');
              input.type = 'checkbox';
              input.value = item.value;
              input.setAttribute('data-service-toggle', '');
              label.appendChild(input);

              var custom = document.createElement('span');
              custom.className = 'checkbox-custom';
              label.appendChild(custom);

              var text = document.createElement('span');
              text.className = 'checkbox-label';
              text.textContent = item.label;
              label.appendChild(text);

              wrap.appendChild(label);

              var priceWrap = document.createElement('div');
              priceWrap.className = 'price-input-wrapper checkbox-inline-price';
              priceWrap.style.display = 'none';
              priceWrap.setAttribute('data-service-price-field', '');

              var price = document.createElement('input');
              price.type = 'text';
              price.className = 'form-field__input ltr-num';
              price.placeholder = '0';
              price.setAttribute('data-service-price', '');
              priceWrap.appendChild(price);

              var suffix = document.createElement('span');
              suffix.className = 'price-suffix';
              suffix.textContent = '0';
              priceWrap.appendChild(suffix);

              wrap.appendChild(priceWrap);
              host.appendChild(wrap);

              input.addEventListener('change', function () {
                priceWrap.style.display = input.checked ? '' : 'none';
                if (!input.checked) price.value = '';
              });
            });
          }

          /* ---------- subscription durations ---------- */

          function renderDurations(items) {
            document.querySelectorAll('[data-duration-options]').forEach(function (host) {
              fillOptions(host, items);
            });
            // The hidden select is what actually gets submitted, so it has to
            // carry the same options as the button list.
            document.querySelectorAll('[data-duration-select]').forEach(function (select) {
              fillSelect(select, items, i18n.months);
            });
            document.querySelectorAll('[data-duration-dropdown] .custom-dropdown__text').forEach(
              function (node) {
                node.textContent = i18n.months;
              },
            );
          }

          /* ---------- loading ---------- */

          function applyOptions(payload) {
            options = payload;

            renderBranches(toItems(payload.branches, 'id'));

            var brandHost = document.querySelector('[data-options="brands"]');
            var brandItems = toItems(payload.brands, 'id');
            fillSelect(document.getElementById('makeSelect'), brandItems, null);
            fillOptions(brandHost, brandItems);

            var typeHost = document.querySelector('[data-options="car_types"]');
            var typeItems = toItems(payload.car_types, 'id');
            fillSelect(document.getElementById('carTypeSelect'), typeItems, null);
            fillOptions(typeHost, typeItems);

            var modelHost = document.querySelector('[data-options="car_models"]');
            var modelItems = toItems(payload.car_models, 'id');
            fillSelect(document.getElementById('modelSelect'), modelItems, null);
            fillOptions(modelHost, modelItems);

            var yearItems = toItems(payload.years, 'value');
            fillSelect(document.getElementById('yearSelect'), yearItems, null);
            fillOptions(document.querySelector('[data-options="years"]'), yearItems);

            var powerItems = toItems(payload.power_labels, 'value');
            fillSelect(document.getElementById('fuelSelect'), powerItems, null);
            fillOptions(document.querySelector('[data-options="power_labels"]'), powerItems);

            var doorItems = toItems(payload.door_counts, 'value');
            fillSelect(document.getElementById('doorsSelect'), doorItems, null);
            fillOptions(document.querySelector('[data-options="door_counts"]'), doorItems);

            renderDurations(toItems(payload.month_counts, 'value'));
            renderServices(toItems(payload.car_additional_services, 'id'));

            bindBranchOptions();
            branchSummary();
            document.querySelectorAll('.custom-dropdown').forEach(bindSingleOptions);
          }

          function load() {
            var url = carId
              ? form.dataset.showUrl.replace('/0', '/' + carId)
              : form.dataset.optionsUrl;

            return fetch(url, {
              headers: { 'X-Requested-With': 'XMLHttpRequest', Accept: 'application/json' },
            })
              .then(function (r) {
                return r.json();
              })
              .then(function (res) {
                if (!res || res.code >= 400) throw new Error(res && res.message);

                car = (res.data && res.data.car) || null;
                applyOptions((res.data && res.data.options) || res.data || {});

                if (car) hydrate(car);
                if (window.TCarBranchUnits) window.TCarBranchUnits.refresh();
              })
              .catch(function () {
                window.alert(i18n.loadError);
              });
          }

          /* ---------- filling an existing car ---------- */

          function hydrate(data) {
            selectInDropdown(document.getElementById('makeDropdown'), data.car_brand_id);
            selectInDropdown(document.getElementById('carTypeDropdown'), data.car_type_id);
            selectInDropdown(document.getElementById('modelDropdown'), data.car_model_id);
            selectInDropdown(document.getElementById('yearDropdown'), data.year);
            // power/door_count live under `details` in the API payload
            var details = data.details || {};
            selectInDropdown(document.getElementById('fuelDropdown'), details.power);
            selectInDropdown(document.getElementById('doorsDropdown'), details.door_count);

            document.querySelectorAll('[data-pricing]').forEach(function (input) {
              var value = data.pricing && data.pricing[input.dataset.pricing];
              if (value !== undefined && value !== null) input.value = value;
            });

            if (data.details) {
              document.querySelectorAll('#sec-specs input[type="checkbox"][name]').forEach(
                function (input) {
                  input.checked = Boolean(data.details[input.name]);
                },
              );
            }

            if (data.subscriptions && data.subscriptions.length) {
              var addBtn = document.getElementById('addSubscriptionTierBtn');
              var subToggle = document.getElementById('subscriptionToggle');
              if (subToggle) subToggle.checked = true;
              if (subToggle) subToggle.dispatchEvent(new Event('change'));

              // The row that ships with the page is the template the add button
              // clones, so the first tier reuses it instead of removing it.
              data.subscriptions.forEach(function (tier, index) {
                if (index > 0 && addBtn) addBtn.click();
                var row = document.querySelectorAll('#subscriptionTiersList [data-tier-row]')[index];
                if (!row) return;
                var dropdown = row.querySelector('[data-duration-dropdown]');
                selectInDropdown(dropdown, tier.month_count);
                var prices = row.querySelectorAll('.form-field__input');
                if (prices[0]) prices[0].value = tier.price;
                if (prices[1]) prices[1].value = tier.lowest_price;
              });
            }

            if (data.services && data.services.length) {
              document.querySelectorAll('[data-service-toggle]').forEach(function (input) {
                var match = data.services.filter(function (row) {
                  return String(row.car_additional_service_id) === input.value;
                })[0];
                if (!match) return;
                input.checked = true;
                var field = input.closest('.checkbox-option-wrap').querySelector(
                  '[data-service-price-field]',
                );
                var price = input.closest('.checkbox-option-wrap').querySelector(
                  '[data-service-price]',
                );
                if (field) field.style.display = '';
                if (price) price.value = match.price;
              });
            }

            if (data.branches && data.branches.length) {
              var values = {};
              data.branches.forEach(function (row) {
                selectInDropdown(document.getElementById('branchesDropdown'), row.branch_id);
                values[row.branch_id] = row.stock;
              });
              if (window.TCarBranchUnits) window.TCarBranchUnits.setValues(values);
            }

            if (data.note_en) {
              var en = document.querySelector('textarea[name="note_en"]');
              if (en) en.value = data.note_en;
            }
            if (data.note_ar) {
              var ar = document.querySelector('textarea[name="note_ar"]');
              if (ar) ar.value = data.note_ar;
            }
          }

          /* ---------- payload ---------- */

          function collectPricing() {
            var pricing = {};
            document.querySelectorAll('[data-pricing]').forEach(function (input) {
              var value = parseFloat(input.value);
              pricing[input.dataset.pricing] = isNaN(value) ? 0 : value;
            });
            if (pricing.free_km === undefined) pricing.free_km = 0;
            return pricing;
          }

          function collectBranches() {
            var rows = [];
            document
              .querySelectorAll('#branchesDropdown .custom-dropdown__option[data-selected]')
              .forEach(function (option) {
                var id = option.getAttribute('data-value');
                if (!id || id === ALL) return;
                var stock = window.TCarBranchUnits ? window.TCarBranchUnits.getValues()[id] : 0;
                rows.push({ branch_id: Number(id), stock: Number(stock) || 0 });
              });
            return rows;
          }

          function collectSubscriptions() {
            var rows = [];
            document.querySelectorAll('#subscriptionTiersList [data-tier-row]').forEach(
              function (row) {
                var select = row.querySelector('[data-duration-select]');
                var month = select && select.value;
                if (!month) return;
                var prices = row.querySelectorAll('.form-field__input');
                rows.push({
                  month_count: Number(month),
                  price: prices[0] ? parseFloat(prices[0].value) || 0 : 0,
                  lowest_price: prices[1] ? parseFloat(prices[1].value) || 0 : 0,
                });
              },
            );
            return rows;
          }

          function collectServices() {
            var rows = [];
            document.querySelectorAll('[data-service-toggle]').forEach(function (input) {
              if (!input.checked) return;
              var wrap = input.closest('.checkbox-option-wrap');
              var price = wrap && wrap.querySelector('[data-service-price]');
              rows.push({
                car_additional_service_id: Number(input.value),
                price: price ? parseFloat(price.value) || 0 : 0,
              });
            });
            return rows;
          }

          function collectDetails() {
            var details = {
              door_count: Number(document.getElementById('doorsSelect').value) || 4,
            };
            var power = document.getElementById('fuelSelect');
            if (power && power.value) details.power = power.value;
            document.querySelectorAll('#sec-specs input[type="checkbox"][name]').forEach(
              function (input) {
                details[input.name] = input.checked ? 1 : 0;
              },
            );
            return details;
          }

          function payload() {
            var subToggle = document.getElementById('subscriptionToggle');
            var year = document.getElementById('yearSelect');

            return {
              car_brand_id: Number(document.getElementById('makeSelect').value) || null,
              car_type_id: Number(document.getElementById('carTypeSelect').value) || null,
              car_model_id: Number(document.getElementById('modelSelect').value) || null,
              year: year && year.value ? Number(year.value) : null,
              note_en: (document.querySelector('textarea[name="note_en"]') || {}).value || null,
              note_ar: (document.querySelector('textarea[name="note_ar"]') || {}).value || null,
              is_subscriber: subToggle && subToggle.checked ? 1 : 0,
              pricing: collectPricing(),
              subscriptions: collectSubscriptions(),
              services: collectServices(),
              branches: collectBranches(),
              details: collectDetails(),
            };
          }

          function submit() {
            var button = form.querySelector('button[type="submit"]');
            var body = new FormData();

            body.append('car_brand_id', document.getElementById('makeSelect').value);
            body.append('car_type_id', document.getElementById('carTypeSelect').value);
            body.append('car_model_id', document.getElementById('modelSelect').value);

            var year = document.getElementById('yearSelect');
            if (year && year.value) body.append('year', year.value);

            var noteEn = document.querySelector('textarea[name="note_en"]');
            if (noteEn) body.append('note_en', noteEn.value);
            var noteAr = document.querySelector('textarea[name="note_ar"]');
            if (noteAr) body.append('note_ar', noteAr.value);

            var subToggle = document.getElementById('subscriptionToggle');
            body.append('is_subscriber', subToggle && subToggle.checked ? 1 : 0);

            var pricing = collectPricing();
            Object.keys(pricing).forEach(function (key) {
              body.append('pricing[' + key + ']', pricing[key]);
            });

            collectSubscriptions().forEach(function (row, index) {
              body.append('subscriptions[' + index + '][month_count]', row.month_count);
              body.append('subscriptions[' + index + '][price]', row.price);
              body.append('subscriptions[' + index + '][lowest_price]', row.lowest_price);
            });

            collectServices().forEach(function (row, index) {
              body.append(
                'services[' + index + '][car_additional_service_id]',
                row.car_additional_service_id,
              );
              body.append('services[' + index + '][price]', row.price);
            });

            collectBranches().forEach(function (row, index) {
              body.append('branches[' + index + '][branch_id]', row.branch_id);
              body.append('branches[' + index + '][stock]', row.stock);
            });

            var details = collectDetails();
            Object.keys(details).forEach(function (key) {
              body.append('details[' + key + ']', details[key]);
            });

            var image = document.getElementById('carImageInput');
            if (image && image.files && image.files[0]) body.append('image', image.files[0]);

            if (button) button.disabled = true;

            var url = carId
              ? form.dataset.updateUrl.replace('/0', '/' + carId)
              : form.dataset.storeUrl;

            return fetch(url, {
              method: carId ? 'PUT' : 'POST',
              headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrf ? csrf.content : '',
                Accept: 'application/json',
              },
              body: body,
            })
              .then(function (r) {
                return r.json().then(function (data) {
                  return { ok: r.ok, data: data };
                });
              })
              .then(function (res) {
                if (button) button.disabled = false;

                if (!res.ok || (res.data && (res.data.code >= 400 || res.data.errors))) {
                  var first = res.data && res.data.errors
                    ? Object.values(res.data.errors)[0][0]
                    : res.data && res.data.message;
                  window.alert(first || i18n.saveError);
                  return;
                }

                window.showSuccessModal(
                  (res.data && res.data.message) || '',
                  @json(route('company.office-cars')),
                );
              })
              .catch(function () {
                if (button) button.disabled = false;
                window.alert(i18n.saveError);
              });
          }

          form.addEventListener('submit', function (event) {
            event.preventDefault();
            submit();
          });

          load();

          return {
            reload: load,
            payload: payload,
            bindSingleOptions: bindSingleOptions,
            branchSummary: branchSummary,
          };
        })();

        window.TCarForm = CarForm;
      });
    </script>
@endpush

