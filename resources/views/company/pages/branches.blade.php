@extends('company.layouts.master')

@section('title', 'T-Car — فروع التأجير')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.467') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span> {{ __('company.common.220') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current"> {{ __('company.common.220') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
              <a href="{{ route('company.add-office') }}" class="btn btn-primary"
                ><i class="bi bi-car-front"></i> {{ __('company.common.87') }}</a
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
                    <a class="dropdown-item" href="{{ route('company.branches.export') }}"
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
                <div class="view-tabs" role="tablist"  aria-label="{{ __('company.pages.branches.10') }}">
                  <button
                    type="button"
                    class="view-tabs__btn is-active"
                    role="tab"
                    aria-selected="true"
                    data-status=""
                  >
                    {{ __('company.common.223') }}</button>
                  <button type="button" class="view-tabs__btn" role="tab" aria-selected="false" data-status="approved">
                    {{ __('company.common.544') }}</button>
                  <button type="button" class="view-tabs__btn" role="tab" aria-selected="false" data-status="reject">
                    {{ __('company.common.455') }}</button>
                  <button type="button" class="view-tabs__btn" role="tab" aria-selected="false" data-status="pending">
                    {{ __('company.common.473') }}</button>
                </div>
              </div>
            </div>

            <div class="table-filter-bar">
              <div class="table-filter-bar__left">
                

                <button
                  type="button"
                  class="btn btn-outline btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#officeFilterModal"
                >
                  <i class="bi bi-sliders"></i> {{ __('company.common.303') }}</button>
              </div>

              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="officesSearchInput"  placeholder="{{ __('company.common.136') }}" />
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="office-table" id="officesTable">
                <thead>
                  <tr>
                    <th>{{ __('company.pages.branches.0') }}</th>
                    <th>{{ __('company.common.217') }}</th>
                    <th>{{ __('company.pages.branches.1') }}</th>
                    <th>{{ __('company.common.394') }}</th>
                    <th>{{ __('company.common.496') }}</th>
                    <th>{{ __('company.pages.branches.2') }}</th>
                    <th>{{ __('company.pages.branches.3') }}</th>
                    <th>{{ __('company.common.363') }}</th>
                    <th>{{ __('company.common.76') }}</th>
                  </tr>
                </thead>
                <tbody id="officesTableBody"></tbody>
              </table>
            </div>

            <div class="table-pagination table-pagination-dt" id="officesPagination">
              <div class="table-pagination__size-select">
                <label for="pageSizeSelect">{{ __('company.common.212') }}</label>
                <select id="pageSizeSelect">
                  <option value="10" selected>10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                </select>
              </div>
              <div class="table-pagination__pages" id="officesTablePages"></div>
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
                  <label class="form-field__label">{{ __('company.common.136') }}</label>
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
                        >{{ __('company.common.110') }}</span
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
                             placeholder="{{ __('company.common.258') }}"
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
                  <label class="form-field__label">{{ __('company.common.229') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="citySelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="citySelectValue"
                        >{{ __('company.common.113') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu" id="cityDropdownMenu" aria-labelledby="citySelectBtn">
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input type="search"  placeholder="{{ __('company.common.259') }}" id="citySearchInput" />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-city="riyadh" data-label="الرياض" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.common.183') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-city="jeddah" data-label="جدة" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.common.357') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-city="dammam" data-label="الدمام" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.common.174') }}</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.common.165') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="statusSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="statusSelectValue"
                        >{{ __('company.pages.branches.5') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu"
                      id="statusDropdownMenu"
                      aria-labelledby="statusSelectBtn"
                    >
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-status="active" data-label="مفعل" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.common.544') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-status="inactive" data-label="غير مفعل" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.common.455') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-status="review" data-label="قيد المراجعة" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.common.473') }}</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="form-field">
                  <label class="form-field__label">{{ __('company.pages.branches.6') }}</label>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="carsAvailableSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span class="filter-dropdown-btn__value" id="carsAvailableSelectValue"
                        >{{ __('company.common.109') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu"
                      id="carsAvailableDropdownMenu"
                      aria-labelledby="carsAvailableSelectBtn"
                    >
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-cars="high" data-label="عالي (20+)" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.branches.7') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-cars="medium" data-label="متوسط (10-20)" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.branches.8') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-cars="low" data-label="منخفض (أقل من 10)" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.pages.branches.9') }}</label>
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

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var dataUrl = '{{ route('company.branches.data') }}';
    var deleteUrl = '{{ route('company.branches.destroy', ['branch' => 0]) }}';
    var detailsUrl = '{{ route('company.office-details') }}';
    var editUrl = '{{ route('company.edit-office') }}';
    var officeCarsUrl = '{{ route('company.office-cars') }}';
    var addCarUrl = '{{ route('company.add-car') }}';
    var csrf = document.querySelector('meta[name="csrf-token"]');
    var isAr = window.COMPANY_CONFIG.locale === 'ar';

    var statusPending = @json(__('company.branches.status_pending'));
    var statusApproved = @json(__('company.branches.status_approved'));
    var statusRejected = @json(__('company.branches.status_rejected'));
    var noBranches = @json(__('company.branches.no_branches'));
    var deleteConfirm = @json(__('company.messages.delete_confirm'));
    var deleteLabel = @json(__('company.branches.delete_label'));
    var editLabel = @json(__('company.common.309'));
    var optionsLabel = @json(__('company.common.384'));
    var branchCarListLabel = @json(__('company.pages.branches.4'));
    var addCarLabel = @json(__('company.common.85'));

    var tbody = document.getElementById('officesTableBody');
    var searchInput = document.getElementById('officesSearchInput');
    var pageSizeSelect = document.getElementById('pageSizeSelect');
    var pagesWrap = document.getElementById('officesTablePages');
    var paginationWrap = document.getElementById('officesPagination');

    var state = { search: '', status: '', page: 1, per_page: 10 };

    function escapeHtml(value) {
      return String(value).replace(/[&<>"']/g, function (c) {
        return {
          '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;',
        }[c];
      });
    }

    function branchName(b) {
      return (isAr ? b.name_ar : b.name_en) || b.name_ar || b.name_en || '—';
    }

    function statusMeta(status) {
      var meta = {
        pending: { cls: 'status-toggle--review', label: statusPending, lock: true },
        approved: { cls: 'status-toggle--active', label: statusApproved, lock: false },
        reject: { cls: 'status-toggle--inactive', label: statusRejected, lock: false },
      };
      return meta[status] || { cls: '', label: status, lock: false };
    }

    function load() {
      var params = new URLSearchParams({
        search: state.search,
        page: state.page,
        per_page: state.per_page,
      });
      if (state.status) params.set('status', state.status);

      var url = dataUrl + '?' + params.toString();

      return fetch(url, {
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
      })
        .then(function (r) {
          return r.json();
        })
        .then(function (res) {
          var rows = res.data || [];
          var pagination = res.pagination || {};

          if (rows.length === 0) {
            tbody.innerHTML =
              '<tr><td colspan="9" class="text-center py-4">' + escapeHtml(noBranches) + '</td></tr>';
          } else {
            tbody.innerHTML = rows
              .map(function (b, i) {
                var status = statusMeta(b.status);
                var name = branchName(b);
                var phone = ((b.phone_code || '') + (b.phone_number || '')).replace('++', '+');

                return (
                  '<tr>' +
                  '<td><a href="' + detailsUrl + '/?id=' + b.id + '" class="office-name">' +
                  escapeHtml(name) + '</a></td>' +
                  '<td class="cell-secondary">' + escapeHtml(b.address || '—') + '</td>' +
                  '<td>' + escapeHtml(b.person_name || '—') + '</td>' +
                  '<td class="ltr-num">' + escapeHtml(phone || '—') + '</td>' +
                  '<td class="cell-fraction"><b class="ltr-num">—</b> <i class="bi bi-car-front-fill text-secondary"></i></td>' +
                  '<td class="ltr-num">—</td>' +
                  '<td class="ltr-num">—</td>' +
                  '<td><span class="status-toggle ' + status.cls + '" data-status="' + b.status + '"' +
                  (status.lock ? ' disabled' : '') + '>' +
                  (status.lock ? '<i class="bi bi-lock-fill" aria-hidden="true"></i> ' : '') +
                  escapeHtml(status.label) + '</span></td>' +
                  '<td class="cell-actions">' +
                  '<div class="action-menu-wrapper">' +
                  '<a href="' + editUrl + '/?id=' + b.id + '" class="btn btn-primary btn-sm" title="' + escapeHtml(editLabel) + '"><i class="bi bi-pencil"></i></a>' +
                  '<div class="dropdown action-dropdown">' +
                  '<button class="action-menu-btn dropdown-toggle" type="button" title="' + escapeHtml(optionsLabel) + '" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></button>' +
                  '<ul class="dropdown-menu dropdown-menu-end">' +
                  '<li><a href="' + officeCarsUrl + '/?id=' + b.id + '" class="dropdown-item action-menu-item"><i class="bi bi-car-front"></i> ' + escapeHtml(branchCarListLabel) + '</a></li>' +
                  '<li><a href="' + addCarUrl + '/?id=' + b.id + '" class="dropdown-item action-menu-item"><i class="bi bi-plus-circle"></i> ' + escapeHtml(addCarLabel) + '</a></li>' +
                  '<li><hr class="dropdown-divider" /></li>' +
                  '<li><a href="#" class="dropdown-item action-menu-item text-danger" data-delete="' + b.id + '" data-name="' + escapeHtml(name) + '"><i class="bi bi-trash"></i> ' + escapeHtml(deleteLabel) + '</a></li>' +
                  '</ul>' +
                  '</div>' +
                  '</div>' +
                  '</td>' +
                  '</tr>'
                );
              })
              .join('');
          }

          renderPagination(pagination);
        });
    }

    function renderPagination(pagination) {
      if (!pagesWrap) return;
      var last = pagination.last_page || 1;
      var current = pagination.current_page || 1;
      state.page = current;

      if (pagination.total === undefined || pagination.total > state.per_page) {
        paginationWrap.style.display = '';
      } else {
        paginationWrap.style.display = 'none';
        return;
      }

      var html = '';

      html +=
        '<button type="button" class="table-pagination__page-btn"' +
        (current <= 1 ? ' disabled' : '') + ' data-page="' + (current - 1) + '">' +
        '<i class="bi bi-chevron-right"></i></button>';

      var from = Math.max(1, current - 2);
      var to = Math.min(last, from + 4);
      for (var p = from; p <= to; p++) {
        html +=
          '<button type="button" class="table-pagination__page-btn' +
          (p === current ? ' is-active' : '') + '" data-page="' + p + '">' + p + '</button>';
      }

      html +=
        '<button type="button" class="table-pagination__page-btn"' +
        (current >= last ? ' disabled' : '') + ' data-page="' + (current + 1) + '">' +
        '<i class="bi bi-chevron-left"></i></button>';

      pagesWrap.innerHTML = html;

      pagesWrap.querySelectorAll('[data-page]').forEach(function (btn) {
        btn.addEventListener('click', function () {
          if (this.classList.contains('disabled')) return;
          state.page = parseInt(this.getAttribute('data-page'), 10) || 1;
          load();
        });
      });
    }

    // Search (debounced)
    var searchTimer = null;
    if (searchInput) {
      searchInput.addEventListener('input', function () {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function () {
          state.search = searchInput.value.trim();
          state.page = 1;
          load();
        }, 400);
      });
    }

    // Page size
    if (pageSizeSelect) {
      pageSizeSelect.addEventListener('change', function () {
        state.per_page = parseInt(this.value, 10) || 10;
        state.page = 1;
        load();
      });
    }

    // View tabs -> status filter
    document.querySelectorAll('.view-tabs__btn').forEach(function (tab) {
      tab.addEventListener('click', function () {
        document.querySelectorAll('.view-tabs__btn').forEach(function (t) {
          t.classList.remove('is-active');
          t.setAttribute('aria-selected', 'false');
        });
        this.classList.add('is-active');
        this.setAttribute('aria-selected', 'true');
        state.status = this.getAttribute('data-status') || '';
        state.page = 1;
        load();
      });
    });

    // Delete
    tbody.addEventListener('click', function (e) {
      var link = e.target.closest('[data-delete]');
      if (!link) return;
      e.preventDefault();

      if (!window.confirm(decodeConfirm(deleteConfirm, link.getAttribute('data-name')))) return;

      fetch(deleteUrl.replace('/0', '/' + link.getAttribute('data-delete')), {
        method: 'DELETE',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': csrf.content,
          'Accept': 'application/json',
        },
      })
        .then(function (r) {
          return r.json();
        })
        .then(function (res) {
          if (res.code && res.code >= 400) {
            window.alert(res.message || '');
            return;
          }
          load();
        })
        .catch(function () {});
    });

    function decodeConfirm(template, name) {
      var fn = new Function('name', 'return `' + template + '`;');
      return fn(name);
    }

    load();
  });
