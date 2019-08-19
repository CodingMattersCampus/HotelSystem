<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class AttendanceRecordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            // 'attendance' => 'mimetypes:application/vnd.ms-excel',//dont work. -_-
            'from' => 'required|date',
            'to'   => 'required|date'
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

        ];
    }
}
