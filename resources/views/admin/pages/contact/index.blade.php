@extends('admin.layouts.master')

@section('title', $config['entity'] . ' | ' . __('admin.panel_name'))

@section('content')
  <div class="card card-lg">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3 border-bottom">
      <h5 class="mb-0 d-flex align-items-center gap-2">
        <i class="ti {{ $config['icon'] }}"></i>
        <span>{{ $config['entity'] }}</span>
      </h5>

      <ul class="nav nav-pills-white nav-fill" id="contactTabs" role="tablist">
        @foreach (['all' => 'ti-planet', 'user' => 'ti-user', 'driver' => 'ti-steering-wheel'] as $tab => $icon)
          <li class="nav-item" role="presentation">
            <button type="button" class="nav-link {{ $loop->first ? 'active' : '' }}" data-type-filter="{{ $tab }}"
              aria-selected="{{ $loop->first ? 'true' : 'false' }}">
              <span class="d-flex align-items-center gap-2">
                <span><i class="ti {{ $icon }}"></i></span>
                <span>{{ $tab === 'all' ? __('admin.common.all') : __('admin.content.badge_' . $tab) }}</span>
              </span>
            </button>
          </li>
        @endforeach
      </ul>

      <div class="position-relative ms-auto">
        <input type="text" id="contactSearch" class="form-control ps-5" style="min-width: 240px;"
          placeholder="{{ __('admin.contact.placeholder_search') }}" autocomplete="off">
        <i class="ti ti-search position-absolute top-50 translate-middle-y text-secondary" style="inset-inline-start: 14px;"></i>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table text-nowrap mb-0 table-centered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('admin.contact.table_sender') }}</th>
            <th>{{ __('admin.contact.table_reason') }}</th>
            <th>{{ __('admin.content.table_type') }}</th>
            <th>{{ __('admin.contact.table_lang') }}</th>
            <th>{{ __('admin.content.table_date') }}</th>
            <th>{{ __('admin.common.actions') }}</th>
          </tr>
        </thead>
        <tbody id="contactsTableBody"></tbody>
      </table>
    </div>

    {{-- Empty state --}}
    <div id="contactsEmpty" class="text-center py-16 px-4 d-none">
      <div class="icon-shape icon-xl rounded-circle bg-gray-200 text-secondary d-inline-flex align-items-center justify-content-center mb-4">
        <i class="ti {{ $config['icon'] }}" style="font-size:32px"></i>
      </div>
      <h6 class="mb-1">{{ __('admin.contact.empty_title') }}</h6>
      <p class="text-secondary">{{ __('admin.contact.empty_text') }}</p>
    </div>

    {{-- Pagination --}}
    <div class="card-footer d-flex flex-wrap justify-content-between align-items-center gap-2 border-top">
      <small class="text-secondary" id="contactsSummary"></small>
      <nav aria-label="pagination"><ul class="pagination pagination-sm mb-0" id="contactsPagination"></ul></nav>
    </div>
  </div>

  {{-- Message details modal --}}
  <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center gap-2">
            <i class="ti ti-mail-open"></i>
            <span>{{ __('admin.contact.message_details') }}</span>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <dl class="row mb-0">
            <dt class="col-sm-3">{{ __('admin.contact.field_name') }}</dt>
            <dd class="col-sm-9" id="detailName"></dd>

            <dt class="col-sm-3">{{ __('admin.login.email') }}</dt>
            <dd class="col-sm-9" id="detailEmail"></dd>

            <dt class="col-sm-3">{{ __('admin.contact.field_reason') }}</dt>
            <dd class="col-sm-9" id="detailReason">—</dd>

            <dt class="col-sm-3">{{ __('admin.contact.field_order_number') }}</dt>
            <dd class="col-sm-9" id="detailOrderNumber">—</dd>

            <dt class="col-sm-3">{{ __('admin.contact.table_date') }}</dt>
            <dd class="col-sm-9" id="detailDate"></dd>

            <dt class="col-sm-3">{{ __('admin.contact.field_lang') }}</dt>
            <dd class="col-sm-9" id="detailLang"></dd>

            <dt class="col-sm-3 mt-3">{{ __('admin.contact.field_message') }}</dt>
            <dd class="col-sm-9 mt-3">
              <div class="bg-gray-100 p-3 rounded-3 text-wrap" id="detailMessage" style="white-space: pre-wrap;"></div>
            </dd>
          </dl>
        </div>
        <div class="modal-footer justify-content-between">
          <a href="#" id="detailMailto" class="btn btn-white d-inline-flex align-items-center gap-2">
            <i class="ti ti-send"></i>
            <span>{{ __('admin.contact.reply') }}</span>
          </a>
          <button type="button" class="btn btn-white" data-bs-dismiss="modal">{{ __('admin.content.cancel') }}</button>
        </div>
      </div>
    </div>
  </div>

  @include('admin.partials.flash')
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const listUrl = @json(route('admin.contact-us.index'));
      const i18n = {
        confirmTitle: @json(__('admin.common.confirm_title')),
        confirmButton: @json(__('admin.common.confirm_delete')),
        confirmDelete: @json(__('admin.contact.delete_confirm')),
        networkError: @json(__('admin.common.network_error')),
        sessionExpired: @json(__('admin.messages.session_expired')),
        loading: @json(__('admin.common.loading')),
        badgeUser: @json(__('admin.content.badge_user')),
        badgeDriver: @json(__('admin.content.badge_driver')),
        langArabic: @json(__('admin.contact.lang_arabic')),
        langEnglish: @json(__('admin.contact.lang_english')),
      };

      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
      const jsonHeaders = { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' };
      const numberFormatter = new Intl.NumberFormat(document.body.getAttribute('data-locale') === 'ar' ? 'ar-EG' : 'en-US');
      const adminLocale = document.body.getAttribute('data-locale') || 'en';

      const tbody = document.getElementById('contactsTableBody');
      const emptyState = document.getElementById('contactsEmpty');
      const summaryEl = document.getElementById('contactsSummary');
      const paginationEl = document.getElementById('contactsPagination');
      const searchInput = document.getElementById('contactSearch');

      const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));

      const badges = {
        user: { text: i18n.badgeUser, classes: 'badge text-info-emphasis bg-info-subtle' },
        driver: { text: i18n.badgeDriver, classes: 'badge text-warning-emphasis bg-warning-subtle' },
      };

      const langBadges = {
        ar: { text: i18n.langArabic, classes: 'badge text-success-emphasis bg-success-subtle' },
        en: { text: i18n.langEnglish, classes: 'badge text-primary-emphasis bg-primary-subtle' },
      };

      let contactsCache = [];
      let paginationMeta = null;
      let currentPage = 1;
      let currentType = 'all';

      function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, (char) => ({
          '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;',
        }[char]));
      }

      function isArabic(contact) {
        if (contact.lang) return contact.lang === 'ar';
        const sample = `${contact.name || ''} ${contact.reason || ''} ${contact.message || ''}`;
        return /[\u0600-\u06FF]/.test(sample);
      }

      function langBadge(contact) {
        return langBadges[isArabic(contact) ? 'ar' : 'en'] || langBadges.en;
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

      // ---------- List ----------
      async function loadContacts() {
        const params = new URLSearchParams({ page: currentPage });
        if (currentType !== 'all') params.set('type', currentType);
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

          contactsCache = payload.data || [];
          paginationMeta = payload.pagination || null;
          renderRows();
          renderPagination(payload.pagination);
        } catch (e) {
          tbody.innerHTML = '';
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        }
      }

      function renderRows() {
        emptyState.classList.toggle('d-none', contactsCache.length > 0);

        const offset = paginationMeta ? (paginationMeta.current_page - 1) * paginationMeta.per_page : 0;

        tbody.innerHTML = contactsCache.map((contact, index) => {
          const rowNumber = offset + index + 1;
          const badge = badges[contact.model] || badges.user;
          const lang = langBadge(contact);
          const reason = contact.reason
            ? escapeHtml(contact.reason)
            : (contact.order_number ? `# ${escapeHtml(contact.order_number)}` : '<span class="text-secondary">—</span>');

          return `
            <tr data-contact-id="${contact.id}">
              <td>${numberFormatter.format(rowNumber)}</td>
              <td style="max-width: 320px;">
                <div class="fw-semibold">${escapeHtml(contact.name)}</div>
                <div class="text-secondary small text-truncate">${escapeHtml(contact.email)}</div>
              </td>
              <td>${reason}</td>
              <td><span class="${escapeHtml(badge.classes)}">${escapeHtml(badge.text)}</span></td>
              <td><span class="${escapeHtml(lang.classes)}">${escapeHtml(lang.text)}</span></td>
              <td>${formatDate(contact.created_at)}</td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <button type="button" class="btn btn-white btn-sm d-inline-flex align-items-center gap-1 js-view">
                    <i class="ti ti-eye"></i>
                    <span>{{ __('admin.dashboard.view') }}</span>
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
        loadContacts();
      });

      // ---------- Tabs / Search ----------
      document.querySelectorAll('#contactTabs [data-type-filter]').forEach((tabBtn) => {
        tabBtn.addEventListener('click', () => {
          currentType = tabBtn.getAttribute('data-type-filter');
          currentPage = 1;

          document.querySelectorAll('#contactTabs [data-type-filter]').forEach((btn) => {
            const isActive = btn === tabBtn;
            btn.classList.toggle('active', isActive);
            btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
          });

          loadContacts();
        });
      });

      let searchTimer = null;
      searchInput.addEventListener('input', () => {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
          currentPage = 1;
          loadContacts();
        }, 300);
      });

      // ---------- Row actions ----------
      async function openDetails(contact) {
        try {
          const { ok, status, payload } = await requestJson(`${listUrl}/${contact.id}`, { headers: jsonHeaders });

          if (status === 401) {
            if (window.adminToast) window.adminToast(i18n.sessionExpired, 'danger');
            return;
          }
          if (!ok || !payload?.data?.message) {
            if (window.adminToast) window.adminToast(payload?.message || i18n.networkError, 'danger');
            return;
          }

          const message = payload.data.message;
          const lang = langBadge(message);
          const dir = isArabic(message) ? 'rtl' : 'ltr';

          document.getElementById('detailName').textContent = message.name ?? '—';
          document.getElementById('detailName').setAttribute('dir', dir);
          document.getElementById('detailEmail').textContent = message.email ?? '—';
          document.getElementById('detailReason').textContent = message.reason || '—';
          document.getElementById('detailReason').setAttribute('dir', dir);
          document.getElementById('detailOrderNumber').textContent = message.order_number || '—';
          document.getElementById('detailDate').textContent = formatDate(message.created_at);
          document.getElementById('detailLang').innerHTML =
            `<span class="${escapeHtml(lang.classes)}">${escapeHtml(lang.text)}</span>`;
          document.getElementById('detailMessage').textContent = message.message || '—';
          document.getElementById('detailMessage').setAttribute('dir', dir);
          document.getElementById('detailMailto').setAttribute('href', `mailto:${encodeURIComponent(message.email ?? '')}`);

          messageModal.show();
        } catch (e) {
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        }
      }

      tbody.addEventListener('click', async function (event) {
        const row = event.target.closest('[data-contact-id]');
        if (!row) return;

        const contactId = parseInt(row.getAttribute('data-contact-id'), 10);
        const contact = contactsCache.find((item) => item.id === contactId);
        if (!contact) return;

        if (event.target.closest('.js-view')) {
          openDetails(contact);
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
          const { ok, status, payload } = await requestJson(listUrl + '/' + contactId, {
            method: 'DELETE',
            headers: { ...jsonHeaders, 'X-CSRF-TOKEN': csrfToken },
          });

          if (status === 401) {
            if (window.adminToast) window.adminToast(i18n.sessionExpired, 'danger');
          } else if (ok) {
            if (window.adminToast) window.adminToast(payload?.message || 'OK', 'success');
            loadContacts();
          } else {
            if (window.adminToast) window.adminToast(payload?.message || i18n.networkError, 'danger');
          }
        } catch (e) {
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        } finally {
          deleteBtn.disabled = false;
        }
      });

      loadContacts();
    });
  </script>
@endpush
