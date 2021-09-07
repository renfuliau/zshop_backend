@extends('layouts.app')

@section('content')

    <div class="table-responsive mt-5 pt-5">
        <h2>訂單管理</h2>
        {{-- <select class="filterpicker">
            <option class="status" value=""></option>
            @foreach ($order_status as $key => $status)
                <option class="status" value="{{ $key }}">{{ $status }}</option>
            @endforeach
        </select> --}}
        <table class="table table-striped table-sm">
            @if (!$orders->isEmpty())
                <thead>
                    <tr>
                        <th></th>
                        <th>日期</th>
                        <th>會員帳號</th>
                        <th>訂單編號</th>
                        <th>訂單金額</th>
                        <th>訂單狀態</th>
                        <th>訂單明細</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $order['created_at'] }}</td>
                            <td>{{ $order->user['email'] }}</td>
                            <td>{{ $order['order_number'] }}</td>
                            <td>$ {{ $order['total'] }}</td>
                            {{-- <td>{{ $order_status[$order['status']] }}</td> --}}
                            <td>
                                <form class="form-horizontal" method="POST" action="{{ route('order-update-status') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="order_id" value="{{ $order['id'] }}">
                                    <input type="hidden" class="status-{{ $order['id'] }}" id="status" name="status"
                                        value="{{ $order['status'] }}">
                                    @if ($order['status'] == 0 || $order['status'] == 4 || $order['status'] == 6)
                                        <span>{{ $order_status[$order['status']] }}</span>
                                    @elseif ($order['status'] > 0 && $order['status'] <= 5) <select
                                            class="selectpicker" data-order-id="{{ $order['id'] }}">
                                            <option class="status" value="{{ $order['status'] }}">
                                                {{ $order_status[$order['status']] }}</option>
                                            <option class="status" value="{{ $order['status'] + 1 }}">
                                                {{ $order_status[$order['status'] + 1] }}</option>
                                            {{-- @foreach ($order_status as $key => $status)
                                                @if ($order_status[$order['status']] != $status)
                                                    <option class="status" value="{{ $key }}">
                                                        {{ $status }}</option>
                                                @endif
                                            @endforeach --}}
                                            </select>
                                            <button class="btn border" type="submit">更改</button>
                                    @endif
                                </form>
                            </td>
                            <td><a class="btn border"
                                    href="{{ route('order-detail', $order['order_number']) }}">明細</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
        <span>{{ $orders->links() }}</span>
    </div>

@endsection

@section('scripts')
    <script>
        // $('.filterpicker').on('change', function() {
        //     // console.log($(this).attr('data-order-id'));
        //     var status_option = $(this).val();
        //     console.log(status_option);
        //     // $(status_option).val($(this).val());
        // })
        $('.selectpicker').on('change', function() {
            console.log($(this).attr('data-order-id'));
            var status_option = '.status-' + $(this).attr('data-order-id');
            console.log(status_option);
            $(status_option).val($(this).val());
        })
    </script>
@endsection
