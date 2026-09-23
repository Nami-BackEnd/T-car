<?php

use App\Http\Middleware\SetAdminLocale;
use App\Http\Middleware\SetCompanyLocale;
use App\Http\Middleware\SetLocale;
use App\Traits\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: [
            __DIR__ . '/../routes/api.php',
            __DIR__ . '/../routes/api/user.php',
            __DIR__ . '/../routes/api/driver.php',
            __DIR__ . '/../routes/api/company.php',
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function (): void {
            Route::middleware('web')
                ->group(base_path('routes/admin/web.php'));

            Route::middleware('web')
                ->group(base_path('routes/company/web.php'));

            Route::middleware('api')
                ->group(base_path('routes/api/user.php'));

            Route::middleware('api')
                ->group(base_path('routes/api/driver.php'));

            Route::middleware('api')
                ->group(base_path('routes/api/company.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            SetLocale::class,
        ]);

        $middleware->alias([
            'admin.locale' => SetAdminLocale::class,
            'company.locale' => SetCompanyLocale::class,
        ]);

        // Guests hitting auth-protected web routes go to the admin login page.
        $middleware->redirectGuestsTo(
            fn (Request $request) => $request->expectsJson()
                ? null
                : (str_starts_with($request->path(), 'company')
                    ? route('company.login')
                    : route('admin.login'))
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (
            AuthenticationException $e,
            Request $request
        ) {
            if ($request->expectsJson()) {
                return ApiResponse::unauthorized();
            }
        });

        $exceptions->shouldRenderJsonWhen(
            fn(Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
        $exceptions->render(function (ValidationException $e, Request $request) {

            if ($request->is('api/*')) {
                return response()->json([
                    'data' => null,
                    'message' => $e->getMessage(),
                    'code' => 422,
                ], 422);
            }
        });
    })->create();
