@extends('admin.layouts.master')

@section('title', $config['entity'] . ' | ' . __('admin.panel_name'))

@section('content')
  <div class="card card-lg">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3 border-bottom">
      <h5 class="mb-0 d-flex align-items-center gap-2">
        <i class="ti {{ $config['icon'] }}"></i>
        <span>{{ $config['entity'] }}</span>
      </h5>

      <div class="d-flex flex-wrap align-items-center gap-2 ms-auto">
        <div class="position-relative">
          <input type="text" id="branchSearch" class="form-control ps-5" style="min-width: 240px;"
            placeholder="{{ __('admin.branches.placeholder_search') }}" autocomplete="off">
          <i class="ti ti-search position-absolute top-50 translate-middle-y text-secondary" style="inset-inline-start: 14px;"></i>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table text-nowrap mb-0 table-centered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('admin.branches.table_branch') }}</th>
            <th>{{ __('admin.branches.table_company') }}</th>
            <th>{{ __('admin.branches.table_person') }}</th>
            <th>{{ __('admin.branches.table_phone') }}</th>
            <th>{{ __('admin.branches.table_address') }}</th>
            <th>{{ __('admin.branches.table_type') }}</th>
            <th>{{ __('admin.branches.table_submitted') }}</th>
            <th>{{ __('admin.branches.table_status') }}</th>
            <th>{{ __('admin.common.actions') }}</th>
          </tr>
        </thead>
        <tbody id="branchesTableBody"></tbody>
      </table>
    </div>

    {{-- Empty state --}}
    <div id="branchesEmpty" class="text-center py-16 px-4 d-none">
      <div class="icon-shape icon-xl rounded-circle bg-gray-200 text-secondary d-inline-flex align-items-center justify-content-center mb-4">
        <i class="ti {{ $config['icon'] }}" style="font-size:32px"></i>
      </div>
      <h6 class="mb-1">{{ __('admin.branches.empty_title') }}</h6>
      <p class="text-secondary mb-0">{{ __('admin.branches.empty_text') }}</p>
    </div>

    {{-- Pagination --}}
    <div class="card-footer d-flex flex-wrap justify-content-between align-items-center gap-2 border-top">
      <small class="text-secondary" id="branchesSummary"></small>
      <nav aria-label="pagination"><ul class="pagination pagination-sm mb-0" id="branchesPagination"></ul></nav>
    </div>
  </div>

  @include('admin.partials.flash')
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const listUrl = @json(route('admin.branches.index'));
      const i18n = {
        confirmTitle: @json(__('admin.common.confirm_title')),
        approveConfirm: @json(__('admin.branches.approve_confirm')),
        rejectConfirm: @json(__('admin.branches.reject_confirm')),
        approveButton: @json(__('admin.branches.approve')),
        rejectButton: @json(__('admin.branches.reject')),
        networkError: @json(__('admin.common.network_error')),
        sessionExpired: @json(__('admin.messages.session_expired')),
        loading: @json(__('admin.common.loading')),
        noResults: @json(__('admin.branches.no_results')),
        typeBranch: @json(__('admin.branches.type_branch')),
        typeWithdrawal: @json(__('admin.branches.type_withdrawal')),
        statusPending: @json(__('admin.branches.status_pending')),
        statusApproved: @json(__('admin.branches.status_approved')),
        statusReject: @json(__('admin.branches.status_reject')),
      };

      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
      const jsonHeaders = { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' };
      const numberFormatter = new Intl.NumberFormat(document.body.getAttribute('data-locale') === 'ar' ? 'ar-EG' : 'en-US');
      const adminLocale = document.body.getAttribute('data-locale') || 'en';

      const tbody = document.getElementById('branchesTableBody');
      const emptyState = document.getElementById('branchesEmpty');
      const summaryEl = document.getElementById('branchesSummary');
      const paginationEl = document.getElementById('branchesPagination');
      const searchInput = document.getElementById('branchSearch');

      let rowsCache = [];
      let paginationMeta = null;
      let currentPage = 1;

      function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, (char) => ({
          '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;',
        }[char]));
      }

      function formatDate(value) {
        if (!value) return '—';
        return new Date(value).toLocaleDateString(
          adminLocale === 'ar' ? 'ar-EG' : 'en-GB',
          { day: '2-digit', month: 'short', year: 'numeric' }
        );
      }

      async function requestJson(url, options = {}) {
        const response = await fetch(url, options);
        const payload = await response.json().catch(() => null);
        return { ok: response.ok, status: response.status, payload };
      }

      function statusBadge(status) {
        const label = {
          pending: i18n.statusPending,
          approved: i18n.statusApproved,
          reject: i18n.statusReject,
        }[status] || escapeHtml(status);
        const tone = {
          pending: 'bg-warning-subtle text-warning',
          approved: 'bg-success-subtle text-success',
          reject: 'bg-danger-subtle text-danger',
        }[status] || 'bg-secondary-subtle text-secondary';
        return `<span class="badge ${tone}">${escapeHtml(label)}</span>`;
      }

      // ---------- List ----------
      async function loadBranches() {
        const params = new URLSearchParams({ page: currentPage });
        if (searchInput.value.trim()) params.set('search', searchInput.value.trim());

        tbody.innerHTML = `<tr><td colspan="10" class="text-center text-secondary py-4">${escapeHtml(i18n.loading)}</td></tr>`;

        try {
          const { ok, status, payload } = await requestJson(`${listUrl}?${params}`, { headers: jsonHeaders });

          if (status === 401) {
            if (window.adminToast) window.adminToast(i18n.sessionExpired, 'danger');
            return;
          }
          if (!ok || !payload) {
            if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
            tbody.innerHTML = '';
            return;
          }

          rowsCache = payload.data || [];
          paginationMeta = payload.pagination || null;
          renderRows();
          renderPagination(payload.pagination);
        } catch (e) {
          tbody.innerHTML = '';
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        }
      }

      function renderRows() {
        emptyState.classList.toggle('d-none', rowsCache.length > 0);

        const offset = paginationMeta ? (paginationMeta.current_page - 1) * paginationMeta.per_page : 0;

        tbody.innerHTML = rowsCache.map((branch, index) => {
          const rowNumber = offset + index + 1;
          const name = adminLocale === 'ar' ? branch.name_ar : branch.name_en;
          const company = branch.company ? (branch.company.name || '—') : '—';
          const type = (branch.branch_type === 'withdrawal')
            ? i18n.typeWithdrawal
            : i18n.typeBranch;
          const phone = ((branch.phone_code || '') + (branch.phone_number || '')).replace('++', '+') || '—';

          return `
            <tr data-branch-id="${branch.id}">
              <td>${numberFormatter.format(rowNumber)}</td>
              <td>
                <div class="fw-semibold">${escapeHtml(name || branch.name_ar || branch.name_en || '—')}</div>
              </td>
              <td>${escapeHtml(company)}</td>
              <td>${escapeHtml(branch.person_name || '—')}</td>
              <td dir="ltr">${escapeHtml(phone)}</td>
              <td style="max-width: 280px;">
                <div class="text-truncate">${escapeHtml(branch.address || '—')}</div>
              </td>
              <td>${escapeHtml(type)}</td>
              <td>${formatDate(branch.created_at)}</td>
              <td>${statusBadge(branch.status)}</td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <button type="button" class="btn btn-success btn-sm d-inline-flex align-items-center gap-1 js-approve">
                    <i class="ti ti-check"></i>
                    <span>${escapeHtml(i18n.approveButton)}</span>
                  </button>
                  <button type="button" class="btn btn-white btn-sm text-danger d-inline-flex align-items-center gap-1 js-reject">
                    <i class="ti ti-x"></i>
                    <span>${escapeHtml(i18n.rejectButton)}</span>
                  </button>
                </div>
              </td>
            </tr>`;
        }).join('');
      }

      function renderPagination(pagination) {
        if (!pagination) {
          summaryEl.textContent = '';
          paginationEl.innerHTML = '';
          return;
        }

        summaryEl.textContent = `${numberFormatter.format(pagination.from ?? 0)} - ${numberFormatter.format(pagination.to ?? 0)} / ${numberFormatter.format(pagination.total)}`;

        const pages = [];
        const pushPage = (page, label, active, disabled, isPrevNext = false) => pages.push(`
          <li class="page-item ${active ? 'active' : ''} ${disabled ? 'disabled' : ''}">
            <a class="page-link ${isPrevNext ? 'px-2' : ''}" href="#" data-page="${page}">
              ${isPrevNext ? label : numberFormatter.format(page)}
            </a>
          </li>`);

        pushPage(pagination.current_page - 1, '<i class="ti ti-chevron-left"></i>', false, pagination.current_page <= 1, true);
        for (let page = 1; page <= pagination.last_page; page++) {
          pushPage(page, null, page === pagination.current_page, false);
        }
        pushPage(pagination.current_page + 1, '<i class="ti ti-chevron-right"></i>', false, pagination.current_page >= pagination.last_page, true);

        paginationEl.innerHTML = pages.join('');
      }

      paginationEl.addEventListener('click', function (event) {
        const link = event.target.closest('[data-page]');
        if (!link || link.parentElement.classList.contains('disabled')) return;
        event.preventDefault();

        const page = parseInt(link.getAttribute('data-page'), 10);
        if (!Number.isFinite(page)) return;

        currentPage = page;
        loadBranches();
      });

      // ---------- Search ----------
      let searchTimer = null;
      searchInput.addEventListener('input', () => {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
          currentPage = 1;
          loadBranches();
        }, 300);
      });

      // ---------- Approve / Reject ----------
      tbody.addEventListener('click', async function (event) {
        const row = event.target.closest('[data-branch-id]');
        if (!row) return;

        const branchId = row.getAttribute('data-branch-id');

        let confirmText;
        let confirmButton;
        let action;
        if (event.target.closest('.js-approve')) {
          confirmText = i18n.approveConfirm;
          confirmButton = i18n.approveButton;
          action = 'approve';
        } else if (event.target.closest('.js-reject')) {
          confirmText = i18n.rejectConfirm;
          confirmButton = i18n.rejectButton;
          action = 'reject';
        } else {
          return;
        }

        const confirmed = await window.adminConfirm({
          title: i18n.confirmTitle,
          text: confirmText,
          confirmText: confirmButton,
        });
        if (!confirmed) return;

        const btn = event.target.closest('button');
        if (btn) btn.disabled = true;

        try {
          const { ok, status, payload } = await requestJson(`${listUrl}/${branchId}/${action}`, {
            method: 'POST',
            headers: { ...jsonHeaders, 'X-CSRF-TOKEN': csrfToken },
          });

          if (status === 401) {
            if (window.adminToast) window.adminToast(i18n.sessionExpired, 'danger');
          } else if (ok) {
            if (window.adminToast) window.adminToast(payload?.message || 'OK', 'success');
            loadBranches();
          } else {
            if (window.adminToast) window.adminToast(payload?.message || i18n.networkError, 'danger');
          }
        } catch (e) {
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        } finally {
          if (btn) btn.disabled = false;
        }
      });

      loadBranches();
    });
  </script>
@endpush