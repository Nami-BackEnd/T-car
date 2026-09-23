@extends('company.layouts.master')

@section('title', 'T-Car — تعديل الملف الشخصي')

@section('main_class', 'profile-page')

@section('content')
<div class="profile-edit-shell">
            <div class="edit-office-card profile-edit-card settings-card">
              <div class="edit-office-card__header profile-edit-card__header">
                <div>
                  <h5 class="edit-office-card__title">
                    <i class="bi bi-person-gear"></i>
                    {{ __('company.pages.edit-profile.0') }}</h5>
                  <p class="edit-office-card__desc">{{ __('company.pages.edit-profile.1') }}</p>
                </div>
              </div>

              <div class="edit-office-card__body">
                <form id="editProfileForm" class="profile-edit-form">
                  <div class="profile-edit-grid">
                    <div class="form-grid">
                      <div class="form-field">
                        <label class="form-field__label">{{ __('company.common.149') }}<span class="req">*</span></label>
                        <input
                          type="text"
                          class="form-field__input form-field__input--bold"
                          value="إيهاب"
                        />
                      </div>

                      <div class="form-field">
                        <label class="form-field__label">{{ __('company.pages.edit-profile.2') }}<span class="req">*</span></label>
                        <div class="dropdown">
                          <button
                            type="button"
                            class="form-field__input dropdown-toggle"
                            id="roleSelectBtn"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <span id="roleSelectValue">{{ __('company.common.513') }}</span>
                            <i class="bi bi-chevron-down"></i>
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="roleSelectBtn">
                            <li>
                              <div class="dropdown-search">
                                <i class="bi bi-search"></i>
                                <input type="search"  placeholder="{{ __('company.common.264') }}" />
                              </div>
                            </li>
                            <li>
                              <a class="dropdown-item active" href="#" data-role="مدير الشركة"
                                >{{ __('company.common.513') }}</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#" data-role="مدير فرع">{{ __('company.common.515') }}</a>
                            </li>
                            <li><a class="dropdown-item" href="#" data-role="مشرف">{{ __('company.pages.edit-profile.3') }}</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="profile-contact-row">
                      <label class="profile-contact-toggle">
                        <input type="checkbox" checked />
                        <span>{{ __('company.pages.edit-profile.4') }}</span>
                      </label>

                      <div class="profile-contact-fields">
                        <div class="form-field profile-prefix-field">
                          <label class="form-field__label"
                            >{{ __('company.common.543') }}<span class="req">*</span></label
                          >
                          <div class="dropdown">
                            <button
                              type="button"
                              class="form-field__input dropdown-toggle ltr-num"
                              id="phoneCodeBtn1"
                              data-bs-toggle="dropdown"
                              aria-expanded="false"
                            >
                              <i class="bi bi-chevron-down"></i>
                              <span id="phoneCodeValue1">+966</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="phoneCodeBtn1">
                              <li>
                                <div class="dropdown-search">
                                  <i class="bi bi-search"></i>
                                  <input type="search"  placeholder="{{ __('company.common.264') }}" />
                                </div>
                              </li>
                              <li>
                                <a class="dropdown-item active" href="#" data-code="+966"
                                  >{{ __('company.common.5') }}</a
                                >
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+971"
                                  >{{ __('company.common.7') }}</a
                                >
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+965">{{ __('company.common.4') }}</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+974">{{ __('company.common.9') }}</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+973"
                                  >{{ __('company.common.8') }}</a
                                >
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+968">{{ __('company.common.6') }}</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+20">{{ __('company.common.1') }}</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+962">{{ __('company.common.3') }}</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+961">{{ __('company.common.2') }}</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="form-field">
                          <label class="form-field__label"
                            >{{ __('company.common.401') }}<span class="req">*</span></label
                          >
                          <input type="tel" class="form-field__input ltr-num" value="570396556" />
                        </div>
                      </div>
                    </div>

                    <div class="profile-contact-row">
                      <label class="profile-contact-toggle">
                        <input type="checkbox" checked />
                        <span>{{ __('company.pages.edit-profile.5') }}</span>
                      </label>

                      <div class="profile-contact-fields">
                        <div class="form-field profile-prefix-field">
                          <label class="form-field__label"
                            >{{ __('company.common.543') }}<span class="req">*</span></label
                          >
                          <div class="dropdown">
                            <button
                              type="button"
                              class="form-field__input dropdown-toggle ltr-num"
                              id="phoneCodeBtn2"
                              data-bs-toggle="dropdown"
                              aria-expanded="false"
                            >
                              <i class="bi bi-chevron-down"></i>
                              <span id="phoneCodeValue2">+966</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="phoneCodeBtn2">
                              <li>
                                <div class="dropdown-search">
                                  <i class="bi bi-search"></i>
                                  <input type="search"  placeholder="{{ __('company.common.264') }}" />
                                </div>
                              </li>
                              <li>
                                <a class="dropdown-item active" href="#" data-code="+966"
                                  >{{ __('company.common.5') }}</a
                                >
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+971"
                                  >{{ __('company.common.7') }}</a
                                >
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+965">{{ __('company.common.4') }}</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+974">{{ __('company.common.9') }}</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+973"
                                  >{{ __('company.common.8') }}</a
                                >
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+968">{{ __('company.common.6') }}</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+20">{{ __('company.common.1') }}</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+962">{{ __('company.common.3') }}</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-code="+961">{{ __('company.common.2') }}</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="form-field">
                          <label class="form-field__label"
                            >{{ __('company.pages.edit-profile.6') }}<span class="req">*</span></label
                          >
                          <input type="tel" class="form-field__input ltr-num" value="553807746" />
                        </div>
                      </div>
                    </div>

                    <div class="profile-contact-row">
                      <label class="profile-contact-toggle">
                        <input type="checkbox" checked />
                        <span>{{ __('company.pages.edit-profile.7') }}</span>
                      </label>

                      <div class="profile-contact-fields profile-contact-fields--single">
                        <div class="form-field">
                          <label class="form-field__label"
                            >{{ __('company.common.154') }}<span class="req">*</span></label
                          >
                          <input
                            type="email"
                            class="form-field__input ltr-num"
                            value="alhattar1995@gmail.com"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="form-section-title profile-edit-section-title">
                      {{ __('company.pages.edit-profile.8') }}</div>

                    <div class="profile-password-grid">
                      <div
                        class="form-field profile-edit-field profile-edit-field--full mask-field"
                      >
                        <label class="form-field__label">{{ __('company.pages.edit-profile.9') }}</label>
                        <input
                          type="password"
                          id="currentPassword"
                          class="form-field__input"
                          placeholder="••••••••"
                          autocomplete="current-password"
                        />
                        <button
                          type="button"
                          class="mask-toggle"
                          data-mask-toggle
                           title="{{ __('company.common.90') }}"
                        >
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                      <div
                        class="form-field profile-edit-field profile-edit-field--full mask-field"
                      >
                        <label class="form-field__label">{{ __('company.pages.edit-profile.10') }}</label>
                        <input
                          type="password"
                          id="newPassword"
                          class="form-field__input"
                          placeholder="••••••••"
                          minlength="8"
                          autocomplete="new-password"
                        />
                        <button
                          type="button"
                          class="mask-toggle"
                          data-mask-toggle
                           title="{{ __('company.common.90') }}"
                        >
                          <i class="bi bi-eye"></i>
                        </button>
                        
                      </div>
                      <div
                        class="form-field profile-edit-field profile-edit-field--full mask-field"
                      >
                        <label class="form-field__label">{{ __('company.common.279') }}</label>
                        <input
                          type="password"
                          id="confirmPassword"
                          class="form-field__input"
                          placeholder="••••••••"
                          autocomplete="new-password"
                        />
                        <button
                          type="button"
                          class="mask-toggle"
                          data-mask-toggle
                           title="{{ __('company.common.90') }}"
                        >
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                    </div>

                    <a href="#" class="profile-passkey-link">{{ __('company.pages.edit-profile.11') }}</a>

                    <div class="form-actions profile-edit-actions">
                      <a href="{{ route('company.edit-profile') }}" class="btn btn-outline btn-lg">
                        <i class="bi bi-x-circle"></i>
                        {{ __('company.common.95') }}</a>
                      <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-check2-circle"></i>
                        {{ __('company.common.376') }}</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
