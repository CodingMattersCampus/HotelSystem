<?php

namespace App\Models\Booking;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\Employee;
use App\Models\Room\Room;

class Transfers extends Model
{
    protected $guarded = [];

    public function transaction() : string
    {
        return $this->created_at->format('Ymd') . str_pad((string)$this->id, 4, "0", STR_PAD_LEFT);
    }

    public function employee() : string
    {
        return Employee::getNameByCode($this->employee);
    }
}
