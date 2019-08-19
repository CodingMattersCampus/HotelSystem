<?php

declare(strict_types = 1);

namespace App\Models\Booking;

use App\Models\Penalty\Penalty;
use App\Models\User\Employee;
use Illuminate\Database\Eloquent\Model;

final class BookingPenalty extends Model
{
    protected $guarded = [];

    public function transaction() : string
    {
        return $this->created_at->format('Ymd') . str_pad((string)$this->id, 4, "0", STR_PAD_LEFT);
    }

    public function cashier() : string
    {
        return Employee::getNameByCode($this->cashier);
    }

    public function penalty() : string
    {
        return Penalty::getNameByCode($this->penalty);
    }
}
