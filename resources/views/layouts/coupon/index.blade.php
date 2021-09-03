@extends('layouts.app')

@section('content')

    <div class="table-responsive mt-5 pt-5">
        <div class="row justify-content-between">
            <h2>優惠管理</h2>
            <a href="{{ route('coupon-create') }}">新增優惠</a>
        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th></th>
                    <th>優惠名稱</th>
                    {{-- <th>優惠名稱（英文）</th> --}}
                    <th>優惠種類</th>
                    <th>優惠達成金額</th>
                    <th>優惠金額</th>
                    <th>狀態</th>
                    <th>選項</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $key => $coupon)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $coupon->name }}</td>
                        <td>{{ $coupon_types[$coupon->coupon_type] }}</td>
                        <td>$ {{ $coupon->coupon_line }}</td>
                        <td>$ {{ $coupon->coupon_amount }}</td>
                        <td>
                            <form class="form-horizontal" method="POST" action="{{ route('coupon-update-status') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="coupon_id" value="{{ $coupon['id'] }}">
                                <input type="hidden" class="status-{{ $coupon['id'] }}" id="status" name="status"
                                    value="{{ $coupon['status'] }}">
                                <select class="selectpicker" data-coupon-id="{{ $coupon['id'] }}">
                                    <option class="status" value="{{ $coupon['status'] }}">
                                        {{ $coupon_status[$coupon['status']] }}</option>
                                    @foreach ($coupon_status as $key => $status)
                                        @if ($coupon_status[$coupon['status']] != $status)
                                            <option class="status" value="{{ $key }}">{{ $status }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <button class="btn border" type="submit">更改</button>
                            </form>
                        </td>
                        <td><a class="btn border" href="{{ route('coupon-detail', $coupon['id']) }}">編輯</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        $('.selectpicker').on('change', function() {
            console.log($(this).attr('data-coupon-id'));
            var status_option = '.status-' + $(this).attr('data-coupon-id');
            console.log(status_option);
            $(status_option).val($(this).val());
        })
    </script>
@endsection
