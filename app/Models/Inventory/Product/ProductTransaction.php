<?php

declare(strict_types = 1);

namespace App\Models\Inventory\Product;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Employee;

final class ProductTransaction extends Model
{
    protected $guarded = [];

    public function user() : string
    {
        return Employee::whereCode($this->user)->first()->fullName ?? User::whereCode($this->user)->first()->fullName;
    }

    public function transaction() : string
    {
        return $this->created_at->format('Ymd') . str_pad((string)$this->id, 4, "0", STR_PAD_LEFT);
    }
}
