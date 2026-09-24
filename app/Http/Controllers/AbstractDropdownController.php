<?php

namespace App\Http\Controllers;

use App\Models\Vacation;
use App\Services\Company\LookupService;
use App\Support\LookupEntities;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class AbstractDropdownController extends Controller
{
    use ApiResponse;

    protected string $panel;

    protected string $routeBase;

    protected string $viewName;

    public function __construct(protected readonly LookupService $service) {}

    public function index(Request $request, string $entity)
    {
        $config = LookupEntities::resolve($entity);

        $this->authorizeLookup($config);

        if ($request->expectsJson() || $request->ajax()) {
            $paginator = $this->service->paginate($request, $config);
            $paginator->getCollection()->transform(fn (Model $row) => $this->expose($row, $config));

            return $this->success($paginator);
        }

        return view($this->viewName, [
            'config' => $this->viewConfig($entity, $config),
            'cityOptions' => $this->service->cityOptions(),
        ]);
    }

    public function store(Request $request, string $entity): JsonResponse
    {
        $config = LookupEntities::resolve($entity);

        $this->authorizeLookup($config);

        $fields = $config['fields'];

        $data = $request->validate($this->rules($fields, updating: false), $this->messages());

        if (in_array('is_active', array_column($fields, 'name'), true) && ! array_key_exists('is_active', $data)) {
            $data['is_active'] = true;
        }

        $row = $this->service->store($data, $config['model']);

        return $this->success(
            ['row' => $this->expose($row->load($config['with'] ?? []), $config)],
            __($this->lang('created'), ['entity' => __($this->labelKey($config['label']))])
        );
    }

    public function update(Request $request, string $entity, int $lookup): JsonResponse
    {
        $config = LookupEntities::resolve($entity);

        $this->authorizeLookup($config);

        $fields = $config['fields'];

        $data = $request->validate($this->rules($fields, updating: true), $this->messages());

        $row = $this->service->update($data, ($config['model'])::findOrFail($lookup));

        return $this->success(
            ['row' => $this->expose($row->load($config['with'] ?? []), $config)],
            __($this->lang('updated'), ['entity' => __($this->labelKey($config['label']))])
        );
    }

    public function destroy(string $entity, int $lookup): JsonResponse
    {
        $config = LookupEntities::resolve($entity);

        $this->authorizeLookup($config);

        $this->service->destroy(($config['model'])::findOrFail($lookup));

        return $this->success(
            message: __($this->lang('deleted'), ['entity' => __($this->labelKey($config['label']))])
        );
    }

    private function labelKey(string $configKey): string
    {
        return $this->panel.'.'.ltrim($configKey, '.');
    }

    private function authorizeLookup(array $config): void
    {
        abort_if($this->panel === 'company' && $config['model'] === Vacation::class, 403);
    }

    private function lang(string $key): string
    {
        return $this->panel.'.lookups.'.ltrim($key, '.');
    }

    private function viewConfig(string $entity, array $config): array
    {
        $columns = array_map(
            fn (array $column) => ['key' => $column['key'], 'label' => __($this->labelKey($column['label']))],
            $config['columns']
        );

        $fields = array_map(function (array $field) {
            $resolved = [
                'name' => $field['name'],
                'type' => $field['type'],
                'label' => __($this->labelKey($field['label'])),
                'col' => $field['col'] ?? 12,
            ];

            if (isset($field['placeholder'])) {
                $resolved['placeholder'] = __($this->labelKey($field['placeholder']));
            }
            if (isset($field['empty'])) {
                $resolved['empty'] = __($this->labelKey($field['empty']));
            }
            if (isset($field['dir'])) {
                $resolved['dir'] = $field['dir'];
            }
            if (isset($field['step'])) {
                $resolved['step'] = $field['step'];
            }

            return $resolved;
        }, $config['fields']);

        return [
            'entity' => $entity,
            'label' => __($this->labelKey($config['label'])),
            'icon' => $this->panel === 'admin' ? ($config['iconTi'] ?? $config['iconBi']) : $config['iconBi'],
            'map' => (bool) ($config['map'] ?? false),
            'enableToggle' => (bool) ($config['enableToggle'] ?? false),
            'columns' => $columns,
            'fields' => $fields,
            'indexUrl' => route($this->routeBase.'.index', $entity),
        ];
    }

    private function rules(array $fields, bool $updating): array
    {
        $required = ['title_ar', 'title_en', 'name_ar', 'name_en', 'city_id', 'date'];

        $typeRules = [
            'title_ar' => ['string', 'max:255'],
            'title_en' => ['string', 'max:255'],
            'name_ar' => ['string', 'max:255'],
            'name_en' => ['string', 'max:255'],
            'latitude' => ['numeric', 'between:-90,90'],
            'longitude' => ['numeric', 'between:-180,180'],
            'city_id' => ['integer', 'exists:cities,id'],
            'date' => ['date'],
            'is_active' => ['boolean'],
        ];

        $rules = [];

        foreach ($fields as $field) {
            $name = $field['name'];
            $base = $typeRules[$name] ?? ['string', 'max:255'];

            if (in_array($name, $required, true)) {
                array_unshift($base, $updating ? 'sometimes' : 'required');
            } else {
                array_unshift($base, 'nullable');
            }

            $rules[$name] = $base;
        }

        return $rules;
    }

    private function messages(): array
    {
        $v = $this->lang('validation.');

        return [
            'title_ar.required' => __($v.'title_ar_required'),
            'title_ar.max' => __($v.'title_max'),
            'title_en.required' => __($v.'title_en_required'),
            'title_en.max' => __($v.'title_max'),
            'name_ar.required' => __($v.'name_ar_required'),
            'name_en.required' => __($v.'name_en_required'),
            'name_ar.max' => __($v.'name_max'),
            'name_en.max' => __($v.'name_max'),
            'city_id.required' => __($v.'city_required'),
            'city_id.integer' => __($v.'city_invalid'),
            'city_id.exists' => __($v.'city_invalid'),
            'latitude.numeric' => __($v.'latitude_numeric'),
            'latitude.between' => __($v.'latitude_between'),
            'longitude.numeric' => __($v.'longitude_numeric'),
            'longitude.between' => __($v.'longitude_between'),
            'date.required' => __($v.'date_required'),
            'date.date' => __($v.'date_invalid'),
            'is_active.boolean' => __($v.'is_active_boolean'),
        ];
    }

    private function expose(Model $row, array $config): array
    {
        $isArabic = app()->getLocale() === 'ar';

        $data = [
            'id' => $row->id,
            'title' => $row->title_ar ?? $row->name_ar ?? '',
            'title_alt' => $row->title_en ?? $row->name_en ?? '',
            'title_ar' => $row->title_ar ?? $row->name_ar ?? '',
            'title_en' => $row->title_en ?? $row->name_en ?? '',
            'name_ar' => $row->name_ar ?? $row->title_ar ?? '',
            'name_en' => $row->name_en ?? $row->title_en ?? '',
            'city_id' => $row->city_id ?? null,
            'latitude' => $row->latitude !== null ? (float) $row->latitude : null,
            'longitude' => $row->longitude !== null ? (float) $row->longitude : null,
            'city' => null,
            'date' => $row->date ? $row->date->toDateString() : null,
            'is_active' => (bool) ($row->is_active ?? true),
            'created_at' => $row->created_at?->toISOString(),
        ];

        if ($row->relationLoaded('city') && $row->city !== null) {
            $data['city'] = $isArabic ? $row->city->title_ar : $row->city->title_en;
        }

        return $data;
    }
}
