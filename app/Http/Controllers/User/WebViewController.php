<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\PrivacyPolicy;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WebViewController extends Controller
{
    private function getTheme(Request $request): string
    {
        $theme = $request->header('theme', 'light');

        return in_array($theme, ['dark', 'light']) ? $theme : 'light';
    }

    private function getLang(Request $request): string
    {
        return $request->header('Accept-Language', $request->getLocale());
    }

    public function faqs(Request $request): View
    {
        $faqs = Faq::where('type', 'user')->latest()->get();
        $theme = $this->getTheme($request);
        $lang = $this->getLang($request);

        return view('web_views.user.faqs', compact('faqs', 'theme', 'lang'));
    }

    public function terms(Request $request): View
    {
        $terms = Term::where('type', 'user')->latest()->get();
        $theme = $this->getTheme($request);
        $lang = $this->getLang($request);

        return view('web_views.user.terms', compact('terms', 'theme', 'lang'));
    }

    public function aboutUs(Request $request): View
    {
        $about = AboutUs::where('type', 'user')->first();
        $theme = $this->getTheme($request);
        $lang = $this->getLang($request);

        return view('web_views.user.about_us', compact('about', 'theme', 'lang'));
    }

    public function privacyPolicy(Request $request): View
    {
        $policies = PrivacyPolicy::where('type', 'user')->latest()->get();
        $theme = $this->getTheme($request);
        $lang = $this->getLang($request);

        return view('web_views.user.privacy', compact('policies', 'theme', 'lang'));
    }
}
