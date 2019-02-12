<?php

namespace App\ViewModels;

use Illuminate\Pagination\LengthAwarePaginator;

class OrdersViewModel
{
    /**
     * @var LengthAwarePaginator
     */
    public $orders;

    public function __construct($items, $path)
    {
        $this->orders = new LengthAwarePaginator($items->map(function ($item) {
            return [
                "id" => $item->id,
                "partnerName" => $item->partner->name,
                "sum" => $item->getSum(),
                "composition" => $item->getProductsComposition(),
                "status" => $item->getStatusString()
            ];
        }), $items->total(), $items->perPage());

        $this->orders->setPath($path);
    }
}