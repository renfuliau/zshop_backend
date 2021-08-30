<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order_status_array;

    public function __construct()
    {
        $this->order_status_array = [
            0 => '訂單取消',
            1 => '訂單處理中',
            2 => '訂單已確認',
            3 => '出貨中',
            4 => '訂單完成',
            5 => '退貨處理中',
            6 => '退貨完成',
        ];
    }

    public function index()
    {
        $orders = Order::limit(10)->orderBy('id', 'desc')->get();
        // dd($order);
        return view('layouts.order.orders-index', compact('orders'))
        ->with('order_status', $this->order_status_array);
    }
}
