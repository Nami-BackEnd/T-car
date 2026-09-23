@extends('company.layouts.master')

@section('title', 'T-Car — تفاصيل الحجز #IEF75D')

@section('content')
<div class="bd2-workspace">
            <aside class="bd2-left-section"  aria-label="{{ __('company.pages.booking-details-two.61') }}">
              <div class="bd2-left-block">
                <button class="bd2-left-row" type="button">
                  <span>{{ __('company.common.550') }}</span>
                  <i class="bi bi-chevron-up"></i>
                </button>
                <button class="bd2-left-row is-active" type="button" id="bd2CommentBtn">
                  <span>{{ __('company.pages.booking-details-two.0') }}</span>
                  <i class="bi bi-send"></i>
                </button>
              </div>
              <div class="bd2-left-block">
                <button class="bd2-left-row" type="button" id="bd2BookingHistoryBtn">
                  <span>{{ __('company.common.293') }}</span>
                  <i class="bi bi-box-arrow-up-right"></i>
                </button>
                <button class="bd2-left-row" type="button" id="bd2CustomerBookingsBtn">
                  <span>{{ __('company.pages.booking-details-two.1') }}</span>
                  <i class="bi bi-box-arrow-up-right"></i>
                </button>
              </div>
            </aside>

            <div class="bd2-main-area">
              <div class="booking-details-two"  aria-label="{{ __('company.common.312') }}">
                
                <section class="bd2-header"  aria-label="{{ __('company.pages.booking-details-two.62') }}">
                  <div class="bd2-header__title">
                    <h1>{{ __('company.common.166') }}<span class="ltr-num">#IEF75D</span></h1>
                    
                  </div>

                  <div class="bd2-header__actions gap-2">
                    <div class="dropdown rounded-3">
                      <button
                        class="bd2-soft-action dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        <i class="bi bi-chevron-down"></i>
                        <span>{{ __('company.common.230') }}</span>
                      </button>
                      <ul class="dropdown-menu bd2-more-menu">
                        <li>
                          <button class="dropdown-item" type="button" data-bd2-open-tab="ratings">
                            <i class="bi bi-star"></i>
                            <span>{{ __('company.common.83') }}</span>
                          </button>
                        </li>
                        <li>
                          <button class="dropdown-item" type="button">
                            <i class="bi bi-file-earmark-arrow-down"></i>
                            <span>{{ __('company.common.346') }}</span>
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </section>

                
                <section class="bd2-card">
                  <div class="bd2-tabs" role="tablist"  aria-label="{{ __('company.common.312') }}">
                    <button
                      class="bd2-tabs__btn is-active"
                      type="button"
                      data-bd2-tab="booking"
                      aria-selected="true"
                    >
                      {{ __('company.common.541') }}</button>
                    <button
                      class="bd2-tabs__btn"
                      type="button"
                      data-bd2-tab="customer"
                      aria-selected="false"
                    >
                      {{ __('company.common.215') }}</button>
                    <button
                      class="bd2-tabs__btn"
                      type="button"
                      data-bd2-tab="vehicle"
                      aria-selected="false"
                    >
                      {{ __('company.common.205') }}</button>
                    
                    <button
                      class="bd2-tabs__btn"
                      type="button"
                      data-bd2-tab="ratings"
                      aria-selected="false"
                    >
                      {{ __('company.common.163') }}</button>
                    <button
                      class="bd2-tabs__btn"
                      type="button"
                      data-bd2-tab="compensation"
                      aria-selected="false"
                    >
                      {{ __('company.common.160') }}</button>
                    <button
                      class="bd2-tabs__btn"
                      type="button"
                      data-bd2-tab="invoice"
                      aria-selected="false"
                    >
                      {{ __('company.common.218') }}</button>
                  </div>

                  
                  <div class="bd2-tab-panel is-active" data-bd2-panel="booking">
                    <div class="bd2-booking-layout">
                      <aside class="bd2-car-summary">
                        <div class="bd2-car-summary__image">
                          <img src="{{ asset('company/img/car.png') }}"  alt="{{ __('company.pages.booking-details-two.2') }}" />
                        </div>
                        <h2>{{ __('company.pages.booking-details-two.2') }}</h2>
                        <p>N2</p>
                        <p>Riyadh</p>
                        <div class="bd2-car-summary__service">
                          <span><i class="bi bi-truck"></i> {{ __('company.common.347') }}</span>
                          <span><i class="bi bi-check2"></i> {{ __('company.common.351') }}</span>
                        </div>
                      </aside>

                      <div class="bd2-booking-content">
                        <div
                          class="d-flex justify-content-between align-items-center bd2-booking-heading-row"
                        >
                          <div class="bd2-customer-heading">
                            <h2>{{ __('company.pages.booking-details-two.3') }}</h2>
                            <span>{{ __('company.pages.booking-details-two.4') }}<span class="ltr-num">30-07-2026</span></span>
                          </div>

                          <div class="bd2-booking-status">
                            <span class="bd2-pill bd2-pill--success">{{ __('company.common.446') }}</span>
                            <button
                              class="bd2-outline-pill"
                              type="button"
                              data-bs-toggle="modal"
                              data-bs-target="#extensionModal"
                              data-current-return-date="2026-08-01"
                              data-daily-rate="203.26"
                            >
                              {{ __('company.common.339') }}</button>
                          </div>
                        </div>

                        <div class="bd2-booking-main">
                          <div class="bd2-details-grid">
                            <dl>
                              <dt>{{ __('company.common.396') }}</dt>
                              <dd class="ltr-num">+966506808367</dd>
                              <dt>{{ __('company.common.294') }}</dt>
                              <dd class="ltr-num">(62) 05/05/1964</dd>
                              <dt>{{ __('company.common.295') }}</dt>
                              <dd></dd>
                              <dt>{{ __('company.common.435') }}</dt>
                              <dd>
                                <button
                                  class="bd2-link-btn"
                                  type="button"
                                  data-bs-toggle="modal"
                                  data-bs-target="#licenseImageModal"
                                  data-license-image=""
                                >
                                  <i class="bi bi-paperclip"></i> {{ __('company.common.537') }}</button>
                              </dd>
                              <dt>{{ __('company.common.284') }}</dt>
                              <dd class="ltr-num">2026-07-30</dd>
                              <dt>{{ __('company.common.587') }}</dt>
                              <dd class="ltr-num">11:00</dd>
                              <dt>{{ __('company.pages.booking-details-two.5') }}</dt>
                              <dd class="ltr-num">2026-08-01</dd>
                              <dt>{{ __('company.pages.booking-details-two.6') }}</dt>
                              <dd class="ltr-num">2026-07-31</dd>
                              <dt>{{ __('company.common.219') }}</dt>
                              <dd>2</dd>
                              <dt>{{ __('company.pages.booking-details-two.7') }}</dt>
                              <dd>Riyadh</dd>
                              <dt>{{ __('company.common.518') }}</dt>
                              <dd>Riyadh</dd>
                            </dl>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="bd2-section-divider"></div>

                    <section class="bd2-delivery">
                      <div class="bd2-delivery__header">
                        <h2>{{ __('company.pages.booking-details-two.8') }}</h2>
                        <div class="bd2-segmented">
                          <button
                            type="button"
                            data-bd2-delivery-tab="pickup"
                            data-lat="24.7059"
                            data-lng="46.6502"
                          >
                            {{ __('company.common.148') }}</button>
                          <button
                            class="is-active"
                            type="button"
                            data-bd2-delivery-tab="dropoff"
                            data-lat="24.7384"
                            data-lng="46.7041"
                          >
                            {{ __('company.common.159') }}</button>
                        </div>
                      </div>

                      <div
                        class="bd2-delivery-panel"
                        data-bd2-delivery-panel="pickup"
                        data-bd2-delivery-status="completed"
                      >
                        <div class="bd2-delivery__content">
                          <div class="bd2-delivery__meta">
                            <p class="bd2-location-line">
                              <i class="bi bi-send"></i>
                              <span
                                >{{ __('company.pages.booking-details-two.9') }}</span
                              >
                            </p>
                            <p>{{ __('company.common.133') }}</p>
                            <p></p>
                          </div>

                          <div class="bd2-delivery__timeline">
                            <h3>{{ __('company.common.451') }}</h3>
                            <p>{{ __('company.pages.booking-details-two.10') }}</p>

                            <span class="bd2-pill bd2-pill--soft-success" data-bd2-status-pill
                              >{{ __('company.pages.booking-details-two.11') }}</span
                            >
                          </div>
                        </div>
                        <ol class="bd2-timeline">
                          <li class="is-done">
                            <span>{{ __('company.pages.booking-details-two.12') }}</span>
                            <time class="ltr-num">10:38 / 2026-07-30</time>
                          </li>
                          <li>
                            <span>{{ __('company.pages.booking-details-two.13') }}</span>
                            <time class="ltr-num">10:38 / 2026-07-30</time>
                          </li>
                          <li data-bd2-status-step>
                            <span data-bd2-status-label> {{ __('company.pages.booking-details-two.14') }}</span>
                            <time class="ltr-num" data-bd2-status-time>10:38 / 2026-07-30</time>
                          </li>
                        </ol>
                      </div>

                      <div
                        class="bd2-delivery-panel is-active"
                        data-bd2-delivery-panel="dropoff"
                        data-bd2-delivery-status="cancelled_by_driver"
                        data-bd2-cancelled-at="14:22 / 2026-08-01"
                      >
                        <div class="bd2-delivery__content bd2-delivery__content--dropoff">
                          <div class="bd2-delivery__meta">
                            <p class="bd2-location-line">
                              <i class="bi bi-send"></i>
                              <span
                                >{{ __('company.pages.booking-details-two.9') }}</span
                              >
                            </p>

                            <p class="ltr-num">{{ __('company.common.133') }}</p>
                          </div>

                          <div class="bd2-delivery__timeline">
                            <h3>{{ __('company.pages.booking-details-two.15') }}</h3>
                            <p>{{ __('company.pages.booking-details-two.16') }}</p>

                            <span class="bd2-pill bd2-pill--soft-success" data-bd2-status-pill
                              >{{ __('company.pages.booking-details-two.11') }}</span
                            >
                          </div>
                        </div>
                        <ol class="bd2-timeline">
                          <li class="is-done">
                            <span>{{ __('company.pages.booking-details-two.17') }}</span>
                            <time class="ltr-num">10:38 / 2026-07-30</time>
                          </li>
                          <li>
                            <span>{{ __('company.pages.booking-details-two.18') }}</span>
                            <time class="ltr-num">10:38 / 2026-07-30</time>
                          </li>
                          <li data-bd2-status-step>
                            <span data-bd2-status-label>{{ __('company.pages.booking-details-two.19') }}</span>
                            <time class="ltr-num" data-bd2-status-time>10:38 / 2026-07-30</time>
                          </li>
                        </ol>
                      </div>

                      <div class="bd2-map" id="bd2MapWrapper" data-lat="24.7384" data-lng="46.7041">
                        <div
                          id="bd2LocationMap"
                          style="height: 100%; min-height: 280px; border-radius: 12px"
                        ></div>
                      </div>
                    </section>
                  </div>

                  
                  <div class="bd2-tab-panel" data-bd2-panel="customer">
                    <div class="bd2-two-columns bd2-two-columns--customer">
                      <section>
                        <h2>{{ __('company.pages.booking-details-two.20') }}</h2>
                        <dl class="bd2-plain-list">
                          <dt>{{ __('company.pages.booking-details-two.21') }}</dt>
                          <dd>{{ __('company.pages.booking-details-two.3') }}</dd>
                          <dt>{{ __('company.pages.booking-details-two.22') }}</dt>
                          <dd>new</dd>
                          <dt>{{ __('company.common.396') }}</dt>
                          <dd class="ltr-num">+966506808367</dd>
                          <dt>{{ __('company.pages.booking-details-two.23') }}</dt>
                          <dd>riyadh16abcd@gmail.com</dd>
                          <dt>{{ __('company.common.294') }}</dt>
                          <dd class="ltr-num">(62) 05/05/1964</dd>
                        </dl>
                      </section>

                      <section>
                        <h2>{{ __('company.common.315') }}</h2>
                        <dl class="bd2-plain-list">
                          <dt>{{ __('company.pages.booking-details-two.24') }}</dt>
                          <dd class="ltr-num">30/07/2026</dd>
                          <dt>{{ __('company.common.162') }}</dt>
                          <dd>5</dd>
                          <dt>{{ __('company.pages.booking-details-two.25') }}</dt>
                          <dd>24</dd>
                          <dt>{{ __('company.common.168') }}</dt>
                          <dd>0</dd>
                          <dt>{{ __('company.pages.booking-details-two.26') }}</dt>
                          <dd>5</dd>
                          <dt>{{ __('company.pages.booking-details-two.27') }}</dt>
                          <dd>0</dd>
                          <dt>{{ __('company.common.435') }}</dt>
                          <dd>
                            <button
                              class="bd2-link-btn"
                              type="button"
                              data-bs-toggle="modal"
                              data-bs-target="#licenseImageModal"
                              data-license-image=""
                            >
                              <i class="bi bi-paperclip"></i> {{ __('company.common.537') }}</button>
                          </dd>
                        </dl>
                      </section>
                    </div>
                  </div>

                  
                  <div class="bd2-tab-panel" data-bd2-panel="vehicle">
                    <div class="bd2-three-columns">
                      <section>
                        <h2>{{ __('company.common.203') }}</h2>
                        <dl class="bd2-plain-list">
                          <dt>{{ __('company.common.207') }}</dt>
                          <dd>{{ __('company.pages.booking-details-two.2') }}</dd>
                          <dt>{{ __('company.common.171') }}</dt>
                          <dd>{{ __('company.common.350') }}</dd>
                          <dt>{{ __('company.common.483') }}</dt>
                          <dd></dd>
                          <dt>{{ __('company.pages.booking-details-two.28') }}</dt>
                          <dd></dd>
                          <dt>{{ __('company.common.407') }}</dt>
                          <dd></dd>
                        </dl>
                      </section>

                      <section>
                        <h2>{{ __('company.common.206') }}</h2>
                        <dl class="bd2-plain-list">
                          <dt>{{ __('company.common.131') }}</dt>
                          <dd>N2</dd>
                          <dt>{{ __('company.common.235') }}</dt>
                          <dd>{{ __('company.pages.booking-details-two.29') }}</dd>
                          <dt>{{ __('company.common.217') }}</dt>
                          <dd>
                            {{ __('company.pages.booking-details-two.30') }}</dd>
                          <dt>{{ __('company.pages.booking-details-two.31') }}</dt>
                          <dd>
                            <a href="tel:0535762361" class="bd2-inline-link"
                              >0535762361 <i class="bi bi-telephone"></i
                            ></a>
                          </dd>
                          <dt>{{ __('company.common.242') }}</dt>
                          <dd>
                            <a href="#" class="bd2-inline-link"
                              >{{ __('company.pages.booking-details-two.32') }}<i class="bi bi-send"></i
                            ></a>
                          </dd>
                        </dl>
                      </section>
                    </div>
                    <section class="schedule"  aria-label="{{ __('company.pages.booking-details-two.63') }}">
                      <header class="header">
                        <div>
                          <h2>{{ __('company.common.416') }}</h2>
                          <p>{{ __('company.pages.booking-details-two.33') }}</p>
                        </div>
                        <span class="week-badge">{{ __('company.pages.booking-details-two.34') }}</span>
                      </header>

                      <div class="days">
                        
                        <div class="day active">
                          <div class="day-info">
                            <span class="day-badge">Sun</span>
                            
                          </div>

                          <div class="shifts">
                            <div class="shift">
                              <span class="shift-number">01</span>
                              <div class="time-range">
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.555') }}</span>
                                  <time class="time">08:00</time>
                                </div>
                                <span class="arrow">←</span>
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.96') }}</span>
                                  <time class="time">12:00</time>
                                </div>
                              </div>
                            </div>

                            <div class="shift">
                              <span class="shift-number">02</span>
                              <div class="time-range">
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.555') }}</span>
                                  <time class="time">15:00</time>
                                </div>
                                <span class="arrow">←</span>
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.96') }}</span>
                                  <time class="time">22:45</time>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        
                        <div class="day">
                          <div class="day-info">
                            <span class="day-badge">Mon</span>
                          </div>

                          <div class="shifts">
                            <div class="shift">
                              <span class="shift-number">01</span>
                              <div class="time-range">
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.555') }}</span>
                                  <time class="time">08:00</time>
                                </div>
                                <span class="arrow">←</span>
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.96') }}</span>
                                  <time class="time">22:45</time>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        
                        <div class="day">
                          <div class="day-info">
                            <span class="day-badge">Tue</span>
                          </div>

                          <div class="shifts">
                            <div class="shift">
                              <span class="shift-number">01</span>
                              <div class="time-range">
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.555') }}</span>
                                  <time class="time">08:00</time>
                                </div>
                                <span class="arrow">←</span>
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.96') }}</span>
                                  <time class="time">11:00</time>
                                </div>
                              </div>
                            </div>

                            <div class="shift">
                              <span class="shift-number">02</span>
                              <div class="time-range">
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.555') }}</span>
                                  <time class="time">12:00</time>
                                </div>
                                <span class="arrow">←</span>
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.96') }}</span>
                                  <time class="time">16:00</time>
                                </div>
                              </div>
                            </div>

                            <div class="shift">
                              <span class="shift-number">03</span>
                              <div class="time-range">
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.555') }}</span>
                                  <time class="time">18:00</time>
                                </div>
                                <span class="arrow">←</span>
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.96') }}</span>
                                  <time class="time">22:45</time>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        
                        <div class="day">
                          <div class="day-info">
                            <span class="day-badge">Wed</span>
                          </div>
                          <div class="shifts">
                            <div class="shift">
                              <span class="shift-number">01</span>
                              <div class="time-range">
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.555') }}</span>
                                  <time class="time">08:00</time>
                                </div>
                                <span class="arrow">←</span>
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.96') }}</span>
                                  <time class="time">22:45</time>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        
                        <div class="day">
                          <div class="day-info">
                            <span class="day-badge">Thu</span>
                          </div>
                          <div class="shifts">
                            <div class="shift">
                              <span class="shift-number">01</span>
                              <div class="time-range">
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.555') }}</span>
                                  <time class="time">08:00</time>
                                </div>
                                <span class="arrow">←</span>
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.96') }}</span>
                                  <time class="time">22:45</time>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        
                        <div class="day">
                          <div class="day-info">
                            <span class="day-badge">Fri</span>
                          </div>
                          <div class="shifts">
                            <div class="shift">
                              <span class="shift-number">01</span>
                              <div class="time-range">
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.555') }}</span>
                                  <time class="time">15:15</time>
                                </div>
                                <span class="arrow">←</span>
                                <div class="time-group">
                                  <span class="time-label">{{ __('company.common.96') }}</span>
                                  <time class="time">22:45</time>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        
                      </div>

                      <footer class="footer">{{ __('company.pages.booking-details-two.35') }}</footer>
                    </section>
                  </div>

                  <div class="bd2-tab-panel" data-bd2-panel="invoices">
                    <section class="bd2-finance-panel">
                      <h2>{{ __('company.pages.booking-details-two.36') }}</h2>
                      <dl class="bd2-invoice-list">
                        <dt>{{ __('company.common.431') }}</dt>
                        <dd>N2</dd>
                        <dt>{{ __('company.common.326') }}</dt>
                        <dd class="ltr-num">09:48:56 2026-07-30</dd>
                        <dt>{{ __('company.common.219') }}</dt>
                        <dd class="ltr-num">{{ __('company.pages.booking-details-two.37') }}</dd>
                        <dt>{{ __('company.pages.booking-details-two.38') }}</dt>
                        <dd class="ltr-num">x 1 91.3</dd>
                        <dt>{{ __('company.pages.booking-details-two.39') }}</dt>
                        <dd class="ltr-num">91.3</dd>
                        <dt>{{ __('company.pages.booking-details-two.40') }}</dt>
                        <dd class="ltr-num">6.96</dd>
                        <dt>{{ __('company.pages.booking-details-two.41') }}</dt>
                        <dd class="ltr-num">5</dd>
                        <dt>{{ __('company.common.347') }}</dt>
                        <dd class="ltr-num">50</dd>
                        <dt>{{ __('company.common.351') }}</dt>
                        <dd class="ltr-num">50</dd>
                        <dt>{{ __('company.pages.booking-details-two.42') }}</dt>
                        <dd class="ltr-num">30.49</dd>
                        <dt>{{ __('company.common.391') }}</dt>
                        <dd class="ltr-num">0.00</dd>
                        <dt>{{ __('company.pages.booking-details-two.43') }}</dt>
                        <dd class="ltr-num">233.75</dd>
                        <dt>{{ __('company.pages.booking-details-two.44') }}</dt>
                        <dd class="ltr-num">0.00</dd>
                        <dt>{{ __('company.pages.booking-details-two.45') }}</dt>
                        <dd class="ltr-num bd2-total">233.75</dd>
                        <dt>{{ __('company.pages.booking-details-two.46') }}</dt>
                        <dd>{{ __('company.pages.booking-details-two.47') }}</dd>
                      </dl>
                    </section>
                  </div>

                  <div class="bd2-tab-panel" data-bd2-panel="ratings">
                    <section class="bd2-ratings-panel">
                      <div class="bd2-rating-block">
                        <div class="bd2-rating-block__head">
                          <h2>{{ __('company.pages.booking-details-two.48') }}</h2>
                          <p>
                            {{ __('company.pages.booking-details-two.49') }}<span class="ltr-num">10:38 / 30-07-2026</span>
                          </p>
                        </div>
                        <div class="bd2-stars"  aria-label="{{ __('company.pages.booking-details-two.64') }}">
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                          <i class="bi bi-star-fill"></i>
                        </div>
                      </div>

                      <div class="bd2-ratings-divider"></div>

                      <div class="bd2-rating-block bd2-rating-block--muted">
                        <div class="bd2-rating-block__head">
                          <h2>{{ __('company.pages.booking-details-two.50') }}</h2>
                        </div>
                        <div
                          class="bd2-stars bd2-stars--muted bd2-stars--interactive"
                          id="customerRatingStars"
                           aria-label="{{ __('company.pages.booking-details-two.65') }}"
                          data-rating="0"
                        >
                          <i class="bi bi-star-fill" data-star-value="1"></i>
                          <i class="bi bi-star-fill" data-star-value="2"></i>
                          <i class="bi bi-star-fill" data-star-value="3"></i>
                          <i class="bi bi-star-fill" data-star-value="4"></i>
                          <i class="bi bi-star-fill" data-star-value="5"></i>
                        </div>
                        <div class="d-flex flex-column gap-4">
                          <label class="bd2-form-label" for="customerRatingNotes">{{ __('company.pages.booking-details-two.51') }}</label>
                          <textarea
                            class="bd2-control"
                            id="customerRatingNotes"
                            rows="2"
                          ></textarea>
                          <button
                            class="btn btn-primary"
                            type="button"
                            id="submitCustomerRating"
                            disabled
                          >
                            {{ __('company.common.78') }}</button>
                        </div>
                      </div>
                    </section>
                  </div>

                  <div class="bd2-tab-panel" data-bd2-panel="compensation">
                    <div class="bd2-empty-line">{{ __('company.pages.booking-details-two.52') }}</div>
                  </div>

                  <div class="bd2-tab-panel" data-bd2-panel="invoice">
                    <section class="bd2-finance-panel">
                      <h2>{{ __('company.pages.booking-details-two.36') }}</h2>
                      <dl class="bd2-invoice-list">
                        <dt>{{ __('company.common.431') }}</dt>
                        <dd>N2</dd>
                        <dt>{{ __('company.common.326') }}</dt>
                        <dd class="ltr-num">09:48:56 2026-07-30</dd>
                        <dt>{{ __('company.common.219') }}</dt>
                        <dd class="ltr-num">{{ __('company.pages.booking-details-two.37') }}</dd>
                        <dt>{{ __('company.pages.booking-details-two.38') }}</dt>
                        <dd class="ltr-num">x 1 91.3</dd>
                        <dt>{{ __('company.pages.booking-details-two.39') }}</dt>
                        <dd class="ltr-num">91.3</dd>
                        <dt>{{ __('company.pages.booking-details-two.40') }}</dt>
                        <dd class="ltr-num">6.96</dd>
                        <dt>{{ __('company.pages.booking-details-two.41') }}</dt>
                        <dd class="ltr-num">5</dd>
                        <dt>{{ __('company.common.347') }}</dt>
                        <dd class="ltr-num">50</dd>
                        <dt>{{ __('company.common.351') }}</dt>
                        <dd class="ltr-num">50</dd>
                        <dt>{{ __('company.pages.booking-details-two.42') }}</dt>
                        <dd class="ltr-num">30.49</dd>
                        <dt>{{ __('company.common.391') }}</dt>
                        <dd class="ltr-num">0.00</dd>
                        <dt>{{ __('company.pages.booking-details-two.43') }}</dt>
                        <dd class="ltr-num">233.75</dd>
                        <dt>{{ __('company.pages.booking-details-two.44') }}</dt>
                        <dd class="ltr-num">0.00</dd>
                        <dt>{{ __('company.pages.booking-details-two.45') }}</dt>
                        <dd class="ltr-num bd2-total">233.75</dd>
                        <dt>{{ __('company.pages.booking-details-two.46') }}</dt>
                        <dd>
                          <button class="bd2-show-more" type="button" id="extensionShowMoreBtn">
                            <i class="bi bi-chevron-down"></i>
                            <span>{{ __('company.pages.booking-details-two.53') }}</span>
                          </button>
                          <div
                            class="bd2-extension-details"
                            id="extensionDetails"
                            style="display: none"
                          >
                            <div class="bd2-extension-details__item">
                              <span class="bd2-extension-details__label">{{ __('company.pages.booking-details-two.54') }}</span>
                              <span class="bd2-extension-details__value"
                                >{{ __('company.common.342') }}</span
                              >
                            </div>
                            <div class="bd2-extension-details__item">
                              <span class="bd2-extension-details__label">{{ __('company.pages.booking-details-two.55') }}</span>
                              <span class="bd2-extension-details__value">{{ __('company.pages.booking-details-two.56') }}</span>
                            </div>
                            <div class="bd2-extension-details__item">
                              <span class="bd2-extension-details__label">{{ __('company.pages.booking-details-two.57') }}</span>
                              <span class="bd2-extension-details__value ltr-num">3</span>
                            </div>
                            <div class="bd2-extension-details__item">
                              <span class="bd2-extension-details__label">{{ __('company.pages.booking-details-two.58') }}</span>
                              <span class="bd2-extension-details__value ltr-num">150.00</span>
                            </div>
                          </div>
                        </dd>
                      </dl>
                    </section>
                  </div>
                </section>
              </div>
            </div>
          </div>
