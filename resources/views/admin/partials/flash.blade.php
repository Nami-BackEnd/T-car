@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const successMessage = @json(session('success'));
      const errorMessage = @json(session('error'));

      if (!window.adminToast) return;
      if (successMessage) window.adminToast(successMessage, 'success');
      else if (errorMessage) window.adminToast(errorMessage, 'danger');
    });
  </script>
@endpush
