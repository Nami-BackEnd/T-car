@extends('company.layouts.master')

@section('title', 'T-Car — تعديل سائق')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.edit-driver.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.233') }}</span>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('company.drivers') }}">{{ __('company.common.190') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.pages.edit-driver.1') }}</span>
              </nav>
            </div>
          </div>

          
          <div class="save-success-banner" id="saveSuccessBanner">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ __('company.common.337') }}</span>
          </div>

          
          <form id="addDriverForm" novalidate class="edit-driver-form">
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
                      <span class="filter-dropdown-btn__value" id="branchSelectValue"
                        >{{ __('company.common.111') }}</span
                      >
                      <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul
                      class="dropdown-menu w-100"
                      id="branchDropdownMenu"
                      aria-labelledby="branchSelectBtn"
                    >
                      <li>
                        <div class="dropdown-search">
                          <i class="bi bi-search"></i>
                          <input type="search"  placeholder="{{ __('company.common.258') }}" id="branchSearchInput" />
                        </div>
                      </li>
                      
                      <li class="branch-dropdown-empty d-none" id="branchDropdownEmpty">
                        <div class="dropdown-item-text text-muted small px-3 py-2">
                          {{ __('company.pages.edit-driver.2') }}</div>
                      </li>
                    </ul>
                  </div>
                  <span class="form-field__error">{{ __('company.pages.edit-driver.3') }}</span>
                </div>

                
                <div class="form-grid">
                  <div class="form-field" data-required>
                    <label class="form-field__label"
                      >{{ __('company.common.405') }}<span class="text-danger">*</span></label
                    >
                    <div class="dropdown">
                      <button
                        type="button"
                        class="filter-dropdown-btn dropdown-toggle w-100 has-value"
                        id="countryCodeBtn"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        <span class="filter-dropdown-btn__value ltr-num" id="countryCodeValue"
                          >966+</span
                        >
                        <i class="bi bi-chevron-down"></i>
                      </button>
                      <ul class="dropdown-menu w-100" aria-labelledby="countryCodeBtn" id="countryCodeMenu">
                        <li>
                          <div class="dropdown-search">
                            <i class="bi bi-search"></i>
                            <input type="search"  placeholder="{{ __('company.pages.edit-driver.7') }}" />
                          </div>
                        </li>
                        <li id="countryCodeList">
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
                    />
                    <span class="form-field__error">{{ __('company.drivers.errors.phone_required') }}</span>
                  </div>
                </div>

                
                <div class="form-grid">
                  <div class="form-field" data-required>
                    <label class="form-field__label"
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
                  />
                  <span class="form-field__error">{{ __('company.common.177') }}</span>
                </div>

                <div class="form-grid">
                  <div class="form-field" data-required>
                    <label class="form-field__label">{{ __('company.common.182') }}</label>
                    <div class="password-field">
                      <input
                        type="password"
                        class="form-field__input ltr-num"
                        id="driverPassword"
                        placeholder="••••••••"
                        autocomplete="new-password"
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
                    <span class="form-field__error">{{ __('company.pages.edit-driver.4') }}</span>
                  </div>

                  <div class="form-field" data-required>
                    <label class="form-field__label">{{ __('company.common.278') }}</label>
                    <div class="password-field">
                      <input
                        type="password"
                        class="form-field__input ltr-num"
                        id="driverPasswordConfirm"
                        placeholder="••••••••"
                        autocomplete="new-password"
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
    var driverId = @json(request()->route('driver')?->id ?? request()->route('driver'));
    var showUrl = @json(route('company.drivers.show', request()->route('driver')));
    var updateUrl = @json(route('company.edit-driver.update', request()->route('driver')));
    var driversUrl = @json(route('company.drivers'));
    var csrf = document.querySelector('meta[name="csrf-token"]');
    var isAr = @json(app()->getLocale() === 'ar');

    var noMatches = @json(__('company.pages.edit-driver.2'));
    var branchPlaceholder = @json(__('company.common.110'));
    var saveFailed = @json(__('company.drivers.errors.save_failed'));

    var messages = {
      name: @json(__('company.drivers.errors.name_required')),
      phone: @json(__('company.drivers.errors.phone_required')),
      identity: @json(__('company.drivers.errors.identity_required')),
      license: @json(__('company.drivers.errors.license_required')),
      email: @json(__('company.drivers.errors.email_invalid')),
      branches: @json(__('company.drivers.errors.branches_required')),
      saveFailed: saveFailed,
    };

    function escapeHtml(value) {
      return String(value).replace(/[&<>"']/g, function (c) {
        return {
          '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;',
        }[c];
      });
    }

    var assignedBranches = [];
    var allBranches = [];
    var selectedPhoneCode = '';

    var branchSelectBtn = document.getElementById('branchSelectBtn');
    var branchSelectValue = document.getElementById('branchSelectValue');
    var branchDropdownMenu = document.getElementById('branchDropdownMenu');
    var branchDropdownEmpty = document.getElementById('branchDropdownEmpty');
    var branchSearchInput = document.getElementById('branchSearchInput');

    function setField(id, value) {
      var el = document.getElementById(id);
      if (el) el.value = value === null || value === undefined ? '' : value;
    }

    function setError(el, message) {
      if (!el) return false;
      var field = el.closest('.form-field');
      if (!field) return false;
      field.classList.add('is-invalid');
      var slot = field.querySelector('.form-field__error');
      if (slot && message) slot.textContent = message;
      return false;
    }

    function clearError(el) {
      if (!el) return true;
      var field = el.closest('.form-field');
      if (field) field.classList.remove('is-invalid');
      return true;
    }

    /* ---- Branch dropdown ---- */
    function updateBranchDisplay() {
      if (assignedBranches.length === 0) {
        branchSelectValue.textContent = branchPlaceholder;
        branchSelectBtn.classList.remove('has-value');
        return;
      }

      var labels = assignedBranches.map(function (id) {
        var branch = allBranches.find(function (b) {
          return b.id === id;
        });
        return branch ? branch.label : id;
      });

      branchSelectValue.textContent = labels.join('، ');
      branchSelectValue.setAttribute('title', labels.join('، '));
      branchSelectBtn.classList.add('has-value');
    }

    function bindBranchCheckboxes() {
      branchDropdownMenu
        .querySelectorAll('input[type="checkbox"][data-branch]')
        .forEach(function (cb) {
          cb.onchange = function () {
            var id = parseInt(this.getAttribute('data-branch'), 10);
            if (this.checked) {
              if (assignedBranches.indexOf(id) === -1) assignedBranches.push(id);
            } else {
              assignedBranches = assignedBranches.filter(function (b) {
                return b !== id;
              });
            }
            updateBranchDisplay();
            clearError(branchSelectBtn);
          };
        });
    }

    function renderBranchDropdownItems() {
      branchDropdownMenu.querySelectorAll('.branch-dropdown-item').forEach(function (el) {
        el.remove();
      });

      if (!allBranches.length) {
        branchDropdownEmpty.classList.remove('d-none');
        return;
      }

      branchDropdownEmpty.classList.add('d-none');

      allBranches.forEach(function (branch) {
        var li = document.createElement('li');
        li.className = 'branch-dropdown-item';
        li.innerHTML =
          '<div class="dropdown-item">' +
          '<label class="checkbox-option">' +
          '<input type="checkbox" data-branch="' +
          branch.id +
          '" ' +
          (assignedBranches.indexOf(branch.id) !== -1 ? 'checked' : '') +
          '>' +
          '<span class="checkbox-custom"></span>' +
          '<span class="checkbox-label">' +
          escapeHtml(branch.label) +
          '</span>' +
          '</label>' +
          '</div>';
        branchDropdownMenu.insertBefore(li, branchDropdownEmpty);
      });

      bindBranchCheckboxes();
    }

    /* ---- Phone code dropdown ---- */
    function renderPhoneCodes(countries) {
      var list = document.getElementById('countryCodeList');
      if (!list) return;

      list.innerHTML = countries
        .map(function (country) {
          var label = (isAr ? country.title_ar : country.title_en) || country.title_en;
          return (
            '<div class="dropdown-item"><a class="dropdown-item ltr-num" href="#" data-value="' +
            escapeHtml(country.phone_code) + '">' + escapeHtml(label) + '</a></div>'
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

    /* ---- Load driver + options, then hydrate the form ---- */
    function load() {
      return fetch(showUrl, {
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
      })
        .then(function (r) {
          return r.json();
        })
        .then(function (res) {
          if (res.code && res.code >= 400) {
            window.location.href = driversUrl;
            return;
          }

          var driver = res.data.driver;
          var options = res.data.options || {};

          setField('driverFullName', driver.name);
          setField('driverPhoneNumber', driver.phone);
          setField('driverEmail', driver.email);
          setField('driverIdentityNumber', driver.identity_number);
          setField('licenseExpiryInput', driver.license_expiration_date);

          selectedPhoneCode = driver.phone_code || '';
          setField('countryCodeValue', selectedPhoneCode);

          allBranches = (options.branches || []).map(function (branch) {
            return {
              id: parseInt(branch.id, 10),
              label: (isAr ? branch.name_ar : branch.name_en) || branch.name_ar || branch.name_en,
            };
          });
          // A driver flagged as covering every branch may have no explicit
          // pivot rows, so hydrate the picker from the option list instead.
          assignedBranches = driver.assigned_to_all_branches
            ? allBranches.map(function (b) {
                return b.id;
              })
            : (driver.branch_ids || []).map(function (id) {
                return parseInt(id, 10);
              });

          renderBranchDropdownItems();
          updateBranchDisplay();
          renderPhoneCodes(options.phone_codes || []);
        })
        .catch(function () {});
    }

    /* ---- Inline search inside the branch dropdown ---- */
    if (branchSearchInput) {
      branchSearchInput.addEventListener('click', function (e) {
        e.stopPropagation();
      });
      branchSearchInput.addEventListener('input', function () {
        var q = this.value.trim().toLowerCase();
        var visible = 0;

        branchDropdownMenu.querySelectorAll('.branch-dropdown-item').forEach(function (li) {
          var label = (li.textContent || '').trim().toLowerCase();
          var show = !q || label.indexOf(q) !== -1;
          li.style.display = show ? '' : 'none';
          if (show) visible++;
        });

        branchDropdownEmpty.classList.toggle('d-none', visible !== 0);
        if (!visible) {
          branchDropdownEmpty.querySelector('div').textContent = noMatches;
        }
      });
    }

    /* ---- Password show/hide ---- */
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

    /* ---- Native date picker ---- */
    var dateIconBtn = document.getElementById('licenseExpiryIconBtn');
    if (dateIconBtn) {
      dateIconBtn.addEventListener('click', function () {
        var input = document.getElementById('licenseExpiryInput');
        if (input.showPicker) {
          input.showPicker();
        } else {
          input.focus();
        }
      });
    }

    /* ---- Validation + submit ---- */
    var form = document.getElementById('addDriverForm');
    var successBanner = document.getElementById('saveSuccessBanner');

    function value(id) {
      var el = document.getElementById(id);
      return el ? el.value.trim() : '';
    }

    function validateForm() {
      var isValid = true;

      function check(id, ok, message) {
        if (ok) {
          clearError(document.getElementById(id));
        } else {
          isValid = setError(document.getElementById(id), message);
        }
      }

      check('driverFullName', value('driverFullName').length > 0, messages.name);
      check('driverPhoneNumber', value('driverPhoneNumber').length > 0, messages.phone);
      check('driverIdentityNumber', value('driverIdentityNumber').length > 0, messages.identity);
      check('licenseExpiryInput', value('licenseExpiryInput').length > 0, messages.license);

      var emailVal = value('driverEmail');
      var emailOk = emailVal === '' || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal);
      check('driverEmail', emailOk, messages.email);

      // Password is optional on edit; blank means "keep current".
      var pass1 = value('driverPassword');
      if (pass1) {
        var pass2 = value('driverPasswordConfirm');
        var passOk = pass1.length >= 8 && pass1 === pass2;
        check('driverPassword', passOk, messages.passwordMismatch);
        check('driverPasswordConfirm', passOk, messages.passwordMismatch);
      } else {
        clearError(document.getElementById('driverPassword'));
        clearError(document.getElementById('driverPasswordConfirm'));
      }

      if (assignedBranches.length === 0) {
        isValid = setError(branchSelectBtn, messages.branches);
      } else {
        clearError(branchSelectBtn);
      }

      return isValid;
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
        name: value('driverFullName'),
        phone_code: selectedPhoneCode,
        phone: value('driverPhoneNumber'),
        license_expiration_date: value('licenseExpiryInput'),
        identity_number: value('driverIdentityNumber'),
        email: value('driverEmail') || null,
        assigned_to_all_branches:
          allBranches.length > 0 && assignedBranches.length === allBranches.length,
        branches: assignedBranches,
      };

      if (value('driverPassword')) {
        payload.password = value('driverPassword');
        payload.password_confirmation = value('driverPasswordConfirm');
      }

      var submitBtn = form.querySelector('button[type="submit"]');
      if (submitBtn) submitBtn.disabled = true;

      fetch(updateUrl, {
        method: 'PUT',
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
          window.location.href = driversUrl;
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
        setError(document.getElementById(map[key]), errors[key][0]);
      });
    }

    var cancelBtn = document.getElementById('cancelDriverBtn');
    if (cancelBtn) {
      cancelBtn.addEventListener('click', function () {
        window.location.href = driversUrl;
      });
    }

    load();
  </script>
@endpush
