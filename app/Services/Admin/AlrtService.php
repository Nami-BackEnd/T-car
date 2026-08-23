<?php

namespace App\Services\Admin;

use App\Models\Alrt;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AlrtService extends Service
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        return Alrt::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->trim();

                $query->where(function ($inner) use ($search) {
                    $inner->where('title_ar', 'like', "%{$search}%")
                        ->orWhere('title_en', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate($request->integer('per_page', 10))
            ->withQueryString();
    }

    public function store(array $data): Alrt
    {
        return Alrt::create($data);
    }

    public function update(array $data, Alrt $alrt): Alrt
    {
        $alrt->update($data);

        return $alrt;
    }

    public function destroy(Alrt $alrt): void
    {
        $alrt->delete();
    }
}
