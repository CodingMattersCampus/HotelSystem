<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Requests\User\Profile;

use CodingMatters\Booking\Rules\CurrentPasswordValidation;
use Illuminate\Foundation\Http\FormRequest;

final class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'new_password'      => "confirmed|required|min:6",
            'current_password'  => [
                "required",
                new CurrentPasswordValidation,
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return $this->user()->isActive();
    }
}
