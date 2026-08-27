<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RbacSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'members.view',
            'members.create',
            'members.update',
            'members.delete',
            'members.assign_plan',

            'payments.create',

            'plans.view',
            'plans.create',
            'plans.update',
            'plans.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        $user = Role::firstOrCreate([
            'name' => 'user',
        ]);

        $assistant = Role::firstOrCreate([
            'name' => 'assistant',
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'admin',
        ]);

        $userPermissions = Permission::whereIn('name', [
            'members.view',
            'members.create',
            'members.update',
            'members.delete',
            'members.assign_plan',
            'payments.create',
        ])->get();

        $assistantPermissions = Permission::whereIn('name', [
            'members.view',
            'members.create',
            'members.update',
            'members.delete',
            'members.assign_plan',

            'payments.create',

            'plans.view',
            'plans.create',
            'plans.update',
            'plans.delete',
        ])->get();

       $allPermissions = Permission::all();

        $user->permissions()->sync($userPermissions);
        $assistant->permissions()->sync($assistantPermissions);
        $admin->permissions()->sync($allPermissions);
    }
}
