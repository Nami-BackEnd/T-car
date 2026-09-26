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
                      <li id="branchOptionsList">
                        <div class="dropdown-item">
                          <span class="text-muted small">{{ __('company.drivers.loading') }}</span>
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
                      <ul class="dropdown-menu w-100" aria-labelledby="countryCodeBtn" id="countryCodeList">
                        <li>
                          <div class="dropdown-item">
                            <span class="text-muted small">{{ __('company.drivers.loading') }}</span>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <span class="form-field__error">{{ __('company.common.179') }}</span>
                  </div>

                  <div class="form-field" data-required>
                    <label class="form-field__label"
                      >{{ __('company.common.181') }}<span class="text-danger">*</span></label
                    >
                    <input
                      type="text"
                      class="form-field__input ltr-num"
                      id="driverPhoneNumber"
                      placeholder="5XXXXXXXX"
                    />
                    <span class="form-field__error">{{ __('company.drivers.errors.phone_required') }}</span>
                  </div>
                </div>

                
                <div class="form-grid">
                  <div class="form-field" data-required>
                    <label for="licenseExpiryInput" class="form-field__label"
                      >{{ __('company.common.295') }}<span class="text-danger">*</span></label
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
                    <span class="form-field__error">{{ __('company.drivers.errors.license_required') }}</span>
                  </div>

                  <div class="form-field" data-required>
                    <label class="form-field__label"
                      >{{ __('company.common.402') }}<span class="text-danger">*</span></label
                    >
                    <input
                      type="text"
                      class="form-field__input ltr-num"
                      id="driverIdentityNumber"
                      placeholder="{{ __('company.pages.add-driver.3') }}"
                    />
                    <span class="form-field__error">{{ __('company.drivers.errors.identity_required') }}</span>
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
        var branchSelectAll = document.getElementById('branchSelectAll');
        var branchPlaceholder = @json(__('company.common.110'));

        function syncAllChecked() {
          if (!branchSelectAll) return;
          var allCheckboxes = branchDropdownMenu.querySelectorAll(
            'input[type="checkbox"][data-branch]',
          );
          branchSelectAll.checked =
            allCheckboxes.length > 0 &&
            Array.from(allCheckboxes).every(function (cb) {
              return cb.checked;
            });
        }

        function bindBranchCheckboxes() {
          branchDropdownMenu
            .querySelectorAll('input[type="checkbox"][data-branch]')
            .forEach(function (cb) {
              cb.onchange = function () {
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
                syncAllChecked();
                updateMultiSelectDisplay(
                  selectedBranches,
                  branchSelectBtn,
                  branchSelectValue,
                  branchPlaceholder,
                );
              };
            });
        }

        if (branchDropdownMenu) {
          // Select All functionality
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
                branchPlaceholder,
              );
            });
          }

          bindBranchCheckboxes();

          function updateBranchDisplay() {
            updateMultiSelectDisplay(
              selectedBranches,
              branchSelectBtn,
              branchSelectValue,
              branchPlaceholder,
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
       Load options (branches + phone codes) from the database
    ============================================================= */
        var optionsUrl = '{{ route('company.add-driver.options') }}';
        var storeUrl = '{{ route('company.drivers.store') }}';
        var csrf = document.querySelector('meta[name="csrf-token"]');
        var isAr = @json(app()->getLocale() === 'ar');

        var selectedPhoneCode = @json('+966');
        var noBranches = @json(__('company.drivers.no_branches_available'));

        function escapeHtml(value) {
          return String(value).replace(/[&<>"']/g, function (c) {
            return {
              '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;',
            }[c];
          });
        }

        function renderBranches(branches) {
          var list = document.getElementById('branchOptionsList');
          if (!list) return;

          if (!branches.length) {
            list.innerHTML =
              '<div class="dropdown-item"><span class="text-muted small">' +
              escapeHtml(noBranches) +
              '</span></div>';
            return;
          }

          list.innerHTML = branches
            .map(function (branch) {
              var label = (isAr ? branch.name_ar : branch.name_en) || branch.name_ar || branch.name_en;

              return (
                '<div class="dropdown-item">' +
                '<label class="checkbox-option">' +
                '<input type="checkbox" data-branch="' + branch.id + '" data-label="' +
                escapeHtml(label) + '" />' +
                '<span class="checkbox-custom"></span>' + escapeHtml(label) + '</label></div>'
              );
            })
            .join('');

          // Re-bind after the list is rebuilt.
          bindBranchCheckboxes();
        }

        function renderPhoneCodes(countries) {
          var list = document.getElementById('countryCodeList');
          if (!list) return;

          list.innerHTML = countries
            .map(function (country) {
              var label = (isAr ? country.title_ar : country.title_en) || country.title_en;

              return (
                '<li><a class="dropdown-item ltr-num" href="#" data-value="' +
                escapeHtml(country.phone_code) + '">' + escapeHtml(label) + '</a></li>'
              );
            })
            .join('');

          list.querySelectorAll('a[data-value]').forEach(function (link) {
            link.addEventListener('click', function (e) {
              e.preventDefault();
              selectedPhoneCode = this.getAttribute('data-value');
              document.getElementById('countryCodeValue').textContent = selectedPhoneCode;
            });
          });
        }

        function loadOptions() {
          return fetch(optionsUrl, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
          })
            .then(function (r) {
              return r.json();
            })
            .then(function (res) {
              var data = res.data || {};
              renderBranches(data.branches || []);
              renderPhoneCodes(data.phone_codes || []);
            })
            .catch(function () {
              renderBranches([]);
              renderPhoneCodes([]);
            });
        }

        /* ============================================================
       Validation + submit
    ============================================================= */
        var form = document.getElementById('addDriverForm');
        var successBanner = document.getElementById('saveSuccessBanner');

        var messages = {
          name: @json(__('company.drivers.errors.name_required')),
          phone: @json(__('company.drivers.errors.phone_required')),
          identity: @json(__('company.drivers.errors.identity_required')),
          license: @json(__('company.drivers.errors.license_required')),
          email: @json(__('company.drivers.errors.email_invalid')),
          passwordShort: @json(__('company.drivers.errors.password_short')),
          passwordMismatch: @json(__('company.drivers.errors.password_mismatch')),
          branches: @json(__('company.drivers.errors.branches_required')),
          saveFailed: @json(__('company.drivers.errors.save_failed')),
        };

        function setError(el, message) {
          var field = el.closest('.form-field');
          if (!field) return false;
          field.classList.add('is-invalid');
          var slot = field.querySelector('.form-field__error');
          if (slot && message) slot.textContent = message;
          return false;
        }

        function clearError(el) {
          var field = el.closest('.form-field');
          if (field) field.classList.remove('is-invalid');
          return true;
        }

        function validateForm() {
          var isValid = true;

          function check(id, ok, message) {
            var el = document.getElementById(id);
            if (!el) return;
            if (ok) {
              clearError(el);
            } else {
              isValid = setError(el, message);
            }
          }

          check('driverFullName', getValue('driverFullName').length > 0, messages.name);
          check('driverPhoneNumber', getValue('driverPhoneNumber').length > 0, messages.phone);
          check('driverIdentityNumber', getValue('driverIdentityNumber').length > 0, messages.identity);
          check('licenseExpiryInput', getValue('licenseExpiryInput').length > 0, messages.license);

          var emailEl = document.getElementById('driverEmail');
          var emailVal = emailEl ? emailEl.value.trim() : '';
          var emailOk = emailVal === '' || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal);
          check('driverEmail', emailOk, messages.email);

          var pass1 = getValue('driverPassword');
          var pass2 = getValue('driverPasswordConfirm');
          var passwordLengthOk = pass1.length >= 8;
          var passwordsMatch = pass1 === pass2;

          check('driverPassword', passwordLengthOk, messages.passwordShort);
          check(
            'driverPasswordConfirm',
            passwordLengthOk && passwordsMatch,
            messages.passwordMismatch,
          );

          var branchBtn = document.getElementById('branchSelectBtn');
          if (selectedBranches.length === 0) {
            isValid = setError(branchBtn, messages.branches);
          } else {
            clearError(branchBtn);
          }

          return isValid;
        }

        function getValue(id) {
          var el = document.getElementById(id);
          return el ? el.value.trim() : '';
        }

        form.addEventListener('submit', function (e) {
          e.preventDefault();
          successBanner.classList.remove('is-visible');

          if (!validateForm()) {
            var firstInvalid = form.querySelector('.form-field.is-invalid');
            if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
          }

          var payload = {
            name: getValue('driverFullName'),
            phone_code: selectedPhoneCode,
            phone: getValue('driverPhoneNumber'),
            license_expiration_date: getValue('licenseExpiryInput'),
            identity_number: getValue('driverIdentityNumber'),
            email: getValue('driverEmail') || null,
            password: getValue('driverPassword'),
            password_confirmation: getValue('driverPasswordConfirm'),
            assigned_to_all_branches: false,
            is_active: true,
            branches: selectedBranches.map(function (b) {
              return parseInt(b.value, 10);
            }),
          };

          var submitBtn = form.querySelector('button[type="submit"]');
          if (submitBtn) submitBtn.disabled = true;

          fetch(storeUrl, {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': csrf.content,
              'Content-Type': 'application/json',
              'Accept': 'application/json',
            },
            body: JSON.stringify(payload),
          })
            .then(function (r) {
              return r.json();
            })
            .then(function (res) {
              if (res.code && res.code >= 400) {
                applyServerErrors(res.data && res.data.errors);
                window.alert((res.data && res.data.message) || messages.saveFailed);
                return;
              }

              // Laravel validation failures resolve with HTTP 422 and no
              // `code` field, so surface the field errors instead of the
              // generic success path.
              if (res.errors) {
                applyServerErrors(res.errors);
                window.alert(messages.saveFailed);
                return;
              }

              window.location.href = '{{ route('company.drivers') }}';
            })
            .catch(function () {
              window.alert(messages.saveFailed);
            })
            .then(function () {
              if (submitBtn) submitBtn.disabled = false;
            });
        });

        function applyServerErrors(errors) {
          if (!errors) return;

          var map = {
            name: 'driverFullName',
            phone: 'driverPhoneNumber',
            identity_number: 'driverIdentityNumber',
            license_expiration_date: 'licenseExpiryInput',
            email: 'driverEmail',
            password: 'driverPassword',
            branches: 'branchSelectBtn',
          };

          Object.keys(map).forEach(function (key) {
            if (!errors[key]) return;
            var el = document.getElementById(map[key]);
            if (el) setError(el, errors[key][0]);
          });
        }

        loadOptions();

        document.getElementById('cancelDriverBtn').addEventListener('click', function () {
          window.location.href = '{{ route('company.drivers') }}';
        });
      });
    </script>
@endpush
