@extends('company.layouts.master')

@section('title', 'T-Car — Car Availability')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.352') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.202') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.common.352') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
              <div class="dropdown">
                <button
                  class="btn btn-outline dropdown-toggle"
                  type="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="bi bi-download"></i> {{ __('company.common.301') }}</button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="#"
                      ><i class="bi bi-file-earmark-excel"></i> {{ __('company.common.302') }}</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>

          
          <div class="table-card mb-4">
            <div class="table-toolbar">
              <div class="table-toolbar__left">
                <div
                  class="view-tabs"
                  role="tablist"
                   aria-label="{{ __('company.common.305') }}"
                  id="matrixViewTabs"
                >
                  <button
                    type="button"
                    class="view-tabs__btn is-active"
                    data-filter="all"
                    role="tab"
                    aria-selected="true"
                  >
                    {{ __('company.pages.car-availability.0') }}</button>
                  <button
                    type="button"
                    class="view-tabs__btn"
                    data-filter="active"
                    role="tab"
                    aria-selected="false"
                  >
                    {{ __('company.pages.car-availability.1') }}</button>
                  <button
                    type="button"
                    class="view-tabs__btn"
                    data-filter="inactive"
                    role="tab"
                    aria-selected="false"
                  >
                    {{ __('company.pages.car-availability.2') }}</button>
                </div>
              </div>
            </div>

            <div class="table-filter-bar">
              <div class="table-filter-bar__left">
                <button
                  type="button"
                  class="filter-btn"
                  data-bs-toggle="modal"
                  data-bs-target="#filterModal"
                >
                  <i class="bi bi-sliders"></i> {{ __('company.common.303') }}</button>
                <span class="matrix-legend">
                  <span class="matrix-legend__item"
                    ><span class="matrix-legend__swatch matrix-legend__swatch--on"></span>
                    {{ __('company.pages.car-availability.3') }}</span
                  >
                  <span class="matrix-legend__item"
                    ><span class="matrix-legend__swatch matrix-legend__swatch--off"></span> {{ __('company.pages.car-availability.4') }}</span
                  >
                </span>
              </div>

              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="fleetSearchInput"  placeholder="{{ __('company.common.138') }}" />
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="fleet-matrix" id="fleetMatrixTable">
                <thead>
                  <tr>
                    <th class="fleet-matrix__office-head">{{ __('company.common.235') }}</th>
                    <th>
                      <span class="fleet-matrix__model"> {{ __('company.pages.car-availability.5') }}</span
                      ><span class="fleet-matrix__total ltr-num">{{ __('company.pages.car-availability.6') }}</span>
                    </th>
                    <th>
                      <span class="fleet-matrix__model"> {{ __('company.pages.car-availability.7') }}</span
                      ><span class="fleet-matrix__total ltr-num">{{ __('company.pages.car-availability.8') }}</span>
                    </th>
                    <th>
                      <span class="fleet-matrix__model"> {{ __('company.pages.car-availability.9') }}</span
                      ><span class="fleet-matrix__total ltr-num">{{ __('company.pages.car-availability.8') }}</span>
                    </th>
                    <th>
                      <span class="fleet-matrix__model"> {{ __('company.pages.car-availability.10') }}</span
                      ><span class="fleet-matrix__total ltr-num">{{ __('company.pages.car-availability.11') }}</span>
                    </th>
                    <th>
                      <span class="fleet-matrix__model"> {{ __('company.pages.car-availability.12') }}</span
                      ><span class="fleet-matrix__total ltr-num">{{ __('company.pages.car-availability.13') }}</span>
                    </th>
                    <th>
                      <span class="fleet-matrix__model"> {{ __('company.pages.car-availability.14') }}</span
                      ><span class="fleet-matrix__total ltr-num">{{ __('company.pages.car-availability.15') }}</span>
                    </th>
                    <th>
                      <span class="fleet-matrix__model"> {{ __('company.pages.car-availability.16') }}</span
                      ><span class="fleet-matrix__total ltr-num">{{ __('company.pages.car-availability.17') }}</span>
                    </th>
                    <th>
                      <span class="fleet-matrix__model"> {{ __('company.pages.car-availability.18') }}</span
                      ><span class="fleet-matrix__total ltr-num">{{ __('company.pages.car-availability.19') }}</span>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="fleet-matrix__office">
                      <a href="{{ route('company.office-details') }}">{{ __('company.common.49') }}</a>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">3</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">5</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">6</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">5</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">3</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">0</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td class="fleet-matrix__office">
                      <a href="{{ route('company.office-details') }}">N2-Al-Olaya</a>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">0</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">4</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">2</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">2</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">6</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td class="fleet-matrix__office">
                      <a href="{{ route('company.office-details') }}">N2 Rental Car - Riyadh - Almarwa</a>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">0</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">13</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">3</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">3</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">2</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">0</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td class="fleet-matrix__office">
                      <a href="{{ route('company.office-details') }}">N2 Rental Car - Rawdah</a>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">2</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">3</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">2</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">3</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">4</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td class="fleet-matrix__office">
                      <a href="{{ route('company.office-details') }}">N2 Rental Car - Riyadh - Al Aziziyah</a>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">0</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">3</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">2</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">0</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">4</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">7</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">0</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">0</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td class="fleet-matrix__office">
                      <a href="{{ route('company.office-details') }}">N2 Rental Car - Riyadh - Exit 27, Al-Awali</a>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">7</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">3</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">3</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="on">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="true"
                           title="{{ __('company.pages.car-availability.33') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">3</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">1</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="matrix-cell" data-state="off">
                        <button
                          type="button"
                          class="matrix-cell__switch"
                          role="switch"
                          aria-checked="false"
                           title="{{ __('company.pages.car-availability.36') }}"
                        ></button>
                        <div class="matrix-cell__stepper">
                          <button
                            type="button"
                            class="matrix-cell__step"
                            data-action="dec"
                             aria-label="{{ __('company.pages.car-availability.34') }}"
                          >
                            −</button
                          ><span class="matrix-cell__count">3</span
                          ><button
                            type="button"
                            class="matrix-cell__step"
                            data-action="inc"
                             aria-label="{{ __('company.pages.car-availability.35') }}"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="table-pagination table-pagination-dt">
              <div class="table-pagination__size-select">
                <label for="pageSizeSelect">{{ __('company.common.212') }}</label>
                <select id="pageSizeSelect">
                  <option value="10" selected>10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                </select>
              </div>
              <div class="table-pagination__pages">
                <button class="table-pagination__page-btn" disabled>
                  <i class="bi bi-chevron-right"></i>
                </button>
                <button class="table-pagination__page-btn is-active">1</button>
                <button class="table-pagination__page-btn">2</button>
                <button class="table-pagination__page-btn">
                  <i class="bi bi-chevron-left"></i>
                </button>
              </div>
            </div>
          </div>
