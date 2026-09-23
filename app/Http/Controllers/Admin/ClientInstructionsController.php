<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ClientInstructionsRequest;
use App\Services\Admin\ClientInstructionsService;
use Illuminate\Http\RedirectResponse;

class ClientInstructionsController extends Controller
{
    public function __construct(private readonly ClientInstructionsService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.client-instructions',
            'entity'    => __('admin.nav.client_instructions'),
            'icon'      => 'ti-notebook',
        ];
    }

    public function index()
    {
        return view('admin.pages.content.client-instructions', [
            'config' => self::config(),
            'item'   => $this->service->get(),
        ]);
    }

    public function update(ClientInstructionsRequest $request): RedirectResponse
    {
        $this->service->update($request->validated());

        return redirect()
            ->back()
            ->withInput()
            ->with('success', __('admin.messages.updated_success', ['entity' => self::config()['entity']]));
    }
}
