@extends('company.layouts.master')

@section('title', 'T-Car — قائمة السيارات في المكتب')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.office-cars.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('company.branches') }}">{{ __('company.pages.office-cars.1') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.pages.office-cars.0') }}</span>
              </nav>
            </div>
          </div>

          
          <div class="office-info-header mb-4">
            <div class="office-info-header__left">
              <h2 class="office-info-header__title">{{ __('company.common.49') }}</h2>
              <p class="office-info-header__subtitle">{{ __('company.pages.office-cars.2') }}</p>
            </div>
            <div class="office-info-header__right">
              <a href="{{ route('company.add-car') }}" class="btn btn-primary"
                ><i class="bi bi-car-front"></i> {{ __('company.common.85') }}</a
              >
              <button class="btn btn-outline">
                <i class="bi bi-link-45deg"></i> {{ __('company.pages.office-cars.3') }}</button>
            </div>
          </div>

          
          <div class="table-card mb-4">
            <div class="table-toolbar">
              <div class="table-toolbar__left">
                <div class="view-tabs" role="tablist"  aria-label="{{ __('company.common.305') }}">
                  <button
                    type="button"
                    class="view-tabs__btn is-active"
                    role="tab"
                    aria-selected="true"
                  >
                    {{ __('company.common.223') }}</button>
                  <button type="button" class="view-tabs__btn" role="tab" aria-selected="false">
                    {{ __('company.common.544') }}</button>
                  <button type="button" class="view-tabs__btn" role="tab" aria-selected="false">
                    {{ __('company.common.455') }}</button>
                </div>
              </div>
            </div>

            <div class="table-filter-bar">
              <div class="table-filter-bar__left">
                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    {{ __('company.common.207') }}<i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">{{ __('company.common.354') }}</span>
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">{{ __('company.common.575') }}</span>
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">{{ __('company.common.586') }}</span>
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">{{ __('company.common.488') }}</span>
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">{{ __('company.common.468') }}</span>
                        </label>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    {{ __('company.common.241') }}<i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">{{ __('company.common.474') }}</span>
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">{{ __('company.common.487') }}</span>
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">{{ __('company.pages.office-cars.4') }}</span>
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">{{ __('company.pages.office-cars.5') }}</span>
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">{{ __('company.pages.office-cars.6') }}</span>
                        </label>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    {{ __('company.common.201') }}<i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">2024</span>
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">2023</span>
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">2022</span>
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">2021</span>
                        </label>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-item">
                        <label class="checkbox-option">
                          <input type="checkbox" checked />
                          <span class="checkbox-custom"></span>
                          <span class="checkbox-label">2020</span>
                        </label>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search"  placeholder="{{ __('company.common.255') }}" />
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="office-table" id="officeCarsTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.207') }}</th>
                    <th>{{ __('company.common.241') }}</th>
                    <th>{{ __('company.common.201') }}</th>
                    <th>{{ __('company.common.496') }}</th>
                    <th>{{ __('company.pages.office-cars.7') }}</th>
                    <th>{{ __('company.common.165') }}</th>
                    <th>{{ __('company.common.76') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ __('company.common.354') }}</td>
                    <td>{{ __('company.common.474') }}</td>
                    <td class="ltr-num">2024</td>
                    <td class="ltr-num">5</td>
                    <td class="ltr-num">2</td>
                    <td>
                      <button class="status-toggle status-toggle--active" data-status="active">
                        {{ __('company.common.544') }}</button>
                    </td>
                    <td class="cell-actions">
                      <div class="action-menu-wrapper">
                        <a href="{{ route('company.add-car') }}" class="btn btn-primary btn-sm"  title="{{ __('company.common.309') }}"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <button class="action-menu-btn"  title="{{ __('company.common.384') }}">
                          <i class="bi bi-three-dots"></i>
                        </button>
                        <div class="action-menu-dropdown">
                          <button class="action-menu-item" data-action="availability">
                            <i class="bi bi-check-circle"></i> {{ __('company.common.353') }}</button>
                          <button class="action-menu-item" data-action="logs">
                            <i class="bi bi-clock-history"></i> {{ __('company.pages.office-cars.8') }}</button>
                          <button class="action-menu-item">
                            <i class="bi bi-copy"></i> {{ __('company.pages.office-cars.9') }}</button>
                          <button class="action-menu-item"><i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>{{ __('company.common.575') }}</td>
                    <td>{{ __('company.pages.office-cars.4') }}</td>
                    <td class="ltr-num">2023</td>
                    <td class="ltr-num">3</td>
                    <td class="ltr-num">1</td>
                    <td>
                      <button class="status-toggle status-toggle--inactive" data-status="inactive">
                        {{ __('company.common.455') }}</button>
                    </td>
                    <td class="cell-actions">
                      <div class="action-menu-wrapper">
                        <a href="{{ route('company.add-car') }}" class="btn btn-primary btn-sm"  title="{{ __('company.common.309') }}"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <button class="action-menu-btn"  title="{{ __('company.common.384') }}">
                          <i class="bi bi-three-dots"></i>
                        </button>
                        <div class="action-menu-dropdown">
                          <button class="action-menu-item" data-action="availability">
                            <i class="bi bi-check-circle"></i> {{ __('company.common.353') }}</button>
                          <button class="action-menu-item" data-action="logs">
                            <i class="bi bi-clock-history"></i> {{ __('company.pages.office-cars.8') }}</button>
                          <button class="action-menu-item">
                            <i class="bi bi-copy"></i> {{ __('company.pages.office-cars.9') }}</button>
                          <button class="action-menu-item"><i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>{{ __('company.common.586') }}</td>
                    <td>{{ __('company.pages.office-cars.5') }}</td>
                    <td class="ltr-num">2024</td>
                    <td class="ltr-num">4</td>
                    <td class="ltr-num">2</td>
                    <td>
                      <button class="status-toggle status-toggle--active" data-status="active">
                        {{ __('company.common.544') }}</button>
                    </td>
                    <td class="cell-actions">
                      <div class="action-menu-wrapper">
                        <a href="{{ route('company.add-car') }}" class="btn btn-primary btn-sm"  title="{{ __('company.common.309') }}"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <button class="action-menu-btn"  title="{{ __('company.common.384') }}">
                          <i class="bi bi-three-dots"></i>
                        </button>
                        <div class="action-menu-dropdown">
                          <button class="action-menu-item" data-action="availability">
                            <i class="bi bi-check-circle"></i> {{ __('company.common.353') }}</button>
                          <button class="action-menu-item" data-action="logs">
                            <i class="bi bi-clock-history"></i> {{ __('company.pages.office-cars.8') }}</button>
                          <button class="action-menu-item">
                            <i class="bi bi-copy"></i> {{ __('company.pages.office-cars.9') }}</button>
                          <button class="action-menu-item"><i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>{{ __('company.common.354') }}</td>
                    <td>{{ __('company.common.487') }}</td>
                    <td class="ltr-num">2023</td>
                    <td class="ltr-num">6</td>
                    <td class="ltr-num">3</td>
                    <td>
                      <button class="status-toggle status-toggle--active" data-status="active">
                        {{ __('company.common.544') }}</button>
                    </td>
                    <td class="cell-actions">
                      <div class="action-menu-wrapper">
                        <a href="{{ route('company.add-car') }}" class="btn btn-primary btn-sm"  title="{{ __('company.common.309') }}"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <button class="action-menu-btn"  title="{{ __('company.common.384') }}">
                          <i class="bi bi-three-dots"></i>
                        </button>
                        <div class="action-menu-dropdown">
                          <button class="action-menu-item" data-action="availability">
                            <i class="bi bi-check-circle"></i> {{ __('company.common.353') }}</button>
                          <button class="action-menu-item" data-action="logs">
                            <i class="bi bi-clock-history"></i> {{ __('company.pages.office-cars.8') }}</button>
                          <button class="action-menu-item">
                            <i class="bi bi-copy"></i> {{ __('company.pages.office-cars.9') }}</button>
                          <button class="action-menu-item"><i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>{{ __('company.common.488') }}</td>
                    <td>{{ __('company.pages.office-cars.6') }}</td>
                    <td class="ltr-num">2024</td>
                    <td class="ltr-num">2</td>
                    <td class="ltr-num">1</td>
                    <td>
                      <button class="status-toggle status-toggle--inactive" data-status="inactive">
                        {{ __('company.common.455') }}</button>
                    </td>
                    <td class="cell-actions">
                      <div class="action-menu-wrapper">
                        <a href="{{ route('company.add-car') }}" class="btn btn-primary btn-sm"  title="{{ __('company.common.309') }}"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <button class="action-menu-btn"  title="{{ __('company.common.384') }}">
                          <i class="bi bi-three-dots"></i>
                        </button>
                        <div class="action-menu-dropdown">
                          <button class="action-menu-item" data-action="availability">
                            <i class="bi bi-check-circle"></i> {{ __('company.common.353') }}</button>
                          <button class="action-menu-item" data-action="logs">
                            <i class="bi bi-clock-history"></i> {{ __('company.pages.office-cars.8') }}</button>
                          <button class="action-menu-item">
                            <i class="bi bi-copy"></i> {{ __('company.pages.office-cars.9') }}</button>
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
                <button class="table-pagination__page-btn">3</button>
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
      id="carAvailabilityModal"
      tabindex="-1"
      aria-labelledby="carAvailabilityModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content availability-modal">
          <div class="availability-modal__header">
            <h5 class="availability-modal__header__title" id="carAvailabilityModalLabel">
              {{ __('company.common.352') }}</h5>
            <button
              type="button"
              class="availability-modal__header__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>

          <div class="availability-modal__body">
            <div class="availability-summary">
              <div class="availability-car-chip">
                <div class="availability-car-chip__thumb"><img src="{{ asset('company/img/car.png') }}" alt="Car" /></div>
                <div class="availability-car-chip__text">
                  <span class="availability-car-chip__name" id="availCarName"
                    >{{ __('company.common.585') }}</span
                  >
                  <span class="availability-car-chip__sub" id="availCarSub">{{ __('company.common.582') }}</span>
                </div>
              </div>
              <div class="availability-stat">
                <span class="availability-stat__value" id="availTotalCount">1</span>
                <span class="availability-stat__label">Total available</span>
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="availability-table">
                <thead>
                  <tr>
                    <th>{{ __('company.common.431') }}</th>
                    <th>{{ __('company.common.547') }}</th>
                    <th>{{ __('company.common.517') }}</th>
                    <th>{{ __('company.common.227') }}</th>
                    
                  </tr>
                </thead>
                <tbody id="availabilityTableBody">
                  <tr>
                    <td class="cell-office-name">N2</td>
                    <td>{{ __('company.common.49') }}</td>
                    <td>{{ __('company.common.183') }}</td>
                    <td>
                      <span class="cell-available-count"><i class="bi bi-car-front"></i> 1</span>
                    </td>
                    
                  </tr>
                  <tr>
                    <td class="cell-office-name">N2</td>
                    <td>N2-Al-Olaya</td>
                    <td>{{ __('company.common.183') }}</td>
                    <td>
                      <span class="cell-available-count"><i class="bi bi-car-front"></i> 0</span>
                    </td>
                    
                  </tr>
                  <tr>
                    <td class="cell-office-name">N2</td>
                    <td>N2 Rental Car - Rawdah</td>
                    <td>{{ __('company.common.183') }}</td>
                    <td>
                      <span class="cell-available-count"><i class="bi bi-car-front"></i> 0</span>
                    </td>
                    
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="availability-modal__footer">
            <button type="button" class="link-cancel" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
            <button type="button" class="btn btn-primary" id="availSaveBtn">{{ __('company.common.375') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="carLogsModal"
      tabindex="-1"
      aria-labelledby="carLogsModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content car-logs-modal">
          <div class="car-logs-modal__header">
            <h5 class="car-logs-modal__header__title" id="carLogsModalLabel">
              {{ __('company.pages.office-cars.8') }}</h5>
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
                id="logsScrollUpBtn"
                 aria-label="{{ __('company.common.344') }}"
              >
                <i class="bi bi-chevron-up"></i>
              </button>
              <div class="car-logs-scrollctrl__track">
                <div class="car-logs-scrollctrl__thumb" id="logsScrollThumb"></div>
              </div>
              <button
                type="button"
                class="car-logs-scrollctrl__btn"
                id="logsScrollDownBtn"
                 aria-label="{{ __('company.common.343') }}"
              >
                <i class="bi bi-chevron-down"></i>
              </button>
            </div>

            <div class="car-logs-table-wrap" id="carLogsTableWrap">
              <table class="car-logs-table">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.389') }}</th>
                    <th>{{ __('company.common.523') }}</th>
                    <th>{{ __('company.common.296') }}</th>
                  </tr>
                </thead>
                <tbody id="carLogsTableBody">
                  <tr>
                    <td class="log-index">100</td>
                    <td class="log-message--deactivate">{{ __('company.pages.office-cars.10') }}</td>
                    <td>{{ __('company.common.104') }}</td>
                    <td class="log-datetime ltr-num">2026-07-27 12:13:28</td>
                  </tr>
                  <tr>
                    <td class="log-index">99</td>
                    <td class="log-message--activate">{{ __('company.pages.office-cars.11') }}</td>
                    <td>{{ __('company.common.104') }}</td>
                    <td class="log-datetime ltr-num">2026-07-26 22:56:49</td>
                  </tr>
                  <tr>
                    <td class="log-index">98</td>
                    <td class="log-message--deactivate">{{ __('company.pages.office-cars.10') }}</td>
                    <td>{{ __('company.common.246') }}</td>
                    <td class="log-datetime ltr-num">2026-07-24 20:30:26</td>
                  </tr>
                  <tr>
                    <td class="log-index">97</td>
                    <td class="log-message--activate">{{ __('company.pages.office-cars.11') }}</td>
                    <td>{{ __('company.pages.office-cars.12') }}</td>
                    <td class="log-datetime ltr-num">2026-07-23 19:29:26</td>
                  </tr>
                  <tr>
                    <td class="log-index">96</td>
                    <td class="log-message--deactivate">{{ __('company.pages.office-cars.10') }}</td>
                    <td>{{ __('company.common.104') }}</td>
                    <td class="log-datetime ltr-num">2026-07-23 08:58:35</td>
                  </tr>
                  <tr>
                    <td class="log-index">95</td>
                    <td class="log-message--activate">{{ __('company.pages.office-cars.11') }}</td>
                    <td>{{ __('company.common.104') }}</td>
                    <td class="log-datetime ltr-num">2026-07-21 23:26:05</td>
                  </tr>
                  <tr>
                    <td class="log-index">94</td>
                    <td class="log-message--stock">{{ __('company.pages.office-cars.13') }}</td>
                    <td>{{ __('company.common.104') }}</td>
                    <td class="log-datetime ltr-num">2026-07-21 23:25:57</td>
                  </tr>
                  <tr>
                    <td class="log-index">93</td>
                    <td class="log-message--deactivate">{{ __('company.pages.office-cars.10') }}</td>
                    <td>n2rentalcar</td>
                    <td class="log-datetime ltr-num">2026-07-20 16:38:13</td>
                  </tr>
                  <tr>
                    <td class="log-index">92</td>
                    <td class="log-message--activate">{{ __('company.pages.office-cars.11') }}</td>
                    <td>{{ __('company.common.104') }}</td>
                    <td class="log-datetime ltr-num">2026-07-19 12:36:25</td>
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
        // Status toggle functionality
        const statusToggles = document.querySelectorAll('.status-toggle');

        statusToggles.forEach((toggle) => {
          toggle.addEventListener('click', function () {
            const currentStatus = this.getAttribute('data-status');

            if (currentStatus === 'active') {
              this.setAttribute('data-status', 'inactive');
              this.classList.remove('status-toggle--active');
              this.classList.add('status-toggle--inactive');
              this.textContent = 'غير مفعل';
            } else {
              this.setAttribute('data-status', 'active');
              this.classList.remove('status-toggle--inactive');
              this.classList.add('status-toggle--active');
              this.textContent = 'مفعل';
            }
          });
        });

        // View tabs functionality
        const viewTabs = document.querySelectorAll('.view-tabs__btn');

        viewTabs.forEach((tab) => {
          tab.addEventListener('click', function () {
            viewTabs.forEach((t) => {
              t.classList.remove('is-active');
              t.setAttribute('aria-selected', 'false');
            });

            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');

            // Filter table rows based on status
            const filterType = this.textContent.trim();
            const tableRows = document.querySelectorAll('#officeCarsTable tbody tr');

            tableRows.forEach((row) => {
              const statusToggle = row.querySelector('.status-toggle');
              if (statusToggle) {
                const rowStatus = statusToggle.getAttribute('data-status');

                if (filterType === 'الكل') {
                  row.style.display = '';
                } else if (filterType === 'مفعل' && rowStatus === 'active') {
                  row.style.display = '';
                } else if (filterType === 'غير مفعل' && rowStatus === 'inactive') {
                  row.style.display = '';
                } else {
                  row.style.display = 'none';
                }
              }
            });
          });
        });

        // Close dropdowns when clicking on dropdown items
        document.querySelectorAll('.action-menu-item').forEach((item) => {
          item.addEventListener('click', function () {
            this.closest('.action-menu-dropdown').classList.remove('is-visible');
          });
        });

        /* ============================================================
         "توفر السيارة" -> opens the Car Availability modal, populated
         with the manufacturer / model / year of the clicked row.
      ============================================================= */
        const availabilityModalEl = document.getElementById('carAvailabilityModal');
        const availabilityModal = new bootstrap.Modal(availabilityModalEl);
        const availCarName = document.getElementById('availCarName');
        const availCarSub = document.getElementById('availCarSub');
        const availTotalCount = document.getElementById('availTotalCount');

        document.querySelectorAll('[data-action="availability"]').forEach(function (btn) {
          btn.addEventListener('click', function () {
            const row = this.closest('tr');
            const make = row.children[1].textContent.trim();
            const model = row.children[2].textContent.trim();
            const year = row.children[3].textContent.trim();

            availCarName.textContent = make + ' ' + model + ' ' + year;
            availCarSub.textContent = make;

            // Sum the "المتوفر" column for this car to keep the stat consistent
            var total = 0;
            document
              .querySelectorAll('#availabilityTableBody .cell-available-count')
              .forEach(function (cell) {
                total += parseInt(cell.textContent.trim(), 10) || 0;
              });
            availTotalCount.textContent = total;

            availabilityModal.show();
          });
        });

        document.getElementById('availSaveBtn').addEventListener('click', function () {
          availabilityModal.hide();
        });

        /* ============================================================
         "سجل تعديلات السيارة" -> opens the Car Logs History modal
      ============================================================= */
        const logsModalEl = document.getElementById('carLogsModal');
        const logsModal = new bootstrap.Modal(logsModalEl);

        document.querySelectorAll('[data-action="logs"]').forEach(function (btn) {
          btn.addEventListener('click', function () {
            logsModal.show();
          });
        });

        /* Scrollable logs list: up/down buttons + a live scroll thumb */
        const logsWrap = document.getElementById('carLogsTableWrap');
        const logsThumb = document.getElementById('logsScrollThumb');

        function updateLogsThumb() {
          if (!logsWrap || !logsThumb) return;
          var trackHeight = logsWrap.clientHeight;
          var ratio = logsWrap.clientHeight / logsWrap.scrollHeight;
          var thumbHeight = Math.max(ratio * trackHeight, 24);
          var maxScroll = logsWrap.scrollHeight - logsWrap.clientHeight;
          var scrollRatio = maxScroll > 0 ? logsWrap.scrollTop / maxScroll : 0;
          logsThumb.style.height = thumbHeight + 'px';
          logsThumb.style.top = scrollRatio * (trackHeight - thumbHeight) + 'px';
        }

        logsWrap.addEventListener('scroll', updateLogsThumb);
        logsModalEl.addEventListener('shown.bs.modal', updateLogsThumb);
        window.addEventListener('resize', updateLogsThumb);

        document.getElementById('logsScrollUpBtn').addEventListener('click', function () {
          logsWrap.scrollBy({ top: -100, behavior: 'smooth' });
        });
        document.getElementById('logsScrollDownBtn').addEventListener('click', function () {
          logsWrap.scrollBy({ top: 100, behavior: 'smooth' });
        });
      });
    </script>
@endpush

