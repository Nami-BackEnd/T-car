@extends('admin.layouts.master')

@section('title', $config['entity'] . ' | ' . __('admin.panel_name'))

@section('content')
  <div class="card card-lg">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3 border-bottom">
      <h5 class="mb-0 d-flex align-items-center gap-2">
        <i class="ti {{ $config['icon'] }}"></i>
        <span>{{ $config['entity'] }}</span>
      </h5>

      <button type="button" id="addSliderBtn" class="btn btn-primary d-inline-flex align-items-center gap-1 ms-auto">
        <i class="ti ti-plus"></i>
        <span>{{ __('admin.content.add_new') }}</span>
      </button>
    </div>

    <div class="table-responsive">
      <table class="table text-nowrap mb-0 table-centered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>{{ __('admin.sliders.table_image') }}</th>
            <th>{{ __('admin.sliders.table_order') }}</th>
            <th>{{ __('admin.content.table_date') }}</th>
            <th>{{ __('admin.common.actions') }}</th>
          </tr>
        </thead>
        <tbody id="slidersTableBody"></tbody>
      </table>
    </div>

    {{-- Empty state --}}
    <div id="slidersEmpty" class="text-center py-16 px-4 d-none">
      <div class="icon-shape icon-xl rounded-circle bg-gray-200 text-secondary d-inline-flex align-items-center justify-content-center mb-4">
        <i class="ti {{ $config['icon'] }}" style="font-size:32px"></i>
      </div>
      <h6 class="mb-1">{{ __('admin.sliders.empty_title') }}</h6>
      <p class="text-secondary mb-4">{{ __('admin.sliders.empty_text') }}</p>
      <button type="button" class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1 js-open-create">
        <i class="ti ti-plus"></i>
        <span>{{ __('admin.content.add_new') }}</span>
      </button>
    </div>

    {{-- Pagination --}}
    <div class="card-footer d-flex flex-wrap justify-content-between align-items-center gap-2 border-top">
      <small class="text-secondary" id="slidersSummary"></small>
      <nav aria-label="pagination"><ul class="pagination pagination-sm mb-0" id="slidersPagination"></ul></nav>
    </div>
  </div>

  {{-- Create / Edit Modal --}}
  <div class="modal fade" id="sliderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sliderModalTitle">{{ __('admin.sliders.add_slider') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="sliderForm" novalidate enctype="multipart/form-data">
            <input type="hidden" name="_method" value="POST">

            <div class="row g-4">
              {{-- Image --}}
              <div class="col-md-7">
                <label class="form-label" for="sliderImage">{{ __('admin.sliders.field_image') }} <span class="text-danger">*</span></label>
                <input type="file" name="image" id="sliderImage" accept="image/png,image/jpeg,image/webp" class="form-control">
                <small class="text-secondary d-block mt-1">{{ __('admin.sliders.hint_image') }}</small>
                <div class="invalid-feedback" data-error-for="image"></div>

                <div id="imagePreviewWrap" class="mt-3 d-none">
                  <img id="imagePreview" src="" alt="" class="img-fluid rounded border"
                    style="max-height: 220px; max-width: 100%; object-fit: contain;">
                </div>
              </div>

              {{-- Order --}}
              <div class="col-md-5">
                <label class="form-label" for="sliderOrder">{{ __('admin.sliders.field_order') }} <span class="text-danger">*</span></label>
                <input type="number" name="order" id="sliderOrder" min="0" step="1" class="form-control"
                  placeholder="{{ __('admin.sliders.placeholder_order') }}">
                <small class="text-secondary d-block mt-1">{{ __('admin.sliders.hint_order') }}</small>
                <div class="invalid-feedback" data-error-for="order"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-bs-dismiss="modal">{{ __('admin.content.cancel') }}</button>
          <button type="button" id="sliderSaveBtn" class="btn btn-primary d-inline-flex align-items-center gap-2">
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
      const listUrl = @json(route('admin.sliders.index'));
      const i18n = {
        confirmTitle: @json(__('admin.common.confirm_title')),
        confirmButton: @json(__('admin.common.confirm_delete')),
        confirmDelete: @json(__('admin.sliders.delete_confirm')),
        networkError: @json(__('admin.common.network_error')),
        sessionExpired: @json(__('admin.messages.session_expired')),
        loading: @json(__('admin.common.loading')),
        addTitle: @json(__('admin.sliders.add_slider')),
        editTitle: @json(__('admin.sliders.edit_slider')),
      };

      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
      const jsonHeaders = { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' };
      const numberFormatter = new Intl.NumberFormat(document.body.getAttribute('data-locale') === 'ar' ? 'ar-EG' : 'en-US');
      const adminLocale = document.body.getAttribute('data-locale') || 'en';

      const tbody = document.getElementById('slidersTableBody');
      const emptyState = document.getElementById('slidersEmpty');
      const summaryEl = document.getElementById('slidersSummary');
      const paginationEl = document.getElementById('slidersPagination');

      const modalEl = document.getElementById('sliderModal');
      const sliderModal = new bootstrap.Modal(modalEl);
      const form = document.getElementById('sliderForm');
      const modalTitle = document.getElementById('sliderModalTitle');
      const saveBtn = document.getElementById('sliderSaveBtn');
      const imageInput = document.getElementById('sliderImage');
      const orderInput = document.getElementById('sliderOrder');
      const imagePreviewWrap = document.getElementById('imagePreviewWrap');
      const imagePreview = document.getElementById('imagePreview');

      let slidersCache = [];
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
      async function loadSliders() {
        const params = new URLSearchParams({ page: currentPage });

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

          slidersCache = payload.data || [];
          paginationMeta = payload.pagination || null;
          renderRows();
          renderPagination(payload.pagination);
        } catch (e) {
          tbody.innerHTML = '';
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        }
      }

      function renderRows() {
        emptyState.classList.toggle('d-none', slidersCache.length > 0);

        const offset = paginationMeta ? (paginationMeta.current_page - 1) * paginationMeta.per_page : 0;

        tbody.innerHTML = slidersCache.map((slider, index) => {
          const rowNumber = offset + index + 1;

          return `
            <tr data-slider-id="${slider.id}">
              <td>${numberFormatter.format(rowNumber)}</td>
              <td>
                <img src="${escapeHtml(slider.image_url)}" alt="${escapeHtml(slider.image)}"
                  class="rounded border" style="height: 48px; width: 96px; object-fit: cover;">
              </td>
              <td><span class="badge bg-secondary">${numberFormatter.format(slider.order)}</span></td>
              <td>${formatDate(slider.created_at)}</td>
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
        loadSliders();
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

      function showPreview(src) {
        if (!src) {
          imagePreviewWrap.classList.add('d-none');
          imagePreview.removeAttribute('src');
          return;
        }
        imagePreview.src = src;
        imagePreviewWrap.classList.remove('d-none');
      }

      imageInput.addEventListener('change', () => {
        const file = imageInput.files && imageInput.files[0];
        showPreview(file ? URL.createObjectURL(file) : null);
      });

      function openCreate() {
        editingId = null;
        clearErrors();
        form.reset();
        showPreview(null);
        form.querySelector('[name="_method"]').value = 'POST';
        modalTitle.textContent = i18n.addTitle;
        sliderModal.show();
      }

      function openEdit(slider) {
        editingId = slider.id;
        clearErrors();
        form.reset();
        form.querySelector('[name="_method"]').value = 'PUT';
        orderInput.value = slider.order ?? 0;
        showPreview(slider.image_url || null);
        modalTitle.textContent = i18n.editTitle;
        sliderModal.show();
      }

      document.getElementById('addSliderBtn').addEventListener('click', openCreate);
      document.querySelectorAll('.js-open-create').forEach((btn) => btn.addEventListener('click', openCreate));

      // ---------- Row actions ----------
      tbody.addEventListener('click', async function (event) {
        const row = event.target.closest('[data-slider-id]');
        if (!row) return;

        const sliderId = parseInt(row.getAttribute('data-slider-id'), 10);
        const slider = slidersCache.find((item) => item.id === sliderId);
        if (!slider) return;

        if (event.target.closest('.js-edit')) {
          openEdit(slider);
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
          const { ok, status, payload } = await requestJson(listUrl + '/' + sliderId, {
            method: 'DELETE',
            headers: { ...jsonHeaders, 'X-CSRF-TOKEN': csrfToken },
          });

          if (status === 401) {
            if (window.adminToast) window.adminToast(i18n.sessionExpired, 'danger');
          } else if (ok) {
            if (window.adminToast) window.adminToast(payload?.message || 'OK', 'success');
            loadSliders();
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
            sliderModal.hide();
            currentPage = 1;
            loadSliders();
          } else {
            if (window.adminToast) window.adminToast(payload?.message || i18n.networkError, 'danger');
          }
        } catch (e) {
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        } finally {
          saveBtn.disabled = false;
        }
      });

      loadSliders();
    });
  </script>
@endpush
