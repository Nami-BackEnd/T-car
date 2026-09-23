@extends('company.layouts.master')

@section('title', 'T-Car — إضافة سيارة')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.85') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.202') }}</span>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('company.license-plates') }}"> {{ __('company.common.472') }}</a>
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

          <form id="editCarForm">
            
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
                      <select id="branchesSelect" style="display: none" multiple>
                        <option value="all" selected>{{ __('company.common.223') }}</option>
                        <option value="branch1" selected>{{ __('company.common.461') }}</option>
                        <option value="branch2" selected>{{ __('company.common.464') }}</option>
                        <option value="branch3">{{ __('company.common.463') }}</option>
                        <option value="branch4">{{ __('company.common.462') }}</option>
                        <option value="branch5">{{ __('company.common.459') }}</option>
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
                        <div class="custom-dropdown__options">
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="all"
                            data-selected="true"
                          >
                            <span class="custom-dropdown__option-text">{{ __('company.common.223') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="branch1"
                            data-selected="true"
                          >
                            <span class="custom-dropdown__option-text">{{ __('company.common.461') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="branch2"
                            data-selected="true"
                          >
                            <span class="custom-dropdown__option-text">{{ __('company.common.464') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="branch3"
                          >
                            <span class="custom-dropdown__option-text">{{ __('company.common.463') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="branch4"
                          >
                            <span class="custom-dropdown__option-text">{{ __('company.common.462') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="branch5"
                          >
                            <span class="custom-dropdown__option-text">{{ __('company.common.459') }}</span>
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
                      <select id="makeSelect" style="display: none">
                        <option value="">{{ __('company.common.108') }}</option>
                        <option value="toyota" selected>{{ __('company.common.354') }}</option>
                        <option value="nissan">{{ __('company.common.575') }}</option>
                        <option value="hyundai">{{ __('company.common.586') }}</option>
                        <option value="kia">{{ __('company.common.488') }}</option>
                        <option value="suzuki">{{ __('company.common.428') }}</option>
                        <option value="honda">{{ __('company.common.581') }}</option>
                        <option value="ford">{{ __('company.common.468') }}</option>
                        <option value="chevrolet">{{ __('company.common.434') }}</option>
                        <option value="bmw">{{ __('company.common.272') }}</option>
                        <option value="mercedes">{{ __('company.common.520') }}</option>
                        <option value="audi">{{ __('company.common.71') }}</option>
                        <option value="mazda">{{ __('company.common.494') }}</option>
                        <option value="volkswagen">{{ __('company.common.469') }}</option>
                        <option value="mitsubishi">{{ __('company.common.560') }}</option>
                      </select>
                      <button type="button" class="custom-dropdown__trigger" aria-expanded="false">
                        <span class="custom-dropdown__selected">
                          <span class="custom-dropdown__icon"
                            ><i class="bi bi-car-front-fill"></i
                          ></span>
                          <span class="custom-dropdown__text">{{ __('company.common.354') }}</span>
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
                        <div class="custom-dropdown__options">
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="toyota"
                            data-selected="true"
                          >
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.354') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="nissan">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.575') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="hyundai"
                          >
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.586') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="kia">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.488') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="suzuki">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.428') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="honda">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.581') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="ford">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.468') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="chevrolet"
                          >
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.434') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="bmw">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.272') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="mercedes"
                          >
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.520') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="audi">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.71') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="mazda">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.494') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="volkswagen"
                          >
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.469') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="mitsubishi"
                          >
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.560') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
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
                        <div class="custom-dropdown__options" data-car-type-options>
                          
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-field">
                    <label class="form-field__label"
                      >{{ __('company.common.241') }}<span class="text-danger">*</span></label
                    >
                    <div class="custom-dropdown" id="modelDropdown">
                      <select id="modelSelect" style="display: none">
                        <option value="">{{ __('company.common.116') }}</option>
                        <option value="camry" selected>{{ __('company.common.474') }}</option>
                        <option value="corolla">{{ __('company.common.487') }}</option>
                        <option value="yaris">{{ __('company.common.589') }}</option>
                        <option value="rava4">{{ __('company.common.388') }}</option>
                        <option value="highlander">{{ __('company.common.578') }}</option>
                        <option value="landcruiser">{{ __('company.common.493') }}</option>
                        <option value="prius">{{ __('company.common.266') }}</option>
                        <option value="avalon">{{ __('company.common.67') }}</option>
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
                        <div class="custom-dropdown__options">
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="camry"
                            data-selected="true"
                          >
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.474') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="corolla"
                          >
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.487') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="yaris">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.589') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="rava4">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.388') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="highlander"
                          >
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.578') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="landcruiser"
                          >
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.493') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="prius">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.266') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="avalon">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-car-front"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.67') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.201') }}</label>
                    <div class="custom-dropdown" id="yearDropdown">
                      <select id="yearSelect" style="display: none">
                        <option value="" selected>{{ __('company.common.107') }}</option>
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
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
                        <div class="custom-dropdown__options">
                          <button type="button" class="custom-dropdown__option" data-value="2026">
                            <span class="custom-dropdown__option-text">2026</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="2025">
                            <span class="custom-dropdown__option-text">2025</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="2024">
                            <span class="custom-dropdown__option-text">2024</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="2023">
                            <span class="custom-dropdown__option-text">2023</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="2022">
                            <span class="custom-dropdown__option-text">2022</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="2021">
                            <span class="custom-dropdown__option-text">2021</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="2020">
                            <span class="custom-dropdown__option-text">2020</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="2019">
                            <span class="custom-dropdown__option-text">2019</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="2018">
                            <span class="custom-dropdown__option-text">2018</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="2017">
                            <span class="custom-dropdown__option-text">2017</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
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
                          <input type="text" class="form-field__input ltr-num" placeholder="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                      <div class="form-field">
                        <label class="form-field__label"
                          >{{ __('company.common.196') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" value="0" />
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
                          <input type="text" class="form-field__input ltr-num" placeholder="0" />
                          <span class="price-suffix">{{ __('company.common.406') }}</span>
                        </div>
                      </div>
                      <div class="form-field">
                        <label class="form-field__label"
                          >{{ __('company.common.196') }}<span class="text-danger">*</span></label
                        >
                        <div class="price-input-wrapper">
                          <input type="text" class="form-field__input ltr-num" value="0" />
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
                            <input type="text" class="form-field__input ltr-num" placeholder="0" />
                            <span class="price-suffix">{{ __('company.common.406') }}</span>
                          </div>
                        </div>
                        <div class="form-field">
                          <label class="form-field__label"
                            >{{ __('company.common.196') }}<span class="text-danger">*</span></label
                          >
                          <div class="price-input-wrapper">
                            <input type="text" class="form-field__input ltr-num" value="0" />
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
                              
                              <option value="2">{{ __('company.common.432') }}</option>
                              <option value="3">{{ __('company.common.22') }}</option>
                              <option value="4">{{ __('company.common.35') }}</option>
                              <option value="5">{{ __('company.common.38') }}</option>
                              <option value="6">{{ __('company.common.39') }}</option>
                              <option value="7">{{ __('company.common.40') }}</option>
                              <option value="8">{{ __('company.common.41') }}</option>
                              <option value="9">{{ __('company.common.42') }}</option>
                              <option value="10">{{ __('company.common.10') }}</option>
                              <option value="11">{{ __('company.common.11') }}</option>
                              <option value="12">{{ __('company.common.12') }}</option>
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
                              <div class="custom-dropdown__options">
                                
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="2"
                                >
                                  <span class="custom-dropdown__option-text">{{ __('company.common.432') }}</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="3"
                                >
                                  <span class="custom-dropdown__option-text">{{ __('company.common.22') }}</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="4"
                                >
                                  <span class="custom-dropdown__option-text">{{ __('company.common.35') }}</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="5"
                                >
                                  <span class="custom-dropdown__option-text">{{ __('company.common.38') }}</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="6"
                                >
                                  <span class="custom-dropdown__option-text">{{ __('company.common.39') }}</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="7"
                                >
                                  <span class="custom-dropdown__option-text">{{ __('company.common.40') }}</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="8"
                                >
                                  <span class="custom-dropdown__option-text">{{ __('company.common.41') }}</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="9"
                                >
                                  <span class="custom-dropdown__option-text">{{ __('company.common.42') }}</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="10"
                                >
                                  <span class="custom-dropdown__option-text">{{ __('company.common.10') }}</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="11"
                                >
                                  <span class="custom-dropdown__option-text">{{ __('company.common.11') }}</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
                                <button
                                  type="button"
                                  class="custom-dropdown__option"
                                  data-value="12"
                                >
                                  <span class="custom-dropdown__option-text">{{ __('company.common.12') }}</span>
                                  <i class="bi bi-check2 custom-dropdown__option-check"></i>
                                </button>
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
                  <div class="checkbox-list">
                    <div class="checkbox-option-wrap">
                      <label class="checkbox-option">
                        <input type="checkbox" id="addDriverToggle" />
                        <span class="checkbox-custom"></span>
                        <span class="checkbox-label"> {{ __('company.common.84') }}</span>
                      </label>
                      <div
                        class="price-input-wrapper checkbox-inline-price"
                        id="addDriverPriceField"
                        style="display: none"
                      >
                        <input
                          type="text"
                          class="form-field__input ltr-num"
                          id="addDriverPrice"
                          placeholder="0"
                        />
                        <span class="price-suffix">{{ __('company.common.406') }}</span>
                      </div>
                    </div>
                    <div class="checkbox-option-wrap">
                      <label class="checkbox-option">
                        <input type="checkbox" id="unlimitedKmToggle" />
                        <span class="checkbox-custom"></span>
                        <span class="checkbox-label">{{ __('company.common.483') }}</span>
                      </label>
                      <div
                        class="price-input-wrapper checkbox-inline-price"
                        id="unlimitedKmPriceField"
                        style="display: none"
                      >
                        <input
                          type="text"
                          class="form-field__input ltr-num"
                          id="unlimitedKmPrice"
                          placeholder="0"
                        />
                        <span class="price-suffix">{{ __('company.common.406') }}</span>
                      </div>
                    </div>
                    <div class="checkbox-option-wrap">
                      <label class="checkbox-option">
                        <input type="checkbox" id="cdwToggle" />
                        <span class="checkbox-custom"></span>
                        <span class="checkbox-label">CDW</span>
                      </label>
                      <div
                        class="price-input-wrapper checkbox-inline-price"
                        id="cdwPriceField"
                        style="display: none"
                      >
                        <input
                          type="text"
                          class="form-field__input ltr-num"
                          id="cdwPrice"
                          placeholder="0"
                        />
                        <span class="price-suffix">{{ __('company.common.406') }}</span>
                      </div>
                    </div>
                    <div class="checkbox-option-wrap">
                      <label class="checkbox-option">
                        <input type="checkbox" id="nonSmokingToggle" />
                        <span class="checkbox-custom"></span>
                        <span class="checkbox-label">{{ __('company.common.429') }}</span>
                      </label>
                      <div
                        class="price-input-wrapper checkbox-inline-price"
                        id="nonSmokingPriceField"
                        style="display: none"
                      >
                        <input
                          type="text"
                          class="form-field__input ltr-num"
                          id="nonSmokingPrice"
                          placeholder="0"
                        />
                        <span class="price-suffix">{{ __('company.common.406') }}</span>
                      </div>
                    </div>
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
                      <select id="fuelSelect" style="display: none">
                        <option value="diesel" selected>{{ __('company.common.386') }}</option>
                        <option value="petrol">{{ __('company.common.271') }}</option>
                        <option value="hybrid">{{ __('company.common.579') }}</option>
                        <option value="electric">{{ __('company.common.485') }}</option>
                        <option value="gas">{{ __('company.common.453') }}</option>
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
                        <div class="custom-dropdown__options">
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="diesel"
                            data-selected="true"
                          >
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-fuel-pump-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.386') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="petrol">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-fuel-pump-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.271') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="hybrid">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-lightning-charge-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.579') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="electric"
                          >
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-lightning-fill"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.485') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="gas">
                            <span class="custom-dropdown__option-icon"
                              ><i class="bi bi-fire"></i
                            ></span>
                            <span class="custom-dropdown__option-text">{{ __('company.common.453') }}</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.440') }}</label>
                    <div class="custom-dropdown" id="doorsDropdown">
                      <select id="doorsSelect" style="display: none">
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5" selected>5</option>
                      </select>
                      <button type="button" class="custom-dropdown__trigger" aria-expanded="false">
                        <span class="custom-dropdown__selected">
                          <span class="custom-dropdown__icon"
                            ><i class="bi bi-door-closed-fill"></i
                          ></span>
                          <span class="custom-dropdown__text">5</span>
                        </span>
                        <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                      </button>
                      <div class="custom-dropdown__menu">
                        <div class="custom-dropdown__options">
                          <button type="button" class="custom-dropdown__option" data-value="2">
                            <span class="custom-dropdown__option-text">2</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="3">
                            <span class="custom-dropdown__option-text">3</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button type="button" class="custom-dropdown__option" data-value="4">
                            <span class="custom-dropdown__option-text">4</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                          <button
                            type="button"
                            class="custom-dropdown__option"
                            data-value="5"
                            data-selected="true"
                          >
                            <span class="custom-dropdown__option-text">5</span>
                            <i class="bi bi-check2 custom-dropdown__option-check"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="checkbox-list">
                  <label class="checkbox-option">
                    <input type="checkbox" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.549') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.270') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.252') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.593') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.475') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.373') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" />
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
                      placeholder="Notes in English..."
                    ></textarea>
                  </div>
                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.238') }}</label>
                    <textarea
                      class="form-field__input"
                      rows="3"
                       placeholder="{{ __('company.common.57') }}"
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

@push('modals')
</main>
        
      

    
@endpush

@push('libs')
<script src="{{ asset('company/js/car-types.js?v=3') }}"></script>
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

        /* Simulate fetching matched car units for the chosen make/model */
        setTimeout(function () {
          var loadingEl = document.getElementById('carUnitsLoading');
          var listEl = document.getElementById('carUnitsList');
          if (loadingEl) loadingEl.style.display = 'none';
          if (listEl) listEl.style.display = 'block';
        }, 900);

        /* Enable/disable the daily+weekly pricing blocks with the toggle */
        var dwToggle = document.getElementById('dailyWeeklyToggle');
        var dwBlocks = document.getElementById('dailyWeeklyBlocks');
        function syncDW() {
          dwBlocks.style.display = dwToggle.checked ? '' : 'none';
        }
        dwToggle.addEventListener('change', syncDW);
        syncDW();

        /* إضافة سائق: show the price field only when the checkbox is checked */
        var addDriverToggle = document.getElementById('addDriverToggle');
        var addDriverPriceField = document.getElementById('addDriverPriceField');
        var addDriverPriceInput = document.getElementById('addDriverPrice');
        function syncAddDriverPrice() {
          addDriverPriceField.style.display = addDriverToggle.checked ? '' : 'none';
          if (!addDriverToggle.checked) {
            addDriverPriceInput.value = '';
          }
        }
        addDriverToggle.addEventListener('change', syncAddDriverPrice);
        syncAddDriverPrice();

        /* كم لا محدود / CDW / سيارات غير مدخنين: show price field when checked */
        function bindTogglePrice(toggleId, fieldId, inputId) {
          var toggle = document.getElementById(toggleId);
          var field = document.getElementById(fieldId);
          var input = document.getElementById(inputId);
          if (!toggle || !field) return;
          function sync() {
            field.style.display = toggle.checked ? '' : 'none';
            if (!toggle.checked && input) input.value = '';
          }
          toggle.addEventListener('change', sync);
          sync();
        }
        bindTogglePrice('unlimitedKmToggle', 'unlimitedKmPriceField', 'unlimitedKmPrice');
        bindTogglePrice('cdwToggle', 'cdwPriceField', 'cdwPrice');
        bindTogglePrice('nonSmokingToggle', 'nonSmokingPriceField', 'nonSmokingPrice');

        /* Custom Dropdown Menus (Manufacturer / Model / Year / Subscription duration...) */
        function initCustomDropdown(dropdown) {
          if (dropdown.dataset.ddInit === '1') return; // avoid double-binding
          dropdown.dataset.ddInit = '1';

          var trigger = dropdown.querySelector('.custom-dropdown__trigger');
          var menu = dropdown.querySelector('.custom-dropdown__menu');
          var select = dropdown.querySelector('select');
          var options = dropdown.querySelectorAll('.custom-dropdown__option');
          var searchInput = dropdown.querySelector('.custom-dropdown__search-input');

          // Special handling for branches dropdown (multi-select with "All")
          if (dropdown.id === 'branchesDropdown') {
            // Select option
            options.forEach(function (option) {
              option.addEventListener('click', function (e) {
                e.stopPropagation();
                var value = this.getAttribute('data-value');
                var text = this.querySelector('.custom-dropdown__option-text').textContent;

                if (value === 'all') {
                  // Toggle all selection
                  var allOption = dropdown.querySelector(
                    '.custom-dropdown__option[data-value="all"]',
                  );
                  var isAllSelected = allOption.hasAttribute('data-selected');

                  if (isAllSelected) {
                    // Deselect all
                    options.forEach(function (opt) {
                      opt.removeAttribute('data-selected');
                      var optValue = opt.getAttribute('data-value');
                      if (optValue !== 'all') {
                        var selectOption = select.querySelector('option[value="' + optValue + '"]');
                        if (selectOption) selectOption.selected = false;
                      }
                    });
                    dropdown.querySelector('.custom-dropdown__text').textContent = '0 فروع';
                  } else {
                    // Select all
                    options.forEach(function (opt) {
                      opt.setAttribute('data-selected', 'true');
                      var optValue = opt.getAttribute('data-value');
                      if (optValue !== 'all') {
                        var selectOption = select.querySelector('option[value="' + optValue + '"]');
                        if (selectOption) selectOption.selected = true;
                      }
                    });
                    // ملاحظة: في <select multiple> إسناد value يلغي تحديد الباقي،
                    // لذلك نكتفي بتحديد خيار "الكل" دون المساس ببقية الفروع.
                    var allSelectOption = select.querySelector('option[value="all"]');
                    if (allSelectOption) allSelectOption.selected = true;
                    dropdown.querySelector('.custom-dropdown__text').textContent = 'الكل';
                  }
                } else {
                  // Toggle individual selection
                  var isSelected = this.hasAttribute('data-selected');
                  if (isSelected) {
                    this.removeAttribute('data-selected');
                    var selectOption = select.querySelector('option[value="' + value + '"]');
                    if (selectOption) selectOption.selected = false;
                  } else {
                    this.setAttribute('data-selected', 'true');
                    var selectOption = select.querySelector('option[value="' + value + '"]');
                    if (selectOption) selectOption.selected = true;
                  }

                  // Check if all are selected
                  var allSelected = true;
                  var anySelected = false;
                  options.forEach(function (opt) {
                    var optValue = opt.getAttribute('data-value');
                    if (optValue !== 'all') {
                      if (!opt.hasAttribute('data-selected')) {
                        allSelected = false;
                      } else {
                        anySelected = true;
                      }
                    }
                  });

                  if (allSelected && anySelected) {
                    options.forEach(function (opt) {
                      opt.setAttribute('data-selected', 'true');
                    });
                    var allSelectOpt = select.querySelector('option[value="all"]');
                    if (allSelectOpt) allSelectOpt.selected = true;
                    dropdown.querySelector('.custom-dropdown__text').textContent = 'الكل';
                  } else {
                    // Update display with selected count
                    var selectedCount = 0;
                    options.forEach(function (opt) {
                      if (
                        opt.hasAttribute('data-selected') &&
                        opt.getAttribute('data-value') !== 'all'
                      ) {
                        selectedCount++;
                      }
                    });
                    dropdown.querySelector('.custom-dropdown__text').textContent =
                      selectedCount + ' فروع';
                    // Deselect "All" option
                    var allOption = dropdown.querySelector(
                      '.custom-dropdown__option[data-value="all"]',
                    );
                    if (allOption) allOption.removeAttribute('data-selected');
                    var allSelectOption2 = select.querySelector('option[value="all"]');
                    if (allSelectOption2) allSelectOption2.selected = false;
                  }
                }

                // Don't close dropdown - keep it open for multi-selection
              });
            });

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

            // Prevent dropdown from closing when clicking on search input in branches dropdown
            if (searchInput) {
              searchInput.addEventListener('click', function (e) {
                e.stopPropagation();
              });

              searchInput.addEventListener('focus', function (e) {
                e.stopPropagation();
              });

              // Prevent dropdown from closing when clicking on search container
              var searchContainer = dropdown.querySelector('.custom-dropdown__search');
              if (searchContainer) {
                searchContainer.addEventListener('click', function (e) {
                  e.stopPropagation();
                });
              }

              // Search functionality for branches dropdown
              searchInput.addEventListener('input', function () {
                var searchTerm = this.value.toLowerCase();
                options.forEach(function (option) {
                  var text = option
                    .querySelector('.custom-dropdown__option-text')
                    .textContent.toLowerCase();
                  if (text.includes(searchTerm)) {
                    option.style.display = 'flex';
                  } else {
                    option.style.display = 'none';
                  }
                });
              });
            }

            return; // Skip the rest for branches dropdown
          }

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
              var iconElement = this.querySelector('.custom-dropdown__option-icon');
              var icon = iconElement ? iconElement.innerHTML : '';

              // Update select value
              select.value = value;

              // Update trigger display
              dropdown.querySelector('.custom-dropdown__text').textContent = text;
              var triggerIcon = dropdown.querySelector('.custom-dropdown__icon');
              if (triggerIcon && icon) {
                triggerIcon.innerHTML = icon;
              }

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

          // Search functionality
          if (searchInput) {
            searchInput.addEventListener('input', function () {
              var searchTerm = this.value.toLowerCase();
              options.forEach(function (option) {
                var text = option
                  .querySelector('.custom-dropdown__option-text')
                  .textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                  option.style.display = 'flex';
                } else {
                  option.style.display = 'none';
                }
              });
            });

            // Prevent dropdown from closing when clicking on search input
            searchInput.addEventListener('click', function (e) {
              e.stopPropagation();
            });

            // Prevent dropdown from closing when focusing on search input
            searchInput.addEventListener('focus', function (e) {
              e.stopPropagation();
            });

            // Prevent dropdown from closing when clicking on search container
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
            input.setAttribute('aria-label', 'عدد السيارات المتاحة في ' + branch.name);

            var suffix = document.createElement('span');
            suffix.className = 'branch-units__suffix';
            suffix.textContent = 'سيارة';

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
          if (dd) initCustomDropdown(dd);

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
          });
          clonedDropdown.querySelector('.custom-dropdown__text').textContent = 'اختر المدة';
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

        document.getElementById('editCarForm').addEventListener('submit', function (e) {
          e.preventDefault();
          // مثال لقراءة القيم عند الحفظ:
          // var payload = {
          //   branch_units: BranchUnits.getValues(),      // { branch1: 4, branch2: 2 }
          //   available_cars_total: BranchUnits.getTotal() // 6
          // };
        });
      });
    </script>
@endpush

