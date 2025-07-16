<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        Role::insert([
            ['id' => 1, 'name' => 'admin', 'description' => 'Quản trị viên'],
            ['id' => 2, 'name' => 'user', 'description' => 'Người dùng thường'],
        ]);
    }
}
