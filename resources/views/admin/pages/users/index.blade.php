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
          <input type="text" id="userSearch" class="form-control ps-5" style="min-width: 240px;"
            placeholder="{{ __('admin.users.placeholder_search') }}" autocomplete="off">
          <i class="ti ti-search position-absolute top-50 translate-middle-y text-secondary" style="inset-inline-start: 14px;"></i>
        </div>

        <button type="button" id="addUserBtn" class="btn btn-primary d-inline-flex align-items-center gap-1">
          <i class="ti ti-plus"></i>
          <span>{{ __('admin.users.add_new') }}</span>
        </button>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table text-nowrap mb-0 table-centered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('admin.users.table_user') }}</th>
            <th>{{ __('admin.users.table_phone') }}</th>
            <th>{{ __('admin.users.table_email') }}</th>
            <th>{{ __('admin.users.table_balance') }}</th>
            <th>{{ __('admin.users.table_joined') }}</th>
            <th>{{ __('admin.common.actions') }}</th>
          </tr>
        </thead>
        <tbody id="usersTableBody"></tbody>
      </table>
    </div>

    {{-- Empty state --}}
    <div id="usersEmpty" class="text-center py-16 px-4 d-none">
      <div class="icon-shape icon-xl rounded-circle bg-gray-200 text-secondary d-inline-flex align-items-center justify-content-center mb-4">
        <i class="ti ti-users" style="font-size:32px"></i>
      </div>
      <h6 class="mb-1">{{ __('admin.users.empty_title') }}</h6>
      <p class="text-secondary mb-4">{{ __('admin.users.empty_text') }}</p>
      <button type="button" class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1 js-open-create">
        <i class="ti ti-plus"></i>
        <span>{{ __('admin.users.add_new') }}</span>
      </button>
    </div>

    {{-- Pagination --}}
    <div class="card-footer d-flex flex-wrap justify-content-between align-items-center gap-2 border-top">
      <small class="text-secondary" id="usersSummary"></small>
      <nav aria-label="pagination"><ul class="pagination pagination-sm mb-0" id="usersPagination"></ul></nav>
    </div>
  </div>

  {{-- Create / Edit Modal --}}
  <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalTitle">{{ __('admin.users.add_new') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="userForm" novalidate>
            <input type="hidden" name="_method" value="POST">

            <div class="row g-4">
              <div class="col-md-6">
                <label class="form-label" for="userName">{{ __('admin.users.field_name') }}</label>
                <input type="text" name="name" id="userName" class="form-control"
                  placeholder="{{ __('admin.users.placeholder_name') }}">
                <div class="invalid-feedback" data-error-for="name"></div>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="userEmail">{{ __('admin.users.field_email') }}</label>
                <input type="email" name="email" id="userEmail" dir="ltr" class="form-control"
                  placeholder="{{ __('admin.users.placeholder_email') }}">
                <div class="invalid-feedback" data-error-for="email"></div>
              </div>

              <div class="col-md-3 col-4">
                <label class="form-label" for="userPhoneCode">{{ __('admin.users.field_phone_code') }}</label>
                <input type="text" name="phone_code" id="userPhoneCode" dir="ltr" class="form-control"
                  placeholder="{{ __('admin.users.placeholder_phone_code') }}">
                <div class="invalid-feedback" data-error-for="phone_code"></div>
              </div>

              <div class="col-md-9 col-8">
                <label class="form-label" for="userPhone">{{ __('admin.users.field_phone') }}</label>
                <input type="tel" name="phone" id="userPhone" dir="ltr" class="form-control"
                  placeholder="{{ __('admin.users.placeholder_phone') }}">
                <div class="invalid-feedback" data-error-for="phone"></div>
              </div>

              <div class="col-md-4">
                <label class="form-label" for="userBirthDate">{{ __('admin.users.field_birth_date') }}</label>
                <input type="date" name="birth_date" id="userBirthDate" dir="ltr" class="form-control">
                <div class="invalid-feedback" data-error-for="birth_date"></div>
              </div>

              <div class="col-md-4">
                <label class="form-label" for="userBalance">{{ __('admin.users.field_balance') }}</label>
                <input type="number" step="0.01" min="0" name="balance" id="userBalance" dir="ltr" class="form-control">
                <div class="invalid-feedback" data-error-for="balance"></div>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="userLang">{{ __('admin.users.field_lang') }}</label>
                <select name="lang" id="userLang" class="form-select">
                  <option value="">{{ __('admin.common.all') }}</option>
                  <option value="ar">{{ __('admin.users.lang_arabic') }}</option>
                  <option value="en">{{ __('admin.users.lang_english') }}</option>
                </select>
                <div class="invalid-feedback" data-error-for="lang"></div>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="userAddress">{{ __('admin.users.field_address') }}</label>
                <input type="text" name="address_name" id="userAddress" class="form-control"
                  placeholder="{{ __('admin.users.placeholder_address') }}">
                <div class="invalid-feedback" data-error-for="address_name"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-bs-dismiss="modal">{{ __('admin.content.cancel') }}</button>
          <button type="button" id="userSaveBtn" class="btn btn-primary d-inline-flex align-items-center gap-2">
            <i class="ti ti-device-floppy"></i>
            <span>{{ __('admin.content.save') }}</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  @include('admin.partials.flash')
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const listUrl = @json(route('admin.users.index'));
      const i18n = {
        confirmTitle: @json(__('admin.common.confirm_title')),
        confirmButton: @json(__('admin.common.confirm_delete')),
        confirmDelete: @json(__('admin.users.delete_confirm')),
        networkError: @json(__('admin.common.network_error')),
        sessionExpired: @json(__('admin.messages.session_expired')),
        loading: @json(__('admin.common.loading')),
        addTitle: @json(__('admin.users.add_new')),
        editTitle: @json(__('admin.users.edit_user')),
      };

      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
      const jsonHeaders = { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' };
      const numberFormatter = new Intl.NumberFormat(document.body.getAttribute('data-locale') === 'ar' ? 'ar-EG' : 'en-US');

      const tbody = document.getElementById('usersTableBody');
      const emptyState = document.getElementById('usersEmpty');
      const summaryEl = document.getElementById('usersSummary');
      const paginationEl = document.getElementById('usersPagination');
      const searchInput = document.getElementById('userSearch');

      const modalEl = document.getElementById('userModal');
      const userModal = new bootstrap.Modal(modalEl);
      const form = document.getElementById('userForm');
      const modalTitle = document.getElementById('userModalTitle');
      const saveBtn = document.getElementById('userSaveBtn');

      let usersCache = [];
      let paginationMeta = null;
      let currentPage = 1;
      let editingId = null;

      function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, (char) => ({
          '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;',
        }[char]));
      }

      function formatDate(value) {
        if (!value) return '—';
        return new Date(value).toLocaleDateString(
          document.body.getAttribute('data-locale') === 'ar' ? 'ar-EG' : 'en-GB',
          { day: '2-digit', month: 'short', year: 'numeric' }
        );
      }

      async function requestJson(url, options = {}) {
        const response = await fetch(url, options);
        const payload = await response.json().catch(() => null);
        return { ok: response.ok, status: response.status, payload };
      }

      // ---------- List ----------
      async function loadUsers() {
        const params = new URLSearchParams({ page: currentPage });
        if (searchInput.value.trim()) params.set('search', searchInput.value.trim());

        tbody.innerHTML = `<tr><td colspan="7" class="text-center text-secondary py-4">${escapeHtml(i18n.loading)}</td></tr>`;

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

          usersCache = payload.data || [];
          paginationMeta = payload.pagination || null;
          renderRows();
          renderPagination(payload.pagination);
        } catch (e) {
          tbody.innerHTML = '';
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        }
      }

      function renderRows() {
        emptyState.classList.toggle('d-none', usersCache.length > 0);

        const offset = paginationMeta ? (paginationMeta.current_page - 1) * paginationMeta.per_page : 0;

        tbody.innerHTML = usersCache.map((user, index) => {
          const rowNumber = offset + index + 1;
          const initials = (user.name || '?').trim().charAt(0).toUpperCase();
          const email = user.email
            ? `<a href="mailto:${escapeHtml(user.email)}" class="text-reset">${escapeHtml(user.email)}</a>`
            : '<span class="text-secondary">—</span>';
          const balance = user.balance !== null && user.balance !== undefined
            ? numberFormatter.format(parseFloat(user.balance))
            : numberFormatter.format(0);

          return `
            <tr data-user-id="${user.id}">
              <td>${numberFormatter.format(rowNumber)}</td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <div class="avatar avatar-sm rounded-circle bg-primary-subtle text-primary-emphasis d-flex align-items-center justify-content-center fw-semibold">${escapeHtml(initials)}</div>
                  <span>${escapeHtml(user.name || '—')}</span>
                </div>
              </td>
              <td dir="ltr"><span class="text-secondary">${escapeHtml(user.phone_code || '')}</span> ${escapeHtml(user.phone)}</td>
              <td>${email}</td>
              <td>${balance}</td>
              <td>${formatDate(user.created_at)}</td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <button type="button" class="btn btn-white btn-sm d-inline-flex align-items-center gap-1 js-edit">
                    <i class="ti ti-pencil"></i>
                    <span>{{ __('admin.content.edit') }}</span>
                  </button>
                  <button type="button" class="btn btn-white btn-sm text-danger d-inline-flex align-items-center gap-1 js-delete"
                    data-confirm="${escapeHtml(i18n.confirmDelete)}">
                    <i class="ti ti-trash"></i>
                    <span>{{ __('admin.content.delete') }}</span>
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
        loadUsers();
      });

      // ---------- Search ----------
      let searchTimer = null;
      searchInput.addEventListener('input', () => {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
          currentPage = 1;
          loadUsers();
        }, 300);
      });

      // ---------- Form helpers ----------
      function clearErrors() {
        form.querySelectorAll('.invalid-feedback').forEach((el) => { el.textContent = ''; });
        form.querySelectorAll('.form-control, .form-select').forEach((el) => el.classList.remove('is-invalid'));
      }

      function showErrors(errors) {
        Object.entries(errors || {}).forEach(([field, messages]) => {
          const feedback = form.querySelector(`[data-error-for="${field}"]`);
          if (!feedback) return;
          feedback.textContent = Array.isArray(messages) ? messages[0] : String(messages);
          const input = form.querySelector(`[name="${field}"]`);
          if (input) input.classList.add('is-invalid');
        });
      }

      function openCreate() {
        editingId = null;
        clearErrors();
        form.reset();
        form.querySelector('[name="_method"]').value = 'POST';
        modalTitle.textContent = i18n.addTitle;
        userModal.show();
      }

      function openEdit(user) {
        editingId = user.id;
        clearErrors();
        form.reset();
        form.querySelector('[name="_method"]').value = 'PUT';
        form.elements.name.value = user.name ?? '';
        form.elements.email.value = user.email ?? '';
        form.elements.phone_code.value = user.phone_code ?? '';
        form.elements.phone.value = user.phone ?? '';
        form.elements.birth_date.value = user.birth_date ?? '';
        form.elements.balance.value = user.balance ?? '';
        form.elements.lang.value = user.lang ?? '';
        form.elements.address_name.value = user.address_name ?? '';
        modalTitle.textContent = i18n.editTitle;
        userModal.show();
      }

      document.getElementById('addUserBtn').addEventListener('click', openCreate);
      document.querySelectorAll('.js-open-create').forEach((btn) => btn.addEventListener('click', openCreate));

      // ---------- Row actions ----------
      tbody.addEventListener('click', async function (event) {
        const row = event.target.closest('[data-user-id]');
        if (!row) return;

        const userId = parseInt(row.getAttribute('data-user-id'), 10);
        const user = usersCache.find((item) => item.id === userId);
        if (!user) return;

        if (event.target.closest('.js-edit')) {
          openEdit(user);
          return;
        }

        const deleteBtn = event.target.closest('.js-delete');
        if (!deleteBtn) return;
                const confirmed = await window.adminConfirm({
          title: i18n.confirmTitle,
          text: deleteBtn.getAttribute('data-confirm'),
          confirmText: i18n.confirmButton,
        });
        if (!confirmed) return;

        deleteBtn.disabled = true;
        try {
          const { ok, status, payload } = await requestJson(listUrl + '/' + userId, {
            method: 'DELETE',
            headers: { ...jsonHeaders, 'X-CSRF-TOKEN': csrfToken },
          });

          if (status === 401) {
            if (window.adminToast) window.adminToast(i18n.sessionExpired, 'danger');
          } else if (ok) {
            if (window.adminToast) window.adminToast(payload?.message || 'OK', 'success');
            loadUsers();
          } else {
            if (window.adminToast) window.adminToast(payload?.message || i18n.networkError, 'danger');
          }
        } catch (e) {
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        } finally {
          deleteBtn.disabled = false;
        }
      });

      // ---------- Save (create / update) ----------
      saveBtn.addEventListener('click', async function () {
        clearErrors();

        const formData = new FormData(form);
        if (editingId) formData.set('_method', 'PUT');

        const url = editingId ? listUrl + '/' + editingId : listUrl;
        saveBtn.disabled = true;

        try {
          const { ok, status, payload } = await requestJson(url, {
            method: 'POST',
            headers: { ...jsonHeaders, 'X-CSRF-TOKEN': csrfToken },
            body: formData,
          });

          if (status === 401) {
            if (window.adminToast) window.adminToast(i18n.sessionExpired, 'danger');
            return;
          }
          if (status === 422 && payload?.errors) {
            showErrors(payload.errors);
            if (window.adminToast) window.adminToast(payload?.message || '', 'danger');
            return;
          }
          if (ok) {
            if (window.adminToast) window.adminToast(payload?.message || 'OK', 'success');
            userModal.hide();
            if (!searchInput.value.trim()) currentPage = 1;
            loadUsers();
          } else {
            if (window.adminToast) window.adminToast(payload?.message || i18n.networkError, 'danger');
          }
        } catch (e) {
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        } finally {
          saveBtn.disabled = false;
        }
      });

      loadUsers();
    });
  </script>
@endpush
