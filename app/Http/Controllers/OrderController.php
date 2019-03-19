<?php

namespace App\Http\Controllers;

use App\Order;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->all());
        Mail::to("ZolotukhinVM@ya.ru")->send(new OrderCreated(Order::find($order->id)));
        return redirect()->route('order.list');
    }

    public function list()
    {
        if (Auth::user()->level == 0) {
            $orders = Order::where('email', Auth::user()->email)->orderBy('id', 'desc')->paginate(10);
        } else {
            $orders = Order::orderBy('id', 'desc')->paginate(10);
        }
        return view('user.order.list', compact('orders'));
    }
}
