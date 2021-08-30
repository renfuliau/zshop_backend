@extends('layouts.app')

@section('content')
<h2>訂單管理</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        @if (! $orders->isEmpty())
        <thead>
            <tr>
                <th>日期</th>
                <th>訂單編號</th>
                <th>訂單狀態</th>
                <th>訂單明細</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order['created_at'] }}</td>
                <td>{{ $order['order_number'] }}</td>
                <td>{{ $order_status[$order['status']] }}</td>
                <td><a class="btn" href="{{route('order-detail', $order['order_number'])}}">明細</a></td>
            </tr>
            @endforeach
        </tbody>
        @endif
        
    </table>
</div>
@endsection
