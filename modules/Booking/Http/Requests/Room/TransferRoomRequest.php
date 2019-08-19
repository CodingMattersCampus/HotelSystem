<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

final class TransferRoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'current'       => 'required',
            'room'          => 'required',
            'booking-rate'  => 'required|numeric',
            'reset-time'    => 'required|numeric',
            'reason'        => 'required',
            'cash'          => 'required|numeric',
            'change'        => 'required_with:cash|numeric',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return $this->user('booking')->isActive() && $this->user('booking')->isCashierOnDuty();
    }
}
