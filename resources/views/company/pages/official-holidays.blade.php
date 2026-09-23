@extends('company.layouts.master')

@section('title', 'T-Car — Official Holidays')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.144') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.220') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current"> {{ __('company.common.144') }}</span>
              </nav>
            </div>
            
          </div>

          
          <div class="table-card mb-4">
            <div class="table-toolbar">
              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="holidaysSearchInput"  placeholder="{{ __('company.pages.official-holidays.0') }}" />
              </div>
            </div>
            <div class="table-responsive-custom">
              <table class="data-table" id="holidaysTable">
                <thead>
                  <tr>
                    <th>{{ __('company.pages.official-holidays.0') }}</th>
                    <th>{{ __('company.common.157') }}</th>
                    <th>{{ __('company.common.228') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="cell-primary">{{ __('company.pages.official-holidays.1') }}</td>
                    <td class="ltr-num">01/05/2026</td>
                    <td class="ltr-num">
                      <div class="holiday-duration">
                        <span class="holiday-duration__text">{{ __('company.common.34') }}</span>
                        <button
                          type="button"
                          class="btn btn-primary btn-sm holiday-duration__edit"
                          data-bs-toggle="modal"
                          data-bs-target="#editHolidayDurationModal"
                          data-holiday-name="عيد الفطر"
                          data-days="4"
                           title="{{ __('company.pages.official-holidays.8') }}"
                           aria-label="{{ __('company.pages.official-holidays.6') }}"
                        >
                          <i class="bi bi-pencil"></i>
                        </button>
                      </div>
                    </td>
                    <td class="cell-actions">
                      <div class="toggle-switch">
                        <input
                          type="checkbox"
                          id="holidayToggle1"
                          class="toggle-switch__input"
                          checked
                        />
                        <label for="holidayToggle1" class="toggle-switch__label">
                          <span class="toggle-switch__slider"></span>
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="cell-primary">{{ __('company.pages.official-holidays.2') }}</td>
                    <td class="ltr-num">10/06/2026</td>
                    <td class="ltr-num">
                      <div class="holiday-duration">
                        <span class="holiday-duration__text">{{ __('company.common.37') }}</span>
                        <button
                          type="button"
                          class="btn btn-primary btn-sm holiday-duration__edit"
                          data-bs-toggle="modal"
                          data-bs-target="#editHolidayDurationModal"
                          data-holiday-name="عيد الأضحى"
                          data-days="5"
                           title="{{ __('company.pages.official-holidays.8') }}"
                           aria-label="{{ __('company.pages.official-holidays.6') }}"
                        >
                          <i class="bi bi-pencil"></i>
                        </button>
                      </div>
                    </td>
                    <td class="cell-actions">
                      <div class="toggle-switch">
                        <input
                          type="checkbox"
                          id="holidayToggle2"
                          class="toggle-switch__input"
                          checked
                        />
                        <label for="holidayToggle2" class="toggle-switch__label">
                          <span class="toggle-switch__slider"></span>
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="cell-primary">{{ __('company.pages.official-holidays.3') }}</td>
                    <td class="ltr-num">23/09/2026</td>
                    <td class="ltr-num">
                      <div class="holiday-duration">
                        <span class="holiday-duration__text">{{ __('company.pages.official-holidays.4') }}</span>
                        <button
                          type="button"
                          class="btn btn-primary btn-sm holiday-duration__edit"
                          data-bs-toggle="modal"
                          data-bs-target="#editHolidayDurationModal"
                          data-holiday-name="اليوم الوطني"
                          data-days="1"
                           title="{{ __('company.pages.official-holidays.8') }}"
                           aria-label="{{ __('company.pages.official-holidays.6') }}"
                        >
                          <i class="bi bi-pencil"></i>
                        </button>
                      </div>
                    </td>
                    <td class="cell-actions">
                      <div class="toggle-switch">
                        <input
                          type="checkbox"
                          id="holidayToggle3"
                          class="toggle-switch__input"
                          checked
                        />
                        <label for="holidayToggle3" class="toggle-switch__label">
                          <span class="toggle-switch__slider"></span>
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="cell-primary">{{ __('company.pages.official-holidays.5') }}</td>
                    <td class="ltr-num">01/01/2027</td>
                    <td class="ltr-num">
                      <div class="holiday-duration">
                        <span class="holiday-duration__text">{{ __('company.pages.official-holidays.4') }}</span>
                        <button
                          type="button"
                          class="btn btn-primary btn-sm holiday-duration__edit"
                          data-bs-toggle="modal"
                          data-bs-target="#editHolidayDurationModal"
                          data-holiday-name="رأس السنة الهجرية"
                          data-days="1"
                           title="{{ __('company.pages.official-holidays.8') }}"
                           aria-label="{{ __('company.pages.official-holidays.6') }}"
                        >
                          <i class="bi bi-pencil"></i>
                        </button>
                      </div>
                    </td>
                    <td class="cell-actions">
                      <div class="toggle-switch">
                        <input type="checkbox" id="holidayToggle4" class="toggle-switch__input" />
                        <label for="holidayToggle4" class="toggle-switch__label">
                          <span class="toggle-switch__slider"></span>
                        </label>
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
      id="editHolidayDurationModal"
      tabindex="-1"
      aria-labelledby="editHolidayDurationModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title fs-5" id="editHolidayDurationModalLabel">{{ __('company.pages.official-holidays.6') }}</h2>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body">
            <p class="mb-3">
              <span class="text-muted">{{ __('company.pages.official-holidays.7') }}</span>
              <strong id="editHolidayDurationName"></strong>
            </p>
            <div class="form-field">
              <label class="form-field__label" for="editHolidayDurationInput">{{ __('company.common.441') }}</label>
              <div class="duration-stepper">
                <input
                  type="number"
                  class="form-field__input duration-stepper__input ltr-num"
                  id="editHolidayDurationInput"
                  min="1"
                  max="30"
                  value="1"
                />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
            <button type="button" class="btn btn-primary" id="saveHolidayDurationBtn">
              <i class="bi bi-check-lg" aria-hidden="true"></i>
              {{ __('company.common.375') }}</button>
          </div>
        </div>
      </div>
    </div>

    
@endpush

