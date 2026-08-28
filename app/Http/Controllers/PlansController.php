<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlansService;
use App\Http\Requests\StorePlanRequest;
use App\Http\Resources\PlanResource;
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
        return PlanResource::collection($plans);
    }

    public function store(StorePlanRequest $request)
    {
        $data = $request->validated();
        $plan = $this->service->store($data);
        
        return response()->json([
            'message' => 'Plan created successfully.',
            'data' => new PlanResource($plan)
        ], 201);
    }

    public function show(string $id)
    {
        $plan = $this->service->show($id);
        return new PlanResource($plan);
    }

    public function update(UpdatePlanRequest $request, string $id)
    {
        $data = $request->validated();
        $plan = $this->service->update($id, $data);
        
        return response()->json([
            'message' => 'Plan updated successfully.',
            'data' => new PlanResource($plan)
        ]);
    }

    public function destroy(string $id)
    {
        $this->service->destroy($id);
        return response()->noContent();
    }
}
