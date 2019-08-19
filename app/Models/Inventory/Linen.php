<?php

declare(strict_types = 1);

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

final class Linen extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function availableStocks()
    {
        return $this->stocks - ($this->laundry + $this->rooms);
    }

    public function addRoomsCount(int $count = 0) : void
    {
        $this->rooms += $count;
        $this->save();
    }

    //From room to laundry
    public function toLaundry(int $count = 0) : void
    {
        $this->rooms -= $count;
        $this->addLaundryCount($count);
    }

    //retrieve stock from laundry
    public function retrieveLaundry(int $count = 0) : int
    {
        $onlyRemoved = ($count > $this->laundry) ? $this->laundry : $count;
        $this->laundry -= $onlyRemoved;
        $this->save();
        return $onlyRemoved;
    }

    //if something new then get to laundry
    public function addLaundryCount(int $count = 0) : void
    {
        $this->laundry += $count;
        $this->save();
    }
}
