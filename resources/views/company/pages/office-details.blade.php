@extends('company.layouts.master')

@section('title', 'T-Car — تفاصيل الفرع')

@section('content')

          <div class="page-header">
            <div>
              <h1 class="page-header__title">{{ __('company.common.467') }}</h1>
              <nav class="page-header__breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('company.dashboard') }}">{{ __('company.common.176') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span>{{ __('company.common.220') }}</span>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('company.branches') }}">{{ __('company.common.220') }}</a>
                <i class="bi bi-chevron-right"></i>
                <span class="current">{{ __('company.common.316') }}</span>
              </nav>
            </div>
          </div>

          
          <div class="row g-4">
            
            <div class="col-lg-12">
              <div class="office-details-card">
                <div class="office-details-card__header">
                  <h5 class="office-details-card__title">
                    <i class="bi bi-building"></i>
                    {{ __('company.common.316') }}</h5>
                </div>
                <div class="office-details-card__body">
                  <div class="office-info-grid">
                    <div class="detail-field">
                      <label class="detail-field__label">{{ __('company.pages.office-details.0') }}</label>
                      <input
                        type="text"
                        class="detail-field__input"
                        value="N2 فرع العقيق"
                        readonly
                      />
                    </div>
                    <div class="detail-field">
                      <label class="detail-field__label">{{ __('company.common.137') }}</label>
                      <input
                        type="text"
                        class="detail-field__input"
                        value="N2 فرع العقيق"
                        readonly
                      />
                    </div>
                    <div class="detail-field">
                      <label class="detail-field__label">{{ __('company.common.149') }}</label>
                      <input
                        type="text"
                        class="detail-field__input"
                        value="Fares Al-Hattar"
                        readonly
                      />
                    </div>
                    <div class="detail-field">
                      <label class="detail-field__label">{{ __('company.pages.office-details.1') }}</label>
                      <input
                        type="text"
                        class="detail-field__input ltr-num"
                        value="0553807746"
                        readonly
                      />
                    </div>
                    <div class="detail-field">
                      <label class="detail-field__label">{{ __('company.common.181') }}</label>
                      <input
                        type="text"
                        class="detail-field__input ltr-num"
                        value="0553807746"
                        readonly
                      />
                    </div>
                    <div class="detail-field">
                      <label class="detail-field__label">{{ __('company.common.229') }}</label>
                      <input type="text" class="detail-field__input" value="الرياض" readonly />
                    </div>
                    <div class="detail-field" style="grid-column: 1 / -1">
                      <label class="detail-field__label">{{ __('company.common.217') }}</label>
                      <input
                        type="text"
                        class="detail-field__input"
                        value="طريق الإمام سعود بن فيصل العقيق الرياض 13515، السعودية"
                        readonly
                      />
                    </div>
                    <div class="detail-field">
                      <label class="detail-field__label">{{ __('company.pages.office-details.2') }}</label>
                      <select class="detail-field__select" disabled>
                        <option value="sa" selected>sa</option>
                      </select>
                    </div>
                    <div class="detail-field">
                      <label class="detail-field__label">{{ __('company.pages.office-details.3') }}</label>
                      <input
                        type="text"
                        class="detail-field__input ltr-num"
                        value="2384652395793"
                        readonly
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            
          </div>
@endsection

@push('modals')
</main>
        
      

    
@endpush

