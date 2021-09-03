@extends('layouts.app')

@section('content')
    {{-- <div class="container"> --}}
    {{-- <div class="row"> --}}
    <div class="col-12 mt-5 pt-5">
        <h2>訂單明細 - {{ $order['order_number'] }}</h2>
        <input type="hidden" name="member-id" id="member-id" class="member-id" value="{{ $order['user_id'] }}">
        <input type="hidden" name="order-id" id="order-id" class="order-id" value="{{ $order['id'] }}">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th class="text-center">商品名稱</th>
                        <th class="text-center">單價</th>
                        <th class="text-center">數量</th>
                        <th class="text-center">小計</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $orderItem)
                        <tr>
                            @if ($orderItem['is_return'] == 0)
                                <td class="product-des text-center" data-title="Description">
                                    <p class="product-name">{{ $orderItem->product['title'] }}</p>
                                </td>
                                <td class="price text-center" data-title="Price">
                                    <span>$ {{ $orderItem->price }}</span>
                                </td>
                                <td class="qty text-center" data-title="Qty">
                                    <span>{{ $orderItem->quantity }}</span>
                                </td>
                                <td class="cart_single_price text-right" data-title="Total">
                                    <span class="money pr-4">$
                                        {{ $orderItem->price * $orderItem->quantity }}</span>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="single-widget col-12 mb-5 pb-5">
                <div class="content">
                    <ul>
                        <li class="reward_money last text-right">使用購物金：
                            @if (!$order->reward_money)
                                <span>$ 0</span>
                            @else
                                <span>$ -{{ $order->reward_money }}</span>
                            @endif
                        </li>
                        @if (!empty($order->coupon) && $order->coupon['coupon_type'] == 1)
                            <li class="coupon text-right">優惠：
                                {{ $order->coupon['name'] }}<span>$
                                    -{{ $order->coupon['coupon_amount'] }}</span></li>
                            <li class="total last text-right" id="order_total_price">總計<span>$ {{ $order->total }}</span>
                            </li>
                        @else
                            <li class="total last text-right" id="order_total_price">總計<span>$ {{ $order->total }}</span>
                            </li>
                            @if (!empty($order->coupon) && $order->coupon['coupon_type'] == 2)
                                <li class="coupon text-right">優惠：{{ $order->coupon['name'] }}<span>$
                                        {{ $order->coupon['coupon_amount'] }}</span></li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-12 border p-4">
                <h5 class="text-center mb-4">收件人資訊</h5>
                <p class="pl-5">收件人姓名：
                    <span class="order-name">{{ $order->name }}</span>
                </p>
                <p class="pl-5">收件人電話：
                    <span class="order-phone">{{ $order->phone }}</span>
                </p>
                <p class="pl-5">收件人住址：
                    <span class="order-address">{{ $order->address }}</span>
                </p>
            </div>
            <div class="col-lg-6 col-12 border p-4">
                {{ csrf_field() }}
                <h5 class="text-center mb-4">訂單問答</h5>
                @if (!empty($messages))
                    @foreach ($messages as $message)
                        @switch($message['subject'])
                            @case(1)
                                <div class="text-right border p-2 m-2">
                                    <h6>{{ $message['message'] }} :Q</i></h6>
                                </div>
                            @break

                            @case(2)
                                <div class="text-left border p-2 m-2">
                                    <h6>A: {{ $message['message'] }}</h6>
                                </div>
                            @break
                        @endswitch
                    @endforeach
                @endif
                <input class="w-100 text-center" type="text" name="question" id="question" placeholder="輸入回覆內容">
                <div class="text-center mt-2">
                    <button class="btn border qa-button">送出</button>
                </div>
            </div>

            @if ($order['status'] > 4)
                {{-- <h5 class="py-3 text-center">退貨</h5> --}}

                <table class="table shopping-summery bg-danger" style="height: auto;">
                    <thead>
                        <tr class="main-hading">
                            <h5 class="py-3 text-center">退貨明細</h5>

                            <th class="col-4 text-center">商品名稱</th>
                            <th class="text-center">單價</th>
                            <th class="text-center">數量</th>
                            <th class="text-center">小計</th>
                        </tr>
                    </thead>
                    <tbody id="cart_item_list">
                        @foreach ($order->orderItems as $orderItem)
                            @if ($orderItem['is_return'] == 1)
                                <tr>
                                    <td class="product-des text-center" data-title="Description">
                                        <p class="product-name">{{ $orderItem->product['title'] }}
                                        </p>
                                    </td>
                                    <td class="price text-center" data-title="Price">
                                        <span>$ {{ $orderItem->price }}</span>
                                    </td>
                                    <td class="qty text-center" data-title="Qty">
                                        <span>{{ $orderItem->quantity }}</span>
                                    </td>
                                    <td class="cart_single_price text-right" data-title="Total">
                                        <span class="money pr-4">$
                                            {{ $orderItem->price * $orderItem->quantity }}</span>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="single-widget col-12 mb-5 pb-5">
                    <div class="content">
                        <ul>
                            @if ($order['subtotal'] == $return_total)
                                @if (!empty($order->coupon) && $order->coupon['coupon_type'] == 1)
                                    <li class="coupon text-right">優惠取消：
                                        {{ $order->coupon['name'] }}<span>$
                                            -{{ $order->coupon['coupon_amount'] }}</span></li>
                                    <li class="total last text-right" id="order_total_price">
                                        退款金額<span>$
                                            {{ $order['total'] + $order->reward_money }}</span>
                                    </li>
                                @else
                                    @if (!empty($order->coupon) && $order->coupon['coupon_type'] == 2)
                                        <li class="coupon text-right">
                                            優惠取消：
                                            {{ $order->coupon['name'] }}<span>$
                                                -{{ $order->coupon['coupon_amount'] }}</span></li>
                                        <li class="total last text-right" id="order_total_price">
                                            退款金額<span>$
                                                {{ $order->subtotal - $order->coupon['coupon_amount'] }}</span></li>
                                    @else
                                        <li class="total last text-right" id="order_total_price">
                                            退款金額<span>$
                                                {{ $order->subtotal }}</span></li>
                                    @endif

                                @endif

                            @elseif (!empty($order->coupon) && $order->coupon['coupon_type'] == 1 &&
                                $order['subtotal'] - $return_total < $order->coupon['coupon_line'])
                                    <li class="coupon text-right">優惠取消：
                                        {{ $order->coupon['name'] }}<span>$
                                            -{{ $order->coupon['coupon_amount'] }}</span></li>
                                    {{-- <li class="reward_money">使用購物金： <span>$ -{{ $order->reward_money }}</span></li> --}}
                                    <li class="total last text-right" id="order_total_price">
                                        退款金額<span>$
                                            {{ $return_total - $order->coupon['coupon_amount'] }}</span>
                                    </li>
                                @else
                                    {{-- <li class="reward_money">使用購物金： <span>$ -{{ $order->reward_money }}</span></li> --}}
                                    <li class="total last text-right" id="order_total_price">
                                        退款金額<span>$ {{ $return_total }}</span></li>
                                    @if (!empty($order->coupon) && $order->coupon['coupon_type'] == 2)
                                        <li class="coupon text-right">
                                            優惠取消：
                                            {{ $order->coupon['name'] }}<span>$
                                                -{{ $order->coupon['coupon_amount'] }}</span></li>
                                    @endif
                            @endif
                        </ul>
                    </div>
                </div>

                @if ($order['status'] == 5)
                    <div class="text-center mt-2">
                        <button class="btn border return-btn">退貨</button>
                    </div>
                @endif

                @if ($order['status'] == 6)
                    <h3 class="text-primary text-center">退貨完成</h3>
                @endif
            @endif
        </div>
    </div>
    {{-- </div> --}}
    {{-- </div> --}}

@endsection

@section('scripts')
    <script>
        $('.qa-button').click(function() {
            var member_id = $('.member-id').val();
            console.log(member_id);
            var order_name = $('.order-name').text();
            var order_phone = $('.order-phone').text();
            var order_id = $('#order-id').val();
            var message = $('#question').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/admin/order-message/store',
                data: {
                    user_id: member_id,
                    name: order_name,
                    phone: order_phone,
                    order_id: order_id,
                    message: message,
                },
                success: function(res) {
                    alert(res['message']);
                    document.location.reload(true);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        })

        $('.return-btn').click(function() {
            var order_id = $('#order-id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/admin/order-return-confirm',
                data: {
                    order_id: order_id,
                },
                success: function(res) {
                    alert(res);
                    document.location.reload(true);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        })
    </script>
@endsection