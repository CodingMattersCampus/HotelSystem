<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

final class BookRoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'booking_rate'   => "required|numeric",
            'rate_type'      => "required",
            'total_amount'   => "required|numeric",
            'cash'           => "required|numeric",
            'plate'          => "nullable|string",
            'driver'         => "required_with:plate",
            'sc_first_name'  => "required_with:sc_id",
            'sc_middle_name' => "nullable|string",
            'sc_last_name'   => "required_with:sc_id",
            'sc_id'          => "nullable|string"
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
