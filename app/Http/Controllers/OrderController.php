<?php

namespace App\Http\Controllers;

use App\Models\Message;
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
        $orders = Order::with('user')->orderBy('id', 'desc')->get();
        // $orders->nextPageUrl();
        // dd($orders);
        return view('layouts.order.index', compact('orders'))
            ->with('order_status', $this->order_status_array);
    }

    public function statusUpdate(Request $request)
    {
        // dd($request->all());
        $order = Order::find($request->order_id);
        // dd($order);
        $order['status'] = $request->status;
        $order->save();

        return redirect()->back();
    }

    public function detail($order_number)
    {
        // dd($order_number);
        $order = Order::with('orderItems')->with('coupon')->where('order_number', $order_number)->first();
        $messages = Message::where('order_id', $order['id'])->orderBy('created_at', 'asc')->get();
        $return_total = 0;
        if ($order['status'] > 4) {
            foreach ($order->orderItems as $orderItem) {
                if ($orderItem['is_return'] == 1) {
                    $return_total += ($orderItem['price'] * $orderItem['quantity']);
                }
            }
        }

        // dd($order);
        return view('layouts.order.detail', compact('order', 'messages', 'return_total'));
    }
}
