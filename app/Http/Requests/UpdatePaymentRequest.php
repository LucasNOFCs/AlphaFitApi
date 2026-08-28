<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => ['sometimes', 'decimal:2'],
            'payment_date' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
            'member_id' => ['sometimes', 'uuid' ,'exists:members,id'],
            'plan_id' => ['sometimes', 'uuid', 'exists:plans,id'],
        ];
    }
}
