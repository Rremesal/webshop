<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index', ['users' => $users]);
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        foreach ($roles as $role) {

            if ($user->hasRole($role->name)) {
                $role['set'] = true;
            }

            foreach ($role->permissions as $permission) {
                if ($user->hasPermissionTo($permission->name)) {
                    $permission['set'] = true;
                }
            }
        }

        return view('user.show', ['user' => $user, 'roles' => $roles]);
    }

    public function update(User $user)
    {
        $permissions = Permission::all();
        $roles = Role::all();

        $formPermissions = request()->all();
        //get only the usable data from the request
        unset($formPermissions['_token']);
        unset($formPermissions['_method']);


        // filter the roles from the permissions, because it is all done in the same function
        $formRoles = [];
        foreach (array_keys($formPermissions) as $permission) {
            if (str_starts_with($permission, 'role_')) {
                array_push($formRoles, substr($permission, 5, strlen($permission)));
            }
        }

        foreach ($permissions as $permission) {
            $keyFound = false;
            foreach (array_keys($formPermissions) as $formPermission) {
                if ($formPermission === $permission->name) {
                    $user->givePermissionTo($permission);
                    $keyFound = true;
                    break;
                }
            }
            if (!$keyFound) $user->revokePermissionTo($permission->name);
        }

        foreach ($roles as $role) {
            $keyFound = false;
            foreach (array_values($formRoles) as $formRole) {
                if ($formRole === $role->name) {
                    $user->assignRole($role->name);
                    $keyFound = true;
                    break;
                }
            }
            if (!$keyFound) $user->removeRole($role->name);
        }

        return redirect()->back();
    }
}
