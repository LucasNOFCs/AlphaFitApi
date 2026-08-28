<?php

namespace App\Services;

use App\Models\Payment;
use Carbon\Carbon;

class PaymentService
{
    public function index()
    {
        return Payment::all();
    }

    public function show(string $id)
    {
        return Payment::findOrFail($id);
    }

    public function store(array $data)
    {
        $data['payment_month'] = Carbon::parse($data['payment_month'])
            ->startOfMonth()
            ->toDateString();

        return Payment::create($data);
    }

    public function update(string $id, array $data)
    {
        $payment = Payment::findOrFail($id);

        if (isset($data['payment_date'])) {
            $data['payment_month'] = Carbon::parse($data['payment_date'])
                ->startOfMonth()
                ->toDateString();
        }

        $payment->update($data);

        return $payment;
    }

    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);

        return $payment->delete();
    }
}
