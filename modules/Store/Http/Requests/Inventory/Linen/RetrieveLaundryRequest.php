<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Requests\Inventory\Linen;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class RetrieveLaundryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'linens' => 'required'
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

    public function message(): array
    {
        return [
            'linens.required' => 'Request table was empty',
        ];
    }
}