@endsection

@push('modals')
</main>

        
      

    
    <div
      class="modal fade"
      id="bd2HistoryModal"
      tabindex="-1"
      aria-labelledby="bd2HistoryModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content car-logs-modal">
          <div class="car-logs-modal__header">
            <h5 class="car-logs-modal__header__title" id="bd2HistoryModalLabel">{{ __('company.common.291') }}</h5>
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
                id="bd2HistoryScrollUpBtn"
                 aria-label="{{ __('company.common.344') }}"
              >
                <i class="bi bi-chevron-up"></i>
              </button>
              <div class="car-logs-scrollctrl__track">
                <div class="car-logs-scrollctrl__thumb" id="bd2HistoryScrollThumb"></div>
              </div>
              <button
                type="button"
                class="car-logs-scrollctrl__btn"
                id="bd2HistoryScrollDownBtn"
                 aria-label="{{ __('company.common.343') }}"
              >
                <i class="bi bi-chevron-down"></i>
              </button>
            </div>

            <div class="car-logs-table-wrap" id="bd2HistoryTableWrap">
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
                    <td class="log-index">IEF75D</td>
                    <td class="log-message--activate">{{ __('company.common.324') }}</td>
                    <td>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num">2026-07-30 11:00:00</td>
                  </tr>
                  <tr>
                    <td class="log-index">IEF75D</td>
                    <td class="log-message--stock">{{ __('company.common.336') }}</td>
                    <td>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num">2026-07-30 11:03:00</td>
                  </tr>
                  <tr>
                    <td class="log-index">IEF75D</td>
                    <td class="log-message--activate">{{ __('company.pages.booking-details-two.59') }}</td>
                    <td>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num">2026-07-30 11:05:00</td>
                  </tr>
                  <tr>
                    <td class="log-index">IEF75D</td>
                    <td class="log-message--deactivate">{{ __('company.common.332') }}</td>
                    <td>{{ __('company.common.563') }}</td>
                    <td class="log-datetime ltr-num">2026-07-30 11:08:00</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="bd2CustomerBookingsModal"
      tabindex="-1"
      aria-labelledby="bd2CustomerBookingsModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="bd2CustomerBookingsModalLabel">{{ __('company.pages.booking-details-two.1') }}</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            ></button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>{{ __('company.common.398') }}</th>
                    <th>{{ __('company.common.203') }}</th>
                    <th>{{ __('company.common.284') }}</th>
                    <th>{{ __('company.common.287') }}</th>
                    <th>{{ __('company.common.165') }}</th>
                    <th>{{ __('company.common.145') }}</th>
                  </tr>
                </thead>
                <tbody id="customerBookingsTableBody">
                  <tr
                    data-booking-ref="IEF75D"
                    data-car="تويوتا كامري 2024"
                    data-pickup="2026-07-30"
                    data-return="2026-08-05"
                    data-status="نشط"
                  >
                    <td>
                      <a
                        href="#"
                        class="ltr-num text-decoration-none customer-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#bookingDetailsModal"
                        >#IEF75D</a
                      >
                    </td>
                    <td>{{ __('company.common.355') }}</td>
                    <td class="ltr-num">2026-07-30</td>
                    <td class="ltr-num">2026-08-05</td>
                    <td><span class="badge bg-success">{{ __('company.common.561') }}</span></td>
                    <td>
                      <div class="cell-actions">
                        <button
                          class="btn btn-primary btn-sm customer-booking-details"
                          data-bs-toggle="modal"
                          data-bs-target="#bookingDetailsModal"
                           title="{{ __('company.common.445') }}"
                        >
                          <i class="bi bi-eye"></i>
                        </button>
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="{{ route('company.booking-details-two') }}?tab=ratings"
                                ><i class="bi bi-star"></i> {{ __('company.common.83') }}</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="bi bi-file-earmark-arrow-down"></i> {{ __('company.common.346') }}</a
                              >
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-booking-ref="ABC123"
                    data-car="هيونداي سوناتا 2023"
                    data-pickup="2026-06-15"
                    data-return="2026-06-20"
                    data-status="مكتمل"
                  >
                    <td>
                      <a
                        href="#"
                        class="ltr-num text-decoration-none customer-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#bookingDetailsModal"
                        >#ABC123</a
                      >
                    </td>
                    <td>{{ __('company.pages.booking-details-two.60') }}</td>
                    <td class="ltr-num">2026-06-15</td>
                    <td class="ltr-num">2026-06-20</td>
                    <td><span class="badge bg-secondary">{{ __('company.common.548') }}</span></td>
                    <td>
                      <div class="cell-actions">
                        <button
                          class="btn btn-primary btn-sm customer-booking-details"
                          data-bs-toggle="modal"
                          data-bs-target="#bookingDetailsModal"
                           title="{{ __('company.common.445') }}"
                        >
                          <i class="bi bi-eye"></i>
                        </button>
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="{{ route('company.booking-details-two') }}?tab=ratings"
                                ><i class="bi bi-star"></i> {{ __('company.common.83') }}</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="bi bi-file-earmark-arrow-down"></i> {{ __('company.common.346') }}</a
                              >
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr
                    data-booking-ref="XYZ789"
                    data-car="نيسان ألتيما 2024"
                    data-pickup="2026-05-10"
                    data-return="2026-05-15"
                    data-status="مكتمل"
                  >
                    <td>
                      <a
                        href="#"
                        class="ltr-num text-decoration-none customer-booking-ref"
                        data-bs-toggle="modal"
                        data-bs-target="#bookingDetailsModal"
                        >#XYZ789</a
                      >
                    </td>
                    <td>{{ __('company.common.576') }}</td>
                    <td class="ltr-num">2026-05-10</td>
                    <td class="ltr-num">2026-05-15</td>
                    <td><span class="badge bg-secondary">{{ __('company.common.548') }}</span></td>
                    <td>
                      <div class="cell-actions">
                        <button
                          class="btn btn-primary btn-sm customer-booking-details"
                          data-bs-toggle="modal"
                          data-bs-target="#bookingDetailsModal"
                           title="{{ __('company.common.445') }}"
                        >
                          <i class="bi bi-eye"></i>
                        </button>
                        <div class="dropdown action-dropdown">
                          <button
                            class="action-menu-btn dropdown-toggle"
                            type="button"
                             title="{{ __('company.common.384') }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <i class="bi bi-three-dots"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                              <a class="dropdown-item" href="{{ route('company.booking-details-two') }}?tab=ratings"
                                ><i class="bi bi-star"></i> {{ __('company.common.83') }}</a
                              >
                            </li>
                            <li>
                              <a class="dropdown-item" href="#"
                                ><i class="bi bi-file-earmark-arrow-down"></i> {{ __('company.common.346') }}</a
                              >
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">{{ __('company.common.92') }}</button>
          </div>
        </div>
      </div>
    </div>

    
    <div
      class="modal fade"
      id="bookingDetailsModal"
      tabindex="-1"
      aria-labelledby="bookingDetailsModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content booking-modal">
          
          <div class="modal-header bkmodal-header">
            <div class="bkmodal-header__main">
              <div class="bkmodal-header__icon">
                <i class="bi bi-file-earmark-text"></i>
              </div>
              <div>
                <p class="bkmodal-header__ref">
                  {{ __('company.common.368') }}<span class="num" id="modalBookingRef">#vda7e4</span>
                  <span class="badge bg-danger" id="modalBookingStatus">{{ __('company.common.554') }}</span>
                </p>
                <div class="bkmodal-header__meta">
                  <span
                    ><i class="bi bi-person"></i>
                    <span id="modalCustomerName">ALFALLAJ MEZNAH IBRAHIM A</span></span
                  >
                  <span class="dot">•</span>
                  <span
                    ><i class="bi bi-building"></i> <span id="modalOffice">N2 — Riyadh</span></span
                  >
                  <span class="dot">•</span>
                  <span><i class="bi bi-calendar3"></i> {{ __('company.common.69') }}</span>
                </div>
              </div>
            </div>
            <div class="bkmodal-header__actions">
              
              <button
                type="button"
                class="booking-modal__close"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                <i class="bi bi-x-lg"></i>
              </button>
            </div>
          </div>

          
          <div class="modal-body booking-modal__body">
            <div class="booking-modal__tabs">
              <div class="view-tabs" id="bookingTabs" role="tablist"  aria-label="{{ __('company.common.312') }}">
                <button
                  type="button"
                  class="view-tabs__btn is-active"
                  data-tab-target="#summary"
                  role="tab"
                  aria-selected="true"
                >
                  <i class="bi bi-file-text"></i>
                  <span>{{ __('company.common.239') }}</span>
                </button>
                <button
                  type="button"
                  class="view-tabs__btn"
                  data-tab-target="#rating"
                  role="tab"
                  aria-selected="false"
                >
                  <i class="bi bi-star"></i>
                  <span>{{ __('company.common.162') }}</span>
                </button>

                <button
                  type="button"
                  class="view-tabs__btn"
                  data-tab-target="#bank"
                  role="tab"
                  aria-selected="false"
                >
                  <i class="bi bi-bank"></i>
                  <span>{{ __('company.common.540') }}</span>
                </button>
              </div>
            </div>

            <div class="tab-content booking-modal__content" id="bookingTabsContent">
              
              <div class="tab-pane fade show active" id="summary" role="tabpanel">
                <div class="bkmodal-section-label">{{ __('company.common.273') }}</div>
                <div class="booking-details-grid">
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-truck"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.171') }}</span>
                      <span class="booking-detail-item__value">{{ __('company.common.300') }}</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.449') }}</span>
                      <span class="booking-detail-item__value" id="modalCustomer"
                        >ALFALLAJ MEZNAH IBRAHIM A</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-calendar3"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.284') }}</span>
                      <span class="booking-detail-item__value ltr-num" id="modalPickupFullDate"
                        >2026-07-22</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-clock"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.587') }}</span>
                      <span class="booking-detail-item__value ltr-num" id="modalPickupTime"
                        >16:00</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-calendar-range"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.219') }}</span>
                      <span class="booking-detail-item__value">1</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-car-front"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.430') }}</span>
                      <span class="booking-detail-item__value" id="modalCar"
                        >{{ __('company.common.584') }}</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.423') }}</span>
                      <span class="booking-detail-item__value ltr-num" id="modalDailyPrice"
                        >{{ __('company.common.24') }}</span
                      >
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.431') }}</span>
                      <span class="booking-detail-item__value">N2</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.235') }}</span>
                      <span class="booking-detail-item__value" id="modalOfficeLocation"
                        >N2 rental car - Riyadh - Al Aziziyah</span
                      >
                    </div>
                  </div>
                </div>

                <div class="bkmodal-section-label">{{ __('company.common.172') }}</div>
                <div class="booking-details-grid">
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
                      <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.365') }}</span>
                      <span class="booking-detail-item__value">{{ __('company.common.561') }}</span>
                    </div>
                  </div>
                  <div class="booking-detail-item">
                    <div class="booking-detail-item__icon">
                      <i class="bi bi-cash"></i>
                    </div>
                    <div class="booking-detail-item__content">
                      <span class="booking-detail-item__label">{{ __('company.common.160') }}</span>
                      <span class="booking-detail-item__value">{{ __('company.common.491') }}</span>
                    </div>
                  </div>
                </div>
              </div>

              
              <div class="tab-pane fade" id="rating" role="tabpanel">
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
                  </div>
                </div>
              </div>

              
              <div class="tab-pane fade" id="bank" role="tabpanel">
                <div class="bank-info-section">
                  <div class="bank-info-grid">
                    <div class="bank-info-item">
                      <div class="bank-info-item__icon">
                        <i class="bi bi-building"></i>
                      </div>
                      <div class="bank-info-item__content">
                        <span class="bank-info-item__label">{{ __('company.common.132') }}</span>
                        <span class="bank-info-item__value">{{ __('company.common.156') }}</span>
                      </div>
                    </div>
                    <div class="bank-info-item">
                      <div class="bank-info-item__icon">
                        <i class="bi bi-credit-card"></i>
                      </div>
                      <div class="bank-info-item__content">
                        <span class="bank-info-item__label">{{ __('company.common.152') }}</span>
                        <span class="bank-info-item__value">SA44 2000 0000 0000 0000 0000</span>
                      </div>
                    </div>
                    <div class="bank-info-item">
                      <div class="bank-info-item__icon">
                        <i class="bi bi-person"></i>
                      </div>
                      <div class="bank-info-item__content">
                        <span class="bank-info-item__label">{{ __('company.common.139') }}</span>
                        <span class="bank-info-item__value">{{ __('company.common.509') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
          <div class="modal-footer bkmodal-footer">
            <a href="{{ route('company.booking-details-two') }}" class="btn btn-primary">
              <i class="bi bi-file-earmark-text"></i>
              <span> {{ __('company.common.312') }}</span>
            </a>
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
        function setBd2Tab(tabName) {
          const targetTab = Array.from(document.querySelectorAll('[data-bd2-tab]')).find(
            function (tab) {
              return tab.dataset.bd2Tab === tabName;
            },
          );
          const targetPanel = Array.from(document.querySelectorAll('[data-bd2-panel]')).find(
            function (panel) {
              return panel.dataset.bd2Panel === tabName;
            },
          );
          if (!targetTab || !targetPanel) return;

          document.querySelectorAll('[data-bd2-tab]').forEach(function (item) {
            const isActive = item.dataset.bd2Tab === tabName;
            item.classList.toggle('is-active', isActive);
            item.setAttribute('aria-selected', isActive ? 'true' : 'false');
          });

          document.querySelectorAll('[data-bd2-panel]').forEach(function (panel) {
            panel.classList.toggle('is-active', panel.dataset.bd2Panel === tabName);
          });
        }

        document.querySelectorAll('[data-bd2-tab]').forEach(function (tab) {
          tab.addEventListener('click', function () {
            setBd2Tab(this.dataset.bd2Tab);
          });
        });

        document.querySelectorAll('[data-bd2-open-tab]').forEach(function (button) {
          button.addEventListener('click', function () {
            setBd2Tab(this.dataset.bd2OpenTab);
          });
        });

        const initialBd2Tab = new URLSearchParams(window.location.search).get('tab');
        if (initialBd2Tab) {
          setBd2Tab(initialBd2Tab);
        }

        document.querySelectorAll('[data-copy-value]').forEach(function (button) {
          button.addEventListener('click', function () {
            if (navigator.clipboard) {
              navigator.clipboard.writeText(this.dataset.copyValue).catch(function () {});
            }
            this.classList.add('is-copied');
            setTimeout(() => this.classList.remove('is-copied'), 1200);
          });
        });

        document.querySelectorAll('[data-bd2-delivery-tab]').forEach(function (tab) {
          tab.addEventListener('click', function () {
            const tabName = this.dataset.bd2DeliveryTab;

            document.querySelectorAll('[data-bd2-delivery-tab]').forEach(function (item) {
              item.classList.toggle('is-active', item.dataset.bd2DeliveryTab === tabName);
            });

            document.querySelectorAll('[data-bd2-delivery-panel]').forEach(function (panel) {
              panel.classList.toggle('is-active', panel.dataset.bd2DeliveryPanel === tabName);
            });
          });
        });

        // ============================================================
        // حالة التوصيل: إلغاء من قبل السائق
        // ------------------------------------------------------------
        // كل لوحة توصيل (استلام / تسليم) تحمل data-bd2-delivery-status
        // من الباك إند. القيم المتوقعة:
        //   - "completed"          → تم التسليم في الوقت المحدد (الوضع الحالي)
        //   - "cancelled_by_driver" → ألغى السائق مهمة التوصيل
        // عند الإلغاء، لازم توقيت الإلغاء يكون متاح في
        // data-bd2-cancelled-at على نفس اللوحة.
        // الدالة دي قابلة لإعادة الاستخدام: تتنفذ عند تحميل الصفحة
        // وممكن تتنادى تاني (مثلاً بعد تحديث حالة عن طريق polling/AJAX)
        // على أي لوحة توصيل فيها نفس الـ data attributes.
        // ============================================================
        function applyDeliveryStatus(panel) {
          if (!panel) return;

          var status = panel.dataset.bd2DeliveryStatus || 'completed';
          var statusPill = panel.querySelector('[data-bd2-status-pill]');
          var statusStep = panel.querySelector('[data-bd2-status-step]');
          var statusLabel = panel.querySelector('[data-bd2-status-label]');
          var statusTime = panel.querySelector('[data-bd2-status-time]');

          var isCancelled = status === 'cancelled_by_driver' || status === 'cancelled';

          if (statusPill) {
            statusPill.classList.toggle('bd2-pill--soft-success', !isCancelled);
            statusPill.classList.toggle('bd2-pill--soft-danger', isCancelled);
            statusPill.textContent = isCancelled
              ? 'تم إلغاء التوصيل من قبل السائق'
              : 'تم التسليم في الوقت المحدد';
          }

          if (statusStep) {
            statusStep.classList.toggle('is-cancelled', isCancelled);
            statusStep.classList.toggle('is-done', !isCancelled);
          }

          if (statusLabel) {
            // نحتفظ بالنص الأصلي (مرحلة التسليم النهائية) عشان نقدر
            // نرجعله لو الحالة اتغيرت لاحقًا من إلغاء إلى إتمام.
            if (!statusLabel.dataset.originalText) {
              statusLabel.dataset.originalText = statusLabel.textContent.trim();
            }
            statusLabel.textContent = isCancelled
              ? 'تم إلغاء التوصيل من قبل السائق'
              : statusLabel.dataset.originalText;
          }

          if (statusTime) {
            if (!statusTime.dataset.originalTime) {
              statusTime.dataset.originalTime = statusTime.textContent.trim();
            }
            statusTime.textContent = isCancelled
              ? panel.dataset.bd2CancelledAt || statusTime.dataset.originalTime
              : statusTime.dataset.originalTime;
          }
        }

        document.querySelectorAll('[data-bd2-delivery-panel]').forEach(applyDeliveryStatus);

        // إعادة تطبيق الحالة لو تغيّرت بيانات اللوحة برمجيًا بعد التحميل
        // (مثال: استدعاء بعد استلام رد من الباك إند)
        window.TCarApplyDeliveryStatus = applyDeliveryStatus;

        const bd2HistoryModalEl = document.getElementById('bd2HistoryModal');
        const bd2HistoryWrap = document.getElementById('bd2HistoryTableWrap');
        const bd2HistoryThumb = document.getElementById('bd2HistoryScrollThumb');
        const bd2HistoryModal = new bootstrap.Modal(bd2HistoryModalEl);

        function updateBd2HistoryThumb() {
          if (!bd2HistoryWrap || !bd2HistoryThumb) return;

          const trackHeight = bd2HistoryWrap.clientHeight;
          const ratio = bd2HistoryWrap.clientHeight / bd2HistoryWrap.scrollHeight;
          const thumbHeight = Math.max(ratio * trackHeight, 24);
          const maxScroll = bd2HistoryWrap.scrollHeight - bd2HistoryWrap.clientHeight;
          const scrollRatio = maxScroll > 0 ? bd2HistoryWrap.scrollTop / maxScroll : 0;

          bd2HistoryThumb.style.height = thumbHeight + 'px';
          bd2HistoryThumb.style.top = scrollRatio * (trackHeight - thumbHeight) + 'px';
        }

        document.getElementById('bd2BookingHistoryBtn').addEventListener('click', function () {
          bd2HistoryModal.show();
        });

        // Comment button - open ratings tab and focus on company notes
        const bd2CommentBtn = document.getElementById('bd2CommentBtn');
        if (bd2CommentBtn) {
          bd2CommentBtn.addEventListener('click', function () {
            // Find and click the ratings tab button
            const ratingsTabBtn = document.querySelector('[data-bd2-tab="ratings"]');
            if (ratingsTabBtn) {
              ratingsTabBtn.click();

              // Scroll to the ratings panel
              const ratingsPanel = document.querySelector('[data-bd2-panel="ratings"]');
              if (ratingsPanel) {
                ratingsPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
              }
            }
          });
        }

        // Customer bookings button - open customer bookings modal
        const bd2CustomerBookingsBtn = document.getElementById('bd2CustomerBookingsBtn');
        const bd2CustomerBookingsModalEl = document.getElementById('bd2CustomerBookingsModal');
        if (bd2CustomerBookingsBtn && bd2CustomerBookingsModalEl) {
          const bd2CustomerBookingsModal = new bootstrap.Modal(bd2CustomerBookingsModalEl);
          bd2CustomerBookingsBtn.addEventListener('click', function () {
            bd2CustomerBookingsModal.show();
          });
        }

        // Handle customer booking details modal - populate data from row
        document
          .querySelectorAll('.customer-booking-ref, .customer-booking-details')
          .forEach(function (element) {
            element.addEventListener('click', function (e) {
              e.preventDefault();
              const row = this.closest('tr');
              const bookingRef = row.getAttribute('data-booking-ref');
              const car = row.getAttribute('data-car');
              const pickup = row.getAttribute('data-pickup');
              const returnDate = row.getAttribute('data-return');
              const status = row.getAttribute('data-status');

              // Update modal elements
              document.getElementById('modalBookingRef').textContent = '#' + bookingRef;
              document.getElementById('modalCarName').textContent = car;
              document.getElementById('modalCar').textContent = car;
              document.getElementById('modalPickupDate').textContent = pickup.substring(5); // MM-DD
              document.getElementById('modalReturnDate').textContent = returnDate.substring(5); // MM-DD
              document.getElementById('modalPickupFullDate').textContent = pickup;
              document.getElementById('modalBookingStatus').textContent = status;
              document.getElementById('modalBookingStatus').className =
                'badge ' + (status === 'نشط' ? 'bg-success' : 'bg-secondary');
            });
          });

        // Initialize booking tabs functionality
        const bookingTabs = document.querySelectorAll('#bookingTabs .view-tabs__btn');
        bookingTabs.forEach(function (tab) {
          tab.addEventListener('click', function () {
            const target = this.getAttribute('data-tab-target');

            // Update tab buttons
            bookingTabs.forEach(function (t) {
              t.classList.remove('is-active');
              t.setAttribute('aria-selected', 'false');
            });
            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');

            // Update tab panes
            document.querySelectorAll('#bookingTabsContent .tab-pane').forEach(function (pane) {
              pane.classList.remove('show', 'active');
            });
            document.querySelector(target).classList.add('show', 'active');
          });
        });

        bd2HistoryWrap.addEventListener('scroll', updateBd2HistoryThumb);
        bd2HistoryModalEl.addEventListener('shown.bs.modal', updateBd2HistoryThumb);
        window.addEventListener('resize', updateBd2HistoryThumb);

        document.getElementById('bd2HistoryScrollUpBtn').addEventListener('click', function () {
          bd2HistoryWrap.scrollBy({ top: -100, behavior: 'smooth' });
        });
        document.getElementById('bd2HistoryScrollDownBtn').addEventListener('click', function () {
          bd2HistoryWrap.scrollBy({ top: 100, behavior: 'smooth' });
        });

        // Customer rating stars functionality
        const customerRatingStars = document.getElementById('customerRatingStars');
        const customerRatingNotes = document.getElementById('customerRatingNotes');
        const submitCustomerRating = document.getElementById('submitCustomerRating');

        if (customerRatingStars) {
          const stars = customerRatingStars.querySelectorAll('i');

          // Initialize all stars as inactive
          stars.forEach(function (s) {
            s.classList.add('inactive');
          });

          stars.forEach(function (star) {
            star.addEventListener('click', function () {
              const ratingValue = parseInt(this.dataset.starValue);
              customerRatingStars.dataset.rating = ratingValue;
              customerRatingStars.classList.remove('bd2-stars--muted');
              customerRatingStars.setAttribute('aria-label', 'تقييم ' + ratingValue + ' من 5');

              // Update star visuals using CSS classes instead of inline styles
              stars.forEach(function (s, index) {
                if (index < ratingValue) {
                  s.classList.add('active');
                  s.classList.remove('inactive');
                } else {
                  s.classList.remove('active');
                  s.classList.add('inactive');
                }
              });

              // Enable submit button if rating is selected
              if (submitCustomerRating) {
                submitCustomerRating.disabled = false;
              }
            });

            star.addEventListener('mouseenter', function () {
              const hoverValue = parseInt(this.dataset.starValue);
              stars.forEach(function (s, index) {
                if (index < hoverValue) {
                  s.classList.add('active');
                  s.classList.remove('inactive');
                } else {
                  s.classList.remove('active');
                  s.classList.add('inactive');
                }
              });
            });

            star.addEventListener('mouseleave', function () {
              const currentRating = parseInt(customerRatingStars.dataset.rating) || 0;
              stars.forEach(function (s, index) {
                if (index < currentRating) {
                  s.classList.add('active');
                  s.classList.remove('inactive');
                } else {
                  s.classList.remove('active');
                  s.classList.add('inactive');
                }
              });
            });
          });
        }

        // Submit customer rating
        if (submitCustomerRating) {
          submitCustomerRating.addEventListener('click', function () {
            const rating = customerRatingStars.dataset.rating;
            const notes = customerRatingNotes.value;

            if (rating && rating > 0) {
              // Here you would typically send the data to your backend
              console.log('Customer Rating Submitted:', {
                rating: rating,
                notes: notes,
              });

              // Show success feedback
              this.textContent = 'تم الإرسال ✓';
              this.classList.remove('btn-primary');
              this.classList.add('btn-success');

              // Disable the form after submission
              customerRatingStars.style.pointerEvents = 'none';
              customerRatingNotes.disabled = true;
              this.disabled = true;

              // Reset button after 2 seconds
              setTimeout(() => {
                this.textContent = 'إرسال';
                this.classList.remove('btn-success');
                this.classList.add('btn-primary');
              }, 2000);
            }
          });
        }

        // ============================================================
        // خريطة موقع الاستلام/التسليم — Pin يعرض الموقع فقط (بدون سحب)
        // ويتحدث تلقائيًا حسب التبويب النشط (استلام / تسليم).
        // الإحداثيات الحقيقية لكل موقع لازم تيجي من الباك إند عن طريق
        // data-lat / data-lng على أزرار [data-bd2-delivery-tab].
        // ============================================================
        (function initBd2LocationMap() {
          var wrapper = document.getElementById('bd2MapWrapper');
          var mapEl = document.getElementById('bd2LocationMap');
          if (!wrapper || !mapEl || typeof L === 'undefined') return;

          var initialLat = parseFloat(wrapper.getAttribute('data-lat')) || 24.7136;
          var initialLng = parseFloat(wrapper.getAttribute('data-lng')) || 46.6753;

          var map = L.map(mapEl, { zoomControl: true }).setView([initialLat, initialLng], 14);

          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution:
              '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors"',
          }).addTo(map);

          var marker = L.marker([initialLat, initialLng]).addTo(map);

          function moveTo(lat, lng) {
            var latlng = [lat, lng];
            marker.setLatLng(latlng);
            map.setView(latlng, map.getZoom() < 13 ? 14 : map.getZoom());
            wrapper.setAttribute('data-lat', lat);
            wrapper.setAttribute('data-lng', lng);
          }

          // كل ما يتغير تبويب "الاستلام" / "التسليم" حدّثي مكان العلامة
          document.querySelectorAll('[data-bd2-delivery-tab]').forEach(function (btn) {
            btn.addEventListener('click', function () {
              var lat = parseFloat(this.getAttribute('data-lat'));
              var lng = parseFloat(this.getAttribute('data-lng'));
              if (!isNaN(lat) && !isNaN(lng)) {
                moveTo(lat, lng);
              }
            });
          });

          setTimeout(function () {
            map.invalidateSize();
          }, 200);

          window.addEventListener('resize', function () {
            map.invalidateSize();
          });
        })();

        // ============================================================
        // Extension Modal Validation
        // ============================================================
        var extensionModalEl = document.getElementById('extensionModal');
        var extensionModal = extensionModalEl ? new bootstrap.Modal(extensionModalEl) : null;
        var confirmExtendBtn = document.getElementById('confirmExtendBtn');

        if (extensionModalEl) {
          extensionModalEl.addEventListener('show.bs.modal', function (event) {
            var trigger = event.relatedTarget;
            window.ExtensionCalculator.reset({
              currentReturnDate: trigger?.dataset.currentReturnDate || '2026-08-01',
              dailyRate: trigger?.dataset.dailyRate || 203.26,
            });
          });
        }

        if (confirmExtendBtn) {
          confirmExtendBtn.addEventListener('click', function () {
            var extensionState = window.ExtensionCalculator.validate();
            if (!extensionState) return;

            var newReturnDate = extensionState.date;
            var bookingRef = document.getElementById('extendBookingRef').textContent;

            // Here you would typically send an API request to extend the booking
            document.getElementById('extensionConfirmMessage').textContent =
              'سيتم تمديد الحجز ' +
              bookingRef +
              ' لمدة ' +
              extensionState.days +
              ' أيام إلى تاريخ: ' +
              newReturnDate +
              ' بمبلغ إضافي: ' +
              extensionState.amount.toFixed(2) +
              ' ر.س - ' +
              extensionState.typeLabel +
              ' (طريقة الدفع: ' +
              extensionState.paymentLabel +
              ')' +
              (extensionState.type === 'cash'
                ? '. تم تحصيل المبلغ نقدًا وإضافته إلى فاتورة الحجز.'
                : '.');

            // Wait for the extension modal to fully finish closing before
            // showing the confirmation modal, so the two don't overlap.
            extensionModalEl.addEventListener(
              'hidden.bs.modal',
              function () {
                var extensionConfirmModalEl = document.getElementById('extensionConfirmModal');
                if (extensionConfirmModalEl) {
                  var extensionConfirmModal = new bootstrap.Modal(extensionConfirmModalEl);
                  extensionConfirmModal.show();
                }
              },
              { once: true },
            );

            // إغلاق المودال يدوياً فقط بعد نجاح الفاليديشن (تم اختيار التاريخ)
            if (extensionModal) {
              extensionModal.hide();
            }
          });
        }

        // ============================================================
        // Extension Show More Button
        // ============================================================
        var extensionShowMoreBtn = document.getElementById('extensionShowMoreBtn');
        var extensionDetails = document.getElementById('extensionDetails');

        if (extensionShowMoreBtn && extensionDetails) {
          extensionShowMoreBtn.addEventListener('click', function () {
            var isExpanded = extensionDetails.style.display !== 'none';

            if (isExpanded) {
              extensionDetails.style.display = 'none';
              extensionShowMoreBtn.classList.remove('is-active');
              extensionShowMoreBtn.querySelector('span').textContent = 'عرض أكثر';
            } else {
              extensionDetails.style.display = 'block';
              extensionShowMoreBtn.classList.add('is-active');
              extensionShowMoreBtn.querySelector('span').textContent = 'عرض أقل';
            }
          });
        }
      });
    </script>
@endpush

