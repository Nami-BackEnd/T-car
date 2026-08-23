<?php

namespace App\Services\Admin;

use App\Models\ContactUs;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ContactUsService extends Service
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        return ContactUs::query()
            ->when(in_array($request->query('type'), ['user', 'driver'], true), fn ($query) => $query->where('model', $request->query('type')))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->trim();

                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%")
                        ->orWhere('order_number', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate($request->integer('per_page', 10))
            ->withQueryString();
    }

    public function destroy(ContactUs $contactUs): void
    {
        $contactUs->delete();
    }
}
