<?php

namespace App\Http\Controllers;

use App\Order;
use App\ViewModels\OrdersViewModel;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(["partner", "products"])
            ->paginate(10);

        $vm = new OrdersViewModel($orders, $request->url());

        return view("orders", ["vm" => $vm]);
    }
}
