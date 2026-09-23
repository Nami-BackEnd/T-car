@extends('company.layouts.master')

@section('title', 'T-Car — إضافة مدير شركة')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.add-company-manager.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.233') }}</span>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('company.managers-employees') }}"> {{ __('company.common.516') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.pages.add-company-manager.0') }}</span>
              </nav>
            </div>
          </div>

          
          <form id="addManagerForm">
            <div class="edit-office-card mb-4">
              <div class="edit-office-card__header">
                <h5 class="edit-office-card__title">
                  <i class="bi bi-person-plus"></i> {{ __('company.pages.add-company-manager.1') }}</h5>
              </div>

              <div class="edit-office-card__body">
                <div class="form-grid">
                  
                  <div class="form-field">
                    <label class="form-field__label"
                      >{{ __('company.common.149') }}<span class="text-danger">*</span></label
                    >
                    <input type="text" class="form-field__input"  placeholder="{{ __('company.common.55') }}" />
                  </div>

                  
                  <div class="form-field">
                    <label class="form-field__label"
                      >{{ __('company.common.574') }}<span class="text-danger">*</span></label
                    >
                    <div class="dropdown">
                      <button
                        type="button"
                        class="filter-dropdown-btn dropdown-toggle w-100"
                        data-user-role-dropdown
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        {{ __('company.common.122') }}<i class="bi bi-chevron-down"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <a class="dropdown-item" href="#" data-value="company_manager"
                            >{{ __('company.common.514') }}</a
                          >
                        </li>
                        <li>
                          <a class="dropdown-item" href="#" data-value="branch_manager">{{ __('company.common.515') }}</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="#" data-value="branch_employee"
                            >{{ __('company.common.559') }}</a
                          >
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div
                    class="form-field user-branches-field"
                    id="userBranchesField"
                    hidden
                    aria-hidden="true"
                  >
                    <label class="form-field__label" for="userBranchesSelect">
                      {{ __('company.common.220') }}<span class="text-danger">*</span>
                    </label>
                    <div class="dropdown user-branches-dropdown" data-branches-dropdown>
                      <button
                        type="button"
                        class="filter-dropdown-btn dropdown-toggle w-100"
                        id="userBranchesToggle"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="outside"
                        aria-expanded="false"
                        disabled
                      >
                        {{ __('company.common.111') }}<i class="bi bi-chevron-down"></i>
                      </button>
                      <div class="dropdown-menu user-branches-menu w-100">
                        <label class="user-branch-option">
                          <input type="checkbox" value="branch1" />
                          <span>{{ __('company.common.49') }}</span>
                        </label>
                        <label class="user-branch-option">
                          <input type="checkbox" value="branch2" />
                          <span>N2-Al-Olaya</span>
                        </label>
                        <label class="user-branch-option">
                          <input type="checkbox" value="branch3" />
                          <span>N2 Rental Car - Riyadh - Almarwa</span>
                        </label>
                        <label class="user-branch-option">
                          <input type="checkbox" value="branch4" />
                          <span>N2 Rental Car - Rawdah</span>
                        </label>
                        <label class="user-branch-option">
                          <input type="checkbox" value="branch5" />
                          <span>{{ __('company.common.464') }}</span>
                        </label>
                      </div>
                    </div>
                    <select
                      id="userBranchesSelect"
                      name="branches"
                      multiple
                      hidden
                      disabled
                    ></select>
                    <small class="form-field__hint">{{ __('company.common.592') }}</small>
                  </div>

                  
                  <div class="form-field">
                    <label class="form-field__label"
                      >{{ __('company.common.155') }}<span class="text-danger">*</span></label
                    >
                    <input
                      type="email"
                      class="form-field__input ltr-num"
                      placeholder="example@email.com"
                    />
                  </div>

                  
                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.481') }}</label>
                    <div class="password-field">
                      <input
                        type="password"
                        class="form-field__input"
                        id="managerPassword"
                         placeholder="{{ __('company.common.62') }}"
                      />
                      <button
                        type="button"
                        class="password-field__toggle"
                        data-password-toggle="managerPassword"
                         aria-label="{{ __('company.common.89') }}"
                      >
                        <i class="bi bi-eye"></i>
                      </button>
                    </div>
                  </div>

                  
                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.279') }}</label>
                    <div class="password-confirm-group">
                      <div class="password-field">
                        <input
                          type="password"
                          class="form-field__input"
                          id="managerConfirmPassword"
                           placeholder="{{ __('company.common.66') }}"
                        />
                        <button
                          type="button"
                          class="password-field__toggle"
                          data-password-toggle="managerConfirmPassword"
                           aria-label="{{ __('company.common.89') }}"
                        >
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                
                <div class="edit-office-card__section">
                  <h6 class="edit-office-card__section-title">{{ __('company.common.539') }}</h6>
                </div>

                <div class="form-grid">
                  
                  <div class="form-field">
                    <label class="form-field__label"
                      >{{ __('company.common.397') }}<span class="text-danger">*</span></label
                    >
                    <div class="phone-input-group">
                      <div class="phone-input-group__code">
                        <div class="dropdown">
                          <button
                            type="button"
                            class="filter-dropdown-btn dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            +966 <i class="bi bi-chevron-down"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li>
                              <a class="dropdown-item" href="#" data-code="966">+966</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#" data-code="971">+971</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#" data-code="20">+20</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#" data-code="965">+965</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#" data-code="974">+974</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <input
                        type="text"
                        class="form-field__input ltr-num"
                        placeholder="5xxxxxxxx"
                      />
                    </div>
                  </div>

                  
                  <div class="form-field">
                    <label class="form-field__label">{{ __('company.common.403') }}</label>
                    <div class="phone-input-group">
                      <div class="phone-input-group__code">
                        <div class="dropdown">
                          <button
                            type="button"
                            class="filter-dropdown-btn dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            {{ __('company.common.105') }}<i class="bi bi-chevron-down"></i>
                          </button>
                          <ul class="dropdown-menu">
                            <li>
                              <a class="dropdown-item" href="#" data-code="">{{ __('company.common.105') }}</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#" data-code="966">+966</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#" data-code="971">+971</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#" data-code="20">+20</a>
                            </li>
                            <li>
                              <a class="dropdown-item" href="#" data-code="965">+965</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <input
                        type="text"
                        class="form-field__input ltr-num"
                        placeholder="5xxxxxxxx"
                      />
                    </div>
                  </div>
                </div>

                
                <div class="edit-office-card__section">
                  <h6 class="edit-office-card__section-title">{{ __('company.common.317') }}</h6>
                </div>

                <div class="checkbox-grid">
                  <label class="checkbox-option">
                    <input type="checkbox" checked />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.126') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" checked />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.128') }}</span>
                  </label>
                  <label class="checkbox-option">
                    <input type="checkbox" />
                    <span class="checkbox-custom"></span>
                    <span class="checkbox-label">{{ __('company.common.127') }}</span>
                  </label>
                </div>
              </div>
            </div>
            <div class="eo-savebar">
              <button type="button" class="btn btn-outline">
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
        var branchesField = document.getElementById('userBranchesField');
        var branchesSelect = document.getElementById('userBranchesSelect');
        var userForm = document.getElementById('addManagerForm');

        function arrangeUserFields() {
          if (!userForm) return;
          var fields = {
            name: userForm.querySelector('input[type="text"]'),
            email: userForm.querySelector('input[type="email"]'),
            role: userForm.querySelector('[data-user-role-dropdown]'),
            password: document.getElementById('managerPassword'),
            'confirm-password': document.getElementById('managerConfirmPassword'),
          };
          Object.keys(fields).forEach(function (key) {
            var input = fields[key];
            var field = input && input.closest('.form-field');
            if (field) field.classList.add('user-' + key + '-field');
          });
        }

        arrangeUserFields();

        function syncBranchesField(role) {
          var isBranchUser = role === 'branch_manager' || role === 'branch_employee';
          if (!branchesField || !branchesSelect) return;
          var branchesToggle = document.getElementById('userBranchesToggle');
          branchesField.hidden = !isBranchUser;
          branchesField.setAttribute('aria-hidden', String(!isBranchUser));
          branchesSelect.disabled = !isBranchUser;
          branchesSelect.required = isBranchUser;
          if (branchesToggle) branchesToggle.disabled = !isBranchUser;
          if (!isBranchUser) branchesSelect.selectedIndex = -1;
        }

        function syncBranchesSelection() {
          var toggle = document.getElementById('userBranchesToggle');
          var options = document.querySelectorAll(
            '[data-branches-dropdown] input[type="checkbox"]',
          );
          if (!toggle || !branchesSelect) return;
          var selected = Array.from(options)
            .filter(function (option) {
              return option.checked;
            })
            .map(function (option) {
              return { value: option.value, label: option.nextElementSibling.textContent.trim() };
            });
          branchesSelect.innerHTML = '';
          selected.forEach(function (branch) {
            var option = new Option(branch.label, branch.value, true, true);
            branchesSelect.add(option);
          });
          toggle.innerHTML =
            (selected.length ? selected.length + ' فروع مختارة' : 'اختر الفروع') +
            ' <i class="bi bi-chevron-down"></i>';
        }

        document
          .querySelectorAll('[data-branches-dropdown] input[type="checkbox"]')
          .forEach(function (checkbox) {
            checkbox.addEventListener('change', syncBranchesSelection);
          });
        syncBranchesSelection();

        /* Dropdown value synchronization for form dropdowns */
        document.querySelectorAll('.dropdown .dropdown-item').forEach(function (item) {
          item.addEventListener('click', function (e) {
            e.preventDefault();
            var dropdown = this.closest('.dropdown');
            var button = dropdown.querySelector('.dropdown-toggle');
            var text = this.textContent.trim();
            var value = this.getAttribute('data-value') || this.getAttribute('data-code');

            // Update button text
            button.innerHTML = text + ' <i class="bi bi-chevron-down"></i>';

            // Store value in a hidden input if needed
            var hiddenInput = dropdown.querySelector('input[type="hidden"]');
            if (!hiddenInput && value) {
              hiddenInput = document.createElement('input');
              hiddenInput.type = 'hidden';
              hiddenInput.name =
                dropdown.querySelector('.dropdown-toggle').getAttribute('data-name') ||
                'dropdown_value';
              hiddenInput.value = value;
              dropdown.appendChild(hiddenInput);
            } else if (hiddenInput && value) {
              hiddenInput.value = value;
            }

            if (dropdown.querySelector('[data-user-role-dropdown]')) {
              syncBranchesField(value);
              bootstrap.Dropdown.getOrCreateInstance(button).hide();
            }
          });
        });

        /* Password show/hide toggle */
        document.querySelectorAll('[data-password-toggle]').forEach(function (btn) {
          var input = document.getElementById(btn.getAttribute('data-password-toggle'));
          var icon = btn.querySelector('i');
          btn.addEventListener('click', function () {
            var isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            icon.classList.toggle('bi-eye', !isHidden);
            icon.classList.toggle('bi-eye-slash', isHidden);
            btn.setAttribute('aria-label', isHidden ? 'إخفاء كلمة المرور' : 'إظهار كلمة المرور');
          });
        });

        /* Prevent native submit on this static preview */
        var form = document.getElementById('addManagerForm');
        if (form) {
          form.addEventListener('submit', function (e) {
            e.preventDefault();
          });
        }
      });
    </script>
@endpush

