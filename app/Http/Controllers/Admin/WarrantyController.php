<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\WarrantyRequest;
use App\Models\Warranty;
use App\Services\Admin\WarrantyService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly WarrantyService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.warranties',
            'entity'    => __('admin.nav.warranty'),
            'icon'      => 'ti-shield-check',
        ];
    }

    public function index(Request $request)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return $this->success($this->service->paginate($request));
        }

        return view('admin.pages.warranties.index', ['config' => self::config()]);
    }

    public function store(WarrantyRequest $request): JsonResponse
    {
        $warranty = $this->service->store($request->validated());

        return $this->success(
            ['warranty' => $this->exposed($warranty)],
            __('admin.messages.created_success', ['entity' => self::config()['entity']])
        );
    }

    public function update(WarrantyRequest $request, Warranty $warranty): JsonResponse
    {
        $warranty = $this->service->update($request->validated(), $warranty);

        return $this->success(
            ['warranty' => $this->exposed($warranty)],
            __('admin.messages.updated_success', ['entity' => self::config()['entity']])
        );
    }

    public function destroy(Warranty $warranty): JsonResponse
    {
        $this->service->destroy($warranty);

        return $this->success(message: __('admin.messages.deleted_success', ['entity' => self::config()['entity']]));
    }

    private function exposed(Warranty $warranty): array
    {
        return [
            'id'          => $warranty->id,
            'title_ar'    => $warranty->title_ar,
            'title_en'    => $warranty->title_en,
            'content_ar'  => $warranty->content_ar,
            'content_en'  => $warranty->content_en,
            'created_at'  => $warranty->created_at?->toISOString(),
        ];
    }
}
