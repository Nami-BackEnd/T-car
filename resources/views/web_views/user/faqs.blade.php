<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang) }}" dir="{{ $lang === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('FAQs') }}</title>
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
        .faq-item {
            margin-bottom: 20px;
            padding: 16px;
            background-color: {{ $theme === 'dark' ? '#1e1e1e' : '#fff' }};
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .faq-question {
            font-weight: bold;
            color: {{ $theme === 'dark' ? '#e0e0e0' : '#111' }};
            margin-bottom: 8px;
            font-size: 1rem;
        }
        .faq-answer {
            color: {{ $theme === 'dark' ? '#b0b0b0' : '#444' }};
            line-height: 1.8;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $lang === 'ar' ? 'الأسئلة الشائعة' : 'FAQs' }}</h1>
        @forelse ($faqs as $faq)
            <div class="faq-item">
                <div class="faq-question">{{ $lang === 'ar' ? $faq->question_ar : $faq->question_en }}</div>
                <div class="faq-answer">{!! $lang === 'ar' ? $faq->answer_ar : $faq->answer_en !!}</div>
            </div>
        @empty
            <p style="color: {{ $theme === 'dark' ? '#b0b0b0' : '#444' }};">No data available</p>
        @endforelse
    </div>
</body>
</html>