</script>
@endpush

@push('scripts')
<script>
      // Office Filter Modal Multi-select Logic
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

        /* ---- Multi-select dropdown logic (اسم الفرع) ---- */
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
              'اختر الفرع',
            );
          }

          officeNameSearchInput.addEventListener('click', function (e) {
            e.stopPropagation();
          });
          officeNameSearchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            officeNameDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
              var text = li.textContent.trim().toLowerCase();
              li.style.display = text.includes(q) ? '' : 'none';
            });
          });
        }

        /* ---- Multi-select dropdown logic (المدينة) ---- */
        var selectedCities = [];
        var citySelectBtn = document.getElementById('citySelectBtn');
        var citySelectValue = document.getElementById('citySelectValue');
        var cityDropdownMenu = document.getElementById('cityDropdownMenu');
        var citySearchInput = document.getElementById('citySearchInput');

        if (cityDropdownMenu) {
          cityDropdownMenu
            .querySelectorAll('input[type="checkbox"][data-city]')
            .forEach(function (cb) {
              cb.addEventListener('change', function () {
                var city = this.getAttribute('data-city');
                var label = this.getAttribute('data-label');
                if (this.checked) {
                  if (
                    !selectedCities.some(function (o) {
                      return o.value === city;
                    })
                  ) {
                    selectedCities.push({ value: city, label: label });
                  }
                } else {
                  selectedCities = selectedCities.filter(function (o) {
                    return o.value !== city;
                  });
                }
                updateCityDisplay();
              });
            });

          function updateCityDisplay() {
            updateMultiSelectDisplay(
              selectedCities,
              citySelectBtn,
              citySelectValue,
              'اختر المدينة',
            );
          }

          citySearchInput.addEventListener('click', function (e) {
            e.stopPropagation();
          });
          citySearchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            cityDropdownMenu.querySelectorAll('li:not(:first-child)').forEach(function (li) {
              var text = li.textContent.trim().toLowerCase();
              li.style.display = text.includes(q) ? '' : 'none';
            });
          });
        }

        /* ---- Multi-select dropdown logic (الحالة) ---- */
        var selectedStatuses = [];
        var statusSelectBtn = document.getElementById('statusSelectBtn');
        var statusSelectValue = document.getElementById('statusSelectValue');
        var statusDropdownMenu = document.getElementById('statusDropdownMenu');

        if (statusDropdownMenu) {
          statusDropdownMenu
            .querySelectorAll('input[type="checkbox"][data-status]')
            .forEach(function (cb) {
              cb.addEventListener('change', function () {
                var status = this.getAttribute('data-status');
                var label = this.getAttribute('data-label');
                if (this.checked) {
                  if (
                    !selectedStatuses.some(function (o) {
                      return o.value === status;
                    })
                  ) {
                    selectedStatuses.push({ value: status, label: label });
                  }
                } else {
                  selectedStatuses = selectedStatuses.filter(function (o) {
                    return o.value !== status;
                  });
                }
                updateStatusDisplay();
              });
            });

          function updateStatusDisplay() {
            updateMultiSelectDisplay(
              selectedStatuses,
              statusSelectBtn,
              statusSelectValue,
              'اختر الحالة',
            );
          }
        }

        /* ---- Multi-select dropdown logic (عدد السيارات المتوفرة) ---- */
        var selectedCarsAvailable = [];
        var carsAvailableSelectBtn = document.getElementById('carsAvailableSelectBtn');
        var carsAvailableSelectValue = document.getElementById('carsAvailableSelectValue');
        var carsAvailableDropdownMenu = document.getElementById('carsAvailableDropdownMenu');

        if (carsAvailableDropdownMenu) {
          carsAvailableDropdownMenu
            .querySelectorAll('input[type="checkbox"][data-cars]')
            .forEach(function (cb) {
              cb.addEventListener('change', function () {
                var cars = this.getAttribute('data-cars');
                var label = this.getAttribute('data-label');
                if (this.checked) {
                  if (
                    !selectedCarsAvailable.some(function (o) {
                      return o.value === cars;
                    })
                  ) {
                    selectedCarsAvailable.push({ value: cars, label: label });
                  }
                } else {
                  selectedCarsAvailable = selectedCarsAvailable.filter(function (o) {
                    return o.value !== cars;
                  });
                }
                updateCarsAvailableDisplay();
              });
            });

          function updateCarsAvailableDisplay() {
            updateMultiSelectDisplay(
              selectedCarsAvailable,
              carsAvailableSelectBtn,
              carsAvailableSelectValue,
              'اختر العدد',
            );
          }
        }

        /* ---- Clear All button ---- */
        var clearAllBtn = document.querySelector('#officeFilterModal .modal-footer .btn-outline');
        if (clearAllBtn) {
          clearAllBtn.addEventListener('click', function () {
            // Clear all selections
            selectedOfficeNames = [];
            selectedCities = [];
            selectedStatuses = [];
            selectedCarsAvailable = [];

            // Uncheck all checkboxes
            document
              .querySelectorAll('#officeFilterForm input[type="checkbox"]')
              .forEach(function (cb) {
                cb.checked = false;
              });

            // Update displays
            if (officeNameSelectValue) {
              officeNameSelectValue.textContent = 'اختر الفرع';
              officeNameSelectValue.removeAttribute('title');
              if (officeNameSelectBtn) {
                officeNameSelectBtn.classList.remove('has-value');
              }
            }
            if (citySelectValue) {
              citySelectValue.textContent = 'اختر المدينة';
              citySelectValue.removeAttribute('title');
              if (citySelectBtn) {
                citySelectBtn.classList.remove('has-value');
              }
            }
            if (statusSelectValue) {
              statusSelectValue.textContent = 'اختر الحالة';
              statusSelectValue.removeAttribute('title');
              if (statusSelectBtn) {
                statusSelectBtn.classList.remove('has-value');
              }
            }
            if (carsAvailableSelectValue) {
              carsAvailableSelectValue.textContent = 'اختر العدد';
              carsAvailableSelectValue.removeAttribute('title');
              if (carsAvailableSelectBtn) {
                carsAvailableSelectBtn.classList.remove('has-value');
              }
            }
          });
        }
      });
    </script>
@endpush

