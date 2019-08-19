<?php

namespace CodingMatters\Office\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordPurchaseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'or_number' => 'required|min:1'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user('office')->isActive();
    }
}
