<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlansService;
use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;

class PlansController extends Controller
{

    private PlansService $service;


    public function __construct(PlansService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $plans = $this->service->index();
        return $plans;
    }

    public function store(StorePlanRequest $request)
    {
        $data = $request->validated();
        $plan = $this->service->store($data);
        return $plan;
    }

    public function show(string $id)
    {
        $plan = $this->service->show($id);
        return $plan;
    }

    public function update(UpdatePlanRequest $request, string $id)
    {
        $data = $request->validated();
        $plan = $this->service->update($id, $data);
        return $plan;
    }

    public function destroy(string $id)
    {
        $plan = $this->service->destroy($id);
        return ["plan" => $plan, "message" => "Plan deleted successfully"];
    }
}
