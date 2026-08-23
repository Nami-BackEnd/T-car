<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use App\Services\Admin\ContactUsService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly ContactUsService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.contact-us',
            'entity'    => __('admin.nav.contact_msgs'),
            'icon'      => 'ti-mail',
        ];
    }

    public function index(Request $request)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return $this->success($this->service->paginate($request));
        }

        return view('admin.pages.contact.index', ['config' => self::config()]);
    }

    public function show(ContactUs $contactUs): JsonResponse
    {
        return $this->success(['message' => $this->exposed($contactUs)]);
    }

    public function destroy(ContactUs $contactUs): JsonResponse
    {
        $this->service->destroy($contactUs);

        return $this->success(message: __('admin.messages.deleted_success', ['entity' => self::config()['entity']]));
    }

    private function exposed(ContactUs $contactUs): array
    {
        return [
            'id'           => $contactUs->id,
            'model'        => $contactUs->model,
            'model_id'     => $contactUs->model_id,
            'name'         => $contactUs->name,
            'email'        => $contactUs->email,
            'reason'       => $contactUs->reason,
            'order_number' => $contactUs->order_number,
            'message'      => $contactUs->message,
            'lang'         => $contactUs->lang,
            'created_at'   => $contactUs->created_at?->toISOString(),
        ];
    }
}
