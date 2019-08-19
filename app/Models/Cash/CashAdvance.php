<?php

namespace App\Models\Cash;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\Employee;

class CashAdvance extends Model
{
    protected $guarded = [];

    public function transaction() : string
    {
        return $this->created_at->format('Ymd') . str_pad((string)$this->id, 4, "0", STR_PAD_LEFT);
    }

    public function cashier() : string
    {
        return isset($this->cashier) ? Employee::getNameByCode($this->cashier) : 'Not withdrawn yet';
    }

    public function employee() : string
    {
        return Employee::getNameByCode($this->employee);
    }
}
