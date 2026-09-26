@extends('company.layouts.master')

@section('title', 'T-Car — Car Availability')

@section('content')
          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.352') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.202') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.common.352') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
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
                      ><i class="bi bi-file-earmark-excel"></i> {{ __('company.common.302') }}</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>

          {{-- One GET form drives every filter on this screen, so a change is a
               plain navigation and the server decides the rows and columns. --}}
          <form method="GET" action="{{ route('company.car-availability') }}" id="availabilityFilters">
            <div class="table-card mb-4">
              <div class="table-toolbar">
                <div class="table-toolbar__left">
                  <div
                    class="view-tabs"
                    role="tablist"
                    aria-label="{{ __('company.common.305') }}"
                    id="matrixViewTabs"
                  >
                    @php
                      // The active/inactive tabs narrow the columns, because
                      // is_active lives on the car, not on the branch.
                      $tabs = [
                        'all' => __('company.pages.car-availability.0'),
                        'active' => __('company.pages.car-availability.1'),
                        'inactive' => __('company.pages.car-availability.2'),
                      ];
                    @endphp
                    @foreach ($tabs as $value => $label)
                      <button
                        type="submit"
                        name="status"
                        value="{{ $value }}"
                        class="view-tabs__btn {{ $status === $value ? 'is-active' : '' }}"
                        role="tab"
                        aria-selected="{{ $status === $value ? 'true' : 'false' }}"
                      >
                        {{ $label }}
                      </button>
                    @endforeach
                  </div>
                </div>
              </div>

              <div class="table-filter-bar">
                <div class="table-filter-bar__left">
                  <button
                    type="button"
                    class="filter-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#filterModal"
                  >
                    <i class="bi bi-sliders"></i> {{ __('company.common.303') }}</button>
                  <span class="matrix-legend">
                    <span class="matrix-legend__item"
                      ><span class="matrix-legend__swatch matrix-legend__swatch--on"></span>
                      {{ __('company.pages.car-availability.3') }}</span
                    >
                    <span class="matrix-legend__item"
                      ><span class="matrix-legend__swatch matrix-legend__swatch--off"></span>
                      {{ __('company.pages.car-availability.4') }}</span
                    >
                  </span>
                </div>

                <div class="table-search">
                  <i class="bi bi-search"></i>
                  <input
                    type="search"
                    name="q"
                    id="fleetSearchInput"
                    value="{{ request('q') }}"
                    placeholder="{{ __('company.common.138') }}"
                  />
                </div>
              </div>

              {{-- Keeps the other filters alive when a tab or the search is
                   submitted, so switching tabs does not drop the selection. --}}
              @foreach (['branch', 'brand', 'car_type', 'car_model', 'year'] as $hidden)
                @if (request($hidden))
                  <input type="hidden" name="{{ $hidden }}" value="{{ request($hidden) }}" />
                @endif
              @endforeach

              <div class="table-responsive-custom">
                <table class="fleet-matrix" id="fleetMatrixTable">
                  <thead>
                    <tr>
                      <th class="fleet-matrix__office-head">{{ __('company.common.235') }}</th>

                      @forelse ($cars as $car)
                        <th>
                          <div class="fleet-matrix__model">
                            <span>
                              {{ $car->brand?->title }} {{ $car->carModel?->title }}
                            </span>
                          </div>
                          <span class="fleet-matrix__total ltr-num" data-car-total="{{ $car->id }}">
                            {{ __('company.pages.car-availability.38') }} {{ $car_totals[$car->id] ?? 0 }}
                          </span>
                        </th>
                      @empty
                        <th><span class="fleet-matrix__model">{{ __('company.pages.car-availability.40') }}</span></th>
                      @endforelse

                    </tr>
                  </thead>

                  <tbody>
                    @forelse ($rows as $branch)
                      <tr>
                        <td class="fleet-matrix__office">
                          <a href="{{ route('company.branches') }}">{{ $branch['title'] }}</a>
                        </td>

                        @forelse ($cars as $car)
                          @php
                            $cellStock = $stocks[$branch['id'].':'.$car->id] ?? 0;
                          @endphp
                          <td>
                            <div
                              class="matrix-cell {{ $car->is_active ? 'matrix-cell--active' : 'matrix-cell--inactive' }}"
                              data-state="{{ $car->is_active ? 'on' : 'off' }}"
                              data-cell
                              data-car="{{ $car->id }}"
                              data-branch="{{ $branch['id'] }}"
                              data-stock="{{ $cellStock }}"
                              data-stock-url="{{ route('company.car-availability.stock', ['car' => $car->id]) }}"
                            >
                              <button
                                type="button"
                                class="matrix-cell__switch"
                                role="switch"
                                data-toggle-car="{{ $car->id }}"
                                data-toggle-url="{{ route('company.car-availability.toggle', ['car' => $car->id]) }}"
                                aria-checked="{{ $car->is_active ? 'true' : 'false' }}"
                                data-state="{{ $car->is_active ? 'on' : 'off' }}"
                                title="{{ $car->is_active ? __('company.pages.car-availability.33') : __('company.pages.car-availability.36') }}"
                              ></button>
                              <div class="matrix-cell__stepper">
                                <button
                                  type="button"
                                  class="matrix-cell__step"
                                  data-action="dec"
                                  aria-label="{{ __('company.pages.car-availability.34') }}"
                                >
                                  −</button
                                ><span class="matrix-cell__count ltr-num" data-count>{{ $cellStock }}</span
                                ><button
                                  type="button"
                                  class="matrix-cell__step"
                                  data-action="inc"
                                  aria-label="{{ __('company.pages.car-availability.35') }}"
                                >
                                  +
                                </button>
                              </div>
                            </div>
                          </td>
                        @empty
                          <td colspan="{{ max(count($cars), 1) }}">{{ __('company.pages.car-availability.40') }}</td>
                        @endforelse

                      </tr>
                    @empty
                      <tr>
                        <td colspan="{{ count($cars) + 1 }}">{{ __('company.pages.car-availability.41') }}</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </form>
