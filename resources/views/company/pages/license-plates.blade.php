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

            <form
              method="GET"
              action="{{ route('company.license-plates') }}"
              class="table-filter-bar"
              id="platesFilters"
            >
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
                      <select class="dropdown-item" name="brand" onchange="this.form.submit()">
                        <option value="">{{ __('company.common.223') }}</option>
                        @foreach ($brands as $brand)
                          <option value="{{ $brand['id'] }}" @selected((int) request('brand') === $brand['id'])>{{ $brand['title'] }}</option>
                        @endforeach
                      </select>
                    </li>
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
                      <select class="dropdown-item" name="car_model" onchange="this.form.submit()">
                        <option value="">{{ __('company.common.223') }}</option>
                        @foreach ($car_models as $model)
                          <option value="{{ $model['id'] }}" @selected((int) request('car_model') === $model['id'])>{{ $model['title'] }}</option>
                        @endforeach
                      </select>
                    </li>
                  </ul>
                </div>

                <div class="dropdown">
                  <button
                    type="button"
                    class="filter-btn dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    {{ __('company.common.571') }}<i class="bi bi-chevron-down"></i>
                  </button>
                  <ul class="dropdown-menu" id="carTypeFilterMenu">
                    <li>
                      <select class="dropdown-item" name="car_type" onchange="this.form.submit()">
                        <option value="">{{ __('company.common.223') }}</option>
                        @foreach ($car_types as $carType)
                          <option value="{{ $carType['id'] }}" @selected((int) request('car_type') === $carType['id'])>{{ $carType['title'] }}</option>
                        @endforeach
                      </select>
                    </li>
                  </ul>
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
                      <select class="dropdown-item" name="year" onchange="this.form.submit()">
                        <option value="">{{ __('company.common.223') }}</option>
                        @foreach ($years as $year)
                          <option value="{{ $year }}" @selected(request('year') == $year)>{{ $year }}</option>
                        @endforeach
                      </select>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="table-search">
                <i class="bi bi-search"></i>
                <input
                  type="search"
                  name="q"
                  value="{{ request('q') }}"
                  placeholder="{{ __('company.pages.license-plates.4') }}"
                />
              </div>
            </form>

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
                  @forelse ($cars as $car)
                    @php
                      $name = trim(($car->brand?->title ?? '').' '.($car->carModel?->title ?? '').' '.$car->year);
                      $photo = $car->image_url ?: asset('company/img/car.png');
                      $stocks = $car->branches->mapWithKeys(fn ($row) => [$row->id => (int) $row->pivot->stock])->all();
                    @endphp
                    <tr>
                      <td>
                        <span class="cell-car-thumb">
                          <a
                            href="#"
                            data-car-photo="{{ $photo }}"
                            data-car-name="{{ $name }}"
                          ><img src="{{ $photo }}" alt="{{ $name }}" /></a>
                        </span>
                      </td>
                      <td class="cell-primary">{{ $car->brand?->title ?? '—' }}</td>
                      <td class="cell-primary">{{ $car->carModel?->title ?? '—' }}</td>
                      <td>{{ $car->type?->title ?? '—' }}</td>
                      <td class="ltr-num">{{ $car->year }}</td>
                      <td class="ltr-num">
                        <button
                          type="button"
                          class="availability-count-btn"
                          data-bs-toggle="modal"
                          data-bs-target="#carAvailabilityModal"
                          data-action="availability"
                          data-car-id="{{ $car->id }}"
                          data-car-name="{{ $name }}"
                          data-car-total="{{ (int) $car->count }}"
                          data-car-image="{{ $photo }}"
                          data-car-stocks="{{ json_encode($stocks) }}"
                          data-update-url="{{ route('company.office-cars.stocks', ['car' => $car->id]) }}"
                        >
                          {{ (int) $car->count }} <i class="bi bi-info-circle"></i>
                        </button>
                      </td>
                      <td class="cell-actions">
                        <a
                          href="{{ route('company.edit-car') }}?car={{ $car->id }}"
                          class="btn btn-primary btn-sm d-inline-block"
                          title="{{ __('company.common.309') }}"
                        ><i class="bi bi-pencil"></i></a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="7">
                        <div class="empty-state">
                          <i class="bi bi-car-front empty-state__icon"></i>
                          <span>{{ __('company.cars.empty') }}</span>
                        </div>
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <div class="table-pagination table-pagination-dt">
              <div class="table-pagination__size-select">
                <form method="GET" action="{{ route('company.license-plates') }}" class="d-inline">
                  @foreach (request()->except(['per_page', 'page']) as $key => $value)
                    @if ($value !== null && $value !== '')
                      <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
                    @endif
                  @endforeach
                  <label for="pageSizeSelect">{{ __('company.common.212') }}</label>
                  <select id="pageSizeSelect" name="per_page" onchange="this.form.submit()">
                    @foreach ([10, 25, 50, 100] as $size)
                      <option value="{{ $size }}" @selected($cars->perPage() === $size)>{{ $size }}</option>
                    @endforeach
                  </select>
                </form>
              </div>
              <div class="table-pagination__pages">
                @if ($cars->onFirstPage())
                  <button class="table-pagination__page-btn" disabled>
                    <i class="bi bi-chevron-right"></i>
                  </button>
                @else
                  <a
                    class="table-pagination__page-btn"
                    href="{{ $cars->previousPageUrl() }}"
                    rel="prev"
                  >
                    <i class="bi bi-chevron-right"></i>
                  </a>
                @endif

                @foreach ($cars->getUrlRange(1, $cars->lastPage()) as $page => $url)
                  @if ($page == $cars->currentPage())
                    <button class="table-pagination__page-btn is-active">{{ $page }}</button>
                  @else
                    <a class="table-pagination__page-btn" href="{{ $url }}">{{ $page }}</a>
                  @endif
                @endforeach

                @if ($cars->hasMorePages())
                  <a
                    class="table-pagination__page-btn"
                    href="{{ $cars->nextPageUrl() }}"
                    rel="next"
                  >
                    <i class="bi bi-chevron-left"></i>
                  </a>
                @else
                  <button class="table-pagination__page-btn" disabled>
                    <i class="bi bi-chevron-left"></i>
                  </button>
                @endif
              </div>
            </div>
          </div>
