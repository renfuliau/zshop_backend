@extends('layouts.app')

@section('content')

    <div class="table-responsive mt-5 pt-5">
        <div class="row justify-content-between">
            <h2>商品管理</h2>
            <a href="{{ route('product-create') }}">新增產品</a>
        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th></th>
                    <th>商品分類</th>
                    {{-- <th>商品圖片</th> --}}
                    <th>商品名稱</th>
                    <th>原價</th>
                    <th>特價</th>
                    <th>庫存量</th>
                    <th>狀態</th>
                    {{-- <th>編輯</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $product->category['title'] }}</td>
                        <td>{{ $product['title'] }}</td>
                        <td>$ {{ $product['price'] }}</td>
                        <td>$ {{ $product['special_price'] }}</td>
                        <td>{{ $product['stock'] }}</td>
                        <td>{{ $product_status[$product['status']] }}</td>
                        {{-- <td>{{ $product_status[$product['status']] }}</td> --}}
                        {{-- <td>
                            <form class="form-horizontal" method="POST" action="{{ route('order-update-status') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="order_id" value="{{ $product['id'] }}">
                                <input type="hidden" class="status-{{ $product['id'] }}" id="status" name="status"
                                    value="{{ $product['status'] }}">
                                <select class="selectpicker" data-order-id="{{ $product['id'] }}">
                                    <option class="status" value="{{ $product['status'] }}">
                                        {{ $product_status[$product['status']] }}</option>
                                    @foreach ($product_status as $key => $status)
                                        @if ($product_status[$product['status']] != $status)
                                            <option class="status" value="{{ $key }}">{{ $status }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <button class="btn border" type="submit">更改</button>
                            </form>
                        </td> --}}
                        {{-- <td><a class="btn border" href="{{ route('order-detail', $product['order_number']) }}">編輯</a></td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        $('.selectpicker').on('change', function() {
            console.log($(this).attr('data-order-id'));
            var status_option = '.status-' + $(this).attr('data-order-id');
            console.log(status_option);
            $(status_option).val($(this).val());
        })
    </script>
@endsection
