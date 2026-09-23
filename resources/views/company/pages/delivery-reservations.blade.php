@extends('company.layouts.master')

@section('title', 'T-Car — Delivery Reservations')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.delivery-reservations.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.167') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current"> {{ __('company.pages.delivery-reservations.0') }}</span>
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
                <div class="view-tabs" role="tablist"  aria-label="{{ __('company.common.306') }}">
                  <button
                    type="button"
                    class="view-tabs__btn view-tabs__btn--all is-active"
                    role="tab"
                    aria-selected="true"
                  >
                    {{ __('company.common.223') }}</button>
                  <button
                    type="button"
                    class="view-tabs__btn view-tabs__btn--today"
                    role="tab"
                    aria-selected="false"
                  >
                    {{ __('company.common.249') }}</button>
                  <button
                    type="button"
                    class="view-tabs__btn view-tabs__btn--tomorrow"
                    role="tab"
                    aria-selected="false"
                  >
                    {{ __('company.common.454') }}</button>
                  <button
                    type="button"
                    class="view-tabs__btn view-tabs__btn--day-after"
                    role="tab"
                    aria-selected="false"
                  >
                    {{ __('company.common.269') }}</button>
                </div>
              </div>
            </div>

            <div class="table-filter-bar">
              <div class="table-filter-bar__left">
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
                    {{ __('company.common.229') }}<i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>
                    <li><a class="dropdown-item" href="#">{{ __('company.common.183') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('company.common.357') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('company.common.174') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('company.common.546') }}</a></li>
                  </ul>
                </div>
                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    {{ __('company.common.235') }}<i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">{{ __('company.common.185') }}</a>
                    </li>
                    <li><a class="dropdown-item" href="#">{{ __('company.common.358') }}</a></li>
                    <li>
                      <a class="dropdown-item" href="#">{{ __('company.common.175') }}</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="returnSearchInput"  placeholder="{{ __('company.common.253') }}" />
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="data-table" id="returnTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.449') }}</th>
                    <th>{{ __('company.common.430') }}</th>
                    <th>{{ __('company.common.138') }}</th>
                    <th>{{ __('company.common.284') }}</th>
                    <th>{{ __('company.common.80') }}</th>
                    <th>{{ __('company.common.364') }}</th>
                    <th>{{ __('company.common.363') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="tr--day-after">
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="Cc3774"
                        >Cc3774 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">COTO TT</span>
                        <span class="cell-customer-stack__phone ltr-num">966500578555+</span>
                      </div>
                    </td>
                    <td>{{ __('company.common.360') }}</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td class="ltr-num">2026-03-20<br />00:15:00</td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.433') }}</span>
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
                    <td><span class="badge bg-success">{{ __('company.common.446') }}</span></td>
                    <td><span class="badge bg-danger">{{ __('company.common.495') }}</span></td>
                    <td class="">
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
                            <a href="#" class="dropdown-item action-menu-item" data-action="extend"
                              ><i class="bi bi-clock"></i> {{ __('company.common.339') }}</a
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
                    </td>
                  </tr>
                  <tr class="tr--day-after">
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="B44f06"
                        >B44f06 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">BANDAR Nasser</span>
                        <span class="cell-customer-stack__phone ltr-num">966506768834+</span>
                      </div>
                    </td>
                    <td>{{ __('company.common.583') }}</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td class="ltr-num">2026-03-24<br />18:45:00</td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.433') }}</span>
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
                    <td><span class="badge bg-success">{{ __('company.common.446') }}</span></td>
                    <td><span class="badge bg-success">{{ __('company.common.470') }}</span></td>
                    <td class="">
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
                            <a href="#" class="dropdown-item action-menu-item" data-action="extend"
                              ><i class="bi bi-clock"></i> {{ __('company.common.339') }}</a
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
                    </td>
                  </tr>
                  <tr class="tr--day-after">
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="A744f6"
                        >A744f6 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.common.265') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966555901899+</span>
                      </div>
                    </td>
                    <td>{{ __('company.common.577') }}</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td class="ltr-num">2026-03-24<br />22:00:00</td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.433') }}</span>
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
                    <td><span class="badge bg-success">{{ __('company.common.446') }}</span></td>
                    <td><span class="badge bg-danger">{{ __('company.common.495') }}</span></td>
                    <td class="">
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
                            <a href="#" class="dropdown-item action-menu-item" data-action="extend"
                              ><i class="bi bi-clock"></i> {{ __('company.common.339') }}</a
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
                    </td>
                  </tr>
                  <tr class="tr--day-after">
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="Wbf2ed"
                        >Wbf2ed <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.common.527') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966537768136+</span>
                      </div>
                    </td>
                    <td>{{ __('company.common.489') }}</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td class="ltr-num">2026-03-28<br />19:45:00</td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.411') }}</span>
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
                    <td><span class="badge bg-success">{{ __('company.common.446') }}</span></td>
                    <td><span class="badge bg-danger">{{ __('company.common.495') }}</span></td>
                    <td class="">
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
                            <a href="#" class="dropdown-item action-menu-item" data-action="extend"
                              ><i class="bi bi-clock"></i> {{ __('company.common.339') }}</a
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
                    </td>
                  </tr>
                  <tr class="tr--day-after">
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="M06a62"
                        >M06a62 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.common.438') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966580005665+</span>
                      </div>
                    </td>
                    <td>{{ __('company.common.577') }}</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td class="ltr-num">2026-03-29<br />16:30:00</td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.477') }}</span>
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
                    <td><span class="badge bg-success">{{ __('company.common.446') }}</span></td>
                    <td><span class="badge bg-danger">{{ __('company.common.495') }}</span></td>
                    <td class="">
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
                            <a href="#" class="dropdown-item action-menu-item" data-action="extend"
                              ><i class="bi bi-clock"></i> {{ __('company.common.339') }}</a
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
                <button class="table-pagination__page-btn" disabled>
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
@endsection

@push('modals')
</main>
        
      

    
    <div
      class="modal fade"
      id="extensionModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="extensionModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon">
                <i class="bi bi-calendar-plus"></i>
              </div>
              <div>
                <h2 class="bkmodal-header__ref" id="extensionModalLabel">{{ __('company.common.340') }}</h2>
                <div class="bkmodal-header__meta">
                  <span
                    ><i class="bi bi-file-earmark-text"></i>
                    <span id="extendBookingRef">-</span></span
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
            <div class="bkmodal-section-label">{{ __('company.common.312') }}</div>
            <div class="booking-details-grid">
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon">
                  <i class="bi bi-person"></i>
                </div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.215') }}</span>
                  <span class="booking-detail-item__value" id="extendCustomer">-</span>
                </div>
              </div>
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon">
                  <i class="bi bi-calendar3"></i>
                </div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.284') }}</span>
                  <span class="booking-detail-item__value ltr-num" id="extendPickupDate">-</span>
                </div>
              </div>
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon">
                  <i class="bi bi-calendar-check"></i>
                </div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.288') }}</span>
                  <span class="booking-detail-item__value ltr-num" id="extendReturnDate">-</span>
                </div>
              </div>
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon">
                  <i class="bi bi-calendar-range"></i>
                </div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.219') }}</span>
                  <span class="booking-detail-item__value" id="extendPeriod">-</span>
                </div>
              </div>
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon">
                  <i class="bi bi-car-front"></i>
                </div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.203') }}</span>
                  <span class="booking-detail-item__value" id="extendCar">-</span>
                </div>
              </div>
            </div>

            <div class="bkmodal-section-label">{{ __('company.common.569') }}</div>
            <div class="mb-3">
              <select class="form-select" id="extensionType" aria-describedby="extensionTypeHint">
                <option value="link" selected>{{ __('company.common.341') }}</option>
                <option value="cash">{{ __('company.common.342') }}</option>
              </select>
              <div
                class="form-text text-muted d-flex align-items-center gap-1 mt-2"
                id="extensionTypeHint"
              >
                <i class="bi bi-info-circle"></i>
                <span id="extensionTypeHintText"></span>
              </div>
            </div>

            <div id="extensionDaysField" style="display: none">
              <div class="bkmodal-section-label">{{ __('company.common.439') }}</div>
              <div class="mb-3">
                <input
                  type="number"
                  class="form-control"
                  id="extensionDaysInput"
                  min="1"
                  max="90"
                  step="1"
                  inputmode="numeric"
                   placeholder="{{ __('company.common.61') }}"
                  aria-describedby="extensionErrorMessage"
                />
              </div>
            </div>

            <div class="bkmodal-section-label">{{ __('company.common.290') }}</div>
            <div class="mb-3">
              <input
                type="date"
                class="form-control"
                id="newReturnDate"
                aria-describedby="extensionErrorMessage extensionDailyRate"
              />
              <div
                id="extensionErrorMessage"
                class="text-danger mt-2"
                role="alert"
                style="display: none"
              ></div>
            </div>

            <div class="bkmodal-section-label">{{ __('company.common.553') }}</div>
            <div class="booking-details-grid" aria-live="polite">
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon"><i class="bi bi-calendar2-plus"></i></div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.439') }}</span>
                  <span class="booking-detail-item__value" id="extensionSummaryDays">-</span>
                </div>
              </div>
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon"><i class="bi bi-calendar-check"></i></div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.290') }}</span>
                  <span class="booking-detail-item__value ltr-num" id="extensionSummaryDate"
                    >-</span
                  >
                </div>
              </div>
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon"><i class="bi bi-cash-stack"></i></div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.226') }}</span>
                  <span class="booking-detail-item__value ltr-num" id="extensionSummaryAmount"
                    >-</span
                  >
                </div>
              </div>
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon"><i class="bi bi-bookmark-star"></i></div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.569') }}</span>
                  <span class="booking-detail-item__value" id="extensionSummaryType">-</span>
                </div>
              </div>
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon"><i class="bi bi-wallet2"></i></div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.437') }}</span>
                  <span class="booking-detail-item__value" id="extensionSummaryPayment">-</span>
                </div>
              </div>
            </div>
            <div class="form-text text-muted d-flex align-items-center gap-1 mt-2">
              <i class="bi bi-info-circle"></i>
              {{ __('company.common.199') }}<span class="ltr-num" id="extensionDailyRate">{{ __('company.common.16') }}</span>
            </div>
          </div>

          <div class="modal-footer booking-modal__footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
            <button type="button" class="btn btn-primary" id="confirmExtendBtn">
              <i class="bi bi-check2-circle"></i>
              {{ __('company.common.275') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="extensionConfirmModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="extensionConfirmModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="extensionConfirmModalLabel">{{ __('company.common.330') }}</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body">
            <div class="text-center py-4">
              <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem"></i>
              <p class="mt-3 mb-0" id="extensionConfirmMessage"></p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary m-auto" data-bs-dismiss="modal">
              {{ __('company.common.374') }}</button>
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
                      <span class="booking-detail-item__label"> {{ __('company.common.365') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingAccepted"
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
                data-reservation-modal-action="booking-history-transactions"
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
              <table class="car-logs-table" id="reservationHistoryTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.245') }}</th>
                    <th>{{ __('company.common.225') }}</th>
                    <th>{{ __('company.common.296') }}</th>
                    <th>{{ __('company.common.77') }}</th>
                  </tr>
                </thead>
                <tbody id="reservationHistoryTableBody">
                  
                  <tr class="history-row" data-type="booking">
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-type">{{ __('company.common.368') }}</td>
                    <td class="log-amount">-</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:00:00</td>
                    <td class="log-actions">
                      <button class="btn-expand" data-expand-target="details-1">
                        <i class="bi bi-chevron-down"></i>
                      </button>
                    </td>
                  </tr>
                  <tr class="history-details-row" id="details-1" style="display: none">
                    <td colspan="5">
                      <div class="history-details">
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.390') }}</span>
                          <span class="history-detail-value" data-history-message
                            >{{ __('company.common.324') }}</span
                          >
                        </div>
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.524') }}</span>
                          <span class="history-detail-value" data-history-user>{{ __('company.common.563') }}</span>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr class="history-row" data-type="booking">
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-type">{{ __('company.common.368') }}</td>
                    <td class="log-amount">-</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:03:16</td>
                    <td class="log-actions">
                      <button class="btn-expand" data-expand-target="details-2">
                        <i class="bi bi-chevron-down"></i>
                      </button>
                    </td>
                  </tr>
                  <tr class="history-details-row" id="details-2" style="display: none">
                    <td colspan="5">
                      <div class="history-details">
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.390') }}</span>
                          <span class="history-detail-value" data-history-message
                            >{{ __('company.common.336') }}</span
                          >
                        </div>
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.524') }}</span>
                          <span class="history-detail-value" data-history-user>{{ __('company.common.563') }}</span>
                        </div>
                      </div>
                    </td>
                  </tr>
                  
                  <tr class="transaction-row" data-type="transaction" style="display: none">
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-type">{{ __('company.common.385') }}</td>
                    <td class="log-amount ltr-num">{{ __('company.common.14') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:05:42</td>
                    <td class="log-actions">
                      <button class="btn-expand" data-expand-target="trans-details-1">
                        <i class="bi bi-chevron-down"></i>
                      </button>
                    </td>
                  </tr>
                  <tr class="transaction-details-row" id="trans-details-1" style="display: none">
                    <td colspan="5">
                      <div class="history-details">
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.486') }}</span>
                          <span class="history-detail-value">200</span>
                        </div>
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.390') }}</span>
                          <span class="history-detail-value">Authorized</span>
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
                    <td class="log-actions">
                      <button class="btn-expand" data-expand-target="trans-details-2">
                        <i class="bi bi-chevron-down"></i>
                      </button>
                    </td>
                  </tr>
                  <tr class="transaction-details-row" id="trans-details-2" style="display: none">
                    <td colspan="5">
                      <div class="history-details">
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.486') }}</span>
                          <span class="history-detail-value">200</span>
                        </div>
                        <div class="history-detail-item">
                          <span class="history-detail-label">{{ __('company.common.390') }}</span>
                          <span class="history-detail-value">Authorized</span>
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
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ __('company.common.558') }}</button>
          </div>
        </div>
      </div>
    </div>

    
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
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

        /* ============================================================
         Tabs Logic
      ============================================================= */
        // Handle tab clicks
        document.querySelectorAll('[data-reservation-booking-tab]').forEach(function (tab) {
          tab.addEventListener('click', function () {
            var tabName = this.getAttribute('data-reservation-booking-tab');

            // Remove is-active from all tabs
            document.querySelectorAll('[data-reservation-booking-tab]').forEach(function (t) {
              t.classList.remove('is-active');
              t.setAttribute('aria-selected', 'false');
            });

            // Add is-active to clicked tab
            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');

            // Hide all panels
            document.querySelectorAll('[data-reservation-booking-panel]').forEach(function (panel) {
              panel.classList.remove('is-active');
            });

            // Show corresponding panel
            var targetPanel = document.querySelector(
              '[data-reservation-booking-panel="' + tabName + '"]',
            );
            if (targetPanel) {
              targetPanel.classList.add('is-active');
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

            // Show/hide rows based on action
            if (isTransactions) {
              // Show transaction rows, hide booking rows
              reservationHistoryModalEl.querySelectorAll('.history-row').forEach(function (row) {
                row.style.display = 'none';
              });
              reservationHistoryModalEl
                .querySelectorAll('.history-details-row')
                .forEach(function (row) {
                  row.style.display = 'none';
                });
              reservationHistoryModalEl
                .querySelectorAll('.transaction-row')
                .forEach(function (row) {
                  row.style.display = '';
                });
              reservationHistoryModalEl
                .querySelectorAll('.transaction-details-row')
                .forEach(function (row) {
                  row.style.display = 'none';
                });
            } else {
              // Show booking rows, hide transaction rows
              reservationHistoryModalEl.querySelectorAll('.history-row').forEach(function (row) {
                row.style.display = '';
              });
              reservationHistoryModalEl
                .querySelectorAll('.history-details-row')
                .forEach(function (row) {
                  row.style.display = 'none';
                });
              reservationHistoryModalEl
                .querySelectorAll('.transaction-row')
                .forEach(function (row) {
                  row.style.display = 'none';
                });
              reservationHistoryModalEl
                .querySelectorAll('.transaction-details-row')
                .forEach(function (row) {
                  row.style.display = 'none';
                });
            }

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
         Extension Modal
      ============================================================= */
        var extensionModalEl = document.getElementById('extensionModal');
        var extensionModal = new bootstrap.Modal(extensionModalEl);
        var extensionConfirmModalEl = document.getElementById('extensionConfirmModal');
        var extensionConfirmModal = new bootstrap.Modal(extensionConfirmModalEl);
        var confirmExtendBtn = document.getElementById('confirmExtendBtn');

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
                  document.getElementById('extendBookingRef').textContent = bookingRefValue;
                  document.getElementById('extendCustomer').textContent =
                    row.querySelector('.cell-customer-stack__name')?.textContent || '-';
                  window.ExtensionCalculator.prepareFromRow(row, 1);

                  // Open extension modal
                  extensionModal.show();
                }
                break;
              case 'booking-history':
                if (bookingRefValue) {
                  currentBookingRef = bookingRefValue;
                  document.getElementById('reservationBookingRef').textContent = bookingRefValue;
                  document.getElementById('reservationHistoryModalLabel').textContent =
                    'تاريخ الحجز';

                  reservationHistoryModalEl
                    .querySelectorAll('[data-history-ref]')
                    .forEach(function (cell) {
                      cell.textContent = bookingRefValue;
                    });

                  // Show booking rows, hide transaction rows
                  reservationHistoryModalEl
                    .querySelectorAll('.history-row')
                    .forEach(function (row) {
                      row.style.display = '';
                    });
                  reservationHistoryModalEl
                    .querySelectorAll('.history-details-row')
                    .forEach(function (row) {
                      row.style.display = 'none';
                    });
                  reservationHistoryModalEl
                    .querySelectorAll('.transaction-row')
                    .forEach(function (row) {
                      row.style.display = 'none';
                    });
                  reservationHistoryModalEl
                    .querySelectorAll('.transaction-details-row')
                    .forEach(function (row) {
                      row.style.display = 'none';
                    });

                  reservationHistoryModal.show();
                }
                break;
              case 'transactions':
                if (bookingRefValue) {
                  currentBookingRef = bookingRefValue;
                  document.getElementById('reservationBookingRef').textContent = bookingRefValue;
                  document.getElementById('reservationHistoryModalLabel').textContent =
                    'تاريخ العمليات';

                  reservationHistoryModalEl
                    .querySelectorAll('[data-history-ref]')
                    .forEach(function (cell) {
                      cell.textContent = bookingRefValue;
                    });

                  // Show transaction rows, hide booking rows
                  reservationHistoryModalEl
                    .querySelectorAll('.history-row')
                    .forEach(function (row) {
                      row.style.display = 'none';
                    });
                  reservationHistoryModalEl
                    .querySelectorAll('.history-details-row')
                    .forEach(function (row) {
                      row.style.display = 'none';
                    });
                  reservationHistoryModalEl
                    .querySelectorAll('.transaction-row')
                    .forEach(function (row) {
                      row.style.display = '';
                    });
                  reservationHistoryModalEl
                    .querySelectorAll('.transaction-details-row')
                    .forEach(function (row) {
                      row.style.display = 'none';
                    });

                  reservationHistoryModal.show();
                }
                break;
              case 'add-rating':
                if (bookingRefValue) {
                  window.location.href = '{{ route('company.booking-details-two') }}?booking=' + bookingRefValue;
                }
                break;
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
      });
    </script>
@endpush

