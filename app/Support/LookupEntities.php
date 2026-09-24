<?php

namespace App\Support;

use App\Models\Airport;
use App\Models\Bank;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\City;
use App\Models\CompanyAdditionalService;
use App\Models\Feature;
use App\Models\PaymentMethod;
use App\Models\TrainStation;
use App\Models\Vacation;

/**
 * Shared configuration for the AJAX dropdown CRUD pages.
 * Lang keys are panel-agnostic ("lookups.*"); controllers prefix them
 * with "company." or "admin." depending on the active panel.
 */
class LookupEntities
{
    public static function all(): array
    {
        return [
            'cities' => [
                'label' => 'lookups.cities',
                'iconBi' => 'bi-pin-map',
                'iconTi' => 'ti-map-pin',
                'model' => City::class,
                'map' => true,
                'searchFields' => ['title_ar', 'title_en'],
                'columns' => [
                    ['key' => 'title_ar', 'label' => 'lookups.title_ar'],
                    ['key' => 'title_en', 'label' => 'lookups.title_en'],
                    ['key' => 'latitude', 'label' => 'lookups.latitude'],
                    ['key' => 'longitude', 'label' => 'lookups.longitude'],
                ],
                'fields' => [
                    ['name' => 'title_ar', 'type' => 'text', 'label' => 'lookups.title_ar', 'placeholder' => 'lookups.placeholder_ar', 'dir' => 'rtl', 'col' => 6],
                    ['name' => 'title_en', 'type' => 'text', 'label' => 'lookups.title_en', 'placeholder' => 'lookups.placeholder_en', 'dir' => 'ltr', 'col' => 6],
                    ['name' => 'latitude', 'type' => 'number', 'label' => 'lookups.latitude', 'step' => 'any', 'col' => 6],
                    ['name' => 'longitude', 'type' => 'number', 'label' => 'lookups.longitude', 'step' => 'any', 'col' => 6],
                ],
            ],
            'airports' => [
                'label' => 'lookups.airports',
                'iconBi' => 'bi-airplane-engines',
                'iconTi' => 'ti-plane',
                'model' => Airport::class,
                'with' => ['city'],
                'searchFields' => ['title_ar', 'title_en'],
                'columns' => [
                    ['key' => 'title_ar', 'label' => 'lookups.title_ar'],
                    ['key' => 'title_en', 'label' => 'lookups.title_en'],
                    ['key' => 'city', 'label' => 'lookups.city'],
                ],
                'fields' => [
                    ['name' => 'title_ar', 'type' => 'text', 'label' => 'lookups.title_ar', 'placeholder' => 'lookups.placeholder_ar', 'dir' => 'rtl', 'col' => 6],
                    ['name' => 'title_en', 'type' => 'text', 'label' => 'lookups.title_en', 'placeholder' => 'lookups.placeholder_en', 'dir' => 'ltr', 'col' => 6],
                    ['name' => 'city_id', 'type' => 'select', 'label' => 'lookups.city', 'options' => 'cities', 'empty' => 'lookups.select_city', 'col' => 12],
                ],
            ],
            'train-stations' => [
                'label' => 'lookups.train_stations',
                'iconBi' => 'bi-train-front',
                'iconTi' => 'ti-train',
                'model' => TrainStation::class,
                'with' => ['city'],
                'searchFields' => ['title_ar', 'title_en'],
                'columns' => [
                    ['key' => 'title_ar', 'label' => 'lookups.title_ar'],
                    ['key' => 'title_en', 'label' => 'lookups.title_en'],
                    ['key' => 'city', 'label' => 'lookups.city'],
                ],
                'fields' => [
                    ['name' => 'title_ar', 'type' => 'text', 'label' => 'lookups.title_ar', 'placeholder' => 'lookups.placeholder_ar', 'dir' => 'rtl', 'col' => 6],
                    ['name' => 'title_en', 'type' => 'text', 'label' => 'lookups.title_en', 'placeholder' => 'lookups.placeholder_en', 'dir' => 'ltr', 'col' => 6],
                    ['name' => 'city_id', 'type' => 'select', 'label' => 'lookups.city', 'options' => 'cities', 'empty' => 'lookups.select_city', 'col' => 12],
                ],
            ],
            'brands' => [
                'label' => 'lookups.brands',
                'iconBi' => 'bi-tags',
                'iconTi' => 'ti-tags',
                'model' => Brand::class,
                'searchFields' => ['title_ar', 'title_en'],
                'columns' => [
                    ['key' => 'title_ar', 'label' => 'lookups.title_ar'],
                    ['key' => 'title_en', 'label' => 'lookups.title_en'],
                ],
                'fields' => [
                    ['name' => 'title_ar', 'type' => 'text', 'label' => 'lookups.title_ar', 'placeholder' => 'lookups.placeholder_ar', 'dir' => 'rtl', 'col' => 6],
                    ['name' => 'title_en', 'type' => 'text', 'label' => 'lookups.title_en', 'placeholder' => 'lookups.placeholder_en', 'dir' => 'ltr', 'col' => 6],
                ],
            ],
            'car-types' => [
                'label' => 'lookups.car_types',
                'iconBi' => 'bi-grid',
                'iconTi' => 'ti-layout-grid',
                'model' => CarType::class,
                'searchFields' => ['title_ar', 'title_en'],
                'enableToggle' => true,
                'columns' => [
                    ['key' => 'title_ar', 'label' => 'lookups.title_ar'],
                    ['key' => 'title_en', 'label' => 'lookups.title_en'],
                    ['key' => 'is_active', 'label' => 'lookups.status'],
                ],
                'fields' => [
                    ['name' => 'title_ar', 'type' => 'text', 'label' => 'lookups.title_ar', 'placeholder' => 'lookups.placeholder_ar', 'dir' => 'rtl', 'col' => 6],
                    ['name' => 'title_en', 'type' => 'text', 'label' => 'lookups.title_en', 'placeholder' => 'lookups.placeholder_en', 'dir' => 'ltr', 'col' => 6],
                    ['name' => 'is_active', 'type' => 'toggle', 'label' => 'lookups.active', 'col' => 12],
                ],
            ],
            'car-models' => [
                'label' => 'lookups.models',
                'iconBi' => 'bi-car-front',
                'iconTi' => 'ti-car',
                'model' => CarModel::class,
                'searchFields' => ['title_ar', 'title_en'],
                'columns' => [
                    ['key' => 'title_ar', 'label' => 'lookups.title_ar'],
                    ['key' => 'title_en', 'label' => 'lookups.title_en'],
                ],
                'fields' => [
                    ['name' => 'title_ar', 'type' => 'text', 'label' => 'lookups.title_ar', 'placeholder' => 'lookups.placeholder_ar', 'dir' => 'rtl', 'col' => 6],
                    ['name' => 'title_en', 'type' => 'text', 'label' => 'lookups.title_en', 'placeholder' => 'lookups.placeholder_en', 'dir' => 'ltr', 'col' => 6],
                ],
            ],
            'features' => [
                'label' => 'lookups.features',
                'iconBi' => 'bi-stars',
                'iconTi' => 'ti-star',
                'model' => Feature::class,
                'searchFields' => ['title_ar', 'title_en'],
                'enableToggle' => true,
                'columns' => [
                    ['key' => 'title_ar', 'label' => 'lookups.title_ar'],
                    ['key' => 'title_en', 'label' => 'lookups.title_en'],
                    ['key' => 'is_active', 'label' => 'lookups.status'],
                ],
                'fields' => [
                    ['name' => 'title_ar', 'type' => 'text', 'label' => 'lookups.title_ar', 'placeholder' => 'lookups.placeholder_ar', 'dir' => 'rtl', 'col' => 6],
                    ['name' => 'title_en', 'type' => 'text', 'label' => 'lookups.title_en', 'placeholder' => 'lookups.placeholder_en', 'dir' => 'ltr', 'col' => 6],
                    ['name' => 'is_active', 'type' => 'toggle', 'label' => 'lookups.active', 'col' => 12],
                ],
            ],
            'vacations' => [
                'label' => 'lookups.vacations',
                'iconBi' => 'bi-calendar2-heart',
                'iconTi' => 'ti-calendar',
                'model' => Vacation::class,
                'searchFields' => ['name_ar', 'name_en'],
                'columns' => [
                    ['key' => 'title_ar', 'label' => 'lookups.title_ar'],
                    ['key' => 'title_en', 'label' => 'lookups.title_en'],
                    ['key' => 'date', 'label' => 'lookups.date'],
                ],
                'fields' => [
                    ['name' => 'name_ar', 'type' => 'text', 'label' => 'lookups.name_ar', 'placeholder' => 'lookups.placeholder_name_ar', 'dir' => 'rtl', 'col' => 6],
                    ['name' => 'name_en', 'type' => 'text', 'label' => 'lookups.name_en', 'placeholder' => 'lookups.placeholder_name_en', 'dir' => 'ltr', 'col' => 6],
                    ['name' => 'date', 'type' => 'date', 'label' => 'lookups.date', 'col' => 12],
                ],
            ],
            'banks' => [
                'label' => 'lookups.banks',
                'iconBi' => 'bi-bank',
                'iconTi' => 'ti-building-bank',
                'model' => Bank::class,
                'searchFields' => ['title_ar', 'title_en'],
                'columns' => [
                    ['key' => 'title_ar', 'label' => 'lookups.title_ar'],
                    ['key' => 'title_en', 'label' => 'lookups.title_en'],
                ],
                'fields' => [
                    ['name' => 'title_ar', 'type' => 'text', 'label' => 'lookups.title_ar', 'placeholder' => 'lookups.placeholder_ar', 'dir' => 'rtl', 'col' => 6],
                    ['name' => 'title_en', 'type' => 'text', 'label' => 'lookups.title_en', 'placeholder' => 'lookups.placeholder_en', 'dir' => 'ltr', 'col' => 6],
                ],
            ],
            'payment-methods' => [
                'label' => 'lookups.payment_methods',
                'iconBi' => 'bi-credit-card',
                'iconTi' => 'ti-credit-card',
                'model' => PaymentMethod::class,
                'searchFields' => ['title_ar', 'title_en'],
                'columns' => [
                    ['key' => 'title_ar', 'label' => 'lookups.title_ar'],
                    ['key' => 'title_en', 'label' => 'lookups.title_en'],
                ],
                'fields' => [
                    ['name' => 'title_ar', 'type' => 'text', 'label' => 'lookups.title_ar', 'placeholder' => 'lookups.placeholder_ar', 'dir' => 'rtl', 'col' => 6],
                    ['name' => 'title_en', 'type' => 'text', 'label' => 'lookups.title_en', 'placeholder' => 'lookups.placeholder_en', 'dir' => 'ltr', 'col' => 6],
                ],
            ],
            'company-services' => [
                'label' => 'lookups.company_services',
                'iconBi' => 'bi-tools',
                'iconTi' => 'ti-tools',
                'model' => CompanyAdditionalService::class,
                'searchFields' => ['title_ar', 'title_en'],
                'columns' => [
                    ['key' => 'title_ar', 'label' => 'lookups.title_ar'],
                    ['key' => 'title_en', 'label' => 'lookups.title_en'],
                ],
                'fields' => [
                    ['name' => 'title_ar', 'type' => 'text', 'label' => 'lookups.title_ar', 'placeholder' => 'lookups.placeholder_ar', 'dir' => 'rtl', 'col' => 6],
                    ['name' => 'title_en', 'type' => 'text', 'label' => 'lookups.title_en', 'placeholder' => 'lookups.placeholder_en', 'dir' => 'ltr', 'col' => 6],
                ],
            ],
        ];
    }

    public static function resolve(string $slug): array
    {
        $config = self::all()[$slug] ?? null;

        abort_if($config === null, 404);

        return $config;
    }
}
