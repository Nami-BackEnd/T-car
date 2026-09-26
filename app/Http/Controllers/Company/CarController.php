<?php

namespace App\Http\Controllers\Company;

use App\Http\Requests\Company\CarRequest;
use App\Http\Requests\Company\CarStockRequest;
use App\Models\Car;
use App\Services\Company\CarService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly CarService $service) {}

    public function options(): JsonResponse
    {
        return $this->success($this->service->options((int) auth('company')->id()));
    }

    /**
     * The car list screen. Every filter, tab and page size lives in the query
     * string, so changing one is a plain navigation and the server decides what
     * the table shows — no client-side filtering and no ajax round trip.
     */
    public function index(Request $request): View
    {
        $companyId = (int) auth('company')->id();
        $list = $this->service->listCars($companyId, $request->only(['branch', 'brand', 'car_type', 'car_model', 'year', 'status', 'q', 'sort', 'per_page', 'page']));

        return view('company.pages.office-cars', array_merge($list, [
            'title' => __('company.pages.office-cars'),
        ]));
    }

    /**
     * The "license plates" screen lists the same cars as the office screen, so
     * it shares the one query. It differs only in presentation: the branch
     * column and the status tabs are not offered, and every filter still
     * navigates through the query string.
     */
    public function licensePlates(Request $request): View
    {
        $companyId = (int) auth('company')->id();
        $list = $this->service->listCars($companyId, $request->only(['brand', 'car_type', 'car_model', 'year', 'status', 'q', 'sort', 'per_page', 'page']));

        return view('company.pages.license-plates', array_merge($list, [
            'title' => __('company.common.472'),
        ]));
    }

    /**
     * The availability matrix screen. Same rule as the other car lists: every
     * filter lives in the query string and the server decides the rows and the
     * columns, so nothing is filtered or summed in the browser.
     */
    public function availability(Request $request): View
    {
        $companyId = (int) auth('company')->id();
        $matrix = $this->service->availabilityMatrix($companyId, $request->only(['branch', 'brand', 'car_type', 'car_model', 'year', 'status', 'q']));

        return view('company.pages.car-availability', array_merge($matrix, [
            'title' => __('company.common.352'),
        ]));
    }

    /**
     * One matrix cell. The stepper saves on every click, so this answers with
     * the stored value instead of redirecting.
     */
    public function updateAvailabilityStock(Request $request, Car $car): JsonResponse
    {
        $data = $request->validate([
            'branch' => ['required', 'integer'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $stock = $this->service->setMatrixStock(
            $car,
            (int) $data['branch'],
            (int) $data['stock'],
            (int) auth('company')->id()
        );

        return $this->success([
            'stock' => $stock,
            'branch' => (int) $data['branch'],
            'car' => $car->id,
        ], __('company.cars.stocks_updated'));
    }

    public function toggleAvailability(Request $request, Car $car): JsonResponse
    {
        $isActive = $this->service->toggleActive($car, (int) auth('company')->id());

        return $this->success([
            'is_active' => $isActive,
            'car' => $car->id,
        ]);
    }

    public function updateStocks(CarStockRequest $request, Car $car): RedirectResponse
    {
        $this->service->updateStocks($request->validated()['stocks'], $car, (int) auth('company')->id());

        return redirect()
            ->to($this->returnUrl($request))
            ->with('status', __('company.cars.stocks_updated'));
    }

    public function destroy(Request $request, Car $car): RedirectResponse
    {
        $this->service->delete($car, (int) auth('company')->id());

        return redirect()
            ->to($this->returnUrl($request))
            ->with('status', __('company.cars.deleted'));
    }

    /**
     * The stock form and the delete form are rendered on more than one car
     * screen, so both carry the screen they were submitted from. It is matched
     * against a fixed list rather than used as-is, so it cannot be turned into
     * a redirect somewhere off-site.
     */
    private function returnUrl(Request $request): string
    {
        return $request->input('return') === 'license-plates'
            ? route('company.license-plates', $request->only(['brand', 'car_type', 'car_model', 'year', 'status', 'q', 'per_page']))
            : route('company.office-cars', array_filter($request->only('branch'), fn ($v) => $v !== null));
    }

    public function store(CarRequest $request): JsonResponse
    {
        $car = $this->service->create(
            $request->validated(),
            (int) auth('company')->id(),
            $request->file('image')
        );

        return $this->success(['car' => $this->expose($car)], __('company.cars.created'));
    }

    public function show(Car $car): JsonResponse
    {
        abort_unless($this->service->ownsCar($car, (int) auth('company')->id()), 403);

        return $this->success([
            'car' => $this->expose($car->load(CarService::CAR_RELATIONS)),
            'options' => $this->service->options((int) auth('company')->id()),
        ]);
    }

    public function update(CarRequest $request, Car $car): JsonResponse
    {
        $car = $this->service->update(
            $request->validated(),
            $car,
            (int) auth('company')->id(),
            $request->file('image')
        );

        return $this->success(['car' => $this->expose($car)], __('company.cars.updated'));
    }

    private function expose(Car $car): array
    {
        return [
            'id' => $car->id,
            'image' => $car->image,
            'image_url' => $car->image_url,
            'car_brand_id' => $car->car_brand_id,
            'car_type_id' => $car->car_type_id,
            'car_model_id' => $car->car_model_id,
            'brand' => $this->exposeLookup($car->brand),
            'type' => $this->exposeLookup($car->type),
            'car_model' => $this->exposeLookup($car->carModel),
            'year' => $car->year,
            'count' => $car->count,
            'note_ar' => $car->note_ar,
            'note_en' => $car->note_en,
            'is_subscriber' => $car->is_subscriber,
            'pricing' => $car->pricing ? [
                'day_price' => (float) $car->pricing->day_price,
                'day_lowest_price' => (float) $car->pricing->day_lowest_price,
                'week_price' => (float) $car->pricing->week_price,
                'week_lowest_price' => (float) $car->pricing->week_lowest_price,
                'month_price' => (float) $car->pricing->month_price,
                'month_lowest_price' => (float) $car->pricing->month_lowest_price,
                'free_km' => (int) $car->pricing->free_km,
                'free_km_price' => (float) $car->pricing->free_km_price,
            ] : null,
            'details' => $car->details ? [
                'power' => $car->details->power,
                'door_count' => (int) $car->details->door_count,
                'has_navigation' => (bool) $car->details->has_navigation,
                'has_bluetooth' => (bool) $car->details->has_bluetooth,
                'has_panorama' => (bool) $car->details->has_panorama,
                'has_usp' => (bool) $car->details->has_usp,
                'has_background_camera' => (bool) $car->details->has_background_camera,
                'has_sensors' => (bool) $car->details->has_sensors,
                'has_apple_play' => (bool) $car->details->has_apple_play,
            ] : null,
            'subscriptions' => $car->subscriptions
                ->map(fn ($row) => [
                    'month_count' => (int) $row->month_count,
                    'price' => (float) $row->price,
                    'lowest_price' => (float) $row->lowest_price,
                ])->values(),
            'services' => $car->carServices
                ->map(fn ($row) => [
                    'car_additional_service_id' => $row->car_additional_service_id,
                    'price' => (float) $row->price,
                    'title' => $this->exposeLookup($row->additionalService)['title'] ?? '',
                ])->values(),
            'branches' => $car->branches
                ->map(fn ($row) => [
                    'branch_id' => $row->id,
                    'name_ar' => $row->name_ar,
                    'name_en' => $row->name_en,
                    'stock' => (int) $row->pivot->stock,
                ])->values(),
        ];
    }

    private function exposeLookup(?object $row): array
    {
        if ($row === null) {
            return [];
        }

        $ar = $row->title_ar ?? $row->name_ar;
        $en = $row->title_en ?? $row->name_en;

        return [
            'id' => $row->id,
            'title_ar' => $ar,
            'title_en' => $en,
            'title' => (app()->getLocale() === 'ar' ? $ar : $en) ?: $ar ?: $en,
        ];
    }
}
