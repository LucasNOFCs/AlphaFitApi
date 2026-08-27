<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::where('name', 'user')->firstOrFail();

        $user = User::updateOrCreate(
            [
                'email' => 'lucas@test.com',
            ],
            [
                'name' => 'Lucas',
                'password' => Hash::make('12345678'),
            ]
        );

        $user->roles()->sync([$role->id]);
    }
}
