@extends('company.layouts.master')

@section('title', 'T-Car — Drivers')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.190') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.233') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current"> {{ __('company.common.190') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
              <a href="{{ route('company.add-driver') }}" class="btn btn-primary"
                ><i class="bi bi-plus-lg"></i> {{ __('company.common.84') }}</a
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
                    <a class="dropdown-item" href="{{ route('company.drivers.export') }}"
                      ><i class="bi bi-file-earmark-excel"></i> {{ __('company.common.302') }}</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="table-card mb-4">
            <div class="table-toolbar">
              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="driversSearchInput"  placeholder="{{ __('company.common.133') }}" />
              </div>
            </div>
            <div class="table-responsive-custom">
              <table class="data-table" id="driversTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.149') }}</th>
                    <th>{{ __('company.common.396') }}</th>
                    <th>{{ __('company.drivers.column_branches') }}</th>
                    <th>{{ __('company.drivers.column_status') }}</th>
                    <th>{{ __('company.common.76') }}</th>
                  </tr>
                </thead>
                <tbody id="driversTableBody">
                  <tr>
                    <td colspan="5" class="text-center py-4">{{ __('company.common.212') }}</td>
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
              <div class="table-pagination__pages" id="driversTablePages"></div>
            </div>
          </div>
@endsection

@push('modals')
</main>

@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
    var dataUrl = '{{ route('company.drivers.data') }}';
    var statusUrl = '{{ route('company.drivers.status', ['driver' => 0]) }}';
    var deleteUrl = '{{ route('company.drivers.destroy', ['driver' => 0]) }}';
    var editUrl = '{{ route('company.edit-driver', ['driver' => 0]) }}';
    var csrf = document.querySelector('meta[name="csrf-token"]');
    var isAr = @json(app()->getLocale() === 'ar');

    var noDrivers = @json(__('company.drivers.no_drivers'));
    var deleteConfirm = @json(__('company.messages.delete_confirm'));
    var deleteLabel = @json(__('company.drivers.delete_label'));
    var editLabel = @json(__('company.drivers.edit_label'));
    var activeLabel = @json(__('company.common.544'));
    var inactiveLabel = @json(__('company.common.455'));
    var allBranchesLabel = @json(__('company.drivers.all_branches_label'));

    var tbody = document.getElementById('driversTableBody');
    var searchInput = document.getElementById('driversSearchInput');
    var pageSizeSelect = document.getElementById('pageSizeSelect');
    var pagesWrap = document.getElementById('driversTablePages');

    var state = { search: '', page: 1, per_page: 10 };

    function escapeHtml(value) {
      return String(value).replace(/[&<>"']/g, function (c) {
        return {
          '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;',
        }[c];
      });
    }

    function withId(template, id) {
      return template.replace(/\/0(\/|$)/, '/' + id + '$1');
    }

    function branchText(driver) {
      if (driver.assigned_to_all_branches) {
        return escapeHtml(allBranchesLabel);
      }

      var names = (driver.branches || []).map(function (branch) {
        return isAr ? branch.name_ar : branch.name_en;
      });

      return names.length ? escapeHtml(names.join('، ')) : '—';
    }

    function statusToggle(driver) {
      var isActive = !!driver.is_active;

      return (
        '<button type="button" class="status-toggle ' +
        (isActive ? 'status-toggle--active' : 'status-toggle--inactive') +
        '" data-status="' + (isActive ? 'active' : 'inactive') +
        '" data-driver="' + driver.id + '">' +
        escapeHtml(isActive ? activeLabel : inactiveLabel) +
        '</button>'
      );
    }

    function load() {
      var params = new URLSearchParams({
        search: state.search,
        page: state.page,
        per_page: state.per_page,
      });

      return fetch(dataUrl + '?' + params.toString(), {
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
              '<tr><td colspan="5" class="text-center py-4">' + escapeHtml(noDrivers) + '</td></tr>';
          } else {
            tbody.innerHTML = rows
              .map(function (d) {
                var phone = ((d.phone_code || '') + (d.phone || '')).replace('++', '+');

                return (
                  '<tr>' +
                  '<td>' + escapeHtml(d.name || '—') + '</td>' +
                  '<td class="ltr-num">' + escapeHtml(phone || '—') + '</td>' +
                  '<td class="cell-secondary">' + branchText(d) + '</td>' +
                  '<td>' + statusToggle(d) + '</td>' +
                  '<td class="cell-actions">' +
                  '<a href="' + withId(editUrl, d.id) + '" class="btn btn-primary btn-sm" title="' +
                  escapeHtml(editLabel) + '"><i class="bi bi-pencil"></i></a>' +
                  '<button class="btn btn-danger btn-sm" data-delete="' + d.id +
                  '" data-name="' + escapeHtml(d.name || '') + '" title="' +
                  escapeHtml(deleteLabel) + '"><i class="bi bi-trash"></i></button>' +
                  '</td>' +
                  '</tr>'
                );
              })
              .join('');
          }

          renderPagination(pagination);
        })
        .catch(function () {
          tbody.innerHTML =
            '<tr><td colspan="5" class="text-center py-4">—</td></tr>';
        });
    }

    function renderPagination(pagination) {
      if (!pagesWrap) return;

      var last = pagination.last_page || 1;
      var current = pagination.current_page || 1;
      state.page = current;

      if (pagination.total === undefined || pagination.total <= state.per_page) {
        pagesWrap.innerHTML = '';
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

    if (pageSizeSelect) {
      pageSizeSelect.addEventListener('change', function () {
        state.per_page = parseInt(this.value, 10) || 10;
        state.page = 1;
        load();
      });
    }

    // Status toggle
    tbody.addEventListener('click', function (e) {
      var btn = e.target.closest('.status-toggle');
      if (!btn) return;

      var id = btn.getAttribute('data-driver');
      var isActive = btn.getAttribute('data-status') !== 'active';

      btn.disabled = true;

      fetch(withId(statusUrl, id), {
        method: 'PATCH',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': csrf.content,
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify({ is_active: isActive }),
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
        .catch(function () {})
        .then(function () {
          btn.disabled = false;
        });
    });

    // Delete
    tbody.addEventListener('click', function (e) {
      var link = e.target.closest('[data-delete]');
      if (!link) return;
      e.preventDefault();

      if (!window.confirm(decodeConfirm(deleteConfirm, link.getAttribute('data-name')))) return;

      fetch(withId(deleteUrl, link.getAttribute('data-delete')), {
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
