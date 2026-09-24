@extends('admin.layouts.master')

@php
  // Active tab: first tab containing validation errors wins, otherwise ?tab=, otherwise user.
  $errorTab = collect(['user', 'driver'])->first(fn (string $audience) => $errors->has("sections.{$audience}.*"));
  $activeTab = $errorTab ?? old('active_tab', request()->query('tab', 'user'));
  $activeTab = in_array($activeTab, ['user', 'driver']) ? $activeTab : 'user';
@endphp

@section('title', $config['entity'] . ' | ' . __('admin.panel_name'))

@section('content')
  <style>
    #contentForm .ck-editor__editable_inline {
      min-height: 300px;
    }
  </style>

  <form action="{{ route($config['routeBase'] . '.update') }}" method="POST" id="contentForm">
    @csrf
    @method('PUT')
    <input type="hidden" name="active_tab" value="{{ $activeTab }}">

    <div class="card card-lg">
      <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3 border-bottom">
        <h5 class="mb-0 d-flex align-items-center gap-2">
          <i class="ti {{ $config['icon'] }}"></i>
          <span>{{ $config['entity'] }}</span>
        </h5>

        <ul class="nav nav-pills-white nav-fill" id="audienceTabs" role="tablist">
          @foreach (['user', 'driver'] as $audience)
            <li class="nav-item" role="presentation">
              <button class="nav-link {{ $activeTab === $audience ? 'active' : '' }}" id="tab-{{ $audience }}-btn"
                data-bs-toggle="pill" data-bs-target="#tab-{{ $audience }}" type="button" role="tab"
                aria-controls="tab-{{ $audience }}" aria-selected="{{ $activeTab === $audience ? 'true' : 'false' }}">
                <span class="d-flex align-items-center gap-2 position-relative">
                  <span><i class="ti {{ $audience === 'user' ? 'ti-user' : 'ti-steering-wheel' }}"></i></span>
                  <span>{{ __('admin.content.audience_' . $audience) }}</span>
                  @if ($errors->has("sections.{$audience}.*"))
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger p-1">
                      <span class="visually-hidden">errors</span>
                    </span>
                  @endif
                </span>
              </button>
            </li>
          @endforeach
        </ul>
      </div>

      <div class="tab-content" id="audienceTabsContent">
        @foreach (['user', 'driver'] as $audience)
          @php
            $item = $items[$audience];
            $isActive = $activeTab === $audience;
          @endphp
          <div class="tab-pane fade {{ $isActive ? 'show active' : '' }}" id="tab-{{ $audience }}"
            role="tabpanel" aria-labelledby="tab-{{ $audience }}-btn">
            <div class="card-body d-flex flex-column gap-4">

              <div class="text-secondary small d-flex align-items-center gap-2">
                <i class="ti ti-info-circle"></i>
                <span>{{ __('admin.content.audience_hint_' . $audience) }}</span>
              </div>

              {{-- Titles --}}
              @if ($config['with_titles'] ?? true)
              <div class="row g-4">
                <div class="col-md-6">
                  <label class="form-label" for="{{ $audience }}TitleAr">{{ __('admin.content.field_title_ar') }}</label>
                  <input type="text" name="sections[{{ $audience }}][title_ar]" id="{{ $audience }}TitleAr" dir="rtl"
                    value="{{ old("sections.{$audience}.title_ar", $item->title_ar) }}"
                    class="form-control @error("sections.{$audience}.title_ar") is-invalid @enderror"
                    placeholder="{{ __('admin.content.placeholder_title_ar') }}">
                  @error("sections.{$audience}.title_ar")
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="{{ $audience }}TitleEn">{{ __('admin.content.field_title_en') }}</label>
                  <input type="text" name="sections[{{ $audience }}][title_en]" id="{{ $audience }}TitleEn" dir="ltr"
                    value="{{ old("sections.{$audience}.title_en", $item->title_en) }}"
                    class="form-control @error("sections.{$audience}.title_en") is-invalid @enderror"
                    placeholder="{{ __('admin.content.placeholder_title_en') }}">
                  @error("sections.{$audience}.title_en")
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              @endif

              {{-- Rich contents --}}
              <div class="row g-4">
                <div class="col-md-6">
                  <label class="form-label" for="{{ $audience }}ContentAr">{{ __('admin.content.field_content_ar') }}</label>
                  <textarea name="sections[{{ $audience }}][content_ar]" id="{{ $audience }}ContentAr" rows="10" dir="rtl"
                    data-ckeditor data-lang="ar"
                    class="form-control @error("sections.{$audience}.content_ar") is-invalid @enderror">{{ old("sections.{$audience}.content_ar", $item->content_ar) }}</textarea>
                  @error("sections.{$audience}.content_ar")
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="{{ $audience }}ContentEn">{{ __('admin.content.field_content_en') }}</label>
                  <textarea name="sections[{{ $audience }}][content_en]" id="{{ $audience }}ContentEn" rows="10" dir="ltr"
                    data-ckeditor data-lang="en"
                    class="form-control @error("sections.{$audience}.content_en") is-invalid @enderror">{{ old("sections.{$audience}.content_en", $item->content_en) }}</textarea>
                  @error("sections.{$audience}.content_en")
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
              </div>

            </div>
          </div>
        @endforeach
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

      // ---------- CKEditor ----------
      // Editors inside inactive tab panes are created lazily when their pane becomes visible.
      function createEditor(el) {
        if (el.dataset.editorReady) return;
        el.dataset.editorReady = '1';

        const contentLang = el.getAttribute('data-lang') || locale;

        ClassicEditor.create(el, {
          language: { ui: locale, content: contentLang },
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

      document.querySelectorAll('[data-ckeditor]').forEach((el) => {
        const pane = el.closest('.tab-pane');
        if (!pane || pane.classList.contains('active')) {
          createEditor(el);
        } else {
          pane.addEventListener('shown.bs.tab', () => createEditor(el), { once: true });
        }
      });

      document.querySelectorAll('#audienceTabs [data-bs-toggle="pill"]').forEach((tabBtn) => {
        tabBtn.addEventListener('shown.bs.tab', () => {
          const pane = document.querySelector(tabBtn.getAttribute('data-bs-target'));
          if (!pane) return;
          pane.querySelectorAll('[data-ckeditor]').forEach(createEditor);
          document.querySelector('input[name="active_tab"]').value =
            tabBtn.getAttribute('data-bs-target').replace('#tab-', '');
        });
      });

      // ---------- Submit ----------
      const form = document.getElementById('contentForm');
      const saveBtn = form.querySelector('[data-save-btn]');
      form.addEventListener('submit', function () {
        editors.forEach((editor) => editor.updateSourceElement());
        saveBtn.disabled = true;
      });
    });
  </script>
@endpush
