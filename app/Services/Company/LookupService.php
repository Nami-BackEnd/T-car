<?php

namespace App\Services\Company;

use App\Models\City;
use App\Models\Country;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use InvalidArgumentException;

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

    public function countryOptions(): Collection
    {
        $isArabic = app()->getLocale() === 'ar';

        return Country::query()
            ->ordered()
            ->get()
            ->mapWithKeys(fn (Country $country) => [
                $country->id => $isArabic ? $country->title_ar : $country->title_en,
            ]);
    }

    /**
     * Dropdown sources keyed by the `options` value declared on a lookup field.
     *
     * @return array<string, Collection<int, string>>
     */
    public function optionsForFields(array $fields): array
    {
        $sources = array_values(array_unique(array_filter(array_column($fields, 'options'))));

        $options = [];

        foreach ($sources as $source) {
            $options[$source] = match ($source) {
                'cities' => $this->cityOptions(),
                'countries' => $this->countryOptions(),
                default => throw new InvalidArgumentException("Unknown lookup options source [{$source}]."),
            };
        }

        return $options;
    }
}
