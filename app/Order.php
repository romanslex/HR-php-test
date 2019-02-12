<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    private $statuses = [
        0 => "новый",
        10 => "подтвержден",
        20 => "завершен"
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function products()
    {
        return $this
            ->belongsToMany(Product::class, "order_products")
            ->withPivot("price", "quantity");
    }

    public function getSum()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->quantity * $product->price;
        });
    }

    public function getProductsComposition()
    {
        return implode(", ", $this->products->map(function ($product) {
            return $product->name . ": " . $product->pivot->quantity;
        })->toArray());
    }

    public function getStatusString()
    {
        return $this->statuses[$this->status];
    }
}
