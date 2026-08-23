<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AlrtRequest;
use App\Models\Alrt;
use App\Services\Admin\AlrtService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlrtController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly AlrtService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.alrts',
            'entity'    => __('admin.nav.alerts'),
            'icon'      => 'ti-bell',
        ];
    }

    public function index(Request $request)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return $this->success($this->service->paginate($request));
        }

        return view('admin.pages.alrts.index', ['config' => self::config()]);
    }

    public function store(AlrtRequest $request): JsonResponse
    {
        $alrt = $this->service->store($request->validated());

        return $this->success(
            ['alrt' => $this->exposed($alrt)],
            __('admin.messages.created_success', ['entity' => self::config()['entity']])
        );
    }

    public function update(AlrtRequest $request, Alrt $alrt): JsonResponse
    {
        $alrt = $this->service->update($request->validated(), $alrt);

        return $this->success(
            ['alrt' => $this->exposed($alrt)],
            __('admin.messages.updated_success', ['entity' => self::config()['entity']])
        );
    }

    public function destroy(Alrt $alrt): JsonResponse
    {
        $this->service->destroy($alrt);

        return $this->success(message: __('admin.messages.deleted_success', ['entity' => self::config()['entity']]));
    }

    private function exposed(Alrt $alrt): array
    {
        return [
            'id'         => $alrt->id,
            'title_ar'   => $alrt->title_ar,
            'title_en'   => $alrt->title_en,
            'created_at' => $alrt->created_at?->toISOString(),
        ];
    }
}
