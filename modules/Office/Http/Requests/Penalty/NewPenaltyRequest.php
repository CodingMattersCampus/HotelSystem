<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Requests\Penalty;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class NewPenaltyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            "name"  => "required",
            "rate"  => "required|integer",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return Auth::guard('office')->check();
    }
}
