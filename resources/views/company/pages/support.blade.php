@extends('company.layouts.master')

@section('title', 'T-Car — الدعم الفني')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.support.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.pages.support.0') }}</span>
              </nav>
            </div>
            <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#newSupportModal"
            >
              <i class="bi bi-plus-circle"></i>
              {{ __('company.pages.support.1') }}</button>
          </div>

          <div class="table-card mb-4">
            <div class="table-filter-bar">
              <div class="table-filter-bar__left">
                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <span id="supportStatusFilterLabel">{{ __('company.common.165') }}</span>
                    <i class="bi bi-chevron-down"></i>
                  </button>

                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>
                    <li><a class="dropdown-item" href="#" data-filter="all">{{ __('company.common.223') }}</a></li>
                    <li><a class="dropdown-item" href="#" data-filter="accepted">{{ __('company.common.545') }}</a></li>
                    <li><a class="dropdown-item" href="#" data-filter="rejected">{{ __('company.common.521') }}</a></li>
                    <li><a class="dropdown-item" href="#" data-filter="pending">{{ __('company.common.538') }}</a></li>
                  </ul>
                </div>
                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <span id="supportTypeFilterLabel">{{ __('company.common.245') }}</span>
                    <i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" data-type-filter="all">{{ __('company.common.223') }}</a></li>
                    <li>
                      <a class="dropdown-item" href="#" data-type-filter="fine-objection"
                        >{{ __('company.pages.support.2') }}</a
                      >
                    </li>
                    <li>
                      <a class="dropdown-item" href="#" data-type-filter="complaint">{{ __('company.pages.support.3') }}</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#" data-type-filter="inquiry">{{ __('company.pages.support.4') }}</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#" data-type-filter="technical">{{ __('company.pages.support.5') }}</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#" data-type-filter="booking-review"
                        >{{ __('company.pages.support.6') }}</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="supportSearchInput"  placeholder="{{ __('company.common.253') }}" />
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="data-table" id="supportTicketsTable">
                <thead>
                  <tr>
                    <th>{{ __('company.pages.support.7') }}</th>
                    <th>{{ __('company.common.245') }}</th>
                    <th>{{ __('company.common.165') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>

            <div
              class="table-pagination table-pagination-dt"
              id="tablePagination"
              style="display: none"
            >
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
                <button class="table-pagination__page-btn">2</button>
                <button class="table-pagination__page-btn">3</button>
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
      id="newSupportModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="newSupportModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon">
                <i class="bi bi-headset"></i>
              </div>
              <div>
                <h2 class="bkmodal-header__ref" id="newSupportModalLabel">{{ __('company.pages.support.1') }}</h2>
              </div>
            </div>
            <button
              type="button"
              class="booking-modal__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>

          <div class="modal-body booking-modal__body">
            <form id="newSupportForm">
              <div class="form-grid">
                <div class="form-field">
                  <label class="form-field__label"
                    >{{ __('company.common.572') }}<span class="text-danger">*</span></label
                  >
                  <div class="custom-dropdown" id="supportTypeDropdown">
                    <select id="supportTypeSelect" style="display: none">
                      <option value="">{{ __('company.common.118') }}</option>
                      <option value="fine-objection">{{ __('company.pages.support.2') }}</option>
                      <option value="complaint">{{ __('company.pages.support.3') }}</option>
                      <option value="inquiry">{{ __('company.pages.support.4') }}</option>
                      <option value="technical">{{ __('company.pages.support.5') }}</option>
                      <option value="booking-review">{{ __('company.pages.support.6') }}</option>
                    </select>
                    <button type="button" class="custom-dropdown__trigger" aria-expanded="false">
                      <span class="custom-dropdown__selected">
                        <span class="custom-dropdown__icon"><i class="bi bi-grid"></i></span>
                        <span class="custom-dropdown__text fw-normal text-black-50"
                          >{{ __('company.common.118') }}</span
                        >
                      </span>
                      <i class="bi bi-chevron-down custom-dropdown__chevron"></i>
                    </button>
                    <div class="custom-dropdown__menu">
                      <div class="custom-dropdown__options">
                        <button
                          type="button"
                          class="custom-dropdown__option"
                          data-value="fine-objection"
                        >
                          <span class="custom-dropdown__option-text">{{ __('company.pages.support.2') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button
                          type="button"
                          class="custom-dropdown__option"
                          data-value="complaint"
                        >
                          <span class="custom-dropdown__option-text">{{ __('company.pages.support.3') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button type="button" class="custom-dropdown__option" data-value="inquiry">
                          <span class="custom-dropdown__option-text">{{ __('company.pages.support.4') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button
                          type="button"
                          class="custom-dropdown__option"
                          data-value="technical"
                        >
                          <span class="custom-dropdown__option-text">{{ __('company.pages.support.5') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                        <button
                          type="button"
                          class="custom-dropdown__option"
                          data-value="booking-review"
                        >
                          <span class="custom-dropdown__option-text">{{ __('company.pages.support.6') }}</span>
                          <i class="bi bi-check2 custom-dropdown__option-check"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-field">
                  <label class="form-field__label" for="supportBookingRef"
                    >{{ __('company.common.398') }}<span class="text-muted" id="supportBookingRefRequirement"
                      >{{ __('company.common.0') }}</span
                    ></label
                  >
                  <input
                    type="text"
                    class="form-field__input"
                    id="supportBookingRef"
                     placeholder="{{ __('company.pages.support.13') }}"
                  />
                </div>

                <div class="form-field" style="grid-column: 1 / -1">
                  <label class="form-field__label"
                    >{{ __('company.common.217') }}<span class="text-danger">*</span></label
                  >
                  <input
                    type="text"
                    class="form-field__input"
                    id="supportTitle"
                     placeholder="{{ __('company.pages.support.14') }}"
                    required
                  />
                </div>

                <div class="form-field" style="grid-column: 1 / -1">
                  <label class="form-field__label">{{ __('company.common.248') }}<span class="text-danger">*</span></label>
                  <textarea
                    class="form-field__input"
                    id="supportDescription"
                    rows="5"
                     placeholder="{{ __('company.pages.support.15') }}"
                    required
                  ></textarea>
                </div>

                <div class="form-field" style="grid-column: 1 / -1">
                  <label class="form-field__label"
                    >{{ __('company.pages.support.8') }}<span class="text-muted">{{ __('company.common.0') }}</span></label
                  >
                  <div class="form-field__input-wrapper">
                    <input
                      type="file"
                      id="supportAttachments"
                      multiple
                      accept="image/*,.pdf,.doc,.docx"
                      style="display: none"
                    />
                    <div class="file-upload-trigger" id="fileUploadTrigger">
                      <i class="bi bi-cloud-upload"></i>
                      <span>{{ __('company.pages.support.9') }}</span>
                      <span class="file-upload-hint"
                        >{{ __('company.pages.support.10') }}</span
                      >
                    </div>
                    <div id="selectedFiles" class="selected-files-list"></div>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="modal-footer booking-modal__footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
            <button type="button" class="btn btn-primary" id="submitSupportBtn">
              <i class="bi bi-send"></i>
              {{ __('company.common.78') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="supportDetailsModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="supportDetailsModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon">
                <i class="bi bi-ticket-detailed"></i>
              </div>
              <div>
                <h2 class="bkmodal-header__ref" id="supportDetailsModalLabel">{{ __('company.pages.support.11') }}</h2>
                <div class="bkmodal-header__meta">
                  <span
                    ><i class="bi bi-hash"></i> <span id="supportDetailRef">#SUP-000</span></span
                  >
                </div>
              </div>
            </div>
            <button
              type="button"
              class="booking-modal__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>

          <div class="modal-body booking-modal__body">
            <div class="bkmodal-section-label">{{ __('company.pages.support.12') }}</div>
            <div class="booking-details-grid">
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon">
                  <i class="bi bi-grid"></i>
                </div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.572') }}</span>
                  <span class="booking-detail-item__value" id="supportDetailType">-</span>
                </div>
              </div>
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon">
                  <i class="bi bi-tag"></i>
                </div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.165') }}</span>
                  <span class="booking-detail-item__value" id="supportDetailStatus">-</span>
                </div>
              </div>
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon">
                  <i class="bi bi-calendar3"></i>
                </div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.283') }}</span>
                  <span class="booking-detail-item__value ltr-num" id="supportDetailDate">-</span>
                </div>
              </div>
              <div class="booking-detail-item">
                <div class="booking-detail-item__icon">
                  <i class="bi bi-file-earmark-text"></i>
                </div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.398') }}</span>
                  <span class="booking-detail-item__value" id="supportDetailBookingRef">-</span>
                </div>
              </div>
            </div>

            <div class="bkmodal-section-label">{{ __('company.common.161') }}</div>
            <div class="booking-details-grid">
              <div class="booking-detail-item" style="grid-column: 1 / -1">
                <div class="booking-detail-item__icon">
                  <i class="bi bi-card-heading"></i>
                </div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.217') }}</span>
                  <span class="booking-detail-item__value" id="supportDetailTitle">-</span>
                </div>
              </div>
              <div class="booking-detail-item" style="grid-column: 1 / -1">
                <div class="booking-detail-item__icon">
                  <i class="bi bi-file-text"></i>
                </div>
                <div class="booking-detail-item__content">
                  <span class="booking-detail-item__label">{{ __('company.common.248') }}</span>
                  <span class="booking-detail-item__value" id="supportDetailDescription">-</span>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer booking-modal__footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ __('company.common.374') }}</button>
          </div>
        </div>
      </div>
    </div>

    
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        // ============================================================
        // CUSTOM DROPDOWN LOGIC (same as add-car.html)
        // ============================================================
        function initCustomDropdown(dropdown) {
          if (dropdown.dataset.ddInit === '1') return; // avoid double-binding
          dropdown.dataset.ddInit = '1';

          var trigger = dropdown.querySelector('.custom-dropdown__trigger');
          var menu = dropdown.querySelector('.custom-dropdown__menu');
          var select = dropdown.querySelector('select');
          var options = dropdown.querySelectorAll('.custom-dropdown__option');

          // Toggle dropdown
          trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            var isOpen = menu.classList.contains('is-visible');

            // Close all other dropdowns
            document.querySelectorAll('.custom-dropdown__menu.is-visible').forEach(function (m) {
              if (m !== menu) {
                m.classList.remove('is-visible');
                m.closest('.custom-dropdown')
                  .querySelector('.custom-dropdown__trigger')
                  .setAttribute('aria-expanded', 'false');
                m.closest('.custom-dropdown')
                  .querySelector('.custom-dropdown__trigger')
                  .classList.remove('is-open');
              }
            });

            menu.classList.toggle('is-visible');
            trigger.setAttribute('aria-expanded', !isOpen);
            trigger.classList.toggle('is-open', !isOpen);
          });

          // Select option
          options.forEach(function (option) {
            option.addEventListener('click', function (e) {
              e.stopPropagation();
              var value = this.getAttribute('data-value');
              var text = this.querySelector('.custom-dropdown__option-text').textContent;

              // Update select value
              select.value = value;
              updateBookingReferenceRequirement(value);

              // Update trigger display
              dropdown.querySelector('.custom-dropdown__text').textContent = text;

              // Update selected state
              options.forEach(function (opt) {
                opt.removeAttribute('data-selected');
              });
              this.setAttribute('data-selected', 'true');

              // Close dropdown
              menu.classList.remove('is-visible');
              trigger.setAttribute('aria-expanded', 'false');
              trigger.classList.remove('is-open');
            });
          });
        }

        document.querySelectorAll('.custom-dropdown').forEach(initCustomDropdown);

        // Global click handler to close dropdowns
        document.addEventListener('click', function (e) {
          if (!e.target.closest('.custom-dropdown')) {
            document.querySelectorAll('.custom-dropdown__menu.is-visible').forEach(function (menu) {
              menu.classList.remove('is-visible');
              var dropdown = menu.closest('.custom-dropdown');
              dropdown
                .querySelector('.custom-dropdown__trigger')
                .setAttribute('aria-expanded', 'false');
              dropdown.querySelector('.custom-dropdown__trigger').classList.remove('is-open');
            });
          }
        });

        // ============================================================
        // SUPPORT TICKETS DATA
        // ============================================================
        let supportTickets = [];
        let ticketCounter = 1;
        let activeStatusFilter = 'all';
        let activeTypeFilter = 'all';

        const supportTypeLabels = {
          'fine-objection': 'اعتراض على غرامة',
          complaint: 'شكوى',
          inquiry: 'استفسارات',
          technical: 'دعم فني',
          'booking-review': 'مراجعة حجز',
        };

        // Initialize empty table
        const tbody = document.querySelector('#supportTicketsTable tbody');
        tbody.innerHTML =
          '<tr><td colspan="4" class="text-center text-muted">لا توجد طلبات دعم</td></tr>';

        // ============================================================
        // FILE UPLOAD HANDLING
        // ============================================================
        const fileUploadTrigger = document.getElementById('fileUploadTrigger');
        const supportAttachments = document.getElementById('supportAttachments');
        const selectedFiles = document.getElementById('selectedFiles');

        fileUploadTrigger.addEventListener('click', () => {
          supportAttachments.click();
        });

        supportAttachments.addEventListener('change', function () {
          selectedFiles.innerHTML = '';
          const files = this.files;

          if (files.length > 0) {
            for (let i = 0; i < files.length; i++) {
              const fileItem = document.createElement('div');
              fileItem.className = 'selected-file-item';
              fileItem.innerHTML = `
              <i class="bi bi-file-earmark"></i>
              <span>${files[i].name}</span>
              <button type="button" class="remove-file-btn" data-index="${i}">
                <i class="bi bi-x"></i>
              </button>
            `;
              selectedFiles.appendChild(fileItem);
            }
          }
        });

        selectedFiles.addEventListener('click', function (e) {
          if (e.target.closest('.remove-file-btn')) {
            const btn = e.target.closest('.remove-file-btn');
            const index = btn.getAttribute('data-index');
            const fileItem = btn.closest('.selected-file-item');
            fileItem.remove();
          }
        });

        // ============================================================
        // FILTER LOGIC
        // ============================================================
        document.querySelectorAll('.dropdown-item[data-filter]').forEach((item) => {
          item.addEventListener('click', function (e) {
            e.preventDefault();
            activeStatusFilter = this.getAttribute('data-filter');
            document.getElementById('supportStatusFilterLabel').textContent =
              activeStatusFilter === 'all' ? 'الحالة' : this.textContent.trim();
            renderTickets();
          });
        });

        document.querySelectorAll('.dropdown-item[data-type-filter]').forEach((item) => {
          item.addEventListener('click', function (e) {
            e.preventDefault();
            activeTypeFilter = this.getAttribute('data-type-filter');
            document.getElementById('supportTypeFilterLabel').textContent =
              activeTypeFilter === 'all' ? 'النوع' : this.textContent.trim();
            renderTickets();
          });
        });

        // ============================================================
        // SEARCH LOGIC
        // ============================================================
        document.getElementById('supportSearchInput').addEventListener('input', function () {
          renderTickets();
        });

        function renderTickets() {
          const tbody = document.querySelector('#supportTicketsTable tbody');
          tbody.innerHTML = '';
          const searchTerm = document
            .getElementById('supportSearchInput')
            .value.trim()
            .toLowerCase();

          const filteredTickets = supportTickets.filter((ticket) => {
            const typeLabel = getTypeText(ticket.type).toLowerCase();
            const statusLabel = getStatusText(ticket.status).toLowerCase();
            const matchesStatus =
              activeStatusFilter === 'all' || ticket.status === activeStatusFilter;
            const matchesType = activeTypeFilter === 'all' || ticket.type === activeTypeFilter;
            const matchesSearch =
              !searchTerm ||
              ticket.ref.toLowerCase().includes(searchTerm) ||
              typeLabel.includes(searchTerm) ||
              statusLabel.includes(searchTerm) ||
              ticket.title.toLowerCase().includes(searchTerm);
            return matchesStatus && matchesType && matchesSearch;
          });

          if (filteredTickets.length === 0) {
            tbody.innerHTML =
              '<tr><td colspan="4" class="text-center text-muted">لا توجد طلبات دعم</td></tr>';
            return;
          }

          filteredTickets.forEach((ticket) => {
            const row = createTicketRow(ticket);
            tbody.appendChild(row);
          });
        }

        // ============================================================
        // CREATE TICKET ROW
        // ============================================================
        function createTicketRow(ticket) {
          const row = document.createElement('tr');
          row.dataset.ticketId = ticket.id;

          const statusBadgeClass = getStatusBadgeClass(ticket.status);
          const statusText = getStatusText(ticket.status);

          row.innerHTML = `
          <td>
            <a href="#" class="ticket-ref-link" data-ticket-id="${ticket.id}">
              ${ticket.ref} <i class="bi bi-box-arrow-up-right"></i>
            </a>
          </td>
          <td>${getTypeText(ticket.type)}</td>
          <td><span class="badge ${statusBadgeClass}">${statusText}</span></td>
          <td>
            <button class="btn btn-danger btn-sm delete-ticket-btn" data-ticket-id="${ticket.id}" title="حذف">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        `;

          // Add click event for ticket reference
          row.querySelector('.ticket-ref-link').addEventListener('click', function (e) {
            e.preventDefault();
            openSupportDetailsModal(ticket.id);
          });

          // Add click event for delete button
          row.querySelector('.delete-ticket-btn').addEventListener('click', function () {
            deleteTicket(ticket.id);
          });

          return row;
        }

        function getStatusBadgeClass(status) {
          switch (status) {
            case 'accepted':
              return 'bg-success';
            case 'rejected':
              return 'bg-danger';
            case 'pending':
              return 'bg-warning';
            default:
              return 'bg-secondary';
          }
        }

        function getStatusText(status) {
          switch (status) {
            case 'accepted':
              return 'مقبول';
            case 'rejected':
              return 'مرفوض';
            case 'pending':
              return 'معلق';
            default:
              return status;
          }
        }

        function getTypeText(type) {
          return supportTypeLabels[type] || type;
        }

        function typeRequiresBookingReference(type) {
          return type === 'booking-review' || type === 'fine-objection';
        }

        function updateBookingReferenceRequirement(type) {
          const bookingRefInput = document.getElementById('supportBookingRef');
          const requirementLabel = document.getElementById('supportBookingRefRequirement');
          const isRequired = typeRequiresBookingReference(type);
          bookingRefInput.required = isRequired;
          bookingRefInput.classList.remove('is-invalid');
          requirementLabel.className = isRequired ? 'text-danger' : 'text-muted';
          requirementLabel.textContent = isRequired ? '*' : '(اختياري)';
        }

        // ============================================================
        // FORM SUBMISSION
        // ============================================================
        document.getElementById('submitSupportBtn').addEventListener('click', function () {
          const typeSelect = document.getElementById('supportTypeSelect');
          const titleInput = document.getElementById('supportTitle');
          const descriptionInput = document.getElementById('supportDescription');
          const bookingRefInput = document.getElementById('supportBookingRef');

          // Validation
          if (!typeSelect.value) {
            document.getElementById('errorMessage').textContent = 'يرجى اختيار نوع الطلب';
            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
            return;
          }

          if (typeRequiresBookingReference(typeSelect.value) && !bookingRefInput.value.trim()) {
            bookingRefInput.classList.add('is-invalid');
            document.getElementById('errorMessage').textContent =
              'رقم الحجز مطلوب لهذا النوع من طلبات الدعم';
            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
            return;
          }
          bookingRefInput.classList.remove('is-invalid');

          if (!titleInput.value.trim()) {
            document.getElementById('errorMessage').textContent = 'يرجى إدخال عنوان الطلب';
            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
            return;
          }

          if (!descriptionInput.value.trim()) {
            document.getElementById('errorMessage').textContent = 'يرجى إدخال وصف الطلب';
            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
            return;
          }

          // Create new ticket
          const newTicket = {
            id: Date.now(),
            ref: '#SUP-' + String(ticketCounter).padStart(3, '0'),
            type: typeSelect.value,
            title: titleInput.value.trim(),
            description: descriptionInput.value.trim(),
            bookingRef: bookingRefInput.value.trim() || '-',
            status: 'pending',
            createdAt: new Date().toISOString().split('T')[0],
          };

          ticketCounter++;
          supportTickets.push(newTicket);

          renderTickets();

          // Show pagination
          document.getElementById('tablePagination').style.display = 'flex';

          // Reset form and close modal
          document.getElementById('newSupportForm').reset();
          const dropdown = document.getElementById('supportTypeDropdown');
          dropdown.querySelector('.custom-dropdown__text').textContent = 'اختر النوع';
          dropdown.querySelector('select').value = '';
          dropdown.querySelectorAll('.custom-dropdown__option').forEach((opt) => {
            opt.removeAttribute('data-selected');
          });
          updateBookingReferenceRequirement('');

          const modal = bootstrap.Modal.getInstance(document.getElementById('newSupportModal'));
          modal.hide();

          // Show success modal
          const successModal = new bootstrap.Modal(document.getElementById('successModal'));
          successModal.show();
        });

        // ============================================================
        // DELETE TICKET
        // ============================================================
        var deleteTicketModalEl = document.getElementById('deleteTicketModal');
        var deleteTicketModal = new bootstrap.Modal(deleteTicketModalEl);
        var deleteTicketSuccessModalEl = document.getElementById('deleteTicketSuccessModal');
        var deleteTicketSuccessModal = new bootstrap.Modal(deleteTicketSuccessModalEl);
        var currentDeleteTicketId = null;

        function deleteTicket(ticketId) {
          currentDeleteTicketId = ticketId;
          document.getElementById('deleteTicketMessage').textContent =
            'هل أنت متأكد من حذف هذا الطلب؟';
          deleteTicketModal.show();
        }

        // Handle confirm delete button
        document.getElementById('confirmDeleteTicketBtn').addEventListener('click', function () {
          if (currentDeleteTicketId) {
            supportTickets = supportTickets.filter((ticket) => ticket.id !== currentDeleteTicketId);
            renderTickets();
            if (supportTickets.length === 0) {
              document.getElementById('tablePagination').style.display = 'none';
            }

            // Close the confirmation modal
            deleteTicketModal.hide();

            // Show success modal
            deleteTicketModalEl.addEventListener(
              'hidden.bs.modal',
              function () {
                deleteTicketSuccessModal.show();
              },
              { once: true },
            );
          }
        });

        // ============================================================
        // SUPPORT DETAILS MODAL
        // ============================================================
        function openSupportDetailsModal(ticketId) {
          const ticket = supportTickets.find((t) => t.id === ticketId);
          if (!ticket) return;

          document.getElementById('supportDetailRef').textContent = ticket.ref;
          document.getElementById('supportDetailType').textContent = getTypeText(ticket.type);
          document.getElementById('supportDetailStatus').textContent = getStatusText(ticket.status);
          document.getElementById('supportDetailDate').textContent = ticket.createdAt;
          document.getElementById('supportDetailBookingRef').textContent = ticket.bookingRef;
          document.getElementById('supportDetailTitle').textContent = ticket.title;
          document.getElementById('supportDetailDescription').textContent = ticket.description;

          const modal = new bootstrap.Modal(document.getElementById('supportDetailsModal'));
          modal.show();
        }
      });
    </script>
@endpush

