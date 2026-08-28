<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Permission;
use App\Models\User;
use App\Models\Role;
use Tests\TestCase;

class RbacTest extends TestCase
{
    use RefreshDatabase;
    public function test_unauthenticated_user_cannot_access_plans(): void
    {
        $response = $this->getJson('/api/plans');

        $response->assertUnauthorized();
    }

    public function test_user_role_cannot_access_plans(): void
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => 'user',
        ]);

        $user->roles()->attach($role->id);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this
            ->withToken($token)
            ->getJson('/api/plans');

        $response->assertForbidden();
    }

    public function test_assistant_can_access_plans(): void
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => 'assistant',
        ]);

        $permission = Permission::create([
            'name' => 'plans.view',
        ]);

        $role->permissions()->attach($permission->id);
        $user->roles()->attach($role->id);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this
            ->withToken($token)
            ->getJson('/api/plans');

        $response->assertOk();
    }

    public function test_admin_can_access_plans(): void
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => 'admin',
        ]);

        $permission = Permission::create([
            'name' => 'plans.view',
        ]);

        $role->permissions()->attach($permission->id);
        $user->roles()->attach($role->id);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this
            ->withToken($token)
            ->getJson('/api/plans');

        $response->assertOk();
    }

    public function test_unnauthenticated_user_cannot_insert_plans() {
        $response = $this->postJson('/api/plans', [
            'plan_name' => 'Test Plan',
            'description' => 'A test plan',
            'plan_price' => 100.00,
        ]);

        $response->assertUnauthorized();
    }

    public function test_user_can_insert_plans() {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => 'user',
        ]);

        $permission = Permission::create([
            'name' => 'plans.create',
        ]);

        $role->permissions()->attach($permission->id);
        $user->roles()->attach($role->id);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this
            ->withToken($token)
            ->postJson('/api/plans', [
                'plan_name' => 'Test Plan',
                'description' => 'A test plan',
                'plan_price' => 100.00,
            ]);

        $response->assertCreated();
    }

    public function test_assistant_can_insert_plans() {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => 'assistant',
        ]);

        $permission = Permission::create([
            'name' => 'plans.create',
        ]);

        $role->permissions()->attach($permission->id);
        $user->roles()->attach($role->id);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this
            ->withToken($token)
            ->postJson('/api/plans', [
                'plan_name' => 'Test Plan',
                'description' => 'A test plan',
                'plan_price' => 100.00,
            ]);

        $response->assertCreated();
    }

    public function test_admin_can_insert_plans() {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => 'admin',
        ]);

        $permission = Permission::create([
            'name' => 'plans.create',
        ]);

        $role->permissions()->attach($permission->id);
        $user->roles()->attach($role->id);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this
            ->withToken($token)
            ->postJson('/api/plans', [
                'plan_name' => 'Test Plan',
                'description' => 'A test plan',
                'plan_price' => 100.00,
            ]);

        $response->assertCreated();
    }
}
