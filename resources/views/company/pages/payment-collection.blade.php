@extends('company.layouts.master')

@section('title', 'T-Car — Payment Collection')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">Payment Collection</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">Payment Collection</span>
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

          
          <div class="table-card mb-4">
            <div class="table-toolbar">
              <div class="table-toolbar__left">
                <div class="view-tabs" role="tablist"  aria-label="{{ __('company.pages.payment-collection.10') }}">
                  <button
                    type="button"
                    class="view-tabs__btn is-active"
                    role="tab"
                    aria-selected="true"
                  >
                    {{ __('company.common.223') }}</button>
                  <button type="button" class="view-tabs__btn" role="tab" aria-selected="false">
                    {{ __('company.pages.payment-collection.0') }}</button>
                  <button type="button" class="view-tabs__btn" role="tab" aria-selected="false">
                    {{ __('company.pages.payment-collection.1') }}</button>
                </div>
              </div>
            </div>

            <div class="table-filter-bar">
              <div class="table-filter-bar__left">
                <button type="button" class="filter-btn js-date-trigger" data-field-key="dueDate">
                  <span class="js-date-trigger-label">{{ __('company.pages.payment-collection.2') }}</span>
                  <i class="bi bi-chevron-down"></i>
                </button>
              </div>

              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="paymentSearchInput"  placeholder="{{ __('company.common.253') }}" />
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="data-table" id="paymentTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.449') }}</th>
                    <th>{{ __('company.common.431') }}</th>
                    <th>{{ __('company.pages.payment-collection.0') }}</th>
                    <th>{{ __('company.pages.payment-collection.3') }}</th>
                    <th>{{ __('company.pages.payment-collection.2') }}</th>
                    <th>{{ __('company.common.365') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="Q9c5fd"
                        >Q9c5fd <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">Bader Alabdulrahman</span>
                        <span class="cell-customer-stack__phone ltr-num">966544469448+</span>
                      </div>
                    </td>
                    <td>
                      <span class="cell-company"
                        >N2
                        <i
                          class="bi bi-info-circle company-info-trigger"
                          data-company="N2"
                          data-location="Riyadh - Al Aziziyah ,الرياض"
                          data-rating="4.4"
                          data-manager="hamza mohamed"
                        ></i
                      ></span>
                    </td>
                    <td><span class="fw-bold text-danger">2</span></td>
                    <td></td>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="ltr-num fw-semibold">2023-08-18</span>
                        <span class="text-muted small">{{ __('company.pages.payment-collection.4') }}</span>
                      </div>
                    </td>
                    <td><span class="badge bg-primary">{{ __('company.common.446') }}</span></td>
                    <td class="text-end">
                      <div class="action-menu-wrapper">
                        <button class="action-menu-btn"  title="{{ __('company.common.384') }}">
                          <i class="bi bi-three-dots"></i>
                        </button>
                        <div class="action-menu-dropdown">
                          <button
                            class="action-menu-item"
                            data-bs-toggle="modal"
                            data-bs-target="#bookingLogsModal"
                          >
                            <i class="bi bi-clock-history"></i> {{ __('company.common.422') }}</button>
                          <button
                            class="action-menu-item"
                            data-bs-toggle="modal"
                            data-bs-target="#subscriptionLogsModal"
                          >
                            <i class="bi bi-clock-history"></i> {{ __('company.common.421') }}</button>
                          <button class="action-menu-item">
                            <i class="bi bi-printer"></i> {{ __('company.pages.payment-collection.5') }}</button>
                          <button class="action-menu-item">
                            <i class="bi bi-download"></i> {{ __('company.common.346') }}</button>
                          <button class="action-menu-item"><i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="K9b510"
                        >K9b510 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.payment-collection.6') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966534737266+</span>
                      </div>
                    </td>
                    <td>
                      <span class="cell-company"
                        >N2
                        <i
                          class="bi bi-info-circle company-info-trigger"
                          data-company="N2"
                          data-location="Riyadh - Al Aziziyah ,الرياض"
                          data-rating="4.4"
                          data-manager="hamza mohamed"
                        ></i
                      ></span>
                    </td>
                    <td><span class="fw-bold text-danger">2</span></td>
                    <td></td>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="ltr-num fw-semibold">2023-08-18</span>
                        <span class="text-muted small">{{ __('company.pages.payment-collection.4') }}</span>
                      </div>
                    </td>
                    <td><span class="badge bg-primary">{{ __('company.common.446') }}</span></td>
                    <td class="text-end">
                      <div class="action-menu-wrapper">
                        <button class="action-menu-btn"  title="{{ __('company.common.384') }}">
                          <i class="bi bi-three-dots"></i>
                        </button>
                        <div class="action-menu-dropdown">
                          <button
                            class="action-menu-item"
                            data-bs-toggle="modal"
                            data-bs-target="#bookingLogsModal"
                          >
                            <i class="bi bi-clock-history"></i> {{ __('company.common.422') }}</button>
                          <button
                            class="action-menu-item"
                            data-bs-toggle="modal"
                            data-bs-target="#subscriptionLogsModal"
                          >
                            <i class="bi bi-clock-history"></i> {{ __('company.common.421') }}</button>
                          <button class="action-menu-item">
                            <i class="bi bi-printer"></i> {{ __('company.pages.payment-collection.5') }}</button>
                          <button class="action-menu-item">
                            <i class="bi bi-download"></i> {{ __('company.common.346') }}</button>
                          <button class="action-menu-item"><i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="B6f2cc"
                        >B6f2cc <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">ALQAHTANI ABDULAZIZ JURBUA M</span>
                        <span class="cell-customer-stack__phone ltr-num">966547219011+</span>
                      </div>
                    </td>
                    <td>
                      <span class="cell-company"
                        >N2
                        <i
                          class="bi bi-info-circle company-info-trigger"
                          data-company="N2"
                          data-location="Riyadh - Al Aziziyah ,الرياض"
                          data-rating="4.4"
                          data-manager="hamza mohamed"
                        ></i
                      ></span>
                    </td>
                    <td><span class="fw-bold text-danger">2</span></td>
                    <td></td>
                    <td>
                      <div class="d-flex flex-column">
                        <span class="ltr-num fw-semibold">2023-08-18</span>
                        <span class="text-muted small">{{ __('company.pages.payment-collection.4') }}</span>
                      </div>
                    </td>
                    <td><span class="badge bg-primary">{{ __('company.common.446') }}</span></td>
                    <td class="text-end">
                      <div class="action-menu-wrapper">
                        <button class="action-menu-btn"  title="{{ __('company.common.384') }}">
                          <i class="bi bi-three-dots"></i>
                        </button>
                        <div class="action-menu-dropdown">
                          <button
                            class="action-menu-item"
                            data-bs-toggle="modal"
                            data-bs-target="#bookingLogsModal"
                          >
                            <i class="bi bi-clock-history"></i> {{ __('company.common.422') }}</button>
                          <button
                            class="action-menu-item"
                            data-bs-toggle="modal"
                            data-bs-target="#subscriptionLogsModal"
                          >
                            <i class="bi bi-clock-history"></i> {{ __('company.common.421') }}</button>
                          <button class="action-menu-item">
                            <i class="bi bi-printer"></i> {{ __('company.pages.payment-collection.5') }}</button>
                          <button class="action-menu-item">
                            <i class="bi bi-download"></i> {{ __('company.common.346') }}</button>
                          <button class="action-menu-item"><i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
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
                  {{ __('company.common.95') }}</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="company-info-tooltip" id="companyInfoTooltip">
      <div class="company-info-tooltip__location">
        <i class="bi bi-geo-alt"></i>
        <span id="tooltipLocation">{{ __('company.common.50') }}</span>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="bookingLogsModal"
      tabindex="-1"
      aria-labelledby="bookingLogsModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content car-logs-modal">
          <div class="car-logs-modal__header">
            <h5 class="car-logs-modal__header__title" id="bookingLogsModalLabel">{{ __('company.common.422') }}</h5>
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
                id="bookingLogsScrollUpBtn"
                 aria-label="{{ __('company.common.344') }}"
              >
                <i class="bi bi-chevron-up"></i>
              </button>
              <div class="car-logs-scrollctrl__track">
                <div class="car-logs-scrollctrl__thumb" id="bookingLogsScrollThumb"></div>
              </div>
              <button
                type="button"
                class="car-logs-scrollctrl__btn"
                id="bookingLogsScrollDownBtn"
                 aria-label="{{ __('company.common.343') }}"
              >
                <i class="bi bi-chevron-down"></i>
              </button>
            </div>

            <div class="car-logs-table-wrap" id="bookingLogsTableWrap">
              <table class="car-logs-table">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.389') }}</th>
                    <th>{{ __('company.common.523') }}</th>
                    <th>{{ __('company.common.296') }}</th>
                  </tr>
                </thead>
                <tbody id="bookingLogsTableBody">
                  <tr>
                    <td class="log-index">100</td>
                    <td class="log-message--activate">{{ __('company.common.338') }}</td>
                    <td>{{ __('company.common.104') }}</td>
                    <td class="log-datetime ltr-num">2026-07-27 12:13:28</td>
                  </tr>
                  <tr>
                    <td class="log-index">99</td>
                    <td class="log-message--update">{{ __('company.common.334') }}</td>
                    <td>{{ __('company.common.104') }}</td>
                    <td class="log-datetime ltr-num">2026-07-26 22:56:49</td>
                  </tr>
                  <tr>
                    <td class="log-index">98</td>
                    <td class="log-message--cancel">{{ __('company.common.323') }}</td>
                    <td>{{ __('company.common.246') }}</td>
                    <td class="log-datetime ltr-num">2026-07-24 20:30:26</td>
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
      id="subscriptionLogsModal"
      tabindex="-1"
      aria-labelledby="subscriptionLogsModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content car-logs-modal">
          <div class="car-logs-modal__header">
            <h5 class="car-logs-modal__header__title" id="subscriptionLogsModalLabel">
              {{ __('company.common.421') }}</h5>
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
                id="subscriptionLogsScrollUpBtn"
                 aria-label="{{ __('company.common.344') }}"
              >
                <i class="bi bi-chevron-up"></i>
              </button>
              <div class="car-logs-scrollctrl__track">
                <div class="car-logs-scrollctrl__thumb" id="subscriptionLogsScrollThumb"></div>
              </div>
              <button
                type="button"
                class="car-logs-scrollctrl__btn"
                id="subscriptionLogsScrollDownBtn"
                 aria-label="{{ __('company.common.343') }}"
              >
                <i class="bi bi-chevron-down"></i>
              </button>
            </div>

            <div class="car-logs-table-wrap" id="subscriptionLogsTableWrap">
              <table class="car-logs-table">
                <thead>
                  <tr>
                    <th>{{ __('company.common.385') }}</th>
                    <th>{{ __('company.common.165') }}</th>
                    <th>{{ __('company.pages.payment-collection.7') }}</th>
                    <th>{{ __('company.pages.payment-collection.8') }}</th>
                    <th>{{ __('company.common.225') }}</th>
                    <th>{{ __('company.common.528') }}</th>
                  </tr>
                </thead>
                <tbody id="subscriptionLogsTableBody">
                  <tr>
                    <td class="log-index">1</td>
                    <td class="log-message--activate">
                      <span class="badge bg-success">{{ __('company.common.548') }}</span>
                    </td>
                    <td class="ltr-num">1</td>
                    <td class="ltr-num">0</td>
                    <td class="ltr-num">{{ __('company.common.14') }}</td>
                    <td>{{ __('company.common.512') }}</td>
                  </tr>
                  <tr>
                    <td class="log-index">2</td>
                    <td class="log-message--activate">
                      <span class="badge bg-success">{{ __('company.common.548') }}</span>
                    </td>
                    <td class="ltr-num">1</td>
                    <td class="ltr-num">0</td>
                    <td class="ltr-num">{{ __('company.common.14') }}</td>
                    <td>{{ __('company.common.512') }}</td>
                  </tr>
                  <tr>
                    <td class="log-index">3</td>
                    <td class="log-message--pending"><span class="badge bg-warning">{{ __('company.common.538') }}</span></td>
                    <td class="ltr-num">3</td>
                    <td class="ltr-num">5</td>
                    <td class="ltr-num">{{ __('company.common.14') }}</td>
                    <td>{{ __('company.common.512') }}</td>
                  </tr>
                  <tr>
                    <td class="log-index">4</td>
                    <td class="log-message--cancel"><span class="badge bg-danger">{{ __('company.pages.payment-collection.9') }}</span></td>
                    <td class="ltr-num">2</td>
                    <td class="ltr-num">10</td>
                    <td class="ltr-num">{{ __('company.common.14') }}</td>
                    <td>{{ __('company.common.512') }}</td>
                  </tr>
                  <tr>
                    <td class="log-index">5</td>
                    <td class="log-message--activate">
                      <span class="badge bg-success">{{ __('company.common.548') }}</span>
                    </td>
                    <td class="ltr-num">1</td>
                    <td class="ltr-num">0</td>
                    <td class="ltr-num">{{ __('company.common.14') }}</td>
                    <td>{{ __('company.common.268') }}</td>
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
                    <div class="booking-detail-item__icon"><i class="bi bi-truck"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.171') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingService"
                        >{{ __('company.common.300') }}</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon"><i class="bi bi-person"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.449') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingCustomer"
                        >Maryam Yousuf Ahli</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon"><i class="bi bi-calendar3"></i></div>
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
                    <div class="booking-detail-item__icon"><i class="bi bi-clock"></i></div>
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
                    <div class="booking-detail-item__icon"><i class="bi bi-car-front"></i></div>
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
                    <div class="booking-detail-item__icon"><i class="bi bi-building"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.431') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingCompany"
                        >N2</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon"><i class="bi bi-geo-alt"></i></div>
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
                    <div class="booking-detail-item__icon"><i class="bi bi-credit-card"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.437') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingPayment"
                        >{{ __('company.common.267') }}</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon"><i class="bi bi-check-circle"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.168') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingAccepted"
                        >1</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon"><i class="bi bi-x-circle"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.169') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingCancelled"
                        >0</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon"><i class="bi bi-cash"></i></div>
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
                      <div class="booking-detail-item__icon"><i class="bi bi-person"></i></div>
                      <div class="booking-detail-item__content">
                        <span class="booking-detail-item__label">{{ __('company.common.328') }}</span>
                        <span class="booking-detail-item__value" id="reservationBookingRatedBy"
                          >Maryam Yousuf Ahli</span
                        >
                      </div>
                    </div>
                    <div class="booking-detail-item">
                      <div class="booking-detail-item__icon"><i class="bi bi-calendar3"></i></div>
                      <div class="booking-detail-item__content">
                        <span class="booking-detail-item__label">{{ __('company.common.289') }}</span>
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
                <div class="bkmodal-section-label">{{ __('company.common.540') }}</div>
                <div class="booking-details-grid">
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon"><i class="bi bi-bank"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.132') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingBankName"
                        >-</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon"><i class="bi bi-credit-card"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.141') }}</span>
                      <span class="booking-detail-item__value ltr-num" id="reservationBookingIban"
                        >-</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon"><i class="bi bi-person-badge"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.79') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingCardHolder"
                        >-</span
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
          <div class="modal-footer booking-modal__footer">
            <a href="{{ route('company.booking-details-two') }}" class="btn btn-primary">
              <i class="bi bi-file-earmark-text"></i> {{ __('company.common.312') }}</a>
            <div class="pending-booking-modal__footer-actions">
              <button
                type="button"
                class="pending-booking-link"
                data-reservation-modal-action="booking-history"
              >
                <i class="bi bi-clock-history"></i> {{ __('company.common.291') }}</button>
              <button
                type="button"
                class="pending-booking-link"
                data-reservation-modal-action="transactions"
              >
                <i class="bi bi-wallet2"></i> {{ __('company.common.292') }}</button>
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
              {{ __('company.common.291') }}</h5>
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
              <table class="car-logs-table">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.389') }}</th>
                    <th>{{ __('company.common.523') }}</th>
                    <th>{{ __('company.common.296') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--activate" data-history-message>{{ __('company.common.324') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:00:00</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--stock" data-history-message>{{ __('company.common.336') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:03:16</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--activate" data-history-message>{{ __('company.common.335') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:05:42</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--deactivate" data-history-message>
                      {{ __('company.common.332') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:09:10</td>
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
        const companyInfoTriggers = document.querySelectorAll('.company-info-trigger');
        const companyInfoTooltip = document.getElementById('companyInfoTooltip');

        const tooltipLocation = document.getElementById('tooltipLocation');

        let activeTrigger = null;

        function showTooltip(trigger, location) {
          tooltipLocation.textContent = location;

          // Position tooltip above the trigger
          const rect = trigger.getBoundingClientRect();
          const tooltipRect = companyInfoTooltip.getBoundingClientRect();
          const viewportWidth = window.innerWidth;
          const viewportHeight = window.innerHeight;

          // Calculate horizontal position (prevent going off right edge)
          let leftPos = rect.left;
          if (leftPos + tooltipRect.width > viewportWidth - 20) {
            leftPos = viewportWidth - tooltipRect.width - 20;
          }
          if (leftPos < 10) {
            leftPos = 10;
          }

          companyInfoTooltip.style.left = leftPos + 'px';

          // Calculate vertical position (show above by default)
          let topPos = rect.top - tooltipRect.height - 10;
          let showAbove = true;

          // Check if tooltip goes above viewport, if so show below
          if (topPos < 10) {
            topPos = rect.bottom + 10;
            showAbove = false;
          }

          // Check if tooltip goes below viewport when showing below
          if (!showAbove && topPos + tooltipRect.height > viewportHeight - 10) {
            topPos = viewportHeight - tooltipRect.height - 10;
          }

          companyInfoTooltip.style.top = topPos + 'px';

          // Update positioning classes
          if (showAbove) {
            companyInfoTooltip.classList.remove('company-info-tooltip--bottom');
            companyInfoTooltip.classList.add('company-info-tooltip--top');
          } else {
            companyInfoTooltip.classList.remove('company-info-tooltip--top');
            companyInfoTooltip.classList.add('company-info-tooltip--bottom');
          }

          companyInfoTooltip.classList.add('is-visible');
          activeTrigger = trigger;
        }

        function hideTooltip() {
          companyInfoTooltip.classList.remove('is-visible');
          activeTrigger = null;
        }

        companyInfoTriggers.forEach((trigger) => {
          trigger.addEventListener('click', function (e) {
            e.stopPropagation();

            if (activeTrigger === this) {
              hideTooltip();
              return;
            }

            const location = this.getAttribute('data-location');

            showTooltip(this, location);
          });
        });

        document.addEventListener('click', function (e) {
          if (
            !companyInfoTooltip.contains(e.target) &&
            !e.target.classList.contains('company-info-trigger')
          ) {
            hideTooltip();
          }
        });

        document.addEventListener('keydown', function (e) {
          if (e.key === 'Escape' && companyInfoTooltip.classList.contains('is-visible')) {
            hideTooltip();
          }
        });
      });
    </script>
<script>
      document.addEventListener('DOMContentLoaded', function () {
        /* ============================================================
       Action Menu Logic
    ============================================================= */
        document.querySelectorAll('.action-menu-btn').forEach(function (btn) {
          btn.addEventListener('click', function (e) {
            e.stopPropagation();

            var wrapper = this.closest('.action-menu-wrapper');
            var dropdown = wrapper ? wrapper.querySelector('.action-menu-dropdown') : null;

            if (dropdown) {
              // Close all other dropdowns
              document.querySelectorAll('.action-menu-dropdown').forEach(function (d) {
                if (d !== dropdown) {
                  d.classList.remove('is-visible');
                }
              });

              // Toggle current dropdown
              dropdown.classList.toggle('is-visible');
            }
          });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function () {
          document.querySelectorAll('.action-menu-dropdown').forEach(function (dropdown) {
            dropdown.classList.remove('is-visible');
          });
        });

        // Close dropdowns when clicking on dropdown items
        document.querySelectorAll('.action-menu-item').forEach((item) => {
          item.addEventListener('click', function () {
            this.closest('.action-menu-dropdown').classList.remove('is-visible');
          });
        });

        /* ============================================================
       Reservation Details Modal
    ============================================================= */
        var reservationDetailsModalEl = document.getElementById('reservationDetailsModal');
        var reservationDetailsModal = new bootstrap.Modal(reservationDetailsModalEl);
        var reservationHistoryModalEl = document.getElementById('reservationHistoryModal');
        var reservationHistoryModal = new bootstrap.Modal(reservationHistoryModalEl);
        var currentBookingRef = null;

        // Handle booking reference clicks to open reservation details modal
        document.querySelectorAll('.cell-booking-ref').forEach(function (link) {
          link.addEventListener('click', function (e) {
            e.preventDefault();
            var bookingRef = this.getAttribute('data-booking-ref');
            if (bookingRef) {
              currentBookingRef = bookingRef;
              document.getElementById('reservationBookingRef').textContent = bookingRef;
              // Also update meta fields with sample data for demo
              document.getElementById('reservationBookingCustomerMeta').textContent =
                'Maryam Yousuf Ahli';
              document.getElementById('reservationBookingOfficeMeta').textContent = 'الرياض - N2';
              reservationDetailsModal.show();
            }
          });
        });

        // Handle booking history and transactions buttons in reservation details modal
        document.querySelectorAll('[data-reservation-modal-action]').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var action = this.getAttribute('data-reservation-modal-action');
            var isTransactions = action === 'transactions';

            // Update modal title
            document.getElementById('reservationHistoryModalLabel').textContent = isTransactions
              ? 'تاريخ العمليات'
              : 'تاريخ الحجز';

            // Update booking ref in history table
            if (currentBookingRef) {
              reservationHistoryModalEl
                .querySelectorAll('[data-history-ref]')
                .forEach(function (cell) {
                  cell.textContent = currentBookingRef;
                });
            }

            // Update messages based on action
            var messages = isTransactions
              ? [
                  'تم استلام الدفعة الأولى.',
                  'تم استلام الدفعة الثانية.',
                  'تم استلام الدفعة الثالثة.',
                  'تم إكمال جميع الدفعات.',
                ]
              : [
                  'تم إنشاء الحجز.',
                  'تم تسجيل بيانات العميل.',
                  'تم تحديث حالة الحجز.',
                  'تم تجهيز الحجز للمتابعة.',
                ];

            reservationHistoryModalEl
              .querySelectorAll('[data-history-message]')
              .forEach(function (cell, index) {
                cell.textContent = messages[index] || '-';
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

        /* ============================================================
       Booking Logs Modal
    ============================================================= */
        const bookingLogsModalEl = document.getElementById('bookingLogsModal');
        const bookingLogsModal = new bootstrap.Modal(bookingLogsModalEl);

        /* ============================================================
       Subscription Logs Modal
    ============================================================= */
        const subscriptionLogsModalEl = document.getElementById('subscriptionLogsModal');
        const subscriptionLogsModal = new bootstrap.Modal(subscriptionLogsModalEl);

        /* ============================================================
       Export Functionality
    ============================================================= */
        // Export CSV
        document.getElementById('exportCsv').addEventListener('click', function (e) {
          e.preventDefault();
          exportTableAsCSV('payment_collection.csv');
        });

        // Export Excel
        document.getElementById('exportExcel').addEventListener('click', function (e) {
          e.preventDefault();
          exportTableAsCSV('payment_collection.xls');
        });

        // Export PDF
        document.getElementById('exportPdf').addEventListener('click', function (e) {
          e.preventDefault();
          alert('سيتم تصدير الملف بصيغة PDF');
        });

        function exportTableAsCSV(filename) {
          var table = document.getElementById('paymentCollectionTable');
          var rows = table.querySelectorAll('tbody tr');

          // Create CSV content
          var csvContent = [];
          var headers = [];
          table.querySelectorAll('thead th').forEach(function (th) {
            headers.push(th.textContent.trim());
          });
          csvContent.push(headers.join(','));

          rows.forEach(function (row) {
            var rowData = [];
            row.querySelectorAll('td').forEach(function (td) {
              rowData.push(td.textContent.trim());
            });
            csvContent.push(rowData.join(','));
          });

          // Create download link
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
      });
    </script>
@endpush

