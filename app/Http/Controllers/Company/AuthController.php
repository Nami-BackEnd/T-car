<?php

namespace App\Http\Controllers\Company;

use App\Http\Middleware\SetCompanyLocale;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponse;

    public function showLoginForm()
    {
        return view('company.auth.login');
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [], [
            'email'    => __('company.validation.email'),
            'password' => __('company.validation.password'),
        ]);

        $throttleKey = strtolower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return $this->error(
                __('company.messages.throttled', ['seconds' => $seconds]),
                429
            );
        }

        $remember = $request->boolean('remember');

        if (! Auth::guard('company')->attempt($request->only('email', 'password'), $remember)) {
            RateLimiter::hit($throttleKey);

            return $this->error(__('company.messages.invalid_credentials'), 422);
        }

        RateLimiter::clear($throttleKey);

        $request->session()->regenerate();

        return $this->success([
            'redirect' => redirect()->intended(route('company.dashboard'))->getTargetUrl(),
        ], __('company.messages.login_success'));
    }

    public function logout(Request $request): JsonResponse|RedirectResponse
    {
        Auth::guard('company')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return $this->success([
                'redirect' => route('company.login'),
            ], __('company.messages.logout_success'));
        }

        return redirect()->route('company.login');
    }

    public function switchLang(Request $request): JsonResponse
    {
        $request->validate([
            'locale' => ['required', 'in:ar,en'],
        ]);

        $request->session()->put(SetCompanyLocale::SESSION_KEY, $request->input('locale'));

        return $this->success([
            'locale'   => $request->input('locale'),
            'redirect' => url()->previous() ?: route('company.dashboard'),
        ], __('company.messages.lang_switched'));
    }
}