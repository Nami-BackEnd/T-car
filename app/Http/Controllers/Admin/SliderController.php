<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;
use App\Services\Admin\SliderService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly SliderService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.sliders',
            'entity'    => __('admin.nav.sliders'),
            'icon'      => 'ti-carousel-horizontal',
        ];
    }

    public function index(Request $request)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return $this->success($this->service->paginate($request));
        }

        return view('admin.pages.sliders.index', ['config' => self::config()]);
    }

    public function store(SliderRequest $request): JsonResponse
    {
        $slider = $this->service->store($request->validated());

        return $this->success(
            ['slider' => $this->exposed($slider)],
            __('admin.messages.created_success', ['entity' => self::config()['entity']])
        );
    }

    public function update(SliderRequest $request, Slider $slider): JsonResponse
    {
        $slider = $this->service->update($request->validated(), $slider);

        return $this->success(
            ['slider' => $this->exposed($slider)],
            __('admin.messages.updated_success', ['entity' => self::config()['entity']])
        );
    }

    public function destroy(Slider $slider): JsonResponse
    {
        $this->service->destroy($slider);

        return $this->success(message: __('admin.messages.deleted_success', ['entity' => self::config()['entity']]));
    }

    private function exposed(Slider $slider): array
    {
        return [
            'id'         => $slider->id,
            'image'      => $slider->image,
            'image_url'  => $slider->image_url,
            'order'      => $slider->order,
            'created_at' => $slider->created_at?->toISOString(),
        ];
    }
}
