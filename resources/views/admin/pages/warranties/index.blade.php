@extends('admin.layouts.master')

@section('title', $config['entity'] . ' | ' . __('admin.panel_name'))

@section('content')
  <style>
    #warrantyModal .ck-editor__editable_inline {
      min-height: 300px;
    }
  </style>

  <div class="card card-lg">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3 border-bottom">
      <h5 class="mb-0 d-flex align-items-center gap-2">
        <i class="ti {{ $config['icon'] }}"></i>
        <span>{{ $config['entity'] }}</span>
      </h5>

      <div class="d-flex flex-wrap align-items-center gap-2 ms-auto">
        <div class="position-relative">
          <input type="text" id="warrantySearch" class="form-control ps-5" style="min-width: 220px;"
            placeholder="{{ __('admin.warranties.placeholder_search') }}" autocomplete="off">
          <i class="ti ti-search position-absolute top-50 translate-middle-y text-secondary" style="inset-inline-start: 14px;"></i>
        </div>

        <button type="button" id="addWarrantyBtn" class="btn btn-primary d-inline-flex align-items-center gap-1">
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
            <th>{{ __('admin.warranties.table_title') }}</th>
            <th>{{ __('admin.warranties.table_content') }}</th>
            <th>{{ __('admin.content.table_date') }}</th>
            <th>{{ __('admin.common.actions') }}</th>
          </tr>
        </thead>
        <tbody id="warrantiesTableBody"></tbody>
      </table>
    </div>

    {{-- Empty state --}}
    <div id="warrantiesEmpty" class="text-center py-16 px-4 d-none">
      <div class="icon-shape icon-xl rounded-circle bg-gray-200 text-secondary d-inline-flex align-items-center justify-content-center mb-4">
        <i class="ti {{ $config['icon'] }}" style="font-size:32px"></i>
      </div>
      <h6 class="mb-1">{{ __('admin.warranties.empty_title') }}</h6>
      <p class="text-secondary mb-4">{{ __('admin.warranties.empty_text') }}</p>
      <button type="button" class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1 js-open-create">
        <i class="ti ti-plus"></i>
        <span>{{ __('admin.content.add_new') }}</span>
      </button>
    </div>

    {{-- Pagination --}}
    <div class="card-footer d-flex flex-wrap justify-content-between align-items-center gap-2 border-top">
      <small class="text-secondary" id="warrantiesSummary"></small>
      <nav aria-label="pagination"><ul class="pagination pagination-sm mb-0" id="warrantiesPagination"></ul></nav>
    </div>
  </div>

  {{-- Create / Edit Modal --}}
  <div class="modal fade" id="warrantyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="warrantyModalTitle">{{ __('admin.warranties.add_warranty') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="warrantyForm" novalidate>
            <input type="hidden" name="_method" value="POST">

            {{-- Titles --}}
            <div class="row g-4">
              <div class="col-md-6">
                <label class="form-label" for="warrantyTitleAr">{{ __('admin.content.field_title_ar') }}</label>
                <input type="text" name="title_ar" id="warrantyTitleAr" dir="rtl" class="form-control"
                  placeholder="{{ __('admin.content.placeholder_title_ar') }}">
                <div class="invalid-feedback" data-error-for="title_ar"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="warrantyTitleEn">{{ __('admin.content.field_title_en') }}</label>
                <input type="text" name="title_en" id="warrantyTitleEn" dir="ltr" class="form-control"
                  placeholder="{{ __('admin.content.placeholder_title_en') }}">
                <div class="invalid-feedback" data-error-for="title_en"></div>
              </div>

              {{-- Contents --}}
              <div class="col-md-6">
                <label class="form-label" for="warrantyContentAr">{{ __('admin.content.field_content_ar') }}</label>
                <textarea name="content_ar" id="warrantyContentAr" rows="6" dir="rtl"
                  data-ckeditor data-lang="ar" class="form-control"></textarea>
                <div class="invalid-feedback" data-error-for="content_ar"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="warrantyContentEn">{{ __('admin.content.field_content_en') }}</label>
                <textarea name="content_en" id="warrantyContentEn" rows="6" dir="ltr"
                  data-ckeditor data-lang="en" class="form-control"></textarea>
                <div class="invalid-feedback" data-error-for="content_en"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-bs-dismiss="modal">{{ __('admin.content.cancel') }}</button>
          <button type="button" id="warrantySaveBtn" class="btn btn-primary d-inline-flex align-items-center gap-2">
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
  <script src="{{ asset('admin/libs/ckeditor5/ckeditor.js') }}"></script>
  @if (app()->getLocale() === 'ar')
    <script src="{{ asset('admin/libs/ckeditor5/translations/ar.js') }}"></script>
  @endif
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const listUrl = @json(route('admin.warranties.index'));
      const i18n = {
        confirmTitle: @json(__('admin.common.confirm_title')),
        confirmButton: @json(__('admin.common.confirm_delete')),
        confirmDelete: @json(__('admin.warranties.delete_confirm')),
        networkError: @json(__('admin.common.network_error')),
        sessionExpired: @json(__('admin.messages.session_expired')),
        loading: @json(__('admin.common.loading')),
        addTitle: @json(__('admin.warranties.add_warranty')),
        editTitle: @json(__('admin.warranties.edit_warranty')),
        placeholderContentAr: @json(__('admin.warranties.placeholder_content_ar')),
        placeholderContentEn: @json(__('admin.warranties.placeholder_content_en')),
      };

      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
      const jsonHeaders = { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' };
      const numberFormatter = new Intl.NumberFormat(document.body.getAttribute('data-locale') === 'ar' ? 'ar-EG' : 'en-US');
      const adminLocale = document.body.getAttribute('data-locale') || 'en';

      const tbody = document.getElementById('warrantiesTableBody');
      const emptyState = document.getElementById('warrantiesEmpty');
      const summaryEl = document.getElementById('warrantiesSummary');
      const paginationEl = document.getElementById('warrantiesPagination');
      const searchInput = document.getElementById('warrantySearch');

      const modalEl = document.getElementById('warrantyModal');
      const warrantyModal = new bootstrap.Modal(modalEl);
      const form = document.getElementById('warrantyForm');
      const modalTitle = document.getElementById('warrantyModalTitle');
      const saveBtn = document.getElementById('warrantySaveBtn');

      let warrantiesCache = [];
      let paginationMeta = null;
      let currentPage = 1;
      let editingId = null;

      // ---------- CKEditor ----------
      const editors = {};

      function createEditor(el) {
        if (el.dataset.editorReady) return;
        el.dataset.editorReady = '1';

        ClassicEditor.create(el, {
          language: { ui: adminLocale, content: el.getAttribute('data-lang') || adminLocale },
          placeholder: el.name === 'content_ar' ? i18n.placeholderContentAr : i18n.placeholderContentEn,
          heading: {
            options: [
              { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
              { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
              { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
              { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
            ],
          },
          toolbar: {
            items: [
              'heading', '|', 'bold', 'italic', 'underline', '|',
              'link', 'bulletedList', 'numberedList', '|',
              'insertTable', 'blockQuote', 'undo', 'redo',
            ],
          },
          table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
          },
        })
          .then((editor) => {
            editors[el.name] = editor;
            el.classList.remove('is-invalid');
          })
          .catch((error) => console.error(error));
      }

      document.querySelectorAll('[data-ckeditor]').forEach(createEditor);

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
      async function loadWarranties() {
        const params = new URLSearchParams({ page: currentPage });
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

          warrantiesCache = payload.data || [];
          paginationMeta = payload.pagination || null;
          renderRows();
          renderPagination(payload.pagination);
        } catch (e) {
          tbody.innerHTML = '';
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        }
      }

      function renderRows() {
        emptyState.classList.toggle('d-none', warrantiesCache.length > 0);

        const offset = paginationMeta ? (paginationMeta.current_page - 1) * paginationMeta.per_page : 0;

        tbody.innerHTML = warrantiesCache.map((warranty, index) => {
          const rowNumber = offset + index + 1;
          const title = adminLocale === 'ar' ? warranty.title_ar : warranty.title_en;
          const content = adminLocale === 'ar' ? warranty.content_ar : warranty.content_en;

          return `
            <tr data-warranty-id="${warranty.id}">
              <td>${numberFormatter.format(rowNumber)}</td>
              <td style="max-width: 320px;">
                <div class="text-truncate fw-semibold">${escapeHtml(title)}</div>
              </td>
              <td style="max-width: 360px;">
                <div class="text-truncate text-secondary">${escapeHtml(content)}</div>
              </td>
              <td>${formatDate(warranty.created_at)}</td>
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
        loadWarranties();
      });

      // ---------- Search ----------
      let searchTimer = null;
      searchInput.addEventListener('input', () => {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
          currentPage = 1;
          loadWarranties();
        }, 300);
      });

      // ---------- Form helpers ----------
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
        Object.values(editors).forEach((editor) => editor.setData(''));
        form.querySelector('[name="_method"]').value = 'POST';
        modalTitle.textContent = i18n.addTitle;
        warrantyModal.show();
      }

      function openEdit(warranty) {
        editingId = warranty.id;
        clearErrors();
        form.reset();
        form.querySelector('[name="_method"]').value = 'PUT';
        form.elements.title_ar.value = warranty.title_ar ?? '';
        form.elements.title_en.value = warranty.title_en ?? '';
        editors.content_ar?.setData(warranty.content_ar ?? '');
        editors.content_en?.setData(warranty.content_en ?? '');
        modalTitle.textContent = i18n.editTitle;
        warrantyModal.show();
      }

      document.getElementById('addWarrantyBtn').addEventListener('click', openCreate);
      document.querySelectorAll('.js-open-create').forEach((btn) => btn.addEventListener('click', openCreate));

      // ---------- Row actions ----------
      tbody.addEventListener('click', async function (event) {
        const row = event.target.closest('[data-warranty-id]');
        if (!row) return;

        const warrantyId = parseInt(row.getAttribute('data-warranty-id'), 10);
        const warranty = warrantiesCache.find((item) => item.id === warrantyId);
        if (!warranty) return;

        if (event.target.closest('.js-edit')) {
          openEdit(warranty);
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
          const { ok, status, payload } = await requestJson(listUrl + '/' + warrantyId, {
            method: 'DELETE',
            headers: { ...jsonHeaders, 'X-CSRF-TOKEN': csrfToken },
          });

          if (status === 401) {
            if (window.adminToast) window.adminToast(i18n.sessionExpired, 'danger');
          } else if (ok) {
            if (window.adminToast) window.adminToast(payload?.message || 'OK', 'success');
            loadWarranties();
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
        Object.values(editors).forEach((editor) => editor.updateSourceElement());

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
            warrantyModal.hide();
            if (!searchInput.value.trim()) currentPage = 1;
            loadWarranties();
          } else {
            if (window.adminToast) window.adminToast(payload?.message || i18n.networkError, 'danger');
          }
        } catch (e) {
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        } finally {
          saveBtn.disabled = false;
        }
      });

      loadWarranties();
    });
  </script>
@endpush
