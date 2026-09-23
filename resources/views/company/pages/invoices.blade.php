@extends('company.layouts.master')

@section('title', 'T-Car — Invoices')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.invoices.0') }}</h1>

              <div
                class="modal fade"
                id="dateRangeModal"
                tabindex="-1"
                aria-hidden="true"
                aria-labelledby="dateRangeModalLabel"
              >
                <div class="modal-dialog modal-dialog-centered daterange-modal-dialog">
                  <div class="modal-content daterange-modal">
                    <span class="visually-hidden" id="dateRangeModalLabel"
                      >{{ __('company.common.124') }}</span
                    >
                    <div class="daterange-modal__body">
                      <div class="daterange-presets">
                        <button type="button" class="daterange-presets__item" data-quick="today">
                          {{ __('company.common.249') }}</button>
                        <button
                          type="button"
                          class="daterange-presets__item"
                          data-quick="yesterday"
                        >
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
                        <button
                          type="button"
                          class="daterange-presets__item"
                          data-quick="lastMonth"
                        >
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
                          <button
                            type="button"
                            class="btn btn-primary btn-sm"
                            id="dateRangeConfirmBtn"
                          >
                            {{ __('company.common.566') }}</button>
                          <button
                            type="button"
                            class="btn btn-outline btn-sm"
                            data-bs-dismiss="modal"
                          >
                            {{ __('company.common.95') }}</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.pages.invoices.0') }}</span>
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
                    <a class="dropdown-item" href="#" id="exportExcel"
                      ><i class="bi bi-file-earmark-excel"></i> {{ __('company.common.302') }}</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>

          
          <div class="filter-card mb-4">
            <div class="filter-card__row align-items-center">
              <div class="filter-card__date">
                <span class="filter-card__label">{{ __('company.pages.invoices.1') }}</span>
                <button
                  type="button"
                  class="date-range-trigger invoices-date-trigger js-date-trigger"
                  data-field-key="invoiceFromDate"
                >
                  <i class="bi bi-calendar3"></i>
                  <span class="date-range-trigger__value ltr-num js-date-trigger-label"
                    >2025/05/01</span
                  >
                </button>
              </div>

              <div class="filter-card__date">
                <span class="filter-card__label">{{ __('company.pages.invoices.2') }}</span>
                <button
                  type="button"
                  class="date-range-trigger invoices-date-trigger js-date-trigger"
                  data-field-key="invoiceToDate"
                >
                  <i class="bi bi-calendar3"></i>
                  <span class="date-range-trigger__value ltr-num js-date-trigger-label"
                    >2025/05/31</span
                  >
                </button>
              </div>

              <button type="button" class="btn btn-primary">{{ __('company.common.308') }}</button>
            </div>
          </div>
          
          <div class="metric-grid metric-grid--invoices mb-4">
            <div class="info-card invoices-stat">
              <div class="info-card__header">
                <i class="bi bi-wallet2 info-card__icon"></i>
                <p class="info-card__title">
                  {{ __('company.pages.invoices.3') }}<span class="invoices-stat__title-en">Total Revenue</span>
                </p>
              </div>
              <div class="invoices-stat__value ltr-num">{{ __('company.pages.invoices.4') }}</div>
              <div class="invoices-stat__note">{{ __('company.pages.invoices.5') }}</div>
            </div>
            <div class="info-card invoices-stat">
              <div class="info-card__header">
                <i class="bi bi-arrow-return-left info-card__icon"></i>
                <p class="info-card__title">
                  {{ __('company.common.224') }}<span class="invoices-stat__title-en">Refunds</span>
                </p>
              </div>
              <div class="invoices-stat__value ltr-num">{{ __('company.pages.invoices.6') }}</div>
              <div class="invoices-stat__note">{{ __('company.pages.invoices.5') }}</div>
            </div>
            <div class="info-card invoices-stat">
              <div class="info-card__header">
                <i class="bi bi-credit-card-2-front info-card__icon"></i>
                <p class="info-card__title">
                  {{ __('company.pages.invoices.7') }}<span class="invoices-stat__title-en">Payment Fees</span>
                </p>
              </div>
              <div class="invoices-stat__value ltr-num">{{ __('company.pages.invoices.8') }}</div>
              <div class="invoices-stat__note">{{ __('company.pages.invoices.5') }}</div>
            </div>
            <div class="info-card invoices-stat">
              <div class="info-card__header">
                <i class="bi bi-graph-up-arrow info-card__icon"></i>
                <p class="info-card__title">
                  {{ __('company.pages.invoices.9') }}<span class="invoices-stat__title-en">Net Profit</span>
                </p>
              </div>
              <div class="invoices-stat__value ltr-num">{{ __('company.pages.invoices.10') }}</div>
              <div class="invoices-stat__note">{{ __('company.pages.invoices.5') }}</div>
            </div>
            <div class="info-card invoices-stat">
              <div class="info-card__header">
                <i class="bi bi-gift info-card__icon"></i>
                <p class="info-card__title">
                  {{ __('company.pages.invoices.11') }}<span class="invoices-stat__title-en">Driver Rewards</span>
                </p>
              </div>
              <div class="invoices-stat__value ltr-num">{{ __('company.pages.invoices.12') }}</div>
              <div class="invoices-stat__note">{{ __('company.pages.invoices.5') }}</div>
            </div>
            <div class="info-card invoices-stat">
              <div class="info-card__header">
                <i class="bi bi-bank info-card__icon"></i>
                <p class="info-card__title">
                  {{ __('company.pages.invoices.13') }}<span class="invoices-stat__title-en">Amount Due for Transfer</span>
                </p>
              </div>
              <div class="invoices-stat__value ltr-num">{{ __('company.pages.invoices.14') }}</div>
              <div class="invoices-stat__note">{{ __('company.pages.invoices.5') }}</div>
            </div>
            <div class="info-card invoices-stat">
              <div class="info-card__header">
                <i class="bi bi-receipt info-card__icon"></i>
                <p class="info-card__title">
                  {{ __('company.pages.invoices.15') }}<span class="invoices-stat__title-en">TAMM Fees</span>
                </p>
              </div>
              <div class="invoices-stat__value ltr-num">{{ __('company.pages.invoices.16') }}</div>
              <div class="invoices-stat__note">{{ __('company.pages.invoices.5') }}</div>
            </div>
            <div class="info-card invoices-stat">
              <div class="info-card__header">
                <i class="bi bi-truck info-card__icon"></i>
                <p class="info-card__title">
                  {{ __('company.pages.invoices.17') }}<span class="invoices-stat__title-en">Delivery & Pickup Fees</span>
                </p>
              </div>
              <div class="invoices-stat__value ltr-num">{{ __('company.pages.invoices.18') }}</div>
              <div class="invoices-stat__note">{{ __('company.pages.invoices.5') }}</div>
            </div>
          </div>
          
          <div class="table-card mb-4">
            <div class="table-toolbar invoices-table-toolbar">
              <div class="table-toolbar__left">
                <div class="table-search">
                  <i class="bi bi-search"></i>
                  <input type="search" id="invoicesSearchInput"  placeholder="{{ __('company.common.253') }}" />
                </div>
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="data-table invoices-table" id="invoicesTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.215') }}</th>
                    <th>{{ __('company.common.291') }}</th>
                    <th>{{ __('company.common.225') }}</th>
                    
                    <th>{{ __('company.common.366') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="#10254"
                        >#10254 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.invoices.19') }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="ltr-num fw-semibold">2025/05/28</div>
                      <small class="text-muted ltr-num">{{ __('company.pages.invoices.20') }}</small>
                    </td>
                    <td class="ltr-num">{{ __('company.pages.invoices.21') }}</td>
                    
                    <td><span class="status-badge status-badge--success">{{ __('company.pages.invoices.22') }}</span></td>
                  </tr>
                  <tr>
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="#10255"
                        >#10255 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.invoices.23') }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="ltr-num fw-semibold">2025/05/28</div>
                      <small class="text-muted ltr-num">{{ __('company.pages.invoices.24') }}</small>
                    </td>
                    <td class="ltr-num">{{ __('company.pages.invoices.25') }}</td>
                    
                    <td><span class="status-badge status-badge--success">{{ __('company.pages.invoices.22') }}</span></td>
                  </tr>
                  <tr>
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="#10256"
                        >#10256 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.common.413') }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="ltr-num fw-semibold">2025/05/27</div>
                      <small class="text-muted ltr-num">{{ __('company.pages.invoices.26') }}</small>
                    </td>
                    <td class="ltr-num">{{ __('company.pages.invoices.27') }}</td>
                    
                    <td><span class="status-badge status-badge--warning">{{ __('company.pages.invoices.28') }}</span></td>
                  </tr>
                  <tr>
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="#10257"
                        >#10257 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.common.510') }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="ltr-num fw-semibold">2025/05/27</div>
                      <small class="text-muted ltr-num">{{ __('company.pages.invoices.29') }}</small>
                    </td>
                    <td class="ltr-num">{{ __('company.pages.invoices.30') }}</td>
                    
                    <td><span class="status-badge status-badge--success">{{ __('company.pages.invoices.22') }}</span></td>
                  </tr>
                  <tr>
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="#10258"
                        >#10258 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.invoices.31') }}</span>
                      </div>
                    </td>
                    <td>
                      <div class="ltr-num fw-semibold">2025/05/26</div>
                      <small class="text-muted ltr-num">{{ __('company.pages.invoices.32') }}</small>
                    </td>
                    <td class="ltr-num">{{ __('company.pages.invoices.33') }}</td>
                    
                    <td><span class="status-badge status-badge--success">{{ __('company.pages.invoices.22') }}</span></td>
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
                <button class="table-pagination__page-btn" disabled>
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
      id="reservationDetailsModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="reservationDetailsModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered pending-booking-modal-dialog">
        <div class="modal-content booking-modal">
          
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon">
                <i class="bi bi-file-earmark-text"></i>
              </div>
              <div>
                <h2 class="bkmodal-header__ref" id="reservationDetailsModalLabel">
                  {{ __('company.common.368') }}<span class="num" id="reservationBookingRef">Y8e087</span>
                  <span class="badge bg-success" id="reservationBookingStatus">{{ __('company.common.545') }}</span>
                </h2>
                <div class="bkmodal-header__meta">
                  <span
                    ><i class="bi bi-person"></i>
                    <span id="reservationBookingCustomerMeta">Maryam Yousuf Ahli</span></span
                  >
                  <span class="dot">•</span>
                  <span
                    ><i class="bi bi-building"></i>
                    <span id="reservationBookingOfficeMeta">{{ __('company.common.184') }}</span></span
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
                  data-reservation-booking-tab="summary"
                  aria-selected="true"
                >
                  <i class="bi bi-file-text"></i>
                  <span>{{ __('company.common.239') }}</span>
                </button>
                <button
                  type="button"
                  class="view-tabs__btn"
                  data-reservation-booking-tab="rating"
                  aria-selected="false"
                >
                  <i class="bi bi-star"></i>
                  <span>{{ __('company.common.162') }}</span>
                </button>

                <button
                  type="button"
                  class="view-tabs__btn"
                  data-reservation-booking-tab="bank"
                  aria-selected="false"
                >
                  <i class="bi bi-bank"></i>
                  <span>{{ __('company.common.540') }}</span>
                </button>
              </div>
            </div>

            <div class="tab-content booking-modal__content">
              
              <div class="pending-booking-panel is-active" data-reservation-booking-panel="summary">
                <div class="bkmodal-section-label">{{ __('company.common.273') }}</div>
                <div class="booking-details-grid">
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-truck"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.171') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingService"
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
                      <span class="booking-detail-item__value" id="reservationBookingCustomer"
                        >Maryam Yousuf Ahli</span
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
                        id="reservationBookingPickupDate"
                        >2026-07-20</span
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
                        id="reservationBookingPickupTime"
                        >12:30</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-calendar-range"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.219') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingPeriod"
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
                      <span class="booking-detail-item__value" id="reservationBookingCar">-</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.423') }}</span>
                      <span class="booking-detail-item__value ltr-num" id="reservationBookingPrice"
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
                      <span class="booking-detail-item__value" id="reservationBookingCompany"
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
                      <span class="booking-detail-item__value" id="reservationBookingOffice"
                        >{{ __('company.common.184') }}</span
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
                      <span class="booking-detail-item__value" id="reservationBookingPayment"
                        >{{ __('company.common.267') }}</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-info-circle"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label"> {{ __('company.common.366') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingAccepted"
                        >{{ __('company.pages.invoices.22') }}</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-cash"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.160') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingCompensation"
                        >0</span
                      >
                    </div>
                  </div>
                </div>
              </div>

              
              <div class="pending-booking-panel" data-reservation-booking-panel="rating">
                <div class="reservation-rating-card">
                  <div class="reservation-rating-card__score">
                    <span class="reservation-rating-card__number" id="reservationBookingRating"
                      >5</span
                    >
                    <div class="reservation-rating-card__stars" id="reservationBookingRatingStars">
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
                        <i class="bi bi-person-check"></i>
                      </div>
                      <div class="booking-detail-item__content">
                        <span class="booking-detail-item__label">{{ __('company.common.328') }}</span>
                        <span class="booking-detail-item__value" id="reservationBookingRatedBy"
                          >Maryam Yousuf Ahli</span
                        >
                      </div>
                    </div>
                    <div class="booking-detail-item">
                      <div class="booking-detail-item__icon">
                        <i class="bi bi-calendar3"></i>
                      </div>
                      <div class="booking-detail-item__content">
                        <span class="booking-detail-item__label">{{ __('company.common.280') }}</span>
                        <span
                          class="booking-detail-item__value ltr-num"
                          id="reservationBookingRatingDate"
                          >2026-07-20</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="pending-booking-panel" data-reservation-booking-panel="bank">
                <div class="bank-info-grid">
                  <div class="bank-info-item">
                    <div class="bank-info-item__icon">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="bank-info-item__content">
                      <span class="bank-info-item__label">{{ __('company.common.132') }}</span>
                      <span class="bank-info-item__value" id="reservationBookingBankName">-</span>
                    </div>
                  </div>
                  <div class="bank-info-item">
                    <div class="bank-info-item__icon">
                      <i class="bi bi-credit-card"></i>
                    </div>
                    <div class="bank-info-item__content">
                      <span class="bank-info-item__label">{{ __('company.common.152') }}</span>
                      <span class="bank-info-item__value ltr-num" id="reservationBookingIban"
                        >-</span
                      >
                    </div>
                  </div>
                  <div class="bank-info-item">
                    <div class="bank-info-item__icon">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="bank-info-item__content">
                      <span class="bank-info-item__label">{{ __('company.common.79') }}</span>
                      <span class="bank-info-item__value" id="reservationBookingCardHolder">-</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
          <div class="modal-footer bkmodal-footer">
            <a href="{{ route('company.booking-details-two') }}" class="btn btn-primary">
              <i class="bi bi-file-earmark-text"></i>
              <span>{{ __('company.common.312') }}</span>
            </a>
            <div class="pending-booking-modal__footer-actions">
              <button
                type="button"
                class="pending-booking-link"
                data-reservation-modal-action="combined-history"
              >
                <i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="reservationHistoryModal"
      tabindex="-1"
      aria-labelledby="reservationHistoryModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content car-logs-modal">
          <div class="car-logs-modal__header">
            <h5 class="car-logs-modal__header__title" id="reservationHistoryModalLabel">
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
                id="reservationHistoryScrollUpBtn"
                 aria-label="{{ __('company.common.344') }}"
              >
                <i class="bi bi-chevron-up"></i>
              </button>
              <div class="car-logs-scrollctrl__track">
                <div class="car-logs-scrollctrl__thumb" id="reservationHistoryScrollThumb"></div>
              </div>
              <button
                type="button"
                class="car-logs-scrollctrl__btn"
                id="reservationHistoryScrollDownBtn"
                 aria-label="{{ __('company.common.343') }}"
              >
                <i class="bi bi-chevron-down"></i>
              </button>
            </div>

            <div class="car-logs-table-wrap" id="reservationHistoryTableWrap">
              <table class="car-logs-table" id="reservationHistoryTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.245') }}</th>
                    <th>{{ __('company.common.225') }}</th>
                    <th>{{ __('company.common.296') }}</th>
                    <th>{{ __('company.common.180') }}</th>
                    <th>{{ __('company.common.232') }}</th>
                    <th>{{ __('company.common.77') }}</th>
                  </tr>
                </thead>
                <tbody id="reservationHistoryTableBody">
                  
                  <tr class="history-row" data-type="booking">
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-type">{{ __('company.common.368') }}</td>
                    <td class="log-amount">-</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:00:00</td>
                    <td class="log-message--activate" data-history-message>{{ __('company.common.324') }}</td>
                    <td class="log-user" data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-actions">
                      <button class="btn-expand" data-expand-target="details-1">
                        <i class="bi bi-chevron-down"></i>
                      </button>
                    </td>
                  </tr>
                  <tr class="history-details-row" id="details-1" style="display: none">
                    <td colspan="7">
                      <div class="history-details">
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.404') }}</span>
                          <span class="history-detail-value">-</span>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr class="history-row" data-type="booking">
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-type">{{ __('company.common.368') }}</td>
                    <td class="log-amount">-</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:03:16</td>
                    <td class="log-message--stock" data-history-message>{{ __('company.common.336') }}</td>
                    <td class="log-user" data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-actions">
                      <button class="btn-expand" data-expand-target="details-2">
                        <i class="bi bi-chevron-down"></i>
                      </button>
                    </td>
                  </tr>
                  <tr class="history-details-row" id="details-2" style="display: none">
                    <td colspan="7">
                      <div class="history-details">
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.404') }}</span>
                          <span class="history-detail-value">-</span>
                        </div>
                      </div>
                    </td>
                  </tr>
                  
                  <tr class="transaction-row" data-type="transaction" style="display: none">
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-type">{{ __('company.common.385') }}</td>
                    <td class="log-amount ltr-num">{{ __('company.common.14') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:05:42</td>
                    <td class="log-message--activate" data-history-message>{{ __('company.common.327') }}</td>
                    <td class="log-user" data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-actions">
                      <button class="btn-expand" data-expand-target="trans-details-1">
                        <i class="bi bi-chevron-down"></i>
                      </button>
                    </td>
                  </tr>
                  <tr class="transaction-details-row" id="trans-details-1" style="display: none">
                    <td colspan="7">
                      <div class="history-details">
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.486') }}</span>
                          <span class="history-detail-value">200</span>
                        </div>
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.390') }}</span>
                          <span class="history-detail-value">{{ __('company.common.327') }}</span>
                        </div>
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.404') }}</span>
                          <span class="history-detail-value ltr-num"
                            >pay_2snk33qbbimiviupw45nqpkm3i</span
                          >
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr class="transaction-row" data-type="transaction" style="display: none">
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-type">{{ __('company.common.385') }}</td>
                    <td class="log-amount ltr-num">{{ __('company.common.14') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:09:10</td>
                    <td class="log-message--activate" data-history-message>{{ __('company.common.327') }}</td>
                    <td class="log-user" data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-actions">
                      <button class="btn-expand" data-expand-target="trans-details-2">
                        <i class="bi bi-chevron-down"></i>
                      </button>
                    </td>
                  </tr>
                  <tr class="transaction-details-row" id="trans-details-2" style="display: none">
                    <td colspan="7">
                      <div class="history-details">
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.486') }}</span>
                          <span class="history-detail-value">200</span>
                        </div>
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.390') }}</span>
                          <span class="history-detail-value">{{ __('company.common.327') }}</span>
                        </div>
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.404') }}</span>
                          <span class="history-detail-value ltr-num"
                            >pay_3snk33qbbimiviupw45nqpkm3i</span
                          >
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        var exportExcel = document.getElementById('exportExcel');

        if (exportExcel) {
          exportExcel.addEventListener('click', function (e) {
            e.preventDefault();
            exportTableAsCSV('invoices.xls');
          });
        }

        function exportTableAsCSV(filename) {
          var table = document.getElementById('invoicesTable');
          var rows = table.querySelectorAll('tbody tr');
          var csvContent = [];
          var headers = [];

          table.querySelectorAll('thead th').forEach(function (th) {
            headers.push(th.textContent.trim());
          });

          csvContent.push(headers.join(','));

          rows.forEach(function (row) {
            var rowData = [];

            row.querySelectorAll('td').forEach(function (td) {
              rowData.push(td.textContent.trim().replace(/\s+/g, ' '));
            });

            csvContent.push(rowData.join(','));
          });

          var csvString = csvContent.join('\n');
          var blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
          var link = document.createElement('a');
          var url = URL.createObjectURL(blob);

          link.setAttribute('href', url);
          link.setAttribute('download', filename);
          link.style.visibility = 'hidden';
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        }

        /* ============================================================
         Reservation Details Modal
      ============================================================= */
        var reservationDetailsModalEl = document.getElementById('reservationDetailsModal');
        var reservationDetailsModal = new bootstrap.Modal(reservationDetailsModalEl);
        var currentBookingRef = null;

        // Handle booking reference clicks to open reservation details modal
        document.querySelectorAll('.js-reservation-booking-details').forEach(function (link) {
          link.addEventListener('click', function (e) {
            e.preventDefault();
            currentBookingRef = this.getAttribute('data-booking-ref');
            document.getElementById('reservationBookingRef').textContent = currentBookingRef;
            // Also update meta fields with sample data for demo
            var row = this.closest('tr');
            var customerName =
              row.querySelector('.cell-customer-stack__name')?.textContent || 'عميل';
            document.getElementById('reservationBookingCustomerMeta').textContent = customerName;
            document.getElementById('reservationBookingCustomer').textContent = customerName;
            document.getElementById('reservationBookingOfficeMeta').textContent = 'الرياض - N2';
            document.getElementById('reservationBookingOffice').textContent = 'الرياض - N2';
            reservationDetailsModal.show();
          });
        });

        /* ============================================================
         Tabs Logic
      ============================================================= */
        // Handle tab clicks
        document.querySelectorAll('[data-reservation-booking-tab]').forEach(function (tab) {
          tab.addEventListener('click', function () {
            var tabName = this.getAttribute('data-reservation-booking-tab');

            // Update active state on buttons
            document.querySelectorAll('[data-reservation-booking-tab]').forEach(function (btn) {
              btn.classList.remove('is-active');
              btn.setAttribute('aria-selected', 'false');
            });
            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');

            // Show corresponding tab pane
            document.querySelectorAll('[data-reservation-booking-panel]').forEach(function (panel) {
              panel.classList.remove('is-active');
              if (panel.getAttribute('data-reservation-booking-panel') === tabName) {
                panel.classList.add('is-active');
              }
            });
          });
        });

        /* ============================================================
         Reservation History Modal
      ============================================================= */
        var reservationHistoryModalEl = document.getElementById('reservationHistoryModal');
        var reservationHistoryModal = new bootstrap.Modal(reservationHistoryModalEl);
        var reservationHistoryWrap = document.getElementById('reservationHistoryTableWrap');
        var reservationHistoryThumb = document.getElementById('reservationHistoryScrollThumb');

        function updateReservationHistoryThumb() {
          if (!reservationHistoryWrap || !reservationHistoryThumb) return;
          var trackHeight = reservationHistoryWrap.clientHeight;
          var scrollHeight = reservationHistoryWrap.scrollHeight;
          var thumbHeight = (trackHeight / scrollHeight) * trackHeight;
          var maxScroll = scrollHeight - trackHeight;
          var scrollRatio = maxScroll > 0 ? reservationHistoryWrap.scrollTop / maxScroll : 0;

          reservationHistoryThumb.style.height = thumbHeight + 'px';
          reservationHistoryThumb.style.top = scrollRatio * (trackHeight - thumbHeight) + 'px';
        }

        // Handle booking history and transactions buttons in reservation details modal
        document.querySelectorAll('[data-reservation-modal-action]').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var action = this.getAttribute('data-reservation-modal-action');

            // Update modal title
            document.getElementById('reservationHistoryModalLabel').textContent =
              'تاريخ العمليات والحجز';

            // Update booking ref in history table
            if (currentBookingRef) {
              reservationHistoryModalEl
                .querySelectorAll('[data-history-ref]')
                .forEach(function (cell) {
                  cell.textContent = currentBookingRef;
                });
            }

            // Show both booking and transaction rows together
            reservationHistoryModalEl.querySelectorAll('.history-row').forEach(function (row) {
              row.style.display = '';
            });
            reservationHistoryModalEl
              .querySelectorAll('.history-details-row')
              .forEach(function (row) {
                row.style.display = 'none';
              });
            reservationHistoryModalEl.querySelectorAll('.transaction-row').forEach(function (row) {
              row.style.display = '';
            });
            reservationHistoryModalEl
              .querySelectorAll('.transaction-details-row')
              .forEach(function (row) {
                row.style.display = 'none';
              });

            // Show history modal when details modal is closed
            reservationDetailsModalEl.addEventListener(
              'hidden.bs.modal',
              function () {
                reservationHistoryModal.show();
              },
              { once: true },
            );

            reservationDetailsModal.hide();
          });
        });

        reservationHistoryWrap.addEventListener('scroll', updateReservationHistoryThumb);
        reservationHistoryModalEl.addEventListener('shown.bs.modal', updateReservationHistoryThumb);
        window.addEventListener('resize', updateReservationHistoryThumb);

        document
          .getElementById('reservationHistoryScrollUpBtn')
          .addEventListener('click', function () {
            reservationHistoryWrap.scrollBy({ top: -100, behavior: 'smooth' });
          });

        document
          .getElementById('reservationHistoryScrollDownBtn')
          .addEventListener('click', function () {
            reservationHistoryWrap.scrollBy({ top: 100, behavior: 'smooth' });
          });

        /* ============================================================
         Expand/Collapse Functionality
      ============================================================= */
        // Handle expand button clicks
        document.querySelectorAll('.btn-expand').forEach(function (btn) {
          btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var targetId = this.getAttribute('data-expand-target');
            var targetRow = document.getElementById(targetId);

            if (targetRow) {
              var isHidden = targetRow.style.display === 'none';
              targetRow.style.display = isHidden ? 'table-row' : 'none';
              this.classList.toggle('is-expanded', isHidden);
            }
          });
        });
      });
    </script>
@endpush

