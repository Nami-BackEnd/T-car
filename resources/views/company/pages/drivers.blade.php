@extends('company.layouts.master')

@section('title', 'T-Car — Drivers')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.190') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.233') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current"> {{ __('company.common.190') }}</span>
              </nav>
            </div>
            <div class="page-header__actions">
              <a href="{{ route('company.add-driver') }}" class="btn btn-primary"
                ><i class="bi bi-plus-lg"></i> {{ __('company.common.84') }}</a
              >
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

          
          <div class="table-card mb-4">
            <div class="table-toolbar">
              <div class="table-search">
                <i class="bi bi-search"></i>
                <input type="search" id="driversSearchInput"  placeholder="{{ __('company.common.133') }}" />
              </div>
            </div>
            <div class="table-responsive-custom">
              <table class="data-table" id="driversTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.149') }}</th>
                    <th>{{ __('company.common.396') }}</th>
                    <th>{{ __('company.common.135') }}</th>
                    <th>{{ __('company.common.544') }}</th>
                    <th>{{ __('company.common.76') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ __('company.pages.drivers.0') }}</td>
                    <td class="ltr-num">966508721587+</td>
                    <td>N2</td>
                    <td>
                      <button
                        type="button"
                        class="status-toggle status-toggle--active"
                        data-status="active"
                      >
                        {{ __('company.common.544') }}</button>
                    </td>
                    <td class="cell-actions">
                      <a href="{{ route('company.edit-driver') }}" class="btn btn-primary btn-sm"  title="{{ __('company.common.309') }}"
                        ><i class="bi bi-pencil"></i
                      ></a>
                      <button class="btn btn-danger btn-sm"  title="{{ __('company.common.370') }}">
                        <i class="bi bi-trash"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>{{ __('company.common.510') }}</td>
                    <td class="ltr-num">966508721587+</td>
                    <td>N2</td>
                    <td>
                      <button
                        type="button"
                        class="status-toggle status-toggle--active"
                        data-status="active"
                      >
                        {{ __('company.common.544') }}</button>
                    </td>
                    <td class="cell-actions">
                      <a href="{{ route('company.edit-driver') }}" class="btn btn-primary btn-sm"  title="{{ __('company.common.309') }}"
                        ><i class="bi bi-pencil"></i
                      ></a>
                      <button class="btn btn-danger btn-sm"  title="{{ __('company.common.370') }}">
                        <i class="bi bi-trash"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>{{ __('company.pages.drivers.1') }}</td>
                    <td class="ltr-num">966508721587+</td>
                    <td>N2</td>
                    <td>
                      <button
                        type="button"
                        class="status-toggle status-toggle--inactive"
                        data-status="inactive"
                      >
                        {{ __('company.common.455') }}</button>
                    </td>
                    <td class="cell-actions">
                      <a href="{{ route('company.edit-driver') }}" class="btn btn-primary btn-sm"  title="{{ __('company.common.309') }}"
                        ><i class="bi bi-pencil"></i
                      ></a>
                      <button class="btn btn-danger btn-sm"  title="{{ __('company.common.370') }}">
                        <i class="bi bi-trash"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>{{ __('company.pages.drivers.2') }}</td>
                    <td class="ltr-num">966508721587+</td>
                    <td>N2</td>
                    <td>
                      <button
                        type="button"
                        class="status-toggle status-toggle--active"
                        data-status="active"
                      >
                        {{ __('company.common.544') }}</button>
                    </td>
                    <td class="cell-actions">
                      <a href="{{ route('company.edit-driver') }}" class="btn btn-primary btn-sm"  title="{{ __('company.common.309') }}"
                        ><i class="bi bi-pencil"></i
                      ></a>
                      <button class="btn btn-danger btn-sm"  title="{{ __('company.common.370') }}">
                        <i class="bi bi-trash"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td>{{ __('company.pages.drivers.3') }}</td>
                    <td class="ltr-num">966508721587+</td>
                    <td>N2</td>
                    <td>
                      <button
                        type="button"
                        class="status-toggle status-toggle--active"
                        data-status="active"
                      >
                        {{ __('company.common.544') }}</button>
                    </td>
                    <td class="cell-actions">
                      <a href="{{ route('company.edit-driver') }}" class="btn btn-primary btn-sm"  title="{{ __('company.common.309') }}"
                        ><i class="bi bi-pencil"></i
                      ></a>
                      <button class="btn btn-danger btn-sm"  title="{{ __('company.common.370') }}">
                        <i class="bi bi-trash"></i>
                      </button>
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
                <button class="table-pagination__page-btn">
                  <i class="bi bi-chevron-left"></i>
                </button>
              </div>
            </div>
          </div>
@endsection

@push('modals')
</main>
        
      

    
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        // Status toggle functionality
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
      });
    </script>
@endpush

