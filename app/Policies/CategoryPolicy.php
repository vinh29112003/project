<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    /**
     * Xem danh sách tất cả category
     */
    public function viewAny(User $user): bool
    {
        return true; // Mọi người dùng đều được xem
    }

    /**
     * Xem chi tiết một category cụ thể
     */
    public function view(User $user, Category $category): bool
    {
        return true;
    }

    /**
     * Tạo mới category - cho phép admin hoặc user
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('user');
    }

    /**
     * Cập nhật category - chỉ cho phép admin
     */
    public function update(User $user, Category $category): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Xoá category - chỉ cho phép admin
     */
    public function delete(User $user, Category $category): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Khôi phục lại category đã xoá
     */
    public function restore(User $user, Category $category): bool
    {
        return false; // Không ai được phép
    }

    /**
     * Xoá vĩnh viễn category
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return false;
    }
}
