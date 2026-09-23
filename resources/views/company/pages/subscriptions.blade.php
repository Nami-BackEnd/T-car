@extends('company.layouts.master')

@section('title', 'T-Car — قائمة الاشتراكات')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.subscriptions.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.pages.subscriptions.0') }}</span>
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
                <div
                  class="view-tabs"
                  role="tablist"
                   aria-label="{{ __('company.pages.subscriptions.17') }}"
                  id="subscriptionsStatusTabs"
                >
                  <button
                    type="button"
                    class="view-tabs__btn is-active"
                    role="tab"
                    aria-selected="true"
                    data-status-filter="all"
                  >
                    {{ __('company.common.223') }}</button>
                  <button
                    type="button"
                    class="view-tabs__btn"
                    role="tab"
                    aria-selected="false"
                    data-status-filter="اليوم"
                  >
                    {{ __('company.common.249') }}</button>
                  <button
                    type="button"
                    class="view-tabs__btn"
                    role="tab"
                    aria-selected="false"
                    data-status-filter="غدًا"
                  >
                    {{ __('company.pages.subscriptions.1') }}</button>
                  <button
                    type="button"
                    class="view-tabs__btn"
                    role="tab"
                    aria-selected="false"
                    data-status-filter="بعد غد"
                  >
                    {{ __('company.common.269') }}</button>
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
                
              </div>

              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="subscriptionsSearchInput"  placeholder="{{ __('company.common.253') }}" />
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="data-table" id="subscriptionsTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.215') }}</th>
                    <th>{{ __('company.common.235') }}</th>
                    <th>{{ __('company.pages.subscriptions.2') }}</th>
                    <th>{{ __('company.common.219') }}</th>
                    <th>{{ __('company.common.80') }}</th>
                    <th>{{ __('company.common.282') }}</th>
                    <th>{{ __('company.common.165') }}</th>
                    <th>{{ __('company.common.561') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr data-row-id="K9b510" data-status="معلق">
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
                        <span class="cell-customer-stack__name">{{ __('company.pages.subscriptions.3') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966534736268+</span>
                      </div>
                    </td>
                    <td><span class="cell-company">N2 Rental Car - Riyadh - Qurtubah</span></td>
                    <td>12</td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">16:00 ,2023-04-29</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">2023-04-23</span></span
                        >
                      </div>
                    </td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.408') }}</span>
                        <span class="cell-assignment__icons">
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
                    <td class="cell-close-date ltr-num">-</td>
                    <td><span class="badge bg-warning text-dark">{{ __('company.common.538') }}</span></td>
                    <td><span class="badge bg-danger">{{ __('company.common.490') }}</span></td>
                    <td>
                      <div class="cell-actions" style="justify-content: flex-end">
                        
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
                              <a
                                href="#"
                                class="dropdown-item action-menu-item"
                                data-action="extend"
                                ><i class="bi bi-clock"></i> {{ __('company.common.339') }}</a
                              >
                            </li>
                            <li>
                              <a href="#" class="dropdown-item action-menu-item" data-action="close"
                                ><i class="bi bi-x-circle"></i> {{ __('company.common.92') }}</a
                              >
                            </li>
                            <li class="subscription-review-action" hidden>
                              <a
                                href="#"
                                class="dropdown-item action-menu-item"
                                data-action="accept"
                                ><i class="bi bi-check-circle text-success"></i> {{ __('company.pages.subscriptions.4') }}</a
                              >
                            </li>
                            <li class="subscription-review-action" hidden>
                              <a
                                href="#"
                                class="dropdown-item action-menu-item"
                                data-action="reject"
                                ><i class="bi bi-x-circle text-danger"></i> {{ __('company.common.392') }}</a
                              >
                            </li>
                            <li>
                              <a
                                class="dropdown-item"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#reservationHistoryModal"
                                ><i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ route('company.booking-details-two') }}?tab=ratings"
                                ><i class="bi bi-star"></i> {{ __('company.common.83') }}</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="bi bi-file-earmark-arrow-down"></i> {{ __('company.common.346') }}</a
                              >
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr data-row-id="B6f2cc" data-status="مقبول">
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
                    <td><span class="cell-company">N2 Rental Car - Riyadh - Qurtubah</span></td>
                    <td>12</td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">11:00 ,2023-06-15</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">2023-07-15</span></span
                        >
                      </div>
                    </td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.409') }}</span>
                        <span class="cell-assignment__icons">
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
                    <td class="cell-close-date ltr-num">-</td>
                    <td><span class="badge bg-success">{{ __('company.common.545') }}</span></td>
                    <td><span class="badge bg-success">{{ __('company.common.566') }}</span></td>
                    <td>
                      <div class="cell-actions" style="justify-content: flex-end">
                        
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
                              <a
                                href="#"
                                class="dropdown-item action-menu-item"
                                data-action="extend"
                                ><i class="bi bi-clock"></i> {{ __('company.common.339') }}</a
                              >
                            </li>
                            <li>
                              <a href="#" class="dropdown-item action-menu-item" data-action="close"
                                ><i class="bi bi-x-circle"></i> {{ __('company.common.92') }}</a
                              >
                            </li>
                            <li class="subscription-review-action" hidden>
                              <a
                                href="#"
                                class="dropdown-item action-menu-item"
                                data-action="accept"
                                ><i class="bi bi-check-circle text-success"></i> {{ __('company.pages.subscriptions.4') }}</a
                              >
                            </li>
                            <li class="subscription-review-action" hidden>
                              <a
                                href="#"
                                class="dropdown-item action-menu-item"
                                data-action="reject"
                                ><i class="bi bi-x-circle text-danger"></i> {{ __('company.common.392') }}</a
                              >
                            </li>
                            <li>
                              <a
                                class="dropdown-item"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#reservationHistoryModal"
                                ><i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ route('company.booking-details-two') }}?tab=ratings"
                                ><i class="bi bi-star"></i> {{ __('company.common.83') }}</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="bi bi-file-earmark-arrow-down"></i> {{ __('company.common.346') }}</a
                              >
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <tr data-row-id="Fe2f98" data-status="مقبول">
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="Fe2f98"
                        >Fe2f98 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">AHMED MOHAMMED O ALQAUOD</span>
                        <span class="cell-customer-stack__phone ltr-num">966505284505+</span>
                      </div>
                    </td>
                    <td><span class="cell-company">N2 Rental Car - Riyadh - Qurtubah</span></td>
                    <td>12</td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">21:00 ,2023-04-20</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">2023-04-14</span></span
                        >
                      </div>
                    </td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.410') }}</span>
                        <span class="cell-assignment__icons">
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
                    <td class="cell-close-date ltr-num">-</td>
                    <td><span class="badge bg-success">{{ __('company.common.545') }}</span></td>
                    <td><span class="badge bg-success">{{ __('company.common.566') }}</span></td>
                    <td class="text-end">
                      <div class="cell-actions" style="justify-content: flex-end">
                        
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
                              <a
                                href="#"
                                class="dropdown-item action-menu-item"
                                data-action="extend"
                                ><i class="bi bi-clock"></i> {{ __('company.common.339') }}</a
                              >
                            </li>
                            <li>
                              <a href="#" class="dropdown-item action-menu-item" data-action="close"
                                ><i class="bi bi-x-circle"></i> {{ __('company.common.92') }}</a
                              >
                            </li>
                            <li class="subscription-review-action" hidden>
                              <a
                                href="#"
                                class="dropdown-item action-menu-item"
                                data-action="accept"
                                ><i class="bi bi-check-circle text-success"></i> {{ __('company.pages.subscriptions.4') }}</a
                              >
                            </li>
                            <li class="subscription-review-action" hidden>
                              <a
                                href="#"
                                class="dropdown-item action-menu-item"
                                data-action="reject"
                                ><i class="bi bi-x-circle text-danger"></i> {{ __('company.common.392') }}</a
                              >
                            </li>
                            <li>
                              <a
                                class="dropdown-item"
                                href="#"
                                data-bs-toggle="modal"
                                data-bs-target="#reservationHistoryModal"
                                ><i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="{{ route('company.booking-details-two') }}?tab=ratings"
                                ><i class="bi bi-star"></i> {{ __('company.common.83') }}</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="bi bi-file-earmark-arrow-down"></i> {{ __('company.common.346') }}</a
                              >
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>

              
              <div
                class="table-empty-state"
                id="subscriptionsEmptyState"
                style="
                  display: none;
                  text-align: center;
                  padding: 40px 16px;
                  color: var(--text-muted, #8a8fa3);
                "
              >
                <i
                  class="bi bi-inbox"
                  style="font-size: 28px; display: block; margin-bottom: 8px"
                ></i>
                <span>{{ __('company.pages.subscriptions.5') }}</span>
              </div>
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
                  <h5 class="car-logs-modal__header__title" id="bookingLogsModalLabel">
                    {{ __('company.common.422') }}</h5>
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
                      <div
                        class="car-logs-scrollctrl__thumb"
                        id="subscriptionLogsScrollThumb"
                      ></div>
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
                          <th>{{ __('company.common.165') }}</th>
                          <th>{{ __('company.common.225') }}</th>
                          <th>{{ __('company.common.528') }}</th>
                        </tr>
                      </thead>
                      <tbody id="subscriptionLogsTableBody">
                        <tr>
                          <td class="log-message--activate">
                            <span class="badge bg-success">{{ __('company.common.548') }}</span>
                          </td>
                          <td class="ltr-num">{{ __('company.common.14') }}</td>
                          <td>{{ __('company.common.512') }}</td>
                        </tr>
                        <tr>
                          <td class="log-message--accepted">
                            <span class="badge bg-primary">{{ __('company.common.545') }}</span>
                          </td>
                          <td class="ltr-num">{{ __('company.common.14') }}</td>
                          <td>{{ __('company.common.512') }}</td>
                        </tr>
                        <tr>
                          <td class="log-message--pending">
                            <span class="badge bg-warning">{{ __('company.common.538') }}</span>
                          </td>
                          <td class="ltr-num">{{ __('company.common.14') }}</td>
                          <td>{{ __('company.common.512') }}</td>
                        </tr>
                        <tr>
                          <td class="log-message--cancelled">
                            <span class="badge bg-danger">{{ __('company.common.554') }}</span>
                          </td>
                          <td class="ltr-num">{{ __('company.common.14') }}</td>
                          <td>{{ __('company.common.512') }}</td>
                        </tr>
                        <tr>
                          <td class="log-message--refunded">
                            <span class="badge bg-info">{{ __('company.pages.subscriptions.6') }}</span>
                          </td>
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
            id="filterModal"
            tabindex="-1"
            aria-hidden="true"
            aria-labelledby="filterModalLabel"
          >
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="filterModalLabel">{{ __('company.common.307') }}</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                     aria-label="{{ __('company.common.92') }}"
                  ></button>
                </div>
                <div class="modal-body">
                  
                  <div class="filter-section">
                    <h6 class="filter-section__title">{{ __('company.pages.subscriptions.7') }}</h6>

                    <div class="filter-section__fields">
                      <div class="filter-field">
                        <label>{{ __('company.pages.subscriptions.8') }}</label>
                        <button
                          type="button"
                          class="filter-date-btn js-date-trigger"
                          data-field-key="createdAt"
                        >
                          <span class="js-date-trigger-label">{{ __('company.pages.subscriptions.9') }}</span>
                          <i class="bi bi-chevron-down"></i>
                        </button>
                      </div>

                      <div class="filter-field">
                        <label>{{ __('company.common.284') }}</label>
                        <button
                          type="button"
                          class="filter-date-btn js-date-trigger"
                          data-field-key="pickupDate"
                        >
                          <span class="js-date-trigger-label">{{ __('company.pages.subscriptions.9') }}</span>
                          <i class="bi bi-chevron-down"></i>
                        </button>
                      </div>

                      <div class="filter-field">
                        <label>{{ __('company.common.588') }}</label>
                        <button
                          type="button"
                          class="filter-date-btn js-date-trigger"
                          data-field-key="deliveryTime"
                        >
                          <span class="js-date-trigger-label">{{ __('company.pages.subscriptions.9') }}</span>
                          <i class="bi bi-chevron-down"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline" data-bs-dismiss="modal">
                    {{ __('company.common.95') }}</button>
                  <button type="button" class="btn btn-primary" id="applyFilterBtn">{{ __('company.common.308') }}</button>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('modals')
</main>
        
      

    <div
      class="modal fade"
      id="addColumnsModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="addColumnsModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addColumnsModalLabel">{{ __('company.common.81') }}</h5>
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
                    <input type="checkbox" value="created-at" data-col-label="تم الإنشاء" />
                    <span>{{ __('company.common.326') }}</span>
                  </label>
                </div>

                <div class="filter-field filter-field--checkbox">
                  <label class="checkbox-label">
                    <input type="checkbox" value="pickup-date" data-col-label="تاريخ الاستلام" />
                    <span>{{ __('company.common.284') }}</span>
                  </label>
                </div>

                <div class="filter-field filter-field--checkbox">
                  <label class="checkbox-label">
                    <input type="checkbox" value="return-date" data-col-label="تاريخ التسليم" />
                    <span>{{ __('company.common.287') }}</span>
                  </label>
                </div>

                <div class="filter-field filter-field--checkbox">
                  <label class="checkbox-label">
                    <input type="checkbox" value="months-count" data-col-label="عدد الشهور" />
                    <span>{{ __('company.pages.subscriptions.2') }}</span>
                  </label>
                </div>

                <div class="filter-field filter-field--checkbox">
                  <label class="checkbox-label">
                    <input type="checkbox" value="cancellation-fee" data-col-label="رسوم الإلغاء" />
                    <span>{{ __('company.common.391') }}</span>
                  </label>
                </div>

                <div class="filter-field filter-field--checkbox">
                  <label class="checkbox-label">
                    <input
                      type="checkbox"
                      value="cancellation-reason"
                      data-col-label="سبب الإلغاء"
                    />
                    <span>{{ __('company.pages.subscriptions.10') }}</span>
                  </label>
                </div>

                <div class="filter-field filter-field--checkbox">
                  <label class="checkbox-label">
                    <input type="checkbox" value="total-amount" data-col-label="إجمالي المبلغ" />
                    <span>{{ __('company.pages.subscriptions.11') }}</span>
                  </label>
                </div>

                <div class="filter-field filter-field--checkbox">
                  <label class="checkbox-label">
                    <input type="checkbox" value="city" data-col-label="مدينة" />
                    <span>{{ __('company.common.517') }}</span>
                  </label>
                </div>

                <div class="filter-field filter-field--checkbox">
                  <label class="checkbox-label">
                    <input type="checkbox" value="vehicle" data-col-label="السيارة" />
                    <span>{{ __('company.common.203') }}</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
            <button type="button" class="btn btn-primary" id="applyColumnsBtn">{{ __('company.common.308') }}</button>
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
                    <div class="booking-detail-item__icon"><i class="bi bi-info-circle"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.365') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingAccepted"
                        >{{ __('company.common.495') }}</span
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
              <table class="car-logs-table">
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
                <tbody>
                  <tr class="history-row" data-type="booking">
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-type">{{ __('company.common.368') }}</td>
                    <td class="log-amount">-</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:00:00</td>
                    <td class="log-message--activate" data-history-message>{{ __('company.common.324') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
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
                    <td data-history-user>{{ __('company.common.563') }}</td>
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
                  <tr class="history-row" data-type="booking">
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-type">{{ __('company.common.368') }}</td>
                    <td class="log-amount">-</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:05:42</td>
                    <td class="log-message--activate" data-history-message>{{ __('company.common.335') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-actions">
                      <button class="btn-expand" data-expand-target="details-3">
                        <i class="bi bi-chevron-down"></i>
                      </button>
                    </td>
                  </tr>
                  <tr class="history-details-row" id="details-3" style="display: none">
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
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:09:10</td>
                    <td class="log-message--deactivate" data-history-message>
                      {{ __('company.common.332') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-actions">
                      <button class="btn-expand" data-expand-target="details-4">
                        <i class="bi bi-chevron-down"></i>
                      </button>
                    </td>
                  </tr>
                  <tr class="history-details-row" id="details-4" style="display: none">
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
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 09:12:14</td>
                    <td class="log-message--activate" data-history-message>
                      {{ __('company.pages.subscriptions.12') }}</td>
                    <td data-history-user>{{ __('company.common.564') }}</td>
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
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 09:14:38</td>
                    <td class="log-message--activate" data-history-message>
                      {{ __('company.pages.subscriptions.13') }}</td>
                    <td data-history-user>{{ __('company.common.564') }}</td>
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
                  <tr class="transaction-row" data-type="transaction" style="display: none">
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-type">{{ __('company.common.385') }}</td>
                    <td class="log-amount ltr-num">{{ __('company.common.14') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 09:16:02</td>
                    <td class="log-message--activate" data-history-message>
                      {{ __('company.pages.subscriptions.14') }}</td>
                    <td data-history-user>{{ __('company.common.564') }}</td>
                    <td class="log-actions">
                      <button class="btn-expand" data-expand-target="trans-details-3">
                        <i class="bi bi-chevron-down"></i>
                      </button>
                    </td>
                  </tr>
                  <tr class="transaction-details-row" id="trans-details-3" style="display: none">
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
                            >pay_4snk33qbbimiviupw45nqpkm3i</span
                          >
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr class="transaction-row" data-type="transaction" style="display: none">
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-type">{{ __('company.common.385') }}</td>
                    <td class="log-amount ltr-num">-</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 09:18:20</td>
                    <td class="log-message--activate" data-history-message>
                      {{ __('company.pages.subscriptions.15') }}</td>
                    <td data-history-user>{{ __('company.common.565') }}</td>
                    <td class="log-actions">
                      <button class="btn-expand" data-expand-target="trans-details-4">
                        <i class="bi bi-chevron-down"></i>
                      </button>
                    </td>
                  </tr>
                  <tr class="transaction-details-row" id="trans-details-4" style="display: none">
                    <td colspan="7">
                      <div class="history-details">
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.404') }}</span>
                          <span class="history-detail-value">-</span>
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

    
    <div
      class="modal fade"
      id="editSubscriptionModal"
      tabindex="-1"
      aria-labelledby="editSubscriptionModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editSubscriptionModalLabel">{{ __('company.pages.subscriptions.16') }}</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body">
            <form id="editSubscriptionForm">
              <div class="row gy-3 mb-3">
                <div class="col-md-6">
                  <label for="editSubscriptionCustomer" class="form-label">{{ __('company.common.215') }}</label>
                  <input
                    type="text"
                    class="form-control bg-light"
                    id="editSubscriptionCustomer"
                    readonly
                    style="cursor: not-allowed"
                  />
                </div>
                <div class="col-md-6">
                  <label for="editSubscriptionCompany" class="form-label">{{ __('company.common.206') }}</label>
                  <input
                    type="text"
                    class="form-control bg-light"
                    id="editSubscriptionCompany"
                    readonly
                    style="cursor: not-allowed"
                  />
                </div>
                <div class="col-md-6">
                  <label for="editSubscriptionPeriod" class="form-label">{{ __('company.common.219') }}</label>
                  <input type="number" class="form-control" id="editSubscriptionPeriod" min="1" />
                </div>
                <div class="col-md-6">
                  <label for="editSubscriptionStartDate" class="form-label">{{ __('company.common.286') }}</label>
                  <input type="date" class="form-control" id="editSubscriptionStartDate" />
                </div>
                <div class="col-md-6">
                  <label for="editSubscriptionEndDate" class="form-label">{{ __('company.common.285') }}</label>
                  <input type="date" class="form-control" id="editSubscriptionEndDate" />
                </div>
                <div class="col-md-6">
                  <label for="editSubscriptionStatus" class="form-label">{{ __('company.common.165') }}</label>
                  <select class="form-select" id="editSubscriptionStatus">
                    <option value="مقبول">{{ __('company.common.545') }}</option>
                    <option value="مرفوض">{{ __('company.common.521') }}</option>
                    <option value="معلق">{{ __('company.common.538') }}</option>
                    <option value="ملغي">{{ __('company.common.554') }}</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="editSubscriptionActive" class="form-label">{{ __('company.common.561') }}</label>
                  <select class="form-select" id="editSubscriptionActive">
                    <option value="نعم">{{ __('company.common.566') }}</option>
                    <option value="لا">{{ __('company.common.490') }}</option>
                  </select>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
            <button type="button" class="btn btn-primary" id="saveSubscriptionBtn">
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
            <h4
              class="mb-3"
              id="successModalLabel"
              style="font-family: 'Alexandria', sans-serif; font-weight: 600"
            >
              {{ __('company.common.329') }}</h4>
            <p class="text-muted mb-4" style="font-family: 'Alexandria', sans-serif">
              {{ __('company.common.333') }}</p>
            <button type="button" class="btn btn-primary m-auto" data-bs-dismiss="modal">
              {{ __('company.common.374') }}</button>
          </div>
        </div>
      </div>
    </div>

    
@endpush

@push('scripts')
<script>
      // متغير لتخزين الصف الحالي الذي يتم تعديله
      let currentEditingRow = null;

      // فتح نموذج التعديل مع بيانات الصف المحدد
      document
        .querySelectorAll('.btn-primary[data-bs-target="#editSubscriptionModal"]')
        .forEach(function (editBtn) {
          editBtn.addEventListener('click', function () {
            // العثور على الصف الذي يحتوي على زر التعديل
            currentEditingRow = this.closest('tr');

            if (currentEditingRow) {
              // استخراج البيانات من الصف
              const bookingRef = currentEditingRow
                .querySelector('.cell-booking-ref')
                .textContent.trim();
              const customerName = currentEditingRow
                .querySelector('.cell-customer-stack__name')
                .textContent.trim();
              const company = currentEditingRow.querySelector('.cell-company').textContent.trim();
              const period = currentEditingRow.cells[3].textContent.trim();
              const periodDates = currentEditingRow.querySelectorAll(
                '.cell-period__dates .ltr-num',
              );
              const startDate = periodDates[1].textContent.trim();
              const endDate = periodDates[0].textContent.trim();
              const status = currentEditingRow.querySelector('.badge').textContent.trim();
              const active = currentEditingRow.querySelectorAll('.badge')[1].textContent.trim();

              // Parse dates and format for date input (YYYY-MM-DD)
              const parseDate = (dateStr) => {
                const parts = dateStr.split(',').map((p) => p.trim());
                if (parts.length > 1) {
                  return parts[1].trim(); // Get the date part if it includes time
                }
                return dateStr.trim();
              };

              const formattedStartDate = parseDate(startDate);
              const formattedEndDate = parseDate(endDate);

              // ملء النموذج بالبيانات
              // document.getElementById('editSubscriptionRef').value = bookingRef;
              document.getElementById('editSubscriptionCustomer').value = customerName;
              document.getElementById('editSubscriptionCompany').value = company;
              document.getElementById('editSubscriptionPeriod').value = period;
              document.getElementById('editSubscriptionStartDate').value = formattedStartDate;
              document.getElementById('editSubscriptionEndDate').value = formattedEndDate;
              document.getElementById('editSubscriptionStatus').value = status;
              document.getElementById('editSubscriptionActive').value = active;
            }
          });
        });

      // حفظ التغييرات وتحديث الجدول
      document.getElementById('saveSubscriptionBtn').addEventListener('click', function () {
        if (currentEditingRow) {
          // الحصول على القيم الجديدة من النموذج
          const newCustomer = document.getElementById('editSubscriptionCustomer').value;
          const newCompany = document.getElementById('editSubscriptionCompany').value;
          const newPeriod = document.getElementById('editSubscriptionPeriod').value;
          const newStartDate = document.getElementById('editSubscriptionStartDate').value;
          const newEndDate = document.getElementById('editSubscriptionEndDate').value;
          const newStatus = document.getElementById('editSubscriptionStatus').value;
          const newActive = document.getElementById('editSubscriptionActive').value;

          currentEditingRow.querySelector('.cell-customer-stack__name').textContent = newCustomer;
          currentEditingRow.querySelector('.cell-company').textContent = newCompany;
          currentEditingRow.cells[3].textContent = newPeriod;

          const periodDates = currentEditingRow.querySelectorAll('.cell-period__dates .ltr-num');
          periodDates[1].textContent = newStartDate;
          periodDates[0].textContent = newEndDate;

          const statusBadge = currentEditingRow.querySelector('.badge');
          statusBadge.textContent = newStatus;

          // تحديث لون الحالة
          statusBadge.className = 'badge';
          if (newStatus === 'مقبول') {
            statusBadge.classList.add('bg-success');
          } else if (newStatus === 'مرفوض' || newStatus === 'ملغي') {
            statusBadge.classList.add('bg-danger');
          } else if (newStatus === 'معلق') {
            statusBadge.classList.add('bg-warning');
          }

          const activeBadge = currentEditingRow.querySelectorAll('.badge')[1];
          activeBadge.textContent = newActive;
          activeBadge.className = 'badge';
          if (newActive === 'نعم') {
            activeBadge.classList.add('bg-success');
          } else {
            activeBadge.classList.add('bg-danger');
          }

          // تحديث data-status للفلترة
          currentEditingRow.setAttribute('data-status', newStatus);
          currentEditingRow
            .querySelectorAll('.subscription-review-action')
            .forEach(function (item) {
              item.hidden = !['معلق', 'بانتظار الموافقة', 'pending'].includes(newStatus);
            });

          // إغلاق النموذج
          const modal = bootstrap.Modal.getInstance(
            document.getElementById('editSubscriptionModal'),
          );
          modal.hide();

          // إظهار مودال النجاح
          const successModal = new bootstrap.Modal(document.getElementById('successModal'));
          successModal.show();
        }
      });
    </script>
<script>
      (function () {
        document.addEventListener('show.bs.modal', function (event) {
          var openModalsCount = document.querySelectorAll('.modal.show').length;

          // لو مفيش مودال مفتوح حالياً، سيبه بالسلوك الافتراضي
          if (openModalsCount === 0) return;

          var newModal = event.target;
          var baseZIndex = 1055 + openModalsCount * 20;

          // رفع z-index بتاع المودال الجديد فوق أي مودال مفتوح
          newModal.style.zIndex = baseZIndex + 10;

          // رفع z-index بتاع الـ backdrop الخاص بيه (بيتضاف بعد الحدث بلحظة)
          setTimeout(function () {
            var backdrops = document.querySelectorAll('.modal-backdrop');
            var newestBackdrop = backdrops[backdrops.length - 1];
            if (newestBackdrop) {
              newestBackdrop.style.zIndex = baseZIndex;
            }
          }, 0);
        });

        // عند إغلاق مودال فرعي، إرجاع تركيز لوحة المفاتيح للمودال اللي تحته إن وجد
        document.addEventListener('hidden.bs.modal', function () {
          var stillOpen = document.querySelectorAll('.modal.show');
          if (stillOpen.length > 0) {
            document.body.classList.add('modal-open');
          }
        });
      })();
    </script>
<script>
      document.addEventListener('DOMContentLoaded', function () {
        var table = document.getElementById('subscriptionsTable');
        var thead = table.querySelector('thead tr');
        var tbody = table.querySelector('tbody');
        var addColumnsModalEl = document.getElementById('addColumnsModal');
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

            // Update messages with combined booking and transaction data
            var messages = [
              'تم إنشاء الحجز.',
              'تم تسجيل بيانات العميل.',
              'تم تحديث حالة الحجز.',
              'تم تجهيز الحجز للمتابعة.',
              'تم استلام الدفعة الأولى.',
              'تم استلام الدفعة الثانية.',
              'تم استلام الدفعة الثالثة.',
              'تم إكمال جميع الدفعات.',
            ];

            reservationHistoryModalEl
              .querySelectorAll('[data-history-message]')
              .forEach(function (cell, index) {
                cell.textContent = messages[index] || '-';
              });

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

        // Handle view-tabs click in reservation details modal
        reservationDetailsModalEl
          .querySelectorAll('[data-reservation-booking-tab]')
          .forEach(function (tabBtn) {
            tabBtn.addEventListener('click', function () {
              var targetTab = this.getAttribute('data-reservation-booking-tab');

              // Remove is-active class from all tab buttons
              reservationDetailsModalEl
                .querySelectorAll('[data-reservation-booking-tab]')
                .forEach(function (btn) {
                  btn.classList.remove('is-active');
                  btn.setAttribute('aria-selected', 'false');
                });

              // Add is-active class to clicked tab button
              this.classList.add('is-active');
              this.setAttribute('aria-selected', 'true');

              // Hide all panels
              reservationDetailsModalEl
                .querySelectorAll('[data-reservation-booking-panel]')
                .forEach(function (panel) {
                  panel.classList.remove('is-active');
                });

              // Show target panel
              var targetPanel = reservationDetailsModalEl.querySelector(
                '[data-reservation-booking-panel="' + targetTab + '"]',
              );
              if (targetPanel) {
                targetPanel.classList.add('is-active');
              }
            });
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

        /* ============================================================
         Status View-Tabs Filter (الكل / مقبول / ملغي / إرجاع مبكر / مكتمل)
         يعتمد على data-status الموجودة على كل <tr>، والتي تُقارَن
         بقيمة data-status-filter الخاصة بكل تبويب.
      ============================================================= */
        var statusTabsWrap = document.getElementById('subscriptionsStatusTabs');
        var statusTabButtons = Array.from(statusTabsWrap.querySelectorAll('[data-status-filter]'));
        var searchInput = document.getElementById('subscriptionsSearchInput');
        var emptyState = document.getElementById('subscriptionsEmptyState');
        var activeStatusFilter = 'all';

        function getAllRows() {
          return Array.from(tbody.querySelectorAll('tr[data-row-id]'));
        }

        function applyTableFilters() {
          var rows = getAllRows();
          var searchTerm =
            searchInput && searchInput.value ? searchInput.value.trim().toLowerCase() : '';
          var visibleCount = 0;

          rows.forEach(function (row) {
            var rowStatus = row.getAttribute('data-status') || '';
            var matchesStatus = activeStatusFilter === 'all' || rowStatus === activeStatusFilter;

            var matchesSearch = true;
            if (searchTerm) {
              var rowText = row.textContent.trim().toLowerCase();
              matchesSearch = rowText.indexOf(searchTerm) !== -1;
            }

            var isVisible = matchesStatus && matchesSearch;
            row.style.display = isVisible ? '' : 'none';
            if (isVisible) visibleCount++;
          });

          if (emptyState) {
            emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
          }
        }

        statusTabButtons.forEach(function (btn) {
          btn.addEventListener('click', function () {
            // تبديل الحالة الفعالة بصريًا
            statusTabButtons.forEach(function (b) {
              b.classList.remove('is-active');
              b.setAttribute('aria-selected', 'false');
            });
            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');

            activeStatusFilter = this.getAttribute('data-status-filter');
            applyTableFilters();
          });
        });

        if (searchInput) {
          searchInput.addEventListener('input', applyTableFilters);
        }

        // تطبيق الفلترة الابتدائية عند تحميل الصفحة (حسب التبويب النشط افتراضيًا)
        var initiallyActiveTab = statusTabButtons.find(function (b) {
          return b.classList.contains('is-active');
        });
        activeStatusFilter = initiallyActiveTab
          ? initiallyActiveTab.getAttribute('data-status-filter')
          : 'all';
        applyTableFilters();

        // بيانات تجريبية لكل صف (بديل مؤقت لحين ربطها بالـ backend الفعلي)
        var mockColumnData = {
          K9b510: {
            'created-at': '2023-04-10',
            'pickup-date': '2023-04-23',
            'return-date': '2024-03-25',
            'early-return-date': '-',
            'early-return-fee': '0.00 ريال',
            'months-count': '12',
            'cancellation-fee': '-',
            'cancellation-reason': '-',
            'total-amount': '23000.00 ريال',
            'monthly-payment': '1916.66 ريال',
            city: 'الرياض',
            vehicle: 'تويوتا كامري 2023',
          },
          B6f2cc: {
            'created-at': '2023-06-01',
            'pickup-date': '2023-06-15',
            'return-date': '2024-05-15',
            'early-return-date': '-',
            'early-return-fee': '0.00 ريال',
            'months-count': '12',
            'cancellation-fee': '-',
            'cancellation-reason': '-',
            'total-amount': '23000.00 ريال',
            'monthly-payment': '1916.66 ريال',
            city: 'الرياض',
            vehicle: 'هيونداي سوناتا 2023',
          },
          Fe2f98: {
            'created-at': '2023-04-05',
            'pickup-date': '2023-04-14',
            'return-date': '2024-05-20',
            'early-return-date': '-',
            'early-return-fee': '0.00 ريال',
            'months-count': '2',
            'cancellation-fee': '-',
            'cancellation-reason': '-',
            'total-amount': '2012.50 ريال',
            'monthly-payment': '1006.25 ريال',
            city: 'الرياض',
            vehicle: 'كيا سيراتو 2023',
          },
        };

        // عند فتح المودال: مزامنة حالة الشيك بوكس مع الأعمدة الظاهرة فعلياً في الجدول
        addColumnsModalEl.addEventListener('show.bs.modal', function () {
          var currentExtraKeys = Array.from(thead.querySelectorAll('th.is-extra-col')).map(
            function (th) {
              return th.getAttribute('data-key');
            },
          );

          addColumnsModalEl.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
            checkbox.checked = currentExtraKeys.indexOf(checkbox.value) !== -1;
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
         Extension Modal
      ============================================================= */
        var extensionModalEl = document.getElementById('extensionModal');
        var extensionModal = new bootstrap.Modal(extensionModalEl);
        var extensionConfirmModalEl = document.getElementById('extensionConfirmModal');
        var extensionConfirmModal = new bootstrap.Modal(extensionConfirmModalEl);
        var confirmExtendBtn = document.getElementById('confirmExtendBtn');
        var currentExtendRow = null;

        if (confirmExtendBtn) {
          confirmExtendBtn.addEventListener('click', function () {
            var extensionState = window.ExtensionCalculator.validate();
            if (!extensionState) return;

            var newReturnDate = extensionState.date;
            var bookingRef = document.getElementById('extendBookingRef').textContent;

            // Here you would typically send an API request to extend the booking
            document.getElementById('extensionConfirmMessage').textContent =
              'سيتم تمديد الحجز ' +
              bookingRef +
              ' لمدة ' +
              extensionState.days +
              ' أيام إلى تاريخ: ' +
              newReturnDate +
              ' بمبلغ إضافي: ' +
              extensionState.amount.toFixed(2) +
              ' ر.س - ' +
              extensionState.typeLabel +
              ' (طريقة الدفع: ' +
              extensionState.paymentLabel +
              ')' +
              (extensionState.type === 'cash'
                ? '. تم تحصيل المبلغ نقدًا وإضافته إلى فاتورة الحجز.'
                : '.');

            // Preserve the period markup and update the current return date only.
            if (currentExtendRow) {
              var periodDates = currentExtendRow.querySelectorAll('.cell-period__dates .ltr-num');
              var returnDateElement = Array.prototype.find.call(periodDates, function (element) {
                return element.textContent.indexOf(extensionState.currentReturnDate) !== -1;
              });
              if (returnDateElement) returnDateElement.textContent = newReturnDate;

              // Restart the flash animation even if this row was just
              // extended a moment ago.
              currentExtendRow.classList.remove('row-flash');
              void currentExtendRow.offsetWidth;
              currentExtendRow.classList.add('row-flash');
            }

            // Wait for the extension modal to fully finish closing before
            // showing the confirmation modal, so the two don't overlap.
            extensionModalEl.addEventListener(
              'hidden.bs.modal',
              function () {
                extensionConfirmModal.show();
              },
              { once: true },
            );

            // إغلاق المودال يدوياً فقط بعد نجاح الفاليديشن (تم اختيار التاريخ)
            extensionModal.hide();
          });
        }

        /* ============================================================
         Action Menu Handler
      ============================================================= */
        function getSubscriptionStatus(row) {
          var statusBadge = row ? row.querySelector('td:nth-child(8) .badge') : null;
          return row?.dataset.status || statusBadge?.textContent.trim() || '';
        }

        function canReviewSubscription(row) {
          return ['معلق', 'بانتظار الموافقة', 'pending'].includes(getSubscriptionStatus(row));
        }

        function syncSubscriptionReviewActions(row) {
          if (!row) return;
          row.querySelectorAll('.subscription-review-action').forEach(function (item) {
            item.hidden = !canReviewSubscription(row);
          });
        }

        function updateSubscriptionStatus(row, status, badgeClass) {
          if (!row) return;
          row.dataset.status = status;
          var statusBadge = row.querySelector('td:nth-child(8) .badge');
          if (statusBadge) {
            statusBadge.textContent = status;
            statusBadge.className = 'badge ' + badgeClass;
          }
          syncSubscriptionReviewActions(row);
          applyTableFilters();
        }

        var subscriptionStatusConfirmModal = new bootstrap.Modal(
          document.getElementById('subscriptionStatusConfirmModal'),
        );
        var subscriptionCancellationReasonModal = new bootstrap.Modal(
          document.getElementById('subscriptionCancellationReasonModal'),
        );
        var subscriptionSuccessModal = new bootstrap.Modal(document.getElementById('successModal'));
        var subscriptionStatusRow = null;
        var subscriptionCancellationRow = null;
        var subscriptionCancellationReason = document.getElementById(
          'subscriptionCancellationReason',
        );
        var subscriptionCancellationNotes = document.getElementById(
          'subscriptionCancellationNotes',
        );
        var subscriptionCancellationNotesContainer = document.getElementById(
          'subscriptionCancellationNotesContainer',
        );
        var subscriptionCancellationReasonError = document.getElementById(
          'subscriptionCancellationReasonError',
        );

        function showSubscriptionSuccess(message) {
          document.getElementById('successModalLabel').textContent = message;
          subscriptionSuccessModal.show();
        }

        function openSubscriptionAcceptConfirm(row) {
          if (!canReviewSubscription(row)) return;
          subscriptionStatusRow = row;
          document.getElementById('subscriptionStatusConfirmTitle').textContent = 'قبول الاشتراك؟';
          document.getElementById('subscriptionStatusConfirmText').textContent =
            'سيتم قبول هذا الاشتراك وتفعيله.';
          subscriptionStatusConfirmModal.show();
        }

        function resetSubscriptionCancellationForm() {
          subscriptionCancellationReason.value = '';
          subscriptionCancellationNotes.value = '';
          subscriptionCancellationNotesContainer.style.display = 'none';
          subscriptionCancellationReasonError.style.display = 'none';
        }

        function openSubscriptionRejectModal(row) {
          if (!canReviewSubscription(row)) return;
          subscriptionCancellationRow = row;
          resetSubscriptionCancellationForm();
          subscriptionCancellationReasonModal.show();
        }

        document
          .getElementById('subscriptionStatusConfirmBtn')
          .addEventListener('click', function () {
            if (!subscriptionStatusRow || !canReviewSubscription(subscriptionStatusRow)) return;
            updateSubscriptionStatus(subscriptionStatusRow, 'مقبول', 'bg-success');
            subscriptionStatusRow = null;
            document.getElementById('subscriptionStatusConfirmModal').addEventListener(
              'hidden.bs.modal',
              function () {
                showSubscriptionSuccess('تم قبول الاشتراك بنجاح');
              },
              { once: true },
            );
            subscriptionStatusConfirmModal.hide();
          });

        subscriptionCancellationReason.addEventListener('change', function () {
          subscriptionCancellationNotesContainer.style.display =
            this.value === 'أسباب أخرى' ? 'block' : 'none';
          subscriptionCancellationReasonError.style.display = 'none';
        });

        document
          .getElementById('confirmSubscriptionCancellationBtn')
          .addEventListener('click', function () {
            if (
              !subscriptionCancellationRow ||
              !canReviewSubscription(subscriptionCancellationRow)
            ) {
              return;
            }
            if (!subscriptionCancellationReason.value) {
              subscriptionCancellationReasonError.style.display = 'block';
              return;
            }
            var reason = subscriptionCancellationReason.value;
            if (reason === 'أسباب أخرى' && subscriptionCancellationNotes.value.trim()) {
              reason = subscriptionCancellationNotes.value.trim();
            }
            subscriptionCancellationRow.dataset.rejectionReason = reason;
            updateSubscriptionStatus(subscriptionCancellationRow, 'مرفوض', 'bg-danger');
            subscriptionCancellationRow = null;
            document.getElementById('subscriptionCancellationReasonModal').addEventListener(
              'hidden.bs.modal',
              function () {
                showSubscriptionSuccess('تم رفض الاشتراك بنجاح');
              },
              { once: true },
            );
            subscriptionCancellationReasonModal.hide();
          });

        document
          .getElementById('subscriptionCancellationReasonModal')
          .addEventListener('hidden.bs.modal', function () {
            resetSubscriptionCancellationForm();
            subscriptionCancellationRow = null;
          });

        tbody.querySelectorAll('tr[data-row-id]').forEach(syncSubscriptionReviewActions);

        // Handle action menu items with data-action attribute
        document.querySelectorAll('.action-menu-item[data-action]').forEach(function (item) {
          item.addEventListener('click', function (e) {
            e.preventDefault();
            var action = this.getAttribute('data-action');
            var row = this.closest('tr');
            var bookingRef = row ? row.querySelector('.cell-booking-ref') : null;
            var bookingRefValue = bookingRef ? bookingRef.getAttribute('data-booking-ref') : null;

            switch (action) {
              case 'extend':
                // Populate extension modal with booking details
                if (bookingRefValue) {
                  currentExtendRow = row;
                  document.getElementById('extendBookingRef').textContent = bookingRefValue;
                  document.getElementById('extendCustomer').textContent =
                    row.querySelector('.cell-customer-stack__name')?.textContent || '-';
                  window.ExtensionCalculator.prepareFromRow(row, 1);

                  // Open extension modal
                  extensionModal.show();
                }
                break;
              case 'close':
                currentCloseRow = row;
                currentCloseBookingRef = bookingRefValue || 'غير محدد';
                window.CloseReservationForm.prepareFromRow(row, currentCloseBookingRef);
                closeReservationModal.show();
                break;
              case 'accept':
                openSubscriptionAcceptConfirm(row);
                break;
              case 'reject':
                openSubscriptionRejectModal(row);
                break;
            }
          });
        });

        /* ============================================================
         Export Functionality (same as employee-performance)
      ============================================================= */
        // Export CSV
        var exportCsvBtn = document.getElementById('exportCsv');
        if (exportCsvBtn) {
          exportCsvBtn.addEventListener('click', function (e) {
            e.preventDefault();
            exportTableAsCSV('subscriptions.csv');
          });
        }

        // Export Excel
        document.getElementById('exportExcel').addEventListener('click', function (e) {
          e.preventDefault();
          exportTableAsCSV('subscriptions.xls');
        });

        // Export PDF
        var exportPdfBtn = document.getElementById('exportPdf');
        if (exportPdfBtn) {
          exportPdfBtn.addEventListener('click', function (e) {
            e.preventDefault();
            alert('سيتم تصدير الملف بصيغة PDF');
          });
        }

        /* ============================================================
       Close Subscription Modal Handlers
      ============================================================= */
        var closeReservationModalEl = document.getElementById('closeReservationModal');
        var closeReservationModal = new bootstrap.Modal(closeReservationModalEl);
        var closeReservationSuccessModalEl = document.getElementById(
          'closeReservationSuccessModal',
        );
        var closeReservationSuccessModal = new bootstrap.Modal(closeReservationSuccessModalEl);
        var currentCloseRow = null;
        var currentCloseBookingRef = null;

        // Handle confirm close button
        document
          .getElementById('confirmCloseReservationBtn')
          .addEventListener('click', function () {
            var closeDate = window.CloseReservationForm.validate();
            if (!closeDate || !currentCloseRow) return;

            var closeState = window.CloseReservationForm.getState();
            var successContent = window.CloseReservationForm.getSuccessContent(
              currentCloseBookingRef,
              'الاشتراك',
            );
            window.CloseReservationForm.updateRow(currentCloseRow, closeState);
            document.getElementById('closeReservationSuccessModalLabel').textContent =
              successContent.title;
            document.getElementById('closeReservationSuccessMessage').textContent =
              successContent.message;

            closeReservationModalEl.addEventListener(
              'hidden.bs.modal',
              function () {
                closeReservationSuccessModal.show();
              },
              { once: true },
            );
            closeReservationModal.hide();
          });

        function exportTableAsCSV(filename) {
          var table = document.getElementById('subscriptionsTable');
          var rows = Array.from(table.querySelectorAll('tbody tr')).filter(function (row) {
            return row.style.display !== 'none';
          });

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

        document.getElementById('applyColumnsBtn').addEventListener('click', function () {
          var checkedValues = Array.from(
            addColumnsModalEl.querySelectorAll('input[type="checkbox"]:checked'),
          ).map(function (cb) {
            return cb.value;
          });

          var currentExtraKeys = Array.from(thead.querySelectorAll('th.is-extra-col')).map(
            function (th) {
              return th.getAttribute('data-key');
            },
          );

          // 1) إزالة الأعمدة التي أُلغي تحديدها
          currentExtraKeys.forEach(function (key) {
            if (checkedValues.indexOf(key) === -1) {
              removeColumn(key);
            }
          });

          // 2) إضافة الأعمدة المحددة الجديدة فقط (تفادي التكرار)
          checkedValues.forEach(function (key) {
            var alreadyExists = thead.querySelector('th.is-extra-col[data-key="' + key + '"]');
            if (!alreadyExists) {
              var checkbox = addColumnsModalEl.querySelector('input[value="' + key + '"]');
              var label =
                checkbox.getAttribute('data-col-label') ||
                checkbox.closest('label').querySelector('span').textContent.trim();
              addColumn(key, label);
            }
          });

          var modal = bootstrap.Modal.getInstance(addColumnsModalEl);
          modal.hide();
        });

        function addColumn(key, label) {
          // العمود الجديد يُضاف قبل عمود "الإجراءات" حتى يبقى دائماً آخر عمود في الجدول
          var actionsTh = thead.querySelector('th:last-child');

          var newTh = document.createElement('th');
          newTh.textContent = label;
          newTh.classList.add('is-extra-col');
          newTh.setAttribute('data-key', key);
          thead.insertBefore(newTh, actionsTh);

          tbody.querySelectorAll('tr').forEach(function (row) {
            var rowId = row.getAttribute('data-row-id');
            var value = (mockColumnData[rowId] && mockColumnData[rowId][key]) || '-';

            var actionsTd = row.querySelector('td:last-child');
            var newTd = document.createElement('td');
            newTd.classList.add('is-extra-col');
            newTd.setAttribute('data-key', key);
            newTd.textContent = value;
            row.insertBefore(newTd, actionsTd);
          });
        }

        function removeColumn(key) {
          var th = thead.querySelector('th.is-extra-col[data-key="' + key + '"]');
          if (th) th.remove();

          tbody.querySelectorAll('td.is-extra-col[data-key="' + key + '"]').forEach(function (td) {
            td.remove();
          });
        }
      });
    </script>
@endpush

