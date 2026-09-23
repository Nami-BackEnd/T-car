@extends('company.layouts.master')

@section('title', 'T-Car — Late Delivery Reservations')

@section('content')
<div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.pages.late-delivery.0') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.167') }}</span>
                <i class="bi bi-chevron-right"></i>
                <span class="current"> {{ __('company.pages.late-delivery.0') }}</span>
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

          <div class="notice-banner" id="reservationsNotice">
            <div class="notice-banner__body">
              <i class="bi bi-exclamation-triangle-fill notice-banner__icon"></i>
              <div class="notice-banner__text">
                <strong>{{ __('company.common.345') }}</strong>
                {{ __('company.pages.late-delivery.1') }}</div>
            </div>
            <button
              class="notice-banner__close"
              type="button"
               aria-label="{{ __('company.common.93') }}"
              onclick="this.closest('.notice-banner').style.display = 'none'"
            >
              <i class="bi bi-x-lg"></i>
            </button>
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
                    <th>{{ __('company.common.80') }}</th>
                    <th>{{ __('company.common.364') }}</th>
                    <th>{{ __('company.pages.late-delivery.2') }}</th>
                    <th>{{ __('company.common.365') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
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
                    <td>Toyota Yaris 2026</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Riyadh - Almarwa</a
                      >
                    </td>
                    <td class="ltr-num">18/07/2026 14:00</td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.408') }}</span>
                        <span class="cell-assignment__icons">
                          <button
                            type="button"
                            class="cell-assignment__edit"
                             title="{{ __('company.common.80') }}"
                            data-bs-toggle="modal"
                            data-bs-target="#assignDriverModal"
                          >
                            <i class="bi bi-pencil"></i>
                          </button>
                        </span>
                      </span>
                    </td>
                    <td><span class="badge bg-danger">{{ __('company.common.495') }}</span></td>
                    <td>
                      <button
                        class="btn btn-sm btn-outline tracking-map-btn"
                        data-booking-ref="RES-006"
                        data-driver="سائق 1"
                        data-location="الرياض - الملز"
                        data-destination="الرياض - العليا"
                      >
                        <i class="bi bi-map"></i>
                      </button>
                    </td>
                    <td>
                      <span class="badge bg-warning text-dark">{{ __('company.pages.late-delivery.3') }}</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
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
                    <td>HYUNDAI ACCENT 2025</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 Rental Car - Rawdah</a
                      >
                    </td>
                    <td class="ltr-num">18/07/2026 16:00</td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.409') }}</span>
                        <span class="cell-assignment__icons">
                          <button
                            type="button"
                            class="cell-assignment__edit"
                             title="{{ __('company.common.80') }}"
                            data-bs-toggle="modal"
                            data-bs-target="#assignDriverModal"
                          >
                            <i class="bi bi-pencil"></i>
                          </button>
                        </span>
                      </span>
                    </td>
                    <td><span class="badge bg-danger">{{ __('company.common.495') }}</span></td>
                    <td>
                      <button
                        class="btn btn-sm btn-outline tracking-map-btn"
                        data-booking-ref="RES-007"
                        data-driver="سائق 2"
                        data-location="الرياض - الروضة"
                        data-destination="الرياض - النخيل"
                      >
                        <i class="bi bi-map"></i>
                      </button>
                    </td>
                    <td>
                      <span class="badge bg-warning text-dark">{{ __('company.pages.late-delivery.3') }}</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <a
                        href="#"
                        class="cell-booking-ref"
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
                    <td>KIA pegas 2026</td>
                    <td>
                      <a class="dropdown-item" href="{{ route('company.office-details') }}"
                        ><i class="bi bi-eye"></i> N2 - Al-Olaya</a
                      >
                    </td>
                    <td class="ltr-num">19/07/2026 10:00</td>
                    <td>
                      <span class="cell-assignment">
                        <span class="cell-assignment__name">{{ __('company.common.410') }}</span>
                        <span class="cell-assignment__icons">
                          <button
                            type="button"
                            class="cell-assignment__edit"
                             title="{{ __('company.common.80') }}"
                            data-bs-toggle="modal"
                            data-bs-target="#assignDriverModal"
                          >
                            <i class="bi bi-pencil"></i>
                          </button>
                        </span>
                      </span>
                    </td>
                    <td><span class="badge bg-danger">{{ __('company.common.495') }}</span></td>

                    <td>
                      <button
                        class="btn btn-sm btn-outline tracking-map-btn"
                        data-booking-ref="RES-008"
                        data-driver="سائق 3"
                        data-location="الرياض - العليا"
                        data-destination="الرياض - الملز"
                      >
                        <i class="bi bi-map"></i>
                      </button>
                    </td>
                    <td><span class="badge bg-danger">{{ __('company.common.495') }}</span></td>
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
                      class="tracking-info-value"
                      id="modalBookingRef"
                      data-bs-toggle="modal"
                      data-bs-target="#reservationDetailsModal"
                      data-booking-ref=""
                      >--</a
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.92') }}</button>
            <button type="button" class="btn btn-primary">
              <i class="bi bi-telephone"></i> {{ __('company.common.102') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="assignDriverModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="assignDriverModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content booking-modal">
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon">
                <i class="bi bi-pen"></i>
              </div>
              <div>
                <h2 class="bkmodal-header__ref" id="assignDriverModalLabel">{{ __('company.common.80') }}</h2>
                <div class="bkmodal-header__meta">
                  <span><i class="bi bi-person-badge"></i> {{ __('company.common.123') }}</span>
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
            <label for="driverSelect" class="form-label">{{ __('company.common.188') }}</label>
            <select class="form-select" id="driverSelect">
              <option selected>{{ __('company.common.106') }}</option>
              <option>{{ __('company.common.408') }}</option>
              <option>{{ __('company.common.409') }}</option>
              <option>{{ __('company.common.410') }}</option>
              <option>{{ __('company.common.411') }}</option>
              <option>{{ __('company.common.412') }}</option>
            </select>
          </div>
          <div class="modal-footer booking-modal__footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ __('company.common.558') }}</button>
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
                  {{ __('company.common.368') }}<span class="num" id="reservationBookingRef">RES-006</span>
                  <span class="badge bg-success" id="reservationBookingStatus">{{ __('company.common.545') }}</span>
                </h2>
                <div class="bkmodal-header__meta">
                  <span
                    ><i class="bi bi-person"></i>
                    <span id="reservationBookingCustomerMeta">{{ __('company.common.377') }}</span></span
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
                        >{{ __('company.common.377') }}</span
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
                        >18/07/2026</span
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
                        >14:00</span
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
                      <span class="booking-detail-item__value" id="reservationBookingCar"
                        >Toyota Yaris 2026</span
                      >
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
                          >{{ __('company.common.377') }}</span
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
                          >18/07/2026</span
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

    
@endpush

@push('libs')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endpush

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function () {
        // Reservation Details Modal functionality
        const reservationBookingModalEl = document.getElementById('reservationDetailsModal');
        const reservationBookingModal = new bootstrap.Modal(reservationBookingModalEl);

        // Reservation History Modal functionality
        const reservationHistoryModalEl = document.getElementById('reservationHistoryModal');
        const reservationHistoryModal = new bootstrap.Modal(reservationHistoryModalEl);
        const reservationHistoryWrap = document.getElementById('reservationHistoryTableWrap');
        const reservationHistoryThumb = document.getElementById('reservationHistoryScrollThumb');
        let activeReservationBookingRow = null;

        // Handle booking reference clicks
        document
          .querySelectorAll('[data-bs-target="#reservationDetailsModal"]')
          .forEach(function (trigger) {
            trigger.addEventListener('click', function (e) {
              e.preventDefault();
              const bookingRef = this.getAttribute('data-booking-ref');
              if (bookingRef) {
                activeReservationBookingRow = this.closest('tr');
                loadReservationData(bookingRef);
              }
            });
          });

        // Handle tracking map button clicks
        document.querySelectorAll('.tracking-map-btn').forEach(function (btn) {
          btn.addEventListener('click', function () {
            const bookingRef = this.getAttribute('data-booking-ref');
            if (bookingRef) {
              activeReservationBookingRow = this.closest('tr');
              // Update the modal booking ref in tracking map modal
              const modalBookingRef = document.getElementById('modalBookingRef');
              if (modalBookingRef) {
                modalBookingRef.textContent = '#' + bookingRef;
                modalBookingRef.setAttribute('data-booking-ref', bookingRef);
              }
            }
          });
        });

        // Tab switching functionality
        document.querySelectorAll('[data-reservation-booking-tab]').forEach(function (tab) {
          tab.addEventListener('click', function () {
            const tabName = this.getAttribute('data-reservation-booking-tab');

            // Update tab buttons
            document.querySelectorAll('[data-reservation-booking-tab]').forEach(function (t) {
              t.classList.remove('is-active');
              t.setAttribute('aria-selected', 'false');
            });
            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');

            // Update panels
            document.querySelectorAll('[data-reservation-booking-panel]').forEach(function (panel) {
              panel.classList.remove('is-active');
            });
            const targetPanel = document.querySelector(
              '[data-reservation-booking-panel="' + tabName + '"]',
            );
            if (targetPanel) {
              targetPanel.classList.add('is-active');
            }
          });
        });

        // Function to load reservation data based on booking reference
        function loadReservationData(bookingRef) {
          // Remove # if present
          bookingRef = bookingRef.replace('#', '');

          // Use the active row or find it
          const row =
            activeReservationBookingRow ||
            document.querySelector(`[data-booking-ref="${bookingRef}"]`)?.closest('tr');
          if (!row) return;

          // Extract data from the row
          const customerName =
            row.querySelector('.cell-customer-stack__name')?.textContent.trim() || '';
          const customerPhone =
            row.querySelector('.cell-customer-stack__phone')?.textContent.trim() || '';
          const car = row.children[2]?.textContent.trim() || '';
          const office = row.querySelector('.dropdown-item')?.textContent.trim() || '';
          const dateTime = row.children[4]?.textContent.trim() || '';
          const deliveryStatus = row.querySelector('.badge')?.textContent.trim() || '';

          // Parse date and time
          const dateTimeParts = dateTime.split(' ');
          const pickupDate = dateTimeParts[0] || '';
          const pickupTime = dateTimeParts[1] || '';

          // Update modal elements
          document.getElementById('reservationBookingRef').textContent = '#' + bookingRef;
          document.getElementById('reservationBookingCustomerMeta').textContent = customerName;
          document.getElementById('reservationBookingOfficeMeta').textContent = office;
          document.getElementById('reservationBookingCustomer').textContent = customerName;
          document.getElementById('reservationBookingPickupDate').textContent = pickupDate;
          document.getElementById('reservationBookingPickupTime').textContent = pickupTime;
          document.getElementById('reservationBookingCar').textContent = car;
          document.getElementById('reservationBookingOffice').textContent = office;
          document.getElementById('reservationBookingAccepted').textContent = deliveryStatus;

          // Update tracking map modal booking ref if it exists
          const modalBookingRef = document.getElementById('modalBookingRef');
          if (modalBookingRef) {
            modalBookingRef.textContent = '#' + bookingRef;
            modalBookingRef.setAttribute('data-booking-ref', bookingRef);
          }

          // Update status badge
          const statusBadge = document.getElementById('reservationBookingStatus');
          statusBadge.textContent = deliveryStatus;
          statusBadge.className =
            'badge ' + (deliveryStatus === 'متأخر' ? 'bg-danger' : 'bg-success');

          // Update rating section
          document.getElementById('reservationBookingRatedBy').textContent = customerName;
          document.getElementById('reservationBookingRatingDate').textContent = pickupDate;
        }

        // Handle footer action buttons
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

        // Reservation History Modal scroll functionality
        function updateReservationHistoryThumb() {
          if (!reservationHistoryWrap || !reservationHistoryThumb) return;
          const scrollHeight = reservationHistoryWrap.scrollHeight;
          const clientHeight = reservationHistoryWrap.clientHeight;
          const scrollTop = reservationHistoryWrap.scrollTop;
          const trackHeight = reservationHistoryThumb.parentElement.clientHeight;
          const thumbHeight = Math.max((clientHeight / scrollHeight) * trackHeight, 20);
          const scrollRatio = scrollTop / (scrollHeight - clientHeight);

          reservationHistoryThumb.style.height = thumbHeight + 'px';
          reservationHistoryThumb.style.top = scrollRatio * (trackHeight - thumbHeight) + 'px';
        }

        function fillReservationHistoryModal(row) {
          const data = getReservationBookingDataFromRow(row);

          // Combined booking history and transactions data
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

        function getReservationBookingDataFromRow(row) {
          const customerName =
            row.querySelector('.cell-customer-stack__name')?.textContent.trim() || '';
          const dateTime = row.children[4]?.textContent.trim() || '';
          const dateTimeParts = dateTime.split(' ');
          const pickupDate = dateTimeParts[0] || '';
          const bookingRef =
            row.querySelector('[data-booking-ref]')?.getAttribute('data-booking-ref') || 'Unknown';

          return {
            ref: '#' + bookingRef,
            pickupDate: pickupDate,
          };
        }

        // Add scroll event listeners for history modal
        if (reservationHistoryWrap) {
          reservationHistoryWrap.addEventListener('scroll', updateReservationHistoryThumb);
        }
        if (reservationHistoryModalEl) {
          reservationHistoryModalEl.addEventListener(
            'shown.bs.modal',
            updateReservationHistoryThumb,
          );
        }
        window.addEventListener('resize', updateReservationHistoryThumb);

        if (document.getElementById('reservationHistoryScrollUpBtn')) {
          document
            .getElementById('reservationHistoryScrollUpBtn')
            .addEventListener('click', function () {
              if (reservationHistoryWrap) {
                reservationHistoryWrap.scrollBy({ top: -100, behavior: 'smooth' });
              }
            });
        }
        if (document.getElementById('reservationHistoryScrollDownBtn')) {
          document
            .getElementById('reservationHistoryScrollDownBtn')
            .addEventListener('click', function () {
              if (reservationHistoryWrap) {
                reservationHistoryWrap.scrollBy({ top: 100, behavior: 'smooth' });
              }
            });
        }
      });
    </script>
@endpush

