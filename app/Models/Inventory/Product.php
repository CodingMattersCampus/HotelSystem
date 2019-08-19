<?php

declare(strict_types = 1);

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'sku';
    }

    public function brandName() : string
    {
        $brand = $this->belongsTo(Brand::class, 'brand_id')->first();
        return $brand->name;
    }

    public function isActive() : bool
    {
        return $this->hasAvailableStocks() && $this->hasPrice() && $this->hasBrand();
    }

    private function hasAvailableStocks(): bool
    {
        return $this->stocks > 0 && $this->stocks > $this->max_threshold;
    }

    private function hasPrice(): bool
    {
        return $this->price > 0;
    }

    private function hasBrand(): bool
    {
        return $this->brand_id > 0;
    }

    public function deductFromStocks(int $amount = 0) : void
    {
        $this->stocks -= $amount;
        $this->save();
    }

    public function updatePrice(float $newCost = 0): float
    {
        $this->cost = $newCost;
        $newprice = ceil($newCost + ($newCost * $this->profit_margin));
        if ($this->price < $newprice) {
            $this->price = $newprice;
            $this->save();
        }
        return $newprice;
    }

    public function isSet(): bool
    {
        return ! is_null($this->set_type) && $this->set_quantity > 1;
    }

    public function storedAt() : string
    {
        return ucfirst($this->for);
    }

    public function reStock(int $amount = 0): void
    {
        $this->stocks += $amount;
        $this->save();
    }
}
