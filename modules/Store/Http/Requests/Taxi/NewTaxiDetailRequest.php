<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Requests\Taxi;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class NewTaxiDetailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            "plate" => "required",
            "name"  => "required",
            "make"  => "required",
            "model" => "required",
            "color" => "required"
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