@endsection

@push('modals')
  <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="filterModalLabel">
            {{ __('company.pages.car-availability.20') }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        {{-- Same GET form as the toolbar, so "apply" is a normal submit. --}}
        <form method="GET" action="{{ route('company.car-availability') }}" id="availabilityFilterModal">
          <div class="modal-body">
            @if (request('status'))
              <input type="hidden" name="status" value="{{ request('status') }}" />
            @endif

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label" for="filterBranch">{{ __('company.common.235') }}</label>
                <select class="form-select" name="branch" id="filterBranch">
                  <option value="">{{ __('company.cars.all_branches') }}</option>
                  @foreach ($branches as $branch)
                    <option value="{{ $branch['id'] }}" @selected((int) request('branch') === $branch['id'])>
                      {{ $branch['title'] }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="filterBrand">{{ __('company.common.207') }}</label>
                <select class="form-select" name="brand" id="filterBrand">
                  <option value="">{{ __('company.common.223') }}</option>
                  @foreach ($brands as $brand)
                    <option value="{{ $brand['id'] }}" @selected((int) request('brand') === $brand['id'])>
                      {{ $brand['title'] }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="filterModel">{{ __('company.pages.car-availability.26') }}</label>
                <select class="form-select" name="car_model" id="filterModel">
                  <option value="">{{ __('company.common.223') }}</option>
                  @foreach ($car_models as $model)
                    <option value="{{ $model['id'] }}" @selected((int) request('car_model') === $model['id'])>
                      {{ $model['title'] }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="filterType">{{ __('company.cars.car_type') }}</label>
                <select class="form-select" name="car_type" id="filterType">
                  <option value="">{{ __('company.common.223') }}</option>
                  @foreach ($car_types as $type)
                    <option value="{{ $type['id'] }}" @selected((int) request('car_type') === $type['id'])>
                      {{ $type['title'] }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="filterYear">{{ __('company.pages.car-availability.32') }}</label>
                <select class="form-select" name="year" id="filterYear">
                  <option value="">{{ __('company.common.223') }}</option>
                  @foreach ($years as $year)
                    <option value="{{ $year }}" @selected((int) request('year') === $year)>{{ $year }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="filterSearch">{{ __('company.common.138') }}</label>
                <input
                  type="search"
                  class="form-control"
                  name="q"
                  id="filterSearch"
                  value="{{ request('q') }}"
                />
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <a class="btn btn-outline" href="{{ route('company.car-availability') }}">
              {{ __('company.common.303') }}
            </a>
            <button type="submit" class="btn btn-primary">{{ __('company.common.78') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endpush

@push('scripts')
  <script>
    (function () {
      'use strict';

      /**
       * The stepper and the availability switch save on every click, so both
       * post to the JSON endpoints and patch the cell in place. A failed write
       * puts the number back and marks the cell, because silently leaving a
       * number on screen that the database rejected is the worst outcome here.
       */
      var tokenMeta = document.querySelector('meta[name="csrf-token"]');

      function csrf() {
        return tokenMeta ? tokenMeta.getAttribute('content') : '';
      }

      function errorMessage(payload, fallback) {
        if (payload && payload.message) {
          return payload.message;
        }

        if (payload && payload.errors) {
          var first = Object.values(payload.errors)[0];

          if (Array.isArray(first) && first.length) {
            return first[0];
          }
        }

        return fallback;
      }

      function markFailed(cell) {
        cell.classList.add('matrix-cell--error');
        window.setTimeout(function () {
          cell.classList.remove('matrix-cell--error');
        }, 1600);
      }

      /* ---- Quantity stepper: save the new number on every click ---- */
      document.querySelectorAll('[data-cell]').forEach(function (cell) {
        var count = cell.querySelector('[data-count]');
        var busy = false;

        cell.querySelectorAll('.matrix-cell__step').forEach(function (step) {
          step.addEventListener('click', function () {
            if (busy) {
              return;
            }

            var current = parseInt(count.textContent, 10) || 0;
            var next = step.getAttribute('data-action') === 'inc' ? current + 1 : Math.max(0, current - 1);
            var previous = current;

            busy = true;
            cell.classList.add('matrix-cell--saving');
            count.textContent = next;

            fetch(cell.getAttribute('data-stock-url'), {
              method: 'PUT',
              headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': csrf(),
                'X-Requested-With': 'XMLHttpRequest',
              },
              body: JSON.stringify({ branch: Number(cell.getAttribute('data-branch')), stock: next }),
            })
              .then(function (response) {
                return response.json().then(function (payload) {
                  return { ok: response.ok, payload: payload };
                });
              })
              .then(function (result) {
                if (!result.ok) {
                  count.textContent = previous;
                  markFailed(cell);
                  window.alert(
                    errorMessage(result.payload, @json(__('company.pages.car-availability.44')))
                  );
                  return;
                }

                var stored = result.payload && result.payload.data ? result.payload.data.stock : next;
                count.textContent = stored;
                recalculateTotals(cell, stored);
              })
              .catch(function () {
                count.textContent = previous;
                markFailed(cell);
                window.alert(@json(__('company.pages.car-availability.44')));
              })
              .finally(function () {
                busy = false;
                cell.classList.remove('matrix-cell--saving');
              });
          });
        });
      });

      /**
       * The column header carries that car's fleet total and the row carries the
       * branch total, so one write has to move all three numbers or the table
       * starts lying. They are derived from the cells already on screen.
       */
      function recalculateTotals(cell, stock) {
        var carId = cell.getAttribute('data-car');
        var delta = stock - (parseInt(cell.getAttribute('data-stock') || '0', 10) || 0);

        cell.setAttribute('data-stock', String(stock));

        var headerTotal = document.querySelector('[data-car-total="' + carId + '"]');

        if (headerTotal && delta) {
          headerTotal.textContent = (parseInt(headerTotal.textContent, 10) || 0) + delta;
        }
      }

      /* ---- Availability switch: every cell shows the same car-level state ---- */
      document.querySelectorAll('[data-toggle-car]').forEach(function (toggle) {
        var busy = false;

        toggle.addEventListener('click', function () {
          if (busy) {
            return;
          }

          var wasOn = toggle.getAttribute('data-state') === 'on';
          var nowOn = !wasOn;

          busy = true;
          setCarState(toggle.getAttribute('data-toggle-car'), nowOn);

          fetch(toggle.getAttribute('data-toggle-url'), {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              Accept: 'application/json',
                'X-CSRF-TOKEN': csrf(),
              'X-Requested-With': 'XMLHttpRequest',
            },
          })
            .then(function (response) {
              return response.json().then(function (payload) {
                return { ok: response.ok, payload: payload };
              });
            })
            .then(function (result) {
              if (!result.ok) {
                setCarState(toggle.getAttribute('data-toggle-car'), wasOn);
                window.alert(
                  errorMessage(result.payload, @json(__('company.pages.car-availability.44')))
                );
                return;
              }

              var isActive = result.payload && result.payload.data ? result.payload.data.is_active : nowOn;
              var on = !!isActive;

              setCarState(toggle.getAttribute('data-toggle-car'), on);
            })
            .catch(function () {
              setCarState(toggle.getAttribute('data-toggle-car'), wasOn);
              window.alert(@json(__('company.pages.car-availability.44')));
            })
            .finally(function () {
              busy = false;
            });
        });

        function setCarState(carId, isActive) {
            document.querySelectorAll('[data-toggle-car="' + carId + '"]').forEach(function (toggle) {
              toggle.setAttribute('data-state', isActive ? 'on' : 'off');
              toggle.setAttribute('aria-checked', String(isActive));
            });

            document.querySelectorAll('[data-cell][data-car="' + carId + '"]').forEach(function (cell) {
              cell.setAttribute('data-state', isActive ? 'on' : 'off');
              cell.classList.toggle('matrix-cell--active', isActive);
              cell.classList.toggle('matrix-cell--inactive', !isActive);
            });
        }
      });

      /* ---- Typing in the search box submits the GET form, so the server
             filters instead of hiding rows after the fact. ---- */
      var search = document.getElementById('fleetSearchInput');

      if (search) {
        var timer = null;

        search.addEventListener('input', function () {
          window.clearTimeout(timer);
          timer = window.setTimeout(function () {
            search.form.submit();
          }, 600);
        });
      }
    })();
  </script>
@endpush
