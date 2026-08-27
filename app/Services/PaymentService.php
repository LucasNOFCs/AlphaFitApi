<?php

namespace App\Services;

use App\Models\Payment;

class PaymentService
{
    public function index()
    {
        return Payment::all();
    }

    public function show(int $id)
    {
        return Payment::findOrFail($id);
    }

    public function store(array $data)
    {
        return Payment::create($data);
    }

    public function update(int $id, array $data)
    {
        $payment = Payment::findOrFail($id);

        $payment->update($data);

        return $payment;
    }

    public function destroy(int $id)
    {
        $payment = Payment::findOrFail($id);

        return $payment->delete();
    }
}