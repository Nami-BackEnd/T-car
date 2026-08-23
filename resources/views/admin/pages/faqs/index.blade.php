@extends('admin.layouts.master')

@section('title', $config['entity'] . ' | ' . __('admin.panel_name'))

@section('content')
  <div class="card card-lg">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3 border-bottom">
      <h5 class="mb-0 d-flex align-items-center gap-2">
        <i class="ti {{ $config['icon'] }}"></i>
        <span>{{ $config['entity'] }}</span>
      </h5>

      <ul class="nav nav-pills-white nav-fill" id="faqTabs" role="tablist">
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

      <div class="d-flex flex-wrap align-items-center gap-2 ms-auto">
        <div class="position-relative">
          <input type="text" id="faqSearch" class="form-control ps-5" style="min-width: 220px;"
            placeholder="{{ __('admin.faqs.placeholder_search') }}" autocomplete="off">
          <i class="ti ti-search position-absolute top-50 translate-middle-y text-secondary" style="inset-inline-start: 14px;"></i>
        </div>

        <button type="button" id="addFaqBtn" class="btn btn-primary d-inline-flex align-items-center gap-1">
          <i class="ti ti-plus"></i>
          <span>{{ __('admin.content.add_new') }}</span>
        </button>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table text-nowrap mb-0 table-centered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('admin.faqs.table_question') }}</th>
            <th>{{ __('admin.content.table_type') }}</th>
            <th>{{ __('admin.content.table_date') }}</th>
            <th>{{ __('admin.common.actions') }}</th>
          </tr>
        </thead>
        <tbody id="faqsTableBody"></tbody>
      </table>
    </div>

    {{-- Empty state --}}
    <div id="faqsEmpty" class="text-center py-16 px-4 d-none">
      <div class="icon-shape icon-xl rounded-circle bg-gray-200 text-secondary d-inline-flex align-items-center justify-content-center mb-4">
        <i class="ti {{ $config['icon'] }}" style="font-size:32px"></i>
      </div>
      <h6 class="mb-1">{{ __('admin.faqs.empty_title') }}</h6>
      <p class="text-secondary mb-4">{{ __('admin.faqs.empty_text') }}</p>
      <button type="button" class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1 js-open-create">
        <i class="ti ti-plus"></i>
        <span>{{ __('admin.content.add_new') }}</span>
      </button>
    </div>

    {{-- Pagination --}}
    <div class="card-footer d-flex flex-wrap justify-content-between align-items-center gap-2 border-top">
      <small class="text-secondary" id="faqsSummary"></small>
      <nav aria-label="pagination"><ul class="pagination pagination-sm mb-0" id="faqsPagination"></ul></nav>
    </div>
  </div>

  {{-- Create / Edit Modal --}}
  <div class="modal fade" id="faqModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="faqModalTitle">{{ __('admin.faqs.add_faq') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="faqForm" novalidate>
            <input type="hidden" name="_method" value="POST">

            {{-- Audience selector --}}
            <div class="bg-gray-100 p-3 rounded-3 mb-4">
              <ul class="nav nav-pills-white nav-fill" role="tablist" id="faqAudience">
                <li class="nav-item" role="presentation">
                  <button type="button" class="nav-link active" data-audience="user" aria-selected="true">
                    <span class="d-flex align-items-center justify-content-center gap-2">
                      <span><i class="ti ti-user"></i></span>
                      <span>{{ __('admin.content.audience_user') }}</span>
                    </span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button type="button" class="nav-link" data-audience="driver" aria-selected="false">
                    <span class="d-flex align-items-center justify-content-center gap-2">
                      <span><i class="ti ti-steering-wheel"></i></span>
                      <span>{{ __('admin.content.audience_driver') }}</span>
                    </span>
                  </button>
                </li>
              </ul>
              <div class="text-center mt-2">
                <small class="text-secondary" id="faqAudienceHint">{{ __('admin.faqs.audience_hint_user') }}</small>
              </div>
            </div>

            {{-- Questions --}}
            <div class="row g-4">
              <div class="col-md-6">
                <label class="form-label" for="faqQuestionAr">{{ __('admin.faqs.field_question_ar') }}</label>
                <input type="text" name="question_ar" id="faqQuestionAr" dir="rtl" class="form-control"
                  placeholder="{{ __('admin.faqs.placeholder_question_ar') }}">
                <div class="invalid-feedback" data-error-for="question_ar"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="faqQuestionEn">{{ __('admin.faqs.field_question_en') }}</label>
                <input type="text" name="question_en" id="faqQuestionEn" dir="ltr" class="form-control"
                  placeholder="{{ __('admin.faqs.placeholder_question_en') }}">
                <div class="invalid-feedback" data-error-for="question_en"></div>
              </div>

              {{-- Answers --}}
              <div class="col-md-6">
                <label class="form-label" for="faqAnswerAr">{{ __('admin.faqs.field_answer_ar') }}</label>
                <textarea name="answer_ar" id="faqAnswerAr" rows="6" dir="rtl" class="form-control"
                  placeholder="{{ __('admin.faqs.placeholder_answer_ar') }}"></textarea>
                <div class="invalid-feedback" data-error-for="answer_ar"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="faqAnswerEn">{{ __('admin.faqs.field_answer_en') }}</label>
                <textarea name="answer_en" id="faqAnswerEn" rows="6" dir="ltr" class="form-control"
                  placeholder="{{ __('admin.faqs.placeholder_answer_en') }}"></textarea>
                <div class="invalid-feedback" data-error-for="answer_en"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-bs-dismiss="modal">{{ __('admin.content.cancel') }}</button>
          <button type="button" id="faqSaveBtn" class="btn btn-primary d-inline-flex align-items-center gap-2">
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
      const listUrl = @json(route('admin.faqs.index'));
      const i18n = {
        confirmTitle: @json(__('admin.common.confirm_title')),
        confirmButton: @json(__('admin.common.confirm_delete')),
        confirmDelete: @json(__('admin.faqs.delete_confirm')),
        networkError: @json(__('admin.common.network_error')),
        sessionExpired: @json(__('admin.messages.session_expired')),
        loading: @json(__('admin.common.loading')),
        addTitle: @json(__('admin.faqs.add_faq')),
        editTitle: @json(__('admin.faqs.edit_faq')),
        badgeUser: @json(__('admin.content.badge_user')),
        badgeDriver: @json(__('admin.content.badge_driver')),
        hintUser: @json(__('admin.faqs.audience_hint_user')),
        hintDriver: @json(__('admin.faqs.audience_hint_driver')),
      };

      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
      const jsonHeaders = { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' };
      const numberFormatter = new Intl.NumberFormat(document.body.getAttribute('data-locale') === 'ar' ? 'ar-EG' : 'en-US');
      const adminLocale = document.body.getAttribute('data-locale') || 'en';

      const tbody = document.getElementById('faqsTableBody');
      const emptyState = document.getElementById('faqsEmpty');
      const summaryEl = document.getElementById('faqsSummary');
      const paginationEl = document.getElementById('faqsPagination');
      const searchInput = document.getElementById('faqSearch');

      const modalEl = document.getElementById('faqModal');
      const faqModal = new bootstrap.Modal(modalEl);
      const form = document.getElementById('faqForm');
      const modalTitle = document.getElementById('faqModalTitle');
      const saveBtn = document.getElementById('faqSaveBtn');
      const audienceButtons = document.querySelectorAll('#faqAudience [data-audience]');
      const audienceHint = document.getElementById('faqAudienceHint');

      const hints = { user: i18n.hintUser, driver: i18n.hintDriver };
      const badges = {
        user: { text: i18n.badgeUser, classes: 'badge text-info-emphasis bg-info-subtle' },
        driver: { text: i18n.badgeDriver, classes: 'badge text-warning-emphasis bg-warning-subtle' },
      };

      let faqsCache = [];
      let paginationMeta = null;
      let currentPage = 1;
      let currentType = 'all';
      let editingId = null;

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

      // ---------- List ----------
      async function loadFaqs() {
        const params = new URLSearchParams({ page: currentPage });
        if (currentType !== 'all') params.set('type', currentType);
        if (searchInput.value.trim()) params.set('search', searchInput.value.trim());

        tbody.innerHTML = `<tr><td colspan="5" class="text-center text-secondary py-4">${escapeHtml(i18n.loading)}</td></tr>`;

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

          faqsCache = payload.data || [];
          paginationMeta = payload.pagination || null;
          renderRows();
          renderPagination(payload.pagination);
        } catch (e) {
          tbody.innerHTML = '';
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        }
      }

      function renderRows() {
        emptyState.classList.toggle('d-none', faqsCache.length > 0);

        const offset = paginationMeta ? (paginationMeta.current_page - 1) * paginationMeta.per_page : 0;

        tbody.innerHTML = faqsCache.map((faq, index) => {
          const rowNumber = offset + index + 1;
          const question = adminLocale === 'ar' ? faq.question_ar : faq.question_en;
          const answer = adminLocale === 'ar' ? faq.answer_ar : faq.answer_en;
          const badge = badges[faq.type] || badges.user;

          return `
            <tr data-faq-id="${faq.id}">
              <td>${numberFormatter.format(rowNumber)}</td>
              <td style="max-width: 480px;">
                <div class="text-truncate fw-semibold">${escapeHtml(question)}</div>
                <div class="text-truncate text-secondary small">${escapeHtml(answer)}</div>
              </td>
              <td><span class="${escapeHtml(badge.classes)}">${escapeHtml(badge.text)}</span></td>
              <td>${formatDate(faq.created_at)}</td>
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
        loadFaqs();
      });

      // ---------- Tabs / Search ----------
      document.querySelectorAll('#faqTabs [data-type-filter]').forEach((tabBtn) => {
        tabBtn.addEventListener('click', () => {
          currentType = tabBtn.getAttribute('data-type-filter');
          currentPage = 1;

          document.querySelectorAll('#faqTabs [data-type-filter]').forEach((btn) => {
            const isActive = btn === tabBtn;
            btn.classList.toggle('active', isActive);
            btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
          });

          loadFaqs();
        });
      });

      let searchTimer = null;
      searchInput.addEventListener('input', () => {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
          currentPage = 1;
          loadFaqs();
        }, 300);
      });

      // ---------- Form helpers ----------
      function setAudience(value) {
        if (!hints[value]) value = 'user';
        form.dataset.type = value;

        audienceButtons.forEach((btn) => {
          const isActive = btn.getAttribute('data-audience') === value;
          btn.classList.toggle('active', isActive);
          btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });

        if (audienceHint) audienceHint.textContent = hints[value];
      }

      audienceButtons.forEach((btn) => {
        btn.addEventListener('click', () => setAudience(btn.getAttribute('data-audience')));
      });

      function clearErrors() {
        form.querySelectorAll('.invalid-feedback').forEach((el) => { el.textContent = ''; });
        form.querySelectorAll('.form-control').forEach((el) => el.classList.remove('is-invalid'));
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
        setAudience(currentType !== 'driver' ? 'user' : 'driver');
        modalTitle.textContent = i18n.addTitle;
        faqModal.show();
      }

      function openEdit(faq) {
        editingId = faq.id;
        clearErrors();
        form.reset();
        form.querySelector('[name="_method"]').value = 'PUT';
        form.elements.question_ar.value = faq.question_ar ?? '';
        form.elements.question_en.value = faq.question_en ?? '';
        form.elements.answer_ar.value = faq.answer_ar ?? '';
        form.elements.answer_en.value = faq.answer_en ?? '';
        setAudience(faq.type);
        modalTitle.textContent = i18n.editTitle;
        faqModal.show();
      }

      document.getElementById('addFaqBtn').addEventListener('click', openCreate);
      document.querySelectorAll('.js-open-create').forEach((btn) => btn.addEventListener('click', openCreate));

      // ---------- Row actions ----------
      tbody.addEventListener('click', async function (event) {
        const row = event.target.closest('[data-faq-id]');
        if (!row) return;

        const faqId = parseInt(row.getAttribute('data-faq-id'), 10);
        const faq = faqsCache.find((item) => item.id === faqId);
        if (!faq) return;

        if (event.target.closest('.js-edit')) {
          openEdit(faq);
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
          const { ok, status, payload } = await requestJson(listUrl + '/' + faqId, {
            method: 'DELETE',
            headers: { ...jsonHeaders, 'X-CSRF-TOKEN': csrfToken },
          });

          if (status === 401) {
            if (window.adminToast) window.adminToast(i18n.sessionExpired, 'danger');
          } else if (ok) {
            if (window.adminToast) window.adminToast(payload?.message || 'OK', 'success');
            loadFaqs();
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
        formData.set('type', form.dataset.type || 'user');
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
            faqModal.hide();
            if (!searchInput.value.trim()) currentPage = 1;
            loadFaqs();
          } else {
            if (window.adminToast) window.adminToast(payload?.message || i18n.networkError, 'danger');
          }
        } catch (e) {
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        } finally {
          saveBtn.disabled = false;
        }
      });

      loadFaqs();
    });
  </script>
@endpush
