@extends('company.layouts.master')

@section('title', 'T-Car — إضافة سائق')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.84') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.233') }}</span>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('company.drivers') }}">{{ __('company.common.190') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.common.84') }}</span>
              </nav>
            </div>
          </div>

          
          <div class="save-success-banner" id="saveSuccessBanner">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ __('company.common.337') }}</span>
          </div>

          
          <form id="addDriverForm" novalidate>
            <div class="edit-office-card mb-4">
              <div class="edit-office-card__header">
                <h5 class="edit-office-card__title">
                  <i class="bi bi-person-badge"></i>
                  {{ __('company.common.313') }}</h5>
              </div>
              <div class="edit-office-card__body">
                
                <div class="form-field" data-required>
                  <label class="form-field__label"
                    >{{ __('company.common.150') }}<span class="text-danger">*</span></label
                  >
                  <input
                    type="text"
                    class="form-field__input"
                    id="driverFullName"
                     placeholder="{{ __('company.pages.add-driver.2') }}"
                  />
                  <span class="form-field__error">{{ __('company.common.580') }}</span>
                </div>

                
                <div class="form-field" data-required>
                  <label class="form-field__label"
                    >{{ __('company.common.299') }}<span class="text-danger">*</span></label
                  >
                  <div class="dropdown">
                    <button
                      type="button"
                      class="filter-dropdown-btn dropdown-toggle w-100"
                      id="branchSelectBtn"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      aria-expanded="false"
                    >
                      <span
                        class="filter-dropdown-btn__value"
                        id="branchSelectValue"
                        data- placeholder="{{ __('company.common.110') }}"
                        >{{ __('company.common.110') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu w-100"
                      aria-labelledby="branchSelectBtn"
                      id="branchDropdownMenu"
                    >
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input type="search"  placeholder="{{ __('company.common.258') }}" id="branchSearchInput" />
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" id="branchSelectAll" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.common.223') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-branch="utaik" data-label="N2 فرع العتيق" />
                            <span class="checkbox-custom"></span>
                            {{ __('company.common.49') }}</label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input type="checkbox" data-branch="olaya" data-label="N2-Al-Olaya" />
                            <span class="checkbox-custom"></span>
                            N2-Al-Olaya
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input
                              type="checkbox"
                              data-branch="rawdah"
                              data-label="N2 Rental Car - Rawdah"
                            />
                            <span class="checkbox-custom"></span>
                            N2 Rental Car - Rawdah
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input
                              type="checkbox"
                              data-branch="aziziyah"
                              data-label="N2 Rental Car - Riyadh - Al Aziziyah"
                            />
                            <span class="checkbox-custom"></span>
                            N2 Rental Car - Riyadh - Al Aziziyah
                          </label>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-item">
                          <label class="checkbox-option">
                            <input
                              type="checkbox"
                              data-branch="awali"
                              data-label="N2 Rental Car - Riyadh - Exit 27, Al-Awali"
                            />
                            <span class="checkbox-custom"></span>
                            N2 Rental Car - Riyadh - Exit 27, Al-Awali
                          </label>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <span class="form-field__error">{{ __('company.pages.add-driver.0') }}</span>
                </div>

                
                <div class="form-grid">
                  <div class="form-field" data-required>
                    <label class="form-field__label"
                      >{{ __('company.common.405') }}<span class="text-danger">*</span></label
                    >
                    <div class="dropdown">
                      <button
                        type="button"
                        class="filter-dropdown-btn dropdown-toggle w-100"
                        id="countryCodeBtn"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        <span class="filter-dropdown-btn__value ltr-num" id="countryCodeValue"
                          >966+</span
                        >
                        <i class="bi bi-chevron-down"></i>
                      </button>
                      <ul class="dropdown-menu w-100" aria-labelledby="countryCodeBtn">
                        <li>
                          <a class="dropdown-item ltr-num" href="#" data-value="966+"
                            >{{ __('company.common.44') }}</a
                          >
                        </li>
                        <li>
                          <a class="dropdown-item ltr-num" href="#" data-value="971+"
                            >{{ __('company.common.46') }}</a
                          >
                        </li>
                        <li>
                          <a class="dropdown-item ltr-num" href="#" data-value="973+"
                            >{{ __('company.common.47') }}</a
                          >
                        </li>
                        <li>
                          <a class="dropdown-item ltr-num" href="#" data-value="965+"
                            >{{ __('company.common.43') }}</a
                          >
                        </li>
                        <li>
                          <a class="dropdown-item ltr-num" href="#" data-value="968+">{{ __('company.common.45') }}</a>
                        </li>
                        <li>
                          <a class="dropdown-item ltr-num" href="#" data-value="974+">{{ __('company.common.48') }}</a>
                        </li>
                      </ul>
                    </div>
                    <span class="form-field__error">{{ __('company.common.179') }}</span>
                  </div>

                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.181') }}</label>
                    <input
                      type="text"
                      class="form-field__input ltr-num"
                      id="driverPhoneNumber"
                      placeholder="5XXXXXXXX"
                    />
                  </div>
                </div>

                
                <div class="form-grid">
                  <div class="form-field">
                    <label for="licenseExpiryInput" class="form-field__label"
                      >{{ __('company.common.295') }}</label
                    >
                    <div class="date-field-wrap">
                      <input
                        type="date"
                        class="form-field__input ltr-num"
                        id="licenseExpiryInput"
                      />
                      <button
                        type="button"
                        class="date-field-icon"
                        id="licenseExpiryIconBtn"
                        tabindex="-1"
                         aria-label="{{ __('company.common.456') }}"
                      >
                        <i class="bi bi-calendar3"></i>
                      </button>
                    </div>
                  </div>

                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.402') }}</label>
                    <input
                      type="text"
                      class="form-field__input ltr-num"
                       placeholder="{{ __('company.pages.add-driver.3') }}"
                    />
                  </div>
                </div>

                
                <div class="form-field" data-required>
                  <label class="form-field__label"
                    >{{ __('company.common.153') }}<span class="text-danger">*</span></label
                  >
                  <input
                    type="email"
                    class="form-field__input ltr-num"
                    id="driverEmail"
                    placeholder="example@n2.com"
                  />
                  <span class="form-field__error">{{ __('company.common.177') }}</span>
                </div>

                <div class="form-grid">
                  <div class="form-field" data-required>
                    <label class="form-field__label"
                      >{{ __('company.common.182') }}<span class="text-danger">*</span></label
                    >
                    <div class="password-field">
                      <input
                        type="password"
                        class="form-field__input ltr-num"
                        id="driverPassword"
                        placeholder="••••••••"
                      />
                      <button
                        type="button"
                        class="password-field__toggle"
                        data-toggle-password="driverPassword"
                        tabindex="-1"
                         aria-label="{{ __('company.common.91') }}"
                      >
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                    <span class="form-field__error">{{ __('company.pages.add-driver.1') }}</span>
                  </div>

                  <div class="form-field" data-required>
                    <label class="form-field__label"
                      >{{ __('company.common.278') }}<span class="text-danger">*</span></label
                    >
                    <div class="password-field">
                      <input
                        type="password"
                        class="form-field__input ltr-num"
                        id="driverPasswordConfirm"
                        placeholder="••••••••"
                      />
                      <button
                        type="button"
                        class="password-field__toggle"
                        data-toggle-password="driverPasswordConfirm"
                        tabindex="-1"
                         aria-label="{{ __('company.common.91') }}"
                      >
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                    <span class="form-field__error">{{ __('company.common.482') }}</span>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="eo-savebar">
              <button type="button" class="btn btn-outline" id="cancelDriverBtn">
                <i class="bi bi-x-lg"></i> {{ __('company.common.95') }}</button>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-check2-circle"></i> {{ __('company.common.375') }}</button>
            </div>
          </form>
@endsection

@push('modals')
</main>
        
      

    
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        // Status toggle functionality (kept from the drivers list page)
        document.querySelectorAll('.status-toggle').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var currentStatus = this.getAttribute('data-status');

            if (currentStatus === 'active') {
              this.setAttribute('data-status', 'inactive');
              this.classList.remove('status-toggle--active');
              this.classList.add('status-toggle--inactive');
              this.textContent = 'غير مفعل';
            } else {
              this.setAttribute('data-status', 'active');
              this.classList.remove('status-toggle--inactive');
              this.classList.add('status-toggle--active');
              this.textContent = 'مفعل';
            }
          });
        });

        /* ============================================================
       Generic "single-select" dropdown logic
       — used for "رمز المنطقة"
    ============================================================= */
        function wireSingleSelectDropdown(triggerBtn, valueEl) {
          if (!triggerBtn) return;
          var menu = triggerBtn.nextElementSibling;
          menu.querySelectorAll('.dropdown-item').forEach(function (item) {
            item.addEventListener('click', function (e) {
              e.preventDefault();
              valueEl.textContent = this.getAttribute('data-value');
              triggerBtn.classList.add('has-value');
              triggerBtn.closest('.form-field').classList.remove('is-invalid');
            });
          });
        }

        wireSingleSelectDropdown(
          document.getElementById('countryCodeBtn'),
          document.getElementById('countryCodeValue'),
        );

        /* ============================================================
       Multi-select dropdown logic (تخصيصه إلى فرع)
    ============================================================= */
        function updateMultiSelectDisplay(selected, btnEl, valueEl, placeholder) {
          if (selected.length === 0) {
            valueEl.textContent = placeholder;
            valueEl.removeAttribute('title');
            btnEl.classList.remove('has-value');
            return;
          }
          var labels = selected
            .map(function (o) {
              return o.label;
            })
            .join('، ');
          valueEl.textContent = selected.length > 2 ? selected.length + ' محدد' : labels;
          valueEl.setAttribute('title', labels);
          btnEl.classList.add('has-value');
        }

        var selectedBranches = [];
        var branchSelectBtn = document.getElementById('branchSelectBtn');
        var branchSelectValue = document.getElementById('branchSelectValue');
        var branchDropdownMenu = document.getElementById('branchDropdownMenu');
        var branchSearchInput = document.getElementById('branchSearchInput');

        if (branchDropdownMenu) {
          // Select All functionality
          var branchSelectAll = document.getElementById('branchSelectAll');
          if (branchSelectAll) {
            branchSelectAll.addEventListener('change', function () {
              var isChecked = this.checked;
              branchDropdownMenu
                .querySelectorAll('input[type="checkbox"][data-branch]')
                .forEach(function (cb) {
                  cb.checked = isChecked;
                  var branch = cb.getAttribute('data-branch');
                  var label = cb.getAttribute('data-label');
                  if (isChecked) {
                    if (
                      !selectedBranches.some(function (o) {
                        return o.value === branch;
                      })
                    ) {
                      selectedBranches.push({ value: branch, label: label });
                    }
                  } else {
                    selectedBranches = selectedBranches.filter(function (o) {
                      return o.value !== branch;
                    });
                  }
                });
              updateMultiSelectDisplay(
                selectedBranches,
                branchSelectBtn,
                branchSelectValue,
                'اختر الفرع',
              );
            });
          }

          branchDropdownMenu
            .querySelectorAll('input[type="checkbox"][data-branch]')
            .forEach(function (cb) {
              cb.addEventListener('change', function () {
                var branch = this.getAttribute('data-branch');
                var label = this.getAttribute('data-label');
                if (this.checked) {
                  if (
                    !selectedBranches.some(function (o) {
                      return o.value === branch;
                    })
                  ) {
                    selectedBranches.push({ value: branch, label: label });
                  }
                } else {
                  selectedBranches = selectedBranches.filter(function (o) {
                    return o.value !== branch;
                  });
                }
                // Update Select All checkbox state
                if (branchSelectAll) {
                  var allCheckboxes = branchDropdownMenu.querySelectorAll(
                    'input[type="checkbox"][data-branch]',
                  );
                  var allChecked = Array.from(allCheckboxes).every(function (cb) {
                    return cb.checked;
                  });
                  branchSelectAll.checked = allChecked;
                }
                updateMultiSelectDisplay(
                  selectedBranches,
                  branchSelectBtn,
                  branchSelectValue,
                  'اختر الفرع',
                );
              });
            });

          function updateBranchDisplay() {
            updateMultiSelectDisplay(
              selectedBranches,
              branchSelectBtn,
              branchSelectValue,
              'اختر الفرع',
            );
          }

          branchSearchInput.addEventListener('click', function (e) {
            e.stopPropagation();
          });
          branchSearchInput.addEventListener('input', function () {
            var q = this.value.trim().toLowerCase();
            branchDropdownMenu
              .querySelectorAll('input[type="checkbox"][data-branch]')
              .forEach(function (cb) {
                var label = cb.getAttribute('data-label').toLowerCase();
                cb.closest('li').style.display = label.includes(q) ? '' : 'none';
              });
            // Hide select all checkbox during search
            if (branchSelectAll) {
              branchSelectAll.closest('li').style.display = q.length > 0 ? 'none' : '';
            }
          });

          branchSelectBtn.addEventListener('hidden.bs.dropdown', function () {
            branchSearchInput.value = '';
            branchDropdownMenu
              .querySelectorAll('input[type="checkbox"][data-branch]')
              .forEach(function (cb) {
                cb.closest('li').style.display = '';
              });
          });
        }

        /* ============================================================
       Password show/hide toggles
    ============================================================= */
        document.querySelectorAll('[data-toggle-password]').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var input = document.getElementById(this.getAttribute('data-toggle-password'));
            var icon = this.querySelector('i');
            if (input.type === 'password') {
              input.type = 'text';
              icon.className = 'bi bi-eye-slash';
            } else {
              input.type = 'password';
              icon.className = 'bi bi-eye';
            }
          });
        });

        /* ============================================================
       Generate a strong random password into both password fields
    ============================================================= */
        document.getElementById('generatePasswordBtn').addEventListener('click', function () {
          var chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$%';
          var pwd = '';
          for (var i = 0; i < 12; i++) {
            pwd += chars.charAt(Math.floor(Math.random() * chars.length));
          }

          var pass1 = document.getElementById('driverPassword');
          var pass2 = document.getElementById('driverPasswordConfirm');
          [pass1, pass2].forEach(function (input) {
            input.value = pwd;
            input.type = 'text';
            var toggleBtn = input.parentElement.querySelector('[data-toggle-password]');
            if (toggleBtn) toggleBtn.querySelector('i').className = 'bi bi-eye-slash';
            input.closest('.form-field').classList.remove('is-invalid');
          });
        });

        /* ============================================================
       Open the native date picker when the calendar icon is clicked
           ============================================================= */
        document.getElementById('licenseExpiryIconBtn').addEventListener('click', function () {
          var input = document.getElementById('licenseExpiryInput');
          if (input.showPicker) {
            input.showPicker();
          } else {
            input.focus();
          }
        });

        /* ============================================================
       Lightweight validation + submit
           ============================================================= */
        var form = document.getElementById('addDriverForm');
        var successBanner = document.getElementById('saveSuccessBanner');

        function validateForm() {
          var isValid = true;

          function markField(el, ok) {
            var field = el.closest('.form-field');
            field.classList.toggle('is-invalid', !ok);
            if (!ok) isValid = false;
          }

          markField(
            document.getElementById('driverFullName'),
            document.getElementById('driverFullName').value.trim().length > 0,
          );

          var branchChosen = selectedBranches.length > 0;
          markField(document.getElementById('branchSelectBtn'), branchChosen);

          markField(document.getElementById('countryCodeBtn'), true); // has a default value already

          var emailVal = document.getElementById('driverEmail').value.trim();
          var emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal);
          markField(document.getElementById('driverEmail'), emailOk);

          var pass1 = document.getElementById('driverPassword').value;
          var pass2 = document.getElementById('driverPasswordConfirm').value;
          markField(document.getElementById('driverPassword'), pass1.length >= 6);
          markField(
            document.getElementById('driverPasswordConfirm'),
            pass2.length >= 6 && pass2 === pass1,
          );

          return isValid;
        }

        form.addEventListener('submit', function (e) {
          e.preventDefault();
          successBanner.classList.remove('is-visible');

          if (validateForm()) {
            successBanner.classList.add('is-visible');
            successBanner.scrollIntoView({ behavior: 'smooth', block: 'start' });
          } else {
            var firstInvalid = form.querySelector('.form-field.is-invalid');
            if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        });

        document.getElementById('cancelDriverBtn').addEventListener('click', function () {
          window.location.href = '{{ route('company.drivers') }}';
        });
      });
    </script>
@endpush

