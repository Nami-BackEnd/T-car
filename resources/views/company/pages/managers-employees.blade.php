@extends('company.layouts.master')

@section('title', 'T-Car — مديرو الشركة والفروع')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.516') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.233') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.common.516') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
              <a href="{{ route('company.add-company-manager') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                {{ __('company.pages.managers-employees.0') }}</a>
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
                    <a class="dropdown-item" href="#"
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
                <div class="view-tabs" role="tablist"  aria-label="{{ __('company.pages.managers-employees.6') }}">
                  <button
                    type="button"
                    class="view-tabs__btn is-active"
                    role="tab"
                    aria-selected="true"
                  >
                    {{ __('company.common.223') }}</button>
                  <button type="button" class="view-tabs__btn" role="tab" aria-selected="false">
                    {{ __('company.common.544') }}</button>
                  <button type="button" class="view-tabs__btn" role="tab" aria-selected="false">
                    {{ __('company.common.455') }}</button>
                </div>
              </div>
            </div>

            <div class="table-filter-bar">
              <div class="table-filter-bar__left">
                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    id="userTypeBtn"
                  >
                    {{ __('company.common.574') }}<i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>

                    <li>
                      <a class="dropdown-item" href="#" data-value="مدير الشركة">{{ __('company.common.514') }}</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#" data-value="مدير الفرع">{{ __('company.common.515') }}</a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#" data-value="مدير الفرع">{{ __('company.common.559') }}</a>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="managersSearchInput"  placeholder="{{ __('company.pages.managers-employees.7') }}" />
              </div>
            </div>

            
            <div class="table-responsive-custom">
              <table class="data-table" id="managersTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.131') }}</th>
                    <th>{{ __('company.common.396') }}</th>
                    <th>{{ __('company.common.154') }}</th>
                    <th>{{ __('company.common.574') }}</th>
                    <th>{{ __('company.common.431') }}</th>
                    <th>{{ __('company.common.466') }}</th>
                    <th>{{ __('company.common.363') }}</th>
                    <th>{{ __('company.common.76') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr data-manager="أحمد حبيب">
                    <td>{{ __('company.pages.managers-employees.1') }}</td>
                    <td class="ltr-num">+966537946732</td>
                    <td class="ltr-num">Aredahabib@Gmail.Com</td>
                    <td>{{ __('company.common.513') }}</td>
                    <td>N2</td>
                    <td>
                      <button
                        type="button"
                        class="branch-cell-btn"
                        data-branches="9"
                        data-manager="أحمد حبيب"
                      >
                        9 <i class="bi bi-buildings"></i>
                      </button>
                    </td>
                    <td>
                      <button
                        type="button"
                        class="status-toggle status-toggle--active"
                        data-status="active"
                      >
                        {{ __('company.common.544') }}</button>
                    </td>
                    <td class="text-end">
                      <div class="cell-actions" style="justify-content: flex-end">
                        <a
                          href="{{ route('company.edit-company-manager') }}"
                          class="btn btn-primary btn-sm"
                           title="{{ __('company.common.309') }}"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item branch-assign-btn"
                              >
                                <i class="bi bi-buildings"></i> {{ __('company.pages.managers-employees.2') }}</button>
                            </li>
                            <li>
                              <button type="button" class="dropdown-item action-menu-item">
                                <i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr data-manager="محمد الذكمي">
                    <td>{{ __('company.pages.managers-employees.3') }}</td>
                    <td class="ltr-num">+966559327090</td>
                    <td class="ltr-num">Amranalhatar07@Gmail.Com</td>
                    <td>{{ __('company.pages.managers-employees.4') }}</td>
                    <td>N2</td>
                    <td>
                      <button
                        type="button"
                        class="branch-cell-btn"
                        data-branches="8"
                        data-manager="محمد الذكمي"
                      >
                        8 <i class="bi bi-buildings"></i>
                      </button>
                    </td>
                    <td>
                      <button
                        type="button"
                        class="status-toggle status-toggle--active"
                        data-status="active"
                      >
                        {{ __('company.common.544') }}</button>
                    </td>
                    <td class="text-end">
                      <div class="cell-actions" style="justify-content: flex-end">
                        <a
                          href="{{ route('company.edit-company-manager') }}"
                          class="btn btn-primary btn-sm"
                           title="{{ __('company.common.309') }}"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item branch-assign-btn"
                              >
                                <i class="bi bi-buildings"></i> {{ __('company.pages.managers-employees.2') }}</button>
                            </li>
                            <li>
                              <button type="button" class="dropdown-item action-menu-item">
                                <i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr data-manager="AlHATTAR">
                    <td>AlHATTAR</td>
                    <td class="ltr-num">+966553807746</td>
                    <td class="ltr-num">Farsalshqrdy@Gmail.Com</td>
                    <td>{{ __('company.common.513') }}</td>
                    <td>N2</td>
                    <td>
                      <button
                        type="button"
                        class="branch-cell-btn"
                        data-branches="9"
                        data-manager="AlHATTAR"
                      >
                        9 <i class="bi bi-buildings"></i>
                      </button>
                    </td>
                    <td>
                      <button
                        type="button"
                        class="status-toggle status-toggle--active"
                        data-status="active"
                      >
                        {{ __('company.common.544') }}</button>
                    </td>
                    <td class="text-end">
                      <div class="cell-actions" style="justify-content: flex-end">
                        <a
                          href="{{ route('company.edit-company-manager') }}"
                          class="btn btn-primary btn-sm"
                           title="{{ __('company.common.309') }}"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item branch-assign-btn"
                              >
                                <i class="bi bi-buildings"></i> {{ __('company.pages.managers-employees.2') }}</button>
                            </li>
                            <li>
                              <button type="button" class="dropdown-item action-menu-item">
                                <i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr data-manager="محمد الذكمي">
                    <td>{{ __('company.pages.managers-employees.3') }}</td>
                    <td class="ltr-num">+966533443472</td>
                    <td class="ltr-num">Mohamedelshafiy2@Gmail.Com</td>
                    <td>{{ __('company.common.513') }}</td>
                    <td>N2</td>
                    <td>
                      <button
                        type="button"
                        class="branch-cell-btn"
                        data-branches="9"
                        data-manager="محمد الذكمي"
                      >
                        9 <i class="bi bi-buildings"></i>
                      </button>
                    </td>
                    <td>
                      <button
                        type="button"
                        class="status-toggle status-toggle--active"
                        data-status="active"
                      >
                        {{ __('company.common.544') }}</button>
                    </td>
                    <td class="text-end">
                      <div class="cell-actions" style="justify-content: flex-end">
                        <a
                          href="{{ route('company.edit-company-manager') }}"
                          class="btn btn-primary btn-sm"
                           title="{{ __('company.common.309') }}"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item branch-assign-btn"
                              >
                                <i class="bi bi-buildings"></i> {{ __('company.pages.managers-employees.2') }}</button>
                            </li>
                            <li>
                              <button type="button" class="dropdown-item action-menu-item">
                                <i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr data-manager="محمد الذكمي">
                    <td>{{ __('company.pages.managers-employees.3') }}</td>
                    <td class="ltr-num">+966537380443</td>
                    <td class="ltr-num">Ncompany060@Gmail.Com</td>
                    <td>{{ __('company.pages.managers-employees.4') }}</td>
                    <td>N2</td>
                    <td>
                      <button
                        type="button"
                        class="branch-cell-btn"
                        data-branches="9"
                        data-manager="محمد الذكمي"
                      >
                        9 <i class="bi bi-buildings"></i>
                      </button>
                    </td>
                    <td>
                      <button
                        type="button"
                        class="status-toggle status-toggle--active"
                        data-status="active"
                      >
                        {{ __('company.common.544') }}</button>
                    </td>
                    <td class="text-end">
                      <div class="cell-actions" style="justify-content: flex-end">
                        <a
                          href="{{ route('company.edit-company-manager') }}"
                          class="btn btn-primary btn-sm"
                           title="{{ __('company.common.309') }}"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item branch-assign-btn"
                              >
                                <i class="bi bi-buildings"></i> {{ __('company.pages.managers-employees.2') }}</button>
                            </li>
                            <li>
                              <button type="button" class="dropdown-item action-menu-item">
                                <i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr data-manager="محمد الذكمي">
                    <td>{{ __('company.pages.managers-employees.3') }}</td>
                    <td class="ltr-num">+966509180443</td>
                    <td class="ltr-num">Ncompany070@Gmail.Com</td>
                    <td>{{ __('company.pages.managers-employees.4') }}</td>
                    <td>N2</td>
                    <td>
                      <button
                        type="button"
                        class="branch-cell-btn"
                        data-branches="8"
                        data-manager="محمد الذكمي"
                      >
                        8 <i class="bi bi-buildings"></i>
                      </button>
                    </td>
                    <td>
                      <button
                        type="button"
                        class="status-toggle status-toggle--inactive"
                        data-status="inactive"
                      >
                        {{ __('company.common.455') }}</button>
                    </td>
                    <td class="text-end">
                      <div class="cell-actions" style="justify-content: flex-end">
                        <a
                          href="{{ route('company.edit-company-manager') }}"
                          class="btn btn-primary btn-sm"
                           title="{{ __('company.common.309') }}"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item branch-assign-btn"
                              >
                                <i class="bi bi-buildings"></i> {{ __('company.pages.managers-employees.2') }}</button>
                            </li>
                            <li>
                              <button type="button" class="dropdown-item action-menu-item">
                                <i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr data-manager="سارة العتيبي">
                    <td>{{ __('company.pages.managers-employees.5') }}</td>
                    <td class="ltr-num">+966501234567</td>
                    <td class="ltr-num">Sarah.Otaibi@Gmail.Com</td>
                    <td>{{ __('company.common.513') }}</td>
                    <td>N2</td>
                    <td>
                      <button
                        type="button"
                        class="branch-cell-btn"
                        data-branches="5"
                        data-manager="سارة العتيبي"
                      >
                        5 <i class="bi bi-buildings"></i>
                      </button>
                    </td>
                    <td>
                      <button
                        type="button"
                        class="status-toggle status-toggle--inactive"
                        data-status="inactive"
                      >
                        {{ __('company.common.455') }}</button>
                    </td>
                    <td class="text-end">
                      <div class="cell-actions" style="justify-content: flex-end">
                        <a
                          href="{{ route('company.edit-company-manager') }}"
                          class="btn btn-primary btn-sm"
                           title="{{ __('company.common.309') }}"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <button
                                type="button"
                                class="dropdown-item action-menu-item branch-assign-btn"
                              >
                                <i class="bi bi-buildings"></i> {{ __('company.pages.managers-employees.2') }}</button>
                            </li>
                            <li>
                              <button type="button" class="dropdown-item action-menu-item">
                                <i class="bi bi-trash"></i> {{ __('company.common.370') }}</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            
            <div class="table-pagination table-pagination-dt">
              <div class="table-pagination__size-select">
                <label for="pageSizeSelectMgr">{{ __('company.common.212') }}</label>
                <select id="pageSizeSelectMgr">
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
                <button class="table-pagination__page-btn">
                  <i class="bi bi-chevron-left"></i>
                </button>
              </div>
            </div>
          </div>
@endsection

@push('modals')
</main>
        
      

    
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        // View tabs functionality
        const viewTabs = document.querySelectorAll(
          '.view-tabs[aria-label="حالة المدير"] .view-tabs__btn',
        );

        viewTabs.forEach((tab) => {
          tab.addEventListener('click', function () {
            viewTabs.forEach((t) => {
              t.classList.remove('is-active');
              t.setAttribute('aria-selected', 'false');
            });

            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');

            // Filter table rows based on status
            const filterType = this.textContent.trim();
            const tableRows = document.querySelectorAll('#managersTable tbody tr');

            tableRows.forEach((row) => {
              const statusBadge = row.querySelector('.status-badge');
              if (statusBadge) {
                const rowStatus = statusBadge.textContent.trim();

                if (filterType === 'الكل') {
                  row.style.display = '';
                } else if (filterType === 'مفعل' && rowStatus === 'مفعل') {
                  row.style.display = '';
                } else if (filterType === 'غير مفعل' && rowStatus === 'غير مفعل') {
                  row.style.display = '';
                } else {
                  row.style.display = 'none';
                }
              }
            });
          });
        });

        // Status toggle functionality
        document.querySelectorAll('.status-toggle').forEach((button) => {
          button.addEventListener('click', function () {
            const currentStatus = this.getAttribute('data-status');

            if (currentStatus === 'active') {
              // Switch to inactive
              this.setAttribute('data-status', 'inactive');
              this.classList.remove('status-toggle--active');
              this.classList.add('status-toggle--inactive');
              this.textContent = 'غير مفعل';
            } else {
              // Switch to active
              this.setAttribute('data-status', 'active');
              this.classList.remove('status-toggle--inactive');
              this.classList.add('status-toggle--active');
              this.textContent = 'مفعل';
            }
          });
        });

        // Branch modal functionality
        var branchModal = new bootstrap.Modal(document.getElementById('branchModal'));
        var managerNameEl = document.getElementById('managerName');

        // Open modal from branch cell button
        document.querySelectorAll('.branch-cell-btn').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var managerName = this.getAttribute('data-manager');
            managerNameEl.textContent = managerName;
            branchModal.show();
          });
        });

        // Open modal from action menu "إسناد فروع" button
        document.querySelectorAll('.branch-assign-btn').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var row = this.closest('tr');
            var managerName = row.getAttribute('data-manager');
            managerNameEl.textContent = managerName;
            branchModal.show();
          });
        });

        // Save branches button (placeholder)
        document.getElementById('saveBranchesBtn').addEventListener('click', function () {
          console.log('Branches saved');
          branchModal.hide();
        });

        // Live search functionality
        document.getElementById('managersSearchInput').addEventListener('input', function () {
          const q = this.value.trim().toLowerCase();
          document.querySelectorAll('#managersTable tbody tr').forEach((row) => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(q) ? '' : 'none';
          });
        });
      });
    </script>
@endpush

