<?php

namespace App\Http\Controllers;

use App\Order;
use App\Partner;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with(["partner", "products"])
            ->paginate(10);

        return view("orders", ["orders" => $orders]);
    }

    public function show($id)
    {
        $order = Order::with("products")->findOrFail($id);
        $partners = Partner::all();
        return view("edit-order", ["order" => $order, "partners" => $partners]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "client_email" => "required|email",
            "partner" => "required|exists:partners,id",
            "status" => "required|in:0,10,20"
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            "status" => $request->get("status"),
            "client_email" => $request->get("client_email"),
            "partner_id" => $request->get("partner")
        ]);

        return back()->with('update-status', 'Изменения сохранены');

    }
}
