<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Domain\Enums\PaymentMethods;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "user_id" => "required|exists:users,id",
            "address_id" => "required|exists:addresses,id",
            "items" => "required|array",
            "items.*.product_id" => "required|exists:products,id",
            "items.*.quantity" => "required|integer|min:1",
            "items.*.toppings" => "array",
            "items.*.toppings.*" => "exists:toppings,id",
            "payment_method" => [
                'required',
                Rule::in(array_column(PaymentMethods::cases(), 'value')),
            ],
        ];
    }
}
