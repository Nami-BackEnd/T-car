<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ClientInstructionRequest;
use App\Services\Admin\ClientInstructionService;
use Illuminate\Http\RedirectResponse;

class ClientInstructionController extends Controller
{
    public function __construct(private readonly ClientInstructionService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase'   => 'admin.client-instructions',
            'entity'      => __('admin.nav.client_instructions'),
            'icon'        => 'ti-clipboard-text',
            'with_titles' => false,
        ];
    }

    public function index()
    {
        $items = collect(['user', 'driver'])
            ->mapWithKeys(fn (string $type) => [$type => $this->service->getOrCreateByType($type)]);

        return view('admin.pages.content.index', ['config' => self::config(), 'items' => $items]);
    }

    public function update(ClientInstructionRequest $request): RedirectResponse
    {
        $this->service->updateSections($request->validated('sections'));

        return redirect()
            ->back()
            ->withInput()
            ->with('success', __('admin.messages.updated_success', ['entity' => self::config()['entity']]));
    }
}
