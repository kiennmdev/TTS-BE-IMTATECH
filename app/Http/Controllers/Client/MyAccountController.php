<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function index() {

        $userID = Auth::user()->id;

        $statusOrder = Order::STATUS_ORDER;

        $statusPayment = Order::STATUS_PAYMENT;
        // dd($statusOrder);
        $ordersAll = Order::query()->where('user_id', '=', $userID)->latest('id')->get();

        $ordersPending = Order::query()->where('user_id', '=', $userID)->where('status_order', 'pending')->latest('id')->get();

        $ordersConfirmed = Order::query()->where('user_id', '=', $userID)->where('status_order', 'confirmed')->latest('id')->get();
        
        $ordersPreparingGoods = Order::query()->where('user_id', '=', $userID)->where('status_order', 'preparing_goods')->latest('id')->get();
        
        $ordersShipping = Order::query()->where('user_id', '=', $userID)->where('status_order', 'shipping')->latest('id')->get();
        
        $ordersDelivered = Order::query()->where('user_id', '=', $userID)->where('status_order', 'delivered')->latest('id')->get();
        
        $ordersCanceled = Order::query()->where('user_id', '=', $userID)->where('status_order', 'canceled')->latest('id')->get();

        return view('client.my-account', compact('statusOrder','statusPayment','ordersAll', 'ordersPending', 'ordersConfirmed', 'ordersPreparingGoods', 'ordersShipping', 'ordersDelivered', 'ordersCanceled'));
    }
}
