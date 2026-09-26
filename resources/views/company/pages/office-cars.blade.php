@extends('company.layouts.master')

@section('title', 'T-Car — قائمة السيارات في المكتب')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.cars.list_title') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('company.branches') }}">{{ __('company.common.235') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.cars.list_title') }}</span>
              </nav>
            </div>
          </div>

          @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
          @endif

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $message)
                  <li>{{ $message }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          
          <div class="office-info-header mb-4">
            <div class="office-info-header__left">
              <h2 class="office-info-header__title">
                @if ($branch_id)
                  {{ $branches->firstWhere('id', $branch_id)['title'] ?? __('company.cars.list_title') }}
                @else
                  {{ __('company.cars.all_branches') }}
                @endif
              </h2>
              <p class="office-info-header__subtitle">{{ __('company.cars.list_subtitle') }}</p>
            </div>
            <div class="office-info-header__right">
              <a href="{{ route('company.add-car', array_filter(['branch' => $branch_id])) }}" class="btn btn-primary"
                ><i class="bi bi-car-front"></i> {{ __('company.common.85') }}</a
              >
            </div>
          </div>

          
          <div class="table-card mb-4">
            <div class="table-toolbar">
              <div class="table-toolbar__left">
                <div class="view-tabs" role="tablist"  aria-label="{{ __('company.common.305') }}">
                  @php
                    $tabUrl = fn (string $status) => route('company.office-cars', array_filter([
                      'branch' => $branch_id,
                      'brand' => request('brand'),
                      'car_type' => request('car_type'),
                      'car_model' => request('car_model'),
                      'year' => request('year'),
                      'q' => request('q'),
                      'per_page' => request('per_page'),
                      'status' => $status === 'all' ? null : $status,
                    ], fn ($v) => $v !== null && $v !== ''));
                  @endphp
                  <a
                    class="view-tabs__btn {{ $status === 'all' ? 'is-active' : '' }}"
                    role="tab"
                    aria-selected="{{ $status === 'all' ? 'true' : 'false' }}"
                    href="{{ $tabUrl('all') }}"
                  >
                    {{ __('company.common.223') }}</a>
                  <a
                    class="view-tabs__btn {{ $status === 'available' ? 'is-active' : '' }}"
                    role="tab"
                    aria-selected="{{ $status === 'available' ? 'true' : 'false' }}"
                    href="{{ $tabUrl('available') }}"
                  >
                    {{ __('company.cars.available') }}</a>
                  <a
                    class="view-tabs__btn {{ $status === 'unavailable' ? 'is-active' : '' }}"
                    role="tab"
                    aria-selected="{{ $status === 'unavailable' ? 'true' : 'false' }}"
                    href="{{ $tabUrl('unavailable') }}"
                  >
                    {{ __('company.cars.unavailable') }}</a>
                </div>
              </div>
            </div>

            <div class="table-filter-bar">
              {{--
                Every filter is a plain GET control inside one form: picking an
                option submits the form and the server re-renders the table, so
                the URL alone always describes the result. No ajax is involved,
                and the empty state below is rendered by the same query.
              --}}
              <form
                class="table-filter-bar__left d-flex flex-wrap align-items-center gap-2"
                method="GET"
                action="{{ route('company.office-cars') }}"
                id="carFiltersForm"
              >
                <select name="branch" class="filter-dropdown-btn" aria-label="{{ __('company.common.235') }}">
                  <option value="">{{ __('company.cars.all_branches') }}</option>
                  @foreach ($branches as $branch)
                    <option value="{{ $branch['id'] }}" @selected($branch_id === $branch['id'])>{{ $branch['title'] }}</option>
                  @endforeach
                </select>

                <select name="brand" class="filter-dropdown-btn" aria-label="{{ __('company.common.207') }}">
                  <option value="">{{ __('company.common.223') }}</option>
                  @foreach ($brands as $brand)
                    <option value="{{ $brand['id'] }}" @selected((int) request('brand') === $brand['id'])>{{ $brand['title'] }}</option>
                  @endforeach
                </select>

                <select name="car_model" class="filter-dropdown-btn" aria-label="{{ __('company.common.241') }}">
                  <option value="">{{ __('company.common.223') }}</option>
                  @foreach ($car_models as $model)
                    <option value="{{ $model['id'] }}" @selected((int) request('car_model') === $model['id'])>{{ $model['title'] }}</option>
                  @endforeach
                </select>

                <select name="car_type" class="filter-dropdown-btn" aria-label="{{ __('company.cars.car_type') }}">
                  <option value="">{{ __('company.common.223') }}</option>
                  @foreach ($car_types as $type)
                    <option value="{{ $type['id'] }}" @selected((int) request('car_type') === $type['id'])>{{ $type['title'] }}</option>
                  @endforeach
                </select>

                <select name="year" class="filter-dropdown-btn" aria-label="{{ __('company.common.201') }}">
                  <option value="">{{ __('company.common.223') }}</option>
                  @foreach ($years as $year)
                    <option value="{{ $year }}" @selected((int) request('year') === $year)>{{ $year }}</option>
                  @endforeach
                </select>

                <input
                  type="search"
                  name="q"
                  class="table-search__input"
                  value="{{ request('q') }}"
                  placeholder="{{ __('company.cars.search_placeholder') }}"
                  aria-label="{{ __('company.cars.search_placeholder') }}"
                />

                <input type="hidden" name="per_page" value="{{ $cars->perPage() }}" />
                <input type="hidden" name="status" value="{{ $status }}" />

                <button type="submit" class="btn btn-primary btn-sm">{{ __('company.common.78') }}</button>
                @if (request()->hasAny(['branch', 'brand', 'car_model', 'car_type', 'year', 'q', 'status']))
                  <a class="btn btn-outline btn-sm" href="{{ route('company.office-cars') }}">{{ __('company.cars.clear_filters') }}</a>
                @endif
              </form>
            </div>

            <div class="table-responsive-custom">
              <table class="office-table" id="officeCarsTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.207') }}</th>
                    <th>{{ __('company.common.241') }}</th>
                    <th>{{ __('company.cars.car_type') }}</th>
                    <th>{{ __('company.common.201') }}</th>
                    <th>{{ $branch_id ? __('company.cars.available_in_branch') : __('company.common.496') }}</th>
                    <th>{{ __('company.cars.total') }}</th>
                    <th>{{ __('company.common.165') }}</th>
                    <th>{{ __('company.common.76') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($cars as $car)
                    @php
                      $stock = $branch_id
                          ? ($branch_stocks[$car->id] ?? 0)
                          : (int) $car->count;
                    @endphp
                    <tr>
                      <td>{{ $car->brand?->title ?? '—' }}</td>
                      <td>{{ $car->carModel?->title ?? '—' }}</td>
                      <td>{{ $car->type?->title ?? '—' }}</td>
                      <td class="ltr-num">{{ $car->year }}</td>
                      <td class="ltr-num">{{ $stock }}</td>
                      <td class="ltr-num">{{ (int) $car->count }}</td>
                      <td>
                        <button
                          type="button"
                          class="status-toggle {{ $stock > 0 ? 'status-toggle--active' : 'status-toggle--inactive' }}"
                          data-status="{{ $stock > 0 ? 'active' : 'inactive' }}"
                          disabled
                          aria-disabled="true"
                          title="{{ $stock > 0 ? __('company.cars.available') : __('company.cars.unavailable') }}"
                        >
                          {{ $stock > 0 ? __('company.cars.available') : __('company.cars.unavailable') }}
                        </button>
                      </td>
                      <td class="cell-actions">
                        <div class="action-menu-wrapper">
                          <a
                            href="{{ route('company.edit-car') }}?car={{ $car->id }}{{ $branch_id ? '&branch='.$branch_id : '' }}"
                            class="btn btn-primary btn-sm"
                            title="{{ __('company.common.309') }}"
                            ><i class="bi bi-pencil"></i
                          ></a>
                          <button class="action-menu-btn"  title="{{ __('company.common.384') }}">
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <div class="action-menu-dropdown">
                            <button
                              type="button"
                              class="action-menu-item"
                              data-bs-toggle="modal"
                              data-bs-target="#carAvailabilityModal"
                              data-action="availability"
                              data-car-id="{{ $car->id }}"
                              data-car-name="{{ $car->brand?->title }} {{ $car->carModel?->title }} {{ $car->year }}"
                              data-car-total="{{ (int) $car->count }}"
                              data-car-image="{{ $car->image_url ?: asset('company/img/car.png') }}"
                              data-car-stocks="{{ json_encode($car->branches->mapWithKeys(fn ($row) => [$row->id => (int) $row->pivot->stock])->all()) }}"
                              data-update-url="{{ route('company.office-cars.stocks', ['car' => $car->id]) }}"
                            >
                              <i class="bi bi-check-circle"></i> {{ __('company.common.353') }}</button>
                            <button
                              type="button"
                              class="action-menu-item"
                              data-bs-toggle="modal"
                              data-bs-target="#carLogsModal"
                              data-action="logs"
                              data-car-name="{{ $car->brand?->title }} {{ $car->carModel?->title }} {{ $car->year }}"
                            >
                              <i class="bi bi-clock-history"></i> {{ __('company.cars.activity') }}</button>
                            <form
                              method="POST"
                              action="{{ route('company.edit-car.destroy', ['car' => $car->id]) }}"
                              class="d-inline"
                              data-confirm="{{ __('company.cars.delete_confirm') }}"
                            >
                              @csrf
                              @method('DELETE')
                              @if ($branch_id)
                                <input type="hidden" name="branch" value="{{ $branch_id }}" />
                              @endif
                              <button type="submit" class="action-menu-item w-100">
                                <i class="bi bi-trash"></i> {{ __('company.common.370') }}
                              </button>
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="8">
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
                <form method="GET" action="{{ route('company.office-cars') }}" class="d-inline">
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
                  <a class="table-pagination__page-btn" href="{{ $cars->previousPageUrl() }}" rel="prev">
                    <i class="bi bi-chevron-right"></i>
                  </a>
                @endif

                @foreach ($cars->getUrlRange(1, $cars->lastPage()) as $page => $url)
                  @if ($page === $cars->currentPage())
                    <button class="table-pagination__page-btn is-active" aria-current="page">{{ $page }}</button>
                  @else
                    <a class="table-pagination__page-btn" href="{{ $url }}">{{ $page }}</a>
                  @endif
                @endforeach

                @if ($cars->hasMorePages())
                  <a class="table-pagination__page-btn" href="{{ $cars->nextPageUrl() }}" rel="next">
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
