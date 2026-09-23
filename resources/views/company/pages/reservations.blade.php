@extends('company.layouts.master')

@section('title', 'T-Car — Reservation List')

@section('content')

          <div class="notice-banner" id="reservationsNotice">
            <div class="notice-banner__body">
              <i class="bi bi-exclamation-triangle-fill notice-banner__icon"></i>
              <div class="notice-banner__text">
                <strong>{{ __('company.pages.reservations.0') }}</strong>
                {{ __('company.pages.reservations.1') }}</div>
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

          
          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.471') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.167') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.common.471') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
              <a href="{{ route('company.create-booking') }}" class="btn btn-primary"
                ><i class="bi bi-plus-lg"></i> {{ __('company.common.97') }}</a
              >
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
                <div class="view-tabs" role="tablist"  aria-label="{{ __('company.pages.reservations.56') }}">
                  <button
                    type="button"
                    class="view-tabs__btn is-active"
                    role="tab"
                    aria-selected="true"
                    data-reservation-view="all"
                  >
                    {{ __('company.pages.reservations.2') }}</button>
                  <button
                    type="button"
                    class="view-tabs__btn"
                    role="tab"
                    aria-selected="false"
                    data-reservation-view="extended"
                  >
                    {{ __('company.pages.reservations.3') }}</button>
                  <button
                    type="button"
                    class="view-tabs__btn"
                    role="tab"
                    aria-selected="false"
                    data-reservation-view="pending"
                  >
                    {{ __('company.pages.reservations.4') }}</button>
                </div>
                
              </div>
            </div>

            <div class="table-filter-bar" id="generalReservationFilters">
              <div class="table-filter-bar__left">
                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    id="reservationStatusFilterBtn"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <span>{{ __('company.common.165') }}</span> <i class="bi bi-chevron-down"></i>
                  </button>

                  <ul class="dropdown-menu">
                    <li>
                      <button class="dropdown-item" type="button" data-status-filter="">
                        {{ __('company.common.478') }}</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button" data-status-filter="جديد">
                        {{ __('company.common.359') }}</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button" data-status-filter="مقبول">
                        {{ __('company.common.545') }}</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button" data-status-filter="عقد مفتوح">
                        {{ __('company.common.446') }}</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button" data-status-filter="مرفوض">
                        {{ __('company.common.521') }}</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button" data-status-filter="معلق">
                        {{ __('company.common.538') }}</button>
                    </li>
                    <li>
                      <button class="dropdown-item" type="button" data-status-filter="مقفل">
                        {{ __('company.pages.reservations.5') }}</button>
                    </li>
                  </ul>
                </div>
                <button type="button" class="filter-btn js-date-trigger" data-field-key="createdAt">
                  <span class="js-date-trigger-label">{{ __('company.pages.reservations.6') }}</span>
                  <i class="bi bi-chevron-down"></i>
                </button>
                <button
                  type="button"
                  class="filter-btn js-date-trigger"
                  data-field-key="pickupDate"
                >
                  <span class="js-date-trigger-label">{{ __('company.common.284') }}</span>
                  <i class="bi bi-chevron-down"></i>
                </button>

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
                <input type="search" id="reservationSearchInput"  placeholder="{{ __('company.common.253') }}" />
              </div>
            </div>

            <div class="table-filter-bar" id="suspendedReservationFilters" style="display: none">
              <div class="table-filter-bar__left">
                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    id="suspensionReasonFilterBtn"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <span>{{ __('company.pages.reservations.7') }}</span>
                    <i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <button class="dropdown-item" type="button" data-suspension-reason-filter="">
                        {{ __('company.pages.reservations.8') }}</button>
                    </li>
                    <li>
                      <button
                        class="dropdown-item"
                        type="button"
                        data-suspension-reason-filter="financial"
                      >
                        {{ __('company.pages.reservations.9') }}</button>
                    </li>
                    <li>
                      <button
                        class="dropdown-item"
                        type="button"
                        data-suspension-reason-filter="damage"
                      >
                        {{ __('company.pages.reservations.10') }}</button>
                    </li>
                    <li>
                      <button
                        class="dropdown-item"
                        type="button"
                        data-suspension-reason-filter="other"
                      >
                        {{ __('company.pages.reservations.11') }}</button>
                    </li>
                  </ul>
                </div>
                <button
                  type="button"
                  class="filter-btn js-date-trigger"
                  data-field-key="suspensionDate"
                >
                  <span class="js-date-trigger-label">{{ __('company.pages.reservations.12') }}</span>
                  <i class="bi bi-chevron-down"></i>
                </button>
              </div>
              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="suspensionSearchInput"  placeholder="{{ __('company.common.253') }}" />
              </div>
            </div>

            <div class="table-responsive-custom" id="generalReservationsTableWrap">
              <table class="data-table" id="reservationsTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.449') }}</th>
                    <th>{{ __('company.common.138') }}</th>
                    <th>{{ __('company.common.229') }}</th>
                    <th>{{ __('company.common.219') }}</th>
                    <th>{{ __('company.common.326') }}</th>
                    <th>{{ __('company.common.80') }}</th>
                    <th>{{ __('company.common.165') }}</th>
                    <th class="extension-column" style="display: none">{{ __('company.common.439') }}</th>
                    <th class="extension-column" style="display: none">{{ __('company.common.290') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr data-row-key="Y8e087" data-reservation-extended="true">
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="Cc3774"
                        >Cc3774 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">Maryam Yousuf Ahli</span>
                        <span class="cell-customer-stack__phone ltr-num">966508721587+</span>
                      </div>
                    </td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td>{{ __('company.common.183') }}</td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">12:30 ,2026-07-20</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">2026-07-24</span></span
                        >
                      </div>
                    </td>
                    <td class="ltr-num">2026-07-20</td>
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
                    <td><span class="badge bg-success">{{ __('company.common.545') }}</span></td>
                    <td class="extension-column" style="display: none" data-extension-days="3">
                      {{ __('company.pages.reservations.13') }}</td>
                    <td
                      class="extension-column"
                      style="display: none"
                      data-extension-date="2026-07-21"
                    >
                      2026-07-21
                    </td>
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
                          <ul class="dropdown-menu dropdown-menu-end"></ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr data-row-key="Hb4685" data-reservation-extended="false">
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="Cc3774"
                        >Cc3774 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.reservations.14') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966558959877+</span>
                      </div>
                    </td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td>{{ __('company.common.183') }}</td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">09:45 ,2026-07-20</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">2026-07-21</span></span
                        >
                      </div>
                    </td>
                    <td class="ltr-num">2026-07-20</td>
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
                    <td><span class="badge bg-secondary">{{ __('company.common.359') }}</span></td>
                    <td class="extension-column" style="display: none">-</td>
                    <td class="extension-column" style="display: none">-</td>
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
                          <ul class="dropdown-menu dropdown-menu-end"></ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-row-key="Gf1d41"
                    data-reservation-extended="false"
                    data-status="معلق"
                    data-previous-status="مقبول"
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="Cc3774"
                        >Cc3774 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.reservations.15') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966544449939+</span>
                      </div>
                    </td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td>{{ __('company.common.183') }}</td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">00:00 ,2026-07-20</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">2026-07-25</span></span
                        >
                      </div>
                    </td>
                    <td class="ltr-num">2026-07-19</td>
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
                    <td><span class="badge bg-warning text-dark">{{ __('company.common.538') }}</span></td>
                    <td class="extension-column" style="display: none">-</td>
                    <td class="extension-column" style="display: none">-</td>
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
                          <ul class="dropdown-menu dropdown-menu-end"></ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr data-row-key="S7a617" data-reservation-extended="false">
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="Cc3774"
                        >Cc3774 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">JSNSON ONTATHG</span>
                        <span class="cell-customer-stack__phone ltr-num">966540840562+</span>
                      </div>
                    </td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td>{{ __('company.common.183') }}</td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">14:45 ,2026-07-20</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">2026-07-21</span></span
                        >
                      </div>
                    </td>
                    <td class="ltr-num">2026-07-19</td>
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
                    <td><span class="badge bg-danger">{{ __('company.common.521') }}</span></td>
                    <td class="extension-column" style="display: none">-</td>
                    <td class="extension-column" style="display: none">-</td>
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
                          <ul class="dropdown-menu dropdown-menu-end"></ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr data-row-key="Q568ef" data-reservation-extended="true">
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="Cc3774"
                        >Cc3774 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">We'd Alseari</span>
                        <span class="cell-customer-stack__phone ltr-num">966505903965+</span>
                      </div>
                    </td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td>{{ __('company.common.183') }}</td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">20:30 ,2026-07-19</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">2026-07-20</span></span
                        >
                      </div>
                    </td>
                    <td class="ltr-num">2026-07-19</td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.412') }}</span>
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
                    <td><span class="badge bg-primary">{{ __('company.pages.reservations.16') }}</span></td>
                    <td class="extension-column" style="display: none" data-extension-days="5">
                      {{ __('company.common.37') }}</td>
                    <td
                      class="extension-column"
                      style="display: none"
                      data-extension-date="2026-07-20"
                    >
                      2026-07-20
                    </td>
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
                          <ul class="dropdown-menu dropdown-menu-end"></ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div
              class="table-responsive-custom"
              id="suspendedReservationsTableWrap"
              style="display: none"
            >
              <table class="data-table" id="suspendedReservationsTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.215') }}</th>
                    <th>{{ __('company.common.203') }}</th>
                    <th>{{ __('company.pages.reservations.17') }}</th>
                    <th>{{ __('company.common.219') }}</th>
                    <th>{{ __('company.pages.reservations.7') }}</th>
                    <th>{{ __('company.pages.reservations.12') }}</th>
                    <th>{{ __('company.pages.reservations.18') }}</th>
                    <th>{{ __('company.common.225') }}</th>
                    <th>{{ __('company.common.282') }}</th>
                    <th>{{ __('company.common.165') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    data-row-key="PND-001"
                    data-suspension-reason="damage"
                    data-suspension-date="2026-08-18"
                    data-suspension-note="يوجد تلف في الباب الأمامي ويجب فحص السيارة قبل استكمال الحجز."
                    data-suspension-attachment="car-damage.jpg"
                    data-suspension-attachment-type="image"
                    data-suspension-amount="2500.00"
                  >
                    <td>
                      <a href="#" class="cell-booking-ref" data-booking-ref="Cc3774"
                        >Cc3774 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">Maryam Yousuf Ahli</span>
                        <span class="cell-customer-stack__phone ltr-num">966508721587+</span>
                      </div>
                    </td>
                    <td>{{ __('company.common.577') }}</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}">
                        <i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa
                      </a>
                    </td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">2026-07-20</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">2026-07-25</span></span
                        >
                      </div>
                    </td>
                    <td class="cell-suspension-reason">
                      <span class="badge bg-danger">{{ __('company.pages.reservations.10') }}</span>
                    </td>
                    <td class="cell-suspension-date ltr-num">2026-08-18</td>
                    <td class="cell-suspension-attachment">
                      <button
                        type="button"
                        class="btn btn-outline btn-sm action-menu-item"
                        data-action="view-suspension-attachment"
                        data-file-type="image"
                        data-file-src="{{ asset('company/img/car.png') }}"
                        data-file-name="car-damage.jpg"
                      >
                        <i class="bi bi-image"></i>
                        {{ __('company.pages.reservations.19') }}</button>
                    </td>
                    <td class="cell-suspension-amount ltr-num">{{ __('company.pages.reservations.20') }}</td>
                    <td class="cell-close-date ltr-num">—</td>
                    <td><span class="badge bg-warning text-dark">{{ __('company.common.538') }}</span></td>
                    <td>
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
                              data-action="close-suspended"
                            >
                              <i class="bi bi-lock"></i> {{ __('company.common.94') }}</a>
                          </li>
                          <li>
                            <a
                              href="#"
                              class="dropdown-item action-menu-item"
                              data-action="view-suspension-attachment"
                              data-file-type="image"
                              data-file-src="{{ asset('company/img/car.png') }}"
                              data-file-name="car-damage.jpg"
                            >
                              <i class="bi bi-image"></i> {{ __('company.pages.reservations.21') }}</a>
                          </li>
                          <li>
                            <a
                              href="#"
                              class="dropdown-item action-menu-item"
                              data-action="edit-suspension"
                            >
                              <i class="bi bi-pencil"></i> {{ __('company.pages.reservations.22') }}</a>
                          </li>
                          <li>
                            <a
                              href="#"
                              class="dropdown-item action-menu-item"
                              data-action="reservation-history"
                            >
                              <i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>

                  <tr
                    data-row-key="PND-002"
                    data-suspension-reason="financial"
                    data-suspension-date="2026-08-15"
                    data-suspension-note="يوجد مبلغ مستحق يلزم تسويته قبل إعادة تفعيل الحجز."
                    data-suspension-attachment="financial-claim.pdf"
                    data-suspension-attachment-type="pdf"
                    data-suspension-amount="1750.00"
                  >
                    <td>
                      <a href="#" class="cell-booking-ref" data-booking-ref="Hb4685"
                        >Hb4685 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.reservations.14') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966558959877+</span>
                      </div>
                    </td>
                    <td>{{ __('company.pages.reservations.23') }}</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}">
                        <i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa
                      </a>
                    </td>
                    <td>
                      <div class="cell-period">
                        <span class="cell-period__dates"
                          ><span class="ltr-num">2026-07-20</span></span
                        >
                        <i class="bi bi-arrow-left"></i>
                        <span class="cell-period__dates"
                          ><span class="ltr-num">2026-07-21</span></span
                        >
                      </div>
                    </td>
                    <td class="cell-suspension-reason">
                      <span class="badge bg-primary">{{ __('company.pages.reservations.9') }}</span>
                    </td>
                    <td class="cell-suspension-date ltr-num">2026-08-15</td>
                    <td class="cell-suspension-attachment">
                      <button
                        type="button"
                        class="btn btn-outline btn-sm action-menu-item"
                        data-action="view-suspension-attachment"
                        data-file-type="pdf"
                        data-file-name="financial-claim.pdf"
                      >
                        <i class="bi bi-file-earmark-pdf"></i>
                        PDF
                      </button>
                    </td>
                    <td class="cell-suspension-amount ltr-num">{{ __('company.pages.reservations.24') }}</td>
                    <td class="cell-close-date ltr-num">—</td>
                    <td><span class="badge bg-warning text-dark">{{ __('company.common.538') }}</span></td>
                    <td>
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
                              data-action="close-suspended"
                            >
                              <i class="bi bi-lock"></i> {{ __('company.common.94') }}</a>
                          </li>
                          <li>
                            <a
                              href="#"
                              class="dropdown-item action-menu-item"
                              data-action="view-suspension-attachment"
                              data-file-type="pdf"
                              data-file-name="financial-claim.pdf"
                            >
                              <i class="bi bi-file-earmark-pdf"></i> {{ __('company.pages.reservations.25') }}</a>
                          </li>
                          <li>
                            <a
                              href="#"
                              class="dropdown-item action-menu-item"
                              data-action="edit-suspension"
                            >
                              <i class="bi bi-pencil"></i> {{ __('company.pages.reservations.22') }}</a>
                          </li>
                          <li>
                            <a
                              href="#"
                              class="dropdown-item action-menu-item"
                              data-action="reservation-history"
                            >
                              <i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="table-pagination table-pagination-dt" id="generalReservationsPagination">
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
                <button class="table-pagination__page-btn">3</button>
                <button class="table-pagination__page-btn">
                  <i class="bi bi-chevron-left"></i>
                </button>
              </div>
            </div>

            <div
              class="table-pagination table-pagination-dt"
              id="suspendedReservationsPagination"
              style="display: none"
            >
              <div class="table-pagination__size-select">
                <label for="suspendedPageSizeSelect">{{ __('company.common.212') }}</label>
                <select id="suspendedPageSizeSelect">
                  <option value="10" selected>10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                </select>
              </div>
              <div class="table-pagination__pages">
                <button class="table-pagination__page-btn" type="button" disabled>
                  <i class="bi bi-chevron-right"></i>
                </button>
                <button class="table-pagination__page-btn is-active" type="button">1</button>
                <button class="table-pagination__page-btn" type="button" disabled>
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
                    <h6 class="filter-section__title">{{ __('company.common.312') }}</h6>

                    <div class="filter-section__fields">
                      <div class="filter-field">
                        <label>{{ __('company.common.235') }}</label>
                        <div class="dropdown">
                          <button
                            type="button"
                            class="filter-select-btn dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            {{ __('company.common.223') }}<i class="bi bi-chevron-down"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-scrollable">
                            <li><a class="dropdown-item" href="#">{{ __('company.common.223') }}</a></li>
                            <li>
                              <a class="dropdown-item" href="#">N2 - Tuwaiq</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#">Riyadh</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                >N2 rental car - Riyadh - Al Aziziyah</a
                              >
                            </li>
                          </ul>
                        </div>
                      </div>
                      

                      <div class="filter-field">
                        <label>{{ __('company.common.570') }}</label>
                        <div class="dropdown">
                          <button
                            type="button"
                            class="filter-select-btn dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            {{ __('company.common.223') }}<i class="bi bi-chevron-down"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-scrollable">
                            <li><a class="dropdown-item" href="#">{{ __('company.common.223') }}</a></li>

                            <li>
                              <a class="dropdown-item" href="#">{{ __('company.common.350') }}</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#">{{ __('company.common.129') }}</a>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div class="filter-field">
                        <label>{{ __('company.common.517') }}</label>
                        <div class="dropdown">
                          <button
                            type="button"
                            class="filter-select-btn dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            {{ __('company.common.223') }}<i class="bi bi-chevron-down"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-scrollable">
                            <li><a class="dropdown-item" href="#">{{ __('company.common.223') }}</a></li>
                            <li>
                              <a class="dropdown-item" href="#">{{ __('company.common.183') }}</a>
                            </li>
                            <li><a class="dropdown-item" href="#">{{ __('company.common.357') }}</a></li>
                            <li>
                              <a class="dropdown-item" href="#">{{ __('company.common.174') }}</a>
                            </li>
                            <li><a class="dropdown-item" href="#">{{ __('company.common.546') }}</a></li>
                          </ul>
                        </div>
                      </div>

                      <div class="filter-field">
                        <label>{{ __('company.pages.reservations.26') }}</label>
                        <div class="dropdown">
                          <button
                            type="button"
                            class="filter-select-btn dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            {{ __('company.common.223') }}<i class="bi bi-chevron-down"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-scrollable">
                            <li><a class="dropdown-item" href="#">{{ __('company.common.223') }}</a></li>
                            <li>
                              <a class="dropdown-item" href="#">{{ __('company.common.215') }}</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#">{{ __('company.pages.reservations.27') }}</a>
                            </li>
                          </ul>
                        </div>
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
                    <h6 class="filter-section__title">{{ __('company.common.315') }}</h6>

                    <div class="filter-section__fields">
                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input
                            type="checkbox"
                            value="customer-nationality"
                            data-col-label="جنسية العميل"
                          />
                          <span>{{ __('company.pages.reservations.28') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="customer-gender" data-col-label="الجنس" />
                          <span>{{ __('company.pages.reservations.29') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input
                            type="checkbox"
                            value="license-number"
                            data-col-label="رقم الرخصة"
                          />
                          <span>{{ __('company.pages.reservations.30') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input
                            type="checkbox"
                            value="customer-email"
                            data-col-label="ايميل العميل"
                          />
                          <span>{{ __('company.pages.reservations.31') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input
                            type="checkbox"
                            value="customer-city"
                            data-col-label="مدينة العميل"
                          />
                          <span>{{ __('company.common.229') }}</span>
                        </label>
                      </div>
                    </div>
                  </div>

                  
                  <div class="filter-section">
                    <h6 class="filter-section__title">{{ __('company.pages.reservations.32') }}</h6>

                    <div class="filter-section__fields">
                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="company-name" data-col-label="اسم الشركة" />
                          <span>{{ __('company.common.135') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="car-model" data-col-label="السيارة" />
                          <span>{{ __('company.common.203') }}</span>
                        </label>
                      </div>
                    </div>
                  </div>

                  
                  <div class="filter-section">
                    <h6 class="filter-section__title">{{ __('company.common.312') }}</h6>

                    <div class="filter-section__fields">
                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="booking-time" />
                          <span>{{ __('company.pages.reservations.33') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="delivery-time" />
                          <span>{{ __('company.common.588') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="pickup-location" />
                          <span>{{ __('company.pages.reservations.34') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="delivery-location" />
                          <span>{{ __('company.pages.reservations.35') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="admin-notes" />
                          <span>{{ __('company.pages.reservations.36') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="customer-evaluation" />
                          <span>{{ __('company.pages.reservations.37') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="compensated" />
                          <span>{{ __('company.pages.reservations.38') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="delivery-assignment" />
                          <span>{{ __('company.common.80') }}</span>
                        </label>
                      </div>

                      <div class="filter-field filter-field--checkbox">
                        <label class="checkbox-label">
                          <input type="checkbox" value="delivery-status" />
                          <span>{{ __('company.common.364') }}</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline" data-bs-dismiss="modal">
                    {{ __('company.common.95') }}</button>
                  <button type="button" class="btn btn-primary" id="applyColumnsBtn">{{ __('company.common.308') }}</button>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('modals')
</main>
        
      

    
    <div class="company-info-tooltip" id="companyInfoTooltip">
      <div class="company-info-tooltip__location">
        <i class="bi bi-geo-alt"></i>
        <span id="tooltipLocation">{{ __('company.common.50') }}</span>
      </div>
      <div class="company-info-tooltip__rating">
        <i class="bi bi-star-fill"></i>
        <span id="tooltipRating">4.4</span>
      </div>
      <div class="company-info-tooltip__manager">
        <i class="bi bi-person"></i>
        <span id="tooltipManager">hamza mohamed</span>
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

    
    <div
      class="modal fade"
      id="editReservationModal"
      tabindex="-1"
      aria-labelledby="editReservationModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editReservationModalLabel">{{ __('company.pages.reservations.39') }}</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body">
            <form id="editReservationForm">
              <div class="row gy-3 mb-3">
                <div class="col-md-6">
                  <label for="editReservationRef" class="form-label">{{ __('company.common.398') }}</label>
                  <input
                    type="text"
                    class="form-control bg-light"
                    id="editReservationRef"
                    readonly
                    style="cursor: not-allowed"
                  />
                </div>
                <div class="col-md-6">
                  <label for="editReservationCustomer" class="form-label">{{ __('company.common.215') }}</label>
                  <input
                    type="text"
                    class="form-control bg-light"
                    id="editReservationCustomer"
                    readonly
                    style="cursor: not-allowed"
                  />
                </div>
                <div class="col-md-6">
                  <label for="editReservationCompany" class="form-label">{{ __('company.common.206') }}</label>
                  <input
                    type="text"
                    class="form-control bg-light"
                    id="editReservationCompany"
                    readonly
                    style="cursor: not-allowed"
                  />
                </div>
                <div class="col-md-6">
                  <label for="editReservationCity" class="form-label">{{ __('company.common.229') }}</label>
                  <input type="text" class="form-control" id="editReservationCity" />
                </div>
                <div class="col-md-6">
                  <label for="editReservationStartDate" class="form-label">{{ __('company.common.284') }}</label>
                  <input type="date" class="form-control" id="editReservationStartDate" />
                </div>
                <div class="col-md-6">
                  <label for="editReservationEndDate" class="form-label">{{ __('company.common.281') }}</label>
                  <input type="date" class="form-control" id="editReservationEndDate" />
                </div>
                <div class="col-md-6">
                  <label for="editReservationDriver" class="form-label">{{ __('company.common.188') }}</label>
                  <select class="form-select" id="editReservationDriver">
                    <option value="سائق 1">{{ __('company.common.408') }}</option>
                    <option value="سائق 2">{{ __('company.common.409') }}</option>
                    <option value="سائق 3">{{ __('company.common.410') }}</option>
                    <option value="سائق 4">{{ __('company.common.411') }}</option>
                    <option value="سائق 5">{{ __('company.common.412') }}</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="editReservationStatus" class="form-label">{{ __('company.common.165') }}</label>
                  <select class="form-select" id="editReservationStatus">
                    <option value="جديد">{{ __('company.common.359') }}</option>
                    <option value="مقبول">{{ __('company.common.545') }}</option>
                    <option value="حجز مفتوح">{{ __('company.pages.reservations.16') }}</option>
                    <option value="مرفوض">{{ __('company.common.521') }}</option>
                    <option value="معلق">{{ __('company.common.538') }}</option>
                    <option value="مقفل">{{ __('company.pages.reservations.5') }}</option>
                    <option value="ملغي">{{ __('company.common.554') }}</option>
                    <option value="مكتمل">{{ __('company.common.548') }}</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="editReservationPickupAddress" class="form-label"
                    >{{ __('company.common.451') }}</label
                  >
                  <input type="text" class="form-control" id="editReservationPickupAddress" />
                </div>
                <div class="col-md-6">
                  <label for="editReservationDropoffAddress" class="form-label"
                    >{{ __('company.common.452') }}</label
                  >
                  <input type="text" class="form-control" id="editReservationDropoffAddress" />
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
            <button type="button" class="btn btn-primary" id="saveReservationBtn">
              {{ __('company.common.376') }}</button>
          </div>
        </div>
      </div>
    </div>

    
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
      id="suspendReservationModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="suspendReservationModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon">
                <i class="bi bi-pause-circle"></i>
              </div>
              <div>
                <h2 class="bkmodal-header__ref" id="suspendReservationModalLabel">{{ __('company.pages.reservations.40') }}</h2>
                <div class="bkmodal-header__meta">
                  <span>
                    <i class="bi bi-file-earmark-text"></i>
                    <span id="suspensionBookingRefHeader">-</span>
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

          <form id="suspensionForm" novalidate>
            <div class="modal-body booking-modal__body">
              <span class="bkmodal-section-label">{{ __('company.pages.reservations.41') }}</span>
              <div class="mb-3">
                <label class="form-label" for="suspensionReason">
                  {{ __('company.pages.reservations.7') }}<span class="text-danger">*</span>
                </label>
                <select
                  class="form-select"
                  id="suspensionReason"
                  required
                  aria-describedby="suspensionReasonError"
                >
                  <option value="">{{ __('company.pages.reservations.42') }}</option>
                  <option value="financial">{{ __('company.pages.reservations.9') }}</option>
                  <option value="damage">{{ __('company.pages.reservations.10') }}</option>
                  <option value="other">{{ __('company.pages.reservations.11') }}</option>
                </select>
                <div
                  class="invalid-feedback"
                  id="suspensionReasonError"
                  role="alert"
                  style="display: none"
                ></div>
              </div>

              <div class="mb-3" id="suspensionOtherReasonContainer" style="display: none">
                <label class="form-label" for="suspensionOtherReason">
                  {{ __('company.pages.reservations.43') }}<span class="text-danger">*</span>
                </label>
                <input
                  type="text"
                  class="form-control"
                  id="suspensionOtherReason"
                  maxlength="150"
                   placeholder="{{ __('company.pages.reservations.57') }}"
                  aria-describedby="suspensionOtherReasonError"
                />
                <div
                  class="invalid-feedback"
                  id="suspensionOtherReasonError"
                  role="alert"
                  style="display: none"
                ></div>
              </div>

              <div class="mb-3">
                <div class="row g-3">
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="suspensionDate">
                      {{ __('company.pages.reservations.12') }}<span class="text-danger">*</span>
                    </label>
                    <input
                      type="date"
                      class="form-control ltr-num"
                      id="suspensionDate"
                      required
                      aria-describedby="suspensionDateError"
                    />
                    <div
                      class="invalid-feedback"
                      id="suspensionDateError"
                      role="alert"
                      style="display: none"
                    ></div>
                  </div>
                  <div class="col-12 col-md-6 d-none" id="suspensionAmountContainer">
                    <label class="form-label" for="suspensionAmount">
                      <span id="suspensionAmountLabel">{{ __('company.pages.reservations.44') }}</span>
                      <span class="text-danger">*</span>
                    </label>
                    <input
                      type="number"
                      class="form-control ltr-num"
                      id="suspensionAmount"
                      min="0"
                      step="0.01"
                      value="0"
                      aria-describedby="suspensionAmountError"
                    />
                    <div
                      class="invalid-feedback"
                      id="suspensionAmountError"
                      role="alert"
                      style="display: none"
                    ></div>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="suspensionAttachment">
                  <span id="suspensionAttachmentLabel">{{ __('company.pages.reservations.18') }}</span>
                  <span class="text-danger" id="suspensionAttachmentRequired" style="display: none"
                    >*</span
                  >
                </label>
                <label
                  class="file-dropzone"
                  for="suspensionAttachment"
                  id="suspensionFileDropzone"
                  tabindex="0"
                >
                  <span class="file-dropzone__preview" id="suspensionFilePreview">
                    <i class="bi bi-image"></i>
                  </span>
                  <div class="file-dropzone__text">
                    <p class="file-dropzone__title">{{ __('company.pages.reservations.45') }}</p>
                    <p class="file-dropzone__sub" id="suspensionFileName">
                      {{ __('company.pages.reservations.46') }}</p>
                  </div>
                  <span class="file-dropzone__btn">
                    <i class="bi bi-cloud-arrow-up"></i>
                    {{ __('company.common.125') }}</span>
                  <input
                    type="file"
                    id="suspensionAttachment"
                    accept="image/*,application/pdf"
                    aria-describedby="suspensionAttachmentError"
                    hidden
                  />
                </label>
                <div
                  class="invalid-feedback"
                  id="suspensionAttachmentError"
                  role="alert"
                  style="display: none"
                ></div>
                <div class="file-actions" id="suspensionFileActions" style="display: none">
                  <button
                    type="button"
                    class="file-action-link file-action-link--view"
                    id="previewSuspensionFileBtn"
                  >
                    <i class="bi bi-eye"></i> {{ __('company.common.537') }}</button>
                  <button
                    type="button"
                    class="file-action-link file-action-link--remove"
                    id="removeSuspensionFileBtn"
                  >
                    <i class="bi bi-trash3"></i> {{ __('company.pages.reservations.47') }}</button>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="suspensionNote">
                  <span id="suspensionNoteLabel">{{ __('company.pages.reservations.48') }}</span>
                  <span class="text-danger" id="suspensionNoteRequired" style="display: none"
                    >*</span
                  >
                  <span class="text-muted" id="suspensionNoteOptional">{{ __('company.common.0') }}</span>
                </label>
                <textarea
                  class="form-control"
                  id="suspensionNote"
                  rows="4"
                  maxlength="500"
                   placeholder="{{ __('company.pages.reservations.58') }}"
                  aria-describedby="suspensionNoteError suspensionNoteCounter"
                ></textarea>
                <div class="d-flex justify-content-between gap-2">
                  <div
                    class="invalid-feedback"
                    id="suspensionNoteError"
                    role="alert"
                    style="display: none"
                  ></div>
                  <div class="form-text mt-2 ltr-num" id="suspensionNoteCounter" dir="ltr">
                    0 / 500
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer booking-modal__footer">
              <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-pause-circle"></i>
                <span id="suspensionSubmitLabel">{{ __('company.pages.reservations.49') }}</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="suspensionSuccessModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="suspensionSuccessModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center py-5">
            <div class="mb-4">
              <i class="bi bi-check-circle-fill text-success" style="font-size: 64px"></i>
            </div>
            <h4
              class="mb-3"
              id="suspensionSuccessModalLabel"
              style="font-family: 'Alexandria', sans-serif; font-weight: 600"
            >
              {{ __('company.pages.reservations.50') }}</h4>
            <p
              class="text-muted mb-4"
              id="suspensionSuccessMessage"
              style="font-family: 'Alexandria', sans-serif"
            ></p>
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
              <div class="bkmodal-header__icon"><i class="bi bi-lock"></i></div>
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
              <div class="mt-3 d-flex justify-content-between align-items-center">
                <label class="form-label" for="closeRefundAmount"> {{ __('company.pages.reservations.51') }}</label>
                <p class="fs-5 fw-bold">0.00</p>
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
              id="closeReservationSuccessMessage"
              style="font-family: 'Alexandria', sans-serif"
            ></p>
            <button type="button" class="btn btn-primary m-auto" data-bs-dismiss="modal">
              {{ __('company.common.374') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="imageModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="imageModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon"><i class="bi bi-image"></i></div>
              <div>
                <h2 class="bkmodal-header__ref" id="imageModalLabel">{{ __('company.pages.reservations.21') }}</h2>
                <div class="bkmodal-header__meta">
                  <span id="imageModalFileName">-</span>
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
          <div class="modal-body booking-modal__body text-center">
            <img
              id="imageModalPreview"
              class="img-fluid rounded border"
              src="{{ asset('company/img/car.png') }}"
               alt="{{ __('company.pages.reservations.59') }}"
              style="max-height: 60vh; object-fit: contain"
            />
          </div>
          <div class="modal-footer booking-modal__footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.92') }}</button>
            <a class="btn btn-primary" id="imageModalDownload" href="img/car.png" download>
              <i class="bi bi-download"></i>
              {{ __('company.pages.reservations.52') }}</a>
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
                    <td class="log-message--payment" data-history-message>{{ __('company.common.325') }}</td>
                    <td data-history-user>{{ __('company.common.564') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 09:12:14</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--payment" data-history-message>{{ __('company.common.331') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 09:14:38</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--activate" data-history-message>{{ __('company.common.335') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:05:42</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--invoice" data-history-message>{{ __('company.common.321') }}</td>
                    <td data-history-user>{{ __('company.common.565') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 09:16:02</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--deactivate" data-history-message>
                      {{ __('company.common.332') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:09:10</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--info" data-history-message>{{ __('company.common.492') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 09:18:20</td>
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
      id="bookingDetailsModal"
      tabindex="-1"
      aria-labelledby="bookingDetailsModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content booking-modal">
          
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon">
                <i class="bi bi-file-earmark-text"></i>
              </div>
              <div>
                <p class="bkmodal-header__ref" id="bookingDetailsModalLabel">
                  {{ __('company.common.368') }}<span class="num" id="modalBookingRef">#vda7e4</span>
                  <span class="badge bg-danger" id="modalBookingStatus">{{ __('company.common.554') }}</span>
                </p>
                <div class="bkmodal-header__meta">
                  <span><i class="bi bi-person"></i> ALFALLAJ MEZNAH IBRAHIM A</span>
                  <span class="dot">•</span>
                  <span><i class="bi bi-building"></i> N2 — Riyadh</span>
                  <span class="dot">•</span>
                  <span><i class="bi bi-calendar3"></i> {{ __('company.common.69') }}</span>
                </div>
              </div>
            </div>
            <div class="bkmodal-header__actions">
              <button
                type="button"
                class="bkmodal-urgent-btn"
                id="modalUrgentToggle"
                 title="{{ __('company.pages.reservations.60') }}"
              >
                <i class="bi bi-flag"></i>
              </button>
              <button
                type="button"
                class="booking-modal__close"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                <i class="bi bi-x-lg"></i>
              </button>
            </div>
          </div>

          
          <div class="modal-body booking-modal__body">
            <div class="booking-modal__tabs">
              <div class="view-tabs" id="bookingTabs" role="tablist"  aria-label="{{ __('company.common.312') }}">
                <button
                  type="button"
                  class="view-tabs__btn is-active"
                  data-tab-target="#summary"
                  role="tab"
                  aria-selected="true"
                >
                  <i class="bi bi-file-text"></i>
                  <span>{{ __('company.common.239') }}</span>
                </button>
                <button
                  type="button"
                  class="view-tabs__btn"
                  data-tab-target="#rating"
                  role="tab"
                  aria-selected="false"
                >
                  <i class="bi bi-star"></i>
                  <span>{{ __('company.common.162') }}</span>
                </button>

                <button
                  type="button"
                  class="view-tabs__btn"
                  data-tab-target="#bank"
                  role="tab"
                  aria-selected="false"
                >
                  <i class="bi bi-bank"></i>
                  <span>{{ __('company.common.540') }}</span>
                </button>
              </div>
            </div>

            <div class="tab-content booking-modal__content" id="bookingTabsContent">
              
              <div class="tab-pane fade show active" id="summary" role="tabpanel">
                
                <div class="bkmodal-quickstrip">
                  <div class="bkmodal-quickstrip__car">
                    <div class="bkmodal-quickstrip__car-icon">
                      <i class="bi bi-car-front-fill"></i>
                    </div>
                    <div>
                      <p class="bkmodal-quickstrip__car-name">{{ __('company.common.584') }}</p>
                      <span class="bkmodal-quickstrip__car-sub">N2 · Riyadh</span>
                    </div>
                  </div>
                  <span class="bkmodal-quickstrip__divider"></span>
                  <div class="bkmodal-quickstrip__fact">
                    <span class="bkmodal-quickstrip__fact-label">{{ __('company.common.148') }}</span>
                    <span class="bkmodal-quickstrip__fact-value ltr-num">07-22</span>
                  </div>
                  <div class="bkmodal-quickstrip__fact">
                    <span class="bkmodal-quickstrip__fact-label">{{ __('company.common.159') }}</span>
                    <span class="bkmodal-quickstrip__fact-value ltr-num">07-23</span>
                  </div>
                  <div class="bkmodal-quickstrip__fact">
                    <span class="bkmodal-quickstrip__fact-label">{{ __('company.common.228') }}</span>
                    <span class="bkmodal-quickstrip__fact-value">{{ __('company.common.594') }}</span>
                  </div>
                  <div class="bkmodal-quickstrip__fact">
                    <span class="bkmodal-quickstrip__fact-label">{{ __('company.common.191') }}</span>
                    <span class="bkmodal-quickstrip__fact-value ltr-num">304.13</span>
                  </div>
                </div>

                <div class="bkmodal-section-label">{{ __('company.common.273') }}</div>
                <div class="booking-details-grid">
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-truck"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.171') }}</span>
                      <span class="booking-detail-item__value">{{ __('company.common.300') }}</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.449') }}</span>
                      <span class="booking-detail-item__value">ALFALLAJ MEZNAH IBRAHIM A</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-calendar3"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.284') }}</span>
                      <span class="booking-detail-item__value ltr-num">2026-07-22</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-clock"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.587') }}</span>
                      <span class="booking-detail-item__value ltr-num">16:00</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-calendar-range"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.219') }}</span>
                      <span class="booking-detail-item__value">1</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-car-front"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.430') }}</span>
                      <span class="booking-detail-item__value">{{ __('company.common.584') }}</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.423') }}</span>
                      <span class="booking-detail-item__value ltr-num">{{ __('company.common.24') }}</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.431') }}</span>
                      <span class="booking-detail-item__value">N2</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.235') }}</span>
                      <span class="booking-detail-item__value"
                        >N2 rental car - Riyadh - Al Aziziyah</span
                      >
                    </div>
                  </div>
                </div>

                <div class="bkmodal-section-label">{{ __('company.common.172') }}</div>
                <div class="booking-details-grid">
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-credit-card"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.437') }}</span>
                      <span class="booking-detail-item__value">{{ __('company.common.267') }}</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.168') }}</span>
                      <span class="booking-detail-item__value">1</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-x-circle"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.169') }}</span>
                      <span class="booking-detail-item__value">0</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-cash"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.160') }}</span>
                      <span class="booking-detail-item__value">{{ __('company.common.491') }}</span>
                    </div>
                  </div>
                </div>
              </div>

              
              <div class="tab-pane fade" id="rating" role="tabpanel">
                <div class="rating-section">
                  <div class="rating-overview">
                    <div class="rating-overview__score">
                      <span class="rating-overview__number">4.5</span>
                      <div class="rating-overview__stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                      </div>
                      <span class="rating-overview__count">{{ __('company.common.13') }}</span>
                    </div>
                    <div class="rating-overview__breakdown">
                      <div class="rating-bar">
                        <span class="rating-bar__label">5</span>
                        <div class="rating-bar__track">
                          <div class="rating-bar__fill" style="width: 70%"></div>
                        </div>
                        <span class="rating-bar__count">90</span>
                      </div>
                      <div class="rating-bar">
                        <span class="rating-bar__label">4</span>
                        <div class="rating-bar__track">
                          <div class="rating-bar__fill" style="width: 20%"></div>
                        </div>
                        <span class="rating-bar__count">25</span>
                      </div>
                      <div class="rating-bar">
                        <span class="rating-bar__label">3</span>
                        <div class="rating-bar__track">
                          <div class="rating-bar__fill" style="width: 8%"></div>
                        </div>
                        <span class="rating-bar__count">10</span>
                      </div>
                      <div class="rating-bar">
                        <span class="rating-bar__label">2</span>
                        <div class="rating-bar__track">
                          <div class="rating-bar__fill" style="width: 2%"></div>
                        </div>
                        <span class="rating-bar__count">3</span>
                      </div>
                      <div class="rating-bar">
                        <span class="rating-bar__label">1</span>
                        <div class="rating-bar__track">
                          <div class="rating-bar__fill" style="width: 0%"></div>
                        </div>
                        <span class="rating-bar__count">0</span>
                      </div>
                    </div>
                  </div>

                  <div class="rating-categories">
                    <h6 class="rating-categories__title">{{ __('company.common.320') }}</h6>
                    <div class="rating-categories__grid">
                      <div class="rating-category">
                        <div class="rating-category__icon">
                          <i class="bi bi-car-front"></i>
                        </div>
                        <div class="rating-category__info">
                          <span class="rating-category__name">{{ __('company.common.362') }}</span>
                          <span class="rating-category__score">4.8</span>
                        </div>
                        <div class="rating-category__stars">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-half"></i>
                        </div>
                      </div>
                      <div class="rating-category">
                        <div class="rating-category__icon">
                          <i class="bi bi-person-check"></i>
                        </div>
                        <div class="rating-category__info">
                          <span class="rating-category__name">{{ __('company.common.380') }}</span>
                          <span class="rating-category__score">4.6</span>
                        </div>
                        <div class="rating-category__stars">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star"></i>
                        </div>
                      </div>
                      <div class="rating-category">
                        <div class="rating-category__icon">
                          <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="rating-category__info">
                          <span class="rating-category__name">{{ __('company.common.242') }}</span>
                          <span class="rating-category__score">4.4</span>
                        </div>
                        <div class="rating-category__stars">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star"></i>
                        </div>
                      </div>
                      <div class="rating-category">
                        <div class="rating-category__icon">
                          <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="rating-category__info">
                          <span class="rating-category__name">{{ __('company.common.222') }}</span>
                          <span class="rating-category__score">4.2</span>
                        </div>
                        <div class="rating-category__stars">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="rating-reviews">
                    <h6 class="rating-reviews__title">{{ __('company.common.164') }}</h6>
                    <div class="rating-reviews__list">
                      <div class="rating-review">
                        <div class="rating-review__header">
                          <div class="rating-review__user">
                            <div class="rating-review__avatar">
                              <i class="bi bi-person"></i>
                            </div>
                            <div class="rating-review__user-info">
                              <span class="rating-review__name">{{ __('company.common.508') }}</span>
                              <span class="rating-review__date">2026-07-15</span>
                            </div>
                          </div>
                          <div class="rating-review__rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                          </div>
                        </div>
                        <div class="rating-review__reason">
                          <span class="rating-review__reason-label">{{ __('company.common.418') }}</span>
                          <span class="rating-review__reason-text"
                            >{{ __('company.common.381') }}</span
                          >
                        </div>
                      </div>
                      <div class="rating-review">
                        <div class="rating-review__header">
                          <div class="rating-review__user">
                            <div class="rating-review__avatar">
                              <i class="bi bi-person"></i>
                            </div>
                            <div class="rating-review__user-info">
                              <span class="rating-review__name">{{ __('company.common.414') }}</span>
                              <span class="rating-review__date">2026-07-10</span>
                            </div>
                          </div>
                          <div class="rating-review__rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                          </div>
                        </div>
                        <div class="rating-review__reason">
                          <span class="rating-review__reason-label">{{ __('company.common.418') }}</span>
                          <span class="rating-review__reason-text"
                            >{{ __('company.common.298') }}</span
                          >
                        </div>
                      </div>
                      <div class="rating-review">
                        <div class="rating-review__header">
                          <div class="rating-review__user">
                            <div class="rating-review__avatar">
                              <i class="bi bi-person"></i>
                            </div>
                            <div class="rating-review__user-info">
                              <span class="rating-review__name">{{ __('company.pages.reservations.53') }}</span>
                              <span class="rating-review__date">2026-07-05</span>
                            </div>
                          </div>
                          <div class="rating-review__rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                          </div>
                        </div>
                        <div class="rating-review__reason">
                          <span class="rating-review__reason-label">{{ __('company.common.418') }}</span>
                          <span class="rating-review__reason-text">{{ __('company.pages.reservations.54') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              
              <div class="tab-pane fade" id="bank" role="tabpanel">
                <div class="bank-info-section">
                  <div class="bank-info-grid">
                    <div class="bank-info-item">
                      <div class="bank-info-item__icon">
                        <i class="bi bi-building"></i>
                      </div>
                      <div class="bank-info-item__content">
                        <span class="bank-info-item__label">{{ __('company.common.132') }}</span>
                        <span class="bank-info-item__value">{{ __('company.common.156') }}</span>
                      </div>
                    </div>
                    <div class="bank-info-item">
                      <div class="bank-info-item__icon">
                        <i class="bi bi-credit-card"></i>
                      </div>
                      <div class="bank-info-item__content">
                        <span class="bank-info-item__label">{{ __('company.common.152') }}</span>
                        <span class="bank-info-item__value">SA44 2000 0000 0000 0000 0000</span>
                      </div>
                    </div>
                    <div class="bank-info-item">
                      <div class="bank-info-item__icon">
                        <i class="bi bi-person"></i>
                      </div>
                      <div class="bank-info-item__content">
                        <span class="bank-info-item__label">{{ __('company.common.139') }}</span>
                        <span class="bank-info-item__value">{{ __('company.common.509') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
          <div class="modal-footer bkmodal-footer">
            <a href="{{ route('company.booking-details-two') }}" class="btn btn-primary">
              <i class="bi bi-file-earmark-text"></i>
              <span>{{ __('company.pages.reservations.55') }}</span>
            </a>
            <div class="dropdown">
              <button
                type="button"
                class="btn btn-outline dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-three-dots"></i> {{ __('company.common.230') }}</button>
              <ul class="dropdown-menu dropdown-menu-end">
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

            // Keep the period cell structure intact and update the extension fields.
            if (currentExtendRow) {
              var periodDates = currentExtendRow.querySelectorAll('.cell-period__dates .ltr-num');
              if (periodDates.length > 1) {
                periodDates[periodDates.length - 1].textContent = newReturnDate;
              }

              var extensionDaysCell = currentExtendRow.querySelector('[data-extension-days]');
              var extensionDateCell = currentExtendRow.querySelector('[data-extension-date]');
              if (extensionDaysCell) {
                extensionDaysCell.dataset.extensionDays = extensionState.days;
                extensionDaysCell.textContent = extensionState.days + ' أيام';
              }
              if (extensionDateCell) {
                extensionDateCell.dataset.extensionDate = newReturnDate;
                extensionDateCell.textContent = newReturnDate;
              }
              currentExtendRow.dataset.reservationExtended = 'true';

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
        var suspensionModalEl = document.getElementById('suspendReservationModal');
        var suspensionModal = new bootstrap.Modal(suspensionModalEl);
        var suspensionSuccessModal = new bootstrap.Modal(
          document.getElementById('suspensionSuccessModal'),
        );
        var closeReservationModalEl = document.getElementById('closeReservationModal');
        var closeReservationModal = new bootstrap.Modal(closeReservationModalEl);
        var closeReservationSuccessModal = new bootstrap.Modal(
          document.getElementById('closeReservationSuccessModal'),
        );
        var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        var currentSuspendRow = null;
        var currentSuspendBookingRef = null;
        var suspensionFormMode = 'create';
        var currentCloseRow = null;
        var currentCloseBookingRef = null;

        // ---------------------------------------------------------
        // Reservation status registry — badge + action menu per status
        // ---------------------------------------------------------
        var RESERVATION_STATUSES = {
          جديد: { badge: 'badge bg-secondary', actions: ['accept', 'reject'] },
          مقبول: {
            badge: 'badge bg-success',
            actions: ['extend', 'suspend', 'close', 'rate', 'invoice'],
          },
          'حجز مفتوح': {
            badge: 'badge bg-primary',
            actions: ['extend', 'suspend', 'close', 'rate', 'invoice'],
          },
          مرفوض: { badge: 'badge bg-danger', actions: ['re-accept'] },
          ملغي: { badge: 'badge bg-dark', actions: [] },
          مكتمل: { badge: 'badge bg-info', actions: ['rate', 'invoice'] },
          معلق: { badge: 'badge bg-warning text-dark', actions: ['close-request'] },
          مقفل: { badge: 'badge bg-dark', actions: [] },
        };

        var RESERVATION_ACTION_DEFS = {
          accept: { icon: 'bi-check-circle', label: 'قبول الحجز', cssClass: 'text-success' },
          reject: { icon: 'bi-x-circle', label: 'رفض الحجز', cssClass: 'text-danger' },
          // 're-accept': {
          //   icon: 'bi-check2-circle',
          //   label: 'إعادة قبول الحجز',
          //   cssClass: 'text-success',
          // },
          'close-request': { icon: 'bi-lock', label: 'إغلاق الطلب', cssClass: 'text-danger' },
          extend: { icon: 'bi-clock', label: 'تمديد' },
          suspend: { icon: 'bi-pause-circle', label: 'تعليق' },
          close: { icon: 'bi-lock', label: 'إغلاق الحجز' },
          rate: {
            icon: 'bi-star',
            label: 'إضافة تقييم',
            href: '{{ route('company.booking-details-two') }}?tab=ratings',
          },
          invoice: { icon: 'bi-file-earmark-arrow-down', label: 'تنزيل الفاتورة' },
        };

        function buildActionMenuItem(key) {
          var def = RESERVATION_ACTION_DEFS[key];
          var li = document.createElement('li');
          if (!def) return li;
          var href = def.href || '#';
          var extraAttrs = def.href ? '' : ' data-action="' + key + '"';
          var cssClass = def.cssClass ? ' ' + def.cssClass : '';
          li.innerHTML =
            '<a href="' +
            href +
            '" class="dropdown-item action-menu-item' +
            cssClass +
            '"' +
            extraAttrs +
            '><i class="bi ' +
            def.icon +
            '"></i> ' +
            def.label +
            '</a>';
          return li;
        }

        function applyReservationStatus(row, status) {
          if (!row || !RESERVATION_STATUSES[status]) return;
          row.setAttribute('data-status', status);

          var badge = row.querySelector('.badge');
          if (badge) {
            badge.className = RESERVATION_STATUSES[status].badge;
            badge.textContent = status;
          }

          var assignmentIcons = row.querySelector('.cell-assignment__icons');
          if (assignmentIcons) {
            assignmentIcons.classList.toggle(
              'd-none',
              status !== 'مقبول' && status !== 'حجز مفتوح',
            );
          }

          var menu = row.querySelector('.action-dropdown .dropdown-menu');
          if (!menu) return;
          menu.innerHTML = '';
          RESERVATION_STATUSES[status].actions.forEach(function (key) {
            menu.appendChild(buildActionMenuItem(key));
          });

          var historyLi = document.createElement('li');
          historyLi.innerHTML =
            '<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#reservationHistoryModal"><i class="bi bi-clock-history"></i> تاريخ العمليات والحجز</a>';
          menu.appendChild(historyLi);
        }

        // Assign the real workflow status to each demo row
        applyReservationStatus(document.querySelector('tr[data-row-key="Y8e087"]'), 'مقبول');
        applyReservationStatus(document.querySelector('tr[data-row-key="Hb4685"]'), 'جديد');
        applyReservationStatus(document.querySelector('tr[data-row-key="Gf1d41"]'), 'معلق');
        applyReservationStatus(document.querySelector('tr[data-row-key="S7a617"]'), 'مرفوض');
        applyReservationStatus(document.querySelector('tr[data-row-key="Q568ef"]'), 'حجز مفتوح');

        // ---------------------------------------------------------
        // Reservation status change — shared confirm modal
        // ---------------------------------------------------------
        var RESERVATION_STATUS_ACTION_CONFIG = {
          accept: {
            variant: 'success',
            icon: 'bi-check-circle',
            title: 'قبول الحجز؟',
            text: 'سيتم قبول هذا الحجز وتفعيله.',
            nextStatus: 'مقبول',
          },
          // 're-accept': {
          //   variant: 'success',
          //   icon: 'bi-check2-circle',
          //   title: 'إعادة قبول الحجز؟',
          //   text: 'سيتم قبول هذا الحجز مرة أخرى وتفعيله.',
          //   nextStatus: 'مقبول',
          // },
          'close-request': {
            variant: 'danger',
            icon: 'bi-lock',
            title: 'إغلاق الطلب؟',
            text: 'سيتم إغلاق هذا الحجز نهائيًا.',
            nextStatus: 'مقفل',
          },
        };

        var reservationStatusConfirmModalEl = document.getElementById(
          'reservationStatusConfirmModal',
        );
        var reservationStatusConfirmModal = new bootstrap.Modal(reservationStatusConfirmModalEl);
        var reservationSuccessModal = new bootstrap.Modal(document.getElementById('successModal'));
        var reservationStatusConfirmRow = null;
        var reservationStatusConfirmNextStatus = null;

        function openReservationStatusConfirm(row, actionKey) {
          var cfg = RESERVATION_STATUS_ACTION_CONFIG[actionKey];
          if (!cfg || !row) return;

          reservationStatusConfirmRow = row;
          reservationStatusConfirmNextStatus =
            cfg.nextStatus || row.dataset.previousStatus || 'مقبول';

          document.getElementById('reservationStatusConfirmIcon').className =
            'confirm-modal__icon confirm-modal__icon--' + cfg.variant;
          document.getElementById('reservationStatusConfirmIconEl').className = 'bi ' + cfg.icon;
          document.getElementById('reservationStatusConfirmTitle').textContent = cfg.title;
          document.getElementById('reservationStatusConfirmText').textContent = cfg.text;
          document.getElementById('reservationStatusConfirmBtn').className =
            cfg.variant === 'danger' ? 'btn btn-danger' : 'btn btn-primary';

          reservationStatusConfirmModal.show();
        }

        document
          .getElementById('reservationStatusConfirmBtn')
          .addEventListener('click', function () {
            if (!reservationStatusConfirmRow || !reservationStatusConfirmNextStatus) return;

            applyReservationStatus(reservationStatusConfirmRow, reservationStatusConfirmNextStatus);
            reservationStatusConfirmRow = null;
            reservationStatusConfirmNextStatus = null;

            reservationStatusConfirmModalEl.addEventListener(
              'hidden.bs.modal',
              function () {
                reservationSuccessModal.show();
              },
              { once: true },
            );
            reservationStatusConfirmModal.hide();
          });

        // ---------------------------------------------------------
        // Reject reservation — cancellation reason modal
        // (same flow as pending-reservations.html)
        // ---------------------------------------------------------
        var cancellationReasonModalEl = document.getElementById('cancellationReasonModal');
        var cancellationReasonModal = cancellationReasonModalEl
          ? new bootstrap.Modal(cancellationReasonModalEl)
          : null;
        var cancellationReasonSelect = document.getElementById('cancellationReason');
        var cancellationNotesContainer = document.getElementById('cancellationNotesContainer');
        var cancellationNotesField = document.getElementById('cancellationNotes');
        var cancellationReasonError = document.getElementById('cancellationReasonError');
        var currentCancellingRow = null;

        function resetCancellationForm() {
          if (cancellationReasonSelect) cancellationReasonSelect.value = '';
          if (cancellationNotesContainer) cancellationNotesContainer.style.display = 'none';
          if (cancellationNotesField) cancellationNotesField.value = '';
          if (cancellationReasonError) cancellationReasonError.style.display = 'none';
        }

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

        function openCancellationReasonModal(row) {
          if (!row || !cancellationReasonModal) return;
          currentCancellingRow = row;
          resetCancellationForm();
          cancellationReasonModal.show();
        }

        var confirmCancellationBtn = document.getElementById('confirmCancellationBtn');
        if (confirmCancellationBtn) {
          confirmCancellationBtn.addEventListener('click', function () {
            if (!currentCancellingRow) return;

            if (!cancellationReasonSelect || !cancellationReasonSelect.value) {
              if (cancellationReasonError) cancellationReasonError.style.display = 'block';
              return;
            }

            applyReservationStatus(currentCancellingRow, 'مرفوض');
            currentCancellingRow = null;

            cancellationReasonModalEl.addEventListener(
              'hidden.bs.modal',
              function () {
                reservationSuccessModal.show();
              },
              { once: true },
            );
            cancellationReasonModal.hide();
          });
        }

        if (cancellationReasonModalEl) {
          cancellationReasonModalEl.addEventListener('hidden.bs.modal', function () {
            resetCancellationForm();
            currentCancellingRow = null;
          });
        }

        // ---------------------------------------------------------
        // General reservations — status filter + search
        // ---------------------------------------------------------
        var generalFilters = { status: '', search: '' };

        function applyGeneralReservationFilters() {
          var activeViewBtn = document.querySelector(
            '.view-tabs__btn[data-reservation-view].is-active',
          );
          var activeView = activeViewBtn
            ? activeViewBtn.getAttribute('data-reservation-view')
            : 'all';

          document
            .querySelectorAll('#reservationsTable tbody tr[data-row-key]')
            .forEach(function (row) {
              var inView =
                activeView === 'extended'
                  ? row.getAttribute('data-reservation-extended') === 'true'
                  : true;
              var status = row.getAttribute('data-status') || '';
              var matchesStatus = !generalFilters.status || status === generalFilters.status;
              var matchesSearch =
                !generalFilters.search ||
                row.textContent.toLowerCase().indexOf(generalFilters.search) !== -1;

              row.style.display = inView && matchesStatus && matchesSearch ? '' : 'none';
            });
        }

        document
          .querySelectorAll('#generalReservationFilters [data-status-filter]')
          .forEach(function (btn) {
            btn.addEventListener('click', function () {
              generalFilters.status = this.dataset.statusFilter;
              document.querySelector('#reservationStatusFilterBtn span').textContent = this.dataset
                .statusFilter
                ? 'الحالة: ' + this.textContent.trim()
                : 'الحالة';
              applyGeneralReservationFilters();
            });
          });

        document.getElementById('reservationSearchInput').addEventListener('input', function () {
          generalFilters.search = this.value.trim().toLowerCase();
          applyGeneralReservationFilters();
        });

        document.querySelectorAll('.view-tabs__btn[data-reservation-view]').forEach(function (btn) {
          btn.addEventListener('click', function () {
            applyGeneralReservationFilters();
          });
        });

        document
          .querySelectorAll('#filterModal .dropdown-menu [data-status-filter]')
          .forEach(function (item) {
            item.addEventListener('click', function (e) {
              e.preventDefault();
              var statusBtn = document.getElementById('filterModalStatusBtn');
              statusBtn.dataset.statusFilter = this.dataset.statusFilter;
              statusBtn.childNodes[0].textContent = this.textContent.trim() + ' ';
            });
          });

        document.getElementById('applyFilterBtn').addEventListener('click', function () {
          generalFilters.status =
            document.getElementById('filterModalStatusBtn').dataset.statusFilter || '';
          document.querySelector('#reservationStatusFilterBtn span').textContent =
            generalFilters.status ? 'الحالة: ' + generalFilters.status : 'الحالة';
          applyGeneralReservationFilters();
        });

        function setSuspensionFormMode(mode) {
          suspensionFormMode = mode;
          document.getElementById('suspendReservationModalLabel').textContent =
            mode === 'edit' ? 'تعديل بيانات التعليق' : 'تعليق الحجز';
          document.getElementById('suspensionSubmitLabel').textContent =
            mode === 'edit' ? 'حفظ التعديلات' : 'تأكيد التعليق';
        }

        function downloadSuspensionPdf(fileName) {
          var pdfContent =
            '%PDF-1.4\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n2 0 obj<</Type/Pages/Count 0>>endobj\ntrailer<</Root 1 0 R>>\n%%EOF';
          var url = URL.createObjectURL(new Blob([pdfContent], { type: 'application/pdf' }));
          var link = document.createElement('a');
          link.href = url;
          link.download = fileName || 'suspension-attachment.pdf';
          document.body.appendChild(link);
          link.click();
          link.remove();
          URL.revokeObjectURL(url);
        }

        function createSuspendedReservationRow(sourceRow, state, bookingRef) {
          if (!sourceRow || sourceRow.closest('#suspendedReservationsTable')) return sourceRow;

          var suspendedTableBody = document.querySelector('#suspendedReservationsTable tbody');
          if (!suspendedTableBody) return null;

          var sourceRowKey =
            sourceRow.dataset.rowKey ||
            bookingRef +
              '-' +
              Array.prototype.indexOf.call(sourceRow.parentNode.children, sourceRow);
          var existingRow = null;
          suspendedTableBody.querySelectorAll('tr').forEach(function (candidateRow) {
            if (!existingRow && candidateRow.dataset.sourceRowKey === sourceRowKey) {
              existingRow = candidateRow;
            }
          });
          if (existingRow) return existingRow;

          var row = document.createElement('tr');
          row.dataset.rowKey = 'SUS-' + Date.now();
          row.dataset.sourceRowKey = sourceRowKey;

          var bookingCell = document.createElement('td');
          var bookingLink = document.createElement('a');
          bookingLink.href = '#';
          bookingLink.className = 'cell-booking-ref';
          bookingLink.dataset.bookingRef = bookingRef;
          bookingLink.appendChild(document.createTextNode(bookingRef + ' '));
          var bookingIcon = document.createElement('i');
          bookingIcon.className = 'bi bi-box-arrow-up-right';
          bookingLink.appendChild(bookingIcon);
          bookingCell.appendChild(bookingLink);
          row.appendChild(bookingCell);

          var customerCell = document.createElement('td');
          var customer = sourceRow.querySelector('.cell-customer-stack');
          customerCell.appendChild(
            customer ? customer.cloneNode(true) : document.createTextNode('-'),
          );
          row.appendChild(customerCell);

          var carCell = document.createElement('td');
          carCell.textContent = sourceRow.dataset.carName || '-';
          row.appendChild(carCell);

          var branchCell = document.createElement('td');
          var company = sourceRow.querySelector('.cell-company');
          branchCell.textContent = company ? company.textContent.replace(/\s+/g, ' ').trim() : '-';
          row.appendChild(branchCell);

          var periodCell = document.createElement('td');
          var period = sourceRow.querySelector('.cell-period');
          periodCell.appendChild(period ? period.cloneNode(true) : document.createTextNode('-'));
          row.appendChild(periodCell);

          var reasonCell = document.createElement('td');
          reasonCell.className = 'cell-suspension-reason';
          row.appendChild(reasonCell);

          var dateCell = document.createElement('td');
          dateCell.className = 'cell-suspension-date ltr-num';
          row.appendChild(dateCell);

          var attachmentCell = document.createElement('td');
          attachmentCell.className = 'cell-suspension-attachment';
          attachmentCell.innerHTML =
            '<button type="button" class="btn btn-outline btn-sm action-menu-item" ' +
            'data-action="view-suspension-attachment"><i class="bi bi-image"></i> صورة</button>';
          row.appendChild(attachmentCell);

          var amountCell = document.createElement('td');
          amountCell.className = 'cell-suspension-amount ltr-num';
          row.appendChild(amountCell);

          var closeDateCell = document.createElement('td');
          closeDateCell.className = 'cell-close-date ltr-num';
          closeDateCell.textContent = '—';
          row.appendChild(closeDateCell);

          var statusCell = document.createElement('td');
          statusCell.innerHTML = '<span class="badge bg-warning text-dark">معلق</span>';
          row.appendChild(statusCell);

          var actionsCell = document.createElement('td');
          actionsCell.innerHTML =
            '<div class="dropdown action-dropdown">' +
            '<button class="action-menu-btn dropdown-toggle" type="button" title="خيارات" ' +
            'data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></button>' +
            '<ul class="dropdown-menu dropdown-menu-end">' +
            '<li><a href="#" class="dropdown-item action-menu-item" data-action="close-suspended">' +
            '<i class="bi bi-lock"></i> إغلاق الحجز</a></li>' +
            '<li><a href="#" class="dropdown-item action-menu-item" ' +
            'data-action="view-suspension-attachment"><i class="bi bi-image"></i> عرض المرفق</a></li>' +
            '<li><a href="#" class="dropdown-item action-menu-item" data-action="edit-suspension">' +
            '<i class="bi bi-pencil"></i> تعديل بيانات التعليق</a></li>' +
            '<li><a href="#" class="dropdown-item action-menu-item" data-action="reservation-history">' +
            '<i class="bi bi-clock-history"></i> تاريخ العمليات والحجز</a></li>' +
            '</ul></div>';
          row.appendChild(actionsCell);

          suspendedTableBody.appendChild(row);
          window.SuspendReservationForm.updateRow(row, state);
          return row;
        }

        // Handle action menu items with data-action attribute
        document.addEventListener('click', function (e) {
          var item = e.target.closest('.action-menu-item[data-action]');
          if (!item) return;

          e.preventDefault();
          var action = item.getAttribute('data-action');
          var row = item.closest('tr');
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
            case 'suspend':
              currentSuspendRow = row;
              currentSuspendBookingRef = bookingRefValue || 'غير محدد';
              setSuspensionFormMode('create');
              window.SuspendReservationForm.prepareFromRow(row, currentSuspendBookingRef);
              suspensionModal.show();
              break;
            case 'edit-suspension':
              currentSuspendRow = row;
              currentSuspendBookingRef = bookingRefValue || 'غير محدد';
              setSuspensionFormMode('edit');
              window.SuspendReservationForm.prepareEditFromRow(row, currentSuspendBookingRef);
              suspensionModal.show();
              break;
            case 'close':
              currentCloseRow = row;
              currentCloseBookingRef = bookingRefValue || 'غير محدد';
              window.CloseReservationForm.prepareFromRow(row, currentCloseBookingRef);
              closeReservationModal.show();
              break;
            case 'close-suspended':
              currentCloseRow = row;
              currentCloseBookingRef = bookingRefValue || 'غير محدد';
              window.CloseReservationForm.prepareFromRow(row, currentCloseBookingRef);
              closeReservationModal.show();
              break;
            case 'view-suspension-attachment':
              if (item.dataset.fileType === 'pdf') {
                downloadSuspensionPdf(item.dataset.fileName);
              } else {
                document.getElementById('imageModalPreview').src =
                  item.dataset.fileSrc || 'img/car.png';
                document.getElementById('imageModalFileName').textContent =
                  item.dataset.fileName || 'مرفق الحجز';
                document.getElementById('imageModalDownload').href =
                  item.dataset.fileSrc || 'img/car.png';
                document.getElementById('imageModalDownload').download =
                  item.dataset.fileName || 'suspension-attachment.jpg';
                imageModal.show();
              }
              break;
            case 'reservation-history':
              fillReservationHistoryModal(row);
              reservationHistoryModal.show();
              break;
            case 'accept':
            // case 're-accept':
            case 'close-request':
              openReservationStatusConfirm(row, action);
              break;
            case 'reject':
              openCancellationReasonModal(row);
              break;
          }
        });

        document.getElementById('suspensionForm').addEventListener('submit', function (e) {
          e.preventDefault();

          var suspensionState = window.SuspendReservationForm.validate();
          if (!suspensionState || !currentSuspendRow) return;

          if (suspensionFormMode === 'create') {
            currentSuspendRow.dataset.previousStatus = currentSuspendRow.dataset.status || 'مقبول';
          }
          window.SuspendReservationForm.updateRow(currentSuspendRow, suspensionState);
          applyReservationStatus(currentSuspendRow, 'معلق');
          if (suspensionFormMode === 'create') {
            createSuspendedReservationRow(
              currentSuspendRow,
              suspensionState,
              currentSuspendBookingRef,
            );
            applySuspensionFilters();
          }
          document.getElementById('suspensionSuccessMessage').textContent =
            suspensionFormMode === 'edit'
              ? 'تم تحديث بيانات تعليق الحجز ' + currentSuspendBookingRef + ' بنجاح'
              : 'تم تعليق الحجز ' +
                currentSuspendBookingRef +
                ' بسبب: ' +
                suspensionState.reasonLabel;

          suspensionModalEl.addEventListener(
            'hidden.bs.modal',
            function () {
              suspensionSuccessModal.show();
            },
            { once: true },
          );
          suspensionModal.hide();
        });

        document
          .getElementById('confirmCloseReservationBtn')
          .addEventListener('click', function () {
            var closeDate = window.CloseReservationForm.validate();
            if (!closeDate || !currentCloseRow) return;

            var closeState = window.CloseReservationForm.getState();
            var successContent = window.CloseReservationForm.getSuccessContent(
              currentCloseBookingRef,
              'الحجز',
            );
            currentCloseRow.dataset.previousStatus = currentCloseRow.dataset.status || 'مقبول';
            window.CloseReservationForm.updateRow(currentCloseRow, closeState);
            applyReservationStatus(currentCloseRow, 'مكتمل');
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

        var suspendedRows = document.querySelectorAll(
          '#suspendedReservationsTable tbody tr[data-row-key]',
        );
        var suspensionFilters = {
          reason: '',
          search: '',
          from: '',
          to: '',
        };
        var suspensionCurrentPage = 1;
        var suspensionPageSize = 10;
        var suspensionPaginationPages = document.querySelector(
          '#suspendedReservationsPagination .table-pagination__pages',
        );

        function toLocalDateValue(date) {
          return (
            date.getFullYear() +
            '-' +
            ('0' + (date.getMonth() + 1)).slice(-2) +
            '-' +
            ('0' + date.getDate()).slice(-2)
          );
        }

        function applySuspensionFilters() {
          var matchingRows = [];
          suspendedRows = document.querySelectorAll(
            '#suspendedReservationsTable tbody tr[data-row-key]',
          );

          suspendedRows.forEach(function (row) {
            var rowReason = row.dataset.suspensionReason || '';
            var rowDate = row.dataset.suspensionDate || '';
            var rowText = row.textContent.toLowerCase();
            var matchesReason = !suspensionFilters.reason || rowReason === suspensionFilters.reason;
            var matchesSearch =
              !suspensionFilters.search || rowText.indexOf(suspensionFilters.search) !== -1;
            var matchesFrom = !suspensionFilters.from || rowDate >= suspensionFilters.from;
            var matchesTo = !suspensionFilters.to || rowDate <= suspensionFilters.to;

            if (matchesReason && matchesSearch && matchesFrom && matchesTo) matchingRows.push(row);
            row.style.display = 'none';
          });

          var pageCount = Math.max(1, Math.ceil(matchingRows.length / suspensionPageSize));
          if (suspensionCurrentPage > pageCount) suspensionCurrentPage = pageCount;
          var pageStart = (suspensionCurrentPage - 1) * suspensionPageSize;

          matchingRows.slice(pageStart, pageStart + suspensionPageSize).forEach(function (row) {
            row.style.display = '';
          });

          suspensionPaginationPages.textContent = '';

          var previousButton = document.createElement('button');
          previousButton.type = 'button';
          previousButton.className = 'table-pagination__page-btn';
          previousButton.disabled = suspensionCurrentPage === 1;
          previousButton.innerHTML = '<i class="bi bi-chevron-right"></i>';
          previousButton.addEventListener('click', function () {
            suspensionCurrentPage--;
            applySuspensionFilters();
          });
          suspensionPaginationPages.appendChild(previousButton);

          for (var page = 1; page <= pageCount; page++) {
            var pageButton = document.createElement('button');
            pageButton.type = 'button';
            pageButton.className =
              'table-pagination__page-btn' + (page === suspensionCurrentPage ? ' is-active' : '');
            pageButton.textContent = page;
            pageButton.dataset.page = page;
            pageButton.addEventListener('click', function () {
              suspensionCurrentPage = Number(this.dataset.page);
              applySuspensionFilters();
            });
            suspensionPaginationPages.appendChild(pageButton);
          }

          var nextButton = document.createElement('button');
          nextButton.type = 'button';
          nextButton.className = 'table-pagination__page-btn';
          nextButton.disabled = suspensionCurrentPage === pageCount;
          nextButton.innerHTML = '<i class="bi bi-chevron-left"></i>';
          nextButton.addEventListener('click', function () {
            suspensionCurrentPage++;
            applySuspensionFilters();
          });
          suspensionPaginationPages.appendChild(nextButton);
        }

        document
          .querySelectorAll('[data-suspension-reason-filter]')
          .forEach(function (filterButton) {
            filterButton.addEventListener('click', function () {
              suspensionFilters.reason = this.dataset.suspensionReasonFilter;
              suspensionCurrentPage = 1;
              document.querySelector('#suspensionReasonFilterBtn span').textContent =
                this.textContent.trim();
              applySuspensionFilters();
            });
          });

        document.getElementById('suspensionSearchInput').addEventListener('input', function () {
          suspensionFilters.search = this.value.trim().toLowerCase();
          suspensionCurrentPage = 1;
          applySuspensionFilters();
        });

        document.getElementById('suspendedPageSizeSelect').addEventListener('change', function () {
          suspensionPageSize = Number(this.value) || 10;
          suspensionCurrentPage = 1;
          applySuspensionFilters();
        });

        document.addEventListener('dateRangeApplied', function (e) {
          if (!e.detail || e.detail.key !== 'suspensionDate') return;
          suspensionFilters.from = toLocalDateValue(e.detail.from);
          suspensionFilters.to = toLocalDateValue(e.detail.to);
          suspensionCurrentPage = 1;
          applySuspensionFilters();
        });

        applySuspensionFilters();

        // Booking Details Modal — urgent flag toggle
        const modalUrgentToggle = document.getElementById('modalUrgentToggle');
        if (modalUrgentToggle) {
          modalUrgentToggle.addEventListener('click', function () {
            this.classList.toggle('is-active');
          });
        }

        // Booking Details Modal — tab switching
        const bookingTabs = document.getElementById('bookingTabs');
        if (bookingTabs) {
          const tabButtons = bookingTabs.querySelectorAll('.view-tabs__btn');
          const tabPanes = document.querySelectorAll('#bookingTabsContent .tab-pane');

          tabButtons.forEach((btn) => {
            btn.addEventListener('click', function () {
              // Update active state on buttons
              tabButtons.forEach((b) => {
                b.classList.remove('is-active');
                b.setAttribute('aria-selected', 'false');
              });
              this.classList.add('is-active');
              this.setAttribute('aria-selected', 'true');

              // Show corresponding tab pane
              const targetId = this.getAttribute('data-tab-target');
              tabPanes.forEach((pane) => {
                pane.classList.remove('show', 'active');
                if (pane.getAttribute('id') === targetId.substring(1)) {
                  pane.classList.add('show', 'active');
                }
              });
            });
          });
        }

        // Reservation Details Modal — uses the same design as pending-reservations.html
        const reservationBookingModalEl = document.getElementById('reservationDetailsModal');
        const reservationBookingModal = new bootstrap.Modal(reservationBookingModalEl);
        const reservationHistoryModalEl = document.getElementById('reservationHistoryModal');
        const reservationHistoryModal = new bootstrap.Modal(reservationHistoryModalEl);
        const reservationHistoryWrap = document.getElementById('reservationHistoryTableWrap');
        const reservationHistoryThumb = document.getElementById('reservationHistoryScrollThumb');
        let activeReservationBookingRow = null;

        function reservationTextFrom(row, selector) {
          const el = row.querySelector(selector);
          return el ? el.textContent.trim() : '';
        }

        function parseReservationPeriod(row) {
          const dates = row.querySelectorAll('.cell-period__dates .ltr-num');
          const pickup = dates[0] ? dates[0].textContent.trim() : '';
          const pickupBits = pickup.split(',');

          return {
            pickupDate: (pickupBits[1] || pickupBits[0] || '').trim(),
            pickupTime: (pickupBits[0] || '').trim(),
            returnDate: dates[1] ? dates[1].textContent.trim() : '',
          };
        }

        function getReservationBookingData(row) {
          const period = parseReservationPeriod(row);
          const statusBadge = row.querySelector('td:nth-child(8) .badge');
          const statusText =
            row.dataset.status || (statusBadge ? statusBadge.textContent.trim() : '');

          return {
            ref: reservationTextFrom(row, '.cell-booking-ref').replace(/\s+/g, ''),
            status: statusText,
            statusClass: statusBadge ? statusBadge.className : 'badge bg-secondary',
            service: 'تسليم',
            customer: reservationTextFrom(row, '.cell-customer-stack__name'),
            pickupDate: period.pickupDate,
            pickupTime: period.pickupTime,
            period: '1',
            car: '-',
            price: '203.26 / يومي',
            company:
              reservationTextFrom(row, '.cell-company').replace('Main Company', '').trim() || 'N2',
            office: (row.children[3]?.textContent.trim() || '') + ' - N2',
            payment: 'بطاقة',
            accepted: statusText === 'مقبول' || statusText === 'عقد مفتوح' ? '1' : '0',
            cancelled: statusText === 'ملغي' ? '1' : '0',
            compensation: '0',
            rating: '5',
            ratedBy: reservationTextFrom(row, '.cell-customer-stack__name'),
            ratingDate: row.children[5]?.textContent.trim() || '',
            companyNotes: 'لا يوجد تعليقات',
            bankName: '-',
            iban: '-',
            cardHolder: '-',
          };
        }

        function fillReservationBookingModal(data) {
          const statusClass = data.statusClass || 'badge bg-secondary';
          const statusBadge = document.getElementById('reservationBookingStatus');
          const bookingStatus = document.getElementById('reservationBookingAccepted');

          document.getElementById('reservationBookingRef').textContent = data.ref;
          statusBadge.textContent = data.status;
          statusBadge.className = statusClass;
          document.getElementById('reservationBookingCustomerMeta').textContent = data.customer;
          document.getElementById('reservationBookingOfficeMeta').textContent = data.office;
          document.getElementById('reservationBookingService').textContent = data.service;
          document.getElementById('reservationBookingCustomer').textContent = data.customer;
          document.getElementById('reservationBookingPickupDate').textContent = data.pickupDate;
          document.getElementById('reservationBookingPickupTime').textContent = data.pickupTime;
          document.getElementById('reservationBookingPeriod').textContent = data.period;
          document.getElementById('reservationBookingCar').textContent = data.car;
          document.getElementById('reservationBookingPrice').textContent = data.price;
          document.getElementById('reservationBookingCompany').textContent = data.company;
          document.getElementById('reservationBookingOffice').textContent = data.office;
          document.getElementById('reservationBookingPayment').textContent = data.payment;

          bookingStatus.textContent = data.status;
          bookingStatus.className = 'booking-detail-item__value';

          document.getElementById('reservationBookingCompensation').textContent = data.compensation;
          document.getElementById('reservationBookingRating').textContent = data.rating;
          document.getElementById('reservationBookingRatedBy').textContent = data.ratedBy;
          document.getElementById('reservationBookingRatingDate').textContent = data.ratingDate;
          document.getElementById('reservationBookingBankName').textContent = data.bankName;
          document.getElementById('reservationBookingIban').textContent = data.iban;
          document.getElementById('reservationBookingCardHolder').textContent = data.cardHolder;
        }

        function showReservationBookingTab(tabName) {
          document.querySelectorAll('[data-reservation-booking-tab]').forEach(function (tab) {
            const isActive = tab.dataset.reservationBookingTab === tabName;
            tab.classList.toggle('is-active', isActive);
            tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
          });

          document.querySelectorAll('[data-reservation-booking-panel]').forEach(function (panel) {
            panel.classList.toggle('is-active', panel.dataset.reservationBookingPanel === tabName);
          });
        }

        function updateReservationHistoryThumb() {
          if (!reservationHistoryWrap || !reservationHistoryThumb) return;

          const trackHeight = reservationHistoryWrap.clientHeight;
          const ratio = reservationHistoryWrap.clientHeight / reservationHistoryWrap.scrollHeight;
          const thumbHeight = Math.max(ratio * trackHeight, 24);
          const maxScroll =
            reservationHistoryWrap.scrollHeight - reservationHistoryWrap.clientHeight;
          const scrollRatio = maxScroll > 0 ? reservationHistoryWrap.scrollTop / maxScroll : 0;

          reservationHistoryThumb.style.height = thumbHeight + 'px';
          reservationHistoryThumb.style.top = scrollRatio * (trackHeight - thumbHeight) + 'px';
        }

        function fillReservationHistoryModal(row) {
          const data = getReservationBookingData(row);

          // Combined booking history and transactions data
          const messages = [
            'تم إنشاء الحجز.',
            'تم تسجيل بيانات العميل.',
            'تم إنشاء عملية الدفع.',
            'تم تأكيد طريقة الدفع.',
            'تم تحديث حالة الحجز.',
            'تم إصدار الفاتورة.',
            'تم تجهيز الحجز للمتابعة.',
            'لا يوجد تعويض مسجل.',
          ];
          if (row.dataset.suspensionReason) {
            const suspensionReason =
              row.dataset.suspensionReason === 'financial'
                ? 'مطالبة مالية'
                : row.dataset.suspensionReason === 'damage'
                  ? 'وجود تلفيات'
                  : 'أخرى' +
                    (row.dataset.suspensionOtherReason
                      ? ' — ' + row.dataset.suspensionOtherReason
                      : '');
            messages[4] =
              'تم تعليق الحجز بسبب: ' +
              suspensionReason +
              ' بتاريخ ' +
              (row.dataset.suspensionDate || '-');
          }
          const users = [
            'نظام',
            'نظام',
            'نظام الدفع',
            'نظام',
            'نظام',
            'نظام الفواتير',
            'نظام',
            'نظام',
          ];
          const times = [
            '10:00:00',
            '10:03:16',
            '09:12:14',
            '09:14:38',
            '10:05:42',
            '09:16:02',
            '10:09:10',
            '09:18:20',
          ];

          document.getElementById('reservationHistoryModalLabel').textContent =
            'تاريخ العمليات والحجز';

          reservationHistoryModalEl.querySelectorAll('[data-history-ref]').forEach(function (cell) {
            cell.textContent = data.ref;
          });
          reservationHistoryModalEl
            .querySelectorAll('[data-history-message]')
            .forEach(function (cell, index) {
              cell.textContent = messages[index];
            });
          reservationHistoryModalEl
            .querySelectorAll('[data-history-user]')
            .forEach(function (cell, index) {
              cell.textContent = users[index];
            });
          reservationHistoryModalEl
            .querySelectorAll('[data-history-date]')
            .forEach(function (cell, index) {
              cell.textContent = data.pickupDate + ' ' + times[index];
            });
        }

        document.querySelectorAll('.js-reservation-booking-details').forEach(function (link) {
          link.addEventListener('click', function (e) {
            e.preventDefault();
            activeReservationBookingRow = this.closest('tr');
            fillReservationBookingModal(getReservationBookingData(activeReservationBookingRow));
            showReservationBookingTab('summary');
          });
        });

        document.querySelectorAll('[data-reservation-booking-tab]').forEach(function (tab) {
          tab.addEventListener('click', function () {
            showReservationBookingTab(this.dataset.reservationBookingTab);
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

        // Handle booking history and transactions button in reservation details modal
        document.querySelectorAll('[data-reservation-modal-action]').forEach(function (btn) {
          btn.addEventListener('click', function () {
            if (activeReservationBookingRow) {
              fillReservationHistoryModal(activeReservationBookingRow);
              reservationBookingModalEl.addEventListener(
                'hidden.bs.modal',
                function () {
                  reservationHistoryModal.show();
                },
                { once: true },
              );
              reservationBookingModal.hide();
            }
          });
        });

        // Edit Reservation Modal Logic
        let currentEditingReservationRow = null;

        // Open edit modal with reservation data
        document
          .querySelectorAll('.btn-primary[data-bs-target="#editReservationModal"]')
          .forEach(function (editBtn) {
            editBtn.addEventListener('click', function () {
              currentEditingReservationRow = this.closest('tr');

              if (currentEditingReservationRow) {
                // Extract data from the row
                const bookingRef = currentEditingReservationRow
                  .querySelector('.cell-booking-ref')
                  .textContent.trim();
                const customerName = currentEditingReservationRow
                  .querySelector('.cell-customer-stack__name')
                  .textContent.trim();
                const company = currentEditingReservationRow
                  .querySelector('.cell-company')
                  .textContent.trim();
                const city = currentEditingReservationRow.cells[3].textContent.trim();
                const periodDates = currentEditingReservationRow.querySelectorAll(
                  '.cell-period__dates .ltr-num',
                );
                const startDate = periodDates[0].textContent.trim();
                const endDate = periodDates[1].textContent.trim();
                const driver = currentEditingReservationRow
                  .querySelector('.cell-assignment__name')
                  .textContent.trim();
                const status = currentEditingReservationRow
                  .querySelector('.badge')
                  .textContent.trim();

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

                // Fill the form with data
                document.getElementById('editReservationRef').value = bookingRef;
                document.getElementById('editReservationCustomer').value = customerName;
                document.getElementById('editReservationCompany').value = company;
                document.getElementById('editReservationCity').value = city;
                document.getElementById('editReservationStartDate').value = formattedStartDate;
                document.getElementById('editReservationEndDate').value = formattedEndDate;
                document.getElementById('editReservationDriver').value = driver;
                document.getElementById('editReservationStatus').value = status;
                document.getElementById('editReservationPickupAddress').value = '';
                document.getElementById('editReservationDropoffAddress').value = '';
              }
            });
          });

        // Save reservation changes
        document.getElementById('saveReservationBtn').addEventListener('click', function () {
          if (currentEditingReservationRow) {
            const newCustomer = document.getElementById('editReservationCustomer').value;
            const newCompany = document.getElementById('editReservationCompany').value;
            const newCity = document.getElementById('editReservationCity').value;
            const newStartDate = document.getElementById('editReservationStartDate').value;
            const newEndDate = document.getElementById('editReservationEndDate').value;
            const newDriver = document.getElementById('editReservationDriver').value;
            const newStatus = document.getElementById('editReservationStatus').value;
            const newPickupAddress = document.getElementById('editReservationPickupAddress').value;
            const newDropoffAddress = document.getElementById(
              'editReservationDropoffAddress',
            ).value;

            // Update the row in the table
            currentEditingReservationRow.querySelector('.cell-customer-stack__name').textContent =
              newCustomer;
            currentEditingReservationRow.querySelector('.cell-company').innerHTML =
              newCompany +
              ' <i class="bi bi-info-circle company-info-trigger" data-company="' +
              newCompany +
              '" data-location="Riyadh - Al Aziziyah ,الرياض" data-rating="4.4" data-manager="hamza mohamed"></i>';
            currentEditingReservationRow.cells[3].textContent = newCity;

            const periodDates = currentEditingReservationRow.querySelectorAll(
              '.cell-period__dates .ltr-num',
            );
            periodDates[0].textContent = newStartDate;
            periodDates[1].textContent = newEndDate;
            currentEditingReservationRow.querySelector('.cell-assignment__name').textContent =
              newDriver;

            // Update status badge
            const statusBadge = currentEditingReservationRow.querySelector('.badge');
            statusBadge.textContent = newStatus;
            statusBadge.className = 'badge'; // Reset classes

            // Set appropriate badge color based on status
            if (newStatus === 'مقبول') {
              statusBadge.classList.add('bg-success');
            } else if (newStatus === 'مرفوض' || newStatus === 'ملغي') {
              statusBadge.classList.add('bg-danger');
            } else if (newStatus === 'معلق') {
              statusBadge.classList.add('bg-warning');
            } else if (newStatus === 'مقفل') {
              statusBadge.classList.add('bg-dark');
            } else if (newStatus === 'مكتمل') {
              statusBadge.classList.add('bg-info');
            }

            // Update data-status for filtering
            currentEditingReservationRow.setAttribute('data-status', newStatus);
            const assignmentIcons =
              currentEditingReservationRow.querySelector('.cell-assignment__icons');
            if (assignmentIcons) {
              assignmentIcons.classList.toggle(
                'd-none',
                newStatus !== 'مقبول' && newStatus !== 'حجز مفتوح',
              );
            }

            // Close the modal
            const modal = bootstrap.Modal.getInstance(
              document.getElementById('editReservationModal'),
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

