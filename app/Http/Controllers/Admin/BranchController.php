<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Services\Admin\BranchService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly BranchService $service)
    {
    }

    public static function config(): array
    {
        return [
            'routeBase' => 'admin.branches',
            'entity'    => __('admin.nav.branch_requests'),
            'icon'      => 'ti-building',
        ];
    }

    public function index(Request $request)
    {
        $isAjax = $request->expectsJson() || $request->ajax();

        if (! $request->filled('status')) {
            $request->merge(['status' => BranchService::STATUS_PENDING]);
        }

        if ($isAjax) {
            return $this->success($this->service->paginate($request));
        }

        return view('admin.pages.branches.index', ['config' => self::config()]);
    }

    public function approve(Branch $branch): JsonResponse
    {
        $branch = $this->service->setStatus($branch, 'approved');

        return $this->success(
            ['branch' => $this->exposed($branch)],
            __('admin.messages.branch_approved')
        );
    }

    public function reject(Branch $branch): JsonResponse
    {
        $branch = $this->service->setStatus($branch, 'reject');

        return $this->success(
            ['branch' => $this->exposed($branch)],
            __('admin.messages.branch_rejected')
        );
    }

    private function exposed(Branch $branch): array
    {
        return [
            'id'     => $branch->id,
            'name_ar' => $branch->name_ar,
            'name_en' => $branch->name_en,
            'status' => $branch->status,
        ];
    }
}