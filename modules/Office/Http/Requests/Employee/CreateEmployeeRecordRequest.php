<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class CreateEmployeeRecordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'first_name'    => "required|min:1",
            'last_name'     => "required|min:1",
            'middle_name'   => "nullable|min:1",
            'birthdate'    => "required",
            'contact_number' => "required",
            'date_employed' => "required",
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

    public function messages()
    {
        return [
            'first_name.required' => 'Required',
            'last_name.required'  => 'Required',
            'birthdate.required'  => 'Required',
            'contact_number.required'  => 'Required',
            'date_employed.required'  => 'Required',
        ];
    }
}