@endsection

@push('modals')
</main>

        
      

    
@endpush

@push('libs')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.45.2/dist/apexcharts.min.js"></script>
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        /* ---- Generic single-select dropdown (اختيار واحد: الدور / مفتاح المنطقة) ---- */
        function initSingleSelectDropdown(btnId, valueId, dataAttr) {
          var btn = document.getElementById(btnId);
          if (!btn) return;
          var valueEl = document.getElementById(valueId);
          var menu = btn.nextElementSibling;
          menu.querySelectorAll('.dropdown-item').forEach(function (item) {
            item.addEventListener('click', function (e) {
              e.preventDefault();
              menu.querySelectorAll('.dropdown-item').forEach(function (i) {
                i.classList.remove('active');
              });
              this.classList.add('active');
              valueEl.textContent = this.getAttribute(dataAttr) || this.textContent.trim();
              btn.dispatchEvent(new Event('change', { bubbles: true }));
            });
          });
        }

        initSingleSelectDropdown('roleSelectBtn', 'roleSelectValue', 'data-role');
        initSingleSelectDropdown('phoneCodeBtn1', 'phoneCodeValue1', 'data-code');
        initSingleSelectDropdown('phoneCodeBtn2', 'phoneCodeValue2', 'data-code');

        /* ---- Dropdown search functionality ---- */
        document.querySelectorAll('.dropdown-search input').forEach(function (searchInput) {
          searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const dropdownMenu = this.closest('.dropdown-menu');
            const items = dropdownMenu.querySelectorAll('.dropdown-item');

            items.forEach(function (item) {
              const text = item.textContent.toLowerCase();
              item.style.display = text.includes(searchTerm) ? '' : 'none';
            });
          });
        });

        /* ---- Masked password fields: show/hide ---- */
        document.querySelectorAll('[data-mask-toggle]').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var input = this.previousElementSibling;
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

        /* ---- Change-password logic ----
         - New password requires current password to be filled first.
         - New password must respect the 8-char minimum.
         - Confirm password must match new password.
         All feedback uses the browser's native validation UI (no new styles). */
        var currentPasswordInput = document.getElementById('currentPassword');
        var newPasswordInput = document.getElementById('newPassword');
        var confirmPasswordInput = document.getElementById('confirmPassword');
        var editProfileForm = document.getElementById('editProfileForm');

        function validatePasswordFields() {
          if (newPasswordInput.value && !currentPasswordInput.value) {
            currentPasswordInput.setCustomValidity('يرجى إدخال كلمة المرور الحالية أولاً لتغييرها');
          } else {
            currentPasswordInput.setCustomValidity('');
          }

          if (confirmPasswordInput.value !== newPasswordInput.value) {
            confirmPasswordInput.setCustomValidity('كلمتا المرور غير متطابقتين');
          } else {
            confirmPasswordInput.setCustomValidity('');
          }
        }

        [currentPasswordInput, newPasswordInput, confirmPasswordInput].forEach(function (input) {
          input.addEventListener('input', validatePasswordFields);
        });

        editProfileForm.addEventListener('submit', function (e) {
          validatePasswordFields();
          if (!this.checkValidity()) {
            e.preventDefault();
            this.reportValidity();
          }
        });
      });
    </script>
@endpush

