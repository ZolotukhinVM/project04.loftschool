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
        Mail::to(env('MAIL_ADMIN'))->send(new OrderCreated(Order::find($order->id)));
        return redirect()->route('order.list');
    }

    public function list()
    {

        $orders = Order::where('email', Auth::user()->email)->orderBy('id', 'desc')->paginate();
        return view('user.order.list', compact('orders'));
    }

    public function adminList()
    {
        $orders = Order::orderBy('id', 'desc')->paginate();
        return view('admin.order.list', compact('orders'));
    }
}
