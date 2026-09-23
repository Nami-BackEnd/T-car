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
                    value="ابو سفيان"
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
                      <ul class="dropdown-menu w-100" aria-labelledby="countryCodeBtn">
                        <li>
                          <div class="dropdown-search">
                            <i class="bi bi-search"></i>
                            <input type="search"  placeholder="{{ __('company.pages.edit-driver.7') }}" />
                          </div>
                        </li>
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
                      value="564873828"
                    />
                  </div>
                </div>

                
                <div class="form-grid">
                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.295') }}</label>
                    <div class="date-field-wrap">
                      <input
                        type="date"
                        class="form-field__input ltr-num"
                        id="licenseExpiryInput"
                        value="2034-03-08"
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
                    <input type="text" class="form-field__input ltr-num" value="2507205157" />
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
                    value="Kamrulahmed13579@Gmail.com"
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
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                  <span class="form-field__hint"
                    >{{ __('company.pages.edit-driver.5') }}</span
                  >
                  <button type="button" class="btn-generate-password" id="generatePasswordBtn">
                    <i class="bi bi-shuffle"></i> {{ __('company.pages.edit-driver.6') }}</button>
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
       Multi-select dropdown logic (تخصيصه إلى فرع)
    ============================================================= */
        var ALL_BRANCHES = [
          'N2 فرع العتيق',
          'N2-Al-Olaya',
          'N2 Rental Car - Riyadh - Almarwa',
          'N2 Rental Car-Rawdah',
          'N2 Rental Car - Riyadh - Al Aziziyah',
          'N2 Rental Car - Riyadh -Exit 27, Al-Awali',
          'N2 Rental Car - Riyadh - Qurtubah',
          'N2 - Tuwaiq, Riyadh',
          'N2 Rental Car - Riyadh - Badr',
          'N2 Rental Car - Jeddah - Al Salamah',
          'N2 Rental Car - Dammam - Al Faisaliyah',
        ];

        // الفروع المخصصة لهذا السائق حاليًا (الحالة المبدئية)
        var assignedBranches = [
          'N2 Rental Car - Riyadh -Exit 27, Al-Awali',
          'N2 Rental Car - Riyadh - Al Aziziyah',
          'N2 Rental Car - Riyadh - Almarwa',
          'N2 Rental Car-Rawdah',
          'N2-Al-Olaya',
          'N2 فرع العتيق',
          'N2 Rental Car - Riyadh - Qurtubah',
          'N2 - Tuwaiq, Riyadh',
          'N2 Rental Car - Riyadh - Badr',
        ];

        var branchSelectBtn = document.getElementById('branchSelectBtn');
        var branchSelectValue = document.getElementById('branchSelectValue');
        var branchDropdownMenu = document.getElementById('branchDropdownMenu');
        var branchDropdownEmpty = document.getElementById('branchDropdownEmpty');
        var branchSearchInput = document.getElementById('branchSearchInput');

        function isAssigned(name) {
          return assignedBranches.indexOf(name) !== -1;
        }

        function renderBranchDropdownItems() {
          branchDropdownMenu.querySelectorAll('.branch-dropdown-item').forEach(function (el) {
            el.remove();
          });
          ALL_BRANCHES.forEach(function (name) {
            var li = document.createElement('li');
            li.className = 'branch-dropdown-item';
            li.innerHTML =
              '<div class="dropdown-item">' +
              '<label class="checkbox-option">' +
              '<input type="checkbox" data-branch="' +
              name +
              '" ' +
              (isAssigned(name) ? 'checked' : '') +
              '>' +
              '<span class="checkbox-custom"></span>' +
              '<span class="checkbox-label">' +
              name +
              '</span>' +
              '</label>' +
              '</div>';
            branchDropdownMenu.insertBefore(li, branchDropdownEmpty);
          });

          branchDropdownMenu
            .querySelectorAll('input[type="checkbox"][data-branch]')
            .forEach(function (cb) {
              cb.addEventListener('change', function () {
                var name = this.getAttribute('data-branch');
                if (this.checked) {
                  if (!isAssigned(name)) assignedBranches.push(name);
                } else {
                  assignedBranches = assignedBranches.filter(function (b) {
                    return b !== name;
                  });
                }
                updateBranchDisplay();
                branchSelectBtn
                  .closest('.form-field')
                  .classList.toggle('is-invalid', assignedBranches.length === 0);
              });
            });
        }

        function updateBranchDisplay() {
          if (assignedBranches.length === 0) {
            branchSelectValue.textContent = 'اختر الفروع';
            branchSelectBtn.classList.remove('has-value');
          } else {
            branchSelectValue.textContent = assignedBranches.join(', ');
            branchSelectBtn.classList.add('has-value');
          }
        }

        renderBranchDropdownItems();
        updateBranchDisplay();

        // بحث مباشر داخل منيو الفروع
        branchSearchInput.addEventListener('click', function (e) {
          e.stopPropagation();
        });
        branchSearchInput.addEventListener('input', function () {
          var q = this.value.trim().toLowerCase();
          var visibleCount = 0;
          branchDropdownMenu.querySelectorAll('.branch-dropdown-item').forEach(function (item) {
            var match = item.textContent.trim().toLowerCase().includes(q);
            item.style.display = match ? '' : 'none';
            if (match) visibleCount++;
          });
          branchDropdownEmpty.classList.toggle('d-none', visibleCount !== 0);
        });

        // إعادة ضبط خانة البحث عند إغلاق المنيو
        branchSelectBtn.addEventListener('hidden.bs.dropdown', function () {
          branchSearchInput.value = '';
          branchDropdownMenu.querySelectorAll('.branch-dropdown-item').forEach(function (item) {
            item.style.display = '';
          });
          branchDropdownEmpty.classList.add('d-none');
        });

        /* ============================================================
       Single-select dropdown logic (country code)
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
        var generatePasswordBtn = document.getElementById('generatePasswordBtn');
        if (generatePasswordBtn) {
          generatePasswordBtn.addEventListener('click', function () {
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
        }

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
       (password fields are optional on the edit page — only
       validated if the admin starts changing them)
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

          var branchChosen = assignedBranches.length > 0;
          markField(document.getElementById('branchSelectBtn'), branchChosen);

          markField(document.getElementById('countryCodeBtn'), true);

          var emailVal = document.getElementById('driverEmail').value.trim();
          var emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal);
          markField(document.getElementById('driverEmail'), emailOk);

          var pass1 = document.getElementById('driverPassword').value;
          var pass2 = document.getElementById('driverPasswordConfirm').value;
          if (pass1 || pass2) {
            markField(document.getElementById('driverPassword'), pass1.length >= 6);
            markField(
              document.getElementById('driverPasswordConfirm'),
              pass2.length >= 6 && pass2 === pass1,
            );
          } else {
            document
              .getElementById('driverPassword')
              .closest('.form-field')
              .classList.remove('is-invalid');
            document
              .getElementById('driverPasswordConfirm')
              .closest('.form-field')
              .classList.remove('is-invalid');
          }

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

