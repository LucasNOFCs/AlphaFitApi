<?php

namespace App\Services;

use App\Models\Plan;

class PlansService
{
    public function index()
    {
        return Plan::all();
    }

    public function show(string $id)
    {
        return Plan::findOrFail($id);
    }

    public function store(array $data)
    {
        return Plan::create($data);
    }

    public function update(string $id, array $data)
    {
        $plan = Plan::findOrFail($id);

        $plan->update($data);

        return $plan;
    }

    public function destroy(string $id)
    {
        $plan = Plan::findOrFail($id);

        return $plan->delete();
    }
}