@endsection

@push('modals')
</main>
        
      

    
    <div
      class="modal fade"
      id="filterModal"
      tabindex="-1"
      aria-labelledby="filterModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="filterModalLabel">
              <i class="bi bi-sliders"></i> {{ __('company.pages.car-availability.20') }}</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body">
            <form id="filterForm">
              <div class="form-grid" style="grid-template-columns: 1fr 1fr; gap: 16px">
                
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.common.547') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="officeSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="officeSelectValue"
                        >{{ __('company.common.115') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu"
                      id="officeDropdownMenu"
                      aria-labelledby="officeSelectBtn"
                    >
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input
                            type="search"
                             placeholder="{{ __('company.common.260') }}"
                            id="officeSearchInput"
                          />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input
                              type="checkbox"
                              data-office="branch1"
                              data-label="N2 فرع العتيق"
                            />
                            {{ __('company.common.49') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-office="branch2" data-label="N2-Al-Olaya" />
                            N2-Al-Olaya
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input
                              type="checkbox"
                              data-office="branch3"
                              data-label="N2 Rental Car - Riyadh"
                            />
                            N2 Rental Car - Riyadh
                          </label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.common.229') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="citySelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="citySelectValue"
                        >{{ __('company.common.113') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu" id="cityDropdownMenu" aria-labelledby="citySelectBtn">
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input type="search"  placeholder="{{ __('company.common.259') }}" id="citySearchInput" />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-city="riyadh" data-label="الرياض" /> {{ __('company.common.183') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-city="jeddah" data-label="جدة" /> {{ __('company.common.357') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-city="dammam" data-label="الدمام" /> {{ __('company.common.174') }}</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.pages.car-availability.21') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="servicesSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="servicesSelectValue"
                        >{{ __('company.pages.car-availability.22') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu"
                      id="servicesDropdownMenu"
                      aria-labelledby="servicesSelectBtn"
                    >
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input
                            type="search"
                             placeholder="{{ __('company.pages.car-availability.37') }}"
                            id="servicesSearchInput"
                          />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-service="daily" data-label="تأجير يومي" />
                            {{ __('company.pages.car-availability.23') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-service="monthly" data-label="تأجير شهري" />
                            {{ __('company.pages.car-availability.24') }}</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.pages.car-availability.25') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="countSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="countSelectValue"
                        >{{ __('company.common.109') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu"
                      id="countDropdownMenu"
                      aria-labelledby="countSelectBtn"
                    >
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input type="search"  placeholder="{{ __('company.common.257') }}" id="countSearchInput" />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-count="1-5" data-label="1-5" /> 1-5
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-count="6-10" data-label="6-10" /> 6-10
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-count="10+" data-label="10+" /> 10+
                          </label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                
                
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.pages.car-availability.26') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="modelSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="modelSelectValue"
                        >{{ __('company.common.116') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu"
                      id="modelDropdownMenu"
                      aria-labelledby="modelSelectBtn"
                    >
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input
                            type="search"
                             placeholder="{{ __('company.common.261') }}"
                            id="modelSearchInput"
                          />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-model="accent" data-label="هونداي اكسنت" />
                            {{ __('company.pages.car-availability.27') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-model="camry" data-label="تويوتا كامري" />
                            {{ __('company.pages.car-availability.28') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-model="sentra" data-label="نيسان سنترا" />
                            {{ __('company.pages.car-availability.29') }}</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.common.571') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="carTypeSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="carTypeSelectValue"
                        >{{ __('company.common.118') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu"
                      id="carTypeDropdownMenu"
                      aria-labelledby="carTypeSelectBtn"
                    >
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input
                            type="search"
                             placeholder="{{ __('company.common.263') }}"
                            id="carTypeSearchInput"
                          />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-cartype="sedan" data-label="سيدان" /> {{ __('company.pages.car-availability.30') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-cartype="suv" data-label="SUV" /> SUV
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-cartype="hatchback" data-label="هاتشباك" />
                            {{ __('company.pages.car-availability.31') }}</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.pages.car-availability.32') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="yearSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="yearSelectValue"
                        >{{ __('company.common.107') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu" id="yearDropdownMenu" aria-labelledby="yearSelectBtn">
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input type="search"  placeholder="{{ __('company.common.254') }}" id="yearSearchInput" />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-year="2024" data-label="2024" /> 2024
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-year="2023" data-label="2023" /> 2023
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <span class="checkbox-custom"></span>
                            <input type="checkbox" data-year="2022" data-label="2022" /> 2022
                          </label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.526') }}</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ __('company.common.78') }}</button>
          </div>
        </div>
      </div>
    </div>

    
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        /* ---- Toggle switch (enable/disable a model at a branch) ---- */
        document.querySelectorAll('.matrix-cell__switch').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var cell = this.closest('.matrix-cell');
            var isOn = cell.getAttribute('data-state') === 'on';
            cell.setAttribute('data-state', isOn ? 'off' : 'on');
            this.setAttribute('aria-checked', String(!isOn));
            this.setAttribute('title', isOn ? 'غير مفعّل — اضغط للتفعيل' : 'مفعّل — اضغط للتعطيل');
          });
        });

        /* ---- Quantity stepper +/- ---- */
        document.querySelectorAll('.matrix-cell__step').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var countEl = this.parentElement.querySelector('.matrix-cell__count');
            var val = parseInt(countEl.textContent, 10) || 0;
            if (this.getAttribute('data-action') === 'inc') {
              val += 1;
            } else {
              val = Math.max(0, val - 1);
            }
            countEl.textContent = val;
          });
        });

        /* ---- View tabs: filter the fleet matrix by enabled/disabled state.
     Cells that don't match the current filter are hidden, and any office
     row left with no matching cell at all is hidden too, so "المفعّلة فقط"
     / "غير المفعّلة فقط" actually narrows down the table instead of just
     dimming individual cells. ---- */
        var viewTabs = document.querySelectorAll('#matrixViewTabs .view-tabs__btn');

        function applyFleetStateFilter(filter) {
          console.log('Applying filter:', filter);
          var table = document.getElementById('fleetMatrixTable');
          if (!table) {
            console.log('Table not found');
            return;
          }
          var rows = table.querySelectorAll('tbody tr');
          console.log('Found rows:', rows.length);

          rows.forEach(function (row) {
            var rowHasMatch = false;
            var cells = row.querySelectorAll('.matrix-cell');
            console.log('Row has cells:', cells.length);

            cells.forEach(function (cell) {
              var state = cell.getAttribute('data-state');
              var show = filter === 'all' || filter === state;
              cell.style.display = show ? 'inline-flex' : 'none';
              if (show) rowHasMatch = true;
            });

            row.style.display = filter === 'all' || rowHasMatch ? '' : 'none';
            console.log('Row display:', row.style.display);
          });
        }

        viewTabs.forEach(function (tab) {
          tab.addEventListener('click', function () {
            viewTabs.forEach(function (t) {
              t.classList.remove('is-active');
              t.setAttribute('aria-selected', 'false');
            });
            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');
            applyFleetStateFilter(this.getAttribute('data-filter'));
          });
        });

        // Apply initial filter on page load
        var initialActiveTab = document.querySelector('#matrixViewTabs .view-tabs__btn.is-active');
        if (initialActiveTab) {
          applyFleetStateFilter(initialActiveTab.getAttribute('data-filter'));
        }

        /* ---- Search filters office rows ---- */
        var searchInput = document.getElementById('fleetSearchInput');
        if (searchInput) {
          searchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            var activeFilter = document.querySelector('#matrixViewTabs .view-tabs__btn.is-active');
            var filterValue = activeFilter ? activeFilter.getAttribute('data-filter') : 'all';

            document.querySelectorAll('#fleetMatrixTable tbody tr').forEach(function (row) {
              var officeName = row.querySelector('.fleet-matrix__office').textContent.toLowerCase();
              var matchesSearch = officeName.includes(q);

              var rowHasStateMatch = true;
              if (filterValue !== 'all') {
                rowHasStateMatch = false;
                row.querySelectorAll('.matrix-cell').forEach(function (cell) {
                  if (cell.getAttribute('data-state') === filterValue) rowHasStateMatch = true;
                });
              }

              row.style.display = matchesSearch && rowHasStateMatch ? '' : 'none';
            });
          });
        }

        /* ---- Generic helper: keeps the filter modal a fixed size no matter
     how many options are picked. Instead of concatenating every selected
     label into the button (which stretches the button/grid and pushes
     content outside the modal), it shows the labels up to 2 selections
     and switches to a short "N محدد" count afterwards. The full list is
     still available as a title tooltip on hover. ---- */
        function updateMultiSelectDisplay(selected, btnEl, valueEl, placeholder) {
          if (selected.length === 0) {
            valueEl.textContent = placeholder;
            valueEl.removeAttribute('title');
            btnEl.classList.remove('has-value');
            return;
          }
          var labels = selected
            .map(function (o) {
              return o.label;
            })
            .join('، ');
          valueEl.textContent = selected.length > 2 ? selected.length + ' محدد' : labels;
          valueEl.setAttribute('title', labels);
          btnEl.classList.add('has-value');
        }

        function syncFilterCheckboxVisual(checkbox) {
          var option = checkbox.closest('.checkbox-option');
          if (option) option.classList.toggle('is-checked', checkbox.checked);
        }

        document
          .querySelectorAll('#filterModal input[type="checkbox"]')
          .forEach(function (checkbox) {
            syncFilterCheckboxVisual(checkbox);
            checkbox.addEventListener('change', function () {
              syncFilterCheckboxVisual(this);
            });
          });

        /* ---- Multi-select dropdown logic (مكتب) ---- */
        var selectedOffices = [];
        var officeSelectBtn = document.getElementById('officeSelectBtn');
        var officeSelectValue = document.getElementById('officeSelectValue');
        var officeDropdownMenu = document.getElementById('officeDropdownMenu');
        var officeSearchInput = document.getElementById('officeSearchInput');

        officeDropdownMenu
          .querySelectorAll('input[type="checkbox"][data-office]')
          .forEach(function (cb) {
            cb.addEventListener('change', function () {
              var office = this.getAttribute('data-office');
              var label = this.getAttribute('data-label');
              if (this.checked) {
                if (
                  !selectedOffices.some(function (o) {
                    return o.value === office;
                  })
                ) {
                  selectedOffices.push({ value: office, label: label });
                }
              } else {
                selectedOffices = selectedOffices.filter(function (o) {
                  return o.value !== office;
                });
              }
              updateOfficeDisplay();
            });
          });

        function updateOfficeDisplay() {
          updateMultiSelectDisplay(
            selectedOffices,
            officeSelectBtn,
            officeSelectValue,
            'اختر المكتب',
          );
        }

        officeSearchInput.addEventListener('click', function (e) {
          e.stopPropagation();
        });
        officeSearchInput.addEventListener('input', function () {
          var q = this.value.trim().toLowerCase();
          officeDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
            li.style.display = label.includes(q) ? '' : 'none';
          });
        });

        officeSelectBtn.addEventListener('hidden.bs.dropdown', function () {
          officeSearchInput.value = '';
          officeDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            li.style.display = '';
          });
        });

        /* ---- Multi-select dropdown logic (المدينة) ---- */
        var selectedCities = [];
        var citySelectBtn = document.getElementById('citySelectBtn');
        var citySelectValue = document.getElementById('citySelectValue');
        var cityDropdownMenu = document.getElementById('cityDropdownMenu');
        var citySearchInput = document.getElementById('citySearchInput');

        cityDropdownMenu
          .querySelectorAll('input[type="checkbox"][data-city]')
          .forEach(function (cb) {
            cb.addEventListener('change', function () {
              var city = this.getAttribute('data-city');
              var label = this.getAttribute('data-label');
              if (this.checked) {
                if (
                  !selectedCities.some(function (c) {
                    return c.value === city;
                  })
                ) {
                  selectedCities.push({ value: city, label: label });
                }
              } else {
                selectedCities = selectedCities.filter(function (c) {
                  return c.value !== city;
                });
              }
              updateCityDisplay();
            });
          });

        function updateCityDisplay() {
          updateMultiSelectDisplay(selectedCities, citySelectBtn, citySelectValue, 'اختر المدينة');
        }

        citySearchInput.addEventListener('click', function (e) {
          e.stopPropagation();
        });
        citySearchInput.addEventListener('input', function () {
          var q = this.value.trim().toLowerCase();
          cityDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
            li.style.display = label.includes(q) ? '' : 'none';
          });
        });

        citySelectBtn.addEventListener('hidden.bs.dropdown', function () {
          citySearchInput.value = '';
          cityDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            li.style.display = '';
          });
        });

        /* ---- Multi-select dropdown logic (خدمات) ---- */
        var selectedServices = [];
        var servicesSelectBtn = document.getElementById('servicesSelectBtn');
        var servicesSelectValue = document.getElementById('servicesSelectValue');
        var servicesDropdownMenu = document.getElementById('servicesDropdownMenu');
        var servicesSearchInput = document.getElementById('servicesSearchInput');

        servicesDropdownMenu
          .querySelectorAll('input[type="checkbox"][data-service]')
          .forEach(function (cb) {
            cb.addEventListener('change', function () {
              var service = this.getAttribute('data-service');
              var label = this.getAttribute('data-label');
              if (this.checked) {
                if (
                  !selectedServices.some(function (s) {
                    return s.value === service;
                  })
                ) {
                  selectedServices.push({ value: service, label: label });
                }
              } else {
                selectedServices = selectedServices.filter(function (s) {
                  return s.value !== service;
                });
              }
              updateServicesDisplay();
            });
          });

        function updateServicesDisplay() {
          updateMultiSelectDisplay(
            selectedServices,
            servicesSelectBtn,
            servicesSelectValue,
            'اختر الخدمات',
          );
        }

        servicesSearchInput.addEventListener('click', function (e) {
          e.stopPropagation();
        });
        servicesSearchInput.addEventListener('input', function () {
          var q = this.value.trim().toLowerCase();
          servicesDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
            li.style.display = label.includes(q) ? '' : 'none';
          });
        });

        servicesSelectBtn.addEventListener('hidden.bs.dropdown', function () {
          servicesSearchInput.value = '';
          servicesDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            li.style.display = '';
          });
        });

        /* ---- Multi-select dropdown logic (عدد السيارات المتاحة) ---- */
        var selectedCounts = [];
        var countSelectBtn = document.getElementById('countSelectBtn');
        var countSelectValue = document.getElementById('countSelectValue');
        var countDropdownMenu = document.getElementById('countDropdownMenu');
        var countSearchInput = document.getElementById('countSearchInput');

        countDropdownMenu
          .querySelectorAll('input[type="checkbox"][data-count]')
          .forEach(function (cb) {
            cb.addEventListener('change', function () {
              var count = this.getAttribute('data-count');
              var label = this.getAttribute('data-label');
              if (this.checked) {
                if (
                  !selectedCounts.some(function (c) {
                    return c.value === count;
                  })
                ) {
                  selectedCounts.push({ value: count, label: label });
                }
              } else {
                selectedCounts = selectedCounts.filter(function (c) {
                  return c.value !== count;
                });
              }
              updateCountDisplay();
            });
          });

        function updateCountDisplay() {
          updateMultiSelectDisplay(selectedCounts, countSelectBtn, countSelectValue, 'اختر العدد');
        }

        countSearchInput.addEventListener('click', function (e) {
          e.stopPropagation();
        });
        countSearchInput.addEventListener('input', function () {
          var q = this.value.trim().toLowerCase();
          countDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
            li.style.display = label.includes(q) ? '' : 'none';
          });
        });

        countSelectBtn.addEventListener('hidden.bs.dropdown', function () {
          countSearchInput.value = '';
          countDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            li.style.display = '';
          });
        });

        /* ---- Multi-select dropdown logic (نشط) ---- */
        var selectedActive = [];
        var activeSelectBtn = document.getElementById('activeSelectBtn');
        var activeSelectValue = document.getElementById('activeSelectValue');
        var activeDropdownMenu = document.getElementById('activeDropdownMenu');
        var activeSearchInput = document.getElementById('activeSearchInput');

        activeDropdownMenu
          .querySelectorAll('input[type="checkbox"][data-active]')
          .forEach(function (cb) {
            cb.addEventListener('change', function () {
              var active = this.getAttribute('data-active');
              var label = this.getAttribute('data-label');
              if (this.checked) {
                if (
                  !selectedActive.some(function (a) {
                    return a.value === active;
                  })
                ) {
                  selectedActive.push({ value: active, label: label });
                }
              } else {
                selectedActive = selectedActive.filter(function (a) {
                  return a.value !== active;
                });
              }
              updateActiveDisplay();
            });
          });

        function updateActiveDisplay() {
          updateMultiSelectDisplay(
            selectedActive,
            activeSelectBtn,
            activeSelectValue,
            'اختر الحالة',
          );
        }

        activeSearchInput.addEventListener('click', function (e) {
          e.stopPropagation();
        });
        activeSearchInput.addEventListener('input', function () {
          var q = this.value.trim().toLowerCase();
          activeDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
            li.style.display = label.includes(q) ? '' : 'none';
          });
        });

        activeSelectBtn.addEventListener('hidden.bs.dropdown', function () {
          activeSearchInput.value = '';
          activeDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            li.style.display = '';
          });
        });

        /* ---- Multi-select dropdown logic (موديل السيارة) ---- */
        var selectedModels = [];
        var modelSelectBtn = document.getElementById('modelSelectBtn');
        var modelSelectValue = document.getElementById('modelSelectValue');
        var modelDropdownMenu = document.getElementById('modelDropdownMenu');
        var modelSearchInput = document.getElementById('modelSearchInput');

        modelDropdownMenu
          .querySelectorAll('input[type="checkbox"][data-model]')
          .forEach(function (cb) {
            cb.addEventListener('change', function () {
              var model = this.getAttribute('data-model');
              var label = this.getAttribute('data-label');
              if (this.checked) {
                if (
                  !selectedModels.some(function (m) {
                    return m.value === model;
                  })
                ) {
                  selectedModels.push({ value: model, label: label });
                }
              } else {
                selectedModels = selectedModels.filter(function (m) {
                  return m.value !== model;
                });
              }
              updateModelDisplay();
            });
          });

        function updateModelDisplay() {
          updateMultiSelectDisplay(
            selectedModels,
            modelSelectBtn,
            modelSelectValue,
            'اختر الموديل',
          );
        }

        modelSearchInput.addEventListener('click', function (e) {
          e.stopPropagation();
        });
        modelSearchInput.addEventListener('input', function () {
          var q = this.value.trim().toLowerCase();
          modelDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
            li.style.display = label.includes(q) ? '' : 'none';
          });
        });

        modelSelectBtn.addEventListener('hidden.bs.dropdown', function () {
          modelSearchInput.value = '';
          modelDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            li.style.display = '';
          });
        });

        /* ---- Multi-select dropdown logic (نوع السيارة) ---- */
        var selectedCarTypes = [];
        var carTypeSelectBtn = document.getElementById('carTypeSelectBtn');
        var carTypeSelectValue = document.getElementById('carTypeSelectValue');
        var carTypeDropdownMenu = document.getElementById('carTypeDropdownMenu');
        var carTypeSearchInput = document.getElementById('carTypeSearchInput');

        carTypeDropdownMenu
          .querySelectorAll('input[type="checkbox"][data-cartype]')
          .forEach(function (cb) {
            cb.addEventListener('change', function () {
              var carType = this.getAttribute('data-cartype');
              var label = this.getAttribute('data-label');
              if (this.checked) {
                if (
                  !selectedCarTypes.some(function (c) {
                    return c.value === carType;
                  })
                ) {
                  selectedCarTypes.push({ value: carType, label: label });
                }
              } else {
                selectedCarTypes = selectedCarTypes.filter(function (c) {
                  return c.value !== carType;
                });
              }
              updateCarTypeDisplay();
            });
          });

        function updateCarTypeDisplay() {
          updateMultiSelectDisplay(
            selectedCarTypes,
            carTypeSelectBtn,
            carTypeSelectValue,
            'اختر النوع',
          );
        }

        carTypeSearchInput.addEventListener('click', function (e) {
          e.stopPropagation();
        });
        carTypeSearchInput.addEventListener('input', function () {
          var q = this.value.trim().toLowerCase();
          carTypeDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
            li.style.display = label.includes(q) ? '' : 'none';
          });
        });

        carTypeSelectBtn.addEventListener('hidden.bs.dropdown', function () {
          carTypeSearchInput.value = '';
          carTypeDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            li.style.display = '';
          });
        });

        /* ---- Multi-select dropdown logic (تاريخ السيارة) ---- */
        var selectedYears = [];
        var yearSelectBtn = document.getElementById('yearSelectBtn');
        var yearSelectValue = document.getElementById('yearSelectValue');
        var yearDropdownMenu = document.getElementById('yearDropdownMenu');
        var yearSearchInput = document.getElementById('yearSearchInput');

        yearDropdownMenu
          .querySelectorAll('input[type="checkbox"][data-year]')
          .forEach(function (cb) {
            cb.addEventListener('change', function () {
              var year = this.getAttribute('data-year');
              var label = this.getAttribute('data-label');
              if (this.checked) {
                if (
                  !selectedYears.some(function (y) {
                    return y.value === year;
                  })
                ) {
                  selectedYears.push({ value: year, label: label });
                }
              } else {
                selectedYears = selectedYears.filter(function (y) {
                  return y.value !== year;
                });
              }
              updateYearDisplay();
            });
          });

        function updateYearDisplay() {
          updateMultiSelectDisplay(selectedYears, yearSelectBtn, yearSelectValue, 'اختر السنة');
        }

        yearSearchInput.addEventListener('click', function (e) {
          e.stopPropagation();
        });
        yearSearchInput.addEventListener('input', function () {
          var q = this.value.trim().toLowerCase();
          yearDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
            li.style.display = label.includes(q) ? '' : 'none';
          });
        });

        yearSelectBtn.addEventListener('hidden.bs.dropdown', function () {
          yearSearchInput.value = '';
          yearDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
            li.style.display = '';
          });
        });
      });
    </script>
@endpush

