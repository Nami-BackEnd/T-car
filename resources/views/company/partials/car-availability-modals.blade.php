{{--
  Availability + activity modals shared by every screen that lists cars, plus
  the script that drives them.

  The branch rows are rendered once by the server; the script only copies the
  clicked row's stock numbers into the inputs and points the form at the right
  car. Saving is a real PUT form post that redirects back to the list, so the
  modal needs no ajax of its own.

  Expects: $branches (the company's branches as ['id' => .., 'title' => ..]).
--}}
@push('modals')
    <div
      class="modal fade"
      id="carAvailabilityModal"
      tabindex="-1"
      aria-labelledby="carAvailabilityModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content availability-modal">
          <div class="availability-modal__header">
            <h5 class="availability-modal__header__title" id="carAvailabilityModalLabel">
              {{ __('company.common.352') }}</h5>
            <button
              type="button"
              class="availability-modal__header__close"
              data-bs-dismiss="modal"
               aria-label="{{ __('company.common.92') }}"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>

          <form method="POST" id="carAvailabilityForm" action="">
            @csrf
            @method('PUT')
            {{-- Remembers the screen the modal was opened from, so saving the
                 stock returns to that list. Matched against a fixed list in
                 CarController::returnUrl(), never used as a raw URL. --}}
            <input
              type="hidden"
              name="return"
              value="{{ request()->routeIs('company.license-plates') ? 'license-plates' : 'office-cars' }}"
            />
            {{-- Keeps the active branch filter on screen after saving, the
                 same way the list links carry it through. --}}
            @if (request('branch'))
              <input type="hidden" name="branch" value="{{ request('branch') }}" />
            @endif

            <div class="availability-modal__body">
              <div class="availability-summary">
                <div class="availability-car-chip">
                  <div class="availability-car-chip__thumb">
                    <img
                      id="availCarImage"
                      src="{{ asset('company/img/car.png') }}"
                      alt="{{ __('company.cars.car_image_alt') }}"
                    />
                  </div>
                  <div class="availability-car-chip__text">
                    <span class="availability-car-chip__name" id="availCarName">{{ __('company.cars.select_car') }}</span>
                    <span class="availability-car-chip__sub" id="availCarSub">{{ __('company.cars.per_branch_stock') }}</span>
                  </div>
                </div>
                <div class="availability-stat">
                  <span class="availability-stat__value" id="availTotalCount">0</span>
                  <span class="availability-stat__label">{{ __('company.cars.total') }}</span>
                </div>
              </div>

              <div class="table-responsive-custom">
                <table class="availability-table">
                  <thead>
                    <tr>
                      <th>{{ __('company.common.235') }}</th>
                      <th>{{ __('company.cars.stock') }}</th>
                    </tr>
                  </thead>
                  <tbody id="availabilityTableBody">
                    @forelse ($branches as $branch)
                      <tr>
                        <td class="cell-office-name">{{ $branch['title'] }}</td>
                        <td>
                          <input
                            type="number"
                            class="ltr-num"
                            min="0"
                            step="1"
                            name="stocks[{{ $branch['id'] }}]"
                            id="stock-{{ $branch['id'] }}"
                            value="0"
                          />
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="2">
                          <div class="empty-state">
                            <i class="bi bi-building empty-state__icon"></i>
                            <span>{{ __('company.cars.no_branches') }}</span>
                          </div>
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>

            <div class="availability-modal__footer">
              <button type="button" class="link-cancel" data-bs-dismiss="modal">{{ __('company.common.95') }}</button>
              <button type="submit" class="btn btn-primary" id="availSaveBtn">{{ __('company.common.375') }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="carLogsModal"
      tabindex="-1"
      aria-labelledby="carLogsModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content car-logs-modal">
          <div class="car-logs-modal__header">
            <h5 class="car-logs-modal__header__title" id="carLogsModalLabel">
              {{ __('company.cars.activity') }}</h5>
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
            <div class="table-responsive-custom">
              <table class="car-logs-table">
                <tbody>
                  <tr>
                    <td>
                      <div class="empty-state">
                        <i class="bi bi-clock-history empty-state__icon"></i>
                        <span>{{ __('company.cars.activity_empty') }}</span>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endpush

@push('scripts')
    <script>
      (function () {
        'use strict';

        document.addEventListener('DOMContentLoaded', function () {
          /* ---- Confirm destructive submits. Plain confirm(), then the browser
             performs a normal form POST — nothing is submitted by script. ---- */
          document.querySelectorAll('form[data-confirm]').forEach(function (form) {
            form.addEventListener('submit', function (event) {
              if (!window.confirm(this.getAttribute('data-confirm'))) {
                event.preventDefault();
              }
            });
          });

          /* ---- Car photo lightbox. Delegated so server-rendered and
             client-appended rows behave the same. ---- */
          var imageModal = document.getElementById('imageModal');
          var modalImage = document.getElementById('modalImage');
          var modalImageLabel = document.getElementById('imageModalLabel');

          document.addEventListener('click', function (event) {
            var trigger = event.target.closest('[data-car-photo]');

            if (!trigger || !imageModal) {
              return;
            }

            event.preventDefault();
            modalImage.src = trigger.getAttribute('data-car-photo');
            modalImage.alt = trigger.getAttribute('data-car-name') || '';
            modalImageLabel.textContent = trigger.getAttribute('data-car-name') || '';
            bootstrap.Modal.getOrCreateInstance(imageModal).show();
          });

          /* ---- Availability modal. Copies the clicked row's stock numbers into
             the inputs and points the form at the right car; Bootstrap opens it
             from the trigger's data-bs-target. ---- */
          var availabilityForm = document.getElementById('carAvailabilityForm');
          var availCarName = document.getElementById('availCarName');
          var availTotalCount = document.getElementById('availTotalCount');
          var availCarImage = document.getElementById('availCarImage');

          document.querySelectorAll('[data-action="availability"]').forEach(function (btn) {
            btn.addEventListener('click', function () {
              availabilityForm.action = this.getAttribute('data-update-url');
              availCarName.textContent = this.getAttribute('data-car-name');
              availTotalCount.textContent = this.getAttribute('data-car-total');

              var photo = this.getAttribute('data-car-image');
              if (availCarImage && photo) {
                availCarImage.src = photo;
              }

              var stocks = JSON.parse(this.getAttribute('data-car-stocks') || '{}');
              availabilityForm.querySelectorAll('input[name^="stocks["]').forEach(function (input) {
                var branchId = input.name.replace('stocks[', '').replace(']', '');
                input.value = Object.prototype.hasOwnProperty.call(stocks, branchId) ? stocks[branchId] : 0;
              });
            });
          });

          /* ---- Activity modal just names the car; there is no audit table yet. ---- */
          document.querySelectorAll('[data-action="logs"]').forEach(function (btn) {
            btn.addEventListener('click', function () {
              var label = document.getElementById('carLogsModalLabel');
              if (label) {
                label.textContent = this.getAttribute('data-car-name');
              }
            });
          });
        });
      })();
    </script>
@endpush
