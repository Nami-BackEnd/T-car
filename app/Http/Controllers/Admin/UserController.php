<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Models\UserWalletTransaction;
use App\Services\Admin\UserService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly UserService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.users',
            'entity'    => __('admin.nav.users'),
            'icon'      => 'ti-users',
        ];
    }

    public function index(Request $request)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return $this->success($this->service->paginate($request));
        }

        return view('admin.pages.users.index', ['config' => self::config()]);
    }

    public function store(UserRequest $request): JsonResponse
    {
        $user = $this->service->store($request->validated());

        return $this->success(
            ['user' => $user->only($this->exposedFields())],
            __('admin.messages.created_success', ['entity' => self::config()['entity']])
        );
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {
        $user = $this->service->update($request->validated(), $user);

        return $this->success(
            ['user' => $user->only($this->exposedFields())],
            __('admin.messages.updated_success', ['entity' => self::config()['entity']])
        );
    }

    public function destroy(User $user): JsonResponse
    {
        $this->service->destroy($user);

        return $this->success(message: __('admin.messages.deleted_success', ['entity' => self::config()['entity']]));
    }

    public function wallet(User $user): JsonResponse
    {
        $transactions = $user->walletTransactions()
            ->orderByDesc('id')
            ->get()
            ->map(fn (UserWalletTransaction $transaction) => [
                'id'         => $transaction->id,
                'value'      => (float) $transaction->value,
                'type'       => $transaction->type->value,
                'status'     => $transaction->status,
                'order_id'   => $transaction->order_id,
                'created_at' => $transaction->created_at?->toISOString(),
            ]);

        return $this->success(['transactions' => $transactions]);
    }

    public function show(User $user)
    {
        $transactions = $user->walletTransactions()
            ->orderByDesc('id')
            ->get();

        return view('admin.pages.users.show', [
            'config'       => self::config(),
            'user'         => $user,
            'transactions' => $transactions,
        ]);
    }

    private function exposedFields(): array
    {
        return [
            'id',
            'name',
            'phone_code',
            'phone',
            'email',
            'birth_date',
            'balance',
            'lang',
            'address_name',
        ];
    }
}
