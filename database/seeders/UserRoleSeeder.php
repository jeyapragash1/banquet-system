<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create Roles first
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $adminRole = Role::create(['name' => 'Admin/Manager']);
        $staffRole = Role::create(['name' => 'Staff']);

        // Create Super Admin User
        $super = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@pearl.com',
            'password' => Hash::make('password123'),
        ]);
        $super->assignRole($superAdminRole);

        // Create Manager User
        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@pearl.com',
            'password' => Hash::make('password123'),
        ]);
        $manager->assignRole($adminRole);

        // Create Staff User
        $staff = User::create([
            'name' => 'Staff',
            'email' => 'staff@pearl.com',
            'password' => Hash::make('password123'),
        ]);
        $staff->assignRole($staffRole);
    }
}