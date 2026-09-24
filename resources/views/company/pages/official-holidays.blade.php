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
                    <th>{{ __('company.holidays.column_name') }}</th>
                    <th>{{ __('company.holidays.column_date') }}</th>
                    <th>{{ __('company.holidays.column_duration') }}</th>
                    <th>{{ __('company.holidays.column_status') }}</th>
                  </tr>
                </thead>
                <tbody id="holidaysTableBody"></tbody>
              </table>
            </div>
            <div class="table-pagination table-pagination-dt" id="holidaysPagination">
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

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var dataUrl = '{{ route('company.official-holidays.data') }}';
    var toggleRoute = '{{ route('company.official-holidays.toggle', ['vacation' => 0]) }}';
    var durationRoute = '{{ route('company.official-holidays.duration', ['vacation' => 0]) }}';
    var csrf = document.querySelector('meta[name="csrf-token"]');
    var isAr = window.COMPANY_CONFIG.locale === 'ar';
    var daysOne = @json(__('company.holidays.days_one'));
    var daysMany = @json(__('company.holidays.days_many'));
    var noActive = @json(__('company.holidays.no_active'));

    var body = document.getElementById('holidaysTableBody');
    var search = document.getElementById('holidaysSearchInput');
    var pagination = document.getElementById('holidaysPagination');
    var durationInput = document.getElementById('editHolidayDurationInput');
    var durationName = document.getElementById('editHolidayDurationName');
    var saveBtn = document.getElementById('saveHolidayDurationBtn');
    var editModalEl = document.getElementById('editHolidayDurationModal');

    var holidays = [];
    var currentId = null;

    function escapeHtml(value) {
      return String(value).replace(/[&<>"']/g, function (c) {
        return {
          '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;',
        }[c];
      });
    }

    function holidayLabel(h) {
      return (isAr ? h.name_ar : h.name_en) || h.name_ar || h.name_en || '';
    }

    function daysLabel(count) {
      return count + ' ' + (parseInt(count, 10) === 1 ? daysOne : daysMany);
    }

    function render() {
      var q = (search.value || '').trim().toLowerCase();
      var visible = holidays.filter(function (h) {
        if (!q) return true;
        return holidayLabel(h).toLowerCase().indexOf(q) !== -1;
      });

      if (visible.length === 0) {
        body.innerHTML = '<tr><td colspan="4" class="text-center py-4">' + escapeHtml(noActive) + '</td></tr>';
      } else {
        body.innerHTML = visible.map(function (h) {
          return (
            '<tr>' +
            '<td class="cell-primary">' + escapeHtml(holidayLabel(h)) + '</td>' +
            '<td class="holiday-date-range">' +
            '<span class="holiday-date-range__item">' + @json(__('company.common.555')) + ' <b class="ltr-num">' + escapeHtml(h.date || '') + '</b></span>' +
            '<i class="bi bi-arrow-left holiday-date-range__arrow" aria-hidden="true"></i>' +
            '<span class="holiday-date-range__item">' + @json(__('company.common.96')) + ' <b class="ltr-num">' + escapeHtml(h.end_date || '') + '</b></span>' +
            '</td>' +
            '<td class="ltr-num">' +
            '<div class="holiday-duration">' +
            '<span class="holiday-duration__text">' + escapeHtml(daysLabel(h.day_count)) + '</span>' +
            '<button type="button" class="btn btn-primary btn-sm holiday-duration__edit" data-id="' + h.id + '"' +
            (h.active ? '' : ' style="display:none"') +
            ' title="{{ __('company.pages.official-holidays.8') }}" aria-label="{{ __('company.pages.official-holidays.6') }}">' +
            '<i class="bi bi-pencil"></i>' +
            '</button>' +
            '</div>' +
            '</td>' +
            '<td class="cell-actions">' +
            '<div class="toggle-switch">' +
            '<input type="checkbox" id="holidayToggle-' + h.id + '" data-id="' + h.id + '" class="toggle-switch__input"' + (h.active ? ' checked' : '') + ' />' +
            '<label for="holidayToggle-' + h.id + '" class="toggle-switch__label"><span class="toggle-switch__slider"></span></label>' +
            '</div>' +
            '</td>' +
            '</tr>'
          );
        }).join('');
      }

      if (pagination) pagination.style.display = visible.length > 10 ? '' : 'none';

      body.querySelectorAll('.toggle-switch__input[data-id]').forEach(function (cb) {
        cb.addEventListener('change', onToggle);
      });
      body.querySelectorAll('.holiday-duration__edit[data-id]').forEach(function (btn) {
        btn.addEventListener('click', onEditDuration);
      });
    }

    function onToggle() {
      var cb = this;
      var id = cb.getAttribute('data-id');
      var params = new URLSearchParams({ active: cb.checked ? '1' : '0' });

      fetch(toggleRoute.replace('/0/toggle', '/' + id + '/toggle'), {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': csrf.content,
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: params,
      })
        .then(function (r) {
          return r.json();
        })
        .then(function (res) {
          if (res.code && res.code >= 400) {
            cb.checked = !cb.checked;
          }
          reload();
        })
        .catch(function () {
          cb.checked = !cb.checked;
        });
    }

    function onEditDuration() {
      var id = this.getAttribute('data-id');
      var holiday = holidays.find(function (h) {
        return String(h.id) === id;
      });
      if (!holiday) return;
      currentId = id;
      durationName.textContent = holidayLabel(holiday);
      durationInput.value = holiday.day_count || 1;
      new bootstrap.Modal(editModalEl).show();
    }

    saveBtn.addEventListener('click', function () {
      if (!currentId) return;
      var params = new URLSearchParams({ day_count: durationInput.value });

      fetch(durationRoute.replace('/0/duration', '/' + currentId + '/duration'), {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': csrf.content,
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: params,
      })
        .then(function (r) {
          return r.json();
        })
        .then(function (res) {
          if (res.code && res.code >= 400) {
            window.alert(res.message || '');
            return;
          }
          bootstrap.Modal.getInstance(editModalEl)?.hide();
          reload();
        })
        .catch(function () {});
    });

    search.addEventListener('input', render);

    fetch(dataUrl, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
    })
      .then(function (r) {
        return r.json();
      })
      .then(function (res) {
        holidays = res.data || [];
        render();
      });

    window.reload = reload;

    function reload() {
      return fetch(dataUrl, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
      })
        .then(function (r) {
          return r.json();
        })
        .then(function (res) {
          holidays = res.data || [];
          render();
        });
    }
  });
</script>
@endpush