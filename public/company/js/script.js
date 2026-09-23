(function () {
  'use strict';

  var appShell = document.getElementById('appShell');
  var sidebar = document.getElementById('sidebar');
  var toggleBtn = document.getElementById('sidebarToggleBtn');
  var desktopCollapseBtn = document.getElementById('desktopCollapseBtn');
  var backdrop = document.getElementById('sidebarBackdrop');
  var langSwitch = document.getElementById('langSwitch');

  // Mirrors the `lg` breakpoint used by @include bp-down(lg) in
  // _mixins.scss (max-width: 991.98px). Using matchMedia instead of a raw
  // window.innerWidth check means this stays correct even if the viewport
  // changes without a 'resize' event firing (zoom, devtools docking,
  // orientation change) and keeps JS/CSS breakpoints from ever drifting.
  var mobileQuery = window.matchMedia('(max-width: 991.98px)');

  function isMobile() {
    return mobileQuery.matches;
  }

  // ---------------------------------------------------------
  // Sidebar: desktop collapse vs mobile offcanvas
  // ---------------------------------------------------------
  function openMobileSidebar() {
    sidebar.classList.add('is-mobile-open');
    backdrop.classList.add('is-visible');
    toggleBtn.setAttribute('aria-expanded', 'true');
    // Lock the page behind the offcanvas sidebar so it can't be scrolled
    // while the overlay is open.
    document.body.classList.add('is-scroll-locked');
  }

  function closeMobileSidebar() {
    sidebar.classList.remove('is-mobile-open');
    backdrop.classList.remove('is-visible');
    toggleBtn.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('is-scroll-locked');
  }

  function toggleDesktopCollapse() {
    var collapsed = appShell.classList.toggle('is-collapsed');
    localStorage_set('sidebarCollapsed', collapsed);
  }

  // Safe localStorage wrapper (falls back silently if unavailable)
  function localStorage_set(key, value) {
    try {
      window.localStorage.setItem(key, value);
    } catch (e) {
      /* ignore */
    }
  }
  function localStorage_get(key) {
    try {
      return window.localStorage.getItem(key);
    } catch (e) {
      return null;
    }
  }

  // Restore collapsed preference on desktop
  if (!isMobile() && localStorage_get('sidebarCollapsed') === 'true') {
    appShell.classList.add('is-collapsed');
  }

  // ---------------------------------------------------------
  // Action menu logic
  // ---------------------------------------------------------
  document.addEventListener('DOMContentLoaded', function () {
    var floatingMenuClass = 'table-action-menu-floating';

    function moveMenuToBody(menu, trigger) {
      if (menu._actionMenuPlaceholder) return;

      var placeholder = document.createComment('table action menu');
      var computedStyle = window.getComputedStyle(menu);

      menu.parentNode.insertBefore(placeholder, menu);
      menu._actionMenuPlaceholder = placeholder;
      menu._actionMenuTrigger = trigger;
      menu.style.setProperty('--table-action-menu-min-width', computedStyle.minWidth);
      menu.classList.add(floatingMenuClass);
      document.body.appendChild(menu);
    }

    function restoreMenu(menu) {
      var placeholder = menu._actionMenuPlaceholder;

      if (!placeholder) return;
      if (placeholder.parentNode) {
        placeholder.parentNode.insertBefore(menu, placeholder);
        placeholder.parentNode.removeChild(placeholder);
      }

      menu.classList.remove(floatingMenuClass);
      menu.style.removeProperty('--table-action-menu-min-width');
      menu.style.left = '';
      menu.style.top = '';
      menu.style.right = '';
      menu.style.bottom = '';
      menu._actionMenuPlaceholder = null;
      menu._actionMenuTrigger = null;
    }

    function positionActionMenu(dropdown, trigger) {
      var rect = trigger.getBoundingClientRect();
      var menuHeight = dropdown.offsetHeight || 0;
      var menuWidth = dropdown.offsetWidth || 200;
      var gap = 8;
      var spaceBelow = window.innerHeight - rect.bottom;
      var top;
      var left;

      if (spaceBelow < menuHeight + gap) {
        top = Math.max(gap, rect.top - menuHeight - gap);
      } else {
        top = rect.bottom + gap;
      }

      // Align the menu's right edge with the trigger in RTL tables, while
      // keeping the complete menu inside the viewport on narrow screens.
      left = rect.right - menuWidth;
      left = Math.max(gap, Math.min(left, window.innerWidth - menuWidth - gap));

      dropdown.style.left = left + 'px';
      dropdown.style.top = top + 'px';
      dropdown.style.right = 'auto';
      dropdown.style.bottom = 'auto';
    }

    function closeCustomActionMenu(dropdown) {
      dropdown.classList.remove('is-visible');
      restoreMenu(dropdown);
    }

    // Bootstrap dropdown menus are temporarily portalled to <body>. This is
    // what lets them escape every horizontally scrollable table container;
    // Popper continues to choose above/below placement from viewport space.
    document.addEventListener('show.bs.dropdown', function (event) {
      var trigger = event.target.closest('.action-menu-btn[data-bs-toggle="dropdown"]');
      var wrapper;
      var menu;

      if (!trigger || !trigger.closest('table')) return;
      wrapper = trigger.closest('.action-dropdown');
      menu = wrapper ? wrapper.querySelector('.dropdown-menu') : null;
      if (menu) moveMenuToBody(menu, trigger);
    });

    document.addEventListener('hidden.bs.dropdown', function (event) {
      var trigger = event.target.closest('.action-menu-btn[data-bs-toggle="dropdown"]');
      var menus;

      if (!trigger) return;
      menus = document.querySelectorAll('.dropdown-menu.' + floatingMenuClass);
      menus.forEach(function (menu) {
        if (menu._actionMenuTrigger === trigger) restoreMenu(menu);
      });
    });

    // Put the menu back before its item's own click handler runs. Several
    // pages intentionally use item.closest('tr') to read that row's data.
    document.addEventListener(
      'click',
      function (event) {
        var menu = event.target.closest('.' + floatingMenuClass);
        if (menu) restoreMenu(menu);
      },
      true,
    );

    var actionMenuBtns = document.querySelectorAll('.action-menu-btn');

    actionMenuBtns.forEach(function (btn) {
      // Buttons wired to Bootstrap's own dropdown (data-bs-toggle="dropdown",
      // e.g. the "..." action buttons inside the reservations table) are
      // left alone here ï¿½ Bootstrap already handles opening/closing them
      // and auto-closes any other open Bootstrap dropdown when a new one
      // is opened. If we attach our own click handler on top of those and
      // call stopPropagation(), we block the document-level click listener
      // Bootstrap relies on to close sibling dropdowns, which is exactly
      // what caused multiple menus to stay open at once.
      if (btn.hasAttribute('data-bs-toggle')) return;

      btn.addEventListener('click', function (e) {
        e.stopPropagation();

        var wrapper = this.closest('.action-menu-wrapper');
        var dropdown = wrapper ? wrapper.querySelector('.action-menu-dropdown') : null;

        if (dropdown) {
          var wasVisible = dropdown.classList.contains('is-visible');

          // Close all other dropdowns
          document.querySelectorAll('.action-menu-dropdown').forEach(function (d) {
            if (d !== dropdown) {
              closeCustomActionMenu(d);
            }
          });

          if (wasVisible) {
            closeCustomActionMenu(dropdown);
          } else {
            moveMenuToBody(dropdown, this);
            dropdown.classList.add('is-visible');
            positionActionMenu(dropdown, this);
          }
        }
      });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function () {
      document.querySelectorAll('.action-menu-dropdown').forEach(function (dropdown) {
        closeCustomActionMenu(dropdown);
      });
    });

    // Close fixed dropdowns when scrolling so they don't float detached
    document.addEventListener(
      'scroll',
      function () {
        document.querySelectorAll('.action-menu-dropdown.is-visible').forEach(function (dropdown) {
          closeCustomActionMenu(dropdown);
        });
      },
      true,
    );

    window.addEventListener('resize', function () {
      document.querySelectorAll('.action-menu-dropdown.is-visible').forEach(function (dropdown) {
        closeCustomActionMenu(dropdown);
      });
    });
  });

  // Branch assignment modal trigger
  var branchAssignBtns = document.querySelectorAll('.branch-assign-btn');
  var branchModal = document.getElementById('branchModal');

  if (branchAssignBtns.length > 0 && branchModal) {
    var branchModalInstance = new bootstrap.Modal(branchModal);

    branchAssignBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        // Close the dropdown
        var dropdown = this.closest('.action-menu-dropdown');
        if (dropdown) {
          dropdown.classList.remove('is-visible');
        }

        // Open the modal
        branchModalInstance.show();
      });
    });
  }

  // ---------------------------------------------------------
  // Dropdown selection logic
  // ---------------------------------------------------------

  toggleBtn.addEventListener('click', function () {
    if (isMobile()) {
      if (sidebar.classList.contains('is-mobile-open')) {
        closeMobileSidebar();
      } else {
        openMobileSidebar();
      }
    } else {
      toggleDesktopCollapse();
    }
  });

  desktopCollapseBtn.addEventListener('click', toggleDesktopCollapse);

  backdrop.addEventListener('click', closeMobileSidebar);

  // Close mobile sidebar with Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && sidebar.classList.contains('is-mobile-open')) {
      closeMobileSidebar();
    }
  });

  // Reset mobile offcanvas state the instant the viewport crosses back
  // over the desktop breakpoint (handles orientation change / devtools
  // resize / zoom, not just a plain window resize).
  mobileQuery.addEventListener('change', function (e) {
    if (!e.matches) {
      closeMobileSidebar();
    }
  });

  // ---------------------------------------------------------
  // Submenu accordion (single-open behavior)
  // ---------------------------------------------------------
  var submenuToggles = document.querySelectorAll('[data-submenu-toggle]');

  submenuToggles.forEach(function (link) {
    link.addEventListener('click', function (e) {
      e.preventDefault();

      // If sidebar is collapsed on desktop, flyout handles hover ï¿½ don't accordion-toggle
      if (appShell.classList.contains('is-collapsed') && !isMobile()) {
        return;
      }

      var item = link.closest('.nav-menu__item');
      var isOpen = item.classList.contains('is-open');

      // Close sibling open items within the same list for accordion behavior
      var siblingList = item.parentElement;
      siblingList.querySelectorAll(':scope > .nav-menu__item.is-open').forEach(function (sibling) {
        if (sibling !== item) {
          sibling.classList.remove('is-open');
          var siblingLink = sibling.querySelector('[data-submenu-toggle]');
          if (siblingLink) siblingLink.setAttribute('aria-expanded', 'false');
        }
      });

      item.classList.toggle('is-open', !isOpen);
      link.setAttribute('aria-expanded', String(!isOpen));
    });
  });

  // ---------------------------------------------------------
  // Language switch (EN / AR) ï¿½ toggles document direction
  // ---------------------------------------------------------
  if (langSwitch) {
    var langButtons = langSwitch.querySelectorAll('button');
    var langPill = document.getElementById('langPill');

    function positionLangPill(activeBtn) {
      // Measure the real button box instead of assuming a 50/50 split ï¿½
      // English and Arabic labels are different widths, and this also
      // keeps the pill correct since .lang-switch is forced to `direction:
      // ltr` regardless of the page's current direction.
      var containerRect = langSwitch.getBoundingClientRect();
      var btnRect = activeBtn.getBoundingClientRect();
      langPill.style.width = btnRect.width + 'px';
      langPill.style.transform = 'translateX(' + (btnRect.left - containerRect.left) + 'px)';
    }

    function getActiveLangBtn() {
      return langSwitch.querySelector('button.is-active') || langButtons[0];
    }

    langButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var lang = btn.getAttribute('data-lang');

        langButtons.forEach(function (b) {
          b.classList.toggle('is-active', b === btn);
        });

        positionLangPill(btn);

        if (lang === 'ar') {
          document.documentElement.setAttribute('dir', 'rtl');
          document.documentElement.setAttribute('lang', 'ar');
        } else {
          document.documentElement.setAttribute('dir', 'ltr');
          document.documentElement.setAttribute('lang', 'en');
        }
      });
    });

    // Re-measure on resize: the short "EN"/"AR" labels kick in below the sm
    // breakpoint, which changes the active button's width/position.
    window.addEventListener('resize', function () {
      positionLangPill(getActiveLangBtn());
    });

    // Initial placement (buttons are already in the DOM at this point
    // since this script runs at the end of body).
    positionLangPill(getActiveLangBtn());
  }

  // ---------------------------------------------------------
  // Ripple-like button hover: track pointer position for the
  // radial-gradient defined in CSS (--x / --y custom props)
  // ---------------------------------------------------------
  document.querySelectorAll('.btn').forEach(function (btn) {
    btn.addEventListener('pointermove', function (e) {
      var rect = btn.getBoundingClientRect();
      btn.style.setProperty('--x', e.clientX - rect.left + 'px');
      btn.style.setProperty('--y', e.clientY - rect.top + 'px');
    });
  });

  // ---------------------------------------------------------
  // Custom dropdown — "تصفح كتالوج السيارات" (car catalog select)
  //
  // Wires the trigger button + option list markup (`[data-car-dropdown]`,
  // `.custom-dropdown__trigger`, `.custom-dropdown__option`) since it
  // isn't a native <select> and needs its own open/close + selection
  // logic. Also keeps the hidden native <select data-car-select> in sync
  // so the value still submits normally with the form.
  // ---------------------------------------------------------
  function initCustomDropdowns() {
    // Every currently-open dropdown's close function, so the document-level
    // outside-click listener can close whichever ones are open regardless
    // of how many [data-car-dropdown] instances exist on the page.
    var openDropdowns = [];

    document.querySelectorAll('[data-car-dropdown]').forEach(function (wrapper) {
      var trigger = wrapper.querySelector('.custom-dropdown__trigger');
      var menu = wrapper.querySelector('.custom-dropdown__menu');
      var textEl = wrapper.querySelector('.custom-dropdown__text');
      var select = wrapper.querySelector('[data-car-select]');
      var options = wrapper.querySelectorAll('.custom-dropdown__option');

      if (!trigger || !menu) return;

      function closeDropdown() {
        menu.classList.remove('is-visible');
        trigger.classList.remove('is-open');
        trigger.setAttribute('aria-expanded', 'false');
        var idx = openDropdowns.indexOf(closeDropdown);
        if (idx !== -1) openDropdowns.splice(idx, 1);
      }

      function openDropdown() {
        // Close any other open custom dropdown first
        openDropdowns.slice().forEach(function (close) {
          close();
        });

        menu.classList.add('is-visible');
        trigger.classList.add('is-open');
        trigger.setAttribute('aria-expanded', 'true');
        openDropdowns.push(closeDropdown);
      }

      trigger.addEventListener('click', function (e) {
        e.stopPropagation();
        if (menu.classList.contains('is-visible')) {
          closeDropdown();
        } else {
          openDropdown();
        }
      });

      options.forEach(function (opt) {
        opt.addEventListener('click', function () {
          var value = opt.getAttribute('data-value');
          var labelEl = opt.querySelector('.custom-dropdown__option-text');
          var label = labelEl ? labelEl.textContent.trim() : '';

          options.forEach(function (o) {
            o.removeAttribute('data-selected');
          });
          opt.setAttribute('data-selected', 'true');

          if (textEl) textEl.textContent = label;
          if (select) select.value = value;

          closeDropdown();
        });
      });

      // Prevent clicks inside the menu from bubbling to the document
      // listener below and closing it immediately.
      menu.addEventListener('click', function (e) {
        e.stopPropagation();
      });
    });

    // Close any open custom dropdown when clicking outside of it
    document.addEventListener('click', function () {
      openDropdowns.slice().forEach(function (close) {
        close();
      });
    });
  }

  initCustomDropdowns();

  // ---------------------------------------------------------
  // Offers scope selector ï¿½ shared by discounts and special offers
  // ---------------------------------------------------------
  var scopeSelectorOptions = {
    branches: ['فرع العتيق', 'فرع العليا', 'فرع المروة', 'فرع الروضة', 'فرع العزيزية'],
    carTypes: ['اقتصادي', 'متوسط', 'دفع رباعي', 'فاخر', 'عائلي'],
  };

  function escapeScopeHtml(value) {
    return String(value)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  function scopeCountLabel(type, count) {
    if (type === 'branches') {
      if (count === 1) return 'فرع واحد';
      if (count === 2) return 'فرعين';
      return count + ' فروع';
    }

    if (count === 1) return 'نوع واحد من السيارات';
    if (count === 2) return 'نوعين من السيارات';
    return count + ' أنواع من السيارات';
  }

  function createScopeDimension(config) {
    var optionsMarkup = config.options
      .map(function (option) {
        return (
          '<label class="scope-option" data-scope-option-row>' +
          '<input type="checkbox" value="' +
          escapeScopeHtml(option) +
          '" data-scope-option>' +
          '<span>' +
          escapeScopeHtml(option) +
          '</span></label>'
        );
      })
      .join('');

    return (
      '<fieldset class="scope-dimension" data-scope-dimension="' +
      config.type +
      '">' +
      '<legend class="scope-dimension__legend"><i class="bi ' +
      config.icon +
      '" aria-hidden="true"></i>' +
      config.title +
      '</legend>' +
      '<div class="scope-dimension__radios">' +
      '<label class="scope-radio"><input type="radio" name="' +
      config.name +
      '_mode" value="all" checked><span>' +
      config.allLabel +
      '</span></label>' +
      '<label class="scope-radio"><input type="radio" name="' +
      config.name +
      '_mode" value="selected"><span>' +
      config.selectedLabel +
      '</span></label>' +
      '</div>' +
      '<div class="scope-multiselect" data-scope-options hidden>' +
      '<div class="scope-multiselect__search"><i class="bi bi-search" aria-hidden="true"></i>' +
      '<input type="search" placeholder="' +
      config.searchPlaceholder +
      '" aria-label="' +
      config.searchPlaceholder +
      '" data-scope-search></div>' +
      '<div class="scope-multiselect__options">' +
      '<label class="scope-option scope-option--all"><input type="checkbox" data-scope-select-all>' +
      '<span>تحديد الكل</span></label>' +
      '<div data-scope-option-list>' +
      optionsMarkup +
      '</div>' +
      '<div class="scope-multiselect__empty" data-scope-empty hidden>لا توجد نتائج مطابقة</div>' +
      '</div>' +
      '<div class="scope-chips" data-scope-chips></div>' +
      '</div>' +
      '<input type="hidden" name="' +
      config.name +
      '_values" data-scope-value value="[]">' +
      '<p class="scope-dimension__error" data-scope-error role="alert">' +
      config.errorMessage +
      '</p>' +
      '</fieldset>'
    );
  }

  function initScopeSelector(root) {
    if (!root || root.dataset.scopeReady === 'true') return;

    root.dataset.scopeReady = 'true';
    var scopeName = root.getAttribute('data-scope-name') || 'offer';
    var titleId = scopeName + 'ScopeSelectorTitle';

    root.classList.add('scope-selector');
    root.setAttribute('aria-labelledby', titleId);
    root.innerHTML =
      '<div class="scope-selector__heading">' +
      '<i class="bi bi-bullseye" aria-hidden="true"></i>' +
      '<div><h3 class="scope-selector__title" id="' +
      titleId +
      '">حدود التطبيق</h3>' +
      '<p class="scope-selector__hint">حدد النطاق المكاني وأنواع السيارات معًا</p></div></div>' +
      '<div class="scope-selector__dimensions">' +
      createScopeDimension({
        type: 'branches',
        name: scopeName + '_branches',
        icon: 'bi-buildings',
        title: 'النطاق المكاني',
        allLabel: 'كل الفروع',
        selectedLabel: 'فروع معينة',
        searchPlaceholder: 'ابحث عن فرع',
        errorMessage: 'اختر فرعًا واحدًا على الأقل',
        options: scopeSelectorOptions.branches,
      }) +
      createScopeDimension({
        type: 'carTypes',
        name: scopeName + '_car_types',
        icon: 'bi-car-front',
        title: 'أنواع السيارات',
        allLabel: 'كل الأنواع',
        selectedLabel: 'أنواع معينة',
        searchPlaceholder: 'ابحث عن نوع سيارة',
        errorMessage: 'اختر نوع سيارة واحدًا على الأقل',
        options: scopeSelectorOptions.carTypes,
      }) +
      '</div>' +
      '<p class="scope-selector__summary" data-scope-summary aria-live="polite"></p>';

    var dimensions = root.querySelectorAll('[data-scope-dimension]');
    var summary = root.querySelector('[data-scope-summary]');
    var form = root.closest('form');

    function selectedValues(dimension) {
      return Array.prototype.slice
        .call(dimension.querySelectorAll('[data-scope-option]:checked'))
        .map(function (checkbox) {
          return checkbox.value;
        });
    }

    function currentMode(dimension) {
      var checkedMode = dimension.querySelector('input[type="radio"]:checked');
      return checkedMode ? checkedMode.value : 'all';
    }

    function clearDimensionError(dimension) {
      dimension.classList.remove('is-invalid');
    }

    function renderChips(dimension, values) {
      var chips = dimension.querySelector('[data-scope-chips]');
      if (!chips) return;

      chips.innerHTML = values
        .map(function (value) {
          return (
            '<span class="scope-chip">' +
            escapeScopeHtml(value) +
            '<button type="button" data-scope-remove="' +
            escapeScopeHtml(value) +
            '" aria-label="إزالة ' +
            escapeScopeHtml(value) +
            '"><i class="bi bi-x" aria-hidden="true"></i></button></span>'
          );
        })
        .join('');

      chips.querySelectorAll('[data-scope-remove]').forEach(function (button) {
        button.addEventListener('click', function () {
          var value = button.getAttribute('data-scope-remove');
          var checkbox = Array.prototype.slice
            .call(dimension.querySelectorAll('[data-scope-option]'))
            .find(function (option) {
              return option.value === value;
            });

          if (checkbox) checkbox.checked = false;
          updateDimension(dimension);
        });
      });
    }

    function updateSummary() {
      if (!summary) return;

      var branchesDimension = root.querySelector('[data-scope-dimension="branches"]');
      var carTypesDimension = root.querySelector('[data-scope-dimension="carTypes"]');
      var branchesText =
        currentMode(branchesDimension) === 'all'
          ? 'كل الفروع'
          : scopeCountLabel('branches', selectedValues(branchesDimension).length);
      var carTypesText =
        currentMode(carTypesDimension) === 'all'
          ? 'كل أنواع السيارات'
          : scopeCountLabel('carTypes', selectedValues(carTypesDimension).length);

      summary.innerHTML =
        '<i class="bi bi-info-circle" aria-hidden="true"></i>' +
        '<span>يُطبق على <strong>' +
        branchesText +
        '</strong> و <strong>' +
        carTypesText +
        '</strong></span>';
    }

    function updateDimension(dimension) {
      var mode = currentMode(dimension);
      var optionsPanel = dimension.querySelector('[data-scope-options]');
      var values = selectedValues(dimension);
      var selectAll = dimension.querySelector('[data-scope-select-all]');
      var allOptions = dimension.querySelectorAll('[data-scope-option]');
      var valueInput = dimension.querySelector('[data-scope-value]');

      optionsPanel.hidden = mode !== 'selected';
      selectAll.checked = allOptions.length > 0 && values.length === allOptions.length;
      selectAll.indeterminate = values.length > 0 && values.length < allOptions.length;
      if (valueInput) valueInput.value = JSON.stringify(mode === 'all' ? ['all'] : values);

      renderChips(dimension, mode === 'selected' ? values : []);
      if (mode === 'all' || values.length) clearDimensionError(dimension);
      updateSummary();
    }

    dimensions.forEach(function (dimension) {
      var searchInput = dimension.querySelector('[data-scope-search]');
      var selectAll = dimension.querySelector('[data-scope-select-all]');
      var optionCheckboxes = dimension.querySelectorAll('[data-scope-option]');
      var emptyState = dimension.querySelector('[data-scope-empty]');

      dimension.querySelectorAll('input[type="radio"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
          updateDimension(dimension);
        });
      });

      optionCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
          updateDimension(dimension);
        });
      });

      selectAll.addEventListener('change', function () {
        optionCheckboxes.forEach(function (checkbox) {
          checkbox.checked = selectAll.checked;
        });
        updateDimension(dimension);
      });

      searchInput.addEventListener('input', function () {
        var query = searchInput.value.trim().toLowerCase();
        var visibleCount = 0;

        dimension.querySelectorAll('[data-scope-option-row]').forEach(function (row) {
          var matches = row.textContent.trim().toLowerCase().indexOf(query) !== -1;
          row.hidden = !matches;
          if (matches) visibleCount += 1;
        });

        emptyState.hidden = visibleCount !== 0;
      });

      updateDimension(dimension);
    });

    function validateScope() {
      var isValid = true;

      dimensions.forEach(function (dimension) {
        var requiresSelection = currentMode(dimension) === 'selected';
        var hasSelection = selectedValues(dimension).length > 0;
        dimension.classList.toggle('is-invalid', requiresSelection && !hasSelection);
        if (requiresSelection && !hasSelection) isValid = false;
      });

      return isValid;
    }

    function getScopeValue() {
      var value = {};

      dimensions.forEach(function (dimension) {
        var type = dimension.getAttribute('data-scope-dimension');
        var mode = currentMode(dimension);
        value[type] = mode === 'all' ? ['all'] : selectedValues(dimension);
      });

      return value;
    }

    function setScopeValue(value) {
      dimensions.forEach(function (dimension) {
        var type = dimension.getAttribute('data-scope-dimension');
        var values = value && Array.isArray(value[type]) ? value[type] : ['all'];
        var mode = values[0] === 'all' ? 'all' : 'selected';
        var modeRadio = dimension.querySelector('input[type="radio"][value="' + mode + '"]');

        if (modeRadio) modeRadio.checked = true;
        dimension.querySelectorAll('[data-scope-option]').forEach(function (checkbox) {
          checkbox.checked = mode === 'selected' && values.indexOf(checkbox.value) !== -1;
        });
        clearDimensionError(dimension);
        updateDimension(dimension);
      });
    }

    root.scopeSelectorApi = {
      getValue: getScopeValue,
      setValue: setScopeValue,
      validate: validateScope,
    };

    if (form && form.dataset.scopeValidationReady !== 'true') {
      form.dataset.scopeValidationReady = 'true';
      form.addEventListener('submit', function (event) {
        var isValid = true;
        var successMessage = form.querySelector('[data-scope-submit-message]');

        event.preventDefault();
        if (successMessage) successMessage.classList.remove('is-visible');

        isValid = validateScope();

        if (!isValid) {
          var firstInvalid = form.querySelector('.scope-dimension.is-invalid');
          if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
          return;
        }

        if (successMessage) successMessage.classList.add('is-visible');
      });
    }
  }

  function closeScopeCellPopovers(exceptPopover) {
    document.querySelectorAll('.scope-cell__popover').forEach(function (popover) {
      if (popover === exceptPopover) return;
      popover.hidden = true;
      var trigger =
        popover._scopeTrigger ||
        popover.parentElement.querySelector('[data-scope-popover-trigger]');
      if (trigger) trigger.setAttribute('aria-expanded', 'false');
      popover.style.top = '';
      popover.style.left = '';
    });
  }

  function initScopeCell(cell) {
    if (!cell) return;
    if (cell.dataset.scopeCellReady === 'true') {
      cell.innerHTML = '';
      cell.dataset.scopeCellReady = 'false';
    }

    cell.dataset.scopeCellReady = 'true';
    var provider = cell.getAttribute('data-provider') || 'كل الفروع';

    function parseValues(attributeName) {
      var rawValue = cell.getAttribute(attributeName) || '[]';
      try {
        return JSON.parse(rawValue);
      } catch (error) {
        return [];
      }
    }

    function createScopeLine(config) {
      var values = config.values;
      var isAll = values === 'all' || (Array.isArray(values) && values[0] === 'all');
      var displayValues = Array.isArray(values) ? values : [];
      var primaryLabel = isAll ? config.allLabel : displayValues[0] || config.emptyLabel;
      var extraValues = isAll ? [] : displayValues.slice(1);
      var popoverId = 'scopePopover' + Math.random().toString(36).slice(2, 9) + config.type;
      var moreButton = '';

      if (extraValues.length) {
        moreButton =
          '<button type="button" class="scope-cell__more" data-scope-popover-trigger ' +
          'aria-expanded="false" aria-controls="' +
          popoverId +
          '">+' +
          extraValues.length +
          ' ' +
          config.moreLabel +
          '</button>' +
          '<div class="scope-cell__popover" id="' +
          popoverId +
          '" hidden><ul>' +
          displayValues
            .map(function (value) {
              return '<li>' + escapeScopeHtml(value) + '</li>';
            })
            .join('') +
          '</ul></div>';
      }

      return (
        '<div class="scope-cell__line" data-scope-cell-line="' +
        config.type +
        '"><i class="bi ' +
        config.icon +
        '" aria-hidden="true"></i><span>' +
        escapeScopeHtml(primaryLabel) +
        '</span>' +
        moreButton +
        '</div>'
      );
    }

    var branches = parseValues('data-branches');
    var carTypes = parseValues('data-car-types');
    var cellMode = cell.getAttribute('data-scope-cell-mode') || 'both';
    var scopeLines = [];
    cell.classList.add('scope-cell');
    if (cellMode === 'both' || cellMode === 'branches') {
      scopeLines.push(
        createScopeLine({
          type: 'branches',
          values: branches,
          icon: 'bi-buildings',
          allLabel: provider,
          emptyLabel: 'لا توجد فروع',
          moreLabel: 'فروع',
        }),
      );
    }
    if (cellMode === 'both' || cellMode === 'carTypes') {
      scopeLines.push(
        createScopeLine({
          type: 'carTypes',
          values: carTypes,
          icon: 'bi-car-front',
          allLabel: 'كل أنواع السيارات',
          emptyLabel: 'لا توجد أنواع',
          moreLabel: 'أنواع',
        }),
      );
    }
    cell.innerHTML = scopeLines.join('');

    cell.querySelectorAll('[data-scope-popover-trigger]').forEach(function (trigger) {
      trigger.addEventListener('click', function (event) {
        var popover = trigger.parentElement.querySelector('.scope-cell__popover');
        var willOpen = popover.hidden;

        event.stopPropagation();
        closeScopeCellPopovers(willOpen ? popover : null);
        popover.hidden = !willOpen;
        trigger.setAttribute('aria-expanded', String(willOpen));
        if (willOpen) {
          var triggerRect = trigger.getBoundingClientRect();
          var left = Math.max(
            8,
            Math.min(triggerRect.left, window.innerWidth - popover.offsetWidth - 8),
          );
          var top = Math.min(triggerRect.bottom + 7, window.innerHeight - popover.offsetHeight - 8);
          popover._scopeTrigger = trigger;
          popover.style.left = left + 'px';
          popover.style.top = Math.max(8, top) + 'px';
        }
      });
    });
  }

  document.querySelectorAll('[data-scope-selector]').forEach(function (root) {
    initScopeSelector(root);
  });

  document.querySelectorAll('[data-scope-cell]').forEach(function (cell) {
    initScopeCell(cell);
  });

  document.addEventListener('click', function (event) {
    if (!event.target.closest('.scope-cell__line')) closeScopeCellPopovers();
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') closeScopeCellPopovers();
  });

  // ---------------------------------------------------------
  // Discounts page ï¿½ add/edit form, live preview, table and actions
  // ---------------------------------------------------------
  function initDiscountsPage() {
    var tableBody = document.getElementById('discountsTableBody');
    var form = document.getElementById('discountForm');
    var formModalElement = document.getElementById('discountFormModal');

    if (!tableBody || !form || !formModalElement || typeof bootstrap === 'undefined') return;

    var formModal = bootstrap.Modal.getOrCreateInstance(formModalElement);
    var detailsModal = bootstrap.Modal.getOrCreateInstance(
      document.getElementById('discountDetailsModal'),
    );
    var deleteModal = bootstrap.Modal.getOrCreateInstance(
      document.getElementById('deleteDiscountModal'),
    );
    var scopeRoot = form.querySelector('[data-scope-selector]');
    var nameInput = document.getElementById('discountName');
    var amountInput = document.getElementById('discountAmount');
    var percentageInput = document.getElementById('discountPercentage');
    var handlingInput = document.getElementById('discountHandling');
    var startDateInput = document.getElementById('discountStartDate');
    var endDateInput = document.getElementById('discountEndDate');
    var recordIdInput = document.getElementById('discountRecordId');
    var handlingHint = document.getElementById('discountHandlingHint');
    var searchInput = document.getElementById('discountsSearchInput');
    var statusFilter = document.getElementById('discountStatusFilter');
    var dateFilter = document.getElementById('discountDateFilter');
    var pageSizeSelect = document.getElementById('discountPageSize');
    var pagination = document.getElementById('tablePagination');
    var resultCount = document.getElementById('discountsResultCount');
    var deleteRecordId = null;
    var activeTab = 'all';
    var currentPage = 1;

    var handlingMeta = {
      replace: {
        label: 'استبدال الخصم القائم',
        shortLabel: 'استبدال',
        description: 'يتم تجاهل الخصم القائم وتطبيق هذا الخصم وحده على السعر.',
      },
      highest: {
        label: 'تطبيق الخصم الأعلى',
        shortLabel: 'الأعلى',
        description: 'تتم مقارنة الخصمين ويُطبق الخصم الذي يمنح العميل قيمة أكبر.',
      },
      cumulative: {
        label: 'تراكمي — جمع بسيط',
        shortLabel: 'تراكمي',
        description: 'يُجمع الخصم الجديد مع الخصم القائم جمعًا بسيطًا قبل حساب السعر النهائي.',
      },
    };

    function localDateString(date) {
      var year = date.getFullYear();
      var month = String(date.getMonth() + 1).padStart(2, '0');
      var day = String(date.getDate()).padStart(2, '0');
      return year + '-' + month + '-' + day;
    }

    function addDays(baseDate, days) {
      var result = new Date(baseDate.getFullYear(), baseDate.getMonth(), baseDate.getDate());
      result.setDate(result.getDate() + days);
      return localDateString(result);
    }

    function todayString() {
      return localDateString(new Date());
    }

    function formatDiscountDate(value) {
      if (!value) return '-';
      return value.split('-').reverse().join('/');
    }

    var today = new Date();
    var discountRecords = Array.prototype.map.call(
      tableBody.querySelectorAll('[data-discount-row]'),
      function (row) {
        return {
          id: row.dataset.discountRow,
          name: row.dataset.name,
          type: row.dataset.type,
          value: Number(row.dataset.value),
          handling: row.dataset.handling,
          startDate: row.dataset.startDate,
          endDate: row.dataset.endDate,
          branches: JSON.parse(row.dataset.branches || '["all"]'),
          carTypes: JSON.parse(row.dataset.carTypes || '["all"]'),
          manualStopped: row.dataset.manualStopped === 'true',
          row: row,
        };
      },
    );

    function getDiscountStatus(record) {
      var todayValue = todayString();
      if (todayValue < record.startDate) return 'scheduled';
      if (todayValue > record.endDate) return 'expired';
      if (record.manualStopped) return 'stopped';
      return 'active';
    }

    function statusMeta(status) {
      var values = {
        active: { label: 'مفعل', icon: 'bi-check-circle-fill' },
        scheduled: { label: 'مجدول', icon: 'bi-calendar-event' },
        stopped: { label: 'متوقف', icon: 'bi-pause-circle-fill' },
        expired: { label: 'منتهي', icon: 'bi-clock-history' },
      };
      return values[status] || values.expired;
    }

    function discountValueText(record) {
      return record.type === 'percentage'
        ? record.value + '%'
        : Number(record.value).toFixed(2) + ' ';
    }

    function discountValueSecondaryText(record) {
      return record.type === 'percentage' ? 'نسبة مئوية' : 'قيمة مالية';
    }

    function filteredRecords() {
      var query = searchInput.value.trim().toLowerCase();
      var selectedStatus = statusFilter.value;
      var selectedDate = dateFilter.value;

      return discountRecords.filter(function (record) {
        var status = getDiscountStatus(record);
        var matchesTab = activeTab === 'all' || status === activeTab;
        var matchesStatus = selectedStatus === 'all' || status === selectedStatus;
        var matchesSearch = !query || record.name.toLowerCase().indexOf(query) !== -1;
        var matchesDate =
          !selectedDate || (selectedDate >= record.startDate && selectedDate <= record.endDate);
        return matchesTab && matchesStatus && matchesSearch && matchesDate;
      });
    }

    function renderPagination(totalPages) {
      pagination.innerHTML = '';
      var previousButton = document.createElement('button');
      previousButton.type = 'button';
      previousButton.className = 'table-pagination__page-btn';
      previousButton.disabled = currentPage === 1;
      previousButton.setAttribute('aria-label', 'الصفحة السابقة');
      previousButton.innerHTML = '<i class="bi bi-chevron-right"></i>';
      previousButton.addEventListener('click', function () {
        currentPage -= 1;
        renderTable();
      });
      pagination.appendChild(previousButton);

      for (var page = 1; page <= totalPages; page += 1) {
        (function (pageNumber) {
          var pageButton = document.createElement('button');
          pageButton.type = 'button';
          pageButton.className =
            'table-pagination__page-btn' + (pageNumber === currentPage ? ' is-active' : '');
          pageButton.textContent = pageNumber;
          pageButton.setAttribute('aria-label', 'الصفحة ' + pageNumber);
          pageButton.addEventListener('click', function () {
            currentPage = pageNumber;
            renderTable();
          });
          pagination.appendChild(pageButton);
        })(page);
      }

      var nextButton = document.createElement('button');
      nextButton.type = 'button';
      nextButton.className = 'table-pagination__page-btn';
      nextButton.disabled = currentPage === totalPages;
      nextButton.setAttribute('aria-label', 'الصفحة التالية');
      nextButton.innerHTML = '<i class="bi bi-chevron-left"></i>';
      nextButton.addEventListener('click', function () {
        currentPage += 1;
        renderTable();
      });
      pagination.appendChild(nextButton);
    }

    function renderTable() {
      var records = filteredRecords();
      var pageSize = Number(pageSizeSelect.value) || 3;
      var totalPages = Math.max(1, Math.ceil(records.length / pageSize));
      if (currentPage > totalPages) currentPage = totalPages;
      var visibleIds = records
        .slice((currentPage - 1) * pageSize, currentPage * pageSize)
        .map(function (record) {
          return record.id;
        });
      tableBody.querySelectorAll('[data-discount-row]').forEach(function (row) {
        row.hidden = true;
      });
      discountRecords.forEach(function (record) {
        var row = record.row;
        row.hidden = visibleIds.indexOf(record.id) === -1;
        row.querySelector('td:nth-child(1) .cell-primary').textContent = record.name;
        row.querySelector('td:nth-child(2) strong').textContent = discountValueText(record);
        row.querySelector('td:nth-child(2) span').textContent = discountValueSecondaryText(record);
        row.querySelector('td:nth-child(6) strong').textContent = formatDiscountDate(
          record.startDate,
        );
        row.querySelector('td:nth-child(7) strong').textContent = formatDiscountDate(
          record.endDate,
        );
        var status = getDiscountStatus(record);
        var meta = statusMeta(status);
        row.querySelector('td:nth-child(8)').innerHTML =
          '<span class="discount-status discount-status--' +
          status +
          '"><i class="bi ' +
          meta.icon +
          '"></i>' +
          meta.label +
          '</span>';
        var branchCell = row.querySelector('[data-scope-cell-mode="branches"]');
        var carCell = row.querySelector('[data-scope-cell-mode="carTypes"]');
        branchCell.dataset.branches = JSON.stringify(record.branches);
        carCell.dataset.carTypes = JSON.stringify(record.carTypes);
        var canPause = status === 'active';
        var pauseAction = canPause
          ? '<button type="button" class="dropdown-item action-menu-item" data-discount-row-action="pause" data-record-id="' +
            record.id +
            '"><i class="bi bi-pause-circle"></i> إيقاف مؤقت</button>'
          : status === 'stopped'
            ? '<button type="button" class="dropdown-item action-menu-item" data-discount-row-action="activate" data-record-id="' +
              record.id +
              '"><i class="bi bi-play-circle"></i> إعادة تفعيل</button>'
            : '<button type="button" class="dropdown-item action-menu-item discount-action-disabled" disabled><i class="bi bi-pause-circle"></i> إيقاف مؤقت</button>';
        row.querySelector('.cell-actions').innerHTML =
          '<div class="action-menu-wrapper"><div class="dropdown action-dropdown"><button class="action-menu-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="الإجراءات"><i class="bi bi-three-dots"></i></button><ul class="dropdown-menu dropdown-menu-end"><li><button type="button" class="dropdown-item action-menu-item" data-discount-row-action="view" data-record-id="' +
          record.id +
          '"><i class="bi bi-eye"></i> عرض</button></li><li><button type="button" class="dropdown-item action-menu-item" data-discount-row-action="edit" data-record-id="' +
          record.id +
          '"><i class="bi bi-pencil"></i> تعديل</button></li><li>' +
          pauseAction +
          '</li><li><hr class="dropdown-divider"></li><li><button type="button" class="dropdown-item action-menu-item text-danger" data-discount-row-action="delete" data-record-id="' +
          record.id +
          '"><i class="bi bi-trash3"></i> حذف</button></li></ul></div></div>';
      });
      tableBody.querySelectorAll('[data-scope-cell]').forEach(function (cell) {
        initScopeCell(cell);
      });
      if (resultCount) resultCount.textContent = records.length + ' خصم';
      renderPagination(totalPages);
    }

    function selectedDiscountType() {
      var checkedType = form.querySelector('input[name="discountType"]:checked');
      return checkedType ? checkedType.value : 'amount';
    }

    function setInputInvalid(input, invalid) {
      input.classList.toggle('is-invalid', invalid);
    }

    function toggleDiscountTypeFields() {
      var type = selectedDiscountType();
      form.querySelectorAll('[data-discount-amount-field]').forEach(function (field) {
        field.hidden = type !== 'amount';
      });
      form.querySelectorAll('[data-discount-percentage-field]').forEach(function (field) {
        field.hidden = type !== 'percentage';
      });
      updateDiscountPreview();
    }

    function updateDiscountPreview() {
      handlingHint.textContent = handlingMeta[handlingInput.value].description;
    }

    function resetDiscountForm() {
      form.reset();
      recordIdInput.value = '';
      document.getElementById('discountFormModalLabel').textContent = 'إضافة خصم';
      document.getElementById('saveDiscountBtn').lastChild.textContent = ' حفظ الخصم';
      form.querySelectorAll('.is-invalid').forEach(function (field) {
        field.classList.remove('is-invalid');
      });
      startDateInput.min = todayString();
      startDateInput.value = todayString();
      endDateInput.min = addDays(new Date(), 1);
      endDateInput.value = addDays(new Date(), 30);
      amountInput.value = '';
      percentageInput.value = '';
      if (scopeRoot.scopeSelectorApi) {
        scopeRoot.scopeSelectorApi.setValue({ branches: ['all'], carTypes: ['all'] });
      }
      toggleDiscountTypeFields();
    }

    function populateDiscountForm(record) {
      resetDiscountForm();
      recordIdInput.value = record.id;
      nameInput.value = record.name;
      form.querySelector('input[name="discountType"][value="' + record.type + '"]').checked = true;
      if (record.type === 'percentage') {
        percentageInput.value = record.value;
      } else {
        amountInput.value = record.value;
      }
      handlingInput.value = record.handling;
      startDateInput.value = record.startDate;
      endDateInput.value = record.endDate;
      if (scopeRoot.scopeSelectorApi) {
        scopeRoot.scopeSelectorApi.setValue({
          branches: record.branches,
          carTypes: record.carTypes,
        });
      }
      document.getElementById('discountFormModalLabel').textContent = 'تعديل الخصم';
      document.getElementById('saveDiscountBtn').lastChild.textContent = ' حفظ التعديلات';
      toggleDiscountTypeFields();
    }

    function validateDiscountForm() {
      var isEditing = Boolean(recordIdInput.value);
      var type = selectedDiscountType();
      var nameInvalid = !nameInput.value.trim();
      var amountInvalid = type === 'amount' && Number(amountInput.value) <= 0;
      var percentageInvalid =
        type === 'percentage' &&
        (Number(percentageInput.value) < 1 || Number(percentageInput.value) > 100);
      var startInvalid =
        !startDateInput.value || (!isEditing && startDateInput.value < todayString());
      var endInvalid = !endDateInput.value || endDateInput.value <= startDateInput.value;
      var scopeValid = scopeRoot.scopeSelectorApi ? scopeRoot.scopeSelectorApi.validate() : true;

      setInputInvalid(nameInput, nameInvalid);
      setInputInvalid(amountInput, amountInvalid);
      setInputInvalid(percentageInput, percentageInvalid);
      setInputInvalid(startDateInput, startInvalid);
      setInputInvalid(endDateInput, endInvalid);

      return !(
        nameInvalid ||
        amountInvalid ||
        percentageInvalid ||
        startInvalid ||
        endInvalid ||
        !scopeValid
      );
    }

    function recordFromForm(existingRecord) {
      var type = selectedDiscountType();
      var scope = scopeRoot.scopeSelectorApi.getValue();
      return {
        id: existingRecord ? existingRecord.id : 'DSC-' + String(Date.now()).slice(-5),
        name: nameInput.value.trim(),
        type: type,
        value: type === 'percentage' ? Number(percentageInput.value) : Number(amountInput.value),
        handling: handlingInput.value,
        startDate: startDateInput.value,
        endDate: endDateInput.value,
        branches: scope.branches,
        carTypes: scope.carTypes,
        manualStopped: existingRecord ? existingRecord.manualStopped : false,
      };
    }

    function showDiscountDetails(record) {
      var status = getDiscountStatus(record);
      var statusInfo = statusMeta(status);
      var branchesText = record.branches[0] === 'all' ? 'كل الفروع' : record.branches.join('، ');
      var carTypesText =
        record.carTypes[0] === 'all' ? 'كل أنواع السيارات' : record.carTypes.join('، ');
      document.getElementById('discountDetailsModalLabel').textContent = record.name;
      document.getElementById('discountDetailsContent').innerHTML =
        '<div class="discount-details-grid">' +
        '<div class="discount-detail-item"><span>نوع وقيمة الخصم</span><strong>' +
        discountValueText(record) +
        ' ï¿½ ' +
        discountValueSecondaryText(record) +
        '</strong></div>' +
        '<div class="discount-detail-item"><span>الحالة</span><strong>' +
        statusInfo.label +
        '</strong></div>' +
        '<div class="discount-detail-item"><span>طريقة التعامل</span><strong>' +
        handlingMeta[record.handling].label +
        '</strong></div>' +
        '<div class="discount-detail-item"><span>الفترة</span><strong class="ltr-num">' +
        formatDiscountDate(record.startDate) +
        ' ï¿½ ' +
        formatDiscountDate(record.endDate) +
        '</strong></div>' +
        '<div class="discount-detail-item discount-detail-item--wide"><span>الفروع</span><strong>' +
        escapeScopeHtml(branchesText) +
        '</strong></div>' +
        '<div class="discount-detail-item discount-detail-item--wide"><span>أنواع السيارات</span><strong>' +
        escapeScopeHtml(carTypesText) +
        '</strong></div></div>';
      detailsModal.show();
    }

    document.querySelectorAll('[data-discount-action="add"]').forEach(function (button) {
      button.addEventListener('click', resetDiscountForm);
    });

    form.querySelectorAll('input, select').forEach(function (field) {
      field.addEventListener('input', function () {
        field.classList.remove('is-invalid');
        updateDiscountPreview();
      });
      field.addEventListener('change', updateDiscountPreview);
    });

    form.querySelectorAll('input[name="discountType"]').forEach(function (radio) {
      radio.addEventListener('change', toggleDiscountTypeFields);
    });

    startDateInput.addEventListener('change', function () {
      if (startDateInput.value)
        endDateInput.min = addDays(new Date(startDateInput.value + 'T00:00:00'), 1);
    });

    form.addEventListener('change', function (event) {
      if (event.target.closest('[data-scope-dimension]')) updateDiscountPreview();
    });

    form.addEventListener('submit', function (event) {
      event.preventDefault();
      if (!validateDiscountForm()) return;

      var existingId = recordIdInput.value;
      var existingIndex = discountRecords.findIndex(function (record) {
        return record.id === existingId;
      });
      var existingRecord = existingIndex >= 0 ? discountRecords[existingIndex] : null;
      var savedRecord = recordFromForm(existingRecord);

      if (existingIndex >= 0) {
        savedRecord.row = discountRecords[existingIndex].row;
        discountRecords[existingIndex] = savedRecord;
      } else {
        var newRow = tableBody.querySelector('[data-discount-row]').cloneNode(true);
        newRow.dataset.discountRow = savedRecord.id;
        newRow.dataset.name = savedRecord.name;
        newRow.dataset.type = savedRecord.type;
        newRow.dataset.value = savedRecord.value;
        newRow.dataset.handling = savedRecord.handling;
        newRow.dataset.startDate = savedRecord.startDate;
        newRow.dataset.endDate = savedRecord.endDate;
        newRow.dataset.branches = JSON.stringify(savedRecord.branches);
        newRow.dataset.carTypes = JSON.stringify(savedRecord.carTypes);
        newRow.dataset.manualStopped = String(savedRecord.manualStopped);
        tableBody.appendChild(newRow);
        savedRecord.row = newRow;
        discountRecords.unshift(savedRecord);
      }

      currentPage = 1;
      renderTable();
      bootstrap.Modal.getOrCreateInstance(formModalElement).hide();
    });

    document.addEventListener('click', function (event) {
      var action = event.target.closest('[data-discount-row-action]');
      if (!action) return;
      var recordId = action.getAttribute('data-record-id');
      var record = discountRecords.find(function (item) {
        return item.id === recordId;
      });
      if (!record) return;

      var actionName = action.getAttribute('data-discount-row-action');
      if (actionName === 'view') showDiscountDetails(record);
      if (actionName === 'edit') {
        populateDiscountForm(record);
        formModal.show();
      }
      if (actionName === 'pause') {
        record.manualStopped = true;
        renderTable();
      }
      if (actionName === 'activate') {
        record.manualStopped = false;
        renderTable();
      }
      if (actionName === 'delete') {
        deleteRecordId = record.id;
        document.getElementById('deleteDiscountName').textContent = record.name;
        deleteModal.show();
      }
    });

    document.getElementById('confirmDeleteDiscount').addEventListener('click', function () {
      if (!deleteRecordId) return;
      discountRecords = discountRecords.filter(function (record) {
        return record.id !== deleteRecordId;
      });
      deleteRecordId = null;
      deleteModal.hide();
      renderTable();
    });

    document.querySelectorAll('[data-discount-status-tab]').forEach(function (tab) {
      tab.addEventListener('click', function () {
        document.querySelectorAll('[data-discount-status-tab]').forEach(function (item) {
          item.classList.remove('is-active');
          item.setAttribute('aria-selected', 'false');
        });
        tab.classList.add('is-active');
        tab.setAttribute('aria-selected', 'true');
        activeTab = tab.getAttribute('data-discount-status-tab');
        currentPage = 1;
        renderTable();
      });
    });

    [searchInput, statusFilter, dateFilter].forEach(function (filter) {
      filter.addEventListener(filter === searchInput ? 'input' : 'change', function () {
        currentPage = 1;
        renderTable();
      });
    });

    pageSizeSelect.addEventListener('change', function () {
      currentPage = 1;
      renderTable();
    });

    document.getElementById('clearDiscountFilters').addEventListener('click', function () {
      searchInput.value = '';
      statusFilter.value = 'all';
      dateFilter.value = '';
      activeTab = 'all';
      currentPage = 1;
      document.querySelectorAll('[data-discount-status-tab]').forEach(function (tab) {
        var isAll = tab.getAttribute('data-discount-status-tab') === 'all';
        tab.classList.toggle('is-active', isAll);
        tab.setAttribute('aria-selected', String(isAll));
      });
      renderTable();
    });

    resetDiscountForm();
    updateDiscountPreview();
    renderTable();
  }

  initDiscountsPage();

  // ===========================================================
  // ARABIC DASHBOARD ï¿½ date filters, range modal, branch select
  // ===========================================================

  // ---------------------------------------------------------
  // Helpers
  // ---------------------------------------------------------
  var AR_MONTHS = [
    'يناير',
    'فبراير',
    'مارس',
    'أبريل',
    'مايو',
    'يونيو',
    'يوليو',
    'أغسطس',
    'سبتمبر',
    'أكتوبر',
    'نوفمبر',
    'ديسمبر',
  ];

  function pad2(n) {
    return n < 10 ? '0' + n : '' + n;
  }

  function formatDMY(date) {
    return pad2(date.getDate()) + '/' + pad2(date.getMonth() + 1) + '/' + date.getFullYear();
  }

  function sameDay(a, b) {
    return (
      a &&
      b &&
      a.getFullYear() === b.getFullYear() &&
      a.getMonth() === b.getMonth() &&
      a.getDate() === b.getDate()
    );
  }

  function startOfMonth(date) {
    return new Date(date.getFullYear(), date.getMonth(), 1);
  }
  function endOfMonth(date) {
    return new Date(date.getFullYear(), date.getMonth() + 1, 0);
  }

  // ---------------------------------------------------------
  // Current-month / previous-month quick filter buttons
  // ---------------------------------------------------------
  function initDashboardFilters() {
    var buttons = document.querySelectorAll('.month-toggle-btn[data-preset-btn]');
    buttons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        buttons.forEach(function (b) {
          b.classList.toggle('is-active', b === btn);
        });

        var today = new Date();
        var from, to;
        if (btn.getAttribute('data-preset-btn') === 'lastMonth') {
          var lm = new Date(today.getFullYear(), today.getMonth() - 1, 1);
          from = startOfMonth(lm);
          to = endOfMonth(lm);
        } else {
          from = startOfMonth(today);
          to = today;
        }
        setAppliedRange(from, to);
      });
    });

    // Reset button functionality
    var resetBtn = document.getElementById('filterResetBtn');
    if (resetBtn) {
      resetBtn.addEventListener('click', function () {
        // Reset date range to today
        var today = new Date();
        setAppliedRange(today, today);

        // Reset month toggle buttons to thisMonth
        buttons.forEach(function (btn) {
          if (btn.getAttribute('data-preset-btn') === 'thisMonth') {
            btn.classList.add('is-active');
          } else {
            btn.classList.remove('is-active');
          }
        });

        // Reset branch selection
        var branchAllCheckbox = document.getElementById('branchAll');
        var branchOptionCheckboxes = document.querySelectorAll(
          '#branchOptionsList input[type="checkbox"]',
        );
        var branchSelectLabel = document.getElementById('branchSelectLabel');

        if (branchAllCheckbox) {
          branchAllCheckbox.checked = true;
        }
        if (branchOptionCheckboxes.length) {
          branchOptionCheckboxes.forEach(function (cb) {
            cb.checked = true;
          });
        }
        if (branchSelectLabel) {
          branchSelectLabel.textContent = 'كل الفروع';
        }
      });
    }
  }

  // ---------------------------------------------------------
  // Day filter pills (scheduled reservations & return reservations)
  // ---------------------------------------------------------
  function initDayFilterPills() {
    var filterContainers = document.querySelectorAll('.view-tabs[aria-label="تصفية حسب اليوم"]');
    if (!filterContainers.length) return;

    filterContainers.forEach(function (filterContainer) {
      var buttons = filterContainer.querySelectorAll('.view-tabs__btn');
      var table = filterContainer.closest('.table-card').querySelector('table');
      if (!table) return;

      var tbody = table.querySelector('tbody');
      if (!tbody) return;

      buttons.forEach(function (btn) {
        btn.addEventListener('click', function () {
          // Update active state
          buttons.forEach(function (b) {
            b.classList.remove('is-active');
            b.setAttribute('aria-selected', 'false');
          });
          btn.classList.add('is-active');
          btn.setAttribute('aria-selected', 'true');

          // Get filter type
          var filterType = '';
          if (btn.classList.contains('view-tabs__btn--all')) {
            filterType = 'all';
          } else if (btn.classList.contains('view-tabs__btn--today')) {
            filterType = 'today';
          } else if (btn.classList.contains('view-tabs__btn--tomorrow')) {
            filterType = 'tomorrow';
          } else if (btn.classList.contains('view-tabs__btn--day-after')) {
            filterType = 'day-after';
          }

          // Filter rows
          var rows = tbody.querySelectorAll('tr');
          rows.forEach(function (row) {
            if (filterType === 'all') {
              row.style.display = '';
            } else {
              if (row.classList.contains('tr--' + filterType)) {
                row.style.display = '';
              } else {
                row.style.display = 'none';
              }
            }
          });
        });
      });
    });
  }

  // ---------------------------------------------------------
  // Reservations list tabs ï¿½ all / extended / pending reservations
  // ---------------------------------------------------------
  function initReservationViewTabs() {
    var tabs = document.querySelector('.view-tabs[aria-label="عرض الحجوزات"]');
    var table = document.getElementById('reservationsTable');
    if (!tabs || !table) return;

    var buttons = tabs.querySelectorAll('.view-tabs__btn[data-reservation-view]');
    var rows = table.querySelectorAll('tbody tr[data-row-key]');
    var extensionColumns = table.querySelectorAll('.extension-column');
    var generalTableWrap = document.getElementById('generalReservationsTableWrap');
    var suspendedTableWrap = document.getElementById('suspendedReservationsTableWrap');
    var generalFilters = document.getElementById('generalReservationFilters');
    var suspendedFilters = document.getElementById('suspendedReservationFilters');
    var generalPagination = document.getElementById('generalReservationsPagination');
    var suspendedPagination = document.getElementById('suspendedReservationsPagination');
    if (!buttons.length || !rows.length) return;

    function setActiveButton(activeBtn) {
      buttons.forEach(function (btn) {
        var isActive = btn === activeBtn;
        btn.classList.toggle('is-active', isActive);
        btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
      });
    }

    function applyView(view) {
      var showExtensionColumns = view === 'extended';
      var showSuspendedTable = view === 'pending' && suspendedTableWrap;

      if (generalTableWrap) generalTableWrap.style.display = showSuspendedTable ? 'none' : '';
      if (suspendedTableWrap) suspendedTableWrap.style.display = showSuspendedTable ? '' : 'none';
      if (generalFilters) generalFilters.style.display = showSuspendedTable ? 'none' : '';
      if (suspendedFilters) suspendedFilters.style.display = showSuspendedTable ? '' : 'none';
      if (generalPagination) generalPagination.style.display = showSuspendedTable ? 'none' : '';
      if (suspendedPagination) suspendedPagination.style.display = showSuspendedTable ? '' : 'none';

      extensionColumns.forEach(function (column) {
        column.style.display = showExtensionColumns ? 'table-cell' : 'none';
      });

      rows.forEach(function (row) {
        var statusBadge = row.querySelector('td:nth-child(8) .badge');
        var status =
          row.getAttribute('data-status') || (statusBadge ? statusBadge.textContent.trim() : '');
        var shouldShow = view === 'all';

        if (view === 'extended') {
          shouldShow = row.getAttribute('data-reservation-extended') === 'true';
        } else if (view === 'pending') {
          shouldShow = false;
        }

        row.style.display = shouldShow ? '' : 'none';
      });
    }

    buttons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        setActiveButton(btn);
        applyView(btn.getAttribute('data-reservation-view'));
      });
    });
  }

  function setAppliedRange(from, to) {
    var display = document.getElementById('dateRangeDisplay');
    if (display) {
      display.textContent = formatDMY(to) + ' - ' + formatDMY(from);
    }
    // Keep the modal's own fields roughly in sync for the next time it opens
    if (window.__dateRangeSetFields) {
      window.__dateRangeSetFields(from, to);
    }
  }

  // ---------------------------------------------------------
  // Branch multi-select dropdown
  // ---------------------------------------------------------
  function initBranchSelect() {
    var allCheckbox = document.getElementById('branchAll');
    var list = document.getElementById('branchOptionsList');
    var label = document.getElementById('branchSelectLabel');
    var searchInput = document.getElementById('branchSearchInput');
    if (!allCheckbox || !list || !label) return;

    var optionCheckboxes = Array.prototype.slice.call(
      list.querySelectorAll('input[type="checkbox"]'),
    );

    function updateLabel() {
      var checked = optionCheckboxes.filter(function (cb) {
        return cb.checked;
      });
      if (checked.length === 0) {
        label.textContent = 'اختر فرع';
      } else if (checked.length === optionCheckboxes.length) {
        label.textContent = 'كل الفروع';
      } else if (checked.length === 1) {
        label.textContent = checked[0].closest('.branch-select__option').textContent.trim();
      } else {
        label.textContent = checked.length + ' فروع محددة';
      }
    }

    allCheckbox.addEventListener('change', function () {
      optionCheckboxes.forEach(function (cb) {
        cb.checked = allCheckbox.checked;
      });
      updateLabel();
    });

    optionCheckboxes.forEach(function (cb) {
      cb.addEventListener('change', function () {
        var allChecked = optionCheckboxes.every(function (c) {
          return c.checked;
        });
        allCheckbox.checked = allChecked;
        updateLabel();
      });
    });

    if (searchInput) {
      searchInput.addEventListener('input', function () {
        var q = searchInput.value.trim().toLowerCase();
        list.querySelectorAll('.branch-select__option').forEach(function (opt) {
          var text = opt.textContent.trim().toLowerCase();
          opt.style.display = text.indexOf(q) !== -1 ? '' : 'none';
        });
      });
    }

    // Prevent the dropdown from closing when interacting with checkboxes/search
    var menu = document.querySelector('.branch-select__menu');
    if (menu) {
      menu.addEventListener('click', function (e) {
        e.stopPropagation();
      });
    }
  }

  // ---------------------------------------------------------
  // Date range modal: dual calendar + presets
  // ---------------------------------------------------------
  // NOTE: this modal is now shared by several trigger buttons (both the
  // toolbar shortcuts and every date field inside the advanced filter
  // modal). `initDateTriggerBinding` below keeps track of which button
  // opened it and pushes the confirmed range back onto that exact button
  // once the user presses "نعم" — see that function for the wiring.
  function initDateRangeModal() {
    var modalEl = document.getElementById('dateRangeModal');
    if (!modalEl) return;

    var fromField = document.getElementById('dateFromField');
    var toField = document.getElementById('dateToField');
    var titleRight = document.getElementById('calTitleRight');
    var titleLeft = document.getElementById('calTitleLeft');
    var daysRight = document.getElementById('calDaysRight');
    var daysLeft = document.getElementById('calDaysLeft');
    var yearBtn = document.getElementById('yearSelectBtn');
    var yearMenu = document.getElementById('yearSelectMenu');
    var prevBtn = document.getElementById('calPrevBtn');
    var nextBtn = document.getElementById('calNextBtn');
    var confirmBtn = document.getElementById('dateRangeConfirmBtn');
    var quickButtons = document.querySelectorAll('.daterange-presets__item[data-quick]');
    var daysBeforeInput = document.getElementById('daysBeforeInput');

    var today = new Date();
    // Right calendar = earlier month, left calendar = the following month
    var viewDate = startOfMonth(today);
    var rangeStart = new Date(today.getFullYear(), today.getMonth(), today.getDate());
    var rangeEnd = new Date(today.getFullYear(), today.getMonth(), today.getDate());

    function buildYearMenu() {
      yearMenu.innerHTML = '';
      var currentYear = new Date().getFullYear();
      for (var y = currentYear + 1; y >= currentYear - 6; y--) {
        var li = document.createElement('li');
        var a = document.createElement('a');
        a.href = '#';
        a.className = 'dropdown-item';
        a.textContent = y;
        (function (year) {
          a.addEventListener('click', function (e) {
            e.preventDefault();
            viewDate = new Date(year, viewDate.getMonth(), 1);
            render();
          });
        })(y);
        li.appendChild(a);
        yearMenu.appendChild(li);
      }
    }

    function renderMonthGrid(container, monthDate) {
      container.innerHTML = '';
      var first = startOfMonth(monthDate);
      var last = endOfMonth(monthDate);
      // Week starts Saturday: JS getDay() 0=Sun..6=Sat -> convert so Sat=0
      var startOffset = (first.getDay() + 1) % 7;

      for (var i = 0; i < startOffset; i++) {
        var empty = document.createElement('span');
        container.appendChild(empty);
      }

      for (var d = 1; d <= last.getDate(); d++) {
        var dayDate = new Date(monthDate.getFullYear(), monthDate.getMonth(), d);
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'calendar-day';
        btn.textContent = d;

        if (sameDay(dayDate, today)) btn.classList.add('is-today');

        if (
          rangeStart &&
          rangeEnd &&
          sameDay(rangeStart, rangeEnd) &&
          sameDay(dayDate, rangeStart)
        ) {
          btn.classList.add('is-range-single');
        } else if (rangeStart && sameDay(dayDate, rangeStart)) {
          btn.classList.add('is-range-start');
        } else if (rangeEnd && sameDay(dayDate, rangeEnd)) {
          btn.classList.add('is-range-end');
        } else if (rangeStart && rangeEnd && dayDate > rangeStart && dayDate < rangeEnd) {
          btn.classList.add('is-in-range');
        }

        btn.addEventListener(
          'click',
          (function (clickedDate) {
            return function () {
              handleDayClick(clickedDate);
            };
          })(dayDate),
        );

        container.appendChild(btn);
      }
    }

    function handleDayClick(clickedDate) {
      if (!rangeStart || (rangeStart && rangeEnd && !sameDay(rangeStart, rangeEnd))) {
        rangeStart = clickedDate;
        rangeEnd = clickedDate;
      } else if (clickedDate < rangeStart) {
        rangeEnd = rangeStart;
        rangeStart = clickedDate;
      } else {
        rangeEnd = clickedDate;
      }
      quickButtons.forEach(function (b) {
        b.classList.remove('is-active');
      });
      updateFields();
      render();
    }

    function updateFields() {
      fromField.value = formatDMY(rangeStart);
      toField.value = formatDMY(rangeEnd);
    }

    function render() {
      var rightMonth = viewDate;
      var leftMonth = new Date(viewDate.getFullYear(), viewDate.getMonth() + 1, 1);

      titleRight.textContent = AR_MONTHS[rightMonth.getMonth()] + ' ' + rightMonth.getFullYear();
      titleLeft.textContent = AR_MONTHS[leftMonth.getMonth()] + ' ' + leftMonth.getFullYear();
      yearBtn.textContent = rightMonth.getFullYear();

      renderMonthGrid(daysRight, rightMonth);
      renderMonthGrid(daysLeft, leftMonth);
      updateFields();
    }

    prevBtn.addEventListener('click', function () {
      viewDate = new Date(viewDate.getFullYear(), viewDate.getMonth() - 1, 1);
      render();
    });
    nextBtn.addEventListener('click', function () {
      viewDate = new Date(viewDate.getFullYear(), viewDate.getMonth() + 1, 1);
      render();
    });

    quickButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        quickButtons.forEach(function (b) {
          b.classList.remove('is-active');
        });
        btn.classList.add('is-active');

        var now = new Date();
        var key = btn.getAttribute('data-quick');

        if (key === 'today') {
          rangeStart = new Date(now.getFullYear(), now.getMonth(), now.getDate());
          rangeEnd = rangeStart;
        } else if (key === 'yesterday') {
          var y = new Date(now);
          y.setDate(y.getDate() - 1);
          rangeStart = new Date(y.getFullYear(), y.getMonth(), y.getDate());
          rangeEnd = rangeStart;
        } else if (key === 'thisWeek') {
          var dow = (now.getDay() + 1) % 7; // Sat = 0
          var weekStart = new Date(now);
          weekStart.setDate(now.getDate() - dow);
          rangeStart = new Date(weekStart.getFullYear(), weekStart.getMonth(), weekStart.getDate());
          rangeEnd = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        } else if (key === 'lastWeek') {
          var dow2 = (now.getDay() + 1) % 7;
          var thisWeekStart = new Date(now);
          thisWeekStart.setDate(now.getDate() - dow2);
          var lastWeekStart = new Date(thisWeekStart);
          lastWeekStart.setDate(thisWeekStart.getDate() - 7);
          var lastWeekEnd = new Date(thisWeekStart);
          lastWeekEnd.setDate(thisWeekStart.getDate() - 1);
          rangeStart = new Date(
            lastWeekStart.getFullYear(),
            lastWeekStart.getMonth(),
            lastWeekStart.getDate(),
          );
          rangeEnd = new Date(
            lastWeekEnd.getFullYear(),
            lastWeekEnd.getMonth(),
            lastWeekEnd.getDate(),
          );
        } else if (key === 'thisMonth') {
          rangeStart = startOfMonth(now);
          rangeEnd = new Date(now.getFullYear(), now.getMonth(), now.getDate());
        } else if (key === 'lastMonth') {
          var lm = new Date(now.getFullYear(), now.getMonth() - 1, 1);
          rangeStart = startOfMonth(lm);
          rangeEnd = endOfMonth(lm);
        }

        viewDate = startOfMonth(rangeStart);
        render();
      });
    });

    // Handle days before today input
    if (daysBeforeInput) {
      daysBeforeInput.addEventListener('input', function () {
        var daysBefore = parseInt(this.value, 10);
        if (isNaN(daysBefore) || daysBefore < 1) {
          daysBefore = 1;
          this.value = 1;
        }

        // Calculate the date that is 'daysBefore' days before today
        var targetDate = new Date(today);
        targetDate.setDate(today.getDate() - daysBefore);

        // Set the range to that single date
        rangeStart = new Date(
          targetDate.getFullYear(),
          targetDate.getMonth(),
          targetDate.getDate(),
        );
        rangeEnd = new Date(targetDate.getFullYear(), targetDate.getMonth(), targetDate.getDate());

        // Remove active class from quick buttons
        quickButtons.forEach(function (b) {
          b.classList.remove('is-active');
        });

        // Update the calendar view and fields
        viewDate = startOfMonth(rangeStart);
        render();
      });
    }

    confirmBtn.addEventListener('click', function () {
      setAppliedRange(rangeStart, rangeEnd);
      var bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
      bsModal.hide();
    });

    // Allow other parts of the page (month-toggle buttons, filter-modal
    // triggers) to sync the modal's state before it opens.
    window.__dateRangeSetFields = function (from, to) {
      rangeStart = from;
      rangeEnd = to;
      viewDate = startOfMonth(from);
    };

    // Lets other code (the trigger binding below) read back the exact
    // Date objects the user just confirmed, in the same shape that
    // __dateRangeSetFields expects, so per-field values round-trip cleanly.
    window.__dateRangeGetRange = function () {
      return { from: rangeStart, to: rangeEnd };
    };

    modalEl.addEventListener('show.bs.modal', function () {
      render();
    });

    buildYearMenu();
    render();
  }

  // ---------------------------------------------------------
  // Date-trigger binding: wires every button that opens the shared
  // #dateRangeModal (toolbar shortcuts + every date field inside the
  // advanced filter modal) so that:
  //   1) the date-range modal is shown on top of whichever modal (if any)
  //      it was opened from ï¿½ handled visually by the z-index rules in
  //      the page's <style>, this just makes sure we call bootstrap's
  //      show() directly instead of relying on data-bs-toggle so we can
  //      remember which button asked for it;
  //   2) each field remembers its own previously chosen range, so
  //      reopening the calendar for that field starts from where it left
  //      off instead of resetting to "today";
  //   3) confirming a date only closes the date-range modal itself ï¿½ the
  //      filter modal (if it was open) stays open ï¿½ and writes the
  //      chosen range back onto the exact button the user clicked.
  // ---------------------------------------------------------
  function initDateTriggerBinding() {
    var modalEl = document.getElementById('dateRangeModal');
    var confirmBtn = document.getElementById('dateRangeConfirmBtn');
    var triggers = document.querySelectorAll('.js-date-trigger');
    if (!modalEl || !triggers.length || typeof bootstrap === 'undefined') return;

    var activeTrigger = null;
    var savedRanges = {}; // fieldKey -> { from: Date, to: Date }

    function formatRangeLabel(from, to) {
      if (sameDay(from, to)) return formatDMY(from);
      return formatDMY(to) + ' - ' + formatDMY(from);
    }

    triggers.forEach(function (btn) {
      btn.addEventListener('click', function () {
        activeTrigger = btn;

        var key = btn.getAttribute('data-field-key');
        var saved = key && savedRanges[key];
        if (window.__dateRangeSetFields) {
          if (saved) {
            window.__dateRangeSetFields(new Date(saved.from), new Date(saved.to));
          } else {
            var today = new Date();
            window.__dateRangeSetFields(today, today);
          }
        }

        bootstrap.Modal.getOrCreateInstance(modalEl).show();
      });
    });

    if (confirmBtn) {
      confirmBtn.addEventListener('click', function () {
        if (!activeTrigger || !window.__dateRangeGetRange) return;

        var range = window.__dateRangeGetRange();
        var key = activeTrigger.getAttribute('data-field-key');
        if (key) {
          savedRanges[key] = {
            from: new Date(range.from),
            to: new Date(range.to),
          };
        }

        var label = activeTrigger.querySelector('.js-date-trigger-label');
        if (label) {
          label.textContent = formatRangeLabel(range.from, range.to);
          label.classList.add('ltr-num');
        }
        activeTrigger.classList.add('has-value');

        document.dispatchEvent(
          new CustomEvent('dateRangeApplied', {
            detail: {
              key: key,
              from: range.from,
              to: range.to,
            },
          }),
        );
      });
    }

    document.addEventListener('dateRangeClearRequested', function (event) {
      var key = event.detail && event.detail.key;
      if (!key) return;

      delete savedRanges[key];
      triggers.forEach(function (trigger) {
        if (trigger.getAttribute('data-field-key') !== key) return;

        var label = trigger.querySelector('.js-date-trigger-label');
        if (label) {
          label.textContent = trigger.getAttribute('data-default-label') || '';
          label.classList.remove('ltr-num');
        }
        trigger.classList.remove('has-value');
      });

      document.dispatchEvent(
        new CustomEvent('dateRangeCleared', {
          detail: { key: key },
        }),
      );
    });
  }

  // ---------------------------------------------------------
  // Scheduled reservations toolbar filters
  // ---------------------------------------------------------
  function initScheduledReservationFilters() {
    var table = document.getElementById('scheduledTable');
    var searchInput = document.getElementById('scheduledSearchInput');
    var clearFiltersButton = document.getElementById('scheduledFiltersClearBtn');
    var filterModal = document.getElementById('filterModal');
    var applyAdvancedFiltersButton = document.getElementById('applyFilterBtn');
    if (!table || !searchInput) return;

    var rows = table.querySelectorAll('tbody tr');
    var filterBar = table.closest('.table-card').querySelector('.table-filter-bar');
    var toolbarFilters = filterBar.querySelectorAll('.scheduled-toolbar-filter');
    var dateTriggers = filterBar.querySelectorAll('.js-date-trigger');
    var dayTabs = table
      .closest('.table-card')
      .querySelector('.view-tabs[aria-label="تصفية حسب اليوم"]');
    var selectedFilters = { city: '', office: '' };
    var advancedFilters = {
      licenseNumber: '',
      kiosk: '',
      rated: '',
      assigned: '',
    };
    var dateRanges = {};
    var selectedDay = 'all';

    function padDatePart(value) {
      return value < 10 ? '0' + value : String(value);
    }

    function toDateKey(date) {
      var year = date.getFullYear();
      var month = padDatePart(date.getMonth() + 1);
      var day = padDatePart(date.getDate());
      return year + '-' + month + '-' + day;
    }

    function matchesSelectedDay(row) {
      return selectedDay === 'all' || row.classList.contains('tr--' + selectedDay);
    }

    function updateClearFiltersButton() {
      if (!clearFiltersButton) return;
      var hasToolbarFilter = Object.keys(selectedFilters).some(function (key) {
        return Boolean(selectedFilters[key]);
      });
      var hasAdvancedFilter = Object.keys(advancedFilters).some(function (key) {
        return Boolean(advancedFilters[key]);
      });
      var hasActiveFilter =
        hasToolbarFilter ||
        hasAdvancedFilter ||
        Object.keys(dateRanges).length > 0 ||
        Boolean(searchInput.value.trim()) ||
        selectedDay !== 'all';
      clearFiltersButton.disabled = !hasActiveFilter;
    }

    function applyFilters() {
      var searchValue = searchInput.value.trim().toLowerCase();

      rows.forEach(function (row) {
        var matchesToolbar = Object.keys(selectedFilters).every(function (key) {
          return !selectedFilters[key] || row.dataset[key] === selectedFilters[key];
        });
        var matchesDates = Object.keys(dateRanges).every(function (key) {
          var rowDate = row.dataset[key] || '';
          var range = dateRanges[key];
          return rowDate && rowDate >= range.from && rowDate <= range.to;
        });
        var matchesAdvanced =
          (!advancedFilters.licenseNumber ||
            row.textContent.toLowerCase().includes(advancedFilters.licenseNumber)) &&
          (!advancedFilters.kiosk || row.dataset.kiosk === advancedFilters.kiosk) &&
          (!advancedFilters.rated || row.dataset.rated === advancedFilters.rated) &&
          (!advancedFilters.assigned || row.dataset.assigned === advancedFilters.assigned);
        var matchesSearch = !searchValue || row.textContent.toLowerCase().includes(searchValue);

        row.style.display =
          matchesToolbar &&
          matchesDates &&
          matchesAdvanced &&
          matchesSearch &&
          matchesSelectedDay(row)
            ? ''
            : 'none';
      });
    }

    toolbarFilters.forEach(function (filter) {
      var key = filter.getAttribute('data-filter-key');
      var button = filter.querySelector('.filter-btn');
      var label = filter.querySelector('.scheduled-toolbar-filter__label');

      filter.querySelectorAll('.dropdown-item[data-filter-value]').forEach(function (item) {
        item.addEventListener('click', function (event) {
          event.preventDefault();
          var value = item.getAttribute('data-filter-value');
          selectedFilters[key] = value;
          label.textContent = value || label.getAttribute('data-default-label');
          button.classList.toggle('has-value', Boolean(value));
          updateClearFiltersButton();
          applyFilters();
        });
      });
    });

    searchInput.addEventListener('input', function () {
      updateClearFiltersButton();
      applyFilters();
    });

    if (dayTabs) {
      dayTabs.querySelectorAll('.view-tabs__btn').forEach(function (button) {
        button.addEventListener('click', function () {
          selectedDay = 'all';
          if (button.classList.contains('view-tabs__btn--today')) selectedDay = 'today';
          if (button.classList.contains('view-tabs__btn--tomorrow')) selectedDay = 'tomorrow';
          if (button.classList.contains('view-tabs__btn--day-after')) selectedDay = 'day-after';
          updateClearFiltersButton();
          applyFilters();
        });
      });
    }

    document.addEventListener('dateRangeApplied', function (event) {
      var detail = event.detail || {};
      var supportedTrigger = filterBar.querySelector(
        '.js-date-trigger[data-field-key="' + detail.key + '"]',
      );
      if (!supportedTrigger || !detail.from || !detail.to) return;

      dateRanges[detail.key] = {
        from: toDateKey(detail.from),
        to: toDateKey(detail.to),
      };
      updateClearFiltersButton();
      applyFilters();
    });

    document.addEventListener('dateRangeCleared', function (event) {
      var key = event.detail && event.detail.key;
      if (!key || !Object.prototype.hasOwnProperty.call(dateRanges, key)) return;
      delete dateRanges[key];
      updateClearFiltersButton();
      applyFilters();
    });

    if (applyAdvancedFiltersButton && filterModal) {
      applyAdvancedFiltersButton.addEventListener('click', function () {
        advancedFilters.licenseNumber = document
          .getElementById('licenseNumber')
          .value.trim()
          .toLowerCase();
        advancedFilters.kiosk = document.getElementById('kioskFilter').value;
        advancedFilters.rated = document.getElementById('ratedFilter').value;
        advancedFilters.assigned = document.getElementById('assignedFilter').value;
        updateClearFiltersButton();
        applyFilters();

        if (typeof bootstrap !== 'undefined') {
          bootstrap.Modal.getOrCreateInstance(filterModal).hide();
        }
      });
    }

    if (clearFiltersButton) {
      clearFiltersButton.addEventListener('click', function () {
        Object.keys(selectedFilters).forEach(function (key) {
          selectedFilters[key] = '';
        });
        toolbarFilters.forEach(function (filter) {
          var button = filter.querySelector('.filter-btn');
          var label = filter.querySelector('.scheduled-toolbar-filter__label');
          label.textContent = label.getAttribute('data-default-label');
          button.classList.remove('has-value');
        });
        Object.keys(advancedFilters).forEach(function (key) {
          advancedFilters[key] = '';
        });
        ['licenseNumber', 'kioskFilter', 'ratedFilter', 'assignedFilter'].forEach(function (id) {
          var field = document.getElementById(id);
          if (field) field.value = '';
        });
        searchInput.value = '';
        selectedDay = 'all';
        if (dayTabs) {
          dayTabs.querySelectorAll('.view-tabs__btn').forEach(function (button) {
            var isAll = button.classList.contains('view-tabs__btn--all');
            button.classList.toggle('is-active', isAll);
            button.setAttribute('aria-selected', isAll ? 'true' : 'false');
          });
        }
        dateTriggers.forEach(function (trigger) {
          document.dispatchEvent(
            new CustomEvent('dateRangeClearRequested', {
              detail: { key: trigger.getAttribute('data-field-key') },
            }),
          );
        });
        updateClearFiltersButton();
        applyFilters();
      });
    }
  }

  // ---------------------------------------------------------
  // ApexCharts ï¿½ rate-card radial gauges
  // ---------------------------------------------------------
  function initGaugeCharts() {
    if (typeof ApexCharts === 'undefined') return;

    document.querySelectorAll('.rate-card__gauge').forEach(function (el) {
      var value = parseFloat(el.getAttribute('data-value')) || 0;
      var color = el.getAttribute('data-color') || '#1f7ffa';
      var label = el.getAttribute('data-label') || value + '%';

      var chart = new ApexCharts(el, {
        chart: {
          type: 'radialBar',
          width: 108,
          height: 108,
          sparkline: { enabled: true },
        },
        series: [value],
        colors: [color],
        plotOptions: {
          radialBar: {
            hollow: { size: '62%' },
            track: { background: '#eef1f6', strokeWidth: '100%' },
            dataLabels: {
              show: true,
              name: { show: false },
              value: {
                offsetY: 6,
                fontSize: '1.1rem',
                fontWeight: 800,
                fontFamily: 'Alexandria, sans-serif',
                color: '#0a2540',
                formatter: function () {
                  return label;
                },
              },
            },
          },
        },
        stroke: { lineCap: 'round' },
      });
      chart.render();
    });
  }

  // ---------------------------------------------------------
  // ApexCharts ï¿½ service type donut
  // ---------------------------------------------------------
  function initServiceTypeChart() {
    var mount = document.getElementById('serviceTypeChart');
    var legendMount = document.getElementById('serviceTypeLegend');
    if (!mount || typeof ApexCharts === 'undefined') return;

    // Service types mirror the options offered in the user app.
    var data = [
      { label: 'يومي', value: 5, color: '#14b8a6' },
      { label: 'شهري', value: 3, color: '#1f7ffa' },
      { label: 'دولي', value: 2, color: '#fb7185' },
      { label: 'محطة القطار', value: 1, color: '#f59e0b' },
      { label: 'من المطار', value: 2, color: '#8b5cf6' },
    ];
    var total = data.reduce(function (sum, d) {
      return sum + d.value;
    }, 0);

    var chart = new ApexCharts(mount, {
      chart: { type: 'donut', width: 225, height: 225 },
      series: data.map(function (d) {
        return d.value;
      }),
      labels: data.map(function (d) {
        return d.label;
      }),
      colors: data.map(function (d) {
        return d.color;
      }),
      dataLabels: { enabled: false },
      legend: { show: false },
      stroke: { width: 2, colors: ['#ffffff'] },
      plotOptions: {
        pie: {
          donut: {
            size: '70%',
            labels: {
              show: true,
              total: {
                show: true,
                label: 'الإجمالي',
                fontFamily: 'Alexandria, sans-serif',
                color: '#6b7488',
                formatter: function () {
                  return total;
                },
              },
              value: {
                fontFamily: 'Alexandria, sans-serif',
                fontWeight: 800,
                color: '#0a2540',
              },
            },
          },
        },
      },
      tooltip: { style: { fontFamily: 'Alexandria, sans-serif' } },
    });
    chart.render();

    if (legendMount) {
      legendMount.innerHTML = data
        .map(function (d) {
          return (
            '<span class="donut-legend__item"><i class="donut-legend__dot" style="background:' +
            d.color +
            '"></i> ' +
            d.label +
            ': ' +
            d.value +
            '</span>'
          );
        })
        .join('');
    }
  }

  // ---------------------------------------------------------
  // DataTables ï¿½ cars tables (lightweight: sortable only) and
  // the offices performance table (full search + pagination)
  // ---------------------------------------------------------
  function initDataTables() {
    if (typeof jQuery === 'undefined' || !jQuery.fn.DataTable) return;
    var $ = jQuery;

    var arNoData = { emptyTable: 'لا توجد بيانات لعرضها' };

    // Small "most rented cars" tables: sortable columns only, no
    // paging/search UI (they're short reference lists).
    ['#ksaCarsTable', '#companyCarsTable'].forEach(function (sel) {
      if (!$(sel).length) return;
      $(sel).DataTable({
        paging: false,
        searching: false,
        info: false,
        order: [],
        columnDefs: [{ targets: -1, orderable: false }],
        language: arNoData,
      });
    });

    // Offices performance table: full search + pagination, wired
    // to our custom-styled search input and page-size select.
    if ($('#officeTable').length) {
      var officeTable = $('#officeTable').DataTable({
        pageLength: 10,
        lengthChange: false,
        dom: 'rt<"table-pagination-dt-controls"ip>',
        order: [],
        language: {
          emptyTable: 'لا توجد بيانات لعرضها',
          zeroRecords: 'لا توجد نتائج مطابقة',
          info: 'عرض _START_ إلى _END_ من أصل _TOTAL_ عنصر',
          infoEmpty: 'عرض 0 إلى 0 من أصل 0 عنصر',
          infoFiltered: '(منتقاة من أصل _MAX_ عنصر)',
          paginate: {
            first: '<i class="bi bi-chevron-double-right"></i>',
            previous: '<i class="bi bi-chevron-right"></i>',
            next: '<i class="bi bi-chevron-left"></i>',
            last: '<i class="bi bi-chevron-double-left"></i>',
          },
        },
      });

      var searchInput = document.getElementById('officeSearchInput');
      if (searchInput) {
        searchInput.addEventListener('input', function () {
          officeTable.search(searchInput.value).draw();
        });
      }

      var pageSizeSelect = document.getElementById('pageSizeSelect');
      if (pageSizeSelect) {
        pageSizeSelect.addEventListener('change', function () {
          officeTable.page.len(parseInt(pageSizeSelect.value, 10)).draw();
        });
      }

      // Fold DataTables' auto-generated info + pagination controls
      // into our existing footer row alongside the page-size select.
      var controls = document.querySelector('.table-pagination-dt-controls');
      var footer = document.querySelector('.table-pagination-dt');
      if (controls && footer) {
        footer.insertBefore(controls, footer.firstChild);
      }
    }
  }

  // ---------------------------------------------------------
  // Booking map toggles — "إظهار الخريطة" button wiring
  //
  // Each [data-booking-map] block owns an independent Leaflet map and marker.
  // Maps are initialized on first show so Leaflet can measure their containers.
  // ---------------------------------------------------------
  function initMapToggle() {
    const mapRoots = document.querySelectorAll('[data-booking-map]');
    if (!mapRoots.length) return;

    window.BookingMaps = window.BookingMaps || {};

    mapRoots.forEach(function (mapRoot) {
      const mapName = mapRoot.getAttribute('data-booking-map');
      const showMapBtn = mapRoot.querySelector('[data-map-toggle]');
      const mapContainer = mapRoot.querySelector('[data-map-container]');
      const mapElement = mapRoot.querySelector('[data-map-canvas]');
      const locationInput = mapRoot.querySelector('input[type="text"]');
      let map = null;
      let marker = null;

      if (!mapName || !showMapBtn || !mapContainer || !mapElement) return;

      function setButtonState(isVisible) {
        const icon = showMapBtn.querySelector('i');
        const label = showMapBtn.querySelector('span');

        showMapBtn.classList.toggle('is-active', isVisible);
        showMapBtn.setAttribute('aria-expanded', String(isVisible));
        mapContainer.setAttribute('aria-hidden', String(!isVisible));

        if (icon) icon.className = isVisible ? 'bi bi-map-fill' : 'bi bi-map';
        if (label) label.textContent = isVisible ? 'إخفاء الخريطة' : 'إظهار الخريطة';
      }

      function applyLatLng(latlng) {
        if (!locationInput) return;

        locationInput.value = latlng.lat.toFixed(6) + ', ' + latlng.lng.toFixed(6);
        locationInput.dispatchEvent(new Event('input', { bubbles: true }));
      }

      function buildMap() {
        if (typeof L === 'undefined') return;

        // Center on Riyadh, Saudi Arabia.
        map = L.map(mapElement).setView([24.7136, 46.6753], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(map);

        marker = L.marker([24.7136, 46.6753], { draggable: true }).addTo(map);

        marker.on('dragend', function () {
          applyLatLng(marker.getLatLng());
        });

        map.on('click', function (event) {
          marker.setLatLng(event.latlng);
          applyLatLng(event.latlng);
        });
      }

      function showMap() {
        mapContainer.classList.add('is-visible');
        setButtonState(true);

        if (!map) buildMap();

        if (map) {
          setTimeout(function () {
            map.invalidateSize();
          }, 100);
        }
      }

      function hideMap() {
        mapContainer.classList.remove('is-visible');
        setButtonState(false);
      }

      function isVisible() {
        return mapContainer.classList.contains('is-visible');
      }

      showMapBtn.addEventListener('click', function (event) {
        event.preventDefault();

        if (isVisible()) {
          hideMap();
        } else {
          showMap();
        }
      });

      window.BookingMaps[mapName] = {
        show: showMap,
        hide: hideMap,
        isVisible: isVisible,
        getMap: function () {
          return map;
        },
      };
    });
  }

  // ---------------------------------------------------------
  // Filter modal — "تطبيق" button wiring
  //
  // Collects all selected filter values from the comprehensive
  // filter modal and applies them to filter the reservations table.
  // ---------------------------------------------------------
  function initFilterModal() {
    var modalEl = document.getElementById('filterModal');
    var applyBtn = document.getElementById('applyFilterBtn');
    var table = document.getElementById('reservationsTable');
    if (!modalEl || !applyBtn || !table || typeof bootstrap === 'undefined') return;

    applyBtn.addEventListener('click', function () {
      // Get all filter dropdown buttons and their selected values
      var filterButtons = modalEl.querySelectorAll('.filter-select-btn');
      var filters = {};

      filterButtons.forEach(function (btn) {
        var label = btn.closest('.filter-field').querySelector('label').textContent;
        var selectedText = btn.textContent.trim();
        filters[label] = selectedText;
      });

      // Get date filter values
      var dateButtons = modalEl.querySelectorAll('.js-date-trigger.has-value');
      dateButtons.forEach(function (btn) {
        var label = btn.closest('.filter-field').querySelector('label').textContent;
        var dateValue = btn.querySelector('.js-date-trigger-label').textContent;
        filters[label] = dateValue;
      });

      // Apply filters to table rows
      var tbody = table.querySelector('tbody');
      var rows = tbody.querySelectorAll('tr');

      rows.forEach(function (row) {
        var shouldShow = true;

        // Check if row matches all active filters
        // For now, this is a placeholder for the actual filter logic
        // In a real implementation, you would compare each row's data
        // against the selected filter values

        row.style.display = shouldShow ? '' : 'none';
      });

      // Close the modal
      bootstrap.Modal.getOrCreateInstance(modalEl).hide();
    });
  }

  // ---------------------------------------------------------
  // Reservations table — "إضافة أعمدة" modal wiring
  //
  // Checking boxes and pressing "تطبيق" inserts the matching
  // column(s) into #reservationsTable (header + one cell per row,
  // right before the "الإجراءات" column) using the sample dataset
  // below, keyed by each row's data-row-key. The selection is
  // persisted in localStorage so it survives a reload, and the
  // checkboxes are re-synced to the applied state every time the
  // modal is opened.
  // ---------------------------------------------------------
  function initAddColumnsModal() {
    var modalEl = document.getElementById('addColumnsModal');
    var table = document.getElementById('reservationsTable');
    if (!modalEl || !table || typeof bootstrap === 'undefined') return;

    var applyBtn = document.getElementById('applyColumnsBtn');
    var checkboxes = modalEl.querySelectorAll('input[type="checkbox"]');
    var STORAGE_KEY = 'reservationsExtraColumns';

    var COLUMN_DATA = {
      'customer-nationality': {
        label: 'جنسية العميل',
        values: {
          Y8e087: 'سعودي',
          Hb4685: 'سعودي',
          Gf1d41: 'سعودي',
          S7a617: 'أمريكي',
          Q568ef: 'إماراتي',
        },
      },
      'customer-gender': {
        label: 'الجنس',
        values: { Y8e087: 'أنثى', Hb4685: 'أنثى', Gf1d41: 'ذكر', S7a617: 'ذكر', Q568ef: 'أنثى' },
      },
      'license-number': {
        label: 'رقم الرخصة',
        cls: 'ltr-num',
        values: {
          Y8e087: '1023456789',
          Hb4685: '1087654321',
          Gf1d41: '1099887766',
          S7a617: '1076543210',
          Q568ef: '1065432109',
        },
      },
      'customer-email': {
        label: 'ايميل العميل',
        cls: 'ltr-num',
        values: {
          Y8e087: 'maryam.ahli@example.com',
          Hb4685: 'ozai.sbeai@example.com',
          Gf1d41: 'fahad.anazi@example.com',
          S7a617: 'jsnson.ont@example.com',
          Q568ef: 'weds.alseari@example.com',
        },
      },
      'booking-count': {
        label: 'عدد الحجوزات',
        values: { Y8e087: '5', Hb4685: '2', Gf1d41: '8', S7a617: '1', Q568ef: '3' },
      },
      'customer-city': {
        label: 'مدينة العميل',
        values: {
          Y8e087: 'الرياض',
          Hb4685: 'جدة',
          Gf1d41: 'الدمام',
          S7a617: 'الرياض',
          Q568ef: 'مكة',
        },
      },

      'company-name': {
        label: 'اسم الشركة',
        values: {
          Y8e087: 'N2 لتأجير السيارات',
          Hb4685: 'N2 لتأجير السيارات',
          Gf1d41: 'N2 لتأجير السيارات',
          S7a617: 'N2 لتأجير السيارات',
          Q568ef: 'N2 لتأجير السيارات',
        },
      },
      'car-model': {
        label: 'السيارة',
        values: {
          Y8e087: 'تويوتا كامري 2025',
          Hb4685: 'هيونداي إلنترا 2024',
          Gf1d41: 'كيا سبورتاج 2025',
          S7a617: 'نيسان صني 2023',
          Q568ef: 'تويوتا يارس 2024',
        },
      },

      'booking-time': {
        label: 'وقت الحجز',
        cls: 'ltr-num',
        values: {
          Y8e087: '2026-07-20 12:15',
          Hb4685: '2026-07-20 09:20',
          Gf1d41: '2026-07-19 23:50',
          S7a617: '2026-07-19 14:10',
          Q568ef: '2026-07-19 20:05',
        },
      },
      'delivery-time': {
        label: 'وقت التسليم',
        cls: 'ltr-num',
        values: {
          Y8e087: '12:30',
          Hb4685: '09:45',
          Gf1d41: '00:00',
          S7a617: '14:45',
          Q568ef: '20:30',
        },
      },
      'adjusted-time': {
        label: 'الوقت المعدل',
        cls: 'ltr-num',
        values: {
          Y8e087: '12:45',
          Hb4685: '10:00',
          Gf1d41: '00:15',
          S7a617: '15:00',
          Q568ef: '20:45',
        },
      },
      'response-duration': {
        label: 'مدة الاستجابة',
        values: {
          Y8e087: '5 دقائق',
          Hb4685: '3 دقائق',
          Gf1d41: '10 دقائق',
          S7a617: 'دقيقتان',
          Q568ef: '7 دقائق',
        },
      },
      'pickup-location': {
        label: 'موقع الاستلام',
        values: {
          Y8e087: 'فرع الرياض - العليا',
          Hb4685: 'فرع الرياض - العليا',
          Gf1d41: 'فرع الرياض - التويق',
          S7a617: 'فرع الرياض - العزيزية',
          Q568ef: 'فرع الرياض - العليا',
        },
      },
      'delivery-location': {
        label: 'موقع التسليم',
        values: {
          Y8e087: 'مطار الملك خالد الدولي',
          Hb4685: 'عنوان العميل',
          Gf1d41: 'عنوان العميل',
          S7a617: 'فرع الرياض',
          Q568ef: 'عنوان العميل',
        },
      },
      'payment-method': {
        label: 'طريقة الدفع',
        values: {
          Y8e087: 'بطاقة',
          Hb4685: 'أبل باي',
          Gf1d41: 'نقدًا',
          S7a617: 'تابي',
          Q568ef: 'بطاقة',
        },
      },
      'net-total-price': {
        label: 'السعر الإجمالي الصافي',
        cls: 'ltr-num',
        values: {
          Y8e087: '450 ',
          Hb4685: '180 ',
          Gf1d41: '620 ',
          S7a617: '210 ',
          Q568ef: '95 ',
        },
      },
      'total-price': {
        label: 'السعر الإجمالي',
        cls: 'ltr-num',
        values: {
          Y8e087: '520 ',
          Hb4685: '210 ',
          Gf1d41: '690 ',
          S7a617: '240 ',
          Q568ef: '110 ',
        },
      },
      accepted: {
        label: 'مقبول',
        values: { Y8e087: 'نعم', Hb4685: 'لا', Gf1d41: 'لا', S7a617: 'لا', Q568ef: 'نعم' },
      },
      'admin-notes': {
        label: 'ملاحظات الادمن',
        values: {
          Y8e087: 'ï¿½',
          Hb4685: 'تأخر العميل عن الاستلام',
          Gf1d41: 'بانتظار مراجعة الحجز',
          S7a617: 'بيانات غير مكتملة',
          Q568ef: 'ï¿½',
        },
      },
      'customer-evaluation': {
        label: 'تقييم العميل للمكتب',
        values: { Y8e087: '5', Hb4685: 'ï¿½', Gf1d41: 'ï¿½', S7a617: 'ï¿½', Q568ef: '4' },
      },
      'evaluation-reason': {
        label: 'سبب التقييم',
        values: {
          Y8e087: 'ï¿½',
          Hb4685: 'إلغاء التأجير للعميل المؤهل',
          Gf1d41: 'السيارة غير متوفرة',
          S7a617: 'بيانات غير مكتملة',
          Q568ef: 'ï¿½',
        },
      },
      compensated: {
        label: 'تم التعويض',
        values: { Y8e087: 'لا', Hb4685: 'لا', Gf1d41: 'نعم', S7a617: 'لا', Q568ef: 'لا' },
      },
      'settlement-status': {
        label: 'حالة التسوية',
        values: {
          Y8e087: 'تمت التسوية',
          Hb4685: 'غير مسوى',
          Gf1d41: 'غير مسوى',
          S7a617: 'غير مسوى',
          Q568ef: 'تمت التسوية',
        },
      },
      'delivery-assignment': {
        label: 'إسناد التوصيل',
        values: {
          Y8e087: 'أحمد السالم',
          Hb4685: 'ï¿½',
          Gf1d41: 'ï¿½',
          S7a617: 'ï¿½',
          Q568ef: 'خالد المطيري',
        },
      },
      'delivery-status': {
        label: 'حالة التوصيل',
        values: {
          Y8e087: 'تم التسليم',
          Hb4685: 'ملغي',
          Gf1d41: 'بانتظار الموافقة',
          S7a617: 'ملغي',
          Q568ef: 'تم التسليم',
        },
      },
    };

    function getAppliedColumns() {
      var raw = localStorage_get(STORAGE_KEY);
      if (!raw) return [];
      try {
        var parsed = JSON.parse(raw);
        return Array.isArray(parsed) ? parsed : [];
      } catch (e) {
        return [];
      }
    }

    function saveAppliedColumns(order) {
      localStorage_set(STORAGE_KEY, JSON.stringify(order));
    }

    function removeAllExtraColumns() {
      table.querySelectorAll('.extra-col').forEach(function (el) {
        el.remove();
      });
    }

    function applyColumns(order) {
      removeAllExtraColumns();

      var headRow = table.querySelector('thead tr');
      var actionsTh = headRow.querySelector('th:last-child');
      var bodyRows = table.querySelectorAll('tbody tr');

      order.forEach(function (key) {
        var def = COLUMN_DATA[key];
        if (!def) return;

        var th = document.createElement('th');
        th.className = 'extra-col';
        th.setAttribute('data-col', key);
        th.textContent = def.label;
        headRow.insertBefore(th, actionsTh);

        bodyRows.forEach(function (row) {
          var rowKey = row.getAttribute('data-row-key');
          var actionsTd = row.querySelector('td:last-child');
          var td = document.createElement('td');
          td.className = 'extra-col' + (def.cls ? ' ' + def.cls : '');
          td.setAttribute('data-col', key);
          td.textContent = (def.values && def.values[rowKey]) || 'ï¿½';
          row.insertBefore(td, actionsTd);
        });
      });

      // Keep an already-initialized DataTable (if any) in sync
      if (
        typeof jQuery !== 'undefined' &&
        jQuery.fn.DataTable &&
        jQuery.fn.DataTable.isDataTable(table)
      ) {
        jQuery(table).DataTable().columns.adjust();
      }
    }

    function syncCheckboxesToApplied() {
      var applied = getAppliedColumns();
      checkboxes.forEach(function (cb) {
        cb.checked = applied.indexOf(cb.value) !== -1;
      });
    }

    if (applyBtn) {
      applyBtn.addEventListener('click', function () {
        var order = [];
        checkboxes.forEach(function (cb) {
          if (cb.checked) order.push(cb.value);
        });

        applyColumns(order);
        saveAppliedColumns(order);

        bootstrap.Modal.getOrCreateInstance(modalEl).hide();
      });
    }

    // Reset the checkboxes to reflect the currently-applied columns
    // every time the modal is opened (so an unconfirmed selection
    // that was closed via "إلغاء" or the backdrop doesn't stick).
    modalEl.addEventListener('show.bs.modal', syncCheckboxesToApplied);

    // Re-apply whatever was saved from a previous visit
    var initiallyApplied = getAppliedColumns();
    if (initiallyApplied.length) {
      applyColumns(initiallyApplied);
    }
  }

  // ---------------------------------------------------------
  // Tracking Map Modal ï¿½ Late Delivery Reservations
  // ---------------------------------------------------------
  function initTrackingMapModal() {
    var modalEl = document.getElementById('trackingMapModal');
    var trackingButtons = document.querySelectorAll('.tracking-map-btn');
    var mapElement = document.getElementById('trackingMap');
    var selectedLatInput = document.getElementById('selectedTrackingLat');
    var selectedLngInput = document.getElementById('selectedTrackingLng');
    var confirmLocationBtn = document.getElementById('confirmTrackingLocationBtn');
    var map = null;
    var markers = [];
    var selectedMarker = null;
    var selectedLatLng = null;
    var defaultSelectedLat = 24.725;
    var defaultSelectedLng = 46.685;

    if (!modalEl || !trackingButtons.length || !mapElement) return;

    function updateSelectedLocation(latlng) {
      selectedLatLng = latlng;

      if (selectedLatInput) selectedLatInput.value = latlng.lat.toFixed(6);
      if (selectedLngInput) selectedLngInput.value = latlng.lng.toFixed(6);

      if (!map || typeof L === 'undefined') return;

      if (!selectedMarker) {
        selectedMarker = L.marker(latlng, {
          draggable: true,
          icon: L.divIcon({
            className: 'custom-marker-icon selected-location-marker',
            html: '<div style="background: #16a34a; width: 28px; height: 28px; border-radius: 50% 50% 50% 0; border: 3px solid white; box-shadow: 0 3px 10px rgba(0,0,0,0.3); transform: rotate(-45deg); display: flex; align-items: center; justify-content: center;"><span style="width: 8px; height: 8px; background: white; border-radius: 50%; display: block;"></span></div>',
            iconSize: [28, 28],
            iconAnchor: [14, 28],
          }),
        }).addTo(map);

        selectedMarker.on('dragend', function () {
          updateSelectedLocation(selectedMarker.getLatLng());
        });
      } else {
        selectedMarker.setLatLng(latlng);
      }

      selectedMarker.bindPopup('<b>الموقع المحدد</b>');
    }

    function setDefaultSelectedLocation() {
      if (!map || typeof L === 'undefined') return;
      updateSelectedLocation(L.latLng(defaultSelectedLat, defaultSelectedLng));
    }

    function resetSelectedLocation() {
      selectedLatLng = null;
      if (selectedLatInput) selectedLatInput.value = '';
      if (selectedLngInput) selectedLngInput.value = '';

      if (map && selectedMarker) {
        map.removeLayer(selectedMarker);
      }
      selectedMarker = null;
    }

    // Initialize map when modal is shown
    modalEl.addEventListener('shown.bs.modal', function () {
      if (!map && typeof L !== 'undefined') {
        // Center on Riyadh, Saudi Arabia
        map = L.map('trackingMap').setView([24.7136, 46.6753], 12);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(map);

        map.on('click', function (event) {
          updateSelectedLocation(event.latlng);
        });

        // Invalidate size after modal is shown
        setTimeout(function () {
          map.invalidateSize();
          setDefaultSelectedLocation();
        }, 300);
      } else if (map) {
        setTimeout(function () {
          map.invalidateSize();
          setDefaultSelectedLocation();
        }, 300);
      }
    });

    // Clear markers when modal is hidden
    modalEl.addEventListener('hidden.bs.modal', function () {
      if (map) {
        markers.forEach(function (marker) {
          map.removeLayer(marker);
        });
        markers = [];
      }

      resetSelectedLocation();
    });

    if (confirmLocationBtn) {
      confirmLocationBtn.addEventListener('click', function () {
        if (!selectedLatLng) {
          return;
        }
      });
    }

    // Handle tracking button clicks
    trackingButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var bookingRef = btn.getAttribute('data-booking-ref');
        var driver = btn.getAttribute('data-driver');
        var location = btn.getAttribute('data-location');
        var destination = btn.getAttribute('data-destination');

        // Update modal content
        document.getElementById('modalBookingRef').textContent = bookingRef;
        document.getElementById('modalDriverName').textContent = driver;
        document.getElementById('modalCurrentLocation').textContent = location;
        document.getElementById('modalDestination').textContent = destination;

        // Show modal
        var bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
        bsModal.show();

        // Add markers after modal is shown
        setTimeout(function () {
          if (map && typeof L !== 'undefined') {
            // Clear existing markers
            markers.forEach(function (marker) {
              map.removeLayer(marker);
            });
            markers = [];

            // Sample coordinates for Riyadh locations (in production, use real coordinates)
            var locationCoords = [24.7136, 46.6753]; // Default to Riyadh center
            var destCoords = [24.725, 46.685]; // Slightly offset for destination
            defaultSelectedLat = destCoords[0];
            defaultSelectedLng = destCoords[1];

            // Add current location marker (blue)
            var locationMarker = L.marker(locationCoords, {
              icon: L.divIcon({
                className: 'custom-marker-icon',
                html: '<div style="background: #1f7ffa; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>',
                iconSize: [20, 20],
                iconAnchor: [10, 10],
              }),
            }).addTo(map);
            locationMarker.bindPopup('<b>الموقع الحالي</b><br>' + location);
            markers.push(locationMarker);

            // Add destination marker (red)
            var destMarker = L.marker(destCoords, {
              icon: L.divIcon({
                className: 'custom-marker-icon',
                html: '<div style="background: #ef4444; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>',
                iconSize: [20, 20],
                iconAnchor: [10, 10],
              }),
            }).addTo(map);
            destMarker.bindPopup('<b>الوجهة</b><br>' + destination);
            markers.push(destMarker);

            // Draw route line
            var routeLine = L.polyline([locationCoords, destCoords], {
              color: '#1f7ffa',
              weight: 4,
              opacity: 0.7,
              dashArray: '10, 10',
            }).addTo(map);
            markers.push(routeLine);

            // Fit map to show both markers
            map.fitBounds(L.latLngBounds(locationCoords, destCoords), { padding: [50, 50] });
            setDefaultSelectedLocation();
          }
        }, 400);
      });
    });
  }

  // Edit Subscription Modal functionality
  var editSubscriptionModal = document.getElementById('editSubscriptionModal');
  var editSubscriptionForm = document.getElementById('editSubscriptionForm');
  var saveSubscriptionBtn = document.getElementById('saveSubscriptionBtn');

  if (editSubscriptionModal && editSubscriptionForm) {
    var editSubscriptionModalInstance = new bootstrap.Modal(editSubscriptionModal);

    // Handle edit button clicks
    document.querySelectorAll('[data-bs-target="#editSubscriptionModal"]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        // Close the dropdown
        var dropdown = this.closest('.action-menu-dropdown');
        if (dropdown) {
          dropdown.classList.remove('is-visible');
        }

        // Get the row data
        var row = this.closest('tr');
        if (row) {
          var rowId = row.getAttribute('data-row-id');
          var cells = row.querySelectorAll('td');

          // Extract data from the row
          var bookingRef = cells[0].textContent.trim();
          var customerName = cells[1]
            .querySelector('.cell-customer-stack__name')
            .textContent.trim();
          var company = cells[2].querySelector('.cell-company').textContent.trim();
          var period = cells[3].textContent.trim();
          var status = cells[4].querySelector('.badge').textContent.trim();
          var active = cells[5].querySelector('.badge').textContent.trim();

          // Populate the form
          document.getElementById('editSubscriptionRef').value = bookingRef;
          document.getElementById('editSubscriptionCustomer').value = customerName;
          document.getElementById('editSubscriptionCompany').value = company;
          document.getElementById('editSubscriptionPeriod').value = period;
          document.getElementById('editSubscriptionStatus').value = status;
          document.getElementById('editSubscriptionActive').value = active;

          // Store the row ID for saving
          editSubscriptionForm.setAttribute('data-row-id', rowId);

          // Open the modal
          editSubscriptionModalInstance.show();
        }
      });
    });

    // Handle save button
    if (saveSubscriptionBtn) {
      saveSubscriptionBtn.addEventListener('click', function () {
        var rowId = editSubscriptionForm.getAttribute('data-row-id');
        var period = document.getElementById('editSubscriptionPeriod').value;
        var status = document.getElementById('editSubscriptionStatus').value;
        var active = document.getElementById('editSubscriptionActive').value;

        // Find and update the row
        var row = document.querySelector('tr[data-row-id="' + rowId + '"]');
        if (row) {
          var cells = row.querySelectorAll('td');

          // Update period
          cells[3].textContent = period;

          // Update status badge
          var statusBadge = cells[4].querySelector('.badge');
          statusBadge.textContent = status;
          statusBadge.className = 'badge ' + getStatusBadgeClass(status);

          // Update active badge
          var activeBadge = cells[5].querySelector('.badge');
          activeBadge.textContent = active;
          activeBadge.className = 'badge ' + getActiveBadgeClass(active);

          // Close the modal
          editSubscriptionModalInstance.hide();
        }
      });
    }

    function getStatusBadgeClass(status) {
      switch (status) {
        case 'مقبول':
          return 'bg-success';
        case 'مرفوض':
          return 'bg-danger';
        case 'معلق':
          return 'bg-warning';
        case 'ملغي':
          return 'bg-secondary';
        default:
          return 'bg-primary';
      }
    }

    function getActiveBadgeClass(active) {
      return active === 'نعم' ? 'bg-success' : 'bg-danger';
    }
  }

  var dashboardRoot = document.querySelector('.dashboard-ar');
  if (dashboardRoot) {
    initDashboardFilters();
    initDayFilterPills();
    initScheduledReservationFilters();
    initReservationViewTabs();
    initBranchSelect();
    initDateRangeModal();
    initDateTriggerBinding();
    initGaugeCharts();
    initServiceTypeChart();
    initDataTables();
    initFilterModal();
    initAddColumnsModal();
    initMapToggle();
    initTrackingMapModal();

    // Set default date range to today
    var today = new Date();
    setAppliedRange(today, today);
  }

  // ---------------------------------------------------------
  // Reservation extension summary, calculation and validation
  // ---------------------------------------------------------
  window.ExtensionCalculator = (function () {
    var DAY_MS = 24 * 60 * 60 * 1000;
    var MAX_EXTENSION_DAYS = 90;

    // Two extension flows: the customer pays through a link we send them, or
    // the branch employee adds the days and collects cash at the office. The
    // cash flow is recorded under its own type so the invoice and the
    // financial settlement can tell the two apart.
    // `shortLabel` is what the summary tile shows — the full `label` wraps
    // badly in that narrow card.
    var EXTENSION_TYPES = {
      link: {
        label: 'تمديد برابط الدفع (العميل)',
        shortLabel: 'برابط الدفع',
        paymentLabel: 'رابط دفع إلكتروني',
        hint: 'يتم إرسال رابط الدفع إلى العميل لإتمام التمديد.',
      },
      cash: {
        label: 'تمديد نقدي (عن طريق المكتب)',
        shortLabel: 'نقدي عن طريق المكتب',
        paymentLabel: 'نقدي',
        hint: 'يضيف موظف الفرع أيام التمديد ويحصّل المبلغ نقدًا، ويُضاف إلى فاتورة الحجز.',
      },
    };
    var DEFAULT_TYPE = 'link';

    var dateInput;
    var errorMessage;
    var daysOutput;
    var dateOutput;
    var amountOutput;
    var dailyRateOutput;
    var typeSelect;
    var typeHintText;
    var daysField;
    var daysInput;
    var typeOutput;
    var paymentOutput;

    function parseDateOnly(value) {
      var match = String(value || '').match(/(\d{4})-(\d{2})-(\d{2})/);
      if (!match) return null;

      return new Date(Date.UTC(Number(match[1]), Number(match[2]) - 1, Number(match[3])));
    }

    function formatDateOnly(date) {
      return date.toISOString().slice(0, 10);
    }

    function addDays(value, days) {
      var date = parseDateOnly(value);
      if (!date) return '';
      date.setUTCDate(date.getUTCDate() + days);
      return formatDateOnly(date);
    }

    function differenceInDays(fromValue, toValue) {
      var fromDate = parseDateOnly(fromValue);
      var toDate = parseDateOnly(toValue);
      if (!fromDate || !toDate) return 0;
      return Math.round((toDate.getTime() - fromDate.getTime()) / DAY_MS);
    }

    function normalizeDateText(value) {
      var match = String(value || '').match(/\d{4}-\d{2}-\d{2}/);
      return match ? match[0] : '';
    }

    function formatAmount(value) {
      return Number(value || 0).toFixed(2);
    }

    function cacheElements() {
      dateInput = document.getElementById('newReturnDate');
      errorMessage = document.getElementById('extensionErrorMessage');
      daysOutput = document.getElementById('extensionSummaryDays');
      dateOutput = document.getElementById('extensionSummaryDate');
      amountOutput = document.getElementById('extensionSummaryAmount');
      dailyRateOutput = document.getElementById('extensionDailyRate');
      typeSelect = document.getElementById('extensionType');
      typeHintText = document.getElementById('extensionTypeHintText');
      daysField = document.getElementById('extensionDaysField');
      daysInput = document.getElementById('extensionDaysInput');
      typeOutput = document.getElementById('extensionSummaryType');
      paymentOutput = document.getElementById('extensionSummaryPayment');
    }

    function getType() {
      var value = typeSelect ? typeSelect.value : DEFAULT_TYPE;
      return EXTENSION_TYPES[value] ? value : DEFAULT_TYPE;
    }

    function clearError() {
      if (!errorMessage || !dateInput) return;
      errorMessage.textContent = '';
      errorMessage.style.display = 'none';
      dateInput.classList.remove('is-invalid');
      dateInput.removeAttribute('aria-invalid');
    }

    function showError(message) {
      if (!errorMessage || !dateInput) return;
      errorMessage.textContent = message;
      errorMessage.style.display = 'block';
      dateInput.classList.add('is-invalid');
      dateInput.setAttribute('aria-invalid', 'true');
    }

    function getState() {
      if (!dateInput) cacheElements();

      var currentReturnDate = dateInput ? dateInput.dataset.currentReturnDate : '';
      var newReturnDate = dateInput ? dateInput.value : '';
      var dailyRate = Number(dateInput ? dateInput.dataset.dailyRate : 0) || 0;
      var days = differenceInDays(currentReturnDate, newReturnDate);
      var type = getType();
      var typeConfig = EXTENSION_TYPES[type];

      return {
        valid: Boolean(newReturnDate && currentReturnDate && days > 0),
        date: newReturnDate,
        days: days,
        amount: days > 0 ? days * dailyRate : 0,
        dailyRate: dailyRate,
        currentReturnDate: currentReturnDate,
        type: type,
        typeLabel: typeConfig.label,
        typeShortLabel: typeConfig.shortLabel,
        paymentMethod: type === 'cash' ? 'cash' : 'link',
        paymentLabel: typeConfig.paymentLabel,
      };
    }

    function render(showValidation) {
      var state = getState();

      if (daysOutput) daysOutput.textContent = state.days > 0 ? state.days + ' أيام' : '-';
      if (dateOutput) dateOutput.textContent = state.date || '-';
      if (amountOutput) {
        amountOutput.textContent = state.days > 0 ? formatAmount(state.amount) + ' ' : '-';
      }
      if (typeOutput) typeOutput.textContent = state.typeShortLabel;
      if (paymentOutput) paymentOutput.textContent = state.paymentLabel;

      if (state.valid) {
        clearError();
      } else if (showValidation && !state.date) {
        showError('يرجى اختيار تاريخ التسليم الجديد');
      } else if (showValidation) {
        showError('يجب أن يكون تاريخ التمديد بعد تاريخ التسليم الحالي');
      }

      return state;
    }

    // The date input stays the single source of truth. In the cash flow the
    // employee types the number of days instead, so the two fields are kept in
    // sync in both directions.
    function syncDaysFromDate() {
      if (!daysInput || !dateInput) return;
      var days = differenceInDays(dateInput.dataset.currentReturnDate, dateInput.value);
      daysInput.value = days > 0 ? days : '';
    }

    function syncDateFromDays() {
      if (!daysInput || !dateInput) return;

      var days = parseInt(daysInput.value, 10);
      if (isNaN(days) || days < 1) {
        dateInput.value = '';
        return;
      }

      if (days > MAX_EXTENSION_DAYS) {
        days = MAX_EXTENSION_DAYS;
        daysInput.value = days;
      }

      dateInput.value = addDays(dateInput.dataset.currentReturnDate, days);
    }

    function applyType() {
      var type = getType();
      var typeConfig = EXTENSION_TYPES[type];

      if (typeHintText) typeHintText.textContent = typeConfig.hint;
      if (daysField) daysField.style.display = type === 'cash' ? '' : 'none';
      if (type === 'cash') syncDaysFromDate();
    }

    function init() {
      cacheElements();
      if (!dateInput || dateInput.dataset.extensionCalculatorWired) return;
      dateInput.dataset.extensionCalculatorWired = 'true';
      dateInput.addEventListener('change', function () {
        syncDaysFromDate();
        render(true);
      });

      if (typeSelect) {
        typeSelect.addEventListener('change', function () {
          applyType();
          render(false);
        });
      }

      if (daysInput) {
        daysInput.addEventListener('input', function () {
          syncDateFromDays();
          render(false);
        });
        daysInput.addEventListener('change', function () {
          syncDateFromDays();
          render(true);
        });
      }
    }

    function reset(options) {
      init();
      if (!dateInput) return null;

      var settings = options || {};
      var currentReturnDate = normalizeDateText(settings.currentReturnDate);
      var dailyRate = Number(settings.dailyRate) || 203.26;

      dateInput.value = '';
      dateInput.dataset.currentReturnDate = currentReturnDate;
      dateInput.dataset.dailyRate = dailyRate;
      dateInput.min = addDays(currentReturnDate, 1);
      dateInput.max = addDays(currentReturnDate, MAX_EXTENSION_DAYS);
      if (dailyRateOutput) {
        dailyRateOutput.textContent = formatAmount(dailyRate) + ' ر.س / يومي';
      }

      // Every booking starts on the default (payment link) flow.
      if (typeSelect) typeSelect.value = settings.type || DEFAULT_TYPE;
      if (daysInput) daysInput.value = '';
      applyType();

      clearError();
      return render(false);
    }

    function validate() {
      var state = render(true);
      if (!state.valid && dateInput) dateInput.focus();
      return state.valid ? state : null;
    }

    function getRowBookingData(row, fallbackPeriodDays) {
      var dateElements = row ? row.querySelectorAll('.cell-period__dates .ltr-num') : [];
      var dates = [];

      var dataPickupDate = row ? normalizeDateText(row.dataset.pickupDate) : '';
      var dataReturnDate = row ? normalizeDateText(row.dataset.returnDate) : '';

      if (dataPickupDate || dataReturnDate) {
        var dataPickup = dataPickupDate || dataReturnDate;
        var dataReturn = dataReturnDate || dataPickupDate;

        dates = [dataPickup, dataReturn].filter(function (date, index, values) {
          return date && values.indexOf(date) === index;
        });
      }

      if (!dates.length) {
        Array.prototype.forEach.call(dateElements, function (element) {
          var date = normalizeDateText(element.textContent);
          if (date) dates.push(date);
        });
      }

      if (!dates.length && row && row.cells[4]) {
        dates = row.cells[4].textContent.match(/\d{4}-\d{2}-\d{2}/g) || [];
      }

      dates.sort();

      var fallbackDays = Number(fallbackPeriodDays) || 1;
      var pickupDate = dates[0] || '';
      var returnDate = dates[dates.length - 1] || '';
      // A single date in delivery/return rows is the actual delivery date.
      // Keep it as the extension start date instead of adding a day to it.
      if (dates.length === 1) {
        returnDate = pickupDate;
      }

      var periodDays = pickupDate && returnDate ? differenceInDays(pickupDate, returnDate) : 0;
      if (periodDays < 1) periodDays = fallbackDays;

      var carName = '';
      if (row) {
        var table = row.closest('table');
        var headers = table ? table.querySelectorAll('thead th') : [];
        Array.prototype.some.call(headers, function (header, index) {
          if (header.textContent.trim().indexOf('سيارة') === -1) return false;
          carName = row.cells[index] ? row.cells[index].textContent.trim() : '';
          return true;
        });
      }

      return {
        pickupDate: pickupDate,
        returnDate: returnDate,
        periodDays: periodDays,
        carName: carName,
      };
    }

    function prepareFromRow(row, fallbackPeriodDays) {
      var data = getRowBookingData(row, fallbackPeriodDays);
      var pickupOutput = document.getElementById('extendPickupDate');
      var returnOutput = document.getElementById('extendReturnDate');
      var periodOutput = document.getElementById('extendPeriod');
      var carOutput = document.getElementById('extendCar');

      if (pickupOutput) pickupOutput.textContent = data.pickupDate || '-';
      if (returnOutput) returnOutput.textContent = data.returnDate || '-';
      if (periodOutput) periodOutput.textContent = data.periodDays + ' أيام';
      if (carOutput) {
        carOutput.textContent = data.carName || '-';
        var carCard = carOutput.closest('.booking-detail-item');
        if (carCard) carCard.style.display = data.carName ? '' : 'none';
      }

      reset({ currentReturnDate: data.returnDate, dailyRate: 203.26 });
      return data;
    }

    init();

    return {
      getState: getState,
      getType: getType,
      prepareFromRow: prepareFromRow,
      reset: reset,
      validate: validate,
    };
  })();

  // ---------------------------------------------------------
  // Reservation closure summary, validation and row update
  // ---------------------------------------------------------
  window.CloseReservationForm = (function () {
    var dateInput;
    var errorMessage;
    var earlyReturnSummary;
    var unusedDaysOutput;
    var dailyPriceOutput;
    var refundInput;
    var agreedEndDate = '';
    var dailyPrice = 203.26;

    function normalizeDateText(value) {
      var match = String(value || '').match(/\d{4}-\d{2}-\d{2}/);
      return match ? match[0] : '';
    }

    function getToday() {
      var today = new Date();
      var year = today.getFullYear();
      var month = ('0' + (today.getMonth() + 1)).slice(-2);
      var day = ('0' + today.getDate()).slice(-2);
      return year + '-' + month + '-' + day;
    }

    function differenceInDays(fromValue, toValue) {
      var fromParts = String(fromValue || '').split('-');
      var toParts = String(toValue || '').split('-');
      if (fromParts.length !== 3 || toParts.length !== 3) return 0;

      var fromDate = Date.UTC(fromParts[0], Number(fromParts[1]) - 1, fromParts[2]);
      var toDate = Date.UTC(toParts[0], Number(toParts[1]) - 1, toParts[2]);
      return Math.max(0, Math.round((toDate - fromDate) / (24 * 60 * 60 * 1000)));
    }

    function getPeriodDates(row) {
      var periodCell = row && row.cells[4] ? row.cells[4] : null;
      var matches = periodCell
        ? String(periodCell.textContent || '').match(/\d{4}-\d{2}-\d{2}/g) || []
        : [];

      return matches.sort();
    }

    function getDailyPrice(row) {
      var priceElement = row ? row.querySelector('.cell-daily-price') : null;
      var rawValue = row ? row.dataset.dailyPrice : '';
      var parsedValue = Number(
        rawValue || String(priceElement ? priceElement.textContent : '').replace(/[^\d.]/g, ''),
      );
      return parsedValue > 0 ? parsedValue : 203.26;
    }

    function ensureEnhancedFields() {
      var modalBody = dateInput ? dateInput.closest('.modal-body') : null;
      if (!modalBody) return;

      var enhancements = document.getElementById('closeReservationEnhancements');
      if (!enhancements) {
        enhancements = document.createElement('div');
        enhancements.id = 'closeReservationEnhancements';
        enhancements.innerHTML =
          '<div class="alert alert-info mt-3 d-none" id="closeEarlyReturnSummary">' +
          '<div class="d-flex align-items-center justify-content-between gap-2 mb-3">' +
          '<strong><i class="bi bi-arrow-return-left"></i> تسليم مبكر</strong>' +
          '<span class="badge bg-info text-dark">تسليم مبكر</span></div>' +
          '<div class="row g-3">' +
          '<div class="col-12 col-md-4"><span class="d-block text-muted small">الأيام غير المستخدمة</span>' +
          '<strong class="ltr-num" id="closeUnusedDays">0</strong></div>' +
          '<div class="col-12 col-md-4"><span class="d-block text-muted small">السعر اليومي</span>' +
          '<strong class="ltr-num" id="closeDailyPrice">0.00 </strong></div>' +
          '</div></div>';
        modalBody.appendChild(enhancements);
      }

      earlyReturnSummary = document.getElementById('closeEarlyReturnSummary');
      unusedDaysOutput = document.getElementById('closeUnusedDays');
      dailyPriceOutput = document.getElementById('closeDailyPrice');
      refundInput = document.getElementById('closeRefundAmount');
    }

    function cacheElements() {
      dateInput = document.getElementById('closeReservationDate');
      errorMessage = document.getElementById('closeReservationErrorMessage');
      ensureEnhancedFields();
    }

    function updateEarlyReturn() {
      if (!dateInput || !earlyReturnSummary) return;

      var isEarlyReturn = Boolean(
        dateInput.value && agreedEndDate && dateInput.value < agreedEndDate,
      );
      var unusedDays = isEarlyReturn ? differenceInDays(dateInput.value, agreedEndDate) : 0;
      var refundAmount = unusedDays * dailyPrice;

      earlyReturnSummary.classList.toggle('d-none', !isEarlyReturn);
      unusedDaysOutput.textContent = unusedDays;
      dailyPriceOutput.textContent = dailyPrice.toFixed(2) + ' ';
      if (refundInput) {
        refundInput.value = isEarlyReturn ? refundAmount.toFixed(2) : '';
      }
    }

    function clearError() {
      if (!dateInput || !errorMessage) return;
      errorMessage.textContent = '';
      errorMessage.style.display = 'none';
      dateInput.classList.remove('is-invalid');
      dateInput.removeAttribute('aria-invalid');
    }

    function showError(message) {
      if (!dateInput || !errorMessage) return;
      errorMessage.textContent = message;
      errorMessage.style.display = 'block';
      dateInput.classList.add('is-invalid');
      dateInput.setAttribute('aria-invalid', 'true');
    }

    function setText(id, value) {
      var element = document.getElementById(id);
      if (element) element.textContent = value || '-';
    }

    function prepareFromRow(row, bookingRef) {
      cacheElements();
      if (!dateInput) return null;

      var periodDates = getPeriodDates(row);
      var pickupDate =
        periodDates.length > 1
          ? periodDates[0]
          : normalizeDateText(row ? row.dataset.pickupDate : '');
      var today = getToday();
      var customer = row ? row.querySelector('.cell-customer-stack__name') : null;
      var reference = bookingRef || 'غير محدد';
      var periodDays = pickupDate ? differenceInDays(pickupDate, today) : 0;
      agreedEndDate = periodDates.length ? periodDates[periodDates.length - 1] : '';
      dailyPrice = getDailyPrice(row);

      setText('closeBookingRefHeader', reference);
      setText('closeBookingRef', reference);
      setText('closeBookingCustomer', customer ? customer.textContent.trim() : '-');
      setText('closeBookingPeriod', pickupDate ? periodDays + ' يومًا' : '-');

      dateInput.value = today;
      dateInput.min = today;
      dateInput.max = today;
      dateInput.readOnly = true;
      dateInput.setAttribute('aria-readonly', 'true');
      dateInput.dataset.lockedDate = today;
      dateInput.dataset.pickupDate = pickupDate;
      dateInput.dataset.agreedEndDate = agreedEndDate;
      clearError();
      updateEarlyReturn();

      if (!dateInput.dataset.closeReservationWired) {
        dateInput.dataset.closeReservationWired = 'true';
        dateInput.addEventListener('change', function () {
          validate(false);
          updateEarlyReturn();
        });
      }

      return { pickupDate: pickupDate, today: today };
    }

    function validate(focusOnError) {
      if (!dateInput) cacheElements();
      if (!dateInput) return null;

      var value = dateInput.value;
      var pickupDate = dateInput.dataset.pickupDate || '';
      var today = dateInput.dataset.lockedDate || getToday();
      var message = '';

      if (!value) {
        message = 'يرجى اختيار تاريخ الإغلاق';
      } else if (value !== today) {
        message = 'يجب أن يكون تاريخ الإغلاق هو تاريخ اليوم';
      } else if (pickupDate && value < pickupDate) {
        message = 'لا يمكن أن يكون تاريخ الإغلاق قبل تاريخ الاستلام';
      } else if (value > today) {
        message = 'لا يمكن أن يكون تاريخ الإغلاق في المستقبل';
      }

      if (message) {
        showError(message);
        if (focusOnError !== false) dateInput.focus();
        return null;
      }

      clearError();

      return value;
    }

    function getState() {
      if (!dateInput) cacheElements();

      var unusedDays =
        dateInput.value && agreedEndDate && dateInput.value < agreedEndDate
          ? differenceInDays(dateInput.value, agreedEndDate)
          : 0;

      return {
        closeDate: dateInput.value,
        isEarlyReturn: unusedDays > 0,
        unusedDays: unusedDays,
        dailyPrice: dailyPrice,
        refundAmount: Number(refundInput ? refundInput.value || 0 : 0),
      };
    }

    function findStatusCell(row) {
      var table = row ? row.closest('table') : null;
      var headers = table ? table.querySelectorAll('thead th') : [];
      var statusCell = null;

      Array.prototype.some.call(headers, function (header, index) {
        var headerText = header.textContent.trim();
        if (headerText !== 'حالة' && headerText !== 'الحالة') return false;
        statusCell = row.cells[index] || null;
        return true;
      });

      return statusCell || (row && row.cells.length > 1 ? row.cells[row.cells.length - 2] : null);
    }

    function updateRow(row, state) {
      if (!row || !state) return;

      var nextStatus = 'مغلق';

      row.dataset.status = nextStatus;
      row.dataset.closeDate = state.closeDate || '';
      row.dataset.refundAmount = Number(state.refundAmount || 0).toFixed(2);

      var statusCell = findStatusCell(row);
      if (statusCell) {
        statusCell.textContent = '';

        var badge = document.createElement('span');
        badge.className = 'badge bg-secondary';
        badge.textContent = nextStatus;
        statusCell.appendChild(badge);
      }

      var closeDateCell = row.querySelector('.cell-close-date');
      if (closeDateCell) {
        closeDateCell.textContent = state.closeDate;
        closeDateCell.dataset.closeDate = state.closeDate;
      }

      row
        .querySelectorAll(
          '[data-action="extend"], [data-action="suspend"], [data-action="suspension"], [data-action="close"], [data-action="close-suspended"], [data-action="edit-suspension"]',
        )
        .forEach(function (action) {
          var actionItem = action.closest('li') || action;
          actionItem.style.display = 'none';
        });

      return state;
    }

    function getSuccessContent(reference, entityLabel) {
      var state = getState();
      var entity = entityLabel || 'الحجز';

      return {
        title: 'تم إغلاق ' + entity + ' بنجاح',
        message:
          'تم إغلاق ' +
          entity +
          ' ' +
          reference +
          ' بتاريخ ' +
          state.closeDate +
          (state.isEarlyReturn
            ? '، والمبلغ المسترد للعميل ' + state.refundAmount.toFixed(2) + ' ر.س'
            : ''),
      };
    }

    return {
      getState: getState,
      getSuccessContent: getSuccessContent,
      prepareFromRow: prepareFromRow,
      updateRow: updateRow,
      validate: validate,
    };
  })();

  // ---------------------------------------------------------
  // Reservation suspension form, attachment and row update
  // ---------------------------------------------------------
  window.SuspendReservationForm = (function () {
    var MAX_FILE_SIZE = 5 * 1024 * 1024;
    var form;
    var reasonInput;
    var otherReasonContainer;
    var otherReasonInput;
    var dateInput;
    var attachmentInput;
    var noteInput;
    var amountInput;
    var amountContainer;
    var amountLabel;
    var attachmentLabel;
    var noteLabel;
    var noteRequired;
    var noteOptional;
    var attachmentRequired;
    var filePreview;
    var fileName;
    var fileActions;
    var previewFileButton;
    var removeFileButton;
    var noteCounter;
    var existingFileName = '';
    var existingFileType = '';
    var existingFileSrc = '';
    var selectedFileUrl = '';

    function cacheElements() {
      form = document.getElementById('suspensionForm');
      reasonInput = document.getElementById('suspensionReason');
      otherReasonContainer = document.getElementById('suspensionOtherReasonContainer');
      otherReasonInput = document.getElementById('suspensionOtherReason');
      dateInput = document.getElementById('suspensionDate');
      attachmentInput = document.getElementById('suspensionAttachment');
      noteInput = document.getElementById('suspensionNote');
      amountInput = document.getElementById('suspensionAmount');
      amountContainer = document.getElementById('suspensionAmountContainer');
      amountLabel = document.getElementById('suspensionAmountLabel');
      attachmentLabel = document.getElementById('suspensionAttachmentLabel');
      noteLabel = document.getElementById('suspensionNoteLabel');
      noteRequired = document.getElementById('suspensionNoteRequired');
      noteOptional = document.getElementById('suspensionNoteOptional');
      attachmentRequired = document.getElementById('suspensionAttachmentRequired');
      filePreview = document.getElementById('suspensionFilePreview');
      fileName = document.getElementById('suspensionFileName');
      fileActions = document.getElementById('suspensionFileActions');
      previewFileButton = document.getElementById('previewSuspensionFileBtn');
      removeFileButton = document.getElementById('removeSuspensionFileBtn');
      noteCounter = document.getElementById('suspensionNoteCounter');
    }

    function setText(id, value) {
      var element = document.getElementById(id);
      if (element) element.textContent = value || '-';
    }

    function getErrorElement(field) {
      return document.getElementById(field.id + 'Error');
    }

    function clearError(field) {
      if (!field) return;
      var error = getErrorElement(field);
      if (error) {
        error.textContent = '';
        error.style.display = 'none';
      }
      field.classList.remove('is-invalid');
      field.removeAttribute('aria-invalid');

      if (field === attachmentInput) {
        var dropzone = field.closest('.file-dropzone');
        if (dropzone) dropzone.classList.remove('border-danger');
      }
    }

    function showError(field, message) {
      if (!field) return;
      var error = getErrorElement(field);
      if (error) {
        error.textContent = message;
        error.style.display = 'block';
      }
      field.classList.add('is-invalid');
      field.setAttribute('aria-invalid', 'true');

      if (field === attachmentInput) {
        var dropzone = field.closest('.file-dropzone');
        if (dropzone) dropzone.classList.add('border-danger');
      }
    }

    function getReasonLabel(value) {
      if (value === 'financial') return 'مطالبة مالية';
      if (value === 'damage') return 'وجود تلفيات';
      if (value === 'other') return 'أخرى';
      return '';
    }

    function updateReasonState() {
      if (!reasonInput || !attachmentRequired) return;
      var isOtherReason = reasonInput.value === 'other';
      var isDamageReason = reasonInput.value === 'damage';
      var isFinancialReason = reasonInput.value === 'financial';
      var showAmount = isDamageReason || isFinancialReason;

      attachmentRequired.style.display = isDamageReason ? 'inline' : 'none';
      if (attachmentLabel) {
        attachmentLabel.textContent = isDamageReason ? 'مرفق إثبات التلفيات' : 'المرفق';
      }

      if (noteLabel) noteLabel.textContent = isDamageReason ? 'ملاحظة التلفيات' : 'الملاحظة';
      if (noteRequired) noteRequired.style.display = isDamageReason ? 'inline' : 'none';
      if (noteOptional) noteOptional.style.display = isDamageReason ? 'none' : 'inline';

      if (amountContainer) amountContainer.classList.toggle('d-none', !showAmount);
      if (amountLabel)
        amountLabel.textContent = isDamageReason ? 'المبلغ المستحق' : 'المبلغ المطلوب';
      if (!showAmount) clearError(amountInput);

      otherReasonContainer.style.display = isOtherReason ? 'block' : 'none';
      otherReasonInput.required = isOtherReason;

      if (!isOtherReason) clearError(otherReasonInput);
      if (reasonInput.value) clearError(reasonInput);
      if (reasonInput.value !== 'damage' || attachmentInput.files.length || existingFileName) {
        clearError(attachmentInput);
      }
      if (reasonInput.value !== 'damage' || noteInput.value.trim()) {
        clearError(noteInput);
      }
    }

    function revokeSelectedFileUrl() {
      if (!selectedFileUrl) return;
      URL.revokeObjectURL(selectedFileUrl);
      selectedFileUrl = '';
    }

    function showImagePreview(src, alt) {
      if (!filePreview) return;
      filePreview.textContent = '';
      var image = document.createElement('img');
      image.src = src;
      image.alt = alt;
      filePreview.appendChild(image);
    }

    function resetFileDisplay() {
      if (existingFileName) {
        if (fileName) fileName.textContent = existingFileName;
        if (filePreview) {
          if (existingFileType === 'image' && existingFileSrc) {
            showImagePreview(existingFileSrc, 'معاينة المرفق');
          } else {
            filePreview.innerHTML =
              existingFileType === 'pdf'
                ? '<i class="bi bi-file-earmark-pdf"></i>'
                : '<i class="bi bi-image"></i>';
          }
        }
        if (fileActions) fileActions.style.display = 'flex';
        if (previewFileButton) previewFileButton.disabled = !existingFileSrc;
        return;
      }

      if (fileName) fileName.textContent = 'PNG، JPG، WEBP أو PDF — بحد أقصى 5MB';
      if (filePreview) filePreview.innerHTML = '<i class="bi bi-image"></i>';
      if (fileActions) fileActions.style.display = 'none';
    }

    function updateFileDisplay() {
      var file = attachmentInput && attachmentInput.files ? attachmentInput.files[0] : null;
      if (!file) {
        resetFileDisplay();
        return;
      }

      revokeSelectedFileUrl();
      selectedFileUrl = URL.createObjectURL(file);
      if (fileName) fileName.textContent = file.name;
      if (filePreview) {
        if (file.type === 'application/pdf') {
          filePreview.innerHTML = '<i class="bi bi-file-earmark-pdf"></i>';
        } else {
          showImagePreview(selectedFileUrl, 'معاينة ' + file.name);
        }
      }
      if (fileActions) fileActions.style.display = 'flex';
      if (previewFileButton) previewFileButton.disabled = false;
      clearError(attachmentInput);
    }

    function removeFile() {
      revokeSelectedFileUrl();
      attachmentInput.value = '';
      existingFileName = '';
      existingFileType = '';
      existingFileSrc = '';
      resetFileDisplay();
      updateReasonState();
    }

    function previewFile() {
      var previewUrl = selectedFileUrl || existingFileSrc;
      if (previewUrl) window.open(previewUrl, '_blank', 'noopener');
    }

    function updateNoteCounter() {
      if (noteCounter && noteInput) noteCounter.textContent = noteInput.value.length + ' / 500';
    }

    function init() {
      cacheElements();
      if (!form || form.dataset.suspensionWired) return;
      form.dataset.suspensionWired = 'true';

      reasonInput.addEventListener('change', updateReasonState);
      otherReasonInput.addEventListener('input', function () {
        if (this.value.trim()) clearError(this);
      });
      dateInput.addEventListener('change', function () {
        if (this.value) clearError(this);
      });
      attachmentInput.addEventListener('change', updateFileDisplay);
      previewFileButton.addEventListener('click', previewFile);
      removeFileButton.addEventListener('click', removeFile);
      noteInput.addEventListener('input', function () {
        updateNoteCounter();
        if (this.value.trim()) clearError(this);
      });
      if (amountInput) {
        amountInput.addEventListener('input', function () {
          clearError(amountInput);
        });
      }
    }

    function getTodayValue() {
      var today = new Date();
      return (
        today.getFullYear() +
        '-' +
        ('0' + (today.getMonth() + 1)).slice(-2) +
        '-' +
        ('0' + today.getDate()).slice(-2)
      );
    }

    function prepareFromRow(row, bookingRef, options) {
      init();
      if (!form) return;

      var settings = options || {};
      selectedFileUrl = '';
      form.reset();
      [reasonInput, otherReasonInput, dateInput, attachmentInput, noteInput, amountInput].forEach(
        clearError,
      );
      existingFileName = settings.fileName || '';
      existingFileType = settings.fileType || '';
      existingFileSrc = settings.fileSrc || '';
      reasonInput.value = settings.reason || '';
      otherReasonInput.value = settings.otherReason || '';
      var lockedDate = settings.date || getTodayValue();
      dateInput.value = lockedDate;
      dateInput.min = lockedDate;
      dateInput.max = lockedDate;
      dateInput.readOnly = true;
      dateInput.setAttribute('aria-readonly', 'true');
      dateInput.dataset.lockedDate = lockedDate;
      noteInput.value = settings.note || '';
      if (amountInput) amountInput.value = settings.amount || '0';
      resetFileDisplay();
      updateReasonState();
      updateNoteCounter();

      var customer = row ? row.querySelector('.cell-customer-stack__name') : null;
      var period = row ? row.querySelector('.cell-period') : null;
      var reference = bookingRef || 'غير محدد';
      setText('suspensionBookingRefHeader', reference);
      setText('suspensionBookingRef', reference);
      setText('suspensionCustomer', customer ? customer.textContent.trim() : '-');
      setText('suspensionPeriod', period ? period.textContent.replace(/\s+/g, ' ').trim() : '-');
    }

    function prepareEditFromRow(row, bookingRef) {
      prepareFromRow(row, bookingRef, {
        reason: row ? row.dataset.suspensionReason : '',
        otherReason: row ? row.dataset.suspensionOtherReason : '',
        date: row ? row.dataset.suspensionDate : '',
        note: row ? row.dataset.suspensionNote : '',
        fileName: row ? row.dataset.suspensionAttachment : '',
        fileType: row ? row.dataset.suspensionAttachmentType : '',
        fileSrc: row
          ? row.dataset.suspensionAttachmentSrc ||
            (row.querySelector('[data-action="view-suspension-attachment"]')
              ? row.querySelector('[data-action="view-suspension-attachment"]').dataset.fileSrc
              : '')
          : '',
        amount: row ? row.dataset.suspensionAmount : '0',
      });
    }

    function isAllowedFile(file) {
      if (file.type.indexOf('image/') === 0 || file.type === 'application/pdf') return true;
      return /\.(png|jpe?g|gif|webp|bmp|svg|pdf)$/i.test(file.name);
    }

    function validate() {
      init();
      if (!form) return null;

      var firstInvalid = null;
      var file = attachmentInput.files ? attachmentInput.files[0] : null;
      var note = noteInput.value.trim();
      var otherReason = otherReasonInput.value.trim();
      var suspensionDate = dateInput.value;
      var isDamageReason = reasonInput.value === 'damage';
      var isFinancialReason = reasonInput.value === 'financial';
      var amount = Number(amountInput ? amountInput.value || 0 : 0);

      [reasonInput, otherReasonInput, dateInput, attachmentInput, noteInput, amountInput].forEach(
        clearError,
      );

      if (!reasonInput.value) {
        showError(reasonInput, 'يرجى اختيار سبب تعليق الحجز');
        firstInvalid = reasonInput;
      }

      if (reasonInput.value === 'other' && !otherReason) {
        showError(otherReasonInput, 'يرجى توضيح سبب تعليق الحجز');
        firstInvalid = firstInvalid || otherReasonInput;
      }

      if (!suspensionDate) {
        showError(dateInput, 'يرجى اختيار تاريخ التعليق');
        firstInvalid = firstInvalid || dateInput;
      } else if (suspensionDate !== dateInput.dataset.lockedDate) {
        showError(dateInput, 'لا يمكن تغيير تاريخ التعليق');
        firstInvalid = firstInvalid || dateInput;
      }

      if (isDamageReason && !file && !existingFileName) {
        showError(attachmentInput, 'يرجى إرفاق صورة أو ملف PDF يوضح التلفيات');
        firstInvalid = firstInvalid || attachmentInput;
      } else if (file && !isAllowedFile(file)) {
        showError(attachmentInput, 'نوع الملف غير مدعوم؛ ارفع صورة أو ملف PDF فقط');
        firstInvalid = firstInvalid || attachmentInput;
      } else if (file && file.size > MAX_FILE_SIZE) {
        showError(attachmentInput, 'حجم الملف يجب ألا يتجاوز 5MB');
        firstInvalid = firstInvalid || attachmentInput;
      }

      if (isDamageReason && !note) {
        showError(noteInput, 'يرجى كتابة ملاحظة التلفيات');
        firstInvalid = firstInvalid || noteInput;
      }

      if (amountInput && (isDamageReason || isFinancialReason)) {
        if (!amountInput.value || amount <= 0) {
          showError(
            amountInput,
            isDamageReason ? 'يرجى إدخال المبلغ المستحق' : 'يرجى إدخال المبلغ المطلوب',
          );
          firstInvalid = firstInvalid || amountInput;
        }
      }

      if (firstInvalid) {
        if (firstInvalid === attachmentInput) {
          var dropzone = attachmentInput.closest('.file-dropzone');
          if (dropzone) dropzone.focus();
        } else {
          firstInvalid.focus();
        }
        return null;
      }

      return {
        reason: reasonInput.value,
        reasonLabel: getReasonLabel(reasonInput.value),
        otherReason: otherReason,
        date: suspensionDate,
        note: note,
        fileName: file ? file.name : existingFileName,
        fileType: file ? (file.type === 'application/pdf' ? 'pdf' : 'image') : existingFileType,
        fileSrc: file ? selectedFileUrl : existingFileSrc,
        amount: isDamageReason || isFinancialReason ? amount : 0,
      };
    }

    function findStatusCell(row) {
      var table = row ? row.closest('table') : null;
      var headers = table ? table.querySelectorAll('thead th') : [];
      var statusCell = null;

      Array.prototype.some.call(headers, function (header, index) {
        var headerText = header.textContent.trim();
        if (headerText !== 'حالة' && headerText !== 'الحالة') return false;
        statusCell = row.cells[index] || null;
        return true;
      });

      return statusCell || (row && row.cells.length > 1 ? row.cells[row.cells.length - 2] : null);
    }

    function updateRow(row, state) {
      if (!row || !state) return;

      var statusCell = findStatusCell(row);
      if (statusCell) {
        statusCell.textContent = '';

        var badge = document.createElement('span');
        badge.className = 'badge bg-warning text-dark';
        badge.textContent = 'معلق';
        statusCell.appendChild(badge);
      }

      row.dataset.suspensionReason = state.reason;
      row.dataset.suspensionOtherReason = state.otherReason;
      row.dataset.suspensionDate = state.date;
      row.dataset.suspensionNote = state.note;
      row.dataset.suspensionAttachment = state.fileName;
      row.dataset.suspensionAttachmentType = state.fileType;
      row.dataset.suspensionAttachmentSrc = state.fileSrc || '';
      row.dataset.suspensionAmount = state.amount.toFixed(2);

      var reasonCell = row.querySelector('.cell-suspension-reason');
      if (reasonCell) {
        reasonCell.innerHTML =
          '<span class="badge ' +
          (state.reason === 'damage'
            ? 'bg-danger'
            : state.reason === 'other'
              ? 'bg-secondary'
              : 'bg-primary') +
          '">' +
          state.reasonLabel +
          '</span>';
        if (state.otherReason) reasonCell.title = state.otherReason;
      }

      var amountCell = row.querySelector('.cell-suspension-amount');
      if (amountCell) amountCell.textContent = state.amount.toFixed(2) + ' ر.س';

      row.querySelectorAll('[data-action="view-suspension-attachment"]').forEach(function (button) {
        var actionContainer = button.closest('li') || button;
        actionContainer.style.display = state.fileName ? '' : 'none';
        if (!state.fileName) return;

        button.style.display = '';
        button.dataset.fileSrc = state.fileSrc || '';
        button.dataset.fileName = state.fileName;
        button.dataset.fileType = state.fileType;
        button.innerHTML =
          state.fileType === 'pdf'
            ? '<i class="bi bi-file-earmark-pdf"></i> PDF'
            : '<i class="bi bi-image"></i> صورة';
      });

      var suspensionDateCell = row.querySelector('.cell-suspension-date');
      if (suspensionDateCell) suspensionDateCell.textContent = row.dataset.suspensionDate;
      row
        .querySelectorAll('[data-action="extend"], [data-action="suspend"], [data-action="close"]')
        .forEach(function (action) {
          var actionItem = action.closest('li') || action;
          actionItem.style.display = 'none';
        });
    }

    return {
      prepareEditFromRow: prepareEditFromRow,
      prepareFromRow: prepareFromRow,
      updateRow: updateRow,
      validate: validate,
    };
  })();

  // ---------------------------------------------------------
  // Special offers page — offer form, preview and table
  function initSpecialOffersPage() {
    var form = document.getElementById('specialOfferForm');
    var tableBody = document.getElementById('specialOffersTableBody');
    if (!form || !tableBody) return;

    var description = document.getElementById('specialOfferDescription');
    var counter = document.getElementById('specialOfferDescriptionCount');
    var preview = document.getElementById('specialOfferPreview');
    var repeatExample = document.getElementById('repeatExample');
    var pageSizeSelect = document.getElementById('specialOfferPageSize');
    var pagination = document.getElementById('specialOfferPagination');
    var resultCount = document.getElementById('specialOffersResultCount');
    var submitLabel = document.getElementById('specialOfferSubmitLabel');
    var formModalElement = document.getElementById('specialOfferFormModal');
    var deleteModalElement = document.getElementById('deleteSpecialOfferModal');
    var deleteOfferId = document.getElementById('deleteSpecialOfferId');
    var confirmDeleteButton = document.getElementById('confirmDeleteSpecialOffer');
    var editingRecordId = null;
    var deletingRecord = null;
    var activeStatus = 'all';
    var currentPage = 1;
    var rowTemplate = tableBody.querySelector('[data-special-record-id]').cloneNode(true);
    var statusLabels = {
      pending: 'بانتظار الموافقة',
      active: 'مفعل',
      expired: 'منتهي',
      paused: 'متوقف مؤقتًا',
    };
    var statusIcons = {
      pending: 'bi-hourglass-split',
      active: 'bi-check-circle-fill',
      expired: 'bi-clock-history',
      paused: 'bi-pause-circle-fill',
    };

    function esc(value) {
      return String(value).replace(/[&<>"']/g, function (character) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' }[character];
      });
    }
    function scopeText(values, allLabel) {
      return values[0] === 'all' ? allLabel : values.join('، ');
    }
    function recordsFromRows() {
      return Array.prototype.map.call(
        tableBody.querySelectorAll('[data-special-record-id]'),
        function (row) {
          return {
            id: row.dataset.specialRecordId,
            description: row.dataset.description,
            type: row.dataset.type,
            details: row.dataset.details,
            status: row.dataset.status,
            previousStatus: row.dataset.previousStatus || '',
            startDate: row.dataset.startDate,
            endDate: row.dataset.endDate,
            branches: JSON.parse(row.dataset.branches || '["all"]'),
            cars: JSON.parse(row.dataset.cars || '["all"]'),
            row: row,
          };
        },
      );
    }
    var records = recordsFromRows();
    function selectedType() {
      return form.querySelector('input[name="specialOfferType"]:checked').value;
    }
    function updatePreview() {
      var type = selectedType();
      var required = Number(document.getElementById('requiredBookingDays').value) || 4;
      var free = Number(document.getElementById('freeDays').value) || 1;
      var distance = Number(document.getElementById('deliveryDistance').value) || 61;
      if (preview) {
        preview.textContent =
          type === 'deliveryDistance'
            ? 'توصيل لمسافة تصل إلى ' + distance + ' كم'
            : 'احجز ' +
              required +
              ' أيام واحصل على ' +
              free +
              ' يوم مجاناً' +
              (document.getElementById('specialOfferRepeats').checked ? ' — يتكرر' : '');
      }
      repeatExample.textContent =
        document.getElementById('specialOfferRepeats').checked && type === 'freeDays'
          ? 'مثال: 8 أيام ⇒ ' + Math.floor(8 / required) * free + ' يوماً مجاناً'
          : '';
    }
    function toggleDateMode() {
      var range =
        form.querySelector('input[name="specialOfferDateMode"]:checked').value === 'range';
      document.querySelector('[data-special-date-single]').hidden = range;
      document.querySelector('[data-special-date-start]').hidden = !range;
      document.querySelector('[data-special-date-end]').hidden = !range;
      document.getElementById('specialOfferDate').required = !range;
      document.getElementById('specialOfferStart').required = range;
      document.getElementById('specialOfferEnd').required = range;
    }
    function toggleType() {
      var free = selectedType() === 'freeDays';
      document.querySelector('[data-special-free-days]').hidden = !free;
      document.querySelector('[data-special-distance]').hidden = free;
      updatePreview();
    }
    function renderPagination(totalPages) {
      pagination.innerHTML = '';
      var previousButton = document.createElement('button');
      previousButton.type = 'button';
      previousButton.className = 'table-pagination__page-btn';
      previousButton.disabled = currentPage === 1;
      previousButton.setAttribute('aria-label', 'الصفحة السابقة');
      previousButton.innerHTML = '<i class="bi bi-chevron-right"></i>';
      previousButton.addEventListener('click', function () {
        if (currentPage > 1) {
          currentPage -= 1;
          render();
        }
      });
      pagination.appendChild(previousButton);
      for (var page = 1; page <= totalPages; page += 1) {
        (function (pageNumber) {
          var button = document.createElement('button');
          button.type = 'button';
          button.className =
            'table-pagination__page-btn' + (pageNumber === currentPage ? ' is-active' : '');
          button.textContent = pageNumber;
          button.addEventListener('click', function () {
            currentPage = pageNumber;
            render();
          });
          pagination.appendChild(button);
        })(page);
      }
      var nextButton = document.createElement('button');
      nextButton.type = 'button';
      nextButton.className = 'table-pagination__page-btn';
      nextButton.disabled = currentPage === totalPages;
      nextButton.setAttribute('aria-label', 'الصفحة التالية');
      nextButton.innerHTML = '<i class="bi bi-chevron-left"></i>';
      nextButton.addEventListener('click', function () {
        if (currentPage < totalPages) {
          currentPage += 1;
          render();
        }
      });
      pagination.appendChild(nextButton);
    }
    function render() {
      var query = document.getElementById('specialOffersSearchInput').value.trim().toLowerCase();
      var status = document.getElementById('specialOfferStatusFilter').value;
      var date = document.getElementById('specialOfferDateFilter').value;
      var filtered = records.filter(function (record) {
        return (
          (activeStatus === 'all' || record.status === activeStatus) &&
          (status === 'all' || record.status === status) &&
          (!query || record.description.toLowerCase().indexOf(query) !== -1) &&
          (!date || (date >= record.startDate && date <= record.endDate))
        );
      });
      var pageSize = Number(pageSizeSelect.value) || 3;
      var totalPages = Math.max(1, Math.ceil(filtered.length / pageSize));
      if (currentPage > totalPages) currentPage = totalPages;
      var visibleIds = filtered
        .slice((currentPage - 1) * pageSize, currentPage * pageSize)
        .map(function (record) {
          return record.id;
        });
      records.forEach(function (record) {
        var row = record.row;
        row.dataset.specialRecordId = record.id;
        row.dataset.description = record.description;
        row.dataset.type = record.type;
        row.dataset.details = record.details;
        row.dataset.status = record.status;
        row.dataset.startDate = record.startDate;
        row.dataset.endDate = record.endDate;
        row.dataset.branches = JSON.stringify(record.branches);
        row.dataset.cars = JSON.stringify(record.cars);
        if (record.previousStatus) row.dataset.previousStatus = record.previousStatus;
        else delete row.dataset.previousStatus;
        row.hidden = visibleIds.indexOf(record.id) === -1;
        row.querySelector('td:nth-child(1) .cell-primary').textContent = record.description;
        row.querySelector('td:nth-child(1) small').textContent = record.id;
        row.querySelector('td:nth-child(2)').textContent =
          record.type === 'freeDays' ? 'أيام مجانية' : 'مسافة التوصيل';
        row.querySelector('td:nth-child(3)').textContent = record.details;
        row.querySelector('[data-special-start-date]').textContent = record.startDate
          .split('-')
          .reverse()
          .join('/');
        row.querySelector('[data-special-end-date]').textContent = record.endDate
          .split('-')
          .reverse()
          .join('/');
        row.querySelector('td:nth-child(8)').innerHTML =
          '<span class="discount-status trending-status--' +
          record.status +
          '"><i class="bi ' +
          statusIcons[record.status] +
          '"></i>' +
          statusLabels[record.status] +
          '</span>';
        var branchCell = row.querySelector('[data-scope-cell-mode="branches"]');
        var carCell = row.querySelector('[data-scope-cell-mode="carTypes"]');
        branchCell.dataset.branches = JSON.stringify(record.branches);
        carCell.dataset.carTypes = JSON.stringify(record.cars);
        var pauseAction = row.querySelector('[data-special-row-action="pause"]');
        pauseAction.innerHTML =
          record.status === 'paused'
            ? '<i class="bi bi-play-circle"></i> إعادة تفعيل'
            : '<i class="bi bi-pause-circle"></i> إيقاف مؤقت';
      });
      tableBody.querySelectorAll('[data-scope-cell]').forEach(function (cell) {
        initScopeCell(cell);
      });
      if (resultCount) resultCount.textContent = filtered.length + ' عروض';
      renderPagination(totalPages);
    }
    document.addEventListener('click', function (event) {
      var action = event.target.closest('[data-special-row-action]');
      if (!action) return;
      var row = action.closest('[data-special-record-id]');
      if (!row) return;
      var record = records.find(function (item) {
        return item.id === row.dataset.specialRecordId;
      });
      if (!record) return;
      event.preventDefault();
      if (action.dataset.specialRowAction === 'delete') {
        deletingRecord = record;
        deleteOfferId.textContent = record.id;
        bootstrap.Modal.getOrCreateInstance(deleteModalElement).show();
        return;
      }
      if (action.dataset.specialRowAction === 'pause') {
        if (record.status === 'paused') {
          record.status = record.previousStatus || 'pending';
          record.previousStatus = '';
        } else {
          record.previousStatus = record.status;
          record.status = 'paused';
        }
        render();
        return;
      }
      if (action.dataset.specialRowAction === 'view') {
        document.getElementById('specialOfferDetailsTitle').textContent = record.description;
        document.getElementById('specialOfferDetailsContent').innerHTML =
          '<div class="discount-details-grid"><div class="discount-detail-item"><span>النوع</span><strong>' +
          esc(record.type === 'freeDays' ? 'أيام مجانية' : 'مسافة التوصيل') +
          '</strong></div><div class="discount-detail-item"><span>التفاصيل</span><strong>' +
          esc(record.details) +
          '</strong></div><div class="discount-detail-item"><span>الفترة</span><strong class="ltr-num">' +
          esc(record.startDate + ' — ' + record.endDate) +
          '</strong></div><div class="discount-detail-item"><span>الحالة</span><strong>' +
          statusLabels[record.status] +
          '</strong></div><div class="discount-detail-item discount-detail-item--wide"><span>الفروع</span><strong>' +
          esc(scopeText(record.branches, 'كل الفروع')) +
          '</strong></div><div class="discount-detail-item discount-detail-item--wide"><span>أنواع السيارات</span><strong>' +
          esc(scopeText(record.cars, 'كل أنواع السيارات')) +
          '</strong></div></div>';
        bootstrap.Modal.getOrCreateInstance(
          document.getElementById('specialOfferDetailsModal'),
        ).show();
        return;
      }
      if (action.dataset.specialRowAction === 'edit') {
        editingRecordId = record.id;
        document.getElementById('specialOfferFormModalLabel').textContent = 'تعديل العرض الخاص';
        submitLabel.textContent = 'حفظ التعديلات';
        description.value = record.description;
        counter.textContent = description.value.length;
        form.querySelector('input[name="specialOfferType"][value="' + record.type + '"]').checked =
          true;
        toggleType();
        var rangeMode = record.startDate !== record.endDate;
        form.querySelector(
          'input[name="specialOfferDateMode"][value="' + (rangeMode ? 'range' : 'single') + '"]',
        ).checked = true;
        toggleDateMode();
        document.getElementById('specialOfferDate').value = rangeMode ? '' : record.startDate;
        document.getElementById('specialOfferStart').value = record.startDate;
        document.getElementById('specialOfferEnd').value = record.endDate;
        if (record.type === 'freeDays') {
          var dayValues = record.details.match(/(\d+)\s*\+\s*(\d+)/);
          document.getElementById('requiredBookingDays').value = dayValues ? dayValues[1] : '';
          document.getElementById('freeDays').value = dayValues ? dayValues[2] : '';
          document.getElementById('specialOfferRepeats').checked =
            record.details.indexOf('يتكرر') !== -1;
        } else {
          document.getElementById('deliveryDistance').value = parseInt(record.details, 10) || '';
        }
        updatePreview();
        form
          .querySelector('[data-scope-selector]')
          .scopeSelectorApi.setValue({ branches: record.branches, carTypes: record.cars });
        bootstrap.Modal.getOrCreateInstance(
          document.getElementById('specialOfferFormModal'),
        ).show();
      }
    });
    confirmDeleteButton.addEventListener('click', function () {
      if (!deletingRecord) return;
      records = records.filter(function (item) {
        return item.id !== deletingRecord.id;
      });
      deletingRecord.row.remove();
      deletingRecord = null;
      bootstrap.Modal.getOrCreateInstance(deleteModalElement).hide();
      render();
    });
    form.querySelectorAll('input, textarea').forEach(function (input) {
      input.addEventListener('input', updatePreview);
      input.addEventListener('change', updatePreview);
    });
    form.querySelectorAll('input[name="specialOfferDateMode"]').forEach(function (input) {
      input.addEventListener('change', toggleDateMode);
    });
    form.querySelectorAll('input[name="specialOfferType"]').forEach(function (input) {
      input.addEventListener('change', toggleType);
    });
    document.querySelector('[data-special-action="add"]').addEventListener('click', function () {
      editingRecordId = null;
      document.getElementById('specialOfferFormModalLabel').textContent = 'إضافة عرض خاص';
      submitLabel.textContent = 'إرسال العرض';
      form.reset();
      counter.textContent = '0';
      form
        .querySelector('[data-scope-selector]')
        .scopeSelectorApi.setValue({ branches: ['all'], carTypes: ['all'] });
      toggleDateMode();
      toggleType();
    });
    document.querySelectorAll('[data-special-status]').forEach(function (tab) {
      tab.addEventListener('click', function () {
        activeStatus = tab.dataset.specialStatus;
        document.getElementById('specialOfferStatusFilter').value = activeStatus;
        document.querySelectorAll('[data-special-status]').forEach(function (item) {
          var isActive = item === tab;
          item.classList.toggle('is-active', isActive);
          item.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });
        currentPage = 1;
        render();
      });
    });
    document.getElementById('specialOffersSearchInput').addEventListener('input', function () {
      currentPage = 1;
      render();
    });
    document.getElementById('specialOfferStatusFilter').addEventListener('change', function () {
      activeStatus = this.value;
      document.querySelectorAll('[data-special-status]').forEach(function (tab) {
        var isActive = tab.dataset.specialStatus === activeStatus;
        tab.classList.toggle('is-active', isActive);
        tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
      });
      currentPage = 1;
      render();
    });
    document.getElementById('specialOfferDateFilter').addEventListener('change', function () {
      currentPage = 1;
      render();
    });
    pageSizeSelect.addEventListener('change', function () {
      currentPage = 1;
      render();
    });
    document.getElementById('clearSpecialOfferFilters').addEventListener('click', function () {
      activeStatus = 'all';
      currentPage = 1;
      document.getElementById('specialOfferStatusFilter').value = 'all';
      document.getElementById('specialOffersSearchInput').value = '';
      document.getElementById('specialOfferDateFilter').value = '';
      document.querySelectorAll('[data-special-status]').forEach(function (tab) {
        var isAll = tab.dataset.specialStatus === 'all';
        tab.classList.toggle('is-active', isAll);
        tab.setAttribute('aria-selected', isAll ? 'true' : 'false');
      });
      render();
    });
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      var scope = form.querySelector('[data-scope-selector]').scopeSelectorApi;
      if (!description.value.trim() || !scope.validate()) return;
      var type = selectedType();
      var required = Number(document.getElementById('requiredBookingDays').value) || 4;
      var free = Number(document.getElementById('freeDays').value) || 1;
      var distance = Number(document.getElementById('deliveryDistance').value) || 61;
      var isRange =
        form.querySelector('input[name="specialOfferDateMode"]:checked').value === 'range';
      var selectedDate = document.getElementById('specialOfferDate').value;
      var startDate = isRange ? document.getElementById('specialOfferStart').value : selectedDate;
      var endDate = isRange ? document.getElementById('specialOfferEnd').value : selectedDate;
      if (!startDate || !endDate || endDate < startDate) {
        if (isRange) {
          document.getElementById('specialOfferStart').classList.toggle('is-invalid', !startDate);
          document
            .getElementById('specialOfferEnd')
            .classList.toggle('is-invalid', !endDate || endDate < startDate);
        } else {
          document.getElementById('specialOfferDate').classList.toggle('is-invalid', !selectedDate);
        }
        return;
      }
      var savedRecord = {
        id: editingRecordId,
        description: description.value.trim(),
        type: type,
        details:
          type === 'freeDays'
            ? required +
              ' + ' +
              free +
              (document.getElementById('specialOfferRepeats').checked ? ' — يتكرر' : '')
            : distance + ' كم',
        status: 'pending',
        startDate: startDate,
        endDate: endDate,
        branches: scope.getValue().branches,
        cars: scope.getValue().carTypes,
      };
      var index = records.findIndex(function (item) {
        return item.id === editingRecordId;
      });
      var wasEditing = index >= 0;
      if (index >= 0) {
        savedRecord.status = records[index].status;
        savedRecord.previousStatus = records[index].previousStatus;
        savedRecord.row = records[index].row;
        records[index] = savedRecord;
      } else {
        var highestRecordNumber = records.reduce(function (highest, record) {
          return Math.max(highest, Number(record.id.replace('SPO-', '')) || 0);
        }, 0);
        var recordNumber = String(highestRecordNumber + 1);
        while (recordNumber.length < 3) recordNumber = '0' + recordNumber;
        savedRecord.id = 'SPO-' + recordNumber;
        savedRecord.previousStatus = '';
        var row = rowTemplate.cloneNode(true);
        row.dataset.specialRecordId = savedRecord.id;
        row.dataset.description = savedRecord.description;
        row.dataset.type = savedRecord.type;
        row.dataset.details = savedRecord.details;
        row.dataset.status = savedRecord.status;
        row.dataset.startDate = savedRecord.startDate;
        row.dataset.endDate = savedRecord.endDate;
        row.dataset.branches = JSON.stringify(savedRecord.branches);
        row.dataset.cars = JSON.stringify(savedRecord.cars);
        tableBody.insertBefore(row, tableBody.firstChild);
        savedRecord.row = row;
        records.unshift(savedRecord);
      }
      render();
      bootstrap.Modal.getOrCreateInstance(formModalElement).hide();
      document.getElementById('specialOfferFormModalLabel').textContent = 'إضافة عرض خاص';
      submitLabel.textContent = 'إرسال العرض';
      editingRecordId = null;
      form.reset();
      counter.textContent = '0';
      toggleDateMode();
      toggleType();
    });
    toggleDateMode();
    toggleType();
    render();
  }
  initSpecialOffersPage();

  // ---------------------------------------------------------
  // Trending requests page
  // ---------------------------------------------------------
  function initTrendingPage() {
    var tableBody = document.getElementById('trendingTableBody');
    var form = document.getElementById('trendingRequestForm');

    if (!tableBody || !form) return;

    var tableWrapper = document.getElementById('trendingTableWrapper');
    var emptyState = document.getElementById('trendingEmptyState');
    var resultCount = document.getElementById('trendingResultCount');
    var searchInput = document.getElementById('trendingSearchInput');
    var statusFilter = document.getElementById('trendingStatusFilter');
    var dateFilter = document.getElementById('trendingDateFilter');
    var clearFiltersButton = document.getElementById('clearTrendingFilters');
    var pageSizeSelect = document.getElementById('trendingPageSize');
    var pagination = document.getElementById('trendingPagination');
    var daysInput = document.getElementById('trendingDays');
    var startDateInput = document.getElementById('trendingStartDate');
    var dailyPriceInput = document.getElementById('trendingDailyPrice');
    var endDateOutput = document.getElementById('trendingCalculatedEndDate');
    var costOutput = document.getElementById('trendingCalculatedCost');
    var recordIdInput = document.getElementById('trendingRecordId');
    var requestModalTitle = document.getElementById('trendingRequestModalLabel');
    var submitLabel = document.getElementById('trendingSubmitLabel');
    var requestModalElement = document.getElementById('trendingRequestModal');
    var detailsModalElement = document.getElementById('trendingDetailsModal');
    var detailsContent = document.getElementById('trendingDetailsContent');
    var deleteModalElement = document.getElementById('deleteTrendingModal');
    var deleteRecordId = document.getElementById('deleteTrendingRecordId');
    var confirmDeleteButton = document.getElementById('confirmDeleteTrending');
    var activeCard = document.getElementById('trendingActiveCard');
    var activeEndDate = document.getElementById('trendingActiveEndDate');
    var remainingDays = document.getElementById('trendingRemainingDays');
    var activeStatus = 'all';
    var currentPage = 1;
    var millisecondsPerDay = 24 * 60 * 60 * 1000;
    var editingRow = null;
    var deletingRow = null;
    var rowTemplate = tableBody.querySelector('[data-trending-row]').cloneNode(true);

    var statusMeta = {
      pending: {
        label: 'بانتظار الموافقة',
        icon: 'bi-hourglass-split',
      },
      accepted: {
        label: 'مقبول',
        icon: 'bi-check2-circle',
      },
      active: {
        label: 'نشط',
        icon: 'bi-lightning-charge-fill',
      },
      expired: {
        label: 'منتهي',
        icon: 'bi-clock-history',
      },
      paused: {
        label: 'متوقف مؤقتًا',
        icon: 'bi-pause-circle-fill',
      },
    };

    function padNumber(value) {
      return value < 10 ? '0' + value : String(value);
    }

    function localTodayIso() {
      var today = new Date();
      return (
        today.getFullYear() +
        '-' +
        padNumber(today.getMonth() + 1) +
        '-' +
        padNumber(today.getDate())
      );
    }

    function isoToDate(isoDate) {
      var parts = isoDate.split('-');
      return new Date(Number(parts[0]), Number(parts[1]) - 1, Number(parts[2]));
    }

    function dateToIso(date) {
      return (
        date.getFullYear() + '-' + padNumber(date.getMonth() + 1) + '-' + padNumber(date.getDate())
      );
    }

    function displayDate(isoDate) {
      if (!isoDate) return '—';
      var parts = isoDate.split('-');
      return parts[2] + '/' + parts[1] + '/' + parts[0];
    }

    function formatCurrency(value) {
      var number = Number(value) || 0;
      return (
        number.toLocaleString('en-US', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
        }) + ' ر.س'
      );
    }

    function getRows() {
      return Array.prototype.slice.call(tableBody.querySelectorAll('[data-trending-row]'));
    }

    function updateRowDisplay(row) {
      var cells = row.querySelectorAll('td');
      var status = row.dataset.status;
      var meta = statusMeta[status] || statusMeta.pending;
      var pauseAction = row.querySelector('[data-trending-row-action="pause"]');

      cells[0].innerHTML =
        '<strong class="ltr-num">' + displayDate(row.dataset.requestDate) + '</strong>';
      cells[1].innerHTML = '<strong>' + row.dataset.days + ' أيام</strong>';
      cells[2].innerHTML =
        '<strong class="ltr-num">' + displayDate(row.dataset.startDate) + '</strong>';
      cells[3].innerHTML =
        '<strong class="trending-cost ltr-num">' + formatCurrency(row.dataset.cost) + '</strong>';
      cells[4].innerHTML =
        '<span class="discount-status trending-status--' +
        status +
        '"><i class="bi ' +
        meta.icon +
        '"></i>' +
        meta.label +
        '</span>';

      if (pauseAction) {
        pauseAction.innerHTML =
          status === 'paused'
            ? '<i class="bi bi-play-circle"></i> إعادة تفعيل'
            : '<i class="bi bi-pause-circle"></i> إيقاف مؤقت';
      }
    }

    function resetRequestForm() {
      editingRow = null;
      form.reset();
      recordIdInput.value = '';
      daysInput.value = '7';
      requestModalTitle.textContent = 'طلب تريند';
      submitLabel.textContent = 'إرسال الطلب';
      daysInput.classList.remove('is-invalid');
      startDateInput.classList.remove('is-invalid');
    }

    function openEditForm(row) {
      editingRow = row;
      recordIdInput.value = row.dataset.trendingRow;
      daysInput.value = row.dataset.days;
      startDateInput.value = row.dataset.startDate;
      requestModalTitle.textContent = 'تعديل طلب التريند';
      submitLabel.textContent = 'حفظ التعديلات';
      calculateRequest();
      bootstrap.Modal.getOrCreateInstance(requestModalElement).show();
    }

    function showRequestDetails(row) {
      var meta = statusMeta[row.dataset.status] || statusMeta.pending;
      document.getElementById('trendingDetailsModalLabel').textContent =
        'تفاصيل الطلب ' + row.dataset.trendingRow;
      detailsContent.innerHTML =
        '<div class="discount-details-grid">' +
        '<div class="discount-detail-item"><span>رقم الطلب</span><strong class="ltr-num">' +
        row.dataset.trendingRow +
        '</strong></div>' +
        '<div class="discount-detail-item"><span>الحالة</span><strong>' +
        meta.label +
        '</strong></div>' +
        '<div class="discount-detail-item"><span>تاريخ الطلب</span><strong class="ltr-num">' +
        displayDate(row.dataset.requestDate) +
        '</strong></div>' +
        '<div class="discount-detail-item"><span>عدد الأيام</span><strong>' +
        row.dataset.days +
        ' أيام</strong></div>' +
        '<div class="discount-detail-item"><span>تاريخ البدء</span><strong class="ltr-num">' +
        displayDate(row.dataset.startDate) +
        '</strong></div>' +
        '<div class="discount-detail-item"><span>تاريخ الانتهاء</span><strong class="ltr-num">' +
        displayDate(row.dataset.endDate) +
        '</strong></div>' +
        '<div class="discount-detail-item discount-detail-item--wide"><span>التكلفة المستحقة</span><strong class="ltr-num">' +
        formatCurrency(row.dataset.cost) +
        '</strong></div></div>';
      bootstrap.Modal.getOrCreateInstance(detailsModalElement).show();
    }

    function calculateRequest() {
      var days = Number(daysInput.value);
      var price = Number(dailyPriceInput.dataset.price);
      var startDate = startDateInput.value;
      var endDate = '';

      if (startDate && days > 0 && Math.floor(days) === days) {
        var calculatedDate = isoToDate(startDate);
        calculatedDate.setDate(calculatedDate.getDate() + days - 1);
        endDate = dateToIso(calculatedDate);
      }

      endDateOutput.value = displayDate(endDate);
      endDateOutput.dataset.isoDate = endDate;
      costOutput.textContent = formatCurrency(price * (days > 0 ? days : 0));
    }

    function renderPagination(totalPages) {
      pagination.innerHTML = '';

      var previousButton = document.createElement('button');
      previousButton.type = 'button';
      previousButton.className = 'table-pagination__page-btn';
      previousButton.setAttribute('aria-label', 'الصفحة السابقة');
      previousButton.innerHTML = '<i class="bi bi-chevron-right" aria-hidden="true"></i>';
      previousButton.disabled = currentPage === 1;
      previousButton.addEventListener('click', function () {
        currentPage -= 1;
        renderTable();
      });
      pagination.appendChild(previousButton);

      for (var page = 1; page <= totalPages; page += 1) {
        (function (pageNumber) {
          var pageButton = document.createElement('button');
          pageButton.type = 'button';
          pageButton.className =
            'table-pagination__page-btn' + (pageNumber === currentPage ? ' is-active' : '');
          pageButton.textContent = pageNumber;
          pageButton.setAttribute('aria-label', 'الصفحة ' + pageNumber);
          pageButton.addEventListener('click', function () {
            currentPage = pageNumber;
            renderTable();
          });
          pagination.appendChild(pageButton);
        })(page);
      }

      var nextButton = document.createElement('button');
      nextButton.type = 'button';
      nextButton.className = 'table-pagination__page-btn';
      nextButton.setAttribute('aria-label', 'الصفحة التالية');
      nextButton.innerHTML = '<i class="bi bi-chevron-left" aria-hidden="true"></i>';
      nextButton.disabled = currentPage === totalPages;
      nextButton.addEventListener('click', function () {
        currentPage += 1;
        renderTable();
      });
      pagination.appendChild(nextButton);
    }

    function renderTable() {
      var query = searchInput.value.trim().toLowerCase();
      var selectedStatus = activeStatus !== 'all' ? activeStatus : statusFilter.value;
      var selectedDate = dateFilter.value;
      var rows = getRows();
      var filteredRows = rows.filter(function (row) {
        var matchesQuery = !query || row.textContent.toLowerCase().indexOf(query) >= 0;
        var matchesStatus = selectedStatus === 'all' || row.dataset.status === selectedStatus;
        var matchesDate =
          !selectedDate ||
          row.dataset.requestDate === selectedDate ||
          row.dataset.startDate === selectedDate ||
          row.dataset.endDate === selectedDate;
        return matchesQuery && matchesStatus && matchesDate;
      });
      var pageSize = Number(pageSizeSelect.value);
      var totalPages = Math.max(1, Math.ceil(filteredRows.length / pageSize));

      if (currentPage > totalPages) currentPage = totalPages;

      rows.forEach(function (row) {
        row.hidden = true;
      });
      filteredRows
        .slice((currentPage - 1) * pageSize, currentPage * pageSize)
        .forEach(function (row) {
          row.hidden = false;
        });

      tableWrapper.hidden = filteredRows.length === 0;
      emptyState.hidden = filteredRows.length !== 0;
      if (resultCount) resultCount.textContent = filteredRows.length + ' طلب';
      renderPagination(totalPages);
    }

    function syncStatusTabs(status) {
      document.querySelectorAll('[data-trending-status-tab]').forEach(function (tab) {
        var isActive = tab.dataset.trendingStatusTab === status;
        tab.classList.toggle('is-active', isActive);
        tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
      });
    }

    function updateActiveCard() {
      var activeRow = getRows().find(function (row) {
        return row.dataset.status === 'active';
      });

      if (!activeRow) {
        activeCard.hidden = true;
        return;
      }

      var today = isoToDate(localTodayIso());
      var endDate = isoToDate(activeRow.dataset.endDate);
      var daysLeft = Math.max(
        0,
        Math.ceil((endDate.getTime() - today.getTime()) / millisecondsPerDay),
      );
      activeEndDate.textContent = displayDate(activeRow.dataset.endDate);
      remainingDays.textContent = daysLeft;
      activeCard.hidden = false;
    }

    document.querySelectorAll('[data-trending-status-tab]').forEach(function (tab) {
      tab.addEventListener('click', function () {
        activeStatus = tab.dataset.trendingStatusTab;
        statusFilter.value = activeStatus;
        syncStatusTabs(activeStatus);
        currentPage = 1;
        renderTable();
      });
    });

    statusFilter.addEventListener('change', function () {
      activeStatus = statusFilter.value;
      syncStatusTabs(activeStatus);
      currentPage = 1;
      renderTable();
    });

    searchInput.addEventListener('input', function () {
      currentPage = 1;
      renderTable();
    });

    dateFilter.addEventListener('change', function () {
      currentPage = 1;
      renderTable();
    });

    pageSizeSelect.addEventListener('change', function () {
      currentPage = 1;
      renderTable();
    });

    clearFiltersButton.addEventListener('click', function () {
      searchInput.value = '';
      statusFilter.value = 'all';
      dateFilter.value = '';
      activeStatus = 'all';
      currentPage = 1;
      syncStatusTabs('all');
      renderTable();
    });

    daysInput.addEventListener('input', calculateRequest);
    startDateInput.addEventListener('change', calculateRequest);

    requestModalElement.addEventListener('show.bs.modal', function () {
      var today = localTodayIso();
      startDateInput.min = editingRow ? '' : today;
      if (!editingRow && (!startDateInput.value || startDateInput.value < today)) {
        startDateInput.value = today;
      }
      daysInput.classList.remove('is-invalid');
      startDateInput.classList.remove('is-invalid');
      calculateRequest();
    });

    form.addEventListener('submit', function (event) {
      event.preventDefault();

      var days = Number(daysInput.value);
      var startDate = startDateInput.value;
      var today = localTodayIso();
      var validDays = days > 0 && Math.floor(days) === days;
      var validStartDate = Boolean(startDate) && (Boolean(editingRow) || startDate >= today);

      daysInput.classList.toggle('is-invalid', !validDays);
      startDateInput.classList.toggle('is-invalid', !validStartDate);
      if (!validDays || !validStartDate) return;

      var cost = Number(dailyPriceInput.dataset.price) * days;
      var endDate = endDateOutput.dataset.isoDate;
      var wasEditing = Boolean(editingRow);

      if (editingRow) {
        editingRow.dataset.days = String(days);
        editingRow.dataset.startDate = startDate;
        editingRow.dataset.endDate = endDate;
        editingRow.dataset.cost = String(cost);
        updateRowDisplay(editingRow);
      } else {
        var newRow = rowTemplate.cloneNode(true);
        var highestRecordNumber = getRows().reduce(function (highest, row) {
          return Math.max(highest, Number(row.dataset.trendingRow.replace('TRD-', '')) || 0);
        }, 0);
        var recordNumber = String(highestRecordNumber + 1);
        while (recordNumber.length < 3) recordNumber = '0' + recordNumber;

        newRow.dataset.trendingRow = 'TRD-' + recordNumber;
        newRow.dataset.requestDate = today;
        newRow.dataset.days = String(days);
        newRow.dataset.startDate = startDate;
        newRow.dataset.endDate = endDate;
        newRow.dataset.cost = String(cost);
        newRow.dataset.status = 'pending';
        delete newRow.dataset.previousStatus;
        updateRowDisplay(newRow);
        tableBody.insertBefore(newRow, tableBody.firstChild);
      }

      activeStatus = 'all';
      statusFilter.value = 'all';
      dateFilter.value = '';
      searchInput.value = '';
      currentPage = 1;
      syncStatusTabs('all');
      renderTable();
      updateActiveCard();

      var requestModal = bootstrap.Modal.getOrCreateInstance(requestModalElement);
      bootstrap.Modal.getOrCreateInstance(requestModalElement).hide();
      resetRequestForm();
    });

    document.querySelectorAll('[data-trending-action="add"]').forEach(function (button) {
      button.addEventListener('click', function () {
        resetRequestForm();
      });
    });

    document.addEventListener('click', function (event) {
      var action = event.target.closest('[data-trending-row-action]');
      if (!action) return;

      var row = action.closest('[data-trending-row]');
      if (!row) return;

      var actionName = action.dataset.trendingRowAction;
      if (actionName === 'view') showRequestDetails(row);
      if (actionName === 'edit') openEditForm(row);
      if (actionName === 'pause') {
        if (row.dataset.status === 'paused') {
          row.dataset.status = row.dataset.previousStatus || 'pending';
          delete row.dataset.previousStatus;
        } else {
          row.dataset.previousStatus = row.dataset.status;
          row.dataset.status = 'paused';
        }
        updateRowDisplay(row);
        updateActiveCard();
        renderTable();
      }
      if (actionName === 'delete') {
        deletingRow = row;
        deleteRecordId.textContent = row.dataset.trendingRow;
        bootstrap.Modal.getOrCreateInstance(deleteModalElement).show();
      }
    });

    confirmDeleteButton.addEventListener('click', function () {
      if (!deletingRow) return;
      deletingRow.remove();
      deletingRow = null;
      bootstrap.Modal.getOrCreateInstance(deleteModalElement).hide();
      updateActiveCard();
      renderTable();
    });

    updateActiveCard();
    calculateRequest();
    renderTable();
  }
  initTrendingPage();

  // ---------------------------------------------------------
  // Create Booking Form ï¿½ Success Modal and Redirect
  // ---------------------------------------------------------
  function initCreateBookingForm() {
    var form = document.getElementById('createBookingForm');
    var successModal = document.getElementById('successModal');

    if (!form || !successModal || typeof bootstrap === 'undefined') return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      // Show the success modal
      var bsModal = bootstrap.Modal.getOrCreateInstance(successModal);
      bsModal.show();

      // Redirect to reservations page after 2 seconds
      setTimeout(function () {
        window.location.href = 'reservations.html';
      }, 2000);
    });
  }

  // ---------------------------------------------------------
  // File Input ï¿½ Display selected file name
  // ---------------------------------------------------------
  function initFileInputs() {
    var licenseImageInput = document.getElementById('licenseImage');
    var licenseFileName = document.getElementById('licenseFileName');

    if (licenseImageInput && licenseFileName) {
      licenseImageInput.addEventListener('change', function (e) {
        if (e.target.files && e.target.files.length > 0) {
          licenseFileName.textContent = e.target.files[0].name;
        } else {
          licenseFileName.textContent = 'اختر ملف...';
        }
      });
    }
  }

  // Initialize create booking form if it exists
  initCreateBookingForm();

  // Initialize file inputs
  initFileInputs();

  // ---------------------------------------------------------
  // Official Holidays — edit duration modal
  // ---------------------------------------------------------
  function initHolidayDurationEdit() {
    var modalElement = document.getElementById('editHolidayDurationModal');

    if (!modalElement) return;

    var nameEl = document.getElementById('editHolidayDurationName');
    var input = document.getElementById('editHolidayDurationInput');
    var decreaseBtn = document.getElementById('decreaseDurationBtn');
    var increaseBtn = document.getElementById('increaseDurationBtn');
    var saveBtn = document.getElementById('saveHolidayDurationBtn');
    var editButtons = document.querySelectorAll('.holiday-duration__edit');

    if (!nameEl || !input || !saveBtn) return;

    var minDays = parseInt(input.min, 10) || 1;
    var maxDays = parseInt(input.max, 10) || 30;
    var activeEditBtn = null;

    function formatDuration(days) {
      return days === 1 ? '1 يوم' : days + ' أيام';
    }

    function clampDays(days) {
      if (isNaN(days)) days = minDays;
      return Math.min(maxDays, Math.max(minDays, days));
    }

    function setActiveEditButton(btn) {
      activeEditBtn = btn;
      nameEl.textContent = btn.dataset.holidayName || '';
      input.value = clampDays(parseInt(btn.dataset.days, 10));
    }

    editButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        setActiveEditButton(btn);
      });
    });

    modalElement.addEventListener('show.bs.modal', function (event) {
      var trigger = event.relatedTarget;
      if (trigger && trigger.matches('.holiday-duration__edit')) {
        setActiveEditButton(trigger);
      }
    });

    if (decreaseBtn) {
      decreaseBtn.addEventListener('click', function () {
        input.value = clampDays(parseInt(input.value, 10) - 1);
      });
    }

    if (increaseBtn) {
      increaseBtn.addEventListener('click', function () {
        input.value = clampDays(parseInt(input.value, 10) + 1);
      });
    }

    input.addEventListener('change', function () {
      input.value = clampDays(parseInt(input.value, 10));
    });

    saveBtn.addEventListener('click', function () {
      if (!activeEditBtn) return;

      var days = clampDays(parseInt(input.value, 10));
      var row = activeEditBtn.closest('tr');
      var textEl = row ? row.querySelector('.holiday-duration__text') : null;

      activeEditBtn.dataset.days = days;
      if (textEl) textEl.textContent = formatDuration(days);

      if (window.bootstrap && window.bootstrap.Modal) {
        window.bootstrap.Modal.getOrCreateInstance(modalElement).hide();
      }
    });
  }
  initHolidayDurationEdit();
})();
