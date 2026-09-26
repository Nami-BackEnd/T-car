{{--
  Success modal, matching the one the rest of the company area already uses
  (see subscriptions / support / pending-reservations). Replaces the native
  window.alert() popup that used to fire after saving, which looked out of
  place and ignored the active locale.

  The body text is filled by the caller, because "car added" and "car updated"
  are different messages. A caller may also set data-success-redirect on the
  modal to navigate once it is dismissed.
--}}
@push('modals')
    <div
      class="modal fade"
      id="successModal"
      tabindex="-1"
      aria-hidden="true"
      aria-labelledby="successModalLabel"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center py-5">
            <div class="mb-4">
              <i class="bi bi-check-circle-fill text-success" style="font-size: 64px"></i>
            </div>
            <h4
              class="mb-3"
              id="successModalLabel"
              style="font-family: 'Alexandria', sans-serif; font-weight: 600"
            >
              {{ __('company.common.329') }}</h4>
            <p
              class="text-muted mb-4"
              id="successModalMessage"
              style="font-family: 'Alexandria', sans-serif"
            ></p>
            <button
              type="button"
              class="btn btn-primary m-auto"
              id="successModalConfirm"
              data-bs-dismiss="modal"
            >{{ __('company.common.374') }}</button>
          </div>
        </div>
      </div>
    </div>
@endpush

@push('scripts')
    <script>
      (function () {
        'use strict';

        /**
         * Shows the shared success modal and resolves once it is dismissed.
         * Waits for the dismissal before navigating, otherwise the redirect
         * would tear the modal down while it is still on screen.
         */
        window.showSuccessModal = function (message, redirectUrl) {
          var element = document.getElementById('successModal');

          if (!element || typeof bootstrap === 'undefined') {
            if (redirectUrl) {
              window.location.href = redirectUrl;
            }
            return;
          }

          var text = document.getElementById('successModalMessage');
          if (text) {
            text.textContent = message || '';
          }

          var dismissed = false;
          var go = function () {
            if (dismissed) {
              return;
            }
            dismissed = true;
            if (redirectUrl) {
              window.location.href = redirectUrl;
            }
          };

          element.addEventListener('hidden.bs.modal', go, { once: true });
          bootstrap.Modal.getOrCreateInstance(element).show();
        };
      })();
    </script>
@endpush
