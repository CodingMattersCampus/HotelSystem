<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class CreateRoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'name'              => "required|unique:rooms",
            'type'              => "required",
            'booking_rate'      => 'required',
            'booking_duration'  => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return Auth::guard('store')->check();
    }
}
