<?php

declare(strict_types = 1);

namespace App\Models\Cash;

use Illuminate\Database\Eloquent\Model;

final class CashTransaction extends Model
{
    protected $guarded = [];

    public function transaction() : string
    {
        return $this->created_at->format('Ymd') . str_pad((string)$this->id, 4, "0", STR_PAD_LEFT);
    }
}
