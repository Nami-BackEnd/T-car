@extends('company.layouts.master')

@section('title', 'T-Car — Admin Dashboard')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.dashboard.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="#">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.pages.dashboard.0') }}</span>
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

          
          <div class="filter-card">
            <div class="filter-card__header">
              <div class="filter-card__title">
                <i class="bi bi-sliders"></i>
                <span>{{ __('company.pages.dashboard.1') }}</span>
              </div>
              <button class="filter-card__reset" type="button" id="filterResetBtn">
                <i class="bi bi-arrow-counterclockwise"></i>
                {{ __('company.pages.dashboard.2') }}</button>
            </div>

            <div class="filter-card__row">
              <div class="filter-card__date">
                <span class="filter-card__label">{{ __('company.common.157') }}</span>
                <button
                  type="button"
                  class="date-range-trigger"
                  data-bs-toggle="modal"
                  data-bs-target="#dateRangeModal"
                >
                  <i class="bi bi-calendar3"></i>
                  <span class="date-range-trigger__value ltr-num" id="dateRangeDisplay"></span>
                </button>
              </div>

              <div class="filter-card__month-toggle" role="group"  aria-label="{{ __('company.pages.dashboard.30') }}">
                <button type="button" class="month-toggle-btn" data-preset-btn="lastMonth">
                  <i class="bi bi-calendar3"></i> {{ __('company.common.210') }}</button>
                <button
                  type="button"
                  class="month-toggle-btn is-active"
                  data-preset-btn="thisMonth"
                >
                  <i class="bi bi-calendar3"></i> {{ __('company.common.209') }}</button>
              </div>
            </div>

            <div class="filter-card__branches">
              <span class="filter-card__label">{{ __('company.common.466') }}</span>
              <div class="branch-select dropdown">
                <button
                  type="button"
                  class="branch-select__trigger dropdown-toggle"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  id="branchSelectTrigger"
                >
                  <span id="branchSelectLabel">{{ __('company.pages.dashboard.3') }}</span>
                  <i class="bi bi-chevron-down"></i>
                </button>
                <div
                  class="dropdown-menu branch-select__menu"
                  aria-labelledby="branchSelectTrigger"
                >
                  <div class="branch-select__search">
                    <input type="text"  placeholder="{{ __('company.pages.dashboard.31') }}" id="branchSearchInput" />
                  </div>
                  <label class="branch-select__option is-all">
                    <input type="checkbox" id="branchAll" checked />
                    {{ __('company.pages.dashboard.3') }}</label>
                  <div id="branchOptionsList">
                    <label class="branch-select__option"
                      ><input type="checkbox" value="riyadh-almarwa" checked /> N2 Rental Car -
                      Riyadh - Almarwa</label
                    >
                    <label class="branch-select__option"
                      ><input type="checkbox" value="rawdah" checked /> N2 Rental Car -
                      Rawdah</label
                    >
                    <label class="branch-select__option"
                      ><input type="checkbox" value="olaya" checked /> N2 - Al-Olaya</label
                    >
                    <label class="branch-select__option"
                      ><input type="checkbox" value="tuwaiq" checked /> N2 - Tuwaiq, Riyadh</label
                    >
                    <label class="branch-select__option"
                      ><input type="checkbox" value="atiq" checked /> {{ __('company.common.460') }}</label
                    >
                    <label class="branch-select__option"
                      ><input type="checkbox" value="ruh-t2" checked /> N2 Rental Car - RUH Airport
                      T2</label
                    >
                    <label class="branch-select__option"
                      ><input type="checkbox" value="ruh-t1" checked /> N2 Rental Car - RUH Airport
                      T1</label
                    >
                    <label class="branch-select__option"
                      ><input type="checkbox" value="ruh-t3" checked /> N2 Rental Car - RUH Airport
                      T3</label
                    >
                    <label class="branch-select__option"
                      ><input type="checkbox" value="aziziyah" checked /> N2 Rental Car - Riyadh -
                      Al Aziziyah</label
                    >
                    <label class="branch-select__option"
                      ><input type="checkbox" value="awali" checked /> N2 Rental Car - Riyadh - Exit
                      27, Al-Awali</label
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>

          
          <div class="metric-grid">
            
            <div class="rate-card">
              <div class="rate-card__header">
                <i class="bi bi-x-circle rate-card__icon"></i>
                <p class="rate-card__title">{{ __('company.pages.dashboard.4') }}</p>
              </div>
              <div
                class="rate-card__gauge"
                id="gaugeCancelRate"
                data-value="0"
                data-color="#e5484d"
                data-label="0%"
              ></div>
              <span class="rate-card__avg">Business avg: <b>0</b></span>
            </div>

            
            <div class="rate-card">
              <div class="rate-card__header">
                <i class="bi bi-check-circle rate-card__icon"></i>
                <p class="rate-card__title">{{ __('company.pages.dashboard.5') }}</p>
              </div>
              <div
                class="rate-card__gauge"
                id="gaugeAcceptRate"
                data-value="80"
                data-color="#16a34a"
                data-label="80%"
              ></div>
              <span class="rate-card__avg">Business avg: <b>60</b></span>
            </div>

            
            <div class="rate-card">
              <div class="rate-card__header">
                <i class="bi bi-truck rate-card__icon"></i>
                <p class="rate-card__title">{{ __('company.pages.dashboard.6') }}</p>
              </div>
              <div
                class="rate-card__gauge"
                id="gaugeDeliveryRate"
                data-value="50"
                data-color="#1f7ffa"
                data-label="50%"
              ></div>
              <span class="rate-card__avg">Business avg: <b>50</b></span>
            </div>

            
            <div class="rate-card">
              <div class="rate-card__header">
                <i class="bi bi-star rate-card__icon"></i>
                <p class="rate-card__title">{{ __('company.pages.dashboard.7') }}</p>
              </div>
              <div
                class="rate-card__gauge"
                id="gaugeRating"
                data-value="0"
                data-color="#f59e0b"
                data-label="-"
              ></div>
              <span class="rate-card__avg">Business avg: <b>5</b></span>
            </div>

            
            <div class="rate-card">
              <div class="rate-card__header">
                <i class="bi bi-graph-down-arrow rate-card__icon"></i>
                <p class="rate-card__title">{{ __('company.pages.dashboard.8') }}</p>
              </div>
              <div
                class="rate-card__gauge"
                id="gaugeCancelRatio"
                data-value="0"
                data-color="#e5484d"
                data-label="0%"
              ></div>
              <span class="rate-card__avg">Business avg: <b>0</b></span>
            </div>

            
            <div class="info-card channel-card">
              <div class="info-card__header">
                <i class="bi bi-calendar-check info-card__icon"></i>
                <p class="info-card__title">{{ __('company.common.167') }}</p>
              </div>
              <div class="channel-card__total">5</div>
              <div class="channel-card__list">
                <div class="channel-card__row">
                  <span class="channel-card__label"><i class="bi bi-apple"></i> iOS</span>
                  <span class="channel-card__value">4</span>
                </div>
                <div class="channel-card__row">
                  <span class="channel-card__label"><i class="bi bi-android2"></i> Android</span>
                  <span class="channel-card__value">0</span>
                </div>
                <div class="channel-card__row">
                  <span class="channel-card__label"><i class="bi bi-globe2"></i> Web</span>
                  <span class="channel-card__value">1</span>
                </div>
              </div>
            </div>

            
            <div class="info-card revenue-card">
              <div class="info-card__header">
                <i class="bi bi-currency-dollar info-card__icon"></i>
                <p class="info-card__title">{{ __('company.pages.dashboard.9') }}</p>
              </div>
              <div class="revenue-card__block">
                <div class="revenue-card__label">{{ __('company.pages.dashboard.9') }}</div>
                <div class="revenue-card__value ltr-num">{{ __('company.pages.dashboard.10') }}</div>
              </div>
              <div class="revenue-card__block">
                <div class="revenue-card__label">{{ __('company.common.224') }}</div>
                <div class="revenue-card__value revenue-card__value--muted ltr-num">
                  {{ __('company.pages.dashboard.11') }}</div>
              </div>
            </div>
          </div>

          
          <div class="row g-4 mb-4">
            <div class="col-12 col-lg-6">
              <div class="donut-card h-100">
                <div class="card-header-modern">
                  <div class="card-header-modern__title">
                    <i class="bi bi-pie-chart"></i>
                    <h2>{{ __('company.common.570') }}</h2>
                  </div>
                </div>
                <div class="donut-chart">
                  <div class="donut-chart__figure" id="serviceTypeChart"></div>
                </div>
                <div class="donut-legend" id="serviceTypeLegend"></div>
              </div>
            </div>

            <div class="col-12 col-lg-6">
              <div class="rentals-card h-100">
                <div class="card-header-modern">
                  <div class="card-header-modern__title">
                    <i class="bi bi-car-front"></i>
                    <div>
                      <h2 class="h6 mb-0 text-primary fw-bold mb-2">{{ __('company.pages.dashboard.12') }}</h2>
                      <p>{{ __('company.pages.dashboard.13') }}</p>
                    </div>
                  </div>
                </div>
                <div class="table-responsive-custom">
                  <table class="rentals-table" id="ksaCarsTable">
                    <thead>
                      <tr>
                        <th></th>
                        <th>{{ __('company.common.207') }}</th>
                        <th>{{ __('company.common.241') }}</th>
                        <th>{{ __('company.common.201') }}</th>
                        <th>{{ __('company.common.191') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="cell-index">1</td>
                        <td class="cell-make">KIA</td>
                        <td>pegas</td>
                        <td>2026</td>
                        <td class="cell-price ltr-num">SAR 126.50</td>
                      </tr>
                      <tr>
                        <td class="cell-index">2</td>
                        <td class="cell-make">Toyota</td>
                        <td>Yaris</td>
                        <td>2026</td>
                        <td class="cell-price ltr-num">SAR 119.03</td>
                      </tr>
                      <tr>
                        <td class="cell-index">3</td>
                        <td class="cell-make">HYUNDAI</td>
                        <td>ACCENT</td>
                        <td>2025</td>
                        <td class="cell-price ltr-num">SAR 120.75</td>
                      </tr>
                      <tr>
                        <td class="cell-index">4</td>
                        <td class="cell-make">HYUNDAI</td>
                        <td>i10</td>
                        <td>2025</td>
                        <td class="cell-price ltr-num">SAR 90.00</td>
                      </tr>
                      <tr>
                        <td class="cell-index">5</td>
                        <td class="cell-make">HYUNDAI</td>
                        <td>i10</td>
                        <td>2026</td>
                        <td class="cell-price ltr-num">SAR 97.75</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          
          <div class="row g-4 mb-4">
            <div class="col-md-12">
              <div class="rentals-card">
                <div class="card-header-modern">
                  <div class="card-header-modern__title">
                    <i class="bi bi-building"></i>
                    <div>
                      <h2 class="h6 mb-0 text-primary fw-bold mb-2">{{ __('company.pages.dashboard.12') }}</h2>
                      <p>{{ __('company.pages.dashboard.14') }}</p>
                    </div>
                  </div>
                </div>
                <div class="table-responsive-custom">
                  <table class="rentals-table" id="companyCarsTable">
                    <thead>
                      <tr>
                        <th></th>
                        <th>{{ __('company.common.207') }}</th>
                        <th>{{ __('company.common.241') }}</th>
                        <th>{{ __('company.common.201') }}</th>
                        <th>{{ __('company.common.191') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="cell-index">1</td>
                        <td class="cell-make">HYUNDAI</td>
                        <td>ELANTRA</td>
                        <td>2023</td>
                        <td class="cell-price ltr-num">SAR 110.00</td>
                      </tr>
                      <tr>
                        <td class="cell-index">2</td>
                        <td class="cell-make">HYUNDAI</td>
                        <td>ACCENT</td>
                        <td>2023</td>
                        <td class="cell-price ltr-num">SAR 100.00</td>
                      </tr>
                      <tr>
                        <td class="cell-index">3</td>
                        <td class="cell-make">NISSAN</td>
                        <td>SUNNY</td>
                        <td>2023</td>
                        <td class="cell-price ltr-num">SAR 85.00</td>
                      </tr>
                      <tr>
                        <td class="cell-index">4</td>
                        <td class="cell-make">MG</td>
                        <td>MG 5</td>
                        <td>2024</td>
                        <td class="cell-price ltr-num">SAR 105.00</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          
          <div class="table-card mb-4">
            <div class="table-toolbar">
              <div class="table-toolbar__info">
                <div class="table-toolbar__icon">
                  <i class="bi bi-graph-up"></i>
                </div>
                <div>
                  <h2 class="h6 mb-0 text-primary fw-bold mb-2">{{ __('company.pages.dashboard.15') }}</h2>
                  <p class="mb-0 small text-muted">{{ __('company.pages.dashboard.16') }}</p>
                </div>
              </div>
            </div>
            <div class="table-toolbar border-0">
              <button
                type="button"
                class="btn btn-outline btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#officeFilterModal"
              >
                <i class="bi bi-sliders"></i> {{ __('company.common.303') }}</button>
              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="officeSearchInput"  placeholder="{{ __('company.common.138') }}" />
              </div>
            </div>
            <div class="table-responsive-custom">
              <table class="office-table" id="officeTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.138') }}</th>
                    <th>{{ __('company.pages.dashboard.17') }}</th>
                    <th>{{ __('company.pages.dashboard.5') }}</th>
                    <th>{{ __('company.pages.dashboard.18') }}</th>
                    <th>{{ __('company.pages.dashboard.19') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <a href="{{ route('company.office-details') }}" class="office-name"
                        >N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td class="cell-fraction" data-order="2"><b>2</b> <span>(2)</span></td>
                    <td class="ltr-num">50.00</td>
                    <td class="ltr-num">50.00</td>
                    <td class="ltr-num">2289.04</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="{{ route('company.office-details') }}" class="office-name">N2 Rental Car-Rawdah</a>
                    </td>
                    <td class="cell-fraction" data-order="2"><b>2</b> <span>(1)</span></td>
                    <td class="ltr-num">50.00</td>
                    <td class="ltr-num">50.00</td>
                    <td class="ltr-num">207.17</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="{{ route('company.office-details') }}" class="office-name">N2-Al-Olaya</a>
                    </td>
                    <td class="cell-fraction" data-order="1"><b>1</b> <span>(0)</span></td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="{{ route('company.office-details') }}" class="office-name">N2 - Tuwaiq, Riyadh</a>
                    </td>
                    <td class="cell-fraction" data-order="1"><b>1</b> <span>(1)</span></td>
                    <td class="ltr-num">50.00</td>
                    <td class="ltr-num">50.00</td>
                    <td class="ltr-num">147.61</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="{{ route('company.office-details') }}" class="office-name">{{ __('company.common.460') }}</a>
                    </td>
                    <td class="cell-fraction" data-order="0"><b>0</b> <span>(0)</span></td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="{{ route('company.office-details') }}" class="office-name"
                        >N2 Rental Car - RUH Airport T2</a
                      >
                    </td>
                    <td class="cell-fraction" data-order="0"><b>0</b> <span>(0)</span></td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="{{ route('company.office-details') }}" class="office-name"
                        >N2 Rental Car - RUH Airport T1</a
                      >
                    </td>
                    <td class="cell-fraction" data-order="0"><b>0</b> <span>(0)</span></td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="{{ route('company.office-details') }}" class="office-name"
                        >N2 Rental Car - RUH Airport T3</a
                      >
                    </td>
                    <td class="cell-fraction" data-order="0"><b>0</b> <span>(0)</span></td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="{{ route('company.office-details') }}" class="office-name"
                        >N2 Rental Car - Riyadh - Al Aziziyah</a
                      >
                    </td>
                    <td class="cell-fraction" data-order="0"><b>0</b> <span>(0)</span></td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                  </tr>
                  <tr>
                    <td>
                      <a href="{{ route('company.office-details') }}" class="office-name"
                        >N2 Rental Car - Riyadh -Exit 27, Al-Awali</a
                      >
                    </td>
                    <td class="cell-fraction" data-order="0"><b>0</b> <span>(0)</span></td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
                    <td class="ltr-num">0.00</td>
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
      id="officeFilterModal"
      tabindex="-1"
      aria-labelledby="officeFilterModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="officeFilterModalLabel">
              <i class="bi bi-sliders"></i> {{ __('company.common.304') }}</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body">
            <form id="officeFilterForm">
              <div class="form-grid" style="grid-template-columns: 1fr 1fr; gap: 16px">
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.common.138') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="officeNameSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="officeNameSelectValue"
                        >{{ __('company.common.115') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu"
                      id="officeNameDropdownMenu"
                      aria-labelledby="officeNameSelectBtn"
                    >
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input
                            type="search"
                             placeholder="{{ __('company.common.260') }}"
                            id="officeNameSearchInput"
                          />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input
                              type="checkbox"
                              data-office="riyadh"
                              data-label="N2 Rental Car - Riyadh - Almarwa"
                            />
                            <span class="checkbox-custom"></span>
                            N2 Rental Car - Riyadh - Almarwa
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-office="olaya" data-label="N2-Al-Olaya" />
                            <span class="checkbox-custom"></span>
                            N2-Al-Olaya
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-office="utaik" data-label="N2 فرع العتيق" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.common.49') }}</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.pages.dashboard.17') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="bookingsSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="bookingsSelectValue"
                        >{{ __('company.common.109') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu"
                      id="bookingsDropdownMenu"
                      aria-labelledby="bookingsSelectBtn"
                    >
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input
                            type="search"
                             placeholder="{{ __('company.common.257') }}"
                            id="bookingsSearchInput"
                          />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-bookings="high" data-label="عالي (10+)" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.dashboard.20') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input
                              type="checkbox"
                              data-bookings="medium"
                              data-label="متوسط (5-10)"
                            />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.dashboard.21') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input
                              type="checkbox"
                              data-bookings="low"
                              data-label="منخفض (أقل من 5)"
                            />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.dashboard.22') }}</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.pages.dashboard.5') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="acceptanceRateSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="acceptanceRateSelectValue"
                        >{{ __('company.pages.dashboard.23') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu"
                      id="acceptanceRateDropdownMenu"
                      aria-labelledby="acceptanceRateSelectBtn"
                    >
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input
                            type="search"
                             placeholder="{{ __('company.pages.dashboard.32') }}"
                            id="acceptanceRateSearchInput"
                          />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-rate="high" data-label="عالي (80%+)" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.dashboard.24') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-rate="medium" data-label="متوسط (50-80%)" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.dashboard.25') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input
                              type="checkbox"
                              data-rate="low"
                              data-label="منخفض (أقل من 50%)"
                            />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.dashboard.26') }}</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.pages.dashboard.18') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="responseRateSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="responseRateSelectValue"
                        >{{ __('company.pages.dashboard.23') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu"
                      id="responseRateDropdownMenu"
                      aria-labelledby="responseRateSelectBtn"
                    >
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input
                            type="search"
                             placeholder="{{ __('company.pages.dashboard.32') }}"
                            id="responseRateSearchInput"
                          />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-response="high" data-label="عالي (80%+)" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.dashboard.24') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input
                              type="checkbox"
                              data-response="medium"
                              data-label="متوسط (50-80%)"
                            />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.dashboard.25') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input
                              type="checkbox"
                              data-response="low"
                              data-label="منخفض (أقل من 50%)"
                            />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.dashboard.26') }}</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.pages.dashboard.19') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="revenueRangeSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="revenueRangeSelectValue"
                        >{{ __('company.common.117') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu"
                      id="revenueRangeDropdownMenu"
                      aria-labelledby="revenueRangeSelectBtn"
                    >
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input
                            type="search"
                             placeholder="{{ __('company.common.262') }}"
                            id="revenueRangeSearchInput"
                          />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input
                              type="checkbox"
                              data-revenue="high"
                              data-label="عالي (10,000+)"
                            />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.dashboard.27') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input
                              type="checkbox"
                              data-revenue="medium"
                              data-label="متوسط (5,000-10,000)"
                            />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.dashboard.28') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input
                              type="checkbox"
                              data-revenue="low"
                              data-label="منخفض (أقل من 5,000)"
                            />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.dashboard.29') }}</label>
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

@push('libs')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.45.2/dist/apexcharts.min.js"></script>
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
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

        /* ---- Multi-select dropdown logic (اسم المكتب) ---- */
        var selectedOfficeNames = [];
        var officeNameSelectBtn = document.getElementById('officeNameSelectBtn');
        var officeNameSelectValue = document.getElementById('officeNameSelectValue');
        var officeNameDropdownMenu = document.getElementById('officeNameDropdownMenu');
        var officeNameSearchInput = document.getElementById('officeNameSearchInput');

        if (officeNameDropdownMenu) {
          officeNameDropdownMenu
            .querySelectorAll('input[type="checkbox"][data-office]')
            .forEach(function (cb) {
              cb.addEventListener('change', function () {
                var office = this.getAttribute('data-office');
                var label = this.getAttribute('data-label');
                if (this.checked) {
                  if (
                    !selectedOfficeNames.some(function (o) {
                      return o.value === office;
                    })
                  ) {
                    selectedOfficeNames.push({ value: office, label: label });
                  }
                } else {
                  selectedOfficeNames = selectedOfficeNames.filter(function (o) {
                    return o.value !== office;
                  });
                }
                updateOfficeNameDisplay();
              });
            });

          function updateOfficeNameDisplay() {
            updateMultiSelectDisplay(
              selectedOfficeNames,
              officeNameSelectBtn,
              officeNameSelectValue,
              'اختر المكتب',
            );
          }

          officeNameSearchInput.addEventListener('click', function (e) {
            e.stopPropagation();
          });
          officeNameSearchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            officeNameDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
              var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
              li.style.display = label.includes(q) ? '' : 'none';
            });
          });

          officeNameSelectBtn.addEventListener('hidden.bs.dropdown', function () {
            officeNameSearchInput.value = '';
            officeNameDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
              li.style.display = '';
            });
          });
        }

        /* ---- Multi-select dropdown logic (الحجوزات) ---- */
        var selectedBookings = [];
        var bookingsSelectBtn = document.getElementById('bookingsSelectBtn');
        var bookingsSelectValue = document.getElementById('bookingsSelectValue');
        var bookingsDropdownMenu = document.getElementById('bookingsDropdownMenu');
        var bookingsSearchInput = document.getElementById('bookingsSearchInput');

        if (bookingsDropdownMenu) {
          bookingsDropdownMenu
            .querySelectorAll('input[type="checkbox"][data-bookings]')
            .forEach(function (cb) {
              cb.addEventListener('change', function () {
                var booking = this.getAttribute('data-bookings');
                var label = this.getAttribute('data-label');
                if (this.checked) {
                  if (
                    !selectedBookings.some(function (b) {
                      return b.value === booking;
                    })
                  ) {
                    selectedBookings.push({ value: booking, label: label });
                  }
                } else {
                  selectedBookings = selectedBookings.filter(function (b) {
                    return b.value !== booking;
                  });
                }
                updateBookingsDisplay();
              });
            });

          function updateBookingsDisplay() {
            updateMultiSelectDisplay(
              selectedBookings,
              bookingsSelectBtn,
              bookingsSelectValue,
              'اختر العدد',
            );
          }

          bookingsSearchInput.addEventListener('click', function (e) {
            e.stopPropagation();
          });
          bookingsSearchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            bookingsDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
              var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
              li.style.display = label.includes(q) ? '' : 'none';
            });
          });

          bookingsSelectBtn.addEventListener('hidden.bs.dropdown', function () {
            bookingsSearchInput.value = '';
            bookingsDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
              li.style.display = '';
            });
          });
        }

        /* ---- Multi-select dropdown logic (معدل القبول) ---- */
        var selectedAcceptanceRates = [];
        var acceptanceRateSelectBtn = document.getElementById('acceptanceRateSelectBtn');
        var acceptanceRateSelectValue = document.getElementById('acceptanceRateSelectValue');
        var acceptanceRateDropdownMenu = document.getElementById('acceptanceRateDropdownMenu');
        var acceptanceRateSearchInput = document.getElementById('acceptanceRateSearchInput');

        if (acceptanceRateDropdownMenu) {
          acceptanceRateDropdownMenu
            .querySelectorAll('input[type="checkbox"][data-rate]')
            .forEach(function (cb) {
              cb.addEventListener('change', function () {
                var rate = this.getAttribute('data-rate');
                var label = this.getAttribute('data-label');
                if (this.checked) {
                  if (
                    !selectedAcceptanceRates.some(function (r) {
                      return r.value === rate;
                    })
                  ) {
                    selectedAcceptanceRates.push({ value: rate, label: label });
                  }
                } else {
                  selectedAcceptanceRates = selectedAcceptanceRates.filter(function (r) {
                    return r.value !== rate;
                  });
                }
                updateAcceptanceRateDisplay();
              });
            });

          function updateAcceptanceRateDisplay() {
            updateMultiSelectDisplay(
              selectedAcceptanceRates,
              acceptanceRateSelectBtn,
              acceptanceRateSelectValue,
              'اختر النسبة',
            );
          }

          acceptanceRateSearchInput.addEventListener('click', function (e) {
            e.stopPropagation();
          });
          acceptanceRateSearchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            acceptanceRateDropdownMenu
              .querySelectorAll('li:not(:first-child)')
              .forEach(function (li) {
                var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
                li.style.display = label.includes(q) ? '' : 'none';
              });
          });

          acceptanceRateSelectBtn.addEventListener('hidden.bs.dropdown', function () {
            acceptanceRateSearchInput.value = '';
            acceptanceRateDropdownMenu
              .querySelectorAll('li:not(:first-child)')
              .forEach(function (li) {
                li.style.display = '';
              });
          });
        }

        /* ---- Multi-select dropdown logic (معدل الاستجابة) ---- */
        var selectedResponseRates = [];
        var responseRateSelectBtn = document.getElementById('responseRateSelectBtn');
        var responseRateSelectValue = document.getElementById('responseRateSelectValue');
        var responseRateDropdownMenu = document.getElementById('responseRateDropdownMenu');
        var responseRateSearchInput = document.getElementById('responseRateSearchInput');

        if (responseRateDropdownMenu) {
          responseRateDropdownMenu
            .querySelectorAll('input[type="checkbox"][data-response]')
            .forEach(function (cb) {
              cb.addEventListener('change', function () {
                var response = this.getAttribute('data-response');
                var label = this.getAttribute('data-label');
                if (this.checked) {
                  if (
                    !selectedResponseRates.some(function (r) {
                      return r.value === response;
                    })
                  ) {
                    selectedResponseRates.push({
                      value: response,
                      label: label,
                    });
                  }
                } else {
                  selectedResponseRates = selectedResponseRates.filter(function (r) {
                    return r.value !== response;
                  });
                }
                updateResponseRateDisplay();
              });
            });

          function updateResponseRateDisplay() {
            updateMultiSelectDisplay(
              selectedResponseRates,
              responseRateSelectBtn,
              responseRateSelectValue,
              'اختر النسبة',
            );
          }

          responseRateSearchInput.addEventListener('click', function (e) {
            e.stopPropagation();
          });
          responseRateSearchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            responseRateDropdownMenu
              .querySelectorAll('li:not(:first-child)')
              .forEach(function (li) {
                var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
                li.style.display = label.includes(q) ? '' : 'none';
              });
          });

          responseRateSelectBtn.addEventListener('hidden.bs.dropdown', function () {
            responseRateSearchInput.value = '';
            responseRateDropdownMenu
              .querySelectorAll('li:not(:first-child)')
              .forEach(function (li) {
                li.style.display = '';
              });
          });
        }

        /* ---- Multi-select dropdown logic (الدخل الفعلي) ---- */
        var selectedRevenueRanges = [];
        var revenueRangeSelectBtn = document.getElementById('revenueRangeSelectBtn');
        var revenueRangeSelectValue = document.getElementById('revenueRangeSelectValue');
        var revenueRangeDropdownMenu = document.getElementById('revenueRangeDropdownMenu');
        var revenueRangeSearchInput = document.getElementById('revenueRangeSearchInput');

        if (revenueRangeDropdownMenu) {
          revenueRangeDropdownMenu
            .querySelectorAll('input[type="checkbox"][data-revenue]')
            .forEach(function (cb) {
              cb.addEventListener('change', function () {
                var revenue = this.getAttribute('data-revenue');
                var label = this.getAttribute('data-label');
                if (this.checked) {
                  if (
                    !selectedRevenueRanges.some(function (r) {
                      return r.value === revenue;
                    })
                  ) {
                    selectedRevenueRanges.push({
                      value: revenue,
                      label: label,
                    });
                  }
                } else {
                  selectedRevenueRanges = selectedRevenueRanges.filter(function (r) {
                    return r.value !== revenue;
                  });
                }
                updateRevenueRangeDisplay();
              });
            });

          function updateRevenueRangeDisplay() {
            updateMultiSelectDisplay(
              selectedRevenueRanges,
              revenueRangeSelectBtn,
              revenueRangeSelectValue,
              'اختر النطاق',
            );
          }

          revenueRangeSearchInput.addEventListener('click', function (e) {
            e.stopPropagation();
          });
          revenueRangeSearchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            revenueRangeDropdownMenu
              .querySelectorAll('li:not(:first-child)')
              .forEach(function (li) {
                var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
                li.style.display = label.includes(q) ? '' : 'none';
              });
          });

          revenueRangeSelectBtn.addEventListener('hidden.bs.dropdown', function () {
            revenueRangeSearchInput.value = '';
            revenueRangeDropdownMenu
              .querySelectorAll('li:not(:first-child)')
              .forEach(function (li) {
                li.style.display = '';
              });
          });
        }

        /* ---- Multi-select dropdown logic (التقييم) ---- */
        var selectedRatings = [];
        var ratingSelectBtn = document.getElementById('ratingSelectBtn');
        var ratingSelectValue = document.getElementById('ratingSelectValue');
        var ratingDropdownMenu = document.getElementById('ratingDropdownMenu');
        var ratingSearchInput = document.getElementById('ratingSearchInput');

        if (ratingDropdownMenu) {
          ratingDropdownMenu
            .querySelectorAll('input[type="checkbox"][data-rating]')
            .forEach(function (cb) {
              cb.addEventListener('change', function () {
                var rating = this.getAttribute('data-rating');
                var label = this.getAttribute('data-label');
                if (this.checked) {
                  if (
                    !selectedRatings.some(function (r) {
                      return r.value === rating;
                    })
                  ) {
                    selectedRatings.push({ value: rating, label: label });
                  }
                } else {
                  selectedRatings = selectedRatings.filter(function (r) {
                    return r.value !== rating;
                  });
                }
                updateRatingDisplay();
              });
            });

          function updateRatingDisplay() {
            updateMultiSelectDisplay(
              selectedRatings,
              ratingSelectBtn,
              ratingSelectValue,
              'اختر التقييم',
            );
          }

          ratingSearchInput.addEventListener('click', function (e) {
            e.stopPropagation();
          });
          ratingSearchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            ratingDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
              var label = li.querySelector('input').getAttribute('data-label').toLowerCase();
              li.style.display = label.includes(q) ? '' : 'none';
            });
          });

          ratingSelectBtn.addEventListener('hidden.bs.dropdown', function () {
            ratingSearchInput.value = '';
            ratingDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
              li.style.display = '';
            });
          });
        }
      });
    </script>
@endpush

