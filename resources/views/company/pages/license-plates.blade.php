@extends('company.layouts.master')

@section('title', 'T-Car — License Plates')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.472') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.202') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.common.472') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
              <a href="{{ route('company.add-car') }}" class="btn btn-primary"
                ><i class="bi bi-car-front"></i>{{ __('company.common.85') }}</a
              >
              <button type="button" class="btn btn-outline" id="importCarsExcel">
                <i class="bi bi-file-earmark-arrow-up"></i> {{ __('company.pages.license-plates.0') }}</button>
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
                      ><i class="bi bi-file-earmark-excel"></i>{{ __('company.common.302') }}</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>

          
          <div class="table-card mb-4">
            <div class="table-toolbar">
              <div class="table-toolbar__left">
                <div class="view-tabs" role="tablist"  aria-label="{{ __('company.pages.license-plates.3') }}">
                  <button
                    type="button"
                    class="view-tabs__btn is-active"
                    role="tab"
                    aria-selected="true"
                  >
                    {{ __('company.common.223') }}</button>
                  <button type="button" class="view-tabs__btn" role="tab" aria-selected="false">
                    {{ __('company.pages.license-plates.1') }}</button>
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
                  >
                    {{ __('company.common.207') }}<i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">{{ __('company.common.223') }}</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">TOYOTA</a></li>
                    <li>
                      <a class="dropdown-item" href="#" data-bs-dismiss="dropdown">HYUNDAI</a>
                    </li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">KIA</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">MG</a></li>
                  </ul>
                </div>

                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    {{ __('company.common.241') }}<i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">{{ __('company.common.223') }}</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">Yaris</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">Accent</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">Pegas</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">i10</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">MG 5</a></li>
                  </ul>
                </div>

                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    id="carTypeFilterButton"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    {{ __('company.common.571') }}<i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu" id="carTypeFilterMenu"></ul>
                </div>

                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    {{ __('company.common.201') }}<i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <div class="dropdown-search">
                        <i class="bi bi-search"></i>
                        <input type="search"  placeholder="{{ __('company.common.264') }}" />
                      </div>
                    </li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">{{ __('company.common.223') }}</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">2026</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">2025</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">2024</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-dismiss="dropdown">2023</a></li>
                  </ul>
                </div>
              </div>

              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="platesSearchInput"  placeholder="{{ __('company.pages.license-plates.4') }}" />
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="data-table" id="platesTable">
                <thead>
                  <tr>
                    <th>{{ __('company.pages.license-plates.2') }}</th>
                    <th>{{ __('company.common.207') }}</th>
                    <th>{{ __('company.common.241') }}</th>
                    <th>{{ __('company.common.571') }}</th>
                    <th>{{ __('company.common.201') }}</th>
                    <th>{{ __('company.common.227') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr data-car-type-id="sedan" data-car-image-key="car-demo-1">
                    <td>
                      <span class="cell-car-thumb"
                        ><a
                          href="#"
                          onclick="
                            openImageModal('img/car.png', 'FORD Taurus');
                            return false;
                          "
                          ><img src="{{ asset('company/img/car.png') }}" alt="FORD Taurus" /></a
                      ></span>
                    </td>
                    <td class="cell-primary">FORD</td>
                    <td class="cell-primary">Taurus</td>
                    <td data-car-type-cell></td>
                    <td class="ltr-num">2026</td>
                    <td class="ltr-num">
                      <button
                        type="button"
                        class="availability-count-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#carAvailabilityModal"
                        data-car-model="Taurus"
                        data-car-brand="FORD"
                        data-car-year="2026"
                        data-plate-count="1045"
                      >
                        1045 <i class="bi bi-info-circle"></i>
                      </button>
                    </td>
                    <td>
                      <a href="{{ route('company.add-car') }}" class="btn btn-primary btn-sm d-inline-block"
                        ><i class="bi bi-pencil"></i
                      ></a>
                    </td>
                  </tr>
                  <tr data-car-type-id="hatchback" data-car-image-key="car-demo-2">
                    <td>
                      <span class="cell-car-thumb"
                        ><a
                          href="#"
                          onclick="
                            openImageModal('img/car.png', 'Suzuki Dzire');
                            return false;
                          "
                          ><img src="{{ asset('company/img/car.png') }}" alt="Suzuki Dzire" /></a
                      ></span>
                    </td>
                    <td class="cell-primary">Suzuki</td>
                    <td class="cell-primary">Dzire</td>
                    <td data-car-type-cell></td>
                    <td class="ltr-num">2023</td>
                    <td class="ltr-num">
                      <button
                        type="button"
                        class="availability-count-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#carAvailabilityModal"
                        data-car-model="Dzire"
                        data-car-brand="Suzuki"
                        data-car-year="2023"
                        data-plate-count="9635"
                      >
                        9635 <i class="bi bi-info-circle"></i>
                      </button>
                    </td>
                    <td>
                      <a href="{{ route('company.add-car') }}" class="btn btn-primary btn-sm d-inline-block"
                        ><i class="bi bi-pencil"></i
                      ></a>
                    </td>
                  </tr>
                  <tr data-car-type-id="suv" data-car-image-key="car-demo-3">
                    <td>
                      <span class="cell-car-thumb"
                        ><a
                          href="#"
                          onclick="
                            openImageModal('img/car.png', 'HYUNDAI Tucson');
                            return false;
                          "
                          ><img src="{{ asset('company/img/car.png') }}" alt="HYUNDAI Tucson" /></a
                      ></span>
                    </td>
                    <td class="cell-primary">HYUNDAI</td>
                    <td class="cell-primary">Tucson</td>
                    <td data-car-type-cell></td>
                    <td class="ltr-num">2023</td>
                    <td class="ltr-num">
                      <button
                        type="button"
                        class="availability-count-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#carAvailabilityModal"
                        data-car-model="Tucson"
                        data-car-brand="HYUNDAI"
                        data-car-year="2023"
                        data-plate-count="803"
                      >
                        803 <i class="bi bi-info-circle"></i>
                      </button>
                    </td>
                    <td>
                      <a href="{{ route('company.add-car') }}" class="btn btn-primary btn-sm d-inline-block"
                        ><i class="bi bi-pencil"></i
                      ></a>
                    </td>
                  </tr>
                  <tr data-car-type-id="sedan" data-car-image-key="car-demo-4">
                    <td>
                      <span class="cell-car-thumb"
                        ><a
                          href="#"
                          onclick="
                            openImageModal('img/car.png', 'Chery Arrizo 5');
                            return false;
                          "
                          ><img src="{{ asset('company/img/car.png') }}" alt="Chery Arrizo 5" /></a
                      ></span>
                    </td>
                    <td class="cell-primary">Chery</td>
                    <td class="cell-primary">Arrizo 5</td>
                    <td data-car-type-cell></td>
                    <td class="ltr-num">2023</td>
                    <td class="ltr-num">
                      <button
                        type="button"
                        class="availability-count-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#carAvailabilityModal"
                        data-car-model="Arrizo 5"
                        data-car-brand="Chery"
                        data-car-year="2023"
                        data-plate-count="419"
                      >
                        419 <i class="bi bi-info-circle"></i>
                      </button>
                    </td>
                    <td>
                      <a href="{{ route('company.add-car') }}" class="btn btn-primary btn-sm d-inline-block"
                        ><i class="bi bi-pencil"></i
                      ></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="table-pagination table-pagination-dt">
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
      id="carAvailabilityModal"
      tabindex="-1"
      aria-labelledby="carAvailabilityModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="carAvailabilityModalLabel">{{ __('company.common.353') }}</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>

          <div class="availability-modal__body">
            <div class="availability-summary">
              <div class="availability-car-chip">
                <div class="availability-car-chip__thumb"><img src="{{ asset('company/img/car.png') }}" alt="Car" /></div>
                <div class="availability-car-chip__text">
                  <span class="availability-car-chip__name" id="availCarName"
                    >{{ __('company.common.585') }}</span
                  >
                  <span class="availability-car-chip__sub" id="availCarSub">{{ __('company.common.582') }}</span>
                </div>
              </div>
              <div class="availability-stat">
                <span class="availability-stat__value" id="availTotalCount">1</span>
                <span class="availability-stat__label">Total available</span>
              </div>
            </div>

            <div class="table-responsive-custom">
              <table class="availability-table">
                <thead>
                  <tr>
                    <th>{{ __('company.common.431') }}</th>
                    <th>{{ __('company.common.547') }}</th>
                    <th>{{ __('company.common.227') }}</th>
                  </tr>
                </thead>
                <tbody id="availabilityTableBody">
                  <tr>
                    <td class="cell-office-name">N2</td>
                    <td>{{ __('company.common.49') }}</td>
                    <td>
                      <span class="cell-available-count"><i class="bi bi-car-front"></i> 1</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="cell-office-name">N2</td>
                    <td>N2-Al-Olaya</td>
                    <td>
                      <span class="cell-available-count"><i class="bi bi-car-front"></i> 0</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="cell-office-name">N2</td>
                    <td>N2 Rental Car - Rawdah</td>
                    <td>
                      <span class="cell-available-count"><i class="bi bi-car-front"></i> 0</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="availability-modal__footer">
            <button type="button" class="link-cancel" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
            <button type="button" class="btn btn-primary" id="availSaveBtn">{{ __('company.common.375') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="imageModal"
      tabindex="-1"
      aria-labelledby="imageModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="imageModalLabel">{{ __('company.common.436') }}</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body text-center">
            <img
              id="modalImage"
              src=""
               alt="{{ __('company.common.436') }}"
              style="max-width: 100%; max-height: 500px; object-fit: contain"
            />
          </div>
        </div>
      </div>
    </div>

    
@endpush

@push('libs')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script src="{{ asset('company/js/car-types.js?v=3') }}"></script>
<script src="{{ asset('company/js/car-images.js?v=3') }}"></script>
@endpush

@push('scripts')
<script> wrapper — it is now consolidated into one script,
     avoiding the duplicate 'availability-count-btn' click listener that
     existed both here and in the DOMContentLoaded block below. -->
    <script>
      var platesTable = document.getElementById('platesTable');
      var platesTableBody = platesTable ? platesTable.querySelector('tbody') : null;
      var importCarsExcel = document.getElementById('importCarsExcel');
      var importCarsInput = document.createElement('input');

      importCarsInput.type = 'file';
      importCarsInput.accept = '.xlsx,.xls';
      importCarsInput.hidden = true;
      document.body.appendChild(importCarsInput);

      function getValue(row, keys) {
        var normalizedRow = {};
        Object.keys(row || {}).forEach(function (key) {
          normalizedRow[key.toString().trim().toLowerCase().replace(/\s+/g, '')] = row[key];
        });

        for (var i = 0; i < keys.length; i++) {
          var normalizedKey = keys[i].toLowerCase().replace(/\s+/g, '');
          if (
            normalizedRow[normalizedKey] !== undefined &&
            normalizedRow[normalizedKey] !== null &&
            normalizedRow[normalizedKey] !== ''
          ) {
            return normalizedRow[normalizedKey];
          }
        }

        return '';
      }

      function updateAvailabilityModal(brand, model, year, plateCount) {
        document.getElementById('availCarName').textContent = [brand, model, year]
          .filter(Boolean)
          .join(' ');
        document.getElementById('availCarSub').textContent = brand || '-';
        document.getElementById('availTotalCount').textContent = plateCount || '0';
      }

      function createCarRow(car) {
        var tr = document.createElement('tr');
        tr.dataset.carTypeId = car.carTypeId || '';
        if (car.carTypeId) tr.dataset.carType = car.carTypeId;
        var carLabel = (car.brand || 'Car') + ' ' + (car.model || 'Imported');
        var availability = car.availability || '0';
        var year = car.year || '';

        var imageCell = document.createElement('td');
        var thumb = document.createElement('span');
        thumb.className = 'cell-car-thumb';
        var imageLink = document.createElement('a');
        imageLink.href = '#';
        imageLink.addEventListener('click', function (event) {
          event.preventDefault();
          openImageModal('img/car.png', carLabel);
        });
        var image = document.createElement('img');
        image.src = 'img/car.png';
        image.alt = carLabel;
        imageLink.appendChild(image);
        thumb.appendChild(imageLink);
        imageCell.appendChild(thumb);

        var brandCell = document.createElement('td');
        brandCell.className = 'cell-primary';
        brandCell.textContent = car.brand || '-';

        var modelCell = document.createElement('td');
        modelCell.className = 'cell-primary';
        modelCell.textContent = car.model || '-';

        var carTypeCell = document.createElement('td');
        carTypeCell.setAttribute('data-car-type-cell', '');

        var yearCell = document.createElement('td');
        yearCell.className = 'ltr-num';
        yearCell.textContent = year;

        var availabilityCell = document.createElement('td');
        availabilityCell.className = 'ltr-num';
        var availabilityButton = document.createElement('button');
        availabilityButton.type = 'button';
        availabilityButton.className = 'availability-count-btn';
        availabilityButton.setAttribute('data-bs-toggle', 'modal');
        availabilityButton.setAttribute('data-bs-target', '#carAvailabilityModal');
        availabilityButton.setAttribute('data-car-model', car.model || '');
        availabilityButton.setAttribute('data-car-brand', car.brand || '');
        availabilityButton.setAttribute('data-car-year', year);
        availabilityButton.setAttribute('data-plate-count', availability);
        availabilityButton.innerHTML = availability + ' <i class="bi bi-info-circle"></i>';
        availabilityCell.appendChild(availabilityButton);

        var actionsCell = document.createElement('td');
        actionsCell.innerHTML =
          '<a href="{{ route('company.add-car') }}" class="btn btn-primary btn-sm d-inline-block"><i class="bi bi-pencil"></i></a>';

        tr.appendChild(imageCell);
        tr.appendChild(brandCell);
        tr.appendChild(modelCell);
        tr.appendChild(carTypeCell);
        tr.appendChild(yearCell);
        tr.appendChild(availabilityCell);
        tr.appendChild(actionsCell);

        return tr;
      }

      // Handle availability count button clicks for existing and imported rows
      // (single delegated listener — replaces the old per-button + duplicate
      // DOMContentLoaded listeners that previously fought over the same modal)
      if (platesTable) {
        platesTable.addEventListener('click', function (event) {
          var button = event.target.closest('.availability-count-btn');

          if (!button) {
            return;
          }

          updateAvailabilityModal(
            button.getAttribute('data-car-brand'),
            button.getAttribute('data-car-model'),
            button.getAttribute('data-car-year'),
            button.getAttribute('data-plate-count'),
          );
        });
      }

      if (importCarsExcel && importCarsInput) {
        importCarsExcel.addEventListener('click', function (event) {
          event.preventDefault();
          importCarsInput.click();
        });

        importCarsInput.addEventListener('change', function () {
          var file = this.files && this.files[0];

          if (!file) {
            return;
          }

          if (typeof XLSX === 'undefined') {
            alert('تعذر تحميل مكتبة قراءة Excel.');
            this.value = '';
            return;
          }

          var reader = new FileReader();

          reader.onload = function (e) {
            try {
              var data = new Uint8Array(e.target.result);
              var workbook = XLSX.read(data, { type: 'array' });
              var sheetName = workbook.SheetNames[0];
              var rows = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], { defval: '' });

              if (!rows.length) {
                alert('ملف Excel لا يحتوي على بيانات قابلة للاستيراد.');
                return;
              }

              var importedCount = 0;

              rows.forEach(function (row) {
                var brand = getValue(row, ['الشركة المصنعة', 'المصنع', 'brand', 'make']);
                var model = getValue(row, ['الموديل', 'model']);
                var year = getValue(row, ['السنة', 'year']);
                var availability = getValue(row, ['المتوفر', 'available', 'availability']) || '0';
                var carTypeId = getValue(row, ['نوع السيارة', 'car type', 'carTypeId']);

                if (!brand && !model && !year) {
                  return;
                }

                platesTableBody.appendChild(
                  createCarRow({
                    brand: brand,
                    model: model,
                    year: year,
                    availability: availability,
                    carTypeId: carTypeId,
                  }),
                );
                importedCount++;
              });

              alert('تم استيراد ' + importedCount + ' سيارة من ملف Excel.');
            } catch (error) {
              console.error(error);
              alert('حدث خطأ أثناء قراءة ملف Excel.');
            } finally {
              importCarsInput.value = '';
            }
          };

          reader.readAsArrayBuffer(file);
        });
      }

      // Function to open the car-image modal
      function openImageModal(imageSrc, imageTitle) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModalLabel').textContent = imageTitle;
        var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
      }
    </script>
@endpush

