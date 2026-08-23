<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UserService extends Service
{
    public function paginate(Request $request): LengthAwarePaginator
    {
        return User::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->trim();

                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate($request->integer('per_page', 10))
            ->withQueryString();
    }

    public function store(array $data): User
    {
        return User::create($data);
    }

    public function update(array $data, User $user): User
    {
        $user->update($data);

        return $user;
    }

    public function destroy(User $user): void
    {
        $user->delete();
    }
}
