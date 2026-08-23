<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TermRequest;
use App\Services\Admin\TermService;
use Illuminate\Http\RedirectResponse;

class TermController extends Controller
{
    public function __construct(private readonly TermService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.terms',
            'entity'    => __('admin.nav.terms'),
            'icon'      => 'ti-file-text',
        ];
    }

    public function index()
    {
        $items = collect(['user', 'driver'])
            ->mapWithKeys(fn (string $type) => [$type => $this->service->getOrCreateByType($type)]);

        return view('admin.pages.content.index', ['config' => self::config(), 'items' => $items]);
    }

    public function update(TermRequest $request): RedirectResponse
    {
        $this->service->updateSections($request->validated('sections'));

        return redirect()
            ->back()
            ->withInput()
            ->with('success', __('admin.messages.updated_success', ['entity' => self::config()['entity']]));
    }
}
