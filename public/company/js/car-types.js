(function () {
  'use strict';

  var storageKey = 'tcar.carTypes.v1';
  var defaultTypes = [
    { id: 'sedan', nameAr: 'سيدان', nameEn: 'Sedan', active: true },
    { id: 'suv', nameAr: 'دفع رباعي', nameEn: 'SUV', active: true },
    { id: 'hatchback', nameAr: 'هاتشباك', nameEn: 'Hatchback', active: true },
    { id: 'pickup', nameAr: 'بيك أب', nameEn: 'Pickup', active: true },
    { id: 'van', nameAr: 'فان', nameEn: 'Van', active: true },
  ];

  function readTypes() {
    try {
      var stored = JSON.parse(localStorage.getItem(storageKey) || 'null');
      if (Array.isArray(stored) && stored.length) return stored;
    } catch (error) {
      console.warn('تعذر قراءة أنواع السيارات المحفوظة.', error);
    }

    localStorage.setItem(storageKey, JSON.stringify(defaultTypes));
    return defaultTypes.slice();
  }

  function writeTypes(types) {
    localStorage.setItem(storageKey, JSON.stringify(types));
    document.dispatchEvent(new CustomEvent('carTypesChanged'));
  }

  function getType(id) {
    return readTypes().find(function (type) {
      return type.id === id;
    });
  }

  function resolveTypeId(value) {
    var normalized = String(value || '')
      .trim()
      .toLowerCase();
    var match = readTypes().find(function (type) {
      return [type.id, type.nameAr, type.nameEn].some(function (name) {
        return name.toLowerCase() === normalized;
      });
    });
    return match ? match.id : '';
  }

  function displayName(type) {
    return type ? type.nameAr + ' — ' + type.nameEn : 'غير مصنف';
  }

  function renderSelect(select) {
    if (!select) return;
    var currentId = select.value || select.getAttribute('data-current-type-id') || '';
    var types = readTypes();
    select.innerHTML = '';

    var placeholder = document.createElement('option');
    placeholder.value = '';
    placeholder.textContent = 'اختر نوع السيارة';
    select.appendChild(placeholder);

    types.forEach(function (type) {
      if (
        !type.active &&
        (type.id !== currentId || !select.hasAttribute('data-allow-inactive-current'))
      ) {
        return;
      }
      var option = document.createElement('option');
      option.value = type.id;
      option.textContent = displayName(type);
      option.disabled = !type.active;
      select.appendChild(option);
    });

    select.value = currentId;
    if (!select.value) select.value = '';
  }

  function renderCustomDropdown(dropdown) {
    if (!dropdown) return;
    var select = dropdown.querySelector('select');
    var optionsContainer = dropdown.querySelector('[data-car-type-options]');
    var triggerText = dropdown.querySelector('.custom-dropdown__text');
    if (!select || !optionsContainer || !triggerText) return;

    var currentId = select.value || select.getAttribute('data-current-type-id') || '';
    var types = readTypes();
    optionsContainer.innerHTML = '';

    types.forEach(function (type) {
      if (
        !type.active &&
        (type.id !== currentId || !select.hasAttribute('data-allow-inactive-current'))
      ) {
        return;
      }
      var button = document.createElement('button');
      button.type = 'button';
      button.className = 'custom-dropdown__option';
      if (type.id === currentId) {
        button.setAttribute('data-selected', 'true');
      }
      button.setAttribute('data-value', type.id);

      var icon = document.createElement('span');
      icon.className = 'custom-dropdown__option-icon';
      icon.innerHTML = '<i class="bi bi-tag"></i>';

      var text = document.createElement('span');
      text.className = 'custom-dropdown__option-text';
      text.textContent = displayName(type);

      var check = document.createElement('i');
      check.className = 'bi bi-check2 custom-dropdown__option-check';

      button.appendChild(icon);
      button.appendChild(text);
      button.appendChild(check);
      optionsContainer.appendChild(button);
    });

    // Update trigger text
    var selectedType = getType(currentId);
    if (selectedType) {
      triggerText.textContent = displayName(selectedType);
    } else {
      triggerText.textContent = 'اختر نوع السيارة';
    }
  }

  function renderTypeCells() {
    document.querySelectorAll('[data-car-type-cell]').forEach(function (cell) {
      var row = cell.closest('tr');
      var typeId = row?.dataset.carTypeId || resolveTypeId(row?.dataset.carType);
      if (row && typeId) row.dataset.carTypeId = typeId;
      cell.textContent = displayName(getType(typeId));
    });
  }

  function renderTypeFilter() {
    var menu = document.getElementById('carTypeFilterMenu');
    if (!menu) return;
    menu.innerHTML = '';

    var allItem = document.createElement('li');
    allItem.innerHTML = '<a class="dropdown-item" href="#" data-car-type-filter="">الكل</a>';
    menu.appendChild(allItem);

    readTypes().forEach(function (type) {
      var item = document.createElement('li');
      var link = document.createElement('a');
      link.className = 'dropdown-item';
      link.href = '#';
      link.dataset.carTypeFilter = type.id;
      link.textContent = displayName(type);
      item.appendChild(link);
      menu.appendChild(item);
    });
  }

  function applyTypeFilter() {
    var filter = document.body.dataset.carTypeFilter || '';
    var search = (document.getElementById('platesSearchInput')?.value || '').trim().toLowerCase();
    document.querySelectorAll('#platesTable tbody tr').forEach(function (row) {
      var matchesType = !filter || row.dataset.carTypeId === filter;
      var matchesSearch = !search || row.textContent.toLowerCase().includes(search);
      row.style.display = matchesType && matchesSearch ? '' : 'none';
    });
  }

  function renderManagerList() {
    var list = document.getElementById('carTypeManagerList');
    if (!list) return;
    list.innerHTML = '';

    readTypes().forEach(function (type) {
      var item = document.createElement('li');
      item.className = 'list-group-item d-flex align-items-center justify-content-between gap-2';

      var label = document.createElement('span');
      label.textContent = displayName(type);
      label.className = type.active ? '' : 'text-muted text-decoration-line-through';

      var actions = document.createElement('span');
      actions.className = 'd-flex gap-2';

      var editButton = document.createElement('button');
      editButton.type = 'button';
      editButton.className = 'btn btn-sm btn-outline-primary';
      editButton.textContent = 'تعديل';
      editButton.dataset.editCarType = type.id;

      var toggleButton = document.createElement('button');
      toggleButton.type = 'button';
      toggleButton.className =
        'btn btn-sm ' + (type.active ? 'btn-outline-danger' : 'btn-outline-success');
      toggleButton.textContent = type.active ? 'إيقاف' : 'تفعيل';
      toggleButton.dataset.toggleCarType = type.id;

      actions.appendChild(editButton);
      actions.appendChild(toggleButton);
      item.appendChild(label);
      item.appendChild(actions);
      list.appendChild(item);
    });
  }

  function openManager() {
    var modalElement = document.getElementById('carTypeManagerModal');
    var modal = bootstrap.Modal.getOrCreateInstance(modalElement);
    document.getElementById('carTypeManagerForm').reset();
    document.getElementById('carTypeManagerId').value = '';
    document.getElementById('carTypeManagerModalTitle').textContent = 'إدارة أنواع السيارات';
    renderManagerList();
    modal.show();
  }

  function injectManager() {
    if (!document.querySelector('[data-car-type-manager-trigger]')) return;
    if (!document.getElementById('carTypeManagerModal')) {
      var wrapper = document.createElement('div');
      wrapper.innerHTML =
        '<div class="modal fade" id="carTypeManagerModal" tabindex="-1" aria-hidden="true">' +
        '<div class="modal-dialog modal-dialog-centered"><div class="modal-content">' +
        '<div class="modal-header"><h5 class="modal-title" id="carTypeManagerModalTitle">إدارة أنواع السيارات</h5>' +
        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button></div>' +
        '<div class="modal-body"><ul class="list-group mb-4" id="carTypeManagerList"></ul>' +
        '<form id="carTypeManagerForm"><input type="hidden" id="carTypeManagerId" />' +
        '<div class="mb-3"><label class="form-label" for="carTypeNameAr">الاسم بالعربي</label>' +
        '<input class="form-control" id="carTypeNameAr" required /></div>' +
        '<div class="mb-3"><label class="form-label" for="carTypeNameEn">الاسم بالإنجليزي</label>' +
        '<input class="form-control" id="carTypeNameEn" required /></div>' +
        '<button type="submit" class="btn btn-primary">حفظ النوع</button></form></div></div></div></div>';
      document.body.appendChild(wrapper.firstElementChild);
    }

    document.querySelectorAll('[data-car-type-manager-trigger]').forEach(function (button) {
      button.addEventListener('click', openManager);
    });

    document.getElementById('carTypeManagerForm').addEventListener('submit', function (event) {
      event.preventDefault();
      var idField = document.getElementById('carTypeManagerId');
      var nameAr = document.getElementById('carTypeNameAr').value.trim();
      var nameEn = document.getElementById('carTypeNameEn').value.trim();
      if (!nameAr || !nameEn) return;

      var types = readTypes();
      var id = idField.value || 'car-type-' + Date.now();
      var existing = types.find(function (type) {
        return type.id === id;
      });
      if (existing) {
        existing.nameAr = nameAr;
        existing.nameEn = nameEn;
      } else {
        types.push({ id: id, nameAr: nameAr, nameEn: nameEn, active: true });
      }
      writeTypes(types);
      this.reset();
      idField.value = '';
      document.getElementById('carTypeManagerModalTitle').textContent = 'إدارة أنواع السيارات';
      renderManagerList();
    });

    document.getElementById('carTypeManagerList').addEventListener('click', function (event) {
      var editId = event.target.dataset.editCarType;
      var toggleId = event.target.dataset.toggleCarType;
      var types = readTypes();

      if (editId) {
        var editType = getType(editId);
        if (!editType) return;
        document.getElementById('carTypeManagerId').value = editType.id;
        document.getElementById('carTypeNameAr').value = editType.nameAr;
        document.getElementById('carTypeNameEn').value = editType.nameEn;
        document.getElementById('carTypeManagerModalTitle').textContent = 'تعديل نوع السيارة';
      }

      if (toggleId) {
        var toggleType = types.find(function (type) {
          return type.id === toggleId;
        });
        if (!toggleType) return;
        toggleType.active = !toggleType.active;
        writeTypes(types);
        renderManagerList();
      }
    });
  }

  function migrateLegacyRows() {
    document.querySelectorAll('[data-car-type]').forEach(function (row) {
      if (row.dataset.carTypeId) return;
      var legacyValue = row.dataset.carType.trim().toLowerCase();
      row.dataset.carTypeId = resolveTypeId(legacyValue);
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    migrateLegacyRows();
    injectManager();
    document.querySelectorAll('[data-car-type-select]').forEach(renderSelect);
    document.querySelectorAll('#carTypeDropdown').forEach(renderCustomDropdown);
    renderTypeCells();
    renderTypeFilter();
    applyTypeFilter();

    var filterMenu = document.getElementById('carTypeFilterMenu');
    if (filterMenu) {
      filterMenu.addEventListener('click', function (event) {
        var item = event.target.closest('[data-car-type-filter]');
        if (!item) return;
        event.preventDefault();
        document.body.dataset.carTypeFilter = item.dataset.carTypeFilter;
        var button = document.getElementById('carTypeFilterButton');
        if (button) button.textContent = item.textContent;
        applyTypeFilter();
      });
    }

    var searchInput = document.getElementById('platesSearchInput');
    if (searchInput) searchInput.addEventListener('input', applyTypeFilter);

    document.addEventListener('carTypesChanged', function () {
      document.querySelectorAll('[data-car-type-select]').forEach(renderSelect);
      document.querySelectorAll('#carTypeDropdown').forEach(renderCustomDropdown);
      renderTypeCells();
      renderTypeFilter();
      applyTypeFilter();
    });
  });
})();
