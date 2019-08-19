<?php

namespace App\Models\Discount;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booking\Booking;

class SeniorCitizen extends Model
{
    protected $guarded = [];

    public function transaction() : string
    {
        return $this->created_at->format('Ymd') . str_pad((string)$this->id, 4, "0", STR_PAD_LEFT);
    }
}
