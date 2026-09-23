@extends('company.layouts.master')

@section('title', 'T-Car — الخصومات')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.discounts.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.214') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.pages.discounts.0') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
              <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#discountFormModal"
                data-discount-action="add"
              >
                <i class="bi bi-plus-lg" aria-hidden="true"></i>
                {{ __('company.pages.discounts.1') }}</button>
            </div>
          </div>

          <div class="table-card mb-4" id="discountsTableCard">
            

            <div class="table-filter-bar discount-filter-bar">
              <div class="table-filter-bar__left">
                <div class="discount-filter-field">
                  <label for="discountStatusFilter">{{ __('company.common.165') }}</label>
                  <select id="discountStatusFilter" class="discount-filter-control">
                    <option value="all">{{ __('company.common.478') }}</option>
                    <option value="active">{{ __('company.common.544') }}</option>
                    <option value="scheduled">{{ __('company.pages.discounts.2') }}</option>
                    <option value="stopped">{{ __('company.pages.discounts.3') }}</option>
                    <option value="expired">{{ __('company.common.556') }}</option>
                  </select>
                </div>
                <div class="discount-filter-field">
                  <label for="discountDateFilter">{{ __('company.common.157') }}</label>
                  <input
                    type="date"
                    id="discountDateFilter"
                    class="discount-filter-control ltr-num"
                  />
                </div>
                <button type="button" class="btn btn-outline btn-sm" id="clearDiscountFilters">
                  <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                  {{ __('company.common.525') }}</button>
              </div>
              <div class="table-search">
                <i class="bi bi-search" aria-hidden="true"></i>
                <input type="search" id="discountsSearchInput"  placeholder="{{ __('company.pages.discounts.39') }}" />
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="data-table discounts-table" id="discountsTable">
                <thead>
                  <tr>
                    <th>{{ __('company.pages.discounts.4') }}</th>
                    <th>{{ __('company.pages.discounts.5') }}</th>
                    <th>{{ __('company.common.244') }}</th>
                    <th>{{ __('company.common.70') }}</th>
                    <th>{{ __('company.pages.discounts.6') }}</th>
                    <th>{{ __('company.common.286') }}</th>
                    <th>{{ __('company.common.285') }}</th>
                    <th>{{ __('company.common.165') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody id="discountsTableBody">
                  <tr
                    data-discount-row="DSC-001"
                    data-name="خصم الصيف"
                    data-type="percentage"
                    data-value="15"
                    data-handling="cumulative"
                    data-start-date="2026-08-03"
                    data-end-date="2026-10-02"
                    data-branches='["فرع العتيق", "فرع العليا", "فرع الروضة", "فرع العزيزية"]'
                    data-car-types='["اقتصادي", "دفع رباعي", "عائلي"]'
                    data-manual-stopped="false"
                  >
                    <td>
                      <div class="cell-primary">{{ __('company.pages.discounts.7') }}</div>
                      <small class="text-muted ltr-num">DSC-001</small>
                    </td>
                    <td>
                      <div class="discount-value-cell">
                        <strong>15%</strong><span>{{ __('company.pages.discounts.8') }}</span>
                      </div>
                    </td>
                    <td>
                      <div
                        data-scope-cell
                        data-scope-cell-mode="branches"
                        data-provider="كل الفروع"
                      ></div>
                    </td>
                    <td><div data-scope-cell data-scope-cell-mode="carTypes"></div></td>
                    <td>
                      <span class="discount-handling-badge"
                        ><i class="bi bi-layers"></i>{{ __('company.pages.discounts.9') }}</span
                      >
                    </td>
                    <td>
                      <div class="discount-date-cell">
                        <strong class="ltr-num">03/08/2026</strong>
                      </div>
                    </td>
                    <td>
                      <div class="discount-date-cell">
                        <strong class="ltr-num">02/10/2026</strong>
                      </div>
                    </td>
                    <td>
                      <span class="discount-status discount-status--active"
                        ><i class="bi bi-check-circle-fill"></i>{{ __('company.common.544') }}</span
                      >
                    </td>
                    <td class="cell-actions"></td>
                  </tr>
                  <tr
                    data-discount-row="DSC-002"
                    data-name="خصم الحجز المبكر"
                    data-type="percentage"
                    data-value="10"
                    data-handling="replace"
                    data-start-date="2026-09-02"
                    data-end-date="2026-11-01"
                    data-branches='["all"]'
                    data-car-types='["اقتصادي", "متوسط"]'
                    data-manual-stopped="false"
                  >
                    <td>
                      <div class="cell-primary">{{ __('company.pages.discounts.10') }}</div>
                      <small class="text-muted ltr-num">DSC-002</small>
                    </td>
                    <td>
                      <div class="discount-value-cell">
                        <strong>10%</strong><span>{{ __('company.pages.discounts.8') }}</span>
                      </div>
                    </td>
                    <td>
                      <div
                        data-scope-cell
                        data-scope-cell-mode="branches"
                        data-provider="كل الفروع"
                      ></div>
                    </td>
                    <td><div data-scope-cell data-scope-cell-mode="carTypes"></div></td>
                    <td>
                      <span class="discount-handling-badge"
                        ><i class="bi bi-layers"></i>{{ __('company.pages.discounts.11') }}</span
                      >
                    </td>
                    <td>
                      <div class="discount-date-cell">
                        <strong class="ltr-num">02/09/2026</strong>
                      </div>
                    </td>
                    <td>
                      <div class="discount-date-cell">
                        <strong class="ltr-num">01/11/2026</strong>
                      </div>
                    </td>
                    <td>
                      <span class="discount-status discount-status--scheduled"
                        ><i class="bi bi-calendar-event"></i>{{ __('company.pages.discounts.2') }}</span
                      >
                    </td>
                    <td class="cell-actions"></td>
                  </tr>
                  <tr
                    data-discount-row="DSC-003"
                    data-name="خصم الربيع"
                    data-type="amount"
                    data-value="50"
                    data-handling="highest"
                    data-start-date="2026-06-04"
                    data-end-date="2026-08-08"
                    data-branches='["فرع المروة"]'
                    data-car-types='["all"]'
                    data-manual-stopped="false"
                  >
                    <td>
                      <div class="cell-primary">{{ __('company.pages.discounts.12') }}</div>
                      <small class="text-muted ltr-num">DSC-003</small>
                    </td>
                    <td>
                      <div class="discount-value-cell">
                        <strong>{{ __('company.pages.discounts.13') }}</strong><span>{{ __('company.pages.discounts.14') }}</span>
                      </div>
                    </td>
                    <td>
                      <div
                        data-scope-cell
                        data-scope-cell-mode="branches"
                        data-provider="كل الفروع"
                      ></div>
                    </td>
                    <td><div data-scope-cell data-scope-cell-mode="carTypes"></div></td>
                    <td>
                      <span class="discount-handling-badge"
                        ><i class="bi bi-layers"></i>{{ __('company.pages.discounts.15') }}</span
                      >
                    </td>
                    <td>
                      <div class="discount-date-cell">
                        <strong class="ltr-num">04/06/2026</strong>
                      </div>
                    </td>
                    <td>
                      <div class="discount-date-cell">
                        <strong class="ltr-num">08/08/2026</strong>
                      </div>
                    </td>
                    <td>
                      <span class="discount-status discount-status--expired"
                        ><i class="bi bi-clock-history"></i>{{ __('company.common.556') }}</span
                      >
                    </td>
                    <td class="cell-actions"></td>
                  </tr>
                  <tr
                    data-discount-row="DSC-004"
                    data-name="خصم نهاية الأسبوع"
                    data-type="percentage"
                    data-value="20"
                    data-handling="replace"
                    data-start-date="2026-08-18"
                    data-end-date="2026-10-12"
                    data-branches='["فرع المروة", "فرع الروضة", "فرع العزيزية"]'
                    data-car-types='["متوسط", "فاخر", "عائلي"]'
                    data-manual-stopped="true"
                  >
                    <td>
                      <div class="cell-primary">{{ __('company.pages.discounts.16') }}</div>
                      <small class="text-muted ltr-num">DSC-004</small>
                    </td>
                    <td>
                      <div class="discount-value-cell">
                        <strong>20%</strong><span>{{ __('company.pages.discounts.8') }}</span>
                      </div>
                    </td>
                    <td>
                      <div
                        data-scope-cell
                        data-scope-cell-mode="branches"
                        data-provider="كل الفروع"
                      ></div>
                    </td>
                    <td><div data-scope-cell data-scope-cell-mode="carTypes"></div></td>
                    <td>
                      <span class="discount-handling-badge"
                        ><i class="bi bi-layers"></i>{{ __('company.pages.discounts.11') }}</span
                      >
                    </td>
                    <td>
                      <div class="discount-date-cell">
                        <strong class="ltr-num">18/08/2026</strong>
                      </div>
                    </td>
                    <td>
                      <div class="discount-date-cell">
                        <strong class="ltr-num">12/10/2026</strong>
                      </div>
                    </td>
                    <td>
                      <span class="discount-status discount-status--stopped"
                        ><i class="bi bi-pause-circle-fill"></i>{{ __('company.pages.discounts.3') }}</span
                      >
                    </td>
                    <td class="cell-actions"></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="table-pagination table-pagination-dt">
              <div class="table-pagination__size-select">
                <label for="discountPageSize">{{ __('company.common.212') }}</label>
                <select id="discountPageSize">
                  <option value="3" selected>3</option>
                  <option value="5">5</option>
                  <option value="10">10</option>
                </select>
              </div>
              <div
                class="table-pagination__pages"
                id="tablePagination"
                 aria-label="{{ __('company.pages.discounts.40') }}"
              ></div>
            </div>
          </div>
@endsection

@push('modals')
</main>
        
      

    
    <div
      class="modal fade"
      id="discountFormModal"
      tabindex="-1"
      aria-labelledby="discountFormModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <form id="discountForm" novalidate>
            <div class="modal-header">
              <h2 class="modal-title fs-5" id="discountFormModalLabel">{{ __('company.pages.discounts.1') }}</h2>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                 aria-label="{{ __('company.common.92') }}"
              ></button>
            </div>
            <div class="modal-body discount-form-modal__body">
              <input type="hidden" id="discountRecordId" />
              <div class="discount-form-layout">
                <div class="discount-form-main">
                  <section class="discount-form-section">
                    <h3 class="discount-form-section__title">
                      <i class="bi bi-tag" aria-hidden="true"></i>
                      {{ __('company.pages.discounts.17') }}</h3>
                    <div class="row g-3">
                      <div class="col-12">
                        <div class="form-field">
                          <label class="form-field__label" for="discountName">
                            {{ __('company.pages.discounts.4') }}<span class="text-danger">*</span>
                          </label>
                          <input
                            type="text"
                            class="form-field__input"
                            id="discountName"
                             placeholder="{{ __('company.pages.discounts.41') }}"
                            required
                          />
                          <div class="invalid-feedback">{{ __('company.pages.discounts.18') }}</div>
                        </div>
                      </div>

                      <div class="col-12">
                        <fieldset class="discount-type-fieldset">
                          <legend>{{ __('company.pages.discounts.19') }}<span class="text-danger">*</span></legend>
                          <div class="discount-type-options">
                            <label class="discount-type-option">
                              <input type="radio" name="discountType" value="amount" checked />
                              <span>
                                <i class="bi bi-cash-stack" aria-hidden="true"></i>
                                {{ __('company.pages.discounts.14') }}</span>
                            </label>
                            <label class="discount-type-option">
                              <input type="radio" name="discountType" value="percentage" />
                              <span>
                                <i class="bi bi-percent" aria-hidden="true"></i>
                                {{ __('company.pages.discounts.8') }}</span>
                            </label>
                          </div>
                        </fieldset>
                      </div>

                      <div class="col-12 col-md-6" data-discount-amount-field>
                        <div class="form-field">
                          <label class="form-field__label" for="discountAmount">
                            {{ __('company.pages.discounts.20') }}<span class="text-danger">*</span>
                          </label>
                          <input
                            type="number"
                            min="0.01"
                            step="0.01"
                            class="form-field__input ltr-num"
                            id="discountAmount"
                            placeholder="0.00"
                          />
                          <div class="invalid-feedback">{{ __('company.pages.discounts.21') }}</div>
                        </div>
                      </div>

                      <div class="col-12 col-md-6" data-discount-percentage-field hidden>
                        <div class="form-field">
                          <label class="form-field__label" for="discountPercentage">
                            {{ __('company.pages.discounts.22') }}<span class="text-danger">*</span>
                          </label>
                          <input
                            type="number"
                            min="1"
                            max="100"
                            class="form-field__input ltr-num"
                            id="discountPercentage"
                            placeholder="1 - 100"
                          />
                          <div class="invalid-feedback">{{ __('company.pages.discounts.23') }}</div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="form-field">
                          <label class="form-field__label" for="discountHandling">
                            {{ __('company.pages.discounts.24') }}<span class="text-danger">*</span>
                          </label>
                          <select class="form-field__input" id="discountHandling" required>
                            <option value="replace">{{ __('company.pages.discounts.25') }}</option>
                            <option value="highest">{{ __('company.pages.discounts.26') }}</option>
                            <option value="cumulative">{{ __('company.pages.discounts.27') }}</option>
                          </select>
                          <p class="discount-handling-hint" id="discountHandlingHint"></p>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form-field">
                          <label class="form-field__label" for="discountStartDate">
                            {{ __('company.common.286') }}<span class="text-danger">*</span>
                          </label>
                          <input
                            type="date"
                            class="form-field__input ltr-num"
                            id="discountStartDate"
                            required
                          />
                          <div class="invalid-feedback">{{ __('company.pages.discounts.28') }}</div>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form-field">
                          <label class="form-field__label" for="discountEndDate">
                            {{ __('company.common.285') }}<span class="text-danger">*</span>
                          </label>
                          <input
                            type="date"
                            class="form-field__input ltr-num"
                            id="discountEndDate"
                            required
                          />
                          <div class="invalid-feedback">{{ __('company.pages.discounts.29') }}</div>
                        </div>
                      </div>
                    </div>
                  </section>

                  <section class="discount-form-section">
                    <div data-scope-selector data-scope-name="discount"></div>
                  </section>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
              <button type="submit" class="btn btn-primary" id="saveDiscountBtn">
                <i class="bi bi-check-lg" aria-hidden="true"></i>
                {{ __('company.pages.discounts.30') }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="discountDetailsModal"
      tabindex="-1"
      aria-labelledby="discountDetailsModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title fs-5" id="discountDetailsModalLabel">{{ __('company.pages.discounts.31') }}</h2>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body" id="discountDetailsContent"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.92') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="deleteDiscountModal"
      tabindex="-1"
      aria-labelledby="deleteDiscountModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content confirm-modal">
          <div class="modal-body text-center p-4">
            <div class="confirm-modal__icon confirm-modal__icon--danger">
              <i class="bi bi-trash3" aria-hidden="true"></i>
            </div>
            <h2 class="confirm-modal__title" id="deleteDiscountModalLabel">{{ __('company.pages.discounts.32') }}</h2>
            <p class="confirm-modal__text">
              {{ __('company.pages.discounts.33') }}<strong id="deleteDiscountName"></strong> {{ __('company.pages.discounts.34') }}</p>
            <div class="d-flex justify-content-center gap-2 mt-4">
              <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
              <button type="button" class="btn btn-danger" id="confirmDeleteDiscount">
                {{ __('company.pages.discounts.35') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="discountSuccessModal"
      tabindex="-1"
      aria-labelledby="discountSuccessModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content confirm-modal">
          <div class="modal-body text-center p-4">
            <div class="confirm-modal__icon confirm-modal__icon--success">
              <i class="bi bi-check-lg" aria-hidden="true"></i>
            </div>
            <h2 class="confirm-modal__title" id="discountSuccessModalLabel">{{ __('company.pages.discounts.36') }}</h2>
            <p class="confirm-modal__text">{{ __('company.pages.discounts.37') }}</p>
            <button type="button" class="btn btn-primary mt-3" data-bs-dismiss="modal">
              {{ __('company.pages.discounts.38') }}</button>
          </div>
        </div>
      </div>
    </div>

    
@endpush

