<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Services\PaymentService;

class PaymentController extends Controller
{

    private PaymentService $service;

    public function __construct(PaymentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $payments = $this->service->index();
        return PaymentResource::collection($payments);
    }

    public function store(StorePaymentRequest $request)
    {
        $data = $request->validated();
        $payment = $this->service->store($data);

        return response()->json([
            'message' => 'Payment created successfully.',
            'data' => new PaymentResource($payment)
        ], 201);
    }

    public function show(string $id)
    {
        $payment = $this->service->show($id);
        return new PaymentResource($payment);
    }

    public function update(UpdatePaymentRequest $request, string $id)
    {
        $data = $request->validated();
        $payment = $this->service->update($id, $data);

        return response()->json([
            'message' => 'Payment updated successfully.',
            'data' => new PaymentResource($payment)
        ]);
    }

    public function destroy(string $id)
    {
        $this->service->destroy($id);
        return response()->noContent();
    }
}
