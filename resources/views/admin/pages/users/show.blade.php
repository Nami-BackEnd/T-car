@extends('admin.layouts.master')

@section('title', __('admin.users.details_title') . ' - ' . $user->name . ' | ' . __('admin.panel_name'))

@php
    $initials = mb_strtoupper(mb_substr(trim($user->name ?? '?'), 0, 1));
    $typeBadgeClasses = [
        'topup'   => 'badge text-success-emphasis bg-success-subtle',
        'payment' => 'badge text-primary-emphasis bg-primary-subtle',
        'refund'  => 'badge text-warning-emphasis bg-warning-subtle',
    ];
    $statusBadgeClasses = [
        'pending' => 'badge text-warning-emphasis bg-warning-subtle',
        'success' => 'badge text-success-emphasis bg-success-subtle',
        'failed'  => 'badge text-danger-emphasis bg-danger-subtle',
    ];
@endphp

@section('content')
  <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
    <a href="{{ route('admin.users.index') }}" class="btn btn-white d-inline-flex align-items-center gap-1">
      <i class="ti ti-arrow-back-up"></i>
      <span>{{ __('admin.users.back_to_users') }}</span>
    </a>
  </div>

  <div class="row g-4">
    {{-- User details --}}
    <div class="col-xl-4">
      <div class="card card-lg h-100">
        <div class="card-body">
          <div class="text-center mb-4">
            <div class="avatar avatar-xl rounded-circle bg-primary-subtle text-primary-emphasis d-inline-flex align-items-center justify-content-center fw-semibold fs-2 mb-3">{{ $initials }}</div>
            <h5 class="mb-1">{{ $user->name }}</h5>
            <span class="text-secondary" dir="ltr">{{ $user->phone_code }} {{ $user->phone }}</span>
          </div>

          <div class="bg-gray-100 rounded-3 p-3 mb-3 d-flex justify-content-between align-items-center">
            <small class="text-secondary">{{ __('admin.users.field_balance') }}</small>
            <span class="fw-bold fs-5">{{ number_format((float) $user->balance, 2) }}</span>
          </div>

          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent px-0 d-flex justify-content-between gap-3">
              <span class="text-secondary">{{ __('admin.users.field_email') }}</span>
              <span class="text-break text-end">{{ $user->email ?? '—' }}</span>
            </li>
            <li class="list-group-item bg-transparent px-0 d-flex justify-content-between gap-3">
              <span class="text-secondary">{{ __('admin.users.field_birth_date') }}</span>
              <span>{{ $user->birth_date?->format('Y-m-d') ?? '—' }}</span>
            </li>
            <li class="list-group-item bg-transparent px-0 d-flex justify-content-between gap-3">
              <span class="text-secondary">{{ __('admin.users.field_lang') }}</span>
              <span>{{ $user->lang === 'ar' ? __('admin.users.lang_arabic') : ($user->lang === 'en' ? __('admin.users.lang_english') : '—') }}</span>
            </li>
            <li class="list-group-item bg-transparent px-0 d-flex justify-content-between gap-3">
              <span class="text-secondary">{{ __('admin.users.field_address') }}</span>
              <span class="text-break text-end">{{ $user->address_name ?? '—' }}</span>
            </li>
            <li class="list-group-item bg-transparent px-0 d-flex justify-content-between gap-3">
              <span class="text-secondary">{{ __('admin.users.table_joined') }}</span>
              <span>{{ $user->created_at?->format('Y-m-d') ?? '—' }}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>

    {{-- Wallet transactions --}}
    <div class="col-xl-8">
      <div class="card card-lg h-100">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3 border-bottom">
          <h5 class="mb-0 d-flex align-items-center gap-2">
            <i class="ti ti-wallet"></i>
            <span>{{ __('admin.users.wallet_title') }}</span>
          </h5>
          <span class="badge text-secondary-emphasis bg-secondary-subtle">{{ trans_choice('admin.users.transactions_count', $transactions->count(), ['count' => $transactions->count()]) }}</span>
        </div>

        <div class="table-responsive">
          <table class="table text-nowrap mb-0 table-centered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('admin.users.wallet_table_value') }}</th>
                <th>{{ __('admin.users.wallet_table_type') }}</th>
                <th>{{ __('admin.users.wallet_table_status') }}</th>
                <th>{{ __('admin.users.wallet_table_order') }}</th>
                <th>{{ __('admin.users.wallet_table_date') }}</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($transactions as $transaction)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td class="fw-semibold">{{ number_format((float) $transaction->value, 2) }}</td>
                  <td><span class="{{ $typeBadgeClasses[$transaction->type->value] ?? 'badge text-secondary-emphasis bg-secondary-subtle' }}">{{ __('admin.users.type_' . $transaction->type->value) }}</span></td>
                  <td><span class="{{ $statusBadgeClasses[$transaction->status] ?? 'badge text-secondary-emphasis bg-secondary-subtle' }}">{{ __('admin.users.status_' . $transaction->status) }}</span></td>
                  <td class="text-secondary">{{ $transaction->order_id ?? '—' }}</td>
                  <td>{{ $transaction->created_at?->format('Y-m-d') ?? '—' }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-secondary py-5">
                    <i class="ti ti-wallet" style="font-size:32px"></i>
                    <p class="mb-0 mt-2">{{ __('admin.users.wallet_empty') }}</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @include('admin.partials.flash')
@endsection
