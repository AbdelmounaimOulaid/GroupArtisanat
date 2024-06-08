<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    public function show($id) {
        // $orders = Order::find($id); // Fetch all orders. Adjust this to your needs.
        // return view('order-detail', ['orders' => $orders]);
    }
}
