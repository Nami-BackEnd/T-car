<?php

namespace App\Http\Controllers\Admin;

use App\Models\JoinUs;
use App\Services\Admin\JoinUsService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JoinUsController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly JoinUsService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.join-us',
            'entity'    => __('admin.nav.join_requests'),
            'icon'      => 'ti-inbox',
        ];
    }

    public function index(Request $request)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return $this->success($this->service->paginate($request));
        }

        return view('admin.pages.joins.index', ['config' => self::config()]);
    }

    public function show(JoinUs $join_us): JsonResponse
    {
        return $this->success(['message' => $this->exposed($join_us)]);
    }

    public function destroy(JoinUs $join_us): JsonResponse
    {
        $this->service->destroy($join_us);

        return $this->success(message: __('admin.messages.deleted_success', ['entity' => self::config()['entity']]));
    }

    private function exposed(JoinUs $joinUs): array
    {
        return [
            'id'           => $joinUs->id,
            'name'         => $joinUs->name,
            'phone'        => $joinUs->phone,
            'company_name' => $joinUs->company_name,
            'email'        => $joinUs->email,
            'size'         => $joinUs->size,
            'user_name'    => $joinUs->user?->name,
            'user_phone'   => $joinUs->user?->phone,
            'created_at'   => $joinUs->created_at?->toISOString(),
        ];
    }
}
