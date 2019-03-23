<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function order(Request $request)
    {
        if ($request->ajax == 1) {
            $order = new Order;
            $order->product_id = $request->id;
            $order->name = \Auth::user()->name;
            $order->email = \Auth::user()->email;
            $order->save();
        }
    }
}
