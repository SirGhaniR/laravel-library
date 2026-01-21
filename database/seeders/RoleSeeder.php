<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $user = [
            [
                "name" => 'Admin_1',
                "email" => 'admin1@gmail.com',
                "password" => Hash::make('admin#1')
            ],
            [
                "name" => 'Member_1',
                "email" => 'member1@gmail.com',
                "password" => Hash::make('member#1')
            ],
            [
                "name" => 'Admin_2',
                "email" => 'admin2@gmail.com',
                "password" => Hash::make('admin#2')
            ]
        ];

        $role = [
            [
                "role_name" => 'admin'
            ],
            [
                "role_name" => 'member'
            ]
        ];

        $users = User::insert($user);
        $roles = Role::insert($role);
    }
}
