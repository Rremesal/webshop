<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    private $rules = [
        'role' => ['required', 'unique:'.Role::class.',name' ],
        'permission' => ['unique:'.Permission::class.',name'],
    ];


    public function index()
    {
        $permissions = Permission::all();
        $users = User::all();
        return view('role.index', ['permissions' => $permissions, 'users' => $users]);
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $users = User::all();

        foreach ($role->permissions as $rolePermission) {
            foreach ($permissions as $permission) {
                if ($rolePermission->name === $permission->name) {
                    $permission['set'] = true;
                    break;
                }
            }
        }

        foreach($users as $user) {
            if($user->hasRole($role)) {
                $user['set'] = true;
                break;
            }
        }

        $selectedRole = $role;
        return view('role.index', ['permissions' =>  $permissions, 'selectedRole' => $selectedRole]);
    }

    public function store()
    {

        $data = request()->validate($this->rules);
        $role = Role::create(['name' => $data['role']]);

        //create a custom permission
        if($data['permission']) {
            $permission = Permission::create(['name' => $data['permission']]);
            $role->givePermissionTo($permission->name);
        }


        $formPermissions = request()->all();
        unset($formPermissions['role']);
        unset($formPermissions['permission']);
        unset($formPermissions['_token']);
        unset($formPermissions['_method']);

        $permissions = Permission::all();

        foreach($permissions as $permission) {
            foreach(array_keys($formPermissions) as $formPermissionKey) {
                if(str_replace('_', ' ', $formPermissionKey) === $permission->name) {
                    $role->givePermissionTo($permission->name);
                    break;
                }
            }
        }

        return redirect()->route('roles.edit', $role);
    }

    public function update(Role $role) {
        $data = request()->validate($this->rules);
        $role->update(['name' => $data['role']]);

        //create a custom permission
        if($data['permission']) {
            $permission = Permission::create(['name' => $data['permission']]);
            $role->givePermissionTo($permission->name);
        }

        $formPermissions = request()->all();
        unset($formPermissions['role']);
        unset($formPermissions['permission']);
        unset($formPermissions['_token']);
        unset($formPermissions['_method']);

        $permissions = Permission::all();

        foreach($permissions as $permission) {
            $keyFound = false;
            foreach(array_keys($formPermissions) as $formPermissionKey) {
                if(str_replace('_', ' ', $formPermissionKey) === $permission->name) {
                    $role->givePermissionTo($permission->name);
                    $keyFound = true;
                    break;
                }
            }
            if(!$keyFound) {
                $role->revokePermissionTo($permission->name);
            }
        }

        return redirect()->route('roles.edit', $role);

    }
}