@endsection

@include('company.partials.car-availability-modals')

@push('modals')
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
@endpush

@push('scripts')
    <script>
      (function () {
        'use strict';

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

        if (!importCarsExcel) {
          return;
        }

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
            var count = 0;
            var names = [];

            try {
              var data = new Uint8Array(e.target.result);
              var workbook = XLSX.read(data, { type: 'array' });
              var sheetName = workbook.SheetNames[0];
              var rows = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], { defval: '' });

              rows.forEach(function (row) {
                var brand = getValue(row, ['الشركة المصنعة', 'المصنع', 'brand', 'make']);
                var model = getValue(row, ['الموديل', 'model']);
                var year = getValue(row, ['السنة', 'year']);

                if (brand || model || year) {
                  names.push([brand, model, year].filter(Boolean).join(' '));
                  count++;
                }
              });
            } catch (error) {
              console.error(error);
              alert('حدث خطأ أثناء قراءة ملف Excel.');
            } finally {
              importCarsInput.value = '';
            }

            // The file is only previewed, not saved: the sheet needs a real
            // import endpoint before rows would survive a page reload.
            alert(
              count
                ? 'تم قراءة ' + count + ' سيارة (' + names.slice(0, 3).join('، ') + ').\nالحفظ غير مفعّل بعد.'
                : 'ملف Excel لا يحتوي على بيانات قابلة للاستيراد.',
            );
          };

          reader.readAsArrayBuffer(file);
        });
      })();
    </script>
@endpush

