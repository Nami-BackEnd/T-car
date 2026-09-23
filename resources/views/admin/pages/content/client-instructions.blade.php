@extends('admin.layouts.master')

@section('title', $config['entity'] . ' | ' . __('admin.panel_name'))

@section('content')
  <style>
    #clientInstructionsForm .ck-editor__editable_inline {
      min-height: 300px;
    }
  </style>

  <form action="{{ route($config['routeBase'] . '.update') }}" method="POST" id="clientInstructionsForm">
    @csrf
    @method('PUT')

    <div class="card card-lg">
      <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3 border-bottom">
        <h5 class="mb-0 d-flex align-items-center gap-2">
          <i class="ti {{ $config['icon'] }}"></i>
          <span>{{ $config['entity'] }}</span>
        </h5>
      </div>

      <div class="card-body d-flex flex-column gap-4">
        <div class="row g-4">
          <div class="col-md-6">
            <label class="form-label" for="contentAr">{{ __('admin.content.field_content_ar') }}</label>
            <textarea name="content_ar" id="contentAr" rows="10" dir="rtl"
              data-ckeditor data-lang="ar"
              class="form-control @error('content_ar') is-invalid @enderror">{{ old('content_ar', $item->content_ar) }}</textarea>
            @error('content_ar')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-6">
            <label class="form-label" for="contentEn">{{ __('admin.content.field_content_en') }}</label>
            <textarea name="content_en" id="contentEn" rows="10" dir="ltr"
              data-ckeditor data-lang="en"
              class="form-control @error('content_en') is-invalid @enderror">{{ old('content_en', $item->content_en) }}</textarea>
            @error('content_en')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <div class="card-footer bg-transparent border-top d-flex flex-wrap justify-content-end gap-2 py-4">
        <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2" data-save-btn>
          <i class="ti ti-device-floppy"></i>
          <span>{{ __('admin.content.save') }}</span>
        </button>
      </div>
    </div>
  </form>

  @include('admin.partials.flash')
@endsection

@push('scripts')
  <script src="{{ asset('admin/libs/ckeditor5/ckeditor.js') }}"></script>
  @if (app()->getLocale() === 'ar')
    <script src="{{ asset('admin/libs/ckeditor5/translations/ar.js') }}"></script>
  @endif
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const editors = [];
      const locale = document.body.getAttribute('data-locale') || 'en';

      function createEditor(el) {
        if (el.dataset.editorReady) return;
        el.dataset.editorReady = '1';

        ClassicEditor.create(el, {
          language: { ui: locale, content: el.getAttribute('data-lang') || locale },
          heading: {
            options: [
              { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
              { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
              { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
              { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
            ],
          },
          toolbar: {
            items: [
              'heading', '|', 'bold', 'italic', 'underline', '|',
              'link', 'bulletedList', 'numberedList', '|',
              'insertTable', 'blockQuote', 'undo', 'redo',
            ],
          },
          table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
          },
        })
          .then((editor) => {
            editors.push(editor);
            el.classList.remove('is-invalid');
          })
          .catch((error) => console.error(error));
      }

      document.querySelectorAll('[data-ckeditor]').forEach(createEditor);

      const form = document.getElementById('clientInstructionsForm');
      const saveBtn = form.querySelector('[data-save-btn]');
      form.addEventListener('submit', function () {
        editors.forEach((editor) => editor.updateSourceElement());
        saveBtn.disabled = true;
      });
    });
  </script>
@endpush
