<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

final class CheckoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cash'          => "required",
            'total_amount'  => "required",
            'change'        => "required",
//            'penalties'     => "required"
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user('booking')->isActive();
    }
}
