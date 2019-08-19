<?php

namespace App\Models\Inventory\Linen;

use Illuminate\Database\Eloquent\Model;
use App\Models\Room\Room;

class LinenTransaction extends Model
{
    protected $guarded = [];

    public function transaction() : string
    {
        return $this->created_at->format('Ymd') . str_pad((string)$this->id, 4, "0", STR_PAD_LEFT);
    }

    public function transactionOn() : string
    {
        return ucfirst($this->on);
    }

    public function getRoomName()
    {
        return $this->room;
    }

    public function inventory()
    {
        return ucfirst($this->on);
    }
}
