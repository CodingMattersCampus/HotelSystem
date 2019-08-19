<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Requests\Inventory\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class EditProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            // 'orderable'     => 'boolean',
            // 'consumable'    => 'boolean',
            'toggle'        => 'array',
            'min_threshold' => 'integer',
            'max_threshold' => 'integer',
            // 'profit_margin' => 'float',
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
