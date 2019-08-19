<?php

namespace App\Models\Booking;

use Illuminate\Database\Eloquent\Model;

class ExtendHistory extends Model
{
    //
    protected $guarded = [];

    public function transaction() : string
    {
        return $this->created_at->format('Ymd') . str_pad((string)$this->id, 4, "0", STR_PAD_LEFT);
    }
}
