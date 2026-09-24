@extends('admin.layouts.master')

@section('title', $config['label'] . ' | ' . __('admin.panel_name'))

@section('content')
  @if ($config['map'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
      integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  @endif

  <div class="card card-lg">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3 border-bottom">
      <h5 class="mb-0 d-flex align-items-center gap-2">
        <i class="ti {{ $config['icon'] }}"></i>
        <span>{{ $config['label'] }}</span>
      </h5>

      <div class="d-flex flex-wrap align-items-center gap-2 ms-auto">
        <div class="position-relative">
          <input type="text" id="lookupSearch" class="form-control ps-5" style="min-width: 220px;"
            placeholder="{{ __('admin.lookups.placeholder_search') }}" autocomplete="off">
          <i class="ti ti-search position-absolute top-50 translate-middle-y text-secondary" style="inset-inline-start: 14px;"></i>
        </div>

        <button type="button" id="addLookupBtn" class="btn btn-primary d-inline-flex align-items-center gap-1">
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
            @foreach ($config['columns'] as $column)
              <th>{{ $column['label'] }}</th>
            @endforeach
            <th>{{ __('admin.common.actions') }}</th>
          </tr>
        </thead>
        <tbody id="lookupsTableBody"></tbody>
      </table>
    </div>

    {{-- Empty state --}}
    <div id="lookupsEmpty" class="text-center py-16 px-4 d-none">
      <div class="icon-shape icon-xl rounded-circle bg-gray-200 text-secondary d-inline-flex align-items-center justify-content-center mb-4">
        <i class="ti {{ $config['icon'] }}" style="font-size:32px"></i>
      </div>
      <h6 class="mb-1">{{ __('admin.lookups.empty_title') }}</h6>
      <p class="text-secondary mb-4">{{ __('admin.lookups.empty_text') }}</p>
      <button type="button" class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1 js-open-create">
        <i class="ti ti-plus"></i>
        <span>{{ __('admin.content.add_new') }}</span>
      </button>
    </div>

    {{-- Pagination --}}
    <div class="card-footer d-flex flex-wrap justify-content-between align-items-center gap-2 border-top">
      <small class="text-secondary" id="lookupsSummary"></small>
      <nav aria-label="pagination"><ul class="pagination pagination-sm mb-0" id="lookupsPagination"></ul></nav>
    </div>
  </div>

  {{-- Create / Edit Modal --}}
  <div class="modal fade" id="lookupModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="lookupModalTitle"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="lookupForm" novalidate>
            <input type="hidden" name="_method" value="POST">
            <div class="row g-4" id="lookupFields"></div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-bs-dismiss="modal">{{ __('admin.content.cancel') }}</button>
          <button type="button" id="lookupSaveBtn" class="btn btn-primary d-inline-flex align-items-center gap-2">
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
      const cfg = @json($config);
      const cityOptions = Object.entries(@json($cityOptions) || {}).map(([value, label]) => ({ value, label }));

      const i18n = {
        confirmTitle: @json(__('admin.common.confirm_title')),
        confirmButton: @json(__('admin.common.confirm_delete')),
        confirmDelete: @json(__('admin.lookups.delete_confirm')),
        networkError: @json(__('admin.common.network_error')),
        sessionExpired: @json(__('admin.messages.session_expired')),
        loading: @json(__('admin.common.loading')),
        addTitle: @json(__('admin.lookups.add_title')),
        editTitle: @json(__('admin.lookups.edit_title')),
        active: @json(__('admin.lookups.active')),
        inactive: @json(__('admin.lookups.inactive')),
        mapSearchPlaceholder: @json(__('admin.lookups.map_search_placeholder')),
        mapHint: @json(__('admin.lookups.map_hint')),
      };

      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
      const jsonHeaders = { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' };
      const numberFormatter = new Intl.NumberFormat(document.body.getAttribute('data-locale') === 'ar' ? 'ar-EG' : 'en-US');
      const adminLocale = document.body.getAttribute('data-locale') || 'en';

      const tbody = document.getElementById('lookupsTableBody');
      const emptyState = document.getElementById('lookupsEmpty');
      const summaryEl = document.getElementById('lookupsSummary');
      const paginationEl = document.getElementById('lookupsPagination');
      const searchInput = document.getElementById('lookupSearch');

      const modalEl = document.getElementById('lookupModal');
      const lookupModal = new bootstrap.Modal(modalEl);
      const form = document.getElementById('lookupForm');
      const fieldsContainer = document.getElementById('lookupFields');
      const modalTitle = document.getElementById('lookupModalTitle');
      const saveBtn = document.getElementById('lookupSaveBtn');

      let rowsCache = [];
      let paginationMeta = null;
      let currentPage = 1;
      let editingId = null;
      let map = null;
      let mapMarker = null;

      function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, (char) => ({
          '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;',
        }[char]));
      }

      async function requestJson(url, options = {}) {
        const response = await fetch(url, options);
        const payload = await response.json().catch(() => null);
        return { ok: response.ok, status: response.status, payload };
      }

      // ---------- List ----------
      function hasToggle() {
        return cfg.enableToggle || cfg.fields.some((field) => field.type === 'toggle');
      }

      async function loadRows() {
        const params = new URLSearchParams({ page: currentPage });
        if (searchInput.value.trim()) params.set('search', searchInput.value.trim());

        const columnCount = cfg.columns.length + 2;
        tbody.innerHTML = `<tr><td colspan="${columnCount}" class="text-center text-secondary py-4">${escapeHtml(i18n.loading)}</td></tr>`;

        try {
          const { ok, status, payload } = await requestJson(`${cfg.indexUrl}?${params}`, { headers: jsonHeaders });

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

      function cellFor(row, column) {
        if (column.key === 'is_active') {
          if (cfg.enableToggle) {
            return `<div class="form-check form-switch mb-0">
              <input type="checkbox" class="form-check-input js-active-toggle" data-id="${row.id}"
                ${row.is_active ? 'checked' : ''}>
            </div>`;
          }
          const text = row.is_active ? i18n.active : i18n.inactive;
          const classes = row.is_active
            ? 'badge text-success-emphasis bg-success-subtle'
            : 'badge text-secondary-emphasis bg-secondary-subtle';
          return `<span class="${classes}">${escapeHtml(text)}</span>`;
        }

        let value = row[column.key];
        if (value === null || value === undefined || value === '') return '—';

        const dir = column.key.endsWith('_ar')
          ? ' dir="rtl"'
          : column.key.endsWith('_en')
            ? ' dir="ltr"'
            : '';

        return `<span${dir}>${escapeHtml(value)}</span>`;
      }

      function renderRows() {
        emptyState.classList.toggle('d-none', rowsCache.length > 0);

        const offset = paginationMeta ? (paginationMeta.current_page - 1) * paginationMeta.per_page : 0;

        tbody.innerHTML = rowsCache.map((row, index) => {
          const rowNumber = offset + index + 1;
          const cells = cfg.columns.map((column) =>
            `<td>${cellFor(row, column)}</td>`
          ).join('');

          return `
            <tr data-lookup-id="${row.id}">
              <td>${numberFormatter.format(rowNumber)}</td>
              ${cells}
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
        loadRows();
      });

      // ---------- Search ----------
      let searchTimer = null;
      searchInput.addEventListener('input', () => {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
          currentPage = 1;
          loadRows();
        }, 300);
      });

      // ---------- Modal fields ----------
      function fieldHtml(field) {
        if (field.type === 'select') {
          const options = cityOptions.map((opt) =>
            `<option value="${escapeHtml(String(opt.value))}">${escapeHtml(opt.label)}</option>`
          ).join('');
          return `
            <div class="col-md-${field.col}">
              <label class="form-label" for="f_${field.name}">${escapeHtml(field.label)}</label>
              <select name="${field.name}" id="f_${field.name}" class="form-select">
                ${field.empty ? `<option value="">${escapeHtml(field.empty)}</option>` : ''}
                ${options}
              </select>
              <div class="invalid-feedback" data-error-for="${field.name}"></div>
            </div>`;
        }

        if (field.type === 'toggle') {
          return `
            <div class="col-md-${field.col}">
              <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" name="${field.name}" id="f_${field.name}" value="1">
                <label class="form-check-label" for="f_${field.name}">${escapeHtml(field.label)}</label>
              </div>
              <div class="invalid-feedback" data-error-for="${field.name}"></div>
            </div>`;
        }

        const stepAttr = field.step ? ` step="${escapeHtml(field.step)}"` : '';
        const dirAttr = field.dir ? ` dir="${escapeHtml(field.dir)}"` : '';
        return `
          <div class="col-md-${field.col}">
            <label class="form-label" for="f_${field.name}">${escapeHtml(field.label)}</label>
            <input type="${escapeHtml(field.type)}"${stepAttr}${dirAttr} name="${field.name}" id="f_${field.name}"
              class="form-control" placeholder="${escapeHtml(field.placeholder ?? '')}" autocomplete="off">
            <div class="invalid-feedback" data-error-for="${field.name}"></div>
          </div>`;
      }

      function renderModalFields() {
        if (map) {
          map.remove();
          map = null;
          mapMarker = null;
        }

        const inputs = cfg.fields.map(fieldHtml);

        if (cfg.map) {
          inputs.push(`
            <div class="col-12">
              <label class="form-label">{{ __('admin.lookups.map_search') }}</label>
              <div class="position-relative mb-2">
                <input type="text" id="mapSearch" class="form-control ps-5" placeholder="${escapeHtml(i18n.mapSearchPlaceholder)}" autocomplete="off">
                <i class="ti ti-search position-absolute top-50 translate-middle-y text-secondary" style="inset-inline-start: 14px;"></i>
              </div>
              <div id="lookupMap" style="height: 300px; width: 100%; border-radius: 8px;"></div>
              <small class="text-secondary d-block mt-2">${escapeHtml(i18n.mapHint)}</small>
            </div>`);
        }

        fieldsContainer.innerHTML = inputs.join('');
      }

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

      // ---------- Map ----------
      function initMap(lat, lng) {
        if (map) {
          map.setView([lat, lng], 10);
        } else {
          map = L.map('lookupMap').setView([lat, lng], 10);
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors',
          }).addTo(map);
          map.on('click', (event) => {
            if (mapMarker) {
              mapMarker.setLatLng(event.latlng);
              syncCoords(mapMarker);
            }
          });
        }

        if (mapMarker) map.removeLayer(mapMarker);
        mapMarker = L.marker([lat, lng], { draggable: true }).addTo(map);

        const syncCoords = (marker) => {
          const position = marker.getLatLng();
          const latInput = form.elements.latitude;
          const lngInput = form.elements.longitude;
          if (latInput) latInput.value = position.lat.toFixed(6);
          if (lngInput) lngInput.value = position.lng.toFixed(6);
        };

        mapMarker.on('dragend', () => syncCoords(mapMarker));
      }

      modalEl.addEventListener('shown.bs.modal', () => {
        if (map) map.invalidateSize();
      });

      function wireMapSearch(lat, lng) {
        const input = document.getElementById('mapSearch');
        if (!input) return;

        const run = async () => {
          const query = input.value.trim();
          if (!query) return;
          try {
            const response = await fetch(
              'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(query)
            );
            const results = await response.json();
            const first = results && results[0];
            if (!first) return;
            const foundLat = parseFloat(first.lat);
            const foundLng = parseFloat(first.lon);
            initMap(foundLat, foundLng);
            const latInput = form.elements.latitude;
            const lngInput = form.elements.longitude;
            if (latInput) latInput.value = foundLat.toFixed(6);
            if (lngInput) lngInput.value = foundLng.toFixed(6);
          } catch (e) {
            /* ignore geocoding errors */
          }
        };

        input.addEventListener('keydown', (event) => {
          if (event.key === 'Enter') {
            event.preventDefault();
            run();
          }
        });
      }

      // ---------- Open / edit ----------
      function fillForm(row) {
        cfg.fields.forEach((field) => {
          const input = form.elements[field.name];
          if (!input) return;

          if (field.type === 'toggle') {
            input.checked = Boolean(row.is_active);
            return;
          }

          if (field.type === 'select') {
            input.value = row[field.name] ?? '';
            return;
          }

          input.value = row[field.name] ?? '';
        });

        if (cfg.map) {
          const lat = parseFloat(row.latitude);
          const lng = parseFloat(row.longitude);
          const centerLat = Number.isFinite(lat) ? lat : 24.7136;
          const centerLng = Number.isFinite(lng) ? lng : 46.6753;
          initMap(centerLat, centerLng);
        }
      }

      function openCreate() {
        editingId = null;
        clearErrors();
        form.reset();
        renderModalFields();
        form.querySelector('[name="_method"]').value = 'POST';

        if (cfg.fields.some((field) => field.type === 'toggle')) {
          const toggle = form.elements.is_active;
          if (toggle) toggle.checked = true;
        }

        if (cfg.map) initMap(24.7136, 46.6753);

        modalTitle.textContent = `${cfg.label} · ${i18n.addTitle}`;
        lookupModal.show();
        wireMapSearch();
      }

      function openEdit(row) {
        editingId = row.id;
        clearErrors();
        renderModalFields();
        form.querySelector('[name="_method"]').value = 'PUT';
        fillForm(row);
        modalTitle.textContent = `${cfg.label} · ${i18n.editTitle}`;
        lookupModal.show();
        wireMapSearch();
      }

      document.getElementById('addLookupBtn').addEventListener('click', openCreate);
      document.querySelectorAll('.js-open-create').forEach((btn) => btn.addEventListener('click', openCreate));

      // ---------- Row actions ----------
      tbody.addEventListener('click', async function (event) {
        const row = event.target.closest('[data-lookup-id]');
        if (!row) return;

        const lookupId = parseInt(row.getAttribute('data-lookup-id'), 10);
        const lookup = rowsCache.find((item) => item.id === lookupId);
        if (!lookup) return;

        if (event.target.closest('.js-edit')) {
          openEdit(lookup);
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
          const { ok, status, payload } = await requestJson(cfg.indexUrl + '/' + lookupId, {
            method: 'DELETE',
            headers: { ...jsonHeaders, 'X-CSRF-TOKEN': csrfToken },
          });

          if (status === 401) {
            if (window.adminToast) window.adminToast(i18n.sessionExpired, 'danger');
          } else if (ok) {
            if (window.adminToast) window.adminToast(payload?.message || 'OK', 'success');
            loadRows();
          } else {
            if (window.adminToast) window.adminToast(payload?.message || i18n.networkError, 'danger');
          }
        } catch (e) {
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        } finally {
          deleteBtn.disabled = false;
        }
      });

      // ---------- Active toggle ----------
      tbody.addEventListener('change', async function (event) {
        const checkbox = event.target.closest('.js-active-toggle');
        if (!checkbox) return;

        const lookupId = checkbox.getAttribute('data-id');
        const body = new URLSearchParams({
          is_active: checkbox.checked ? '1' : '0',
          _method: 'PUT',
        });

        try {
          const { ok, status, payload } = await requestJson(cfg.indexUrl + '/' + lookupId, {
            method: 'POST',
            headers: { ...jsonHeaders, 'Content-Type': 'application/x-www-form-urlencoded', 'X-CSRF-TOKEN': csrfToken },
            body,
          });

          if (status === 401) {
            if (window.adminToast) window.adminToast(i18n.sessionExpired, 'danger');
            checkbox.checked = !checkbox.checked;
          } else if (ok) {
            if (window.adminToast) window.adminToast(payload?.message || 'OK', 'success');
          } else {
            if (window.adminToast) window.adminToast(payload?.message || i18n.networkError, 'danger');
            checkbox.checked = !checkbox.checked;
          }
        } catch (e) {
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
          checkbox.checked = !checkbox.checked;
        }
      });

      // ---------- Save (create / update) ----------
      saveBtn.addEventListener('click', async function () {
        clearErrors();

        const formData = new FormData(form);
        cfg.fields.forEach((field) => {
          if (field.type === 'toggle') {
            const input = form.elements[field.name];
            formData.set(field.name, input && input.checked ? '1' : '0');
          }
        });
        if (editingId) formData.set('_method', 'PUT');

        const url = editingId ? cfg.indexUrl + '/' + editingId : cfg.indexUrl;
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
            lookupModal.hide();
            if (!searchInput.value.trim()) currentPage = 1;
            loadRows();
          } else {
            if (window.adminToast) window.adminToast(payload?.message || i18n.networkError, 'danger');
          }
        } catch (e) {
          if (window.adminToast) window.adminToast(i18n.networkError, 'danger');
        } finally {
          saveBtn.disabled = false;
        }
      });

      loadRows();
    });
  </script>
@endpush