<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('user.payment_failed') }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f4f6f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .card { background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.1); padding: 40px; width: 100%; max-width: 420px; text-align: center; }
        .icon { font-size: 64px; margin-bottom: 16px; }
        .card h2 { color: #ef4444; margin-bottom: 8px; }
        .card p { color: #888; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">&#10007;</div>
        <h2>{{ __('user.payment_failed') }}</h2>
        <p>{{ __('user.payment_fail_message') }}</p>
    </div>
</body>
</html>
