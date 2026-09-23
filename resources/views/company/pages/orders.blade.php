@extends('company.layouts.master')

@section('title', 'T-Car — Orders List')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.orders.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.pages.orders.1') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
              <button class="btn btn-outline"><i class="bi bi-download"></i> {{ __('company.common.301') }}</button>
            </div>
          </div>

          
          <div class="table-card mb-4">
            <div class="table-toolbar">
              <div class="table-filters">
                <div class="dropdown">
                  <button
                    class="btn btn-outline dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <i class="bi bi-funnel"></i> {{ __('company.common.363') }}<i class="bi bi-chevron-down ms-2"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">{{ __('company.common.223') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('company.common.548') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('company.pages.orders.2') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('company.common.538') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('company.common.554') }}</a></li>
                  </ul>
                </div>
              </div>
              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="ordersSearchInput"  placeholder="{{ __('company.common.253') }}" />
              </div>
            </div>
            <div class="table-responsive-custom">
              <table class="data-table" id="ordersTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.235') }}</th>
                    <th>{{ __('company.common.430') }}</th>
                    <th>{{ __('company.common.219') }}</th>
                    <th>{{ __('company.common.363') }}</th>
                    <th>{{ __('company.common.76') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <a href="#" class="cell-booking-ref"
                        >#RES-001 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>N2 Rental Car - Riyadh - Almarwa</td>
                    <td>Toyota Yaris 2026</td>
                    <td class="ltr-num">15/07/2026 - 17/07/2026</td>
                    <td><span class="badge bg-success">{{ __('company.common.548') }}</span></td>
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
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-eye"></i> {{ __('company.common.445') }}</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-pencil-square"></i> {{ __('company.common.309') }}</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-printer"></i> {{ __('company.pages.orders.3') }}</a
                            >
                          </li>
                          <li><hr class="dropdown-divider" /></li>
                          <li>
                            <a class="dropdown-item text-danger" href="#"
                              ><i class="bi bi-x-circle"></i> {{ __('company.common.95') }}</a
                            >
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="#" class="cell-booking-ref"
                        >#RES-002 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>N2 Rental Car - Rawdah</td>
                    <td>HYUNDAI ACCENT 2025</td>
                    <td class="ltr-num">16/07/2026 - 18/07/2026</td>
                    <td><span class="badge bg-primary">{{ __('company.pages.orders.2') }}</span></td>
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
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-eye"></i> {{ __('company.common.445') }}</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-pencil-square"></i> {{ __('company.common.309') }}</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-printer"></i> {{ __('company.pages.orders.3') }}</a
                            >
                          </li>
                          <li><hr class="dropdown-divider" /></li>
                          <li>
                            <a class="dropdown-item text-danger" href="#"
                              ><i class="bi bi-x-circle"></i> {{ __('company.common.95') }}</a
                            >
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="#" class="cell-booking-ref"
                        >#RES-003 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>N2 - Al-Olaya</td>
                    <td>KIA pegas 2026</td>
                    <td class="ltr-num">17/07/2026 - 19/07/2026</td>
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
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-eye"></i> {{ __('company.common.445') }}</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-pencil-square"></i> {{ __('company.common.309') }}</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-printer"></i> {{ __('company.pages.orders.3') }}</a
                            >
                          </li>
                          <li><hr class="dropdown-divider" /></li>
                          <li>
                            <a class="dropdown-item text-danger" href="#"
                              ><i class="bi bi-x-circle"></i> {{ __('company.common.95') }}</a
                            >
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="#" class="cell-booking-ref"
                        >#RES-004 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>N2 - Tuwaiq, Riyadh</td>
                    <td>HYUNDAI i10 2025</td>
                    <td class="ltr-num">18/07/2026 - 20/07/2026</td>
                    <td><span class="badge bg-danger">{{ __('company.common.554') }}</span></td>
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
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-eye"></i> {{ __('company.common.445') }}</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-pencil-square"></i> {{ __('company.common.309') }}</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-printer"></i> {{ __('company.pages.orders.3') }}</a
                            >
                          </li>
                          <li><hr class="dropdown-divider" /></li>
                          <li>
                            <a class="dropdown-item text-danger" href="#"
                              ><i class="bi bi-x-circle"></i> {{ __('company.common.95') }}</a
                            >
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a href="#" class="cell-booking-ref"
                        >#RES-005 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>{{ __('company.common.460') }}</td>
                    <td>MG 5 2024</td>
                    <td class="ltr-num">19/07/2026 - 21/07/2026</td>
                    <td><span class="badge bg-primary">{{ __('company.pages.orders.2') }}</span></td>
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
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-eye"></i> {{ __('company.common.445') }}</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-pencil-square"></i> {{ __('company.common.309') }}</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="#"
                              ><i class="bi bi-printer"></i> {{ __('company.pages.orders.3') }}</a
                            >
                          </li>
                          <li><hr class="dropdown-divider" /></li>
                          <li>
                            <a class="dropdown-item text-danger" href="#"
                              ><i class="bi bi-x-circle"></i> {{ __('company.common.95') }}</a
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
                <button class="table-pagination__page-btn">2</button>
                <button class="table-pagination__page-btn">3</button>
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
@endsection

@push('modals')
</main>
        
      

    
@endpush

