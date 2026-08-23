<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;
use App\Services\Admin\FaqService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly FaqService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.faqs',
            'entity'    => __('admin.nav.faqs'),
            'icon'      => 'ti-help-circle',
        ];
    }

    public function index(Request $request)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return $this->success($this->service->paginate($request));
        }

        return view('admin.pages.faqs.index', ['config' => self::config()]);
    }

    public function store(FaqRequest $request): JsonResponse
    {
        $faq = $this->service->store($request->validated());

        return $this->success(
            ['faq' => $this->exposed($faq)],
            __('admin.messages.created_success', ['entity' => self::config()['entity']])
        );
    }

    public function update(FaqRequest $request, Faq $faq): JsonResponse
    {
        $faq = $this->service->update($request->validated(), $faq);

        return $this->success(
            ['faq' => $this->exposed($faq)],
            __('admin.messages.updated_success', ['entity' => self::config()['entity']])
        );
    }

    public function destroy(Faq $faq): JsonResponse
    {
        $this->service->destroy($faq);

        return $this->success(message: __('admin.messages.deleted_success', ['entity' => self::config()['entity']]));
    }

    private function exposed(Faq $faq): array
    {
        return [
            'id'          => $faq->id,
            'type'        => $faq->type,
            'question_ar' => $faq->question_ar,
            'question_en' => $faq->question_en,
            'answer_ar'   => $faq->answer_ar,
            'answer_en'   => $faq->answer_en,
            'created_at'  => $faq->created_at?->toISOString(),
        ];
    }
}
