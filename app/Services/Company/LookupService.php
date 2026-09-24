<?php

namespace App\Services\Company;

use App\Models\City;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LookupService
{
    public function paginate(Request $request, array $config): LengthAwarePaginator
    {
        /** @var class-string<Model> $model */
        $model = $config['model'];

        $query = $model::query();

        if (! empty($config['with'])) {
            $query->with($config['with']);
        }

        $searchFields = $config['searchFields'] ?? [];

        $query
            ->when($request->filled('search') && $searchFields !== [], function ($query) use ($request, $searchFields) {
                $search = $request->string('search')->trim();

                $query->where(function ($inner) use ($search, $searchFields) {
                    foreach ($searchFields as $field) {
                        $inner->orWhere($field, 'like', "%{$search}%");
                    }
                });
            })
            ->orderByDesc('id');

        return $query
            ->paginate($request->integer('per_page', 10))
            ->withQueryString();
    }

    public function store(array $data, string $modelClass): Model
    {
        return $modelClass::create($data);
    }

    public function update(array $data, Model $row): Model
    {
        $row->update($data);

        return $row->fresh();
    }

    public function destroy(Model $row): void
    {
        $row->delete();
    }

    public function cityOptions(): Collection
    {
        $isArabic = app()->getLocale() === 'ar';

        return City::query()
            ->orderByDesc('id')
            ->get()
            ->mapWithKeys(fn (City $city) => [
                $city->id => $isArabic ? $city->title_ar : $city->title_en,
            ]);
    }
}
