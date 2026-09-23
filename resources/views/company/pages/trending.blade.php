@extends('company.layouts.master')

@section('title', 'T-Car — التريند')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.trending.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.214') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.pages.trending.0') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
              <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#trendingRequestModal"
                data-trending-action="add"
              >
                <i class="bi bi-graph-up-arrow" aria-hidden="true"></i>
                {{ __('company.pages.trending.1') }}</button>
            </div>
          </div>

          <div class="notice-banner" role="note">
            <div class="notice-banner__body">
              <i class="bi bi-lightning-charge-fill notice-banner__icon" aria-hidden="true"></i>
              <div class="notice-banner__text">
                <strong>{{ __('company.pages.trending.2') }}</strong>
                {{ __('company.pages.trending.3') }}</div>
            </div>
          </div>

          <div class="table-card mb-4" id="trendingTableCard">
            

            <div class="table-filter-bar discount-filter-bar">
              <div class="table-filter-bar__left">
                <div class="discount-filter-field">
                  <label for="trendingStatusFilter">{{ __('company.common.165') }}</label>
                  <select id="trendingStatusFilter" class="discount-filter-control">
                    <option value="all">{{ __('company.common.478') }}</option>
                    <option value="pending">{{ __('company.common.251') }}</option>
                    <option value="accepted">{{ __('company.common.545') }}</option>
                    <option value="active">{{ __('company.common.561') }}</option>
                    <option value="expired">{{ __('company.common.556') }}</option>
                    <option value="paused">{{ __('company.common.497') }}</option>
                  </select>
                </div>
                <div class="discount-filter-field">
                  <label for="trendingDateFilter">{{ __('company.common.157') }}</label>
                  <input
                    type="date"
                    id="trendingDateFilter"
                    class="discount-filter-control ltr-num"
                  />
                </div>
                <button type="button" class="btn btn-outline btn-sm" id="clearTrendingFilters">
                  <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                  {{ __('company.common.525') }}</button>
              </div>
              <div class="table-search">
                <i class="bi bi-search" aria-hidden="true"></i>
                <input type="search" id="trendingSearchInput"  placeholder="{{ __('company.pages.trending.27') }}" />
              </div>
            </div>

            <div class="table-responsive-custom" id="trendingTableWrapper">
              <table class="data-table discounts-table trending-table" id="trendingTable">
                <thead>
                  <tr>
                    <th>{{ __('company.pages.trending.4') }}</th>
                    <th>{{ __('company.common.441') }}</th>
                    <th>{{ __('company.common.286') }}</th>
                    <th>{{ __('company.pages.trending.5') }}</th>
                    <th>{{ __('company.common.165') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody id="trendingTableBody">
                  <tr
                    data-trending-row="TRD-004"
                    data-request-date="2026-08-22"
                    data-days="7"
                    data-start-date="2026-08-24"
                    data-end-date="2026-08-30"
                    data-cost="840"
                    data-status="pending"
                  >
                    <td><strong class="ltr-num">22/08/2026</strong></td>
                    <td><strong>{{ __('company.pages.trending.6') }}</strong></td>
                    <td><strong class="ltr-num">24/08/2026</strong></td>
                    <td><strong class="trending-cost ltr-num">{{ __('company.pages.trending.7') }}</strong></td>
                    <td>
                      <span class="discount-status trending-status--pending">
                        <i class="bi bi-hourglass-split"></i>{{ __('company.common.251') }}</span>
                    </td>
                    <td class="cell-actions">
                      <div class="action-menu-wrapper">
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                             aria-label="{{ __('company.pages.trending.28') }}"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                class="dropdown-item action-menu-item"
                                type="button"
                                data-trending-row-action="view"
                              >
                                <i class="bi bi-eye"></i> {{ __('company.common.444') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item"
                                type="button"
                                data-trending-row-action="edit"
                              >
                                <i class="bi bi-pencil"></i> {{ __('company.common.309') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item"
                                type="button"
                                data-trending-row-action="pause"
                              >
                                <i class="bi bi-pause-circle"></i> {{ __('company.common.98') }}</button>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-danger"
                                type="button"
                                data-trending-row-action="delete"
                              >
                                <i class="bi bi-trash3"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-trending-row="TRD-003"
                    data-request-date="2026-08-18"
                    data-days="5"
                    data-start-date="2026-09-02"
                    data-end-date="2026-09-06"
                    data-cost="600"
                    data-status="accepted"
                  >
                    <td><strong class="ltr-num">18/08/2026</strong></td>
                    <td><strong>{{ __('company.common.37') }}</strong></td>
                    <td><strong class="ltr-num">02/09/2026</strong></td>
                    <td><strong class="trending-cost ltr-num">{{ __('company.pages.trending.8') }}</strong></td>
                    <td>
                      <span class="discount-status trending-status--accepted">
                        <i class="bi bi-check2-circle"></i>{{ __('company.common.545') }}</span>
                    </td>
                    <td class="cell-actions">
                      <div class="action-menu-wrapper">
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                             aria-label="{{ __('company.pages.trending.28') }}"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                class="dropdown-item action-menu-item"
                                type="button"
                                data-trending-row-action="view"
                              >
                                <i class="bi bi-eye"></i> {{ __('company.common.444') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item"
                                type="button"
                                data-trending-row-action="edit"
                              >
                                <i class="bi bi-pencil"></i> {{ __('company.common.309') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item"
                                type="button"
                                data-trending-row-action="pause"
                              >
                                <i class="bi bi-pause-circle"></i> {{ __('company.common.98') }}</button>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-danger"
                                type="button"
                                data-trending-row-action="delete"
                              >
                                <i class="bi bi-trash3"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-trending-row="TRD-002"
                    data-request-date="2026-08-15"
                    data-days="10"
                    data-start-date="2026-08-19"
                    data-end-date="2026-08-28"
                    data-cost="1200"
                    data-status="active"
                  >
                    <td><strong class="ltr-num">15/08/2026</strong></td>
                    <td><strong>{{ __('company.pages.trending.9') }}</strong></td>
                    <td><strong class="ltr-num">19/08/2026</strong></td>
                    <td><strong class="trending-cost ltr-num">{{ __('company.pages.trending.10') }}</strong></td>
                    <td>
                      <span class="discount-status trending-status--active">
                        <i class="bi bi-lightning-charge-fill"></i>{{ __('company.common.561') }}</span>
                    </td>
                    <td class="cell-actions">
                      <div class="action-menu-wrapper">
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                             aria-label="{{ __('company.pages.trending.28') }}"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                class="dropdown-item action-menu-item"
                                type="button"
                                data-trending-row-action="view"
                              >
                                <i class="bi bi-eye"></i> {{ __('company.common.444') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item"
                                type="button"
                                data-trending-row-action="edit"
                              >
                                <i class="bi bi-pencil"></i> {{ __('company.common.309') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item"
                                type="button"
                                data-trending-row-action="pause"
                              >
                                <i class="bi bi-pause-circle"></i> {{ __('company.common.98') }}</button>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-danger"
                                type="button"
                                data-trending-row-action="delete"
                              >
                                <i class="bi bi-trash3"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-trending-row="TRD-001"
                    data-request-date="2026-07-20"
                    data-days="4"
                    data-start-date="2026-07-25"
                    data-end-date="2026-07-28"
                    data-cost="480"
                    data-status="expired"
                  >
                    <td><strong class="ltr-num">20/07/2026</strong></td>
                    <td><strong>{{ __('company.common.34') }}</strong></td>
                    <td><strong class="ltr-num">25/07/2026</strong></td>
                    <td><strong class="trending-cost ltr-num">{{ __('company.pages.trending.11') }}</strong></td>
                    <td>
                      <span class="discount-status trending-status--expired">
                        <i class="bi bi-clock-history"></i>{{ __('company.common.556') }}</span>
                    </td>
                    <td class="cell-actions">
                      <div class="action-menu-wrapper">
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                             aria-label="{{ __('company.pages.trending.28') }}"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                class="dropdown-item action-menu-item"
                                type="button"
                                data-trending-row-action="view"
                              >
                                <i class="bi bi-eye"></i> {{ __('company.common.444') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item"
                                type="button"
                                data-trending-row-action="edit"
                              >
                                <i class="bi bi-pencil"></i> {{ __('company.common.309') }}</button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item"
                                type="button"
                                data-trending-row-action="pause"
                              >
                                <i class="bi bi-pause-circle"></i> {{ __('company.common.98') }}</button>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                              <button
                                class="dropdown-item action-menu-item text-danger"
                                type="button"
                                data-trending-row-action="delete"
                              >
                                <i class="bi bi-trash3"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="empty-state trending-empty-state" id="trendingEmptyState" hidden>
              <i class="bi bi-search" aria-hidden="true"></i>
              <p>{{ __('company.pages.trending.12') }}</p>
            </div>

            <div class="table-pagination table-pagination-dt">
              <div class="table-pagination__size-select">
                <label for="trendingPageSize">{{ __('company.common.212') }}</label>
                <select id="trendingPageSize">
                  <option value="3" selected>3</option>
                  <option value="5">5</option>
                  <option value="10">10</option>
                </select>
              </div>
              <div
                class="table-pagination__pages"
                id="trendingPagination"
                 aria-label="{{ __('company.pages.trending.29') }}"
              ></div>
            </div>
          </div>
@endsection

@push('modals')
</main>
        
      

    <div
      class="modal fade"
      id="trendingRequestModal"
      tabindex="-1"
      aria-labelledby="trendingRequestModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content trending-request-modal">
          <form id="trendingRequestForm" novalidate>
            <input type="hidden" id="trendingRecordId" />
            <div class="modal-header">
              <div>
                <h2 class="modal-title fs-5" id="trendingRequestModalLabel">{{ __('company.pages.trending.1') }}</h2>
                <p class="trending-modal-subtitle">{{ __('company.pages.trending.13') }}</p>
              </div>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                 aria-label="{{ __('company.common.92') }}"
              ></button>
            </div>
            <div class="modal-body">
              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <div class="form-field">
                    <label class="form-field__label" for="trendingDays">
                      {{ __('company.pages.trending.14') }}<span class="text-danger">*</span>
                    </label>
                    <input
                      class="form-field__input ltr-num"
                      id="trendingDays"
                      type="number"
                      min="1"
                      step="1"
                      value="7"
                      required
                    />
                    <div class="invalid-feedback">{{ __('company.pages.trending.15') }}</div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-field">
                    <label class="form-field__label" for="trendingStartDate">
                      {{ __('company.common.286') }}<span class="text-danger">*</span>
                    </label>
                    <input
                      class="form-field__input ltr-num"
                      id="trendingStartDate"
                      type="date"
                      required
                    />
                    <div class="invalid-feedback">{{ __('company.pages.trending.16') }}</div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-field">
                    <label class="form-field__label" for="trendingDailyPrice">{{ __('company.pages.trending.17') }}</label>
                    <div class="trending-readonly-field">
                      <input
                        class="form-field__input ltr-num"
                        id="trendingDailyPrice"
                        type="text"
                        value="120.00 ر.س"
                        data-price="120"
                        readonly
                      />
                      <i class="bi bi-lock-fill" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-field">
                    <label class="form-field__label" for="trendingCalculatedEndDate">
                      {{ __('company.pages.trending.18') }}</label>
                    <input
                      class="form-field__input ltr-num"
                      id="trendingCalculatedEndDate"
                      type="text"
                      value="—"
                      readonly
                    />
                  </div>
                </div>
              </div>

              <div class="trending-total-card" aria-live="polite">
                <span>{{ __('company.pages.trending.5') }}</span>
                <strong class="ltr-num" id="trendingCalculatedCost">{{ __('company.pages.trending.7') }}</strong>
                <small>{{ __('company.pages.trending.19') }}</small>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-send" aria-hidden="true"></i>
                <span id="trendingSubmitLabel">{{ __('company.pages.trending.20') }}</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="trendingDetailsModal"
      tabindex="-1"
      aria-labelledby="trendingDetailsModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title fs-5" id="trendingDetailsModalLabel">{{ __('company.pages.trending.21') }}</h2>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body" id="trendingDetailsContent"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.92') }}</button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="deleteTrendingModal"
      tabindex="-1"
      aria-labelledby="deleteTrendingModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content confirm-modal">
          <div class="modal-body text-center p-4">
            <div class="confirm-modal__icon confirm-modal__icon--danger">
              <i class="bi bi-trash3" aria-hidden="true"></i>
            </div>
            <h2 class="confirm-modal__title" id="deleteTrendingModalLabel">{{ __('company.pages.trending.22') }}</h2>
            <p class="confirm-modal__text">
              {{ __('company.pages.trending.23') }}<strong class="ltr-num" id="deleteTrendingRecordId"></strong> {{ __('company.common.568') }}</p>
            <div class="d-flex justify-content-center gap-2 mt-3">
              <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
              <button type="button" class="btn btn-danger" id="confirmDeleteTrending">{{ __('company.common.370') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="trendingSuccessModal"
      tabindex="-1"
      aria-labelledby="trendingSuccessModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content confirm-modal">
          <div class="modal-body text-center p-4">
            <div class="confirm-modal__icon confirm-modal__icon--success">
              <i class="bi bi-check-lg" aria-hidden="true"></i>
            </div>
            <h2 class="confirm-modal__title" id="trendingSuccessModalLabel">{{ __('company.pages.trending.24') }}</h2>
            <p class="confirm-modal__text">{{ __('company.pages.trending.25') }}</p>
            <button type="button" class="btn btn-primary mt-3" data-bs-dismiss="modal">{{ __('company.pages.trending.26') }}</button>
          </div>
        </div>
      </div>
    </div>

    
@endpush

