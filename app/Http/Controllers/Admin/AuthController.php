<?php

namespace App\Http\Controllers\Admin;

use App\Http\Middleware\SetAdminLocale;
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
        return view('admin.auth.login');
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [], [
            'email'    => __('admin.validation.email'),
            'password' => __('admin.validation.password'),
        ]);

        $throttleKey = strtolower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return $this->error(
                __('admin.messages.throttled', ['seconds' => $seconds]),
                429
            );
        }

        $remember = $request->boolean('remember');

        if (! Auth::guard('admin')->attempt($request->only('email', 'password'), $remember)) {
            RateLimiter::hit($throttleKey);

            return $this->error(__('admin.messages.invalid_credentials'), 422);
        }

        RateLimiter::clear($throttleKey);

        $request->session()->regenerate();

        return $this->success([
            'redirect' => redirect()->intended(route('admin.dashboard'))->getTargetUrl(),
        ], __('admin.messages.login_success'));
    }

    public function logout(Request $request): JsonResponse|RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return $this->success([
                'redirect' => route('admin.login'),
            ], __('admin.messages.logout_success'));
        }

        return redirect()->route('admin.login');
    }

    public function switchLang(Request $request): JsonResponse
    {
        $request->validate([
            'locale' => ['required', 'in:ar,en'],
        ]);

        $request->session()->put(SetAdminLocale::SESSION_KEY, $request->input('locale'));

        return $this->success([
            'locale'   => $request->input('locale'),
            'redirect' => url()->previous() ?: route('admin.dashboard'),
        ], __('admin.messages.lang_switched'));
    }
}
