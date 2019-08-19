<?php

declare(strict_types = 1);

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

final class InventoryRemittance extends Model
{
    protected $guarded = [];

    public function product() : string
    {
        return Product::whereSku($this->sku)->first()->name ?? "";
    }
}
