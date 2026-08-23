@extends('admin.layouts.master')

@section('title', __('admin.common.dashboard') . ' | ' . __('admin.panel_name'))

@section('content')
  {{-- Welcome row --}}
  <div class="row mb-6 g-6">
    <div class="col-xl-12 col-lg-6">
      <div class="bg-gradient-mixed p-8 py-10 rounded-3 p-lg-7">
        <h1 class="fs-3">👋 {{ __('admin.dashboard.hello') }} {{ auth('admin')->user()?->name }},</h1>
        <p class="mb-0">{{ __('admin.dashboard.welcome_line1') }}</p>
        <p>{{ __('admin.dashboard.welcome_line2') }}</p>
      </div>
    </div>
    
  </div>

  {{-- Stats cards (filled via AJAX) --}}
  <div class="row row-cols-1 row-cols-xl-4 row-cols-md-2 mb-6 g-6" data-stats-url="{{ route('admin.dashboard.stats') }}">
    <div class="col">
      <div class="card card-lg">
        <div class="card-body d-flex flex-column gap-8">
          <div class="d-flex align-items-center gap-3">
            <div class="icon-shape icon-lg rounded-circle bg-warning-darker text-warning-lighter">
              <i class="ti ti-users" style="font-size:24px"></i>
            </div>
            <div>{{ __('admin.dashboard.total_users') }}</div>
          </div>
          <div class="d-flex justify-content-between align-items-center lh-1">
            <div class="fs-3 fw-bold" data-stat="users">—</div>
            <div class="text-success small">+12%
              <i class="ti ti-trending-up"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card card-lg">
        <div class="card-body d-flex flex-column gap-8">
          <div class="d-flex align-items-center gap-3">
            <div class="icon-shape icon-lg rounded-circle bg-success-darker text-success-lighter">
              <i class="ti ti-steering-wheel" style="font-size:24px"></i>
            </div>
            <div>{{ __('admin.dashboard.total_drivers') }}</div>
          </div>
          <div class="d-flex justify-content-between align-items-center lh-1">
            <div class="fs-3 fw-bold" data-stat="drivers">—</div>
            <div class="text-warning small">+8%
              <i class="ti ti-trending-up"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card card-lg">
        <div class="card-body d-flex flex-column gap-8">
          <div class="d-flex align-items-center gap-3">
            <div class="icon-shape icon-lg rounded-circle bg-info-darker text-info-lighter">
              <i class="ti ti-inbox" style="font-size:24px"></i>
            </div>
            <div>{{ __('admin.dashboard.join_requests') }}</div>
          </div>
          <div class="d-flex justify-content-between align-items-center lh-1">
            <div class="fs-3 fw-bold" data-stat="join_us">—</div>
            <div class="text-danger small">-3%
              <i class="ti ti-trending-down"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card card-lg">
        <div class="card-body d-flex flex-column gap-8">
          <div class="d-flex align-items-center gap-3">
            <div class="icon-shape icon-lg rounded-circle bg-primary-darker text-primary-lighter">
              <i class="ti ti-wallet" style="font-size:24px"></i>
            </div>
            <div>{{ __('admin.dashboard.wallet_balance') }}</div>
          </div>
          <div class="d-flex justify-content-between align-items-center lh-1">
            <div class="fs-3 fw-bold" data-stat="wallet">—</div>
            <div class="text-success small">+5%
              <i class="ti ti-trending-up"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Revenue charts --}}
  <div class="row g-6 mb-6">
    <div class="col-xl-8 col-12">
      <div class="card card-lg">
        <div class="card-body d-flex flex-column gap-5">
          <div class="mb-4">
            <h5 class="mb-0">{{ __('admin.dashboard.revenue') }}</h5>
          </div>
          <div class="bg-gray-100 p-3 rounded-3">
            <ul class="nav nav-pills-white nav-fill" id="chartTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="current-week-tab" data-bs-toggle="pill"
                  data-bs-target="#current-week" type="button" role="tab" aria-controls="current-week" aria-selected="true">
                  <span class="d-flex flex-column">
                    <span class="d-flex align-items-center gap-2">
                      <span><i class="ti ti-circle-filled text-primary"></i></span>
                      <span>{{ __('admin.dashboard.total_income') }}</span>
                    </span>
                    <span class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }} fs-3 fw-semibold mt-2">$120,000</span>
                  </span>
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="past-week-tab" data-bs-toggle="pill" data-bs-target="#past-week"
                  type="button" role="tab" aria-controls="past-week" aria-selected="false">
                  <span class="d-flex flex-column">
                    <span class="d-flex align-items-center gap-2">
                      <span><i class="ti ti-circle-filled text-warning"></i></span>
                      <span>{{ __('admin.dashboard.total_expenses') }}</span>
                    </span>
                    <span class="{{ app()->getLocale() === 'ar' ? 'text-end' : 'text-start' }} fs-3 fw-semibold mt-2">$198,214</span>
                  </span>
                </button>
              </li>
            </ul>
          </div>

          <div class="tab-content" id="chartTabsContent">
            <div class="tab-pane fade show active" id="current-week" role="tabpanel" aria-labelledby="current-week-tab">
              <div id="totalIncomeChart"></div>
            </div>
            <div class="tab-pane fade" id="past-week" role="tabpanel" aria-labelledby="past-week-tab">
              <div id="totalExpensesChart"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-12">
      <div class="card card-lg">
        <div class="card-body">
          <h5 class="mb-6">{{ __('admin.dashboard.trips_by_city') }}</h5>
          <div id="totalSale" class="d-flex justify-content-center"></div>
          <table class="table table-sm table-borderless mb-0 mt-5">
            <tbody>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <span><i class="ti ti-circle-filled text-primary"></i></span>
                    <span class="ms-1 me-1">{{ __('admin.dashboard.cairo') }}</span>
                  </div>
                </td>
                <td class="d-flex justify-content-end gap-2">
                  <span>1,240</span>
                  <span class="text-secondary">40%</span>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <span><i class="ti ti-circle-filled text-warning"></i></span>
                    <span class="ms-1 me-1">{{ __('admin.dashboard.giza') }}</span>
                  </div>
                </td>
                <td class="d-flex justify-content-end gap-2">
                  <span>930</span>
                  <span class="text-secondary">30%</span>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <span><i class="ti ti-circle-filled text-info"></i></span>
                    <span class="ms-1 me-1">{{ __('admin.dashboard.alexandria') }}</span>
                  </div>
                </td>
                <td class="d-flex justify-content-end gap-2">
                  <span>620</span>
                  <span class="text-secondary">20%</span>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <span><i class="ti ti-circle-filled text-danger"></i></span>
                    <span class="ms-1 me-1">{{ __('admin.dashboard.mansoura') }}</span>
                  </div>
                </td>
                <td class="d-flex justify-content-end gap-2">
                  <span>310</span>
                  <span class="text-secondary">10%</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- Recent trips + map --}}
  <div class="row g-6 mb-6">
    <div class="col-xl-8">
      <div class="card card-lg">
        <div class="card-header border-bottom-0">
          <h5 class="mb-0">{{ __('admin.dashboard.recent_trips') }}</h5>
        </div>
        <div class="table-responsive">
          <table class="table text-nowrap mb-0 table-centered table-hover">
            <thead>
              <tr>
                <th>{{ __('admin.dashboard.table_trip_id') }}</th>
                <th>{{ __('admin.dashboard.table_amount') }}</th>
                <th>{{ __('admin.dashboard.table_type') }}</th>
                <th>{{ __('admin.dashboard.table_date') }}</th>
                <th>{{ __('admin.dashboard.table_status') }}</th>
                <th>{{ __('admin.common.actions') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>#TR005</td>
                <td>EGP 150</td>
                <td>{{ __('admin.nav.users') }}</td>
                <td>Jan 20, 2026</td>
                <td><span class="badge text-info-emphasis bg-info-subtle">{{ __('admin.dashboard.badge_shipped') }}</span></td>
                <td><a href="#!" class="btn btn-white btn-sm">{{ __('admin.dashboard.view') }}</a></td>
              </tr>
              <tr>
                <td>#TR004</td>
                <td>EGP 200</td>
                <td>{{ __('admin.nav.companies') }}</td>
                <td>Jan 22, 2026</td>
                <td><span class="badge text-warning-emphasis bg-warning-subtle">{{ __('admin.dashboard.badge_pending') }}</span></td>
                <td><a href="#!" class="btn btn-white btn-sm">{{ __('admin.dashboard.view') }}</a></td>
              </tr>
              <tr>
                <td>#TR003</td>
                <td>EGP 300</td>
                <td>{{ __('admin.nav.companies') }}</td>
                <td>Jan 18, 2026</td>
                <td><span class="badge text-danger-emphasis bg-danger-subtle">{{ __('admin.dashboard.badge_cancel') }}</span></td>
                <td><a href="#!" class="btn btn-white btn-sm">{{ __('admin.dashboard.view') }}</a></td>
              </tr>
              <tr>
                <td>#TR002</td>
                <td>EGP 560</td>
                <td>{{ __('admin.nav.users') }}</td>
                <td>Jan 13, 2026</td>
                <td><span class="badge text-success-emphasis bg-success-subtle">{{ __('admin.dashboard.badge_completed') }}</span></td>
                <td><a href="#!" class="btn btn-white btn-sm">{{ __('admin.dashboard.view') }}</a></td>
              </tr>
              <tr>
                <td>#TR001</td>
                <td>EGP 430</td>
                <td>{{ __('admin.nav.users') }}</td>
                <td>Jan 11, 2026</td>
                <td><span class="badge text-success-emphasis bg-success-subtle">{{ __('admin.dashboard.badge_completed') }}</span></td>
                <td><a href="#!" class="btn btn-white btn-sm">{{ __('admin.dashboard.view') }}</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="card card-lg">
        <div class="card-body">
          <h5 class="mb-6">{{ __('admin.dashboard.trips_by_city') }}</h5>
          <div id="map-world" style="width: 100%; height: 250px"></div>
          <div class="d-flex flex-column gap-2">
            <div>
              <div class="d-flex justify-content-between align-items-center">
                <span>{{ __('admin.dashboard.cairo') }}</span>
                <span>1,240</span>
              </div>
              <div class="progress mt-1" style="height: 6px">
                <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
    
            
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Users by gender + top drivers --}}
  <div class="row g-6 mb-6">
    <div class="col-xl-4">
      <div class="card card-lg">
        <div class="card-body">
          <div class="mb-5">
            <h5>{{ __('admin.dashboard.users_by_gender') }}</h5>
          </div>
          <div id="salesBygender"></div>
        </div>
        <div class="border-top border-dashed px-6 py-4">
          <div class="d-flex align-items-center justify-content-center gap-6">
            <div class="d-flex align-items-center gap-1">
              <span><i class="ti ti-circle-filled text-primary"></i></span>
              <span class="lh-1">{{ __('admin.dashboard.male') }}</span>
            </div>
            <div class="d-flex align-items-center gap-1">
              <span><i class="ti ti-circle-filled text-warning"></i></span>
              <span class="lh-1">{{ __('admin.dashboard.female') }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8">
      <div class="card card-lg">
        <div class="card-header border-bottom-0">
          <h5 class="mb-0">{{ __('admin.dashboard.top_drivers') }}</h5>
        </div>
        <div class="table-responsive">
          <table class="table text-nowrap mb-0 table-centered table-hover">
            <thead>
              <tr>
                <th>{{ __('admin.dashboard.table_driver') }}</th>
                <th>{{ __('admin.dashboard.table_trips') }}</th>
                <th>{{ __('admin.dashboard.table_rating') }}</th>
                <th>{{ __('admin.dashboard.table_status') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ([['avatar-1.jpg', 'Ahmed Hassan', '454', '5/5', 'active'], ['avatar-2.jpg', 'Mohamed Ali', '454', '5/5', 'active'], ['avatar-3.jpg', 'Sara Ibrahim', '124', '4.0/5', 'low'], ['avatar-4.jpg', 'Khaled Mostafa', '124', '4.0/5', 'low'], ['avatar-5.jpg', 'Omar Samir', '124', '4.8/5', 'inactive']] as $driver)
                <tr>
                  <td>
                    <a href="#!" class="d-flex align-items-center gap-2 text-inherit">
                      <img src="{{ asset('admin/assets/images/avatar/' . $driver[0]) }}" alt="" class="avatar avatar-sm rounded-circle" />
                      <span class="text-truncate">{{ $driver[1] }}</span>
                    </a>
                  </td>
                  <td>{{ $driver[2] }}</td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <span><i class="ti ti-star-filled text-warning"></i></span>
                      <span>{{ $driver[3] }}</span>
                    </div>
                  </td>
                  <td>
                    @if ($driver[4] === 'active')
                      <span class="badge text-info-emphasis bg-info-subtle">{{ __('admin.dashboard.badge_active') }}</span>
                    @elseif($driver[4] === 'low')
                      <span class="badge text-warning-emphasis bg-warning-subtle">{{ __('admin.dashboard.badge_low') }}</span>
                    @else
                      <span class="badge text-danger-emphasis bg-danger-subtle">{{ __('admin.dashboard.badge_inactive') }}</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="{{ asset('admin/libs/jsvectormap/jsvectormap.min.js') }}"></script>
  <script src="{{ asset('admin/libs/jsvectormap/maps/world.js') }}"></script>
  <script src="{{ asset('admin/libs/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('admin/libs/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/vendors/swiper.js') }}"></script>

  <script>
    window.DASHBOARD_I18N = {
      locale: '{{ app()->getLocale() }}',
      rtl: {{ app()->getLocale() === 'ar' ? 'true' : 'false' }},
      months: @json(__('admin.months')),
      incomeSeries: @json(__('admin.dashboard.total_income')),
      expensesSeries: @json(__('admin.dashboard.total_expenses')),
      cities: {
        labels: [
          @json(__('admin.dashboard.cairo')),
          @json(__('admin.dashboard.giza')),
          @json(__('admin.dashboard.alexandria')),
          @json(__('admin.dashboard.mansoura')),
        ],
      },
      genders: {
        labels: [
          @json(__('admin.dashboard.male')),
          @json(__('admin.dashboard.female')),
        ],
      },
    };
  </script>
  <script src="{{ asset('admin/assets/js/admin-dashboard.js') }}"></script>
@endpush
