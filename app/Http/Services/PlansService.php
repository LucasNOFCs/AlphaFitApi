<?php

namespace App\Services;

use App\Models\Plan;

class PlansService
{
    public function index()
    {
        return Plan::all();
    }

    public function show(int $id)
    {
        return Plan::findOrFail($id);
    }

    public function store(array $data)
    {
        return Plan::create($data);
    }

    public function update(int $id, array $data)
    {
        $plan = Plan::findOrFail($id);

        $plan->update($data);

        return $plan;
    }

    public function destroy(int $id)
    {
        $plan = Plan::findOrFail($id);

        return $plan->delete();
    }
}