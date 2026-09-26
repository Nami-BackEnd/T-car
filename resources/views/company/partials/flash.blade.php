@if (session('success') || session('error') || $errors->any())
  <div class="alert alert-{{ session('error') || $errors->any() ? 'danger' : 'success' }} alert-dismissible fade show"
       id="companyFlash"
       role="alert">
    @if (session('error'))
      {{ session('error') }}
    @elseif ($errors->any())
      <ul class="mb-0 ps-3">
        @foreach ($errors->all() as $message)
          <li>{{ $message }}</li>
        @endforeach
      </ul>
    @else
      {{ session('success') }}
    @endif
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('company.common.90') }}"></button>
  </div>
@endif

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const flash = document.getElementById('companyFlash');

      if (flash) {
        setTimeout(function () {
          bootstrap.Alert.getOrCreateInstance(flash).close();
        }, 6000);
      }
    });
  </script>
@endpush
