<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait ApiResponse
{
    public static function success(
        mixed $data = null,
        string $message = '',
        int $code = 200,
        int $line = 0,
    ): JsonResponse {
        $response = [];

        if ($data instanceof AnonymousResourceCollection) {
            $response['data'] = $data->collection;

            if ($data->resource instanceof LengthAwarePaginator) {
                $response['pagination'] = self::formatPagination($data->resource);
            }
        } elseif ($data instanceof LengthAwarePaginator) {
            $response['data'] = $data->items();
            $response['pagination'] = self::formatPagination($data);
        } elseif ($data instanceof Collection) {
            $response['data'] = $data->values();
        } elseif (is_array($data)) {
            $response['data'] = $data;
        } elseif ($data !== null) {
            $response['data'] = $data;
        } else {
            $response['data'] = null;
        }

        return response()->json(
            array_merge($response, [
                'message' => $message,
                'code'    => $code,
            ]),
            200
        );
    }

    public static function error(
        string $message = '',
        int $code = 400,
        array $errors = [],
        mixed $data = null
    ): JsonResponse {
        $response = [
            'data' => null,
        ];

        if (! empty($errors)) {
            $response['data']['errors'] = $errors;
        }

        if ($data !== null) {
            $response['data'] = array_merge($response['data'] ?? [], $data);
        }

        return response()->json(
            array_merge($response, [
                'message' => $message,
                'code'    => $code,
            ]),
            200
        );
    }

    public static function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return self::error($message, 401);
    }

    public static function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return self::error($message, 403);
    }

    public static function notFound(string $message = 'Not found'): JsonResponse
    {
        return self::error($message, 404);
    }

    public static function internalValidationError(string $message = 'Not found'): JsonResponse
    {
        return self::error($message, 422);
    }

    public static function packageValidationError(string $message = 'subscription expired'): JsonResponse
    {
        return self::error($message, 402);
    }

    public static function validationError(array $errors, string $message = 'Validation failed'): JsonResponse
    {
        return self::error($message, 422, $errors);
    }

    public static function serverError(string $message = 'Server error'): JsonResponse
    {
        return self::error($message, 500);
    }

    public static function tooManyRequests(string $message = 'Too many requests', int $retryAfter = 60): JsonResponse
    {
        return response()->json([
            'data' => [
                'retry_after' => $retryAfter,
            ],
            'message' => $message,
            'code'    => 429,
        ], 200)->header('Retry-After', $retryAfter);
    }

    private static function formatPagination(LengthAwarePaginator $paginator): array
    {
        return [
            'current_page' => $paginator->currentPage(),
            'last_page'    => $paginator->lastPage(),
            'per_page'     => $paginator->perPage(),
            'total'        => $paginator->total(),
            'from'         => $paginator->firstItem(),
            'to'           => $paginator->lastItem(),
        ];
    }
}
