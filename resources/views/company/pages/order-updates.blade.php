@extends('company.layouts.master')

@section('title', 'T-Car — Order Updates')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.order-updates.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.pages.order-updates.0') }}</span>
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

          
          <div class="table-card mb-4">
            <div class="table-toolbar">
              <div class="table-search">
                <i class="bi bi-search"></i>
                <input
                  type="search"
                  id="lateDeliverySearchInput"
                   placeholder="{{ __('company.common.399') }}"
                />
              </div>
            </div>
            <div class="table-responsive-custom">
              <table class="data-table" id="lateDeliveryTable">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.215') }}</th>
                    <th>{{ __('company.common.203') }}</th>
                    <th>{{ __('company.common.138') }}</th>
                    <th>{{ __('company.common.297') }}</th>
                    <th>{{ __('company.common.365') }}</th>
                    <th>{{ __('company.pages.order-updates.1') }}</th>
                    <th>{{ __('company.pages.order-updates.2') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    data-order-id="RES-006"
                    data-edit-history='[{"date":"15/07/2026 10:30","type":"طلب تعديل وقت الاستلام","status":"قيد المراجعة","staff":"أحمد محمد"}]'
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="RES-006"
                        >#RES-006 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.common.377') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966508721587+</span>
                      </div>
                    </td>
                    <td class="car-cell">Toyota Yaris 2026</td>
                    <td class="office-cell">
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td class="pickup-datetime-cell ltr-num">18/07/2026 14:00</td>
                    <td class="booking-status-cell">
                      <span class="badge bg-info text-dark">{{ __('company.common.359') }}</span>
                    </td>
                    <td>{{ __('company.pages.order-updates.3') }}</td>
                    <td>
                      <span
                        class="badge request-status request-status--pending"
                        data-request-status="RES-006"
                        data-status="pending"
                        >{{ __('company.common.473') }}</span
                      >
                      <span
                        class="badge request-status request-status--approved"
                        data-request-status="RES-006"
                        data-status="approved"
                        hidden
                        >{{ __('company.pages.order-updates.4') }}</span
                      >
                      <span
                        class="badge request-status request-status--rejected"
                        data-request-status="RES-006"
                        data-status="rejected"
                        hidden
                        >{{ __('company.common.521') }}</span
                      >
                    </td>
                    <td>
                      <button
                        class="btn btn-primary btn-sm order-review-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#orderUpdatePickupDirectModal"
                        data-order-id="RES-006"
                      >
                        <i class="bi bi-eye"></i> {{ __('company.pages.order-updates.5') }}</button>
                    </td>
                  </tr>
                  <tr
                    data-order-id="RES-007"
                    data-edit-history='[{"date":"16/07/2026 09:00","type":"طلب تعديل وقت الاستلام","status":"تم التصعيد للإدارة","staff":"محمد علي"}]'
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="RES-007"
                        >#RES-007 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.common.387') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966508721587+</span>
                      </div>
                    </td>
                    <td class="car-cell">HYUNDAI ACCENT 2025</td>
                    <td class="office-cell">
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Rawdah</a
                      >
                    </td>
                    <td class="pickup-datetime-cell ltr-num">18/07/2026 16:00</td>
                    <td class="booking-status-cell">
                      <span class="badge bg-info text-dark">{{ __('company.common.359') }}</span>
                    </td>
                    <td>{{ __('company.pages.order-updates.3') }}</td>
                    <td>
                      <span
                        class="badge request-status request-status--pending"
                        data-request-status="RES-007"
                        data-status="pending"
                        hidden
                        >{{ __('company.common.473') }}</span
                      >
                      <span
                        class="badge request-status request-status--escalated"
                        data-request-status="RES-007"
                        data-status="escalated"
                        >{{ __('company.pages.order-updates.6') }}</span
                      >
                      <span
                        class="badge request-status request-status--rejected"
                        data-request-status="RES-007"
                        data-status="rejected"
                        hidden
                        >{{ __('company.common.521') }}</span
                      >
                    </td>
                    <td>
                      <button
                        class="btn btn-primary btn-sm order-review-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#orderUpdatePickupEscalationModal"
                        data-order-id="RES-007"
                      >
                        <i class="bi bi-eye"></i> {{ __('company.pages.order-updates.5') }}</button>
                    </td>
                  </tr>
                  <tr
                    data-order-id="RES-008"
                    data-edit-history='[{"date":"16/07/2026 16:45","type":"طلب تعديل عدد أيام الحجز","status":"بانتظار الدفع","staff":"خالد العمري"}]'
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="RES-008"
                        >#RES-008 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.common.413') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966508721587+</span>
                      </div>
                    </td>
                    <td class="car-cell">KIA pegas 2026</td>
                    <td class="office-cell">
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 - Al-Olaya</a
                      >
                    </td>
                    <td class="pickup-datetime-cell ltr-num">19/07/2026 10:00</td>
                    <td class="booking-status-cell">
                      <span class="badge bg-primary">{{ __('company.common.446') }}</span>
                    </td>
                    <td>{{ __('company.pages.order-updates.7') }}</td>
                    <td>
                      <span
                        class="badge request-status request-status--pending"
                        data-request-status="RES-008"
                        data-status="pending"
                        hidden
                        >{{ __('company.common.473') }}</span
                      >
                      <span
                        class="badge request-status request-status--payment"
                        data-request-status="RES-008"
                        data-status="payment"
                        >{{ __('company.pages.order-updates.8') }}</span
                      >
                      <span
                        class="badge request-status request-status--rejected"
                        data-request-status="RES-008"
                        data-status="rejected"
                        hidden
                        >{{ __('company.common.521') }}</span
                      >
                    </td>
                    <td>
                      <button
                        class="btn btn-primary btn-sm order-review-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#orderUpdateDaysDirectModal"
                        data-order-id="RES-008"
                      >
                        <i class="bi bi-eye"></i> {{ __('company.pages.order-updates.9') }}</button>
                    </td>
                  </tr>
                  <tr
                    data-order-id="RES-009"
                    data-edit-history='[{"date":"18/07/2026 14:20","type":"طلب تعديل عدد أيام الحجز","status":"قيد المراجعة","staff":"نورة السالم"}]'
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="RES-009"
                        >#RES-009 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.order-updates.10') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966501234567+</span>
                      </div>
                    </td>
                    <td class="car-cell">MG 5 2026</td>
                    <td class="office-cell">
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Al-Malqa</a
                      >
                    </td>
                    <td class="pickup-datetime-cell ltr-num">18/07/2026 18:00</td>
                    <td class="booking-status-cell">
                      <span class="badge bg-primary">{{ __('company.common.446') }}</span>
                    </td>
                    <td>{{ __('company.pages.order-updates.7') }}</td>
                    <td>
                      <span
                        class="badge request-status request-status--pending"
                        data-request-status="RES-009"
                        data-status="pending"
                        >{{ __('company.common.473') }}</span
                      >
                      <span
                        class="badge request-status request-status--escalated"
                        data-request-status="RES-009"
                        data-status="escalated"
                        hidden
                        >{{ __('company.pages.order-updates.6') }}</span
                      >
                      <span
                        class="badge request-status request-status--rejected"
                        data-request-status="RES-009"
                        data-status="rejected"
                        hidden
                        >{{ __('company.common.521') }}</span
                      >
                    </td>
                    <td>
                      <button
                        class="btn btn-primary btn-sm order-review-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#orderUpdateDaysEscalationModal"
                        data-order-id="RES-009"
                      >
                        <i class="bi bi-eye"></i> {{ __('company.pages.order-updates.5') }}</button>
                    </td>
                  </tr>
                  <tr
                    data-order-id="RES-010"
                    data-edit-history='[{"date":"17/07/2026 11:10","type":"طلب تعديل وقت الاستلام","status":"تمت الموافقة","staff":"أحمد محمد"}]'
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="RES-010"
                        >#RES-010 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.order-updates.11') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966501112233+</span>
                      </div>
                    </td>
                    <td class="car-cell">Toyota Corolla 2025</td>
                    <td class="office-cell">
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Al-Nakheel</a
                      >
                    </td>
                    <td class="pickup-datetime-cell ltr-num">20/07/2026 09:00</td>
                    <td class="booking-status-cell">
                      <span class="badge bg-info text-dark">{{ __('company.common.359') }}</span>
                    </td>
                    <td>{{ __('company.pages.order-updates.3') }}</td>
                    <td>
                      <span class="badge request-status request-status--approved"
                        >{{ __('company.pages.order-updates.4') }}</span
                      >
                    </td>
                    <td>
                      <button
                        type="button"
                        class="btn btn-primary btn-sm js-view-static-request"
                        data-bs-toggle="modal"
                        data-bs-target="#processedOrderUpdateModal"
                        data-request-panel="RES-010"
                      >
                        <i class="bi bi-eye"></i> {{ __('company.pages.order-updates.9') }}</button>
                    </td>
                  </tr>
                  <tr
                    data-order-id="RES-011"
                    data-edit-history='[{"date":"17/07/2026 12:30","type":"طلب تعديل عدد أيام الحجز","status":"مرفوض","staff":"محمد علي"}]'
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="RES-011"
                        >#RES-011 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.order-updates.12') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966502223344+</span>
                      </div>
                    </td>
                    <td class="car-cell">Hyundai Elantra 2025</td>
                    <td class="office-cell">
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Al-Rawdah</a
                      >
                    </td>
                    <td class="pickup-datetime-cell ltr-num">20/07/2026 13:30</td>
                    <td class="booking-status-cell">
                      <span class="badge bg-info text-dark">{{ __('company.common.359') }}</span>
                    </td>
                    <td>{{ __('company.pages.order-updates.7') }}</td>
                    <td>
                      <span class="badge request-status request-status--rejected">{{ __('company.common.521') }}</span>
                    </td>
                    <td>
                      <button
                        type="button"
                        class="btn btn-primary btn-sm js-view-static-request"
                        data-bs-toggle="modal"
                        data-bs-target="#processedOrderUpdateModal"
                        data-request-panel="RES-011"
                      >
                        <i class="bi bi-eye"></i> {{ __('company.pages.order-updates.9') }}</button>
                    </td>
                  </tr>
                  <tr
                    data-order-id="RES-012"
                    data-edit-history='[{"date":"17/07/2026 14:05","type":"طلب تعديل وقت الاستلام","status":"وافقت الإدارة","staff":"الإدارة"}]'
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="RES-012"
                        >#RES-012 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.order-updates.13') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966503334455+</span>
                      </div>
                    </td>
                    <td class="car-cell">Nissan Sunny 2026</td>
                    <td class="office-cell">
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Al-Yasmin</a
                      >
                    </td>
                    <td class="pickup-datetime-cell ltr-num">21/07/2026 08:00</td>
                    <td class="booking-status-cell">
                      <span class="badge bg-primary">{{ __('company.common.446') }}</span>
                    </td>
                    <td>{{ __('company.pages.order-updates.3') }}</td>
                    <td>
                      <span class="badge request-status request-status--admin-approved"
                        >{{ __('company.pages.order-updates.14') }}</span
                      >
                    </td>
                    <td>
                      <button
                        type="button"
                        class="btn btn-primary btn-sm js-view-static-request"
                        data-bs-toggle="modal"
                        data-bs-target="#processedOrderUpdateModal"
                        data-request-panel="RES-012"
                      >
                        <i class="bi bi-eye"></i> {{ __('company.pages.order-updates.9') }}</button>
                    </td>
                  </tr>
                  <tr
                    data-order-id="RES-013"
                    data-edit-history='[{"date":"17/07/2026 15:40","type":"طلب تعديل عدد أيام الحجز","status":"رفضت الإدارة","staff":"الإدارة"}]'
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="RES-013"
                        >#RES-013 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.order-updates.15') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966504445566+</span>
                      </div>
                    </td>
                    <td class="car-cell">KIA K5 2025</td>
                    <td class="office-cell">
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Al-Malqa</a
                      >
                    </td>
                    <td class="pickup-datetime-cell ltr-num">21/07/2026 15:00</td>
                    <td class="booking-status-cell">
                      <span class="badge bg-primary">{{ __('company.common.446') }}</span>
                    </td>
                    <td>{{ __('company.pages.order-updates.7') }}</td>
                    <td>
                      <span class="badge request-status request-status--admin-rejected"
                        >{{ __('company.pages.order-updates.16') }}</span
                      >
                    </td>
                    <td>
                      <button
                        type="button"
                        class="btn btn-primary btn-sm js-view-static-request"
                        data-bs-toggle="modal"
                        data-bs-target="#processedOrderUpdateModal"
                        data-request-panel="RES-013"
                      >
                        <i class="bi bi-eye"></i> {{ __('company.pages.order-updates.9') }}</button>
                    </td>
                  </tr>
                  <tr
                    data-order-id="RES-014"
                    data-edit-history='[{"date":"18/07/2026 08:25","type":"طلب تعديل عدد أيام الحجز","status":"تم الدفع واعتماد التعديل","staff":"النظام"}]'
                  >
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref js-reservation-booking-details"
                        data-bs-toggle="modal"
                        data-bs-target="#reservationDetailsModal"
                        data-booking-ref="RES-014"
                        >#RES-014 <i class="bi bi-box-arrow-up-right"></i
                      ></a>
                    </td>
                    <td>
                      <div class="cell-customer-stack">
                        <span class="cell-customer-stack__name">{{ __('company.pages.order-updates.17') }}</span>
                        <span class="cell-customer-stack__phone ltr-num">966505556677+</span>
                      </div>
                    </td>
                    <td class="car-cell">MG ZS 2026</td>
                    <td class="office-cell">
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Al-Olaya</a
                      >
                    </td>
                    <td class="pickup-datetime-cell ltr-num">22/07/2026 11:00</td>
                    <td class="booking-status-cell">
                      <span class="badge bg-primary">{{ __('company.common.446') }}</span>
                    </td>
                    <td>{{ __('company.pages.order-updates.7') }}</td>
                    <td>
                      <span class="badge request-status request-status--completed"
                        >{{ __('company.pages.order-updates.18') }}</span
                      >
                    </td>
                    <td>
                      <button
                        type="button"
                        class="btn btn-primary btn-sm js-view-static-request"
                        data-bs-toggle="modal"
                        data-bs-target="#processedOrderUpdateModal"
                        data-request-panel="RES-014"
                      >
                        <i class="bi bi-eye"></i> {{ __('company.pages.order-updates.9') }}</button>
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
      id="trackingMapModal"
      tabindex="-1"
      aria-labelledby="trackingMapModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="trackingMapModalLabel">{{ __('company.common.382') }}</h5>
            <button
              type="button"
              class="btn-close m-0"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body">
            <div class="tracking-info mb-3">
              <div class="row">
                <div class="col-md-6">
                  <div class="tracking-info-item">
                    <span class="tracking-info-label">{{ __('company.common.400') }}</span>
                    <a
                      href="#"
                      class="tracking-info-value js-reservation-booking-details"
                      data-bs-toggle="modal"
                      data-bs-target="#reservationDetailsModal"
                      data-booking-ref="RES-006"
                      id="modalBookingRef"
                      >#RES-006</a
                    >
                  </div>
                  <div class="tracking-info-item">
                    <span class="tracking-info-label">{{ __('company.common.189') }}</span>
                    <span class="tracking-info-value" id="modalDriverName">{{ __('company.common.408') }}</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="tracking-info-item">
                    <span class="tracking-info-label">{{ __('company.common.243') }}</span>
                    <span class="tracking-info-value" id="modalCurrentLocation"
                      >{{ __('company.common.187') }}</span
                    >
                  </div>
                  <div class="tracking-info-item">
                    <span class="tracking-info-label">{{ __('company.common.247') }}</span>
                    <span class="tracking-info-value" id="modalDestination">{{ __('company.common.186') }}</span>
                  </div>
                </div>
              </div>
            </div>
            <div id="trackingMap" style="height: 400px; border-radius: 8px"></div>
            <input type="hidden" id="selectedTrackingLat" />
            <input type="hidden" id="selectedTrackingLng" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.92') }}</button>
            <button type="button" class="btn btn-outline" id="confirmTrackingLocationBtn">
              <i class="bi bi-check2-circle"></i> {{ __('company.pages.order-updates.19') }}</button>
            <button type="button" class="btn btn-primary">
              <i class="bi bi-telephone"></i> {{ __('company.common.102') }}</button>
          </div>
        </div>
      </div>
    </div>

    

    <div
      class="modal fade"
      id="reservationDetailsModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="reservationDetailsModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered pending-booking-modal-dialog">
        <div class="modal-content booking-modal">
          
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon">
                <i class="bi bi-file-earmark-text"></i>
              </div>
              <div>
                <h2 class="bkmodal-header__ref" id="reservationDetailsModalLabel">
                  {{ __('company.common.368') }}<span class="num" id="reservationBookingRef">Y8e087</span>
                  <span class="badge bg-success" id="reservationBookingStatus">{{ __('company.common.545') }}</span>
                </h2>
                <div class="bkmodal-header__meta">
                  <span
                    ><i class="bi bi-person"></i>
                    <span id="reservationBookingCustomerMeta">Maryam Yousuf Ahli</span></span
                  >
                  <span class="dot">•</span>
                  <span
                    ><i class="bi bi-building"></i>
                    <span id="reservationBookingOfficeMeta">{{ __('company.common.184') }}</span></span
                  >
                </div>
              </div>
            </div>
            <button
              type="button"
              class="booking-modal__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>

          
          <div class="modal-body booking-modal__body">
            <div class="booking-modal__tabs">
              <div class="view-tabs" role="tablist"  aria-label="{{ __('company.common.312') }}">
                <button
                  type="button"
                  class="view-tabs__btn is-active"
                  data-reservation-booking-tab="summary"
                  aria-selected="true"
                >
                  <i class="bi bi-file-text"></i>
                  <span>{{ __('company.common.239') }}</span>
                </button>
                <button
                  type="button"
                  class="view-tabs__btn"
                  data-reservation-booking-tab="rating"
                  aria-selected="false"
                >
                  <i class="bi bi-star"></i>
                  <span>{{ __('company.common.162') }}</span>
                </button>

                <button
                  type="button"
                  class="view-tabs__btn"
                  data-reservation-booking-tab="bank"
                  aria-selected="false"
                >
                  <i class="bi bi-bank"></i>
                  <span>{{ __('company.common.540') }}</span>
                </button>
              </div>
            </div>

            <div class="tab-content booking-modal__content">
              
              <div class="pending-booking-panel is-active" data-reservation-booking-panel="summary">
                <div class="bkmodal-section-label">{{ __('company.common.273') }}</div>
                <div class="booking-details-grid">
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-truck"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.171') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingService"
                        >{{ __('company.common.300') }}</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.449') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingCustomer"
                        >Maryam Yousuf Ahli</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-calendar3"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.284') }}</span>
                      <span
                        class="booking-detail-item__value ltr-num"
                        id="reservationBookingPickupDate"
                        >2026-07-20</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-clock"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.587') }}</span>
                      <span
                        class="booking-detail-item__value ltr-num"
                        id="reservationBookingPickupTime"
                        >12:30</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-calendar-range"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.219') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingPeriod"
                        >1</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-car-front"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.430') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingCar">-</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.423') }}</span>
                      <span class="booking-detail-item__value ltr-num" id="reservationBookingPrice"
                        >{{ __('company.common.15') }}</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.431') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingCompany"
                        >N2</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.235') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingOffice"
                        >{{ __('company.common.184') }}</span
                      >
                    </div>
                  </div>
                </div>

                <div class="bkmodal-section-label">{{ __('company.common.173') }}</div>
                <div class="booking-details-grid">
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-credit-card"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.437') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingPayment"
                        >{{ __('company.common.267') }}</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-info-circle"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label"> {{ __('company.common.365') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingAccepted"
                        >{{ __('company.common.495') }}</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-cash"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.160') }}</span>
                      <span class="booking-detail-item__value" id="reservationBookingCompensation"
                        >0</span
                      >
                    </div>
                  </div>
                </div>
              </div>

              
              <div class="pending-booking-panel" data-reservation-booking-panel="rating">
                <div class="reservation-rating-card">
                  <div class="reservation-rating-card__score">
                    <span class="reservation-rating-card__number" id="reservationBookingRating"
                      >5</span
                    >
                    <div class="reservation-rating-card__stars" id="reservationBookingRatingStars">
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                    </div>
                  </div>

                  <div class="booking-details-grid">
                    <div class="booking-detail-item">
                      <div class="booking-detail-item__icon">
                        <i class="bi bi-person-check"></i>
                      </div>
                      <div class="booking-detail-item__content">
                        <span class="booking-detail-item__label">{{ __('company.common.328') }}</span>
                        <span class="booking-detail-item__value" id="reservationBookingRatedBy"
                          >Maryam Yousuf Ahli</span
                        >
                      </div>
                    </div>
                    <div class="booking-detail-item">
                      <div class="booking-detail-item__icon">
                        <i class="bi bi-calendar3"></i>
                      </div>
                      <div class="booking-detail-item__content">
                        <span class="booking-detail-item__label">{{ __('company.common.280') }}</span>
                        <span
                          class="booking-detail-item__value ltr-num"
                          id="reservationBookingRatingDate"
                          >2026-07-20</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="pending-booking-panel" data-reservation-booking-panel="bank">
                <div class="bank-info-grid">
                  <div class="bank-info-item">
                    <div class="bank-info-item__icon">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="bank-info-item__content">
                      <span class="bank-info-item__label">{{ __('company.common.132') }}</span>
                      <span class="bank-info-item__value" id="reservationBookingBankName">-</span>
                    </div>
                  </div>
                  <div class="bank-info-item">
                    <div class="bank-info-item__icon">
                      <i class="bi bi-credit-card"></i>
                    </div>
                    <div class="bank-info-item__content">
                      <span class="bank-info-item__label">{{ __('company.common.152') }}</span>
                      <span class="bank-info-item__value ltr-num" id="reservationBookingIban"
                        >-</span
                      >
                    </div>
                  </div>
                  <div class="bank-info-item">
                    <div class="bank-info-item__icon">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="bank-info-item__content">
                      <span class="bank-info-item__label">{{ __('company.common.79') }}</span>
                      <span class="bank-info-item__value" id="reservationBookingCardHolder">-</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
          <div class="modal-footer bkmodal-footer">
            <a href="{{ route('company.booking-details-two') }}" class="btn btn-primary">
              <i class="bi bi-file-earmark-text"></i>
              <span>{{ __('company.common.312') }}</span>
            </a>
            <div class="pending-booking-modal__footer-actions">
              <button
                type="button"
                class="pending-booking-link"
                data-reservation-modal-action="booking-history-transactions"
              >
                <i class="bi bi-clock-history"></i> {{ __('company.common.293') }}</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="reservationHistoryModal"
      tabindex="-1"
      aria-labelledby="reservationHistoryModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content car-logs-modal">
          <div class="car-logs-modal__header">
            <h5 class="car-logs-modal__header__title" id="reservationHistoryModalLabel">
              {{ __('company.common.291') }}</h5>
            <button
              type="button"
              class="car-logs-modal__header__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>

          <div class="car-logs-modal__body">
            <div class="car-logs-scrollctrl">
              <button
                type="button"
                class="car-logs-scrollctrl__btn"
                id="reservationHistoryScrollUpBtn"
                 aria-label="{{ __('company.common.344') }}"
              >
                <i class="bi bi-chevron-up"></i>
              </button>
              <div class="car-logs-scrollctrl__track">
                <div class="car-logs-scrollctrl__thumb" id="reservationHistoryScrollThumb"></div>
              </div>
              <button
                type="button"
                class="car-logs-scrollctrl__btn"
                id="reservationHistoryScrollDownBtn"
                 aria-label="{{ __('company.common.343') }}"
              >
                <i class="bi bi-chevron-down"></i>
              </button>
            </div>

            <div class="car-logs-table-wrap" id="reservationHistoryTableWrap">
              <table class="car-logs-table">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.389') }}</th>
                    <th>{{ __('company.common.523') }}</th>
                    <th>{{ __('company.common.296') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--activate" data-history-message>{{ __('company.common.324') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:00:00</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--stock" data-history-message>{{ __('company.common.336') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:03:16</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--payment" data-history-message>{{ __('company.common.325') }}</td>
                    <td data-history-user>{{ __('company.common.564') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 09:12:14</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--payment" data-history-message>{{ __('company.common.331') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 09:14:38</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--activate" data-history-message>{{ __('company.common.335') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:05:42</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--invoice" data-history-message>{{ __('company.common.321') }}</td>
                    <td data-history-user>{{ __('company.common.565') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 09:16:02</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--deactivate" data-history-message>
                      {{ __('company.common.332') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 10:09:10</td>
                  </tr>
                  <tr>
                    <td class="log-index" data-history-ref>--</td>
                    <td class="log-message--info" data-history-message>{{ __('company.common.492') }}</td>
                    <td data-history-user>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num" data-history-date>2026-07-20 09:18:20</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade order-update-modal"
      id="orderUpdatePickupDirectModal"
      tabindex="-1"
      aria-labelledby="orderUpdatePickupDirectLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon"><i class="bi bi-clock-history"></i></div>
              <div>
                <h2 class="bkmodal-header__ref" id="orderUpdatePickupDirectLabel">
                  {{ __('company.pages.order-updates.20') }}<span class="num">#RES-006</span>
                </h2>
                <div class="bkmodal-header__meta">
                  <span><i class="bi bi-person"></i> {{ __('company.common.377') }}</span>
                  <span class="dot">•</span>
                  <span
                    ><i class="bi bi-calendar3"></i>
                    <span class="ltr-num">18/07/2026 14:00</span></span
                  >
                </div>
              </div>
            </div>
            <button
              type="button"
              class="booking-modal__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
          <div class="modal-body booking-modal__body">
            <div class="booking-modal__content">
              <div class="notice-banner mb-3">
                <div class="notice-banner__body">
                  <i class="bi bi-shield-lock notice-banner__icon"></i>
                  <div class="notice-banner__text">
                    {{ __('company.pages.order-updates.21') }}</div>
                </div>
              </div>
              <div class="order-update-card">
                <div class="order-update-card__head">
                  <div>
                    <h6 class="order-update-card__title">
                      <i class="bi bi-clock-history"></i> {{ __('company.pages.order-updates.3') }}</h6>
                    <p class="order-update-card__hint">
                      {{ __('company.pages.order-updates.22') }}</p>
                  </div>
                  <span
                    class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle"
                    >{{ __('company.pages.order-updates.23') }}</span
                  >
                </div>
                <div class="order-update-summary mb-3">
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.common.284') }}</span>
                    <span class="order-update-summary__value ltr-num">18/07/2026</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.24') }}</span>
                    <span class="order-update-summary__value ltr-num">14:00</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.common.281') }}</span>
                    <span class="order-update-summary__value ltr-num">20/07/2026</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.25') }}</span>
                    <span class="order-update-summary__value ltr-num">14:00</span>
                  </div>
                </div>
                <label class="booking-detail-item__label" for="pickupTimeRequest006"
                  >{{ __('company.pages.order-updates.26') }}</label
                >
                <input
                  type="time"
                  class="form-control ltr-num"
                  id="pickupTimeRequest006"
                  value="15:30"
                  step="60"
                />
                <div class="form-text">{{ __('company.pages.order-updates.27') }}</div>
                <div
                  class="order-update-result order-update-result--approved"
                  data-decision-result="RES-006"
                  data-result="approved"
                  role="status"
                  hidden
                >
                  <strong>{{ __('company.pages.order-updates.28') }}</strong>
                  <div>{{ __('company.pages.order-updates.29') }}</div>
                </div>
                <div
                  class="order-update-result order-update-result--rejected"
                  data-decision-result="RES-006"
                  data-result="rejected"
                  role="status"
                  hidden
                >
                  <strong>{{ __('company.pages.order-updates.30') }}</strong>
                  <div>{{ __('company.pages.order-updates.31') }}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer bkmodal-footer" data-decision-actions="RES-006">
            <button
              type="button"
              class="btn btn-primary js-order-update-decision"
              data-request-id="RES-006"
              data-status="approved"
            >
              <i class="bi bi-check2-circle"></i> {{ __('company.pages.order-updates.32') }}</button>
            <button
              type="button"
              class="btn btn-outline-danger js-order-update-decision"
              data-request-id="RES-006"
              data-status="rejected"
            >
              <i class="bi bi-x-circle"></i> {{ __('company.pages.order-updates.33') }}</button>
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">
              <i class="bi bi-x-lg"></i> {{ __('company.common.92') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade order-update-modal"
      id="orderUpdatePickupEscalationModal"
      tabindex="-1"
      aria-labelledby="orderUpdatePickupEscalationLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon"><i class="bi bi-clock-history"></i></div>
              <div>
                <h2 class="bkmodal-header__ref" id="orderUpdatePickupEscalationLabel">
                  {{ __('company.pages.order-updates.20') }}<span class="num">#RES-007</span>
                </h2>
                <div class="bkmodal-header__meta">
                  <span><i class="bi bi-person"></i> {{ __('company.common.387') }}</span>
                  <span class="dot">•</span>
                  <span
                    ><i class="bi bi-calendar3"></i>
                    <span class="ltr-num">18/07/2026 16:00</span></span
                  >
                </div>
              </div>
            </div>
            <button
              type="button"
              class="booking-modal__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
          <div class="modal-body booking-modal__body">
            <div class="booking-modal__content">
              <div class="notice-banner mb-3">
                <div class="notice-banner__body">
                  <i class="bi bi-shield-lock notice-banner__icon"></i>
                  <div class="notice-banner__text">
                    {{ __('company.pages.order-updates.34') }}</div>
                </div>
              </div>
              <div class="order-update-card">
                <div class="order-update-card__head">
                  <div>
                    <h6 class="order-update-card__title">
                      <i class="bi bi-clock-history"></i> {{ __('company.pages.order-updates.3') }}</h6>
                    <p class="order-update-card__hint">{{ __('company.pages.order-updates.35') }}</p>
                  </div>
                  <span
                    class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle"
                    >{{ __('company.pages.order-updates.36') }}</span
                  >
                </div>
                <div class="order-update-summary mb-3">
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.common.284') }}</span>
                    <span class="order-update-summary__value ltr-num">18/07/2026</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.24') }}</span>
                    <span class="order-update-summary__value ltr-num">16:00</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.26') }}</span>
                    <span class="order-update-summary__value ltr-num">20:00</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.37') }}</span>
                    <span class="order-update-summary__value ltr-num">20/07/2026 16:00</span>
                  </div>
                </div>
                <div
                  class="order-update-result order-update-result--escalated is-visible"
                  data-decision-result="RES-007"
                  data-result="escalated"
                  role="status"
                >
                  <strong>{{ __('company.pages.order-updates.38') }}</strong>
                  <div>{{ __('company.pages.order-updates.39') }}</div>
                </div>
                <div
                  class="order-update-result order-update-result--approved"
                  data-decision-result="RES-007"
                  data-result="admin-approved"
                  role="status"
                  hidden
                >
                  <strong>{{ __('company.pages.order-updates.40') }}</strong>
                  <div>{{ __('company.pages.order-updates.41') }}</div>
                </div>
                <div
                  class="order-update-result order-update-result--rejected"
                  data-decision-result="RES-007"
                  data-result="admin-rejected"
                  role="status"
                  hidden
                >
                  <strong>{{ __('company.pages.order-updates.42') }}</strong>
                  <div>{{ __('company.pages.order-updates.43') }}</div>
                </div>
                <div
                  class="order-update-result order-update-result--rejected"
                  data-decision-result="RES-007"
                  data-result="rejected"
                  role="status"
                  hidden
                >
                  <strong>{{ __('company.pages.order-updates.30') }}</strong>
                  <div>{{ __('company.pages.order-updates.44') }}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer bkmodal-footer">
            <div class="order-update-action-stage" data-decision-stage="RES-007-provider" hidden>
              <button
                type="button"
                class="btn btn-primary js-order-update-decision"
                data-request-id="RES-007"
                data-status="escalated"
              >
                <i class="bi bi-send"></i> {{ __('company.pages.order-updates.45') }}</button>
              <button
                type="button"
                class="btn btn-outline-danger js-order-update-decision"
                data-request-id="RES-007"
                data-status="rejected"
              >
                <i class="bi bi-x-circle"></i> {{ __('company.pages.order-updates.33') }}</button>
            </div>
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">
              <i class="bi bi-x-lg"></i> {{ __('company.common.92') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade order-update-modal"
      id="orderUpdateDaysDirectModal"
      tabindex="-1"
      aria-labelledby="orderUpdateDaysDirectLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon"><i class="bi bi-calendar-range"></i></div>
              <div>
                <h2 class="bkmodal-header__ref" id="orderUpdateDaysDirectLabel">
                  {{ __('company.pages.order-updates.20') }}<span class="num">#RES-008</span>
                </h2>
                <div class="bkmodal-header__meta">
                  <span><i class="bi bi-person"></i> {{ __('company.common.413') }}</span>
                  <span class="dot">•</span>
                  <span
                    ><i class="bi bi-calendar3"></i>
                    <span class="ltr-num">19/07/2026 10:00</span></span
                  >
                </div>
              </div>
            </div>
            <button
              type="button"
              class="booking-modal__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
          <div class="modal-body booking-modal__body">
            <div class="booking-modal__content">
              <div class="notice-banner mb-3">
                <div class="notice-banner__body">
                  <i class="bi bi-shield-lock notice-banner__icon"></i>
                  <div class="notice-banner__text">
                    {{ __('company.pages.order-updates.46') }}</div>
                </div>
              </div>
              <div class="order-update-card">
                <div class="order-update-card__head">
                  <div>
                    <h6 class="order-update-card__title">
                      <i class="bi bi-calendar-range"></i> {{ __('company.pages.order-updates.7') }}</h6>
                    <p class="order-update-card__hint">{{ __('company.pages.order-updates.47') }}</p>
                  </div>
                  <span
                    class="badge bg-success-subtle text-success-emphasis border border-success-subtle"
                    >{{ __('company.pages.order-updates.48') }}</span
                  >
                </div>
                <div class="order-update-summary">
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.49') }}</span>
                    <span class="order-update-summary__value ltr-num">2</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.50') }}</span>
                    <span class="order-update-summary__value ltr-num">4</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.51') }}</span>
                    <span class="order-update-summary__value ltr-num">21/07/2026 10:00</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.52') }}</span>
                    <span class="order-update-summary__value ltr-num">23/07/2026 10:00</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.53') }}</span>
                    <span class="order-update-summary__value">{{ __('company.pages.order-updates.54') }}</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.common.366') }}</span>
                    <span
                      class="order-update-summary__value"
                      data-payment-status="RES-008"
                      data-payment="pending"
                      hidden
                      >{{ __('company.pages.order-updates.55') }}</span
                    >
                    <span
                      class="order-update-summary__value text-warning-emphasis"
                      data-payment-status="RES-008"
                      data-payment="payment"
                      >{{ __('company.pages.order-updates.8') }}</span
                    >
                    <span
                      class="order-update-summary__value"
                      data-payment-status="RES-008"
                      data-payment="rejected"
                      hidden
                      >{{ __('company.pages.order-updates.56') }}</span
                    >
                  </div>
                </div>
                <div
                  class="order-update-result order-update-result--payment is-visible"
                  data-decision-result="RES-008"
                  data-result="payment"
                  role="status"
                >
                  <strong>{{ __('company.pages.order-updates.57') }}</strong>
                  <div>{{ __('company.pages.order-updates.58') }}</div>
                </div>
                <div
                  class="order-update-result order-update-result--rejected"
                  data-decision-result="RES-008"
                  data-result="rejected"
                  role="status"
                  hidden
                >
                  <strong>{{ __('company.pages.order-updates.30') }}</strong>
                  <div>{{ __('company.pages.order-updates.31') }}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer bkmodal-footer" data-decision-actions="RES-008">
            <button
              type="button"
              class="btn btn-primary js-order-update-decision"
              data-request-id="RES-008"
              data-status="payment"
              disabled
            >
              <i class="bi bi-check2-circle"></i> {{ __('company.pages.order-updates.32') }}</button>
            <button
              type="button"
              class="btn btn-outline-danger js-order-update-decision"
              data-request-id="RES-008"
              data-status="rejected"
              disabled
            >
              <i class="bi bi-x-circle"></i> {{ __('company.pages.order-updates.33') }}</button>
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">
              <i class="bi bi-x-lg"></i> {{ __('company.common.92') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade order-update-modal"
      id="orderUpdateDaysEscalationModal"
      tabindex="-1"
      aria-labelledby="orderUpdateDaysEscalationLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon"><i class="bi bi-calendar-range"></i></div>
              <div>
                <h2 class="bkmodal-header__ref" id="orderUpdateDaysEscalationLabel">
                  {{ __('company.pages.order-updates.20') }}<span class="num">#RES-009</span>
                </h2>
                <div class="bkmodal-header__meta">
                  <span><i class="bi bi-person"></i> {{ __('company.pages.order-updates.10') }}</span>
                  <span class="dot">•</span>
                  <span
                    ><i class="bi bi-calendar3"></i>
                    <span class="ltr-num">18/07/2026 18:00</span></span
                  >
                </div>
              </div>
            </div>
            <button
              type="button"
              class="booking-modal__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
          <div class="modal-body booking-modal__body">
            <div class="booking-modal__content">
              <div class="notice-banner mb-3">
                <div class="notice-banner__body">
                  <i class="bi bi-shield-lock notice-banner__icon"></i>
                  <div class="notice-banner__text">
                    {{ __('company.pages.order-updates.34') }}</div>
                </div>
              </div>
              <div class="order-update-card">
                <div class="order-update-card__head">
                  <div>
                    <h6 class="order-update-card__title">
                      <i class="bi bi-calendar-range"></i> {{ __('company.pages.order-updates.7') }}</h6>
                    <p class="order-update-card__hint">{{ __('company.pages.order-updates.59') }}</p>
                  </div>
                  <span
                    class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle"
                    >{{ __('company.pages.order-updates.36') }}</span
                  >
                </div>
                <div class="order-update-summary">
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.49') }}</span>
                    <span class="order-update-summary__value ltr-num">3</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.50') }}</span>
                    <span class="order-update-summary__value ltr-num">5</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.51') }}</span>
                    <span class="order-update-summary__value ltr-num">21/07/2026 18:00</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.60') }}</span>
                    <span class="order-update-summary__value ltr-num">23/07/2026 18:00</span>
                  </div>
                  <div class="order-update-summary__item">
                    <span class="order-update-summary__label">{{ __('company.pages.order-updates.61') }}</span>
                    <span class="order-update-summary__value">{{ __('company.pages.order-updates.62') }}</span>
                  </div>
                </div>
                <div
                  class="order-update-result order-update-result--escalated"
                  data-decision-result="RES-009"
                  data-result="escalated"
                  role="status"
                  hidden
                >
                  <strong>{{ __('company.pages.order-updates.38') }}</strong>
                  <div>{{ __('company.pages.order-updates.39') }}</div>
                </div>
                <div
                  class="order-update-result order-update-result--payment"
                  data-decision-result="RES-009"
                  data-result="admin-approved"
                  role="status"
                  hidden
                >
                  <strong>{{ __('company.pages.order-updates.40') }}</strong>
                  <div>{{ __('company.pages.order-updates.63') }}</div>
                </div>
                <div
                  class="order-update-result order-update-result--rejected"
                  data-decision-result="RES-009"
                  data-result="admin-rejected"
                  role="status"
                  hidden
                >
                  <strong>{{ __('company.pages.order-updates.42') }}</strong>
                  <div>{{ __('company.pages.order-updates.43') }}</div>
                </div>
                <div
                  class="order-update-result order-update-result--rejected"
                  data-decision-result="RES-009"
                  data-result="rejected"
                  role="status"
                  hidden
                >
                  <strong>{{ __('company.pages.order-updates.30') }}</strong>
                  <div>{{ __('company.pages.order-updates.44') }}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer bkmodal-footer">
            <div class="order-update-action-stage" data-decision-stage="RES-009-provider">
              <button
                type="button"
                class="btn btn-primary js-order-update-decision"
                data-request-id="RES-009"
                data-status="escalated"
              >
                <i class="bi bi-send"></i> {{ __('company.pages.order-updates.45') }}</button>
              <button
                type="button"
                class="btn btn-outline-danger js-order-update-decision"
                data-request-id="RES-009"
                data-status="rejected"
              >
                <i class="bi bi-x-circle"></i> {{ __('company.pages.order-updates.33') }}</button>
            </div>
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">
              <i class="bi bi-x-lg"></i> {{ __('company.common.92') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade order-update-modal"
      id="processedOrderUpdateModal"
      tabindex="-1"
      aria-labelledby="processedOrderUpdateModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon"><i class="bi bi-file-earmark-check"></i></div>
              <div>
                <h2 class="bkmodal-header__ref" id="processedOrderUpdateModalLabel">
                  {{ __('company.pages.order-updates.64') }}</h2>
                <div class="bkmodal-header__meta">{{ __('company.pages.order-updates.65') }}</div>
              </div>
            </div>
            <button
              type="button"
              class="booking-modal__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
          <div class="modal-body booking-modal__body">
            <div class="booking-modal__content">
              <section data-static-request-panel="RES-010" role="region">
                <div class="order-update-card">
                  <div class="order-update-card__head">
                    <div>
                      <h6 class="order-update-card__title">
                        <i class="bi bi-clock-history"></i> {{ __('company.pages.order-updates.66') }}<span class="num">#RES-010</span>
                      </h6>
                      <p class="order-update-card__hint">{{ __('company.pages.order-updates.11') }}</p>
                    </div>
                    <span class="badge request-status request-status--approved">{{ __('company.pages.order-updates.4') }}</span>
                  </div>
                  <div class="order-update-summary">
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.common.572') }}</span>
                      <span class="order-update-summary__value">{{ __('company.pages.order-updates.3') }}</span>
                    </div>
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.pages.order-updates.67') }}</span>
                      <span class="order-update-summary__value ltr-num">20/07/2026 09:00</span>
                    </div>
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.pages.order-updates.68') }}</span>
                      <span class="order-update-summary__value ltr-num">20/07/2026 10:30</span>
                    </div>
                  </div>
                  <div class="order-update-result order-update-result--approved is-visible">
                    {{ __('company.pages.order-updates.69') }}</div>
                </div>
              </section>

              <section data-static-request-panel="RES-011" role="region" hidden>
                <div class="order-update-card">
                  <div class="order-update-card__head">
                    <div>
                      <h6 class="order-update-card__title">
                        <i class="bi bi-calendar-range"></i> {{ __('company.pages.order-updates.66') }}<span class="num">#RES-011</span>
                      </h6>
                      <p class="order-update-card__hint">{{ __('company.pages.order-updates.12') }}</p>
                    </div>
                    <span class="badge request-status request-status--rejected">{{ __('company.common.521') }}</span>
                  </div>
                  <div class="order-update-summary">
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.common.572') }}</span>
                      <span class="order-update-summary__value">{{ __('company.pages.order-updates.7') }}</span>
                    </div>
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.pages.order-updates.49') }}</span>
                      <span class="order-update-summary__value ltr-num">2</span>
                    </div>
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.pages.order-updates.50') }}</span>
                      <span class="order-update-summary__value ltr-num">5</span>
                    </div>
                  </div>
                  <div class="order-update-result order-update-result--rejected is-visible">
                    {{ __('company.pages.order-updates.70') }}</div>
                </div>
              </section>

              <section data-static-request-panel="RES-012" role="region" hidden>
                <div class="order-update-card">
                  <div class="order-update-card__head">
                    <div>
                      <h6 class="order-update-card__title">
                        <i class="bi bi-clock-history"></i> {{ __('company.pages.order-updates.66') }}<span class="num">#RES-012</span>
                      </h6>
                      <p class="order-update-card__hint">{{ __('company.pages.order-updates.13') }}</p>
                    </div>
                    <span class="badge request-status request-status--admin-approved"
                      >{{ __('company.pages.order-updates.14') }}</span
                    >
                  </div>
                  <div class="order-update-summary">
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.common.572') }}</span>
                      <span class="order-update-summary__value">{{ __('company.pages.order-updates.3') }}</span>
                    </div>
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.pages.order-updates.67') }}</span>
                      <span class="order-update-summary__value ltr-num">21/07/2026 08:00</span>
                    </div>
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.pages.order-updates.68') }}</span>
                      <span class="order-update-summary__value ltr-num">21/07/2026 12:00</span>
                    </div>
                  </div>
                  <div class="order-update-result order-update-result--approved is-visible">
                    {{ __('company.pages.order-updates.71') }}</div>
                </div>
              </section>

              <section data-static-request-panel="RES-013" role="region" hidden>
                <div class="order-update-card">
                  <div class="order-update-card__head">
                    <div>
                      <h6 class="order-update-card__title">
                        <i class="bi bi-calendar-range"></i> {{ __('company.pages.order-updates.66') }}<span class="num">#RES-013</span>
                      </h6>
                      <p class="order-update-card__hint">{{ __('company.pages.order-updates.15') }}</p>
                    </div>
                    <span class="badge request-status request-status--admin-rejected"
                      >{{ __('company.pages.order-updates.16') }}</span
                    >
                  </div>
                  <div class="order-update-summary">
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.common.572') }}</span>
                      <span class="order-update-summary__value">{{ __('company.pages.order-updates.7') }}</span>
                    </div>
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.pages.order-updates.49') }}</span>
                      <span class="order-update-summary__value ltr-num">3</span>
                    </div>
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.pages.order-updates.50') }}</span>
                      <span class="order-update-summary__value ltr-num">6</span>
                    </div>
                  </div>
                  <div class="order-update-result order-update-result--rejected is-visible">
                    {{ __('company.pages.order-updates.72') }}</div>
                </div>
              </section>

              <section data-static-request-panel="RES-014" role="region" hidden>
                <div class="order-update-card">
                  <div class="order-update-card__head">
                    <div>
                      <h6 class="order-update-card__title">
                        <i class="bi bi-calendar-range"></i> {{ __('company.pages.order-updates.66') }}<span class="num">#RES-014</span>
                      </h6>
                      <p class="order-update-card__hint">{{ __('company.pages.order-updates.17') }}</p>
                    </div>
                    <span class="badge request-status request-status--completed"
                      >{{ __('company.pages.order-updates.18') }}</span
                    >
                  </div>
                  <div class="order-update-summary">
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.common.572') }}</span>
                      <span class="order-update-summary__value">{{ __('company.pages.order-updates.7') }}</span>
                    </div>
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.common.441') }}</span>
                      <span class="order-update-summary__value ltr-num">5</span>
                    </div>
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.pages.order-updates.73') }}</span>
                      <span class="order-update-summary__value">{{ __('company.pages.order-updates.62') }}</span>
                    </div>
                    <div class="order-update-summary__item">
                      <span class="order-update-summary__label">{{ __('company.pages.order-updates.52') }}</span>
                      <span class="order-update-summary__value ltr-num">27/07/2026 11:00</span>
                    </div>
                  </div>
                  <div class="order-update-result order-update-result--approved is-visible">
                    {{ __('company.pages.order-updates.74') }}</div>
                </div>
              </section>
            </div>
          </div>
          <div class="modal-footer bkmodal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">
              <i class="bi bi-x-lg"></i> {{ __('company.common.92') }}</button>
          </div>
        </div>
      </div>
    </div>

    
@endpush

@push('libs')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endpush

@push('scripts')
<script>
      // ============================================================
      // Order Update decisions only toggle static HTML states.
      document.querySelectorAll('.js-order-update-decision').forEach(function (button) {
        button.addEventListener('click', function () {
          const requestId = this.dataset.requestId;
          const status = this.dataset.status;
          const modal = this.closest('.order-update-modal');

          document
            .querySelectorAll('[data-request-status="' + requestId + '"]')
            .forEach(function (badge) {
              badge.hidden = badge.dataset.status !== status;
            });

          document
            .querySelectorAll('[data-decision-result="' + requestId + '"]')
            .forEach(function (result) {
              const isSelectedResult = result.dataset.result === status;
              result.hidden = !isSelectedResult;
              result.classList.toggle('is-visible', isSelectedResult);
            });

          document
            .querySelectorAll('[data-payment-status="' + requestId + '"]')
            .forEach(function (paymentStatus) {
              paymentStatus.hidden = paymentStatus.dataset.payment !== status;
            });

          const currentActions = this.closest('[data-decision-stage], [data-decision-actions]');
          if (currentActions) {
            currentActions
              .querySelectorAll('.js-order-update-decision')
              .forEach(function (decisionButton) {
                decisionButton.disabled = true;
              });
          }

          const editableInput = modal ? modal.querySelector('input:not([disabled])') : null;
          if (editableInput) editableInput.disabled = true;
        });
      });

      document.querySelectorAll('.js-view-static-request').forEach(function (button) {
        button.addEventListener('click', function () {
          const requestPanel = this.dataset.requestPanel;

          document.querySelectorAll('[data-static-request-panel]').forEach(function (panel) {
            panel.hidden = panel.dataset.staticRequestPanel !== requestPanel;
          });
        });
      });

      // Reservation Details Modal — uses the same design as pending-reservations.html
      const reservationBookingModalEl = document.getElementById('reservationDetailsModal');
      const reservationBookingModal = new bootstrap.Modal(reservationBookingModalEl);
      const reservationHistoryModalEl = document.getElementById('reservationHistoryModal');
      const reservationHistoryModal = new bootstrap.Modal(reservationHistoryModalEl);
      const reservationHistoryWrap = document.getElementById('reservationHistoryTableWrap');
      const reservationHistoryThumb = document.getElementById('reservationHistoryScrollThumb');
      let activeReservationBookingRow = null;

      function reservationTextFrom(row, selector) {
        const el = row.querySelector(selector);
        return el ? el.textContent.trim() : '';
      }

      function getReservationBookingData(row) {
        const statusText = reservationTextFrom(row, '.booking-status-cell .badge');
        const pickupDateTime = reservationTextFrom(row, '.pickup-datetime-cell');

        const pickupParts = pickupDateTime.split(' ');
        const pickupDate = pickupParts[0] || '';
        const pickupTime = pickupParts[1] || '';

        return {
          ref: reservationTextFrom(row, '.js-reservation-booking-details').replace(/\s+/g, ''),
          status: statusText,
          service: 'تسليم',
          customer: reservationTextFrom(row, '.cell-customer-stack__name'),
          pickupDate: pickupDate,
          pickupTime: pickupTime,
          period: '1',
          car: reservationTextFrom(row, '.car-cell') || '-',
          price: '203.26 / يومي',
          company: 'N2',
          office: reservationTextFrom(row, '.office-cell'),
          payment: 'بطاقة',
          accepted: statusText === 'مقبول' || statusText === 'عقد مفتوح' ? '1' : '0',
          cancelled: statusText === 'ملغي' ? '1' : '0',
          compensation: '0',
          rating: '5',
          ratedBy: reservationTextFrom(row, '.cell-customer-stack__name'),
          ratingDate: pickupDate,
          companyNotes: 'لا يوجد تعليقات',
          bankName: '-',
          iban: '-',
          cardHolder: '-',
        };
      }

      function showReservationBookingTab(tabName) {
        document.querySelectorAll('[data-reservation-booking-tab]').forEach(function (tab) {
          const isActive = tab.dataset.reservationBookingTab === tabName;
          tab.classList.toggle('is-active', isActive);
          tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });

        document.querySelectorAll('[data-reservation-booking-panel]').forEach(function (panel) {
          panel.classList.toggle('is-active', panel.dataset.reservationBookingPanel === tabName);
        });
      }

      function fillReservationBookingModal(data) {
        document.getElementById('reservationBookingRef').textContent = data.ref;
        document.getElementById('reservationBookingStatus').textContent = data.status;

        const statusBadge = document.getElementById('reservationBookingStatus');
        statusBadge.className = 'badge';
        if (data.status === 'مقبول') {
          statusBadge.classList.add('bg-success');
        } else if (data.status === 'جديد') {
          statusBadge.classList.add('bg-info', 'text-dark');
        } else if (data.status === 'قيد المتابعة') {
          statusBadge.classList.add('bg-warning', 'text-dark');
        } else if (data.status === 'متأخر') {
          statusBadge.classList.add('bg-danger');
        } else if (data.status === 'عقد مفتوح') {
          statusBadge.classList.add('bg-primary');
        } else {
          statusBadge.classList.add('bg-secondary');
        }

        document.getElementById('reservationBookingCustomerMeta').textContent = data.customer;
        document.getElementById('reservationBookingOfficeMeta').textContent = data.office;
        document.getElementById('reservationBookingService').textContent = data.service;
        document.getElementById('reservationBookingCustomer').textContent = data.customer;
        document.getElementById('reservationBookingPickupDate').textContent = data.pickupDate;
        document.getElementById('reservationBookingPickupTime').textContent = data.pickupTime;
        document.getElementById('reservationBookingPeriod').textContent = data.period;
        document.getElementById('reservationBookingCar').textContent = data.car;
        document.getElementById('reservationBookingPrice').textContent = data.price;
        document.getElementById('reservationBookingCompany').textContent = data.company;
        document.getElementById('reservationBookingOffice').textContent = data.office;
        document.getElementById('reservationBookingPayment').textContent = data.payment;

        let acceptedStatus = data.status;
        if (data.status === 'جديد') {
          acceptedStatus = 'جديد';
        } else if (data.status === 'عقد مفتوح') {
          acceptedStatus = 'عقد مفتوح';
        } else if (data.status === 'قيد المتابعة') {
          acceptedStatus = 'قيد المتابعة';
        } else if (data.status === 'متأخر') {
          acceptedStatus = 'متأخر';
        } else if (data.accepted === '1') {
          acceptedStatus = 'مقبول';
        } else {
          acceptedStatus = 'ملغي';
        }
        document.getElementById('reservationBookingAccepted').textContent = acceptedStatus;

        document.getElementById('reservationBookingCompensation').textContent = data.compensation;
        document.getElementById('reservationBookingRating').textContent = data.rating;
        document.getElementById('reservationBookingRatedBy').textContent = data.ratedBy;
        document.getElementById('reservationBookingRatingDate').textContent = data.ratingDate;
        document.getElementById('reservationBookingBankName').textContent = data.bankName;
        document.getElementById('reservationBookingIban').textContent = data.iban;
        document.getElementById('reservationBookingCardHolder').textContent = data.cardHolder;
      }

      function updateReservationHistoryThumb() {
        if (!reservationHistoryWrap || !reservationHistoryThumb) return;

        const trackHeight = reservationHistoryWrap.clientHeight;
        const ratio = reservationHistoryWrap.clientHeight / reservationHistoryWrap.scrollHeight;
        const thumbHeight = Math.max(ratio * trackHeight, 24);
        const maxScroll = reservationHistoryWrap.scrollHeight - reservationHistoryWrap.clientHeight;
        const scrollRatio = maxScroll > 0 ? reservationHistoryWrap.scrollTop / maxScroll : 0;

        reservationHistoryThumb.style.height = thumbHeight + 'px';
        reservationHistoryThumb.style.top = scrollRatio * (trackHeight - thumbHeight) + 'px';
      }

      function fillReservationHistoryModal(row) {
        const data = getReservationBookingData(row);

        const messages = [
          'تم إنشاء الحجز.',
          'تم تسجيل بيانات العميل.',
          'تم إنشاء عملية الدفع.',
          'تم تأكيد طريقة الدفع.',
          'تم تحديث حالة الحجز.',
          'تم إصدار الفاتورة.',
          'تم تجهيز الحجز للمتابعة.',
          'لا يوجد تعويض مسجل.',
        ];
        const users = [
          'نظام',
          'نظام',
          'نظام الدفع',
          'نظام',
          'نظام',
          'نظام الفواتير',
          'نظام',
          'نظام',
        ];
        const times = [
          '10:00:00',
          '10:03:16',
          '09:12:14',
          '09:14:38',
          '10:05:42',
          '09:16:02',
          '10:09:10',
          '09:18:20',
        ];

        document.getElementById('reservationHistoryModalLabel').textContent =
          'تاريخ العمليات والحجز';

        reservationHistoryModalEl.querySelectorAll('[data-history-ref]').forEach(function (cell) {
          cell.textContent = data.ref;
        });
        reservationHistoryModalEl
          .querySelectorAll('[data-history-message]')
          .forEach(function (cell, index) {
            cell.textContent = messages[index];
          });
        reservationHistoryModalEl
          .querySelectorAll('[data-history-user]')
          .forEach(function (cell, index) {
            cell.textContent = users[index];
          });
        reservationHistoryModalEl
          .querySelectorAll('[data-history-date]')
          .forEach(function (cell, index) {
            cell.textContent = data.pickupDate + ' ' + times[index];
          });
      }

      document.querySelectorAll('.js-reservation-booking-details').forEach(function (link) {
        link.addEventListener('click', function (e) {
          e.preventDefault();
          activeReservationBookingRow = this.closest('tr');
          fillReservationBookingModal(getReservationBookingData(activeReservationBookingRow));
          showReservationBookingTab('summary');
          reservationBookingModal.show();
        });
      });

      document.querySelectorAll('[data-reservation-booking-tab]').forEach(function (tab) {
        tab.addEventListener('click', function () {
          showReservationBookingTab(this.dataset.reservationBookingTab);
        });
      });

      reservationHistoryWrap.addEventListener('scroll', updateReservationHistoryThumb);
      reservationHistoryModalEl.addEventListener('shown.bs.modal', updateReservationHistoryThumb);
      window.addEventListener('resize', updateReservationHistoryThumb);

      document
        .getElementById('reservationHistoryScrollUpBtn')
        .addEventListener('click', function () {
          reservationHistoryWrap.scrollBy({ top: -100, behavior: 'smooth' });
        });
      document
        .getElementById('reservationHistoryScrollDownBtn')
        .addEventListener('click', function () {
          reservationHistoryWrap.scrollBy({ top: 100, behavior: 'smooth' });
        });

      document.querySelectorAll('[data-reservation-modal-action]').forEach(function (btn) {
        btn.addEventListener('click', function () {
          if (activeReservationBookingRow) {
            fillReservationHistoryModal(activeReservationBookingRow);
            reservationBookingModalEl.addEventListener(
              'hidden.bs.modal',
              function () {
                reservationHistoryModal.show();
              },
              { once: true },
            );
            reservationBookingModal.hide();
          }
        });
      });
    </script>
@endpush

