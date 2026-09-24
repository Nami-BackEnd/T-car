<?php

namespace App\Services\Admin;

use App\Models\JoinUs;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class JoinUsService extends Service
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        return JoinUs::query()
            ->with('user:id,name,phone')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->trim();

                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('company_name', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate($request->integer('per_page', 10))
            ->withQueryString();
    }

    public function destroy(JoinUs $joinUs): void
    {
        $joinUs->delete();
    }
}
