@extends('company.layouts.master')

@section('title', 'T-Car — Pending Reservations')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.pending-reservations.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.167') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current"> {{ __('company.pages.pending-reservations.0') }}</span>
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

          
          <div class="notice-banner" id="pendingReservationsNotice">
            <div class="notice-banner__body">
              <i class="bi bi-exclamation-triangle-fill notice-banner__icon"></i>
              <div class="notice-banner__text">
                <strong>{{ __('company.common.345') }}</strong> {{ __('company.pages.pending-reservations.1') }}<span class="fw-bold">6</span> {{ __('company.pages.pending-reservations.2') }}</div>
            </div>
            <button
              class="notice-banner__close"
              type="button"
               aria-label="{{ __('company.common.93') }}"
              onclick="this.closest('.notice-banner').style.display = 'none'"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>

          
          <div class="table-card">
            <div class="table-toolbar">
              <div class="table-toolbar__left">
                <div
                  class="table-actions-bar pending-reservations-filters d-flex flex-wrap gap-2 align-items-center"
                >
                  <button
                    type="button"
                    class="filter-btn js-date-trigger"
                    data-field-key="returnDate"
                  >
                    <span class="js-date-trigger-label">{{ __('company.common.284') }}</span>
                    <i class="bi bi-chevron-down"></i>
                  </button>

                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-btn"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      {{ __('company.common.570') }}<i class="bi bi-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input type="search"  placeholder="{{ __('company.common.264') }}" />
                        </div>
                      </li>
                      <li><a class="dropdown-item" href="#">{{ __('company.common.300') }}</a></li>
                      <li>
                        <a class="dropdown-item" href="#">{{ __('company.pages.pending-reservations.3') }}</a>
                      </li>
                    </ul>
                  </div>

                  
                  <button
                    class="icon-toggle-btn pending-filters-clear d-none"
                    type="button"
                    id="pendingFiltersClearBtn"
                     title="{{ __('company.common.525') }}"
                     aria-label="{{ __('company.common.525') }}"
                  >
                    <i class="bi bi-x-lg"></i>
                  </button>
                  <button
                    class="btn btn-primary btn-sm pending-filters-submit d-none"
                    type="button"
                    id="pendingFiltersSubmitBtn"
                  >
                    {{ __('company.common.78') }}</button>
                </div>
              </div>
              <div class="table-toolbar__right">
                <div class="d-flex gap-2">
                  <div class="table-search">
                    <i class="bi bi-search"></i>
                    <input
                      type="search"
                      id="pendingSearchInput"
                       placeholder="{{ __('company.common.399') }}"
                    />
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="table-responsive-custom">
              <table class="data-table" id="pendingTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.215') }}</th>
                    <th>{{ __('company.common.203') }}</th>
                    <th>{{ __('company.common.138') }}</th>
                    <th>{{ __('company.common.219') }}</th>
                    <th>{{ __('company.common.326') }}</th>
                    <th>{{ __('company.common.165') }}</th>
                    <th>{{ __('company.common.80') }}</th>
                    <th class="d-none" data-optional-column="accepted">{{ __('company.common.545') }}</th>
                    <th class="d-none" data-optional-column="reservation">{{ __('company.common.166') }}</th>
                    <th class="d-none" data-optional-column="days">{{ __('company.common.441') }}</th>
                    <th class="d-none" data-optional-column="price">{{ __('company.common.191') }}</th>
                    <th>{{ __('company.pages.pending-reservations.4') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    data-pending-delivery="true"
                    data-pending-payment="electronic"
                    data-pending-rejected="false"
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#pendingBookingModal"
                        data-booking-ref="#RES-009"
                        >#RES-009 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.pending-reservations.5') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966508721587+</span>
                      </div>
                    </td>
                    <td>Toyota Yaris 2026</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">18/07/2026 10:30</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">20/07/2026</span></span
                        >
                      </div>
                    </td>

                    <td class="ltr-num">18/07/2026</td>
                    <td>
                      <span class="badge bg-warning text-dark">{{ __('company.common.251') }}</span>
                    </td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.433') }}</span>
                        <span class="cell-assignment__icons d-none">
                          <button
                            type="button"
                            class="cell-assignment__edit"
                             title="{{ __('company.common.80') }}"
                            data-bs-toggle="modal"
                            data-bs-target="#assignDriverModal"
                          >
                            <i class="bi bi-pencil"></i>
                          </button>
                        </span>
                      </span>
                    </td>
                    <td class="d-none" data-optional-column="accepted">{{ __('company.common.490') }}</td>
                    <td class="d-none" data-optional-column="reservation">{{ __('company.common.538') }}</td>
                    <td class="d-none ltr-num" data-optional-column="days">2</td>
                    <td class="d-none ltr-num" data-optional-column="price">{{ __('company.common.15') }}</td>
                    <td>{{ __('company.common.563') }}</td>
                    <td>
                      <div class="cell-actions">
                        
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-success"
                                type="button"
                                data-scheduled-action="accept"
                              >
                                <i class="bi bi-check-circle"></i> {{ __('company.pages.pending-reservations.6') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-danger"
                                type="button"
                                data-scheduled-action="cancel"
                              >
                                <i class="bi bi-x-circle"></i> {{ __('company.common.393') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="combined-history"
                              >
                                <i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</button>
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ route('company.booking-details-two') }}?tab=ratings">
                                <i class="bi bi-star"></i> {{ __('company.common.83') }}</a>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="invoice"
                              >
                                <i class="bi bi-receipt"></i> {{ __('company.common.346') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-pending-delivery="true"
                    data-pending-payment="electronic"
                    data-pending-rejected="false"
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#pendingBookingModal"
                        data-booking-ref="#RES-010"
                        >#RES-010 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.pending-reservations.7') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966508721587+</span>
                      </div>
                    </td>
                    <td>HYUNDAI ACCENT 2025</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">18/07/2026 14:00</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">21/07/2026</span></span
                        >
                      </div>
                    </td>

                    <td class="ltr-num">18/07/2026</td>
                    <td>
                      <span class="badge bg-warning text-dark">{{ __('company.common.251') }}</span>
                    </td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.433') }}</span>
                        <span class="cell-assignment__icons d-none">
                          <button
                            type="button"
                            class="cell-assignment__edit"
                             title="{{ __('company.common.80') }}"
                            data-bs-toggle="modal"
                            data-bs-target="#assignDriverModal"
                          >
                            <i class="bi bi-pencil"></i>
                          </button>
                        </span>
                      </span>
                    </td>

                    <td class="d-none" data-optional-column="accepted">{{ __('company.common.490') }}</td>
                    <td class="d-none" data-optional-column="reservation">{{ __('company.common.538') }}</td>
                    <td class="d-none ltr-num" data-optional-column="days">3</td>
                    <td class="d-none ltr-num" data-optional-column="price">{{ __('company.pages.pending-reservations.8') }}</td>
                    <td>{{ __('company.common.563') }}</td>
                    <td>
                      <div class="cell-actions">
                        
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-success"
                                type="button"
                                data-scheduled-action="accept"
                              >
                                <i class="bi bi-check-circle"></i> {{ __('company.pages.pending-reservations.6') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-danger"
                                type="button"
                                data-scheduled-action="cancel"
                              >
                                <i class="bi bi-x-circle"></i> {{ __('company.common.393') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="combined-history"
                              >
                                <i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="review"
                              >
                                <i class="bi bi-star"></i> {{ __('company.common.83') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="invoice"
                              >
                                <i class="bi bi-receipt"></i> {{ __('company.common.346') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-pending-delivery="false"
                    data-pending-payment="electronic"
                    data-pending-rejected="false"
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#pendingBookingModal"
                        data-booking-ref="#RES-011"
                        >#RES-011 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.pending-reservations.9') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966508721587+</span>
                      </div>
                    </td>
                    <td>KIA pegas 2026</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">19/07/2026 09:00</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">22/07/2026</span></span
                        >
                      </div>
                    </td>

                    <td class="ltr-num">19/07/2026</td>
                    <td>
                      <span class="badge bg-warning text-dark">{{ __('company.common.251') }}</span>
                    </td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.433') }}</span>
                        <span class="cell-assignment__icons d-none">
                          <button
                            type="button"
                            class="cell-assignment__edit"
                             title="{{ __('company.common.80') }}"
                            data-bs-toggle="modal"
                            data-bs-target="#assignDriverModal"
                          >
                            <i class="bi bi-pencil"></i>
                          </button>
                        </span>
                      </span>
                    </td>

                    <td class="d-none" data-optional-column="accepted">{{ __('company.common.490') }}</td>
                    <td class="d-none" data-optional-column="reservation">{{ __('company.common.495') }}</td>
                    <td class="d-none ltr-num" data-optional-column="days">3</td>
                    <td class="d-none ltr-num" data-optional-column="price">{{ __('company.pages.pending-reservations.10') }}</td>
                    <td>{{ __('company.common.563') }}</td>
                    <td>
                      <div class="cell-actions">
                        
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-success"
                                type="button"
                                data-scheduled-action="accept"
                              >
                                <i class="bi bi-check-circle"></i> {{ __('company.pages.pending-reservations.6') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-danger"
                                type="button"
                                data-scheduled-action="cancel"
                              >
                                <i class="bi bi-x-circle"></i> {{ __('company.common.393') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="combined-history"
                              >
                                <i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="review"
                              >
                                <i class="bi bi-star"></i> {{ __('company.common.83') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="invoice"
                              >
                                <i class="bi bi-receipt"></i> {{ __('company.common.346') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-pending-delivery="true"
                    data-pending-payment="cash"
                    data-pending-rejected="false"
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#pendingBookingModal"
                        data-booking-ref="#RES-012"
                        >#RES-012 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.pending-reservations.11') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966508721587+</span>
                      </div>
                    </td>
                    <td>HYUNDAI i10 2025</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">19/07/2026 11:00</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">23/07/2026</span></span
                        >
                      </div>
                    </td>

                    <td class="ltr-num">19/07/2026</td>
                    <td>
                      <span class="badge bg-warning text-dark">{{ __('company.common.251') }}</span>
                    </td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.433') }}</span>
                        <span class="cell-assignment__icons d-none">
                          <button
                            type="button"
                            class="cell-assignment__edit"
                             title="{{ __('company.common.80') }}"
                            data-bs-toggle="modal"
                            data-bs-target="#assignDriverModal"
                          >
                            <i class="bi bi-pencil"></i>
                          </button>
                        </span>
                      </span>
                    </td>
                    <td class="d-none" data-optional-column="accepted">{{ __('company.common.490') }}</td>
                    <td class="d-none" data-optional-column="reservation">{{ __('company.common.538') }}</td>
                    <td class="d-none ltr-num" data-optional-column="days">4</td>
                    <td class="d-none ltr-num" data-optional-column="price">{{ __('company.pages.pending-reservations.12') }}</td>
                    <td>{{ __('company.common.563') }}</td>
                    <td>
                      <div class="cell-actions">
                        
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-success"
                                type="button"
                                data-scheduled-action="accept"
                              >
                                <i class="bi bi-check-circle"></i> {{ __('company.pages.pending-reservations.6') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-danger"
                                type="button"
                                data-scheduled-action="cancel"
                              >
                                <i class="bi bi-x-circle"></i> {{ __('company.common.393') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="combined-history"
                              >
                                <i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="review"
                              >
                                <i class="bi bi-star"></i> {{ __('company.common.83') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="invoice"
                              >
                                <i class="bi bi-receipt"></i> {{ __('company.common.346') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-pending-delivery="false"
                    data-pending-payment="electronic"
                    data-pending-rejected="false"
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#pendingBookingModal"
                        data-booking-ref="#RES-013"
                        >#RES-013 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.pending-reservations.13') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966508721587+</span>
                      </div>
                    </td>
                    <td>MG 5 2024</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">19/07/2026 12:30</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">24/07/2026</span></span
                        >
                      </div>
                    </td>

                    <td class="ltr-num">19/07/2026</td>
                    <td>
                      <span class="badge bg-warning text-dark">{{ __('company.common.251') }}</span>
                    </td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.433') }}</span>
                        <span class="cell-assignment__icons d-none">
                          <button
                            type="button"
                            class="cell-assignment__edit"
                             title="{{ __('company.common.80') }}"
                            data-bs-toggle="modal"
                            data-bs-target="#assignDriverModal"
                          >
                            <i class="bi bi-pencil"></i>
                          </button>
                        </span>
                      </span>
                    </td>
                    <td class="d-none" data-optional-column="accepted">{{ __('company.common.490') }}</td>
                    <td class="d-none" data-optional-column="reservation">{{ __('company.common.359') }}</td>
                    <td class="d-none ltr-num" data-optional-column="days">5</td>
                    <td class="d-none ltr-num" data-optional-column="price">{{ __('company.pages.pending-reservations.14') }}</td>
                    <td>{{ __('company.common.563') }}</td>
                    <td>
                      <div class="cell-actions">
                        
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-success"
                                type="button"
                                data-scheduled-action="accept"
                              >
                                <i class="bi bi-check-circle"></i> {{ __('company.pages.pending-reservations.6') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-danger"
                                type="button"
                                data-scheduled-action="cancel"
                              >
                                <i class="bi bi-x-circle"></i> {{ __('company.common.393') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="combined-history"
                              >
                                <i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="review"
                              >
                                <i class="bi bi-star"></i> {{ __('company.common.83') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="invoice"
                              >
                                <i class="bi bi-receipt"></i> {{ __('company.common.346') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-pending-delivery="false"
                    data-pending-payment="electronic"
                    data-pending-rejected="false"
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#pendingBookingModal"
                        data-booking-ref="#RES-014"
                        >#RES-014 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.pending-reservations.15') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966508721587+</span>
                      </div>
                    </td>
                    <td>Toyota Camry 2025</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">19/07/2026 13:00</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">25/07/2026</span></span
                        >
                      </div>
                    </td>

                    <td class="ltr-num">19/07/2026</td>
                    <td>
                      <span class="badge bg-warning text-dark">{{ __('company.common.251') }}</span>
                    </td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.433') }}</span>
                        <span class="cell-assignment__icons d-none">
                          <button
                            type="button"
                            class="cell-assignment__edit"
                             title="{{ __('company.common.80') }}"
                            data-bs-toggle="modal"
                            data-bs-target="#assignDriverModal"
                          >
                            <i class="bi bi-pencil"></i>
                          </button>
                        </span>
                      </span>
                    </td>
                    <td class="d-none" data-optional-column="accepted">{{ __('company.common.490') }}</td>
                    <td class="d-none" data-optional-column="reservation">{{ __('company.common.359') }}</td>
                    <td class="d-none ltr-num" data-optional-column="days">6</td>
                    <td class="d-none ltr-num" data-optional-column="price">{{ __('company.pages.pending-reservations.16') }}</td>
                    <td>{{ __('company.common.563') }}</td>
                    <td>
                      <div class="cell-actions">
                        
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-success"
                                type="button"
                                data-scheduled-action="accept"
                              >
                                <i class="bi bi-check-circle"></i> {{ __('company.pages.pending-reservations.6') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-danger"
                                type="button"
                                data-scheduled-action="cancel"
                              >
                                <i class="bi bi-x-circle"></i> {{ __('company.common.393') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="combined-history"
                              >
                                <i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="review"
                              >
                                <i class="bi bi-star"></i> {{ __('company.common.83') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-pending-action="invoice"
                              >
                                <i class="bi bi-receipt"></i> {{ __('company.common.346') }}</button>
                            </li>
                          </ul>
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
                <button class="table-pagination__page-btn">
                  <i class="bi bi-chevron-left"></i>
                </button>
              </div>
            </div>
          </div>

          
          <div
            class="modal fade"
            id="pendingColumnsModal"
            tabindex="-1"
            aria-hidden="true"
            aria-labelledby="pendingColumnsModalLabel"
          >
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="pendingColumnsModalLabel">{{ __('company.common.81') }}</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                     aria-label="{{ __('company.common.92') }}"
                  ></button>
                </div>
                <div class="modal-body">
                  <div class="filter-section">
                    <div
                      class="filter-section__fields"
                      style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px"
                    >
                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="vehicle" data-col-label="السيارة" />
                          <span>{{ __('company.common.570') }}</span>
                        </label>
                      </div>
                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="vehicle" data-col-label="السيارة" />
                          <span>{{ __('company.common.441') }}</span>
                        </label>
                      </div>
                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="vehicle" data-col-label="السيارة" />
                          <span>{{ __('company.common.191') }}</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.392') }}</button>
                  <button type="button" class="btn btn-primary" id="pendingApplyColumnsBtn">
                    {{ __('company.common.308') }}</button>
                </div>
              </div>
            </div>
          </div>

          
          <div
            class="modal fade"
            id="pendingHistoryModal"
            tabindex="-1"
            aria-labelledby="pendingHistoryModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content car-logs-modal">
                <div class="car-logs-modal__header">
                  <h5 class="car-logs-modal__header__title" id="pendingHistoryModalLabel">
                    {{ __('company.common.293') }}</h5>
                  <button
                    type="button"
                    class="car-logs-modal__header__close"
                    data-bs-dismiss="modal"
                     aria-label="{{ __('company.common.92') }}"
                  >
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>

                <div class="car-logs-modal__body">
                  <div class="car-logs-scrollctrl">
                    <button
                      type="button"
                      class="car-logs-scrollctrl__btn"
                      id="pendingHistoryScrollUpBtn"
                       aria-label="{{ __('company.common.344') }}"
                    >
                      <i class="bi bi-chevron-up"></i>
                    </button>
                    <div class="car-logs-scrollctrl__track">
                      <div class="car-logs-scrollctrl__thumb" id="pendingHistoryScrollThumb"></div>
                    </div>
                    <button
                      type="button"
                      class="car-logs-scrollctrl__btn"
                      id="pendingHistoryScrollDownBtn"
                       aria-label="{{ __('company.common.343') }}"
                    >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                  </div>

                  <div class="car-logs-table-wrap" id="pendingHistoryTableWrap">
                    <table class="car-logs-table">
                      <thead>
                        <tr>
                          <th>{{ __('company.common.398') }}</th>
                          <th>{{ __('company.common.245') }}</th>
                          <th>{{ __('company.common.225') }}</th>
                          <th>{{ __('company.common.296') }}</th>
                          <th>{{ __('company.common.180') }}</th>
                          <th>{{ __('company.common.232') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="log-index" data-history-ref>--</td>
                          <td class="log-type">{{ __('company.common.368') }}</td>
                          <td class="log-amount">-</td>
                          <td class="log-datetime ltr-num" data-history-date>
                            2026-07-30 11:00:00
                          </td>
                          <td class="log-message--activate" data-history-message>
                            {{ __('company.common.324') }}</td>
                          <td data-history-user>{{ __('company.common.563') }}</td>
                        </tr>
                        <tr>
                          <td class="log-index" data-history-ref>--</td>
                          <td class="log-type">{{ __('company.common.368') }}</td>
                          <td class="log-amount">-</td>
                          <td class="log-datetime ltr-num" data-history-date>
                            2026-07-30 11:03:00
                          </td>
                          <td class="log-message--stock" data-history-message>
                            {{ __('company.common.336') }}</td>
                          <td data-history-user>{{ __('company.common.563') }}</td>
                        </tr>
                        <tr>
                          <td class="log-index" data-history-ref>--</td>
                          <td class="log-type">{{ __('company.common.368') }}</td>
                          <td class="log-amount">-</td>
                          <td class="log-datetime ltr-num" data-history-date>
                            2026-07-30 11:05:00
                          </td>
                          <td class="log-message--activate" data-history-message>
                            {{ __('company.pages.pending-reservations.17') }}</td>
                          <td data-history-user>{{ __('company.common.563') }}</td>
                        </tr>
                        <tr>
                          <td class="log-index" data-history-ref>--</td>
                          <td class="log-type">{{ __('company.common.368') }}</td>
                          <td class="log-amount">-</td>
                          <td class="log-datetime ltr-num" data-history-date>
                            2026-07-30 11:08:00
                          </td>
                          <td class="log-message--deactivate" data-history-message>
                            {{ __('company.pages.pending-reservations.18') }}</td>
                          <td data-history-user>{{ __('company.common.563') }}</td>
                        </tr>
                        <tr>
                          <td class="log-index" data-history-ref>--</td>
                          <td class="log-type">{{ __('company.common.385') }}</td>
                          <td class="log-amount ltr-num">{{ __('company.common.14') }}</td>
                          <td class="log-datetime ltr-num" data-history-date>
                            2026-07-30 09:12:14
                          </td>
                          <td class="log-message--activate" data-history-message>
                            {{ __('company.common.325') }}</td>
                          <td data-history-user>{{ __('company.common.564') }}</td>
                        </tr>
                        <tr>
                          <td class="log-index" data-history-ref>--</td>
                          <td class="log-type">{{ __('company.common.385') }}</td>
                          <td class="log-amount ltr-num">{{ __('company.common.14') }}</td>
                          <td class="log-datetime ltr-num" data-history-date>
                            2026-07-30 09:14:38
                          </td>
                          <td class="log-message--activate" data-history-message>
                            {{ __('company.common.331') }}</td>
                          <td data-history-user>{{ __('company.common.563') }}</td>
                        </tr>
                        <tr>
                          <td class="log-index" data-history-ref>--</td>
                          <td class="log-type">{{ __('company.common.385') }}</td>
                          <td class="log-amount ltr-num">{{ __('company.common.14') }}</td>
                          <td class="log-datetime ltr-num" data-history-date>
                            2026-07-30 09:16:02
                          </td>
                          <td class="log-message--activate" data-history-message>
                            {{ __('company.common.321') }}</td>
                          <td data-history-user>{{ __('company.common.565') }}</td>
                        </tr>
                        <tr>
                          <td class="log-index" data-history-ref>--</td>
                          <td class="log-type">{{ __('company.common.385') }}</td>
                          <td class="log-amount ltr-num">-</td>
                          <td class="log-datetime ltr-num" data-history-date>
                            2026-07-30 09:18:20
                          </td>
                          <td class="log-message--deactivate" data-history-message>
                            {{ __('company.common.492') }}</td>
                          <td data-history-user>{{ __('company.common.563') }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
          <div
            class="modal fade"
            id="pendingBookingModal"
            tabindex="-1"
            aria-hidden="true"
            aria-labelledby="pendingBookingModalLabel"
          >
            <div class="modal-dialog modal-dialog-centered pending-booking-modal-dialog">
              <div class="modal-content booking-modal">
                
                <div class="modal-header bkmodal-header">
                  <div class="bkmodal-header__main">
                    <div class="bkmodal-header__icon">
                      <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div>
                      <h2 class="bkmodal-header__ref" id="pendingBookingModalLabel">
                        {{ __('company.common.368') }}<span class="num" id="pendingBookingRef">#RES-009</span>
                      </h2>
                      <div class="bkmodal-header__meta">
                        <span
                          ><i class="bi bi-person"></i>
                          <span id="pendingBookingCustomerMeta">{{ __('company.pages.pending-reservations.5') }}</span></span
                        >
                        <span class="dot">•</span>
                        <span
                          ><i class="bi bi-building"></i>
                          <span id="pendingBookingOfficeMeta">{{ __('company.common.184') }}</span></span
                        >
                      </div>
                    </div>
                  </div>
                  <button
                    type="button"
                    class="booking-modal__close"
                    data-bs-dismiss="modal"
                     aria-label="{{ __('company.common.92') }}"
                  >
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>

                
                <div class="modal-body booking-modal__body">
                  <div class="booking-modal__tabs">
                    <div class="view-tabs" role="tablist"  aria-label="{{ __('company.common.312') }}">
                      <button
                        type="button"
                        class="view-tabs__btn is-active"
                        data-pending-booking-tab="summary"
                        aria-selected="true"
                      >
                        <i class="bi bi-file-text"></i>
                        <span>{{ __('company.common.239') }}</span>
                      </button>
                      <button
                        type="button"
                        class="view-tabs__btn"
                        data-pending-booking-tab="rating"
                        aria-selected="false"
                      >
                        <i class="bi bi-star"></i>
                        <span>{{ __('company.common.162') }}</span>
                      </button>

                      <button
                        type="button"
                        class="view-tabs__btn"
                        data-pending-booking-tab="bank"
                        aria-selected="false"
                      >
                        <i class="bi bi-bank"></i>
                        <span>{{ __('company.common.540') }}</span>
                      </button>
                    </div>
                  </div>

                  <div class="tab-content booking-modal__content">
                    
                    <div
                      class="pending-booking-panel is-active"
                      data-pending-booking-panel="summary"
                    >
                      <div class="bkmodal-section-label">{{ __('company.common.273') }}</div>
                      <div class="booking-details-grid">
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-truck"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.171') }}</span>
                            <span class="booking-detail-item__value" id="pendingBookingService"
                              >{{ __('company.common.300') }}</span
                            >
                          </div>
                        </div>
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-person"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.449') }}</span>
                            <span class="booking-detail-item__value" id="pendingBookingCustomer"
                              >{{ __('company.pages.pending-reservations.5') }}</span
                            >
                          </div>
                        </div>
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-calendar3"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.284') }}</span>
                            <span
                              class="booking-detail-item__value ltr-num"
                              id="pendingBookingPickupDate"
                              >2026-07-18</span
                            >
                          </div>
                        </div>
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-clock"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.587') }}</span>
                            <span
                              class="booking-detail-item__value ltr-num"
                              id="pendingBookingPickupTime"
                              >10:30</span
                            >
                          </div>
                        </div>
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-calendar-range"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.219') }}</span>
                            <span class="booking-detail-item__value" id="pendingBookingPeriod"
                              >1</span
                            >
                          </div>
                        </div>
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-car-front"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.430') }}</span>
                            <span class="booking-detail-item__value" id="pendingBookingCar"
                              >Toyota Yaris 2026</span
                            >
                          </div>
                        </div>
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-currency-dollar"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.423') }}</span>
                            <span
                              class="booking-detail-item__value ltr-num"
                              id="pendingBookingPrice"
                              >{{ __('company.common.15') }}</span
                            >
                          </div>
                        </div>
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-building"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.431') }}</span>
                            <span class="booking-detail-item__value" id="pendingBookingCompany"
                              >N2</span
                            >
                          </div>
                        </div>
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-geo-alt"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.235') }}</span>
                            <span class="booking-detail-item__value" id="pendingBookingOffice"
                              >{{ __('company.pages.pending-reservations.19') }}</span
                            >
                          </div>
                        </div>
                      </div>

                      <div class="bkmodal-section-label">{{ __('company.common.173') }}</div>
                      <div class="booking-details-grid">
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-credit-card"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.437') }}</span>
                            <span class="booking-detail-item__value" id="pendingBookingPayment"
                              >{{ __('company.common.267') }}</span
                            >
                          </div>
                        </div>
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-info-circle"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.365') }}</span>
                            <span class="booking-detail-item__value" id="pendingBookingAccepted"
                              >{{ __('company.common.495') }}</span
                            >
                          </div>
                        </div>
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-cash"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.160') }}</span>
                            <span class="booking-detail-item__value" id="pendingBookingCompensation"
                              >0</span
                            >
                          </div>
                        </div>
                      </div>
                    </div>

                    
                    <div class="pending-booking-panel" data-pending-booking-panel="rating">
                      <div class="reservation-rating-card">
                        <div class="reservation-rating-card__score">
                          <span class="reservation-rating-card__number" id="pendingBookingRating"
                            >5</span
                          >
                          <div
                            class="reservation-rating-card__stars"
                            id="pendingBookingRatingStars"
                          >
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                          </div>
                        </div>

                        <div class="booking-details-grid">
                          <div class="booking-detail-item">
                            <div class="booking-detail-item__icon">
                              <i class="bi bi-person"></i>
                            </div>
                            <div class="booking-detail-item__content">
                              <span class="booking-detail-item__label">{{ __('company.common.328') }}</span>
                              <span class="booking-detail-item__value" id="pendingBookingRatedBy"
                                >{{ __('company.pages.pending-reservations.5') }}</span
                              >
                            </div>
                          </div>
                          <div class="booking-detail-item">
                            <div class="booking-detail-item__icon">
                              <i class="bi bi-calendar3"></i>
                            </div>
                            <div class="booking-detail-item__content">
                              <span class="booking-detail-item__label">{{ __('company.common.289') }}</span>
                              <span
                                class="booking-detail-item__value ltr-num"
                                id="pendingBookingRatingDate"
                                >2026-07-18</span
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    
                    <div class="pending-booking-panel" data-pending-booking-panel="bank">
                      <div class="bkmodal-section-label">{{ __('company.common.540') }}</div>
                      <div class="booking-details-grid">
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-bank"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.132') }}</span>
                            <span class="booking-detail-item__value" id="pendingBookingBankName"
                              >-</span
                            >
                          </div>
                        </div>
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-credit-card"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.141') }}</span>
                            <span class="booking-detail-item__value ltr-num" id="pendingBookingIban"
                              >-</span
                            >
                          </div>
                        </div>
                        <div class="booking-detail-item">
                          <div class="booking-detail-item__icon">
                            <i class="bi bi-person-badge"></i>
                          </div>
                          <div class="booking-detail-item__content">
                            <span class="booking-detail-item__label">{{ __('company.common.79') }}</span>
                            <span class="booking-detail-item__value" id="pendingBookingCardHolder"
                              >-</span
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                
                <div class="modal-footer booking-modal__footer">
                  <a
                    href="{{ route('company.booking-details-two') }}"
                    type="button"
                    class="btn btn-primary"
                    id="pendingBookingDetailsBtn"
                  >
                    <i class="bi bi-file-earmark-text"></i> {{ __('company.common.312') }}</a>
                  <div class="pending-booking-modal__footer-actions">
                    <button
                      type="button"
                      class="pending-booking-link"
                      data-pending-modal-action="combined-history"
                    >
                      <i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</button>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a href="#" class="visually-hidden" id="pendingInvoiceDownload" download></a>

          
          <div
            class="modal fade"
            id="dateRangeModal"
            tabindex="-1"
            aria-hidden="true"
            aria-labelledby="dateRangeModalLabel"
          >
            <div class="modal-dialog modal-dialog-centered daterange-modal-dialog">
              <div class="modal-content daterange-modal">
                <span class="visually-hidden" id="dateRangeModalLabel">{{ __('company.common.124') }}</span>
                <div class="daterange-modal__body">
                  <div class="daterange-presets">
                    <button type="button" class="daterange-presets__item" data-quick="today">
                      {{ __('company.common.249') }}</button>
                    <button type="button" class="daterange-presets__item" data-quick="yesterday">
                      {{ __('company.common.68') }}</button>
                    <button type="button" class="daterange-presets__item" data-quick="thisWeek">
                      {{ __('company.common.147') }}</button>
                    <button type="button" class="daterange-presets__item" data-quick="lastWeek">
                      {{ __('company.common.142') }}</button>
                    <button
                      type="button"
                      class="daterange-presets__item is-active"
                      data-quick="thisMonth"
                    >
                      {{ __('company.common.209') }}</button>
                    <button type="button" class="daterange-presets__item" data-quick="lastMonth">
                      {{ __('company.common.210') }}</button>
                    <div class="daterange-presets__days">
                      <label for="daysBeforeInput">{{ __('company.common.143') }}</label>
                      <input type="number" id="daysBeforeInput" min="1" value="1" />
                    </div>
                  </div>

                  <div class="daterange-modal__main">
                    <div class="daterange-inputs">
                      <input type="text" class="ltr-num" id="dateFromField" readonly />
                      <input type="text" class="ltr-num is-active" id="dateToField" readonly />
                    </div>

                    <div class="daterange-calendars">
                      <div class="daterange-calendars__year">
                        <div class="dropdown">
                          <button
                            class="year-select-btn dropdown-toggle"
                            type="button"
                            id="yearSelectBtn"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          ></button>
                          <ul class="dropdown-menu" id="yearSelectMenu"></ul>
                        </div>
                      </div>

                      <div class="daterange-calendars__grid">
                        <div class="calendar-month">
                          <div class="calendar-month__header">
                            <button
                              type="button"
                              class="calendar-nav"
                              id="calPrevBtn"
                               aria-label="{{ __('company.common.210') }}"
                            >
                              <i class="bi bi-chevron-right"></i>
                            </button>
                            <span class="calendar-month__title" id="calTitleRight"></span>
                            <span class="calendar-month__spacer"></span>
                          </div>
                          <div class="calendar-month__weekdays">
                            <span>{{ __('company.common.420') }}</span><span>{{ __('company.common.51') }}</span><span>{{ __('company.common.103') }}</span><span>{{ __('company.common.356') }}</span
                            ><span>{{ __('company.common.63') }}</span><span>{{ __('company.common.383') }}</span><span>{{ __('company.common.361') }}</span>
                          </div>
                          <div class="calendar-month__days" id="calDaysRight"></div>
                        </div>

                        <div class="calendar-month">
                          <div class="calendar-month__header">
                            <span class="calendar-month__spacer"></span>
                            <span class="calendar-month__title" id="calTitleLeft"></span>
                            <button
                              type="button"
                              class="calendar-nav"
                              id="calNextBtn"
                               aria-label="{{ __('company.common.208') }}"
                            >
                              <i class="bi bi-chevron-left"></i>
                            </button>
                          </div>
                          <div class="calendar-month__weekdays">
                            <span>{{ __('company.common.420') }}</span><span>{{ __('company.common.51') }}</span><span>{{ __('company.common.103') }}</span><span>{{ __('company.common.356') }}</span
                            ><span>{{ __('company.common.63') }}</span><span>{{ __('company.common.383') }}</span><span>{{ __('company.common.361') }}</span>
                          </div>
                          <div class="calendar-month__days" id="calDaysLeft"></div>
                        </div>
                      </div>
                    </div>

                    <div class="daterange-modal__actions">
                      <button type="button" class="btn btn-primary btn-sm" id="dateRangeConfirmBtn">
                        {{ __('company.common.566') }}</button>
                      <button type="button" class="btn btn-outline btn-sm" data-bs-dismiss="modal">
                        {{ __('company.common.392') }}</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('modals')
</main>
        
      

    
    <div
      class="modal fade"
      id="assignDriverModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="assignDriverModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon">
                <i class="bi bi-pen"></i>
              </div>
              <div>
                <h2 class="bkmodal-header__ref" id="assignDriverModalLabel">{{ __('company.common.80') }}</h2>
                <div class="bkmodal-header__meta">
                  <span><i class="bi bi-person-badge"></i> {{ __('company.common.123') }}</span>
                </div>
              </div>
            </div>
            <button
              type="button"
              class="booking-modal__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
          <div class="modal-body booking-modal__body">
            <label for="driverSelect" class="form-label">{{ __('company.common.188') }}</label>
            <select class="form-select" id="driverSelect">
              <option selected>{{ __('company.common.106') }}</option>
              <option>{{ __('company.common.408') }}</option>
              <option>{{ __('company.common.409') }}</option>
              <option>{{ __('company.common.410') }}</option>
              <option>{{ __('company.common.411') }}</option>
              <option>{{ __('company.common.412') }}</option>
            </select>
          </div>
          <div class="modal-footer booking-modal__footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.392') }}</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ __('company.common.558') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="editPendingReservationModal"
      tabindex="-1"
      aria-labelledby="editPendingReservationModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editPendingReservationModalLabel">{{ __('company.pages.pending-reservations.20') }}</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body">
            <form id="editPendingReservationForm">
              <div class="row gy-3 mb-3">
                <div class="col-md-6">
                  <label for="editPendingRef" class="form-label">{{ __('company.common.398') }}</label>
                  <input
                    type="text"
                    class="form-control bg-light"
                    id="editPendingRef"
                    readonly
                    style="cursor: not-allowed"
                  />
                </div>
                <div class="col-md-6">
                  <label for="editPendingCustomer" class="form-label">{{ __('company.common.215') }}</label>
                  <input
                    type="text"
                    class="form-control bg-light"
                    id="editPendingCustomer"
                    readonly
                    style="cursor: not-allowed"
                  />
                </div>
                <div class="col-md-6">
                  <label for="editPendingCar" class="form-label">{{ __('company.common.203') }}</label>
                  <input type="text" class="form-control" id="editPendingCar" />
                  <div
                    class="text-danger mt-1"
                    id="editPendingCarError"
                    style="display: none; font-size: 0.8rem"
                  ></div>
                </div>
                <div class="col-md-6">
                  <label for="editPendingCity" class="form-label">{{ __('company.common.229') }}</label>
                  <input type="text" class="form-control" id="editPendingCity" />
                  <div
                    class="text-danger mt-1"
                    id="editPendingCityError"
                    style="display: none; font-size: 0.8rem"
                  ></div>
                </div>
                <div class="col-md-6">
                  <label for="editPendingStartDate" class="form-label">{{ __('company.common.286') }}</label>
                  <input type="datetime-local" class="form-control" id="editPendingStartDate" />
                  <div
                    class="text-danger mt-1"
                    id="editPendingStartDateError"
                    style="display: none; font-size: 0.8rem"
                  ></div>
                </div>
                <div class="col-md-6">
                  <label for="editPendingEndDate" class="form-label">{{ __('company.common.285') }}</label>
                  <input type="date" class="form-control" id="editPendingEndDate" />
                  <div
                    class="text-danger mt-1"
                    id="editPendingEndDateError"
                    style="display: none; font-size: 0.8rem"
                  ></div>
                </div>
                <div class="col-md-6">
                  <label for="editPendingDriver" class="form-label">{{ __('company.common.188') }}</label>
                  <select class="form-select" id="editPendingDriver">
                    <option value="شيفا بالا">{{ __('company.common.433') }}</option>
                    <option value="سائق 1">{{ __('company.common.408') }}</option>
                    <option value="سائق 2">{{ __('company.common.409') }}</option>
                    <option value="سائق 3">{{ __('company.common.410') }}</option>
                    <option value="سائق 4">{{ __('company.common.411') }}</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="editPendingStatus" class="form-label">{{ __('company.common.165') }}</label>
                  <select class="form-select" id="editPendingStatus">
                    <option value="بانتظار الموافقة">{{ __('company.common.251') }}</option>
                    <option value="مقبول">{{ __('company.common.545') }}</option>
                    <option value="مرفوض">{{ __('company.common.521') }}</option>
                    <option value="ملغي">{{ __('company.common.554') }}</option>
                  </select>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.392') }}</button>
            <button type="button" class="btn btn-primary" id="savePendingReservationBtn">
              {{ __('company.common.376') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="successModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="successModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center py-5">
            <div class="mb-4">
              <i class="bi bi-check-circle-fill text-success" style="font-size: 64px"></i>
            </div>
            <h4 class="mb-3" style="font-family: 'Alexandria', sans-serif; font-weight: 600">
              {{ __('company.common.329') }}</h4>
            <p class="text-muted mb-4" style="font-family: 'Alexandria', sans-serif">
              {{ __('company.common.333') }}</p>
            <button type="button" class="btn btn-primary m-auto" data-bs-dismiss="modal">
              {{ __('company.common.374') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="reservationStatusConfirmModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="reservationStatusConfirmTitle"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content confirm-modal">
          <div class="modal-body text-center p-4">
            <div class="confirm-modal__icon" id="reservationStatusConfirmIcon">
              <i class="bi" id="reservationStatusConfirmIconEl"></i>
            </div>
            <h2 class="confirm-modal__title" id="reservationStatusConfirmTitle"></h2>
            <p class="confirm-modal__text" id="reservationStatusConfirmText"></p>
            <div class="d-flex justify-content-center gap-2 mt-4">
              <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
              <button type="button" class="btn btn-primary" id="reservationStatusConfirmBtn">
                {{ __('company.common.275') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="cancellationReasonModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="cancellationReasonModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon">
                <i class="bi bi-x-circle text-danger"></i>
              </div>
              <div>
                <h2 class="bkmodal-header__ref" id="cancellationReasonModalLabel">{{ __('company.common.393') }}</h2>
                <div class="bkmodal-header__meta">
                  <span><i class="bi bi-file-earmark-text"></i> {{ __('company.common.369') }}</span>
                </div>
              </div>
            </div>
            <button
              type="button"
              class="booking-modal__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
          <div class="modal-body booking-modal__body">
            <div class="mb-3">
              <label for="cancellationReason" class="form-label">{{ __('company.common.419') }}</label>
              <select class="form-select" id="cancellationReason">
                <option value="" selected disabled>{{ __('company.common.119') }}</option>
                <option value="السيارة غير متوفرة">{{ __('company.common.204') }}</option>
                <option value="بيانات العميل غير مكتملة">{{ __('company.common.274') }}</option>
                <option value="مديونية وبلاك لست مع ارفاق اثبات">
                  {{ __('company.common.519') }}</option>
                <option value="العميل لم يحضر للاستلام">{{ __('company.common.216') }}</option>
                <option value="عمر العميل اقل من 21 سنة">{{ __('company.common.447') }}</option>
                <option value="عمر العميل اكبر من 65 سنة">{{ __('company.common.448') }}</option>
                <option value="أسباب تقنية">{{ __('company.common.65') }}</option>
                <option value="أسباب أخرى">{{ __('company.common.64') }}</option>
              </select>
              <div
                class="text-danger mt-1"
                id="cancellationReasonError"
                style="display: none; font-size: 0.8rem"
              >
                {{ __('company.common.591') }}</div>
            </div>
            <div class="mb-3" id="cancellationNotesContainer" style="display: none">
              <label for="cancellationNotes" class="form-label"> {{ __('company.common.417') }}</label>
              <textarea
                class="form-control"
                id="cancellationNotes"
                rows="3"
                 placeholder="{{ __('company.common.140') }}"
              ></textarea>
            </div>
            
          </div>
          <div class="modal-footer booking-modal__footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
            <button type="button" class="btn btn-danger" id="confirmCancellationBtn">
              <i class="bi bi-x-circle"></i> {{ __('company.common.277') }}</button>
          </div>
        </div>
      </div>
    </div>

    
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        const pendingBookingModalEl = document.getElementById('pendingBookingModal');
        if (!pendingBookingModalEl || typeof bootstrap === 'undefined') return;

        const pendingBookingModal = new bootstrap.Modal(pendingBookingModalEl);
        let activePendingBookingRow = null;
        const actionLabels = {
          cancel: 'رفض الحجز',
          'combined-history': 'تاريخ العمليات والحجز',
          review: 'إضافة تقييم',
          invoice: 'تنزيل الفاتورة',
        };

        function textFrom(row, selector) {
          const el = row.querySelector(selector);
          return el ? el.textContent.trim() : '';
        }

        // NOTE: pendingBookingModal itself is now STATIC HTML — this
        // function is kept only because the history modal still needs a
        // booking ref and a pickup date to stamp onto its rows.
        function getBookingData(row) {
          const periodText = textFrom(row, '.cell-period__dates');
          const pickupParts = periodText.split(' ');

          return {
            ref: textFrom(row, '.cell-booking-ref').replace(/\s+/g, ''),
            pickupDate: pickupParts[0]
              ? pickupParts[0].split('/').reverse().join('-')
              : '2026-07-30',
          };
        }

        function showPendingBookingTab(tabName) {
          document.querySelectorAll('[data-pending-booking-tab]').forEach(function (tab) {
            const isActive = tab.dataset.pendingBookingTab === tabName;
            tab.classList.toggle('is-active', isActive);
            tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
          });

          document.querySelectorAll('[data-pending-booking-panel]').forEach(function (panel) {
            panel.classList.toggle('is-active', panel.dataset.pendingBookingPanel === tabName);
          });
        }

        const pendingHistoryModalEl = document.getElementById('pendingHistoryModal');
        const pendingHistoryModal = new bootstrap.Modal(pendingHistoryModalEl);
        const pendingHistoryWrap = document.getElementById('pendingHistoryTableWrap');
        const pendingHistoryThumb = document.getElementById('pendingHistoryScrollThumb');

        function updatePendingHistoryThumb() {
          if (!pendingHistoryWrap || !pendingHistoryThumb) return;

          const trackHeight = pendingHistoryWrap.clientHeight;
          const ratio = pendingHistoryWrap.clientHeight / pendingHistoryWrap.scrollHeight;
          const thumbHeight = Math.max(ratio * trackHeight, 24);
          const maxScroll = pendingHistoryWrap.scrollHeight - pendingHistoryWrap.clientHeight;
          const scrollRatio = maxScroll > 0 ? pendingHistoryWrap.scrollTop / maxScroll : 0;

          pendingHistoryThumb.style.height = thumbHeight + 'px';
          pendingHistoryThumb.style.top = scrollRatio * (trackHeight - thumbHeight) + 'px';
        }

        function fillPendingHistoryModal(row, action) {
          const data = getBookingData(row);
          const messages = [
            'تم إنشاء الحجز.',
            'تم تسجيل بيانات العميل.',
            'تم انتظار الموافقة على الحجز.',
            'تم تحديث حالة الحجز.',
            'تم إنشاء عملية الدفع.',
            'تم تأكيد طريقة الدفع.',
            'تم إصدار الفاتورة.',
            'لا يوجد تعويض مسجل.',
          ];
          const users = [
            'نظام',
            'نظام',
            'نظام',
            'نظام',
            'نظام الدفع',
            'نظام',
            'نظام الفواتير',
            'نظام',
          ];
          const times = [
            '10:30:00',
            '10:33:16',
            '10:35:42',
            '10:39:10',
            '09:12:14',
            '09:14:38',
            '09:16:02',
            '09:18:20',
          ];

          document.getElementById('pendingHistoryModalLabel').textContent = 'تاريخ العمليات والحجز';

          pendingHistoryModalEl.querySelectorAll('[data-history-ref]').forEach(function (cell) {
            cell.textContent = data.ref;
          });
          pendingHistoryModalEl
            .querySelectorAll('[data-history-message]')
            .forEach(function (cell, index) {
              cell.textContent = messages[index];
            });
          pendingHistoryModalEl
            .querySelectorAll('[data-history-user]')
            .forEach(function (cell, index) {
              cell.textContent = users[index];
            });
          pendingHistoryModalEl
            .querySelectorAll('[data-history-date]')
            .forEach(function (cell, index) {
              cell.textContent = data.pickupDate + ' ' + times[index];
            });
        }

        function hasSelectedPendingFilters() {
          return (
            (document.getElementById('toggleDelivery')?.checked ?? false) ||
            (document.getElementById('toggleRejected')?.checked ?? false) ||
            (document.getElementById('toggleEpayment')?.checked ?? false)
          );
        }

        function syncPendingFilterControls() {
          const hasFilters = hasSelectedPendingFilters();

          document.getElementById('pendingFiltersClearBtn').classList.toggle('d-none', !hasFilters);
          document
            .getElementById('pendingFiltersSubmitBtn')
            .classList.toggle('d-none', !hasFilters);
        }

        function applyPendingReservationFilters() {
          const searchValue = document
            .getElementById('pendingSearchInput')
            .value.trim()
            .toLowerCase();
          const deliveryOnly = document.getElementById('toggleDelivery')?.checked ?? false;
          const rejectedOnly = document.getElementById('toggleRejected')?.checked ?? false;
          const epaymentOnly = document.getElementById('toggleEpayment')?.checked ?? false;

          document.querySelectorAll('#pendingTable tbody tr').forEach(function (row) {
            const rowText = row.textContent.trim().toLowerCase();
            const matchesSearch = !searchValue || rowText.includes(searchValue);
            const matchesDelivery = !deliveryOnly || row.dataset.pendingDelivery === 'true';
            const matchesRejected = !rejectedOnly || row.dataset.pendingRejected === 'true';
            const matchesEpayment = !epaymentOnly || row.dataset.pendingPayment === 'electronic';

            row.style.display =
              matchesSearch && matchesDelivery && matchesRejected && matchesEpayment ? '' : 'none';
          });
        }

        function setPendingColumnVisibility(columnName, isVisible) {
          document
            .querySelectorAll('#pendingTable [data-optional-column="' + columnName + '"]')
            .forEach(function (cell) {
              cell.classList.toggle('d-none', !isVisible);
            });
        }

        function applyPendingColumns() {
          const columnKeys = ['accepted', 'reservation', 'days', 'price'];
          const selectedColumns = Array.from(
            document.querySelectorAll('[data-column-toggle]:checked'),
          ).map(function (checkbox) {
            return checkbox.dataset.columnToggle;
          });

          columnKeys.forEach(function (key) {
            setPendingColumnVisibility(key, selectedColumns.includes(key));
          });
        }

        document
          .getElementById('pendingSearchInput')
          .addEventListener('input', applyPendingReservationFilters);

        document
          .querySelectorAll('#toggleDelivery, #toggleRejected, #toggleEpayment')
          .forEach(function (toggle) {
            toggle.addEventListener('change', syncPendingFilterControls);
          });

        document
          .getElementById('pendingFiltersSubmitBtn')
          .addEventListener('click', applyPendingReservationFilters);

        document.getElementById('pendingFiltersClearBtn').addEventListener('click', function () {
          document
            .querySelectorAll('#toggleDelivery, #toggleRejected, #toggleEpayment')
            .forEach(function (toggle) {
              toggle.checked = false;
            });
          syncPendingFilterControls();
          applyPendingReservationFilters();
        });

        const pendingColumnsApplyBtn = document.getElementById('pendingApplyColumnsBtn');
        if (pendingColumnsApplyBtn) {
          pendingColumnsApplyBtn.addEventListener('click', function () {
            applyPendingColumns();
            bootstrap.Modal.getOrCreateInstance(
              document.getElementById('pendingColumnsModal'),
            ).hide();
          });
        }

        const pendingColumnsSelectAllBtn = document.getElementById('pendingColumnsSelectAllBtn');
        if (pendingColumnsSelectAllBtn) {
          pendingColumnsSelectAllBtn.addEventListener('click', function () {
            document.querySelectorAll('[data-column-toggle]').forEach(function (checkbox) {
              checkbox.checked = false;
            });
            applyPendingColumns();
          });
        }

        document.querySelectorAll('[data-pending-booking-tab]').forEach(function (tab) {
          tab.addEventListener('click', function () {
            showPendingBookingTab(this.dataset.pendingBookingTab);
          });
        });

        pendingHistoryWrap.addEventListener('scroll', updatePendingHistoryThumb);
        pendingHistoryModalEl.addEventListener('shown.bs.modal', updatePendingHistoryThumb);
        window.addEventListener('resize', updatePendingHistoryThumb);

        document.getElementById('pendingHistoryScrollUpBtn').addEventListener('click', function () {
          pendingHistoryWrap.scrollBy({ top: -100, behavior: 'smooth' });
        });
        document
          .getElementById('pendingHistoryScrollDownBtn')
          .addEventListener('click', function () {
            pendingHistoryWrap.scrollBy({ top: 100, behavior: 'smooth' });
          });

        // Handle booking reference clicks to open reservation details modal.
        // The modal content itself is static HTML now — clicking just
        // remembers which row was clicked (needed by the history modal)
        // and opens the summary tab.
        document.querySelectorAll('.cell-booking-ref').forEach(function (link) {
          link.addEventListener('click', function (e) {
            e.preventDefault();
            const row = this.closest('tr');
            if (!row) return;
            activePendingBookingRow = row;
            showPendingBookingTab('summary');
            pendingBookingModal.show();
          });
        });

        function closePendingActionMenus() {
          document.querySelectorAll('.action-menu-dropdown').forEach(function (dropdown) {
            dropdown.classList.remove('is-visible');
          });
        }

        // Three-dot actions float outside the table so they do not reserve row height.
        // Action menu logic is handled by global script.js

        document.querySelectorAll('[data-pending-action]').forEach(function (item) {
          item.addEventListener('click', function (event) {
            event.stopPropagation();

            const row = this.closest('tr');
            const action = this.dataset.pendingAction;
            const label = actionLabels[action] || this.textContent.trim();

            activePendingBookingRow = row;
            closePendingActionMenus();

            if (action === 'invoice') {
              const ref = textFrom(row, '.cell-booking-ref').replace(/\s+/g, '');
              const invoiceBlob = new Blob(['Invoice for ' + ref], {
                type: 'text/plain;charset=utf-8',
              });
              const url = URL.createObjectURL(invoiceBlob);
              const downloadLink = document.getElementById('pendingInvoiceDownload');
              downloadLink.href = url;
              downloadLink.download = ref.replace('#', '') + '-invoice.txt';
              downloadLink.click();
              URL.revokeObjectURL(url);
              return;
            }

            if (action === 'combined-history') {
              fillPendingHistoryModal(row, action);
              pendingHistoryModal.show();
              return;
            }

            // "review" (and any other row action that opens the booking
            // modal) just switches to the relevant static tab — the
            // modal's content is fixed HTML, not filled from the row.
            showPendingBookingTab(action === 'review' ? 'rating' : 'summary');
            pendingBookingModal.show();
            pendingBookingModalEl.dataset.lastAction = label;
          });
        });

        document.querySelectorAll('[data-pending-modal-action]').forEach(function (btn) {
          btn.addEventListener('click', function () {
            if (activePendingBookingRow) {
              fillPendingHistoryModal(activePendingBookingRow, this.dataset.pendingModalAction);
              pendingBookingModalEl.addEventListener(
                'hidden.bs.modal',
                function () {
                  pendingHistoryModal.show();
                },
                { once: true },
              );
            }

            pendingBookingModal.hide();
          });
        });

        const pendingBookingDetailsBtn = document.getElementById('pendingBookingDetailsBtn');
        if (pendingBookingDetailsBtn) {
          pendingBookingDetailsBtn.addEventListener('click', function () {
            pendingBookingModal.hide();
          });
        }

        /* ============================================================
         Cancellation Reason Modal Logic
         ------------------------------------------------------------
         UX rules:
         - The error message stays hidden until the user actually
           clicks "تأكيد الرفض" without picking a reason.
         - The moment the user picks a reason, the error disappears
           immediately (no need to click confirm again).
         - The whole form (select, error state, notes field) resets
           itself every time the modal is closed, no matter how it
           was closed (Cancel button, backdrop click, Escape key,
           or a fresh "رفض الحجز" click on a different row).
      ============================================================= */
        let currentCancellingRow = null;
        let cancellationConfirmed = false;
        const cancellationReasonModalEl = document.getElementById('cancellationReasonModal');
        const cancellationReasonModal = cancellationReasonModalEl
          ? new bootstrap.Modal(cancellationReasonModalEl)
          : null;
        const cancellationReasonSelect = document.getElementById('cancellationReason');
        const cancellationNotesContainer = document.getElementById('cancellationNotesContainer');
        const cancellationNotesField = document.getElementById('cancellationNotes');
        const cancellationReasonError = document.getElementById('cancellationReasonError');

        function resetCancellationForm() {
          if (cancellationReasonSelect) {
            cancellationReasonSelect.value = '';
          }
          if (cancellationNotesContainer) {
            cancellationNotesContainer.style.display = 'none';
          }
          if (cancellationNotesField) {
            cancellationNotesField.value = '';
          }
          if (cancellationReasonError) {
            cancellationReasonError.style.display = 'none';
          }
        }

        // Toggle the optional notes field for "أسباب أخرى", and clear the
        // validation error the moment the user picks a reason.
        if (cancellationReasonSelect) {
          cancellationReasonSelect.addEventListener('change', function () {
            if (cancellationNotesContainer) {
              cancellationNotesContainer.style.display =
                this.value === 'أسباب أخرى' ? 'block' : 'none';
            }
            if (cancellationReasonError && this.value) {
              cancellationReasonError.style.display = 'none';
            }
          });
        }

        // Accept/reject/re-accept menu items — definitions for the entries
        // that get rebuilt in a row's action menu as its status changes
        // (same accept/reject/re-accept behavior as reservations.html).
        const PENDING_SCHEDULED_ACTION_DEFS = {
          accept: { cssClass: 'text-success', icon: 'bi-check-circle', label: 'قبول الحجز' },
          cancel: { cssClass: 'text-danger', icon: 'bi-x-circle', label: 'رفض الحجز' },
          // reaccept: { cssClass: 'text-success', icon: 'bi-check2-circle', label: 'إعادة قبول الحجز' },
        };

        function buildPendingActionItem(action) {
          const def = PENDING_SCHEDULED_ACTION_DEFS[action];
          const li = document.createElement('li');
          if (!def) return li;
          li.innerHTML =
            '<button type="button" class="dropdown-item action-menu-item ' +
            def.cssClass +
            '" data-scheduled-action="' +
            action +
            '"><i class="bi ' +
            def.icon +
            '"></i> ' +
            def.label +
            '</button>';
          return li;
        }

        // Rebuild the accept/reject portion of a row's action menu to match
        // its current status: pending shows accept + reject, accepted keeps
        // only reject, rejected offers re-accept only.
        function updatePendingActionMenu(row, statusKey) {
          const menu = row.querySelector('.action-dropdown .dropdown-menu');
          if (!menu) return;

          menu
            .querySelectorAll('[data-scheduled-action="accept"], [data-scheduled-action="cancel"]')
            .forEach(function (btn) {
              const li = btn.closest('li');
              if (li) li.remove();
            });

          const actionsByStatus = {
            pending: ['accept', 'cancel'],
            accepted: ['cancel'],
            // rejected: ['reaccept'],
          };

          (actionsByStatus[statusKey] || [])
            .slice()
            .reverse()
            .forEach(function (action) {
              menu.insertBefore(buildPendingActionItem(action), menu.firstElementChild);
            });
        }

        function closeRowDropdown(item) {
          const dropdown = item.closest('.dropdown');
          if (!dropdown) return;
          const dropdownInstance = bootstrap.Dropdown.getInstance(
            dropdown.querySelector('.dropdown-toggle'),
          );
          if (dropdownInstance) {
            dropdownInstance.hide();
          }
        }

        // Handle the "قبول الحجز" / "إعادة قبول الحجز" menu items to
        // approve a pending reservation, update its status, and reveal
        // the driver-assignment icon.
        function acceptPendingReservation(row) {
          if (!row) return;

          const statusBadge = row.querySelector('.badge');
          if (statusBadge) {
            statusBadge.className = 'badge bg-success';
            statusBadge.textContent = 'مقبول';
          }

          const acceptedCell = row.querySelector('[data-optional-column="accepted"]');
          if (acceptedCell) {
            acceptedCell.textContent = 'نعم';
          }

          const assignmentIcons = row.querySelector('.cell-assignment__icons');
          if (assignmentIcons) {
            assignmentIcons.classList.remove('d-none');
          }

          updatePendingActionMenu(row, 'accepted');

          const successModal = new bootstrap.Modal(document.getElementById('successModal'));
          successModal.show();
        }

        // Accept confirmation — same "قبول الحجز؟ / سيتم قبول هذا الحجز
        // وتفعيله." confirm-modal flow used on reservations.html, shown
        // before a pending reservation is actually accepted.
        const PENDING_ACCEPT_CONFIRM_CONFIG = {
          accept: {
            icon: 'bi-check-circle',
            title: 'قبول الحجز؟',
            text: 'سيتم قبول هذا الحجز وتفعيله.',
          },
          // reaccept: {
          //   icon: 'bi-check2-circle',
          //   title: 'إعادة قبول الحجز؟',
          //   text: 'سيتم قبول هذا الحجز مرة أخرى وتفعيله.',
          // },
        };

        const reservationStatusConfirmModalEl = document.getElementById(
          'reservationStatusConfirmModal',
        );
        const reservationStatusConfirmModal = reservationStatusConfirmModalEl
          ? new bootstrap.Modal(reservationStatusConfirmModalEl)
          : null;
        let reservationStatusConfirmRow = null;

        function openAcceptConfirm(row, action) {
          const cfg = PENDING_ACCEPT_CONFIRM_CONFIG[action];
          if (!cfg || !row || !reservationStatusConfirmModal) return;

          reservationStatusConfirmRow = row;
          document.getElementById('reservationStatusConfirmIcon').className =
            'confirm-modal__icon confirm-modal__icon--success';
          document.getElementById('reservationStatusConfirmIconEl').className = 'bi ' + cfg.icon;
          document.getElementById('reservationStatusConfirmTitle').textContent = cfg.title;
          document.getElementById('reservationStatusConfirmText').textContent = cfg.text;
          reservationStatusConfirmModal.show();
        }

        const reservationStatusConfirmBtn = document.getElementById('reservationStatusConfirmBtn');
        if (reservationStatusConfirmBtn) {
          reservationStatusConfirmBtn.addEventListener('click', function () {
            if (!reservationStatusConfirmRow) return;
            const row = reservationStatusConfirmRow;
            reservationStatusConfirmRow = null;

            reservationStatusConfirmModalEl.addEventListener(
              'hidden.bs.modal',
              function () {
                acceptPendingReservation(row);
              },
              { once: true },
            );
            reservationStatusConfirmModal.hide();
          });
        }

        if (reservationStatusConfirmModalEl) {
          reservationStatusConfirmModalEl.addEventListener('hidden.bs.modal', function () {
            reservationStatusConfirmRow = null;
          });
        }

        // Single delegated listener so it also covers menu items rebuilt
        // dynamically by updatePendingActionMenu (e.g. "إعادة قبول الحجز").
        document.addEventListener('click', function (event) {
          const item = event.target.closest('[data-scheduled-action]');
          if (!item) return;

          event.stopPropagation();
          const row = item.closest('tr');
          if (!row) return;
          const action = item.getAttribute('data-scheduled-action');

          if (action === 'accept') {
            openAcceptConfirm(row, action);
            closeRowDropdown(item);
          } else if (action === 'cancel') {
            if (!cancellationReasonModal) return;
            currentCancellingRow = row;
            resetCancellationForm();
            cancellationReasonModal.show();
            closeRowDropdown(item);
          }
        });

        // Handle confirmation of cancellation
        const confirmCancellationBtn = document.getElementById('confirmCancellationBtn');
        if (confirmCancellationBtn) {
          confirmCancellationBtn.addEventListener('click', function () {
            if (!cancellationReasonSelect || !cancellationReasonSelect.value) {
              if (cancellationReasonError) {
                cancellationReasonError.style.display = 'block';
              }
              return;
            }

            if (currentCancellingRow) {
              // Update the row status
              const statusBadge = currentCancellingRow.querySelector('.badge');
              if (statusBadge) {
                statusBadge.className = 'badge bg-danger';
                statusBadge.textContent = 'مرفوض';
              }
              currentCancellingRow.dataset.pendingRejected = 'true';
              updatePendingActionMenu(currentCancellingRow, 'rejected');

              // Apply filters
              applyPendingReservationFilters();

              // Close the modal; the success modal is shown once this one
              // has fully finished hiding (see hidden.bs.modal listener
              // below) so the two modals/backdrops don't overlap.
              cancellationConfirmed = true;
              cancellationReasonModal.hide();
            }
          });
        }

        // Always reset the form when the modal closes, regardless of how
        // it was closed (Cancel button, backdrop click, Escape key, etc).
        if (cancellationReasonModalEl) {
          cancellationReasonModalEl.addEventListener('hidden.bs.modal', function () {
            resetCancellationForm();
            currentCancellingRow = null;

            if (cancellationConfirmed) {
              cancellationConfirmed = false;
              const successModal = new bootstrap.Modal(document.getElementById('successModal'));
              successModal.show();
            }
          });
        }

        // Edit Pending Reservation Modal Logic
        let currentEditingPendingRow = null;

        // Open edit modal with pending reservation data
        document
          .querySelectorAll('.btn-primary[data-bs-target="#editPendingReservationModal"]')
          .forEach(function (editBtn) {
            editBtn.addEventListener('click', function () {
              currentEditingPendingRow = this.closest('tr');

              if (currentEditingPendingRow) {
                // Extract data from the row
                const bookingRef = currentEditingPendingRow
                  .querySelector('.cell-booking-ref')
                  .textContent.trim();
                const customerName = currentEditingPendingRow
                  .querySelector('.cell-customer-stack__name')
                  .textContent.trim();
                const car = currentEditingPendingRow.cells[2].textContent.trim();
                const city = currentEditingPendingRow.cells[3].textContent.trim();
                const periodDates = currentEditingPendingRow.querySelectorAll(
                  '.cell-period__dates .ltr-num',
                );
                const startDate = periodDates[0].textContent.trim();
                const endDate = periodDates[1].textContent.trim();
                const driver = currentEditingPendingRow
                  .querySelector('.cell-assignment__name')
                  .textContent.trim();
                const status = currentEditingPendingRow.querySelector('.badge').textContent.trim();

                // Parse dates and format for date/datetime input
                const parseDateTime = (dateStr) => {
                  const parts = dateStr.split(',').map((p) => p.trim());
                  if (parts.length > 1) {
                    return parts[1].trim();
                  }
                  return dateStr.trim();
                };

                const formattedStartDate = parseDateTime(startDate);
                const formattedEndDate = parseDateTime(endDate);

                // Fill the form with data
                document.getElementById('editPendingRef').value = bookingRef;
                document.getElementById('editPendingCustomer').value = customerName;
                document.getElementById('editPendingCar').value = car;
                document.getElementById('editPendingCity').value = city;
                document.getElementById('editPendingStartDate').value = formattedStartDate;
                document.getElementById('editPendingEndDate').value = formattedEndDate;
                document.getElementById('editPendingDriver').value = driver;
                document.getElementById('editPendingStatus').value = status;
              }
            });
          });

        // Save pending reservation changes
        document.getElementById('savePendingReservationBtn').addEventListener('click', function () {
          if (currentEditingPendingRow) {
            // Hide all error messages first
            document.getElementById('editPendingCarError').style.display = 'none';
            document.getElementById('editPendingCityError').style.display = 'none';
            document.getElementById('editPendingStartDateError').style.display = 'none';
            document.getElementById('editPendingEndDateError').style.display = 'none';

            const newCar = document.getElementById('editPendingCar').value;
            const newCity = document.getElementById('editPendingCity').value;
            const newStartDate = document.getElementById('editPendingStartDate').value;
            const newEndDate = document.getElementById('editPendingEndDate').value;
            const newDriver = document.getElementById('editPendingDriver').value;
            const newStatus = document.getElementById('editPendingStatus').value;

            let hasError = false;

            // Validation
            if (!newCar.trim()) {
              document.getElementById('editPendingCarError').textContent = 'يرجى إدخال اسم السيارة';
              document.getElementById('editPendingCarError').style.display = 'block';
              hasError = true;
            }

            if (!newCity.trim()) {
              document.getElementById('editPendingCityError').textContent = 'يرجى إدخال المدينة';
              document.getElementById('editPendingCityError').style.display = 'block';
              hasError = true;
            }

            if (!newStartDate) {
              document.getElementById('editPendingStartDateError').textContent =
                'يرجى اختيار تاريخ البدء';
              document.getElementById('editPendingStartDateError').style.display = 'block';
              hasError = true;
            }

            if (!newEndDate) {
              document.getElementById('editPendingEndDateError').textContent =
                'يرجى اختيار تاريخ الانتهاء';
              document.getElementById('editPendingEndDateError').style.display = 'block';
              hasError = true;
            }

            if (hasError) {
              return;
            }

            // Update the row in the table
            currentEditingPendingRow.cells[2].textContent = newCar;
            currentEditingPendingRow.cells[3].textContent = newCity;

            const periodDates = currentEditingPendingRow.querySelectorAll(
              '.cell-period__dates .ltr-num',
            );
            periodDates[0].textContent = newStartDate;
            periodDates[1].textContent = newEndDate;
            currentEditingPendingRow.querySelector('.cell-assignment__name').textContent =
              newDriver;

            // Update status badge
            const statusBadge = currentEditingPendingRow.querySelector('.badge');
            statusBadge.textContent = newStatus;
            statusBadge.className = 'badge';
            if (newStatus === 'بانتظار الموافقة') {
              statusBadge.classList.add('bg-warning', 'text-dark');
            } else if (newStatus === 'مقبول') {
              statusBadge.classList.add('bg-success');
            } else if (newStatus === 'مرفوض' || newStatus === 'ملغي') {
              statusBadge.classList.add('bg-danger');
            }

            // Close the modal
            const modal = bootstrap.Modal.getInstance(
              document.getElementById('editPendingReservationModal'),
            );
            modal.hide();

            // Show success modal
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
          }
        });
      });
    </script>
@endpush

