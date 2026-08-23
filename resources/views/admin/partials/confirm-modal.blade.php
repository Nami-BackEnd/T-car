{{-- Global confirmation modal --}}
<div class="modal fade" id="adminConfirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center p-6">
        <div class="icon-shape icon-xl bg-danger-subtle text-danger-emphasis rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
          <i class="ti ti-alert-triangle" style="font-size:28px"></i>
        </div>
        <h5 class="mb-2" id="adminConfirmTitle"></h5>
        <p class="text-secondary mb-0" id="adminConfirmText"></p>
      </div>
      <div class="modal-footer justify-content-center border-top-0 pt-0">
        <button type="button" class="btn btn-white" data-bs-dismiss="modal">{{ __('admin.content.cancel') }}</button>
        <button type="button" class="btn btn-danger d-inline-flex align-items-center gap-2" id="adminConfirmOkBtn">
          <i class="ti ti-trash"></i>
          <span>{{ __('admin.common.confirm_delete') }}</span>
        </button>
      </div>
    </div>
  </div>
</div>
