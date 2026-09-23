@extends('company.layouts.master')

@section('title', 'T-Car — تفاصيل الحجز #VDA7E4')

@section('content')

          <div class="detail-breadcrumb">
            <a href="{{ route('company.reservations') }}"><i class="bi bi-arrow-right"></i> {{ __('company.pages.booking-details.0') }}</a>
          </div>

          
          <div class="booking-hero">
            <div class="booking-hero__main">
              <div class="booking-hero__id-row">
                <button type="button" class="booking-hero__chip" id="copyUuidBtn"  title="{{ __('company.pages.booking-details.54') }}">
                  <i class="bi bi-clipboard"></i> {{ __('company.pages.booking-details.1') }}</button>
                <button
                  type="button"
                  class="booking-hero__chip"
                  id="copyIdBtn"
                   title="{{ __('company.pages.booking-details.55') }}"
                >
                  <i class="bi bi-clipboard"></i> {{ __('company.pages.booking-details.2') }}</button>
              </div>
              <div class="booking-hero__title-row">
                <h1>{{ __('company.common.166') }}<span class="ltr-num">#VDA7E4</span></h1>
                <div class="dropdown">
                  <button
                    type="button"
                    class="status-pill status-pill--cancelled dropdown-toggle"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    {{ __('company.common.554') }}</button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">{{ __('company.common.545') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('company.common.446') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('company.pages.booking-details.3') }}</a></li>
                    <li><a class="dropdown-item active" href="#">{{ __('company.common.554') }}</a></li>
                  </ul>
                </div>
              </div>
              <div class="booking-hero__meta">
                <span><i class="bi bi-calendar3"></i> {{ __('company.common.69') }}</span>
                <span class="dot">•</span>
                <span><i class="bi bi-building"></i> N2 — Riyadh</span>
                <span class="dot">•</span>
                <span><i class="bi bi-truck"></i> {{ __('company.common.300') }}</span>
              </div>
            </div>

            <div class="booking-hero__actions">
              <button type="button" class="btn btn-outline btn-urgent" id="urgentToggleBtn">
                <i class="bi bi-flag"></i> <span>{{ __('company.pages.booking-details.4') }}</span>
              </button>
              <div class="dropdown">
                <button
                  type="button"
                  class="btn btn-outline dropdown-toggle"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="bi bi-three-dots"></i> {{ __('company.common.230') }}</button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item text-danger" href="#"
                      ><i class="bi bi-x-circle"></i> {{ __('company.pages.booking-details.5') }}</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="#"
                      ><i class="bi bi-clock-history"></i> {{ __('company.common.292') }}</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="#"
                      ><i class="bi bi-calendar-check"></i> {{ __('company.common.291') }}</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="#"><i class="bi bi-star"></i> {{ __('company.common.83') }}</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#"
                      ><i class="bi bi-file-earmark-arrow-down"></i> {{ __('company.common.346') }}</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>

          
          <div class="detail-tabs-bar">
            <div class="view-tabs" id="bookingDetailTabs" role="tablist"  aria-label="{{ __('company.common.312') }}">
              <button
                type="button"
                class="view-tabs__btn is-active"
                data-bs-toggle="pill"
                data-bs-target="#tab-info"
                role="tab"
                aria-selected="true"
              >
                <i class="bi bi-info-circle"></i><span>{{ __('company.common.541') }}</span>
              </button>
              <button
                type="button"
                class="view-tabs__btn"
                data-bs-toggle="pill"
                data-bs-target="#tab-urgent"
                role="tab"
                aria-selected="false"
              >
                <i class="bi bi-flag"></i><span>{{ __('company.pages.booking-details.4') }}</span>
              </button>
              <button
                type="button"
                class="view-tabs__btn"
                data-bs-toggle="pill"
                data-bs-target="#tab-customer"
                role="tab"
                aria-selected="false"
              >
                <i class="bi bi-person"></i><span>{{ __('company.common.215') }}</span>
              </button>
              <button
                type="button"
                class="view-tabs__btn"
                id="vehicleTabBtn"
                data-bs-toggle="pill"
                data-bs-target="#tab-vehicle"
                role="tab"
                aria-selected="false"
              >
                <i class="bi bi-car-front"></i><span>{{ __('company.common.205') }}</span>
              </button>
              <button
                type="button"
                class="view-tabs__btn"
                data-bs-toggle="pill"
                data-bs-target="#tab-terms"
                role="tab"
                aria-selected="false"
              >
                <i class="bi bi-file-earmark-text"></i><span>{{ __('company.pages.booking-details.6') }}</span>
              </button>
              <button
                type="button"
                class="view-tabs__btn"
                data-bs-toggle="pill"
                data-bs-target="#tab-ratings"
                role="tab"
                aria-selected="false"
              >
                <i class="bi bi-star"></i><span>{{ __('company.common.163') }}</span>
              </button>
              <button
                type="button"
                class="view-tabs__btn"
                data-bs-toggle="pill"
                data-bs-target="#tab-compensation"
                role="tab"
                aria-selected="false"
              >
                <i class="bi bi-cash-coin"></i><span>{{ __('company.common.160') }}</span>
              </button>
              <button
                type="button"
                class="view-tabs__btn"
                data-bs-toggle="pill"
                data-bs-target="#tab-invoice"
                role="tab"
                aria-selected="false"
              >
                <i class="bi bi-receipt"></i><span>{{ __('company.common.218') }}</span>
              </button>
            </div>
          </div>

          <div class="tab-content" id="bookingDetailTabsContent">
            
            <div class="tab-pane fade show active" id="tab-info" role="tabpanel">
              <div class="detail-grid-layout">
                <div class="detail-main-col">
                  <div class="content-card detail-card">
                    <div class="detail-card__header">
                      <div>
                        <h2>{{ __('company.pages.booking-details.7') }}</h2>
                        <span class="subtext">ALFALLAJ MEZNAH IBRAHIM A</span>
                      </div>
                    </div>

                    <div class="detail-info-grid">
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon"><i class="bi bi-telephone"></i></div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.396') }}</span>
                          <span class="booking-detail-item__value ltr-num">+966508934039</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon">
                          <i class="bi bi-person-vcard"></i>
                        </div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.294') }}</span>
                          <span class="booking-detail-item__value ltr-num">(33) 25/07/1993</span>
                        </div>
                      </div>
                      <div class="booking-detail-item booking-detail-item--full">
                        <div class="booking-detail-item__icon">
                          <i class="bi bi-card-image"></i>
                        </div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.295') }}</span>
                          <span class="booking-detail-item__value ltr-num">13/09/2032</span>
                        </div>
                        <a href="#" class="booking-detail-item__action"
                          ><i class="bi bi-eye"></i> {{ __('company.common.537') }}</a
                        >
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon"><i class="bi bi-calendar3"></i></div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.284') }}</span>
                          <span class="booking-detail-item__value ltr-num">2026-07-22</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon"><i class="bi bi-clock"></i></div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.587') }}</span>
                          <span class="booking-detail-item__value ltr-num">16:00</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon">
                          <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.287') }}</span>
                          <span class="booking-detail-item__value ltr-num">2026-07-23</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon">
                          <i class="bi bi-calendar-range"></i>
                        </div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.219') }}</span>
                          <span class="booking-detail-item__value">{{ __('company.common.594') }}</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon"><i class="bi bi-geo-alt"></i></div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.pages.booking-details.8') }}</span>
                          <span class="booking-detail-item__value">Riyadh</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon">
                          <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.518') }}</span>
                          <span class="booking-detail-item__value">Riyadh</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="content-card detail-card">
                    <div class="detail-card__header">
                      <h2>{{ __('company.pages.booking-details.9') }}</h2>
                    </div>
                    <div class="detail-info-grid">
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon">
                          <i class="bi bi-credit-card"></i>
                        </div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.437') }}</span>
                          <span class="booking-detail-item__value">{{ __('company.common.267') }}</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon">
                          <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.pages.booking-details.10') }}</span>
                          <span class="booking-detail-item__value ltr-num">{{ __('company.common.24') }}</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon">
                          <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.168') }}</span>
                          <span class="booking-detail-item__value">1</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon"><i class="bi bi-x-circle"></i></div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.169') }}</span>
                          <span class="booking-detail-item__value">0</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="detail-side-col">
                  <div class="vehicle-showcase">
                    <div class="vehicle-showcase__media">
                      <span class="vehicle-showcase__badge">N2</span>
                      <i class="bi bi-car-front-fill"></i>
                    </div>
                    <div class="vehicle-showcase__body">
                      <h3 class="vehicle-showcase__name">{{ __('company.common.584') }}</h3>
                      <div class="vehicle-showcase__location">
                        <i class="bi bi-geo-alt"></i> Riyadh
                      </div>
                      <div class="vehicle-showcase__tags">
                        <span class="vtag"><i class="bi bi-truck"></i> {{ __('company.common.347') }}</span>
                        <span class="vtag vtag--success"
                          ><i class="bi bi-check2-circle"></i> {{ __('company.common.351') }}</span
                        >
                      </div>
                      <div class="vehicle-showcase__facts">
                        <div class="vfact"><span>{{ __('company.pages.booking-details.11') }}</span><span>N2</span></div>
                        <div class="vfact">
                          <span>{{ __('company.common.197') }}</span><span class="ltr-num">304.13 ﷼</span>
                        </div>
                        <div class="vfact"><span>{{ __('company.common.206') }}</span><span>N2</span></div>
                      </div>
                      <button
                        type="button"
                        class="btn btn-outline vehicle-showcase__cta"
                        id="viewVehicleBtn"
                      >
                        <i class="bi bi-arrow-left"></i> {{ __('company.pages.booking-details.12') }}</button>
                    </div>
                  </div>

                  <div class="content-card">
                    <div
                      class="detail-card__header"
                      style="margin-bottom: 12px; padding-bottom: 12px"
                    >
                      <h2 style="font-size: 0.9rem">{{ __('company.common.160') }}</h2>
                    </div>
                    <div class="empty-state" style="padding: 24px 10px">
                      <i class="bi bi-cash-coin" style="font-size: 2rem; margin-bottom: 10px"></i>
                      <p style="font-size: 0.82rem">{{ __('company.pages.booking-details.13') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="tab-pane fade" id="tab-urgent" role="tabpanel">
              <div class="content-card detail-card">
                <div class="urgent-banner">
                  <div class="urgent-banner__icon"><i class="bi bi-flag-fill"></i></div>
                  <div>
                    <p class="urgent-banner__title">{{ __('company.pages.booking-details.14') }}</p>
                    <p class="urgent-banner__text">
                      {{ __('company.pages.booking-details.15') }}</p>
                  </div>
                </div>
                <div class="urgent-toggle-row">
                  <div>
                    <div
                      class="booking-detail-item__label"
                      style="display: block; margin-bottom: 4px"
                    >
                      {{ __('company.pages.booking-details.16') }}</div>
                    <div class="booking-detail-item__value">{{ __('company.pages.booking-details.17') }}</div>
                  </div>
                  <button type="button" class="btn btn-outline btn-urgent" id="urgentToggleBtn2">
                    <i class="bi bi-flag"></i> {{ __('company.pages.booking-details.18') }}</button>
                </div>
              </div>

              <div class="content-card detail-card">
                <div class="detail-card__header"><h2>{{ __('company.pages.booking-details.19') }}</h2></div>
                <ul class="activity-timeline">
                  <li class="activity-timeline__item">
                    <span class="activity-timeline__dot activity-timeline__dot--gray"
                      ><i class="bi bi-dash"></i
                    ></span>
                    <p class="activity-timeline__text">
                      {{ __('company.pages.booking-details.20') }}</p>
                    <span class="activity-timeline__time">—</span>
                  </li>
                </ul>
              </div>
            </div>

            
            <div class="tab-pane fade" id="tab-customer" role="tabpanel">
              <div class="content-card detail-card">
                <div class="customer-profile">
                  <div class="customer-profile__avatar">AM</div>
                  <div>
                    <p class="customer-profile__name">ALFALLAJ MEZNAH IBRAHIM A</p>
                    <span class="customer-profile__sub">{{ __('company.pages.booking-details.21') }}</span>
                  </div>
                </div>

                <div class="customer-stats">
                  <div class="customer-stat">
                    <span class="customer-stat__value">1</span>
                    <span class="customer-stat__label">{{ __('company.pages.booking-details.22') }}</span>
                  </div>
                  <div class="customer-stat">
                    <span class="customer-stat__value">0</span>
                    <span class="customer-stat__label">{{ __('company.pages.booking-details.23') }}</span>
                  </div>
                  <div class="customer-stat">
                    <span class="customer-stat__value ltr-num">4.5</span>
                    <span class="customer-stat__label">{{ __('company.pages.booking-details.24') }}</span>
                  </div>
                </div>

                <div class="detail-info-grid">
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon"><i class="bi bi-telephone"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.396') }}</span>
                      <span class="booking-detail-item__value ltr-num">+966508934039</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon"><i class="bi bi-person-vcard"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.294') }}</span>
                      <span class="booking-detail-item__value ltr-num">(33) 25/07/1993</span>
                    </div>
                  </div>
                  <div class="booking-detail-item booking-detail-item--full">
                    <div class="booking-detail-item__icon"><i class="bi bi-card-image"></i></div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.pages.booking-details.25') }}</span>
                      <span class="booking-detail-item__value ltr-num">13/09/2032</span>
                    </div>
                    <a href="#" class="booking-detail-item__action"
                      ><i class="bi bi-eye"></i> {{ __('company.pages.booking-details.26') }}</a
                    >
                  </div>
                </div>
              </div>

              <div class="content-card detail-card">
                <div class="detail-card__header"><h2>{{ __('company.common.550') }}</h2></div>
                <div class="company-notes">
                  <div class="company-notes__content">
                    <div class="company-note">
                      <div class="company-note__header">
                        <span class="company-note__author">{{ __('company.pages.booking-details.27') }}</span>
                        <span class="company-note__date">2026-07-18</span>
                      </div>
                      <p class="company-note__text">
                        {{ __('company.pages.booking-details.28') }}</p>
                    </div>
                    <div class="company-note">
                      <div class="company-note__header">
                        <span class="company-note__author">{{ __('company.pages.booking-details.27') }}</span>
                        <span class="company-note__date">2026-07-10</span>
                      </div>
                      <p class="company-note__text">
                        {{ __('company.pages.booking-details.29') }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="tab-pane fade" id="tab-vehicle" role="tabpanel">
              <div class="detail-grid-layout">
                <div class="detail-main-col">
                  <div class="content-card detail-card">
                    <div class="detail-card__header"><h2>{{ __('company.pages.booking-details.30') }}</h2></div>
                    <div class="detail-info-grid">
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon"><i class="bi bi-car-front"></i></div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.203') }}</span>
                          <span class="booking-detail-item__value">{{ __('company.common.584') }}</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon"><i class="bi bi-palette"></i></div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.pages.booking-details.11') }}</span>
                          <span class="booking-detail-item__value">N2</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon">
                          <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.197') }}</span>
                          <span class="booking-detail-item__value ltr-num">304.13 ﷼</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon"><i class="bi bi-truck"></i></div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.pages.booking-details.31') }}</span>
                          <span class="booking-detail-item__value">{{ __('company.common.351') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="content-card detail-card">
                    <div class="detail-card__header"><h2>{{ __('company.pages.booking-details.32') }}</h2></div>
                    <div class="detail-info-grid">
                      <div class="booking-detail-item booking-detail-item--full">
                        <div class="booking-detail-item__icon"><i class="bi bi-geo-alt"></i></div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.235') }}</span>
                          <span class="booking-detail-item__value"
                            >N2 rental car - Riyadh - Al Aziziyah</span
                          >
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon"><i class="bi bi-building"></i></div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.common.206') }}</span>
                          <span class="booking-detail-item__value">N2</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon"><i class="bi bi-star"></i></div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.pages.booking-details.33') }}</span>
                          <span class="booking-detail-item__value ltr-num">4.4</span>
                        </div>
                      </div>
                      <div class="booking-detail-item">
                        <div class="booking-detail-item__icon"><i class="bi bi-person"></i></div>
                        <div class="booking-detail-item__content">
                          <span class="booking-detail-item__label">{{ __('company.pages.booking-details.34') }}</span>
                          <span class="booking-detail-item__value">hamza mohamed</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="detail-side-col">
                  <div class="vehicle-showcase">
                    <div class="vehicle-showcase__media">
                      <span class="vehicle-showcase__badge">N2</span>
                      <i class="bi bi-car-front-fill"></i>
                    </div>
                    <div class="vehicle-showcase__body">
                      <h3 class="vehicle-showcase__name">{{ __('company.common.584') }}</h3>
                      <div class="vehicle-showcase__location">
                        <i class="bi bi-geo-alt"></i> Riyadh
                      </div>
                      <div class="vehicle-showcase__tags">
                        <span class="vtag"><i class="bi bi-truck"></i> {{ __('company.common.347') }}</span>
                        <span class="vtag vtag--success"
                          ><i class="bi bi-check2-circle"></i> {{ __('company.common.351') }}</span
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="tab-pane fade" id="tab-terms" role="tabpanel">
              <div class="content-card detail-card">
                <div class="detail-card__header"><h2>{{ __('company.pages.booking-details.35') }}</h2></div>
                <ul class="terms-list">
                  <li class="terms-item">
                    <span class="terms-item__icon"><i class="bi bi-check2"></i></span>
                    <div>
                      <p class="terms-item__title">{{ __('company.pages.booking-details.36') }}</p>
                      <p class="terms-item__desc">
                        {{ __('company.pages.booking-details.37') }}</p>
                    </div>
                  </li>
                  <li class="terms-item">
                    <span class="terms-item__icon"><i class="bi bi-check2"></i></span>
                    <div>
                      <p class="terms-item__title">{{ __('company.pages.booking-details.38') }}</p>
                      <p class="terms-item__desc">{{ __('company.pages.booking-details.39') }}</p>
                    </div>
                  </li>
                  <li class="terms-item">
                    <span class="terms-item__icon"><i class="bi bi-check2"></i></span>
                    <div>
                      <p class="terms-item__title">{{ __('company.pages.booking-details.40') }}</p>
                      <p class="terms-item__desc">
                        {{ __('company.pages.booking-details.41') }}</p>
                    </div>
                  </li>
                  <li class="terms-item">
                    <span class="terms-item__icon"><i class="bi bi-check2"></i></span>
                    <div>
                      <p class="terms-item__title">{{ __('company.pages.booking-details.42') }}</p>
                      <p class="terms-item__desc">
                        {{ __('company.pages.booking-details.43') }}</p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>

            
            <div class="tab-pane fade" id="tab-ratings" role="tabpanel">
              <div class="content-card detail-card">
                <div class="rating-section">
                  <div class="rating-overview">
                    <div class="rating-overview__score">
                      <span class="rating-overview__number">4.5</span>
                      <div class="rating-overview__stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                      </div>
                      <span class="rating-overview__count">{{ __('company.common.13') }}</span>
                    </div>
                    <div class="rating-overview__breakdown">
                      <div class="rating-bar">
                        <span class="rating-bar__label">5</span>
                        <div class="rating-bar__track">
                          <div class="rating-bar__fill" style="width: 70%"></div>
                        </div>
                        <span class="rating-bar__count">90</span>
                      </div>
                      <div class="rating-bar">
                        <span class="rating-bar__label">4</span>
                        <div class="rating-bar__track">
                          <div class="rating-bar__fill" style="width: 20%"></div>
                        </div>
                        <span class="rating-bar__count">25</span>
                      </div>
                      <div class="rating-bar">
                        <span class="rating-bar__label">3</span>
                        <div class="rating-bar__track">
                          <div class="rating-bar__fill" style="width: 8%"></div>
                        </div>
                        <span class="rating-bar__count">10</span>
                      </div>
                      <div class="rating-bar">
                        <span class="rating-bar__label">2</span>
                        <div class="rating-bar__track">
                          <div class="rating-bar__fill" style="width: 2%"></div>
                        </div>
                        <span class="rating-bar__count">3</span>
                      </div>
                      <div class="rating-bar">
                        <span class="rating-bar__label">1</span>
                        <div class="rating-bar__track">
                          <div class="rating-bar__fill" style="width: 0%"></div>
                        </div>
                        <span class="rating-bar__count">0</span>
                      </div>
                    </div>
                  </div>

                  <div class="rating-categories">
                    <h6 class="rating-categories__title">{{ __('company.common.320') }}</h6>
                    <div class="rating-categories__grid">
                      <div class="rating-category">
                        <div class="rating-category__icon"><i class="bi bi-car-front"></i></div>
                        <div class="rating-category__info">
                          <span class="rating-category__name">{{ __('company.common.362') }}</span>
                          <span class="rating-category__score">4.8</span>
                        </div>
                        <div class="rating-category__stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-half"></i>
                        </div>
                      </div>
                      <div class="rating-category">
                        <div class="rating-category__icon"><i class="bi bi-person-check"></i></div>
                        <div class="rating-category__info">
                          <span class="rating-category__name">{{ __('company.common.380') }}</span>
                          <span class="rating-category__score">4.6</span>
                        </div>
                        <div class="rating-category__stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star"></i>
                        </div>
                      </div>
                      <div class="rating-category">
                        <div class="rating-category__icon"><i class="bi bi-geo-alt"></i></div>
                        <div class="rating-category__info">
                          <span class="rating-category__name">{{ __('company.common.242') }}</span>
                          <span class="rating-category__score">4.4</span>
                        </div>
                        <div class="rating-category__stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star"></i>
                        </div>
                      </div>
                      <div class="rating-category">
                        <div class="rating-category__icon">
                          <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="rating-category__info">
                          <span class="rating-category__name">{{ __('company.common.222') }}</span>
                          <span class="rating-category__score">4.2</span>
                        </div>
                        <div class="rating-category__stars">
                          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i
                          ><i class="bi bi-star"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="rating-reviews">
                    <h6 class="rating-reviews__title">{{ __('company.common.164') }}</h6>
                    <div class="rating-reviews__list">
                      <div class="rating-review">
                        <div class="rating-review__header">
                          <div class="rating-review__user">
                            <div class="rating-review__avatar"><i class="bi bi-person"></i></div>
                            <div class="rating-review__user-info">
                              <span class="rating-review__name">{{ __('company.common.508') }}</span>
                              <span class="rating-review__date">2026-07-15</span>
                            </div>
                          </div>
                          <div class="rating-review__rating">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i
                            ><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i
                            ><i class="bi bi-star-fill"></i>
                          </div>
                        </div>
                        <div class="rating-review__reason">
                          <span class="rating-review__reason-label">{{ __('company.common.418') }}</span>
                          <span class="rating-review__reason-text"
                            >{{ __('company.common.381') }}</span
                          >
                        </div>
                      </div>
                      <div class="rating-review">
                        <div class="rating-review__header">
                          <div class="rating-review__user">
                            <div class="rating-review__avatar"><i class="bi bi-person"></i></div>
                            <div class="rating-review__user-info">
                              <span class="rating-review__name">{{ __('company.common.414') }}</span>
                              <span class="rating-review__date">2026-07-10</span>
                            </div>
                          </div>
                          <div class="rating-review__rating">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i
                            ><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i
                            ><i class="bi bi-star"></i>
                          </div>
                        </div>
                        <div class="rating-review__reason">
                          <span class="rating-review__reason-label">{{ __('company.common.418') }}</span>
                          <span class="rating-review__reason-text"
                            >{{ __('company.common.298') }}</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="tab-pane fade" id="tab-compensation" role="tabpanel">
              <div class="content-card detail-card">
                <div class="no-comments">
                  <div class="no-comments__icon"><i class="bi bi-cash-coin"></i></div>
                  <h6 class="no-comments__title">{{ __('company.common.491') }}</h6>
                  <p class="no-comments__text">{{ __('company.pages.booking-details.44') }}</p>
                </div>
              </div>
            </div>

            
            <div class="tab-pane fade" id="tab-invoice" role="tabpanel">
              <div class="content-card detail-card">
                <div class="invoice-summary">
                  <div class="invoice-summary__item">
                    <span class="invoice-summary__label">{{ __('company.common.437') }}</span>
                    <span class="invoice-summary__value">{{ __('company.common.267') }}</span>
                  </div>
                  <div class="invoice-summary__item">
                    <span class="invoice-summary__label">{{ __('company.common.366') }}</span>
                    <span class="invoice-summary__value">{{ __('company.pages.booking-details.45') }}</span>
                  </div>
                  <div class="invoice-summary__item">
                    <span class="invoice-summary__label">{{ __('company.pages.booking-details.46') }}</span>
                    <span class="invoice-summary__value ltr-num">347.61 ﷼</span>
                  </div>
                </div>

                <div class="table-responsive-custom">
                  <table class="invoice-table">
                    <thead>
                      <tr>
                        <th>{{ __('company.pages.booking-details.47') }}</th>
                        <th>{{ __('company.common.161') }}</th>
                        <th style="text-align: end">{{ __('company.common.225') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{ __('company.pages.booking-details.10') }}</td>
                        <td>{{ __('company.pages.booking-details.48') }}</td>
                        <td class="amount ltr-num" style="text-align: end">304.13 ﷼</td>
                      </tr>
                      <tr>
                        <td>{{ __('company.pages.booking-details.49') }}</td>
                        <td>{{ __('company.pages.booking-details.50') }}</td>
                        <td class="amount ltr-num" style="text-align: end">50.00 ﷼</td>
                      </tr>
                      <tr>
                        <td>{{ __('company.pages.booking-details.51') }}</td>
                        <td>15%</td>
                        <td class="amount ltr-num" style="text-align: end">53.11 ﷼</td>
                      </tr>
                      <tr>
                        <td>{{ __('company.pages.booking-details.52') }}</td>
                        <td>—</td>
                        <td class="amount ltr-num" style="text-align: end">0.00 ﷼</td>
                      </tr>
                      <tr class="invoice-total-row">
                        <td colspan="2">{{ __('company.pages.booking-details.53') }}</td>
                        <td class="amount ltr-num" style="text-align: end">347.61 ﷼</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <button type="button" class="btn btn-primary" style="margin-top: 8px">
                  <i class="bi bi-file-earmark-arrow-down"></i> {{ __('company.common.346') }}</button>
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
        // Copy chips feedback
        function wireCopyChip(id, value) {
          var el = document.getElementById(id);
          if (!el) return;
          el.addEventListener('click', function () {
            if (navigator.clipboard) {
              navigator.clipboard.writeText(value).catch(function () {});
            }
            var original = el.innerHTML;
            el.classList.add('is-copied');
            el.innerHTML = '<i class="bi bi-check2"></i> تم النسخ';
            setTimeout(function () {
              el.classList.remove('is-copied');
              el.innerHTML = original;
            }, 1500);
          });
        }
        wireCopyChip('copyUuidBtn', 'a1b2c3d4-uuid-vda7e4');
        wireCopyChip('copyIdBtn', '1234567890');

        // Urgent toggle buttons (both in hero + tab)
        function toggleUrgent(btn) {
          btn.classList.toggle('is-active');
        }
        var urgentBtn1 = document.getElementById('urgentToggleBtn');
        var urgentBtn2 = document.getElementById('urgentToggleBtn2');
        if (urgentBtn1)
          urgentBtn1.addEventListener('click', function () {
            toggleUrgent(urgentBtn1);
          });
        if (urgentBtn2)
          urgentBtn2.addEventListener('click', function () {
            toggleUrgent(urgentBtn2);
          });

        // Jump to vehicle tab from the showcase card button
        var viewVehicleBtn = document.getElementById('viewVehicleBtn');
        var vehicleTabBtn = document.getElementById('vehicleTabBtn');
        if (viewVehicleBtn && vehicleTabBtn) {
          viewVehicleBtn.addEventListener('click', function () {
            var tab = new bootstrap.Tab(vehicleTabBtn);
            tab.show();
            vehicleTabBtn.scrollIntoView({
              behavior: 'smooth',
              inline: 'center',
              block: 'nearest',
            });
          });
        }
      });
    </script>
@endpush

