<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Resources\AboutUsResource;
use App\Http\Resources\FaqResource;
use App\Http\Resources\PrivacyPolicyResource;
use App\Http\Resources\TermResource;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\PrivacyPolicy;
use App\Models\Term;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DriverSettingController extends Controller
{
    public function settings(Request $request): JsonResponse
    {
        $locale=app()->getLocale();
        $theme = $request->header('theme', 'light');
        $theme = in_array($theme, ['dark', 'light']) ? $theme : 'light';
        $queryParams = http_build_query(['theme' => $theme, 'lang' => $locale]);

        return ApiResponse::success(
            data: [
                'terms_url'            => route('driver.web.terms'),
                'about_us_url'         => route('driver.web.about-us'),
                'privacy_policy_url'   => route('driver.web.privacy'),
            ],
            message: 'Settings retrieved successfully'
        );
    }
    public function faqs(Request $request): JsonResponse
    {
        $faqs = Faq::where('type', 'driver')->latest()->paginate($request->per_page ?? 10);

        return ApiResponse::success(
            data:FaqResource::collection($faqs),
            message: 'Faqs retrieved successfully'
        );
    }
}
