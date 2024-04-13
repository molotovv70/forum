<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ToggleRoleRequest;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\User\UserWithRolesResource;
use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = UserWithRolesResource::collection(User::all())->resolve();
        $roles = RoleResource::collection(Role::all())->resolve();
        return Inertia::render('Admin/User/Index', ['users' => $users, 'roles' => $roles]);
    }

    public function toggleRole(User $user, ToggleRoleRequest $request)
    {
        $data = $request->validated();
        $user->roles()->toggle($data);

        $user->load('roles');

        return UserWithRolesResource::make($user)->resolve();
    }
}
