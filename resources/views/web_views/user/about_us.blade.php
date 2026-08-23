<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang) }}" dir="{{ $lang === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $about ? ($lang === 'ar' ? $about->title_ar : $about->title_en) : __('About Us') }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: {{ $theme === 'dark' ? '#121212' : '#f9f9f9' }};
            padding: 20px;
            display: flex;
            justify-content: center;
            transition: background-color 0.3s;
        }
        .container {
            width: 100%;
            max-width: 600px;
            padding: 30px;
            text-align: {{ $lang === 'ar' ? 'right' : 'left' }};
        }
        h1 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: {{ $theme === 'dark' ? '#e0e0e0' : '#111' }};
            padding-bottom: 10px;
            transition: color 0.3s;
        }
        p, .content {
            margin-bottom: 16px;
            color: {{ $theme === 'dark' ? '#b0b0b0' : '#444' }};
            line-height: 1.8;
            font-size: 1rem;
            transition: color 0.3s;
        }
    </style>
</head>
<body>
    <div class="container">
        @if ($about)
            <h1>{{ $lang === 'ar' ? $about->title_ar : $about->title_en }}</h1>
            <div class="content">
                {!! $lang === 'ar' ? $about->content_ar : $about->content_en !!}
            </div>
        @else
            <p>No data available</p>
        @endif
    </div>
</body>
</html>
