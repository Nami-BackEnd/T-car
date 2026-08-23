<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PrivacyPolicyRequest;
use App\Services\Admin\PrivacyPolicyService;
use Illuminate\Http\RedirectResponse;

class PrivacyPolicyController extends Controller
{
    public function __construct(private readonly PrivacyPolicyService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.privacy-policy',
            'entity'    => __('admin.nav.privacy'),
            'icon'      => 'ti-shield-lock',
        ];
    }

    public function index()
    {
        $items = collect(['user', 'driver'])
            ->mapWithKeys(fn (string $type) => [$type => $this->service->getOrCreateByType($type)]);

        return view('admin.pages.content.index', ['config' => self::config(), 'items' => $items]);
    }

    public function update(PrivacyPolicyRequest $request): RedirectResponse
    {
        $this->service->updateSections($request->validated('sections'));

        return redirect()
            ->back()
            ->withInput()
            ->with('success', __('admin.messages.updated_success', ['entity' => self::config()['entity']]));
    }
}
