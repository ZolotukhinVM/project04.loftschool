<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'max:50|required',
            'email' => 'email|required'
        ]);
        Order::create($request->all());
        Mail::to("ZolotukhinVM@ya.ru")->send(new OrderCreated($request));
        return redirect()->route('order.list');
    }

    public function list()
    {
        if (Auth::user()->level == 0) {
            $order = Order::where('email', Auth::user()->email)->orderBy('id', 'desc')->paginate(10);
        } else {
            $order = Order::orderBy('id', 'desc')->paginate(10);
        }
        return view('user.order.list', ['orders' => $order]);
    }
}
