@extends('company.layouts.master')

@section('title', 'T-Car — العروض الخاصة')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.special-offers.0') }}</h1>
              <nav class="page-header__breadcrumb"  aria-label="{{ __('company.pages.special-offers.31') }}">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a><i class="bi bi-chevron-right"></i
                ><span>{{ __('company.common.214') }}</span><i class="bi bi-chevron-right"></i
                ><span class="current">{{ __('company.pages.special-offers.0') }}</span>
              </nav>
            </div>
            <div class="page-header__actions special-offer-add-action">
              <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#specialOfferFormModal"
                data-special-action="add"
              >
                <i class="bi bi-plus-lg" aria-hidden="true"></i> {{ __('company.pages.special-offers.1') }}</button>
            </div>
          </div>
          <div
            class="modal fade"
            id="specialOfferFormModal"
            tabindex="-1"
            aria-labelledby="specialOfferFormModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h2 class="modal-title fs-5" id="specialOfferFormModalLabel">{{ __('company.pages.special-offers.1') }}</h2>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                     aria-label="{{ __('company.common.92') }}"
                  ></button>
                </div>
                <div class="special-offer-layout">
                  <form id="specialOfferForm" novalidate>
                    <div class="offers-card">
                      <div class="offers-card__header">
                        <div>
                          <h2 class="offers-card__title">
                            <i class="bi bi-stars" aria-hidden="true"></i> {{ __('company.pages.special-offers.1') }}</h2>
                          <p class="offers-card__desc">
                            {{ __('company.pages.special-offers.2') }}</p>
                        </div>
                      </div>
                      <div class="offers-card__body">
                        <div class="special-offer-field">
                          <label class="form-field__label" for="specialOfferDescription"
                            >{{ __('company.pages.special-offers.3') }}<span class="text-danger">*</span></label
                          ><textarea
                            id="specialOfferDescription"
                            class="form-field__input special-offer-description"
                            maxlength="180"
                            rows="3"
                             placeholder="{{ __('company.pages.special-offers.32') }}"
                            required
                          ></textarea>
                          <div class="special-offer-counter">
                            <span id="specialOfferDescriptionCount">0</span> / 180
                          </div>
                          <div class="invalid-feedback">{{ __('company.pages.special-offers.4') }}</div>
                        </div>
                        <div data-scope-selector data-scope-name="special_offer"></div>
                        <section class="special-offer-section">
                          <h3 class="special-offer-section__title">
                            <i class="bi bi-calendar3"></i> {{ __('company.pages.special-offers.5') }}</h3>
                          <div class="special-offer-toggle" role="radiogroup">
                            <label
                              ><input
                                type="radio"
                                name="specialOfferDateMode"
                                value="single"
                                checked
                              /><span>{{ __('company.common.594') }}</span></label
                            ><label
                              ><input type="radio" name="specialOfferDateMode" value="range" /><span
                                >{{ __('company.pages.special-offers.6') }}</span
                              ></label
                            >
                          </div>
                          <div class="row g-3 mt-1">
                            <div class="col-12 col-md-6" data-special-date-single>
                              <label class="form-field__label" for="specialOfferDate">{{ __('company.common.157') }}</label
                              ><input
                                id="specialOfferDate"
                                type="date"
                                class="form-field__input ltr-num"
                                required
                              />
                            </div>
                            <div class="col-12 col-md-6" data-special-date-start hidden>
                              <label class="form-field__label" for="specialOfferStart">{{ __('company.common.555') }}</label
                              ><input
                                id="specialOfferStart"
                                type="date"
                                class="form-field__input ltr-num"
                              />
                            </div>
                            <div class="col-12 col-md-6" data-special-date-end hidden>
                              <label class="form-field__label" for="specialOfferEnd">{{ __('company.common.96') }}</label
                              ><input
                                id="specialOfferEnd"
                                type="date"
                                class="form-field__input ltr-num"
                              />
                            </div>
                          </div>
                        </section>
                        <section class="special-offer-section">
                          <h3 class="special-offer-section__title">
                            <i class="bi bi-gift"></i> {{ __('company.pages.special-offers.7') }}<span class="text-danger">*</span>
                          </h3>
                          <div class="special-offer-type-options">
                            <label
                              ><input
                                type="radio"
                                name="specialOfferType"
                                value="freeDays"
                                checked
                              /><span
                                ><i class="bi bi-calendar-heart"></i><strong>{{ __('company.pages.special-offers.8') }}</strong
                                ><small>{{ __('company.pages.special-offers.9') }}</small></span
                              ></label
                            ><label
                              ><input
                                type="radio"
                                name="specialOfferType"
                                value="deliveryDistance"
                              /><span
                                ><i class="bi bi-signpost-2"></i><strong>{{ __('company.pages.special-offers.10') }}</strong
                                ><small>{{ __('company.pages.special-offers.11') }}</small></span
                              ></label
                            >
                          </div>
                          <div class="row g-3 mt-2" data-special-free-days>
                            <div class="col-12 col-md-6">
                              <label class="form-field__label" for="requiredBookingDays"
                                >{{ __('company.pages.special-offers.12') }}</label
                              ><input
                                id="requiredBookingDays"
                                type="number"
                                min="1"
                                class="form-field__input ltr-num"
                                placeholder="4"
                              />
                              <div class="invalid-feedback">{{ __('company.pages.special-offers.13') }}</div>
                            </div>
                            <div class="col-12 col-md-6">
                              <label class="form-field__label" for="freeDays">{{ __('company.pages.special-offers.14') }}</label
                              ><input
                                id="freeDays"
                                type="number"
                                min="1"
                                class="form-field__input ltr-num"
                                placeholder="1"
                              />
                              <div class="invalid-feedback">{{ __('company.pages.special-offers.13') }}</div>
                            </div>
                            <div class="col-12">
                              <label class="special-offer-check"
                                ><input id="specialOfferRepeats" type="checkbox" />
                                <span>{{ __('company.pages.special-offers.15') }}</span></label
                              >
                              <p
                                id="repeatExample"
                                class="special-offer-hint"
                                aria-live="polite"
                              ></p>
                            </div>
                          </div>
                          <div class="row g-3 mt-2" data-special-distance hidden>
                            <div class="col-12 col-md-7">
                              <label class="form-field__label" for="deliveryDistance"
                                >{{ __('company.pages.special-offers.16') }}</label
                              ><input
                                id="deliveryDistance"
                                type="number"
                                min="61"
                                class="form-field__input ltr-num"
                                placeholder="61"
                              />
                              <div class="special-offer-hint">
                                {{ __('company.pages.special-offers.17') }}<strong>{{ __('company.pages.special-offers.18') }}</strong>
                              </div>
                              <div class="invalid-feedback">{{ __('company.pages.special-offers.19') }}</div>
                            </div>
                          </div>
                        </section>
                        <div class="scope-form-actions">
                          <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send" aria-hidden="true"></i>
                            <span id="specialOfferSubmitLabel">{{ __('company.pages.special-offers.20') }}</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="table-card mb-4" id="specialOffersTableCard">
            
            <div class="table-filter-bar discount-filter-bar">
              <div class="table-filter-bar__left">
                <div class="discount-filter-field">
                  <label for="specialOfferStatusFilter">{{ __('company.common.165') }}</label
                  ><select id="specialOfferStatusFilter" class="discount-filter-control">
                    <option value="all">{{ __('company.common.478') }}</option>
                    <option value="pending">{{ __('company.common.251') }}</option>
                    <option value="active">{{ __('company.common.544') }}</option>
                    <option value="expired">{{ __('company.common.556') }}</option>
                    <option value="paused">{{ __('company.common.497') }}</option>
                  </select>
                </div>
                <div class="discount-filter-field">
                  <label for="specialOfferDateFilter">{{ __('company.common.157') }}</label>
                  <input
                    type="date"
                    id="specialOfferDateFilter"
                    class="discount-filter-control ltr-num"
                  />
                </div>
                <button type="button" class="btn btn-outline btn-sm" id="clearSpecialOfferFilters">
                  <i class="bi bi-arrow-counterclockwise"></i> {{ __('company.common.525') }}</button>
              </div>
              <div class="table-search">
                <i class="bi bi-search"></i
                ><input type="search" id="specialOffersSearchInput"  placeholder="{{ __('company.pages.special-offers.33') }}" />
              </div>
            </div>
            <div class="table-responsive-custom">
              <table class="data-table discounts-table special-offers-table">
                <thead>
                  <tr>
                    <th>{{ __('company.common.248') }}</th>
                    <th>{{ __('company.common.245') }}</th>
                    <th>{{ __('company.common.161') }}</th>
                    <th>{{ __('company.common.244') }}</th>
                    <th>{{ __('company.common.70') }}</th>
                    <th>{{ __('company.common.286') }}</th>
                    <th>{{ __('company.common.285') }}</th>
                    <th>{{ __('company.common.165') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody id="specialOffersTableBody">
                  <tr
                    data-special-record-id="SPO-001"
                    data-description="احجز 4 أيام واحصل على يوم مجاناً"
                    data-type="freeDays"
                    data-details="4 + 1 — يتكرر"
                    data-status="active"
                    data-start-date="2026-08-30"
                    data-end-date="2026-08-30"
                    data-branches='["فرع المروة", "فرع الروضة"]'
                    data-cars='["متوسط", "فاخر"]'
                  >
                    <td>
                      <div class="cell-primary">{{ __('company.pages.special-offers.21') }}</div>
                      <small class="text-muted">SPO-001</small>
                    </td>
                    <td>{{ __('company.pages.special-offers.8') }}</td>
                    <td>{{ __('company.pages.special-offers.22') }}</td>
                    <td>
                      <div
                        data-scope-cell
                        data-scope-cell-mode="branches"
                        data-provider="كل الفروع"
                      ></div>
                    </td>
                    <td><div data-scope-cell data-scope-cell-mode="carTypes"></div></td>
                    <td class="ltr-num" data-special-start-date>2026-08-30</td>
                    <td class="ltr-num" data-special-end-date>2026-08-30</td>
                    <td>
                      <span class="discount-status trending-status--active"
                        ><i class="bi bi-check-circle-fill"></i>{{ __('company.common.544') }}</span
                      >
                    </td>
                    <td class="cell-actions">
                      <div class="action-menu-wrapper">
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                             aria-label="{{ __('company.pages.special-offers.34') }}"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item"
                                data-special-row-action="view"
                              >
                                <i class="bi bi-eye"></i> {{ __('company.common.444') }}</button>
                            </li>
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item"
                                data-special-row-action="edit"
                              >
                                <i class="bi bi-pencil"></i> {{ __('company.common.309') }}</button>
                            </li>
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item"
                                data-special-row-action="pause"
                              >
                                <i class="bi bi-pause-circle"></i> {{ __('company.common.98') }}</button>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item text-danger"
                                data-special-row-action="delete"
                              >
                                <i class="bi bi-trash3"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-special-record-id="SPO-002"
                    data-description="توصيل مجاني للمسافات الطويلة"
                    data-type="deliveryDistance"
                    data-details="80 كم"
                    data-status="pending"
                    data-start-date="2026-09-05"
                    data-end-date="2026-09-12"
                    data-branches='["all"]'
                    data-cars='["all"]'
                  >
                    <td>
                      <div class="cell-primary">{{ __('company.pages.special-offers.23') }}</div>
                      <small class="text-muted">SPO-002</small>
                    </td>
                    <td>{{ __('company.pages.special-offers.10') }}</td>
                    <td>{{ __('company.pages.special-offers.24') }}</td>
                    <td>
                      <div
                        data-scope-cell
                        data-scope-cell-mode="branches"
                        data-provider="كل الفروع"
                      ></div>
                    </td>
                    <td><div data-scope-cell data-scope-cell-mode="carTypes"></div></td>
                    <td class="ltr-num" data-special-start-date>2026-09-05</td>
                    <td class="ltr-num" data-special-end-date>2026-09-12</td>
                    <td>
                      <span class="discount-status trending-status--pending"
                        ><i class="bi bi-hourglass-split"></i>{{ __('company.common.251') }}</span
                      >
                    </td>
                    <td class="cell-actions">
                      <div class="action-menu-wrapper">
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                             aria-label="{{ __('company.pages.special-offers.34') }}"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item"
                                data-special-row-action="view"
                              >
                                <i class="bi bi-eye"></i> {{ __('company.common.444') }}</button>
                            </li>
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item"
                                data-special-row-action="edit"
                              >
                                <i class="bi bi-pencil"></i> {{ __('company.common.309') }}</button>
                            </li>
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item"
                                data-special-row-action="pause"
                              >
                                <i class="bi bi-pause-circle"></i> {{ __('company.common.98') }}</button>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item text-danger"
                                data-special-row-action="delete"
                              >
                                <i class="bi bi-trash3"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-special-record-id="SPO-003"
                    data-description="أسبوع العائلة — يومان مجاناً"
                    data-type="freeDays"
                    data-details="12 + 3"
                    data-status="expired"
                    data-start-date="2026-07-12"
                    data-end-date="2026-07-19"
                    data-branches='["فرع العزيزية"]'
                    data-cars='["عائلي"]'
                  >
                    <td>
                      <div class="cell-primary">{{ __('company.pages.special-offers.25') }}</div>
                      <small class="text-muted">SPO-003</small>
                    </td>
                    <td>{{ __('company.pages.special-offers.8') }}</td>
                    <td>12 + 3</td>
                    <td>
                      <div
                        data-scope-cell
                        data-scope-cell-mode="branches"
                        data-provider="كل الفروع"
                      ></div>
                    </td>
                    <td><div data-scope-cell data-scope-cell-mode="carTypes"></div></td>
                    <td class="ltr-num" data-special-start-date>2026-07-12</td>
                    <td class="ltr-num" data-special-end-date>2026-07-19</td>
                    <td>
                      <span class="discount-status trending-status--expired"
                        ><i class="bi bi-clock-history"></i>{{ __('company.common.556') }}</span
                      >
                    </td>
                    <td class="cell-actions">
                      <div class="action-menu-wrapper">
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                             aria-label="{{ __('company.pages.special-offers.34') }}"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item"
                                data-special-row-action="view"
                              >
                                <i class="bi bi-eye"></i> {{ __('company.common.444') }}</button>
                            </li>
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item"
                                data-special-row-action="edit"
                              >
                                <i class="bi bi-pencil"></i> {{ __('company.common.309') }}</button>
                            </li>
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item"
                                data-special-row-action="pause"
                              >
                                <i class="bi bi-pause-circle"></i> {{ __('company.common.98') }}</button>
                            </li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item text-danger"
                                data-special-row-action="delete"
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
            <div class="table-pagination table-pagination-dt">
              <div class="table-pagination__size-select">
                <label for="specialOfferPageSize">{{ __('company.common.212') }}</label
                ><select id="specialOfferPageSize">
                  <option selected>3</option>
                  <option>5</option>
                  <option>10</option>
                </select>
              </div>
              <div class="table-pagination__pages" id="specialOfferPagination"></div>
            </div>
          </div>
@endsection

@push('modals')
</main>
        
      
    <div
      class="modal fade"
      id="specialOfferDetailsModal"
      tabindex="-1"
      aria-labelledby="specialOfferDetailsTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title fs-5" id="specialOfferDetailsTitle">{{ __('company.pages.special-offers.26') }}</h2>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body" id="specialOfferDetailsContent"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.92') }}</button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="specialOfferSuccessModal"
      tabindex="-1"
      aria-labelledby="specialOfferSuccessTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content confirm-modal">
          <div class="modal-body text-center p-4">
            <div class="confirm-modal__icon confirm-modal__icon--success">
              <i class="bi bi-check-lg"></i>
            </div>
            <h2 class="confirm-modal__title" id="specialOfferSuccessTitle">{{ __('company.pages.special-offers.27') }}</h2>
            <p class="confirm-modal__text">
              {{ __('company.pages.special-offers.28') }}</p>
            <button type="button" class="btn btn-primary mt-3" data-bs-dismiss="modal">
              {{ __('company.common.374') }}</button>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="deleteSpecialOfferModal"
      tabindex="-1"
      aria-labelledby="deleteSpecialOfferModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content confirm-modal">
          <div class="modal-body text-center p-4">
            <div class="confirm-modal__icon confirm-modal__icon--danger">
              <i class="bi bi-trash3" aria-hidden="true"></i>
            </div>
            <h2 class="confirm-modal__title" id="deleteSpecialOfferModalLabel">{{ __('company.pages.special-offers.29') }}</h2>
            <p class="confirm-modal__text">
              {{ __('company.pages.special-offers.30') }}<strong class="ltr-num" id="deleteSpecialOfferId"></strong> {{ __('company.common.568') }}</p>
            <div class="d-flex justify-content-center gap-2 mt-3">
              <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
              <button type="button" class="btn btn-danger" id="confirmDeleteSpecialOffer">
                {{ __('company.common.370') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
@endpush

