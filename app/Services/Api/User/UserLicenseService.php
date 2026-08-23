<?php

namespace App\Services\Api\User;

use App\Http\Resources\UserLicenseResource;
use App\Models\UserLicense;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Storage;

class UserLicenseService
{

    public function store($user, $data)
    {
        $data['license'] = $data['license']->store('users/licenses', 'public');
        if($user->license) {
            $oldLicense = UserLicense::where('user_id', $user->id)->first();
            Storage::disk('public')->delete($oldLicense->license);
        }
        $license = UserLicense::updateOrCreate(['user_id' => $user->id], $data);

        return ApiResponse::success(
            data: new UserLicenseResource($license),
            message: __('user.license_created'),
        );
    }
}
