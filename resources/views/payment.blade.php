<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('user.payment') }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f4f6f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); padding: 40px; width: 100%; max-width: 420px; text-align: center; }
        .card h2 { margin-bottom: 8px; color: #333; }
        .card .subtitle { color: #888; margin-bottom: 24px; font-size: 14px; }
        .detail { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #eee; }
        .detail span:first-child { color: #888; }
        .detail span:last-child { color: #333; font-weight: 600; }
        .actions { margin-top: 32px; display: flex; gap: 12px; }
        .btn { flex: 1; padding: 14px; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; text-decoration: none; text-align: center; transition: opacity 0.2s; }
        .btn:hover { opacity: 0.85; }
        .btn-success { background: #22c55e; color: #fff; }
        .btn-fail { background: #ef4444; color: #fff; }
    </style>
</head>
<body>
    <div class="card">
        <h2>{{ __('user.payment_simulation') }}</h2>
        <p class="subtitle">{{ __('user.simulate_payment_action') }}</p>

        <div class="detail">
            <span>{{ __('user.transaction_id') }}</span>
            <span>#{{ $transaction->id }}</span>
        </div>
        <div class="detail">
            <span>{{ __('user.amount') }}</span>
            <span>{{ number_format($transaction->value, 2) }}</span>
        </div>
        <div class="detail">
            <span>{{ __('user.type') }}</span>
            <span>{{ $transaction->type->value }}</span>
        </div>

        <div class="actions">
            <a href="{{ route('success.wallet', $transaction->id) }}" class="btn btn-success">{{ __('user.pay_now') }}</a>
            <a href="{{ route('fail.wallet', $transaction->id) }}" class="btn btn-fail">{{ __('user.cancel') }}</a>
        </div>
    </div>
</body>
</html>
