<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionController extends Controller
{
    public function setupRolesPermissions()
    {
        // Tạo permissions
        $viewPosts = Permission::firstOrCreate(['name' => 'view posts']);
        $editPosts = Permission::firstOrCreate(['name' => 'edit posts']);
        $deletePosts = Permission::firstOrCreate(['name' => 'delete posts']);

        // Tạo roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Gán quyền cho roles
        $adminRole->givePermissionTo([$viewPosts, $editPosts, $deletePosts]);
        $userRole->givePermissionTo([$viewPosts]);

        // Gán role cho user id = 1
        $user = User::find(1);
        $user?->assignRole('admin');

        return "Đã setup Roles & Permissions!";
    }
}
