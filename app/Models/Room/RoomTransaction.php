<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Model;

class RoomTransaction extends Model
{
    protected $guarded = [];

    public function getRoomName()
    {
        return Room::where('code', $this->room)->first()->name;
    }
}
