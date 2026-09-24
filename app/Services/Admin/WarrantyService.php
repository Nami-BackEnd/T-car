<?php

namespace App\Services\Admin;

use App\Models\Warranty;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class WarrantyService extends Service
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        return Warranty::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->trim();

                $query->where(function ($inner) use ($search) {
                    $inner->where('title_ar', 'like', "%{$search}%")
                        ->orWhere('title_en', 'like', "%{$search}%")
                        ->orWhere('content_ar', 'like', "%{$search}%")
                        ->orWhere('content_en', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate($request->integer('per_page', 10))
            ->withQueryString();
    }

    public function store(array $data): Warranty
    {
        return Warranty::create($data);
    }

    public function update(array $data, Warranty $warranty): Warranty
    {
        $warranty->update($data);

        return $warranty;
    }

    public function destroy(Warranty $warranty): void
    {
        $warranty->delete();
    }
}
