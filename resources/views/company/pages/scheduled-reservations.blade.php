@extends('company.layouts.master')

@section('title', 'T-Car — Scheduled Reservations')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.scheduled-reservations.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.167') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current"> {{ __('company.pages.scheduled-reservations.0') }}</span>
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
                  data-field-key="createdAt"
                  data-default-label="تاريخ الإنشاء"
                >
                  <span class="js-date-trigger-label">{{ __('company.common.283') }}</span>
                  <i class="bi bi-chevron-down"></i>
                </button>
                <button
                  type="button"
                  class="filter-btn js-date-trigger"
                  data-field-key="pickupDate"
                  data-default-label="تاريخ الاستلام"
                >
                  <span class="js-date-trigger-label">{{ __('company.common.284') }}</span>
                  <i class="bi bi-chevron-down"></i>
                </button>
                <button
                  type="button"
                  class="filter-btn js-date-trigger"
                  data-field-key="returnDate"
                  data-default-label="تاريخ التسليم"
                >
                  <span class="js-date-trigger-label">{{ __('company.common.287') }}</span>
                  <i class="bi bi-chevron-down"></i>
                </button>
                <div class="dropdown scheduled-toolbar-filter" data-filter-key="city">
                  <button
                    type="button"
                    class="filter-btn"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <span class="scheduled-toolbar-filter__label" data-default-label="المدينة"
                      >{{ __('company.common.229') }}</span
                    >
                    <i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>
                    <li><a class="dropdown-item" href="#" data-filter-value="">{{ __('company.common.223') }}</a></li>
                    <li><a class="dropdown-item" href="#" data-filter-value="الرياض">{{ __('company.common.183') }}</a></li>
                    <li><a class="dropdown-item" href="#" data-filter-value="جدة">{{ __('company.common.357') }}</a></li>
                    <li><a class="dropdown-item" href="#" data-filter-value="الدمام">{{ __('company.common.174') }}</a></li>
                    <li><a class="dropdown-item" href="#" data-filter-value="مكة">{{ __('company.common.546') }}</a></li>
                  </ul>
                </div>
                <div class="dropdown scheduled-toolbar-filter" data-filter-key="office">
                  <button
                    type="button"
                    class="filter-btn"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <span class="scheduled-toolbar-filter__label" data-default-label="المكتب"
                      >{{ __('company.common.235') }}</span
                    >
                    <i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>
                    <li><a class="dropdown-item" href="#" data-filter-value="">{{ __('company.common.223') }}</a></li>
                    <li>
                      <a class="dropdown-item" href="#" data-filter-value="الرياض - المروة"
                        >{{ __('company.pages.scheduled-reservations.1') }}</a
                      >
                    </li>
                    <li>
                      <a class="dropdown-item" href="#" data-filter-value="جدة - الحمراء"
                        >{{ __('company.common.358') }}</a
                      >
                    </li>
                    <li>
                      <a class="dropdown-item" href="#" data-filter-value="الدمام - الشاطئ"
                        >{{ __('company.common.175') }}</a
                      >
                    </li>
                  </ul>
                </div>
                <button class="filter-btn" type="button" id="scheduledFiltersClearBtn" disabled>
                  <i class="bi bi-x-lg"></i>
                  {{ __('company.common.525') }}</button>
              </div>
              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="scheduledSearchInput"  placeholder="{{ __('company.common.253') }}" />
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="data-table" id="scheduledTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.449') }}</th>
                    <th>{{ __('company.common.430') }}</th>
                    <th>{{ __('company.common.138') }}</th>
                    <th>{{ __('company.common.284') }}</th>
                    <th>{{ __('company.common.367') }}</th>
                    <th>{{ __('company.common.287') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="tr--day-after"
                    data-created-at="2026-03-15"
                    data-pickup-date="2026-03-20"
                    data-return-date="2026-03-21"
                    data-city="الرياض"
                    data-office="الرياض - المروة"
                    data-service="استلام من الفرع"
                    data-kiosk="yes"
                    data-rated="yes"
                    data-assigned="yes"
                  >
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

                    <td><span class="badge bg-success">{{ __('company.common.446') }}</span></td>
                    <td class="cell-close-date ltr-num">-</td>
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
                            <a href="#" class="dropdown-item action-menu-item" data-action="close"
                              ><i class="bi bi-x-circle"></i> {{ __('company.common.92') }}</a
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
                  <tr
                    class="tr--day-after"
                    data-created-at="2026-03-18"
                    data-pickup-date="2026-03-24"
                    data-return-date="2026-03-25"
                    data-city="الرياض"
                    data-office="الرياض - المروة"
                    data-service="استلام من الفرع"
                    data-kiosk="no"
                    data-rated="yes"
                    data-assigned="yes"
                  >
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

                    <td><span class="badge bg-success">{{ __('company.common.446') }}</span></td>
                    <td class="cell-close-date ltr-num">-</td>
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
                            <a href="#" class="dropdown-item action-menu-item" data-action="close"
                              ><i class="bi bi-x-circle"></i> {{ __('company.common.92') }}</a
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
                  <tr
                    class="tr--day-after"
                    data-created-at="2026-03-20"
                    data-pickup-date="2026-03-24"
                    data-return-date="2026-03-25"
                    data-city="الرياض"
                    data-office="الرياض - المروة"
                    data-service="استلام من الفرع"
                    data-kiosk="yes"
                    data-rated="no"
                    data-assigned="yes"
                  >
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

                    <td><span class="badge bg-success">{{ __('company.common.446') }}</span></td>
                    <td class="cell-close-date ltr-num">-</td>
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
                            <a href="#" class="dropdown-item action-menu-item" data-action="close"
                              ><i class="bi bi-x-circle"></i> {{ __('company.common.92') }}</a
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
                  <tr
                    class="tr--day-after"
                    data-created-at="2026-03-22"
                    data-pickup-date="2026-03-28"
                    data-return-date="2026-03-29"
                    data-city="الرياض"
                    data-office="الرياض - المروة"
                    data-service="استلام من الفرع"
                    data-kiosk="no"
                    data-rated="no"
                    data-assigned="yes"
                  >
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

                    <td><span class="badge bg-success">{{ __('company.common.446') }}</span></td>
                    <td class="cell-close-date ltr-num">-</td>
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
                            <a href="#" class="dropdown-item action-menu-item" data-action="close"
                              ><i class="bi bi-x-circle"></i> {{ __('company.common.92') }}</a
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
                  <tr
                    class="tr--day-after"
                    data-created-at="2026-03-23"
                    data-pickup-date="2026-03-29"
                    data-return-date="2026-03-30"
                    data-city="الرياض"
                    data-office="الرياض - المروة"
                    data-service="استلام من الفرع"
                    data-kiosk="yes"
                    data-rated="yes"
                    data-assigned="yes"
                  >
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

                    <td><span class="badge bg-success">{{ __('company.common.446') }}</span></td>
                    <td class="cell-close-date ltr-num">-</td>
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
                            <a href="#" class="dropdown-item action-menu-item" data-action="close"
                              ><i class="bi bi-x-circle"></i> {{ __('company.common.92') }}</a
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
      id="closeReservationModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="closeReservationModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon">
                <i class="bi bi-lock"></i>
              </div>
              <div>
                <h2 class="bkmodal-header__ref" id="closeReservationModalLabel">{{ __('company.common.94') }}</h2>
                <div class="bkmodal-header__meta">
                  <span>
                    <i class="bi bi-file-earmark-text"></i>
                    <span id="closeBookingRefHeader">-</span>
                  </span>
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
              <label class="form-label" for="closeReservationDate">
                {{ __('company.common.282') }}<span class="text-danger">*</span>
              </label>
              <input
                type="date"
                class="form-control"
                id="closeReservationDate"
                required
                aria-describedby="closeReservationErrorMessage"
              />
              <div class="mt-3">
                <label class="form-label" for="closeRefundAmount">{{ __('company.common.82') }}</label>
                <input
                  type="number"
                  class="form-control ltr-num"
                  id="closeRefundAmount"
                  name="refundAmount"
                  min="0"
                  step="0.01"
                  inputmode="decimal"
                  placeholder="0.00"
                />
              </div>
              <div
                id="closeReservationErrorMessage"
                class="text-danger mt-2"
                role="alert"
                style="display: none"
              ></div>
              <div class="form-text text-muted d-flex align-items-center gap-1 mt-2">
                <i class="bi bi-info-circle"></i>
                {{ __('company.common.590') }}</div>
            </div>
          </div>

          <div class="modal-footer booking-modal__footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
            <button type="button" class="btn btn-danger" id="confirmCloseReservationBtn">
              <i class="bi bi-lock"></i>
              {{ __('company.common.276') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="closeReservationSuccessModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="closeReservationSuccessModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center py-5">
            <div class="mb-4">
              <i class="bi bi-check-circle-fill text-success" style="font-size: 64px"></i>
            </div>
            <h4
              class="mb-3"
              id="closeReservationSuccessModalLabel"
              style="font-family: 'Alexandria', sans-serif; font-weight: 600"
            >
              {{ __('company.common.322') }}</h4>
            <p
              class="text-muted mb-4"
              style="font-family: 'Alexandria', sans-serif"
              id="closeReservationSuccessMessage"
            ></p>
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

    
    

    
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        const companyInfoTriggers = document.querySelectorAll('.company-info-trigger');
        const companyInfoTooltip = document.getElementById('companyInfoTooltip');

        const tooltipLocation = document.getElementById('tooltipLocation');
        const tooltipRating = document.getElementById('tooltipRating');
        const tooltipManager = document.getElementById('tooltipManager');

        let activeTrigger = null;

        function showTooltip(trigger, location, rating, manager) {
          tooltipLocation.textContent = location;
          tooltipRating.textContent = rating;
          tooltipManager.textContent = manager;

          // Temporarily make tooltip visible to get correct dimensions
          companyInfoTooltip.classList.add('is-visible');
          companyInfoTooltip.style.opacity = '0';

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

          // Make tooltip fully visible after positioning
          companyInfoTooltip.style.opacity = '';
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
            const rating = this.getAttribute('data-rating');
            const manager = this.getAttribute('data-manager');

            showTooltip(this, location, rating, manager);
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
        const scheduledBookingModalEl = document.getElementById('scheduledBookingModal');
        if (!scheduledBookingModalEl || typeof bootstrap === 'undefined') return;

        const scheduledBookingModal = new bootstrap.Modal(scheduledBookingModalEl);

        function textFrom(row, selector) {
          const el = row.querySelector(selector);
          return el ? el.textContent.trim() : '';
        }

        function getScheduledBookingData(row) {
          const pickupText = row.children[6]?.textContent.trim() || '';
          const pickupParts = pickupText.split(/\s+/);
          const statusText = textFrom(row, 'td:nth-child(10) .badge');

          return {
            ref: textFrom(row, '.js-scheduled-booking-details').replace(/\s+/g, ''),
            status:
              row.querySelector('.js-scheduled-booking-details')?.dataset.bookingStatus ||
              statusText ||
              'مقبول',
            service: textFrom(row, 'td:nth-child(2)') || 'استلام من الفرع',
            customer: textFrom(row, '.cell-customer-stack__name'),
            pickupDate: pickupParts[0] || '',
            pickupTime: pickupParts[1] || '',
            period: '1',
            car: row.children[3]?.textContent.trim() || '',
            price: '203.26 / يومي',
            company: textFrom(row, '.cell-company').replace('Main Company', '').trim() || 'N2',
            office: (row.children[4]?.textContent.trim() || '') + ' - N2',
            payment: 'بطاقة',
            accepted: statusText === 'مقبول' || statusText === 'عقد مفتوح' ? '1' : '0',
            cancelled: '0',
            compensation: '0',
            rating: '5',
            ratedBy: textFrom(row, '.cell-customer-stack__name'),
            ratingDate: pickupParts[0] || '',
            companyNotes: 'لا يوجد تعليقات',
            bankName: '-',
            iban: '-',
            cardHolder: '-',
          };
        }

        function fillScheduledBookingModal(data) {
          document.getElementById('scheduledBookingRef').textContent = data.ref;
          document.getElementById('scheduledBookingStatus').textContent = data.status;
          document.getElementById('scheduledBookingCustomerMeta').textContent = data.customer;
          document.getElementById('scheduledBookingOfficeMeta').textContent = data.office;
          document.getElementById('scheduledBookingService').textContent = data.service;
          document.getElementById('scheduledBookingPickupDate').textContent = data.pickupDate;
          document.getElementById('scheduledBookingPickupTime').textContent = data.pickupTime;
          document.getElementById('scheduledBookingPeriod').textContent = data.period;
          document.getElementById('scheduledBookingCar').textContent = data.car;
          document.getElementById('scheduledBookingPrice').textContent = data.price;
          document.getElementById('scheduledBookingCompany').textContent = data.company;
          document.getElementById('scheduledBookingOffice').textContent = data.office;
          document.getElementById('scheduledBookingPayment').textContent = data.payment;
          document.getElementById('scheduledBookingAccepted').textContent = data.accepted;
          // document.getElementById("scheduledBookingCancelled").textContent =
          //   data.cancelled;
          document.getElementById('scheduledBookingCompensation').textContent = data.compensation;
          document.getElementById('scheduledBookingRating').textContent = data.rating;
          document.getElementById('scheduledBookingRatedBy').textContent = data.ratedBy;
          document.getElementById('scheduledBookingRatingDate').textContent = data.ratingDate;
          document.getElementById('scheduledBookingBankName').textContent = data.bankName;
          document.getElementById('scheduledBookingIban').textContent = data.iban;
          document.getElementById('scheduledBookingCardHolder').textContent = data.cardHolder;
        }

        function showScheduledBookingTab(tabName) {
          document.querySelectorAll('[data-scheduled-booking-tab]').forEach(function (tab) {
            const isActive = tab.dataset.scheduledBookingTab === tabName;
            tab.classList.toggle('is-active', isActive);
            tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
          });

          document.querySelectorAll('[data-scheduled-booking-panel]').forEach(function (panel) {
            panel.classList.toggle('is-active', panel.dataset.scheduledBookingPanel === tabName);
          });
        }

        const scheduledHistoryModalEl = document.getElementById('scheduledHistoryModal');
        const scheduledHistoryModal = new bootstrap.Modal(scheduledHistoryModalEl);
        const scheduledHistoryWrap = document.getElementById('scheduledHistoryTableWrap');
        const scheduledHistoryThumb = document.getElementById('scheduledHistoryScrollThumb');

        function updateScheduledHistoryThumb() {
          if (!scheduledHistoryWrap || !scheduledHistoryThumb) return;

          const trackHeight = scheduledHistoryWrap.clientHeight;
          const ratio = scheduledHistoryWrap.clientHeight / scheduledHistoryWrap.scrollHeight;
          const thumbHeight = Math.max(ratio * trackHeight, 24);
          const maxScroll = scheduledHistoryWrap.scrollHeight - scheduledHistoryWrap.clientHeight;
          const scrollRatio = maxScroll > 0 ? scheduledHistoryWrap.scrollTop / maxScroll : 0;

          scheduledHistoryThumb.style.height = thumbHeight + 'px';
          scheduledHistoryThumb.style.top = scrollRatio * (trackHeight - thumbHeight) + 'px';
        }

        function fillScheduledHistoryModal(row, action) {
          const data = getScheduledBookingData(row);
          const isTransactions = action === 'transactions';
          const messages = [
            'تم إنشاء الحجز.',
            'تم جدولة موعد الاستلام.',
            'تم تحديث حالة الحجز.',
            'تم تجهيز الحجز للمتابعة.',
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
            '10:00:00',
            '10:03:16',
            '10:05:42',
            '10:09:10',
            '09:12:14',
            '09:14:38',
            '09:16:02',
            '09:18:20',
          ];

          document.getElementById('scheduledHistoryModalLabel').textContent =
            'تاريخ العمليات والحجز';

          scheduledHistoryModalEl.querySelectorAll('[data-history-ref]').forEach(function (cell) {
            cell.textContent = data.ref;
          });
          scheduledHistoryModalEl
            .querySelectorAll('[data-history-message]')
            .forEach(function (cell, index) {
              cell.textContent = messages[index];
            });
          scheduledHistoryModalEl
            .querySelectorAll('[data-history-user]')
            .forEach(function (cell, index) {
              cell.textContent = users[index];
            });
          scheduledHistoryModalEl
            .querySelectorAll('[data-history-date]')
            .forEach(function (cell, index) {
              cell.textContent = data.pickupDate + ' ' + times[index];
            });
        }

        function closeScheduledActionMenus() {
          document.querySelectorAll('.action-menu-dropdown').forEach(function (dropdown) {
            dropdown.classList.remove('is-visible');
          });
        }

        let activeScheduledActionRow = null;

        document
          .querySelectorAll('.scheduled-action-menu .action-menu-btn')
          .forEach(function (btn) {
            btn.addEventListener('click', function (event) {
              event.stopPropagation();
              const wrapper = btn.closest('.scheduled-action-menu');
              activeScheduledActionRow = wrapper.closest('tr');
            });
          });

        document.querySelectorAll('.js-scheduled-booking-details').forEach(function (link) {
          link.addEventListener('click', function (event) {
            event.preventDefault();
            activeScheduledActionRow = this.closest('tr');
            fillScheduledBookingModal(getScheduledBookingData(activeScheduledActionRow));
            showScheduledBookingTab('summary');
            scheduledBookingModal.show();
          });
        });

        document.querySelectorAll('[data-scheduled-booking-tab]').forEach(function (tab) {
          tab.addEventListener('click', function () {
            showScheduledBookingTab(this.dataset.scheduledBookingTab);
          });
        });

        scheduledHistoryWrap.addEventListener('scroll', updateScheduledHistoryThumb);
        scheduledHistoryModalEl.addEventListener('shown.bs.modal', updateScheduledHistoryThumb);
        window.addEventListener('resize', updateScheduledHistoryThumb);

        document
          .getElementById('scheduledHistoryScrollUpBtn')
          .addEventListener('click', function () {
            scheduledHistoryWrap.scrollBy({ top: -100, behavior: 'smooth' });
          });
        document
          .getElementById('scheduledHistoryScrollDownBtn')
          .addEventListener('click', function () {
            scheduledHistoryWrap.scrollBy({ top: 100, behavior: 'smooth' });
          });

        document.addEventListener('click', closeScheduledActionMenus);
        window.addEventListener('resize', closeScheduledActionMenus);

        document.querySelectorAll('[data-scheduled-action]').forEach(function (item) {
          item.addEventListener('click', function (event) {
            event.stopPropagation();

            const row = activeScheduledActionRow || this.closest('tr');
            const action = this.dataset.scheduledAction;

            closeScheduledActionMenus();

            if (action === 'cancel') {
              const statusBadge = row.querySelector('td:nth-child(10) .badge');
              statusBadge.className = 'badge bg-danger';
              statusBadge.textContent = 'مرفوض';
              row.querySelector('.js-scheduled-booking-details').dataset.bookingStatus = 'مرفوض';
              return;
            }

            if (action === 'invoice') {
              const ref = textFrom(row, '.js-scheduled-booking-details').replace(/\s+/g, '');
              const invoiceBlob = new Blob(['Invoice for ' + ref], {
                type: 'text/plain;charset=utf-8',
              });
              const url = URL.createObjectURL(invoiceBlob);
              const downloadLink = document.getElementById('scheduledInvoiceDownload');
              downloadLink.href = url;
              downloadLink.download = ref + '-invoice.txt';
              downloadLink.click();
              URL.revokeObjectURL(url);
              return;
            }

            if (action === 'combined-history') {
              fillScheduledHistoryModal(row, action);
              scheduledHistoryModal.show();
              return;
            }

            fillScheduledBookingModal(getScheduledBookingData(row));
            showScheduledBookingTab(action === 'review' ? 'rating' : 'summary');
            scheduledBookingModal.show();
          });
        });

        document.querySelectorAll('[data-scheduled-modal-action]').forEach(function (btn) {
          btn.addEventListener('click', function () {
            if (activeScheduledActionRow) {
              fillScheduledHistoryModal(
                activeScheduledActionRow,
                this.dataset.scheduledModalAction,
              );
              scheduledBookingModalEl.addEventListener(
                'hidden.bs.modal',
                function () {
                  scheduledHistoryModal.show();
                },
                { once: true },
              );
            }

            scheduledBookingModal.hide();
          });
        });
      });
    </script>
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
        var closeReservationModalEl = document.getElementById('closeReservationModal');
        var closeReservationModal = new bootstrap.Modal(closeReservationModalEl);
        var closeReservationSuccessModalEl = document.getElementById(
          'closeReservationSuccessModal',
        );
        var closeReservationSuccessModal = new bootstrap.Modal(closeReservationSuccessModalEl);
        var currentCloseRow = null;
        var currentCloseBookingRef = null;

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
              case 'close':
                currentCloseRow = row;
                currentCloseBookingRef = bookingRefValue || 'غير محدد';
                window.CloseReservationForm.prepareFromRow(row, currentCloseBookingRef);
                closeReservationModal.show();
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

        // Handle close reservation confirmation
        document
          .getElementById('confirmCloseReservationBtn')
          .addEventListener('click', function () {
            var closeDate = window.CloseReservationForm.validate();
            if (closeDate && currentCloseRow && currentCloseBookingRef) {
              var closeState = window.CloseReservationForm.getState();
              var successContent = window.CloseReservationForm.getSuccessContent(
                currentCloseBookingRef,
                'الحجز',
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
            }
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

