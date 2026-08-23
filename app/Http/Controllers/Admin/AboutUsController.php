<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AboutUsRequest;
use App\Services\Admin\AboutUsService;
use Illuminate\Http\RedirectResponse;

class AboutUsController extends Controller
{
    public function __construct(private readonly AboutUsService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.about-us',
            'entity'    => __('admin.nav.about_us'),
            'icon'      => 'ti-info-circle',
        ];
    }

    public function index()
    {
        $items = collect(['user', 'driver'])
            ->mapWithKeys(fn (string $type) => [$type => $this->service->getOrCreateByType($type)]);

        return view('admin.pages.content.index', ['config' => self::config(), 'items' => $items]);
    }

    public function update(AboutUsRequest $request): RedirectResponse
    {
        $this->service->updateSections($request->validated('sections'));

        return redirect()
            ->back()
            ->withInput()
            ->with('success', __('admin.messages.updated_success', ['entity' => self::config()['entity']]));
    }
}
