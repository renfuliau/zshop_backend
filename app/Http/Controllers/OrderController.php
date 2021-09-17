<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Order;
use App\Models\Message;
use App\Models\OrderItem;
use App\Models\RewardMoneyHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $orders = Order::with('user')->orderBy('id', 'desc')->paginate(15);
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
        if($order->save()) {
            $request->session()->flash('alert-success', '變更狀態成功');
            return redirect()->back();
        }

        $request->session()->flash('alert-danger', '變更狀態失敗');
        return redirect()->back();
    }

    public function detail($order_number)
    {
        // dd($order_number);
        $order = Order::with('orderItems')->with('coupon')->with('returnOrders')->where('order_number', $order_number)->first();
        $messages = Message::where('order_id', $order['id'])->orderBy('created_at', 'asc')->get();
        $return_total_array = [];
        if ($order['status'] > 4) {
            foreach ($order->returnOrders as $returnOrder) {
                $return_total = 0;
                foreach ($returnOrder->orderItems as $orderItem) {
                    $return_total += ($orderItem['price'] * $orderItem['quantity']);
                }
                array_push($return_total_array, $return_total);
            }
        }

        // dd($order);
        return view('layouts.order.detail', compact('order', 'messages', 'return_total_array'));
    }

    public function messageStore(Request $request)
    {
        // dd($request->all());
        // $user_id = Auth::user()->id;
        $message = new Message();
        $message_data = $request->all();
        $message_data['subject'] = 2;
        $message->fill($message_data);
        // dd($message);
        $message->save();

        return response(['message' => '回覆成功']);
    }

    public function returnConfirm(Request $request)
    {
        $order = Order::with('returnOrders')->find($request->order_id);
        $return_total = Order::getReturnOrderTotal($request->order_id, $request->return_order_id);
        // dd($return_total);
        $user = User::find($order->user_id);
        $refund = $return_total;
        if ($order->coupon) {
            if ($order->coupon['coupon_type'] == 1) {
                if ($order['subtotal'] - $return_total < $order->coupon['coupon_line']) {
                    $refund = $return_total - $order->coupon['coupon_amount'];
                }
            }
        }

        $user['reward_money'] += $refund;
        $user->save();

        $reward_history = new RewardMoneyHistory();
        $reward_history['user_id'] = $user['id'];
        $reward_history['reward_item'] = $order['order_number'] . '，訂單退款';
        $reward_history['amount'] = $refund;
        $reward_history['total'] = $user['reward_money'];
        $reward_history->save();

        // dd($order->returnOrders);
        $no_refund_order_amount = 0;
        foreach ($order->returnOrders as $returnOrder) {
            if ($returnOrder['id'] == $request->return_order_id) {
                $returnOrder['is_refund'] = 1;
                $returnOrder->save();
            }
            if ($returnOrder['is_refund'] == 0) {
                $no_refund_order_amount += 1;
            }
        }
        if ($no_refund_order_amount == 0) {
            $order['status'] = 6;
            $order->save();
        }
        return response('退貨完成');
    }
}
