<?php

declare(strict_types = 1);

namespace App\Models\Cash;

use App\Models\User\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

final class Remittance extends Model
{
    protected $guarded = [];

    public function getRouteKeyName() : string
    {
        return 'code';
    }

    public function transaction() : string
    {
        return $this->created_at->format('Ymd') . str_pad((string)$this->id, 4, "0", STR_PAD_LEFT);
    }

    public function cashier() : string
    {
        return Employee::getNameByCode($this->cashier);
    }

    public function beginningTransaction() : string
    {
        return Carbon::make($this->getDrawer()->start_shift)->toDayDateTimeString();
    }

    public function endingTransaction() : string
    {
        return Carbon::make($this->getDrawer()->end_shift)->toDayDateTimeString();
    }

    public function expectedAmount()
    {
        return $this->amount;
    }

    public function remittedAmount()
    {
        return $this->remitted;
    }

    private function getDrawer() : Drawer
    {
        return Drawer::whereCode($this->drawer)->first();
    }

    public function getDeficitAttribute()
    {
        return ($this->remitted < $this->amount) ? ($this->remitted - $this->amount) : 0.00;
    }

    public function getExcessAttribute()
    {
        return ($this->remitted > $this->amount) ? ($this->remitted - $this->amount) : 0.00;
    }
}
