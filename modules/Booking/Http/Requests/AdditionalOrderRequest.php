<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class AdditionalOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'cash' => "required",
            'total_amount' => "required|min:1",
            'change' => "required|min:0",
            'orders' => "required"
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return $this->user('booking')->isActive();
    }
}
