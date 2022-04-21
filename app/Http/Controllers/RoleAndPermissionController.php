<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use function view;

class RoleAndPermissionController extends Controller
{
    public function roles()
    {
        $allRoleNames = Role::all()->pluck('name');
        $response = [];
        foreach ($allRoleNames as $roleName) {
            $query = User::role($roleName);

            $response[] = [
                'name' => $roleName,
                'userCount' => $query->count(),
                'userList' => $query->take(5)->get(),
            ];
        }
        $pageConfigs = ['pageHeader' => false,];

        return view('content.role-and-permission.access-roles', [
            'pageConfigs' => $pageConfigs,
            'listRoles' => $response,
        ]);
    }

    public function permissions()
    {
        $pageConfigs = ['pageHeader' => false,];

        return view('content.role-and-permission.access-permission', ['pageConfigs' => $pageConfigs]);
    }
}
