@extends('layouts.app')

@section('content')

<h2>訂單管理</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        @if (! $orders->isEmpty())
        <thead>
            <tr>
                <th></th>
                <th>日期</th>
                <th>訂單編號</th>
                <th>會員帳號</th>
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
                        <input type="hidden" id="status" name="status" value="{{ $order['status'] }}">
                        <select class="selectpicker">
                            <option class="status" value="{{ $order['status'] }}">
                                {{ $order_status[$order['status']] }}</option>
                            @foreach ($order_status as $key => $status)
                            @if ($order_status[$order['status']] != $status)
                            <option class="status" value="{{ $key }}">{{ $status }}</option>
                            @endif
                            @endforeach
                        </select>
                        <button class="btn" type="submit">更改</button>
                    </form>
                </td>
                <td><a class="btn" href="{{route('order-detail', $order['order_number'])}}">明細</a></td>
            </tr>
            @endforeach
        </tbody>
        @endif

    </table>
    <div class="pagination">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<script>
    $('.selectpicker').on('change', function () {
        $('#status').val($(this).val());
        // console.log($('.selectpicker').val());
    })
</script>
@endsection