@extends('layouts.app')

@section('content')

    <div class="col-12 mt-5 pt-5">
        <h2>新增優惠</h2>

        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body mt-4">
                            <form class="border px-4 pt-2 pb-3" method="POST" action="{{ route('coupon-store') }}">
                                {{ csrf_field() }}
                                <div class="row d-flex justify-content-center">
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="coupon_type" class="col-form-label">優惠種類</label>
                                        <input id="coupon_type" type="hidden" name="coupon_type" value="1"
                                            class="form-control" required>
                                        <select class="coupon-type-picker">
                                            @foreach ($coupon_types as $key => $coupon_type)
                                                <option class="coupon_type" value="{{ $key }}">
                                                    {{ $coupon_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="form-group col-12">
                                        <label for="name_en" class="col-form-label">優惠英文名稱</label>
                                        <input id="name_en" type="text" name="name_en" value="" class="form-control">
                                    </div> --}}
                                    <div class="form-group col-12">
                                        <label for="name" class="col-form-label">優惠名稱</label>
                                        <input id="name" type="text" name="name" value="" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="coupon_line" class="col-form-label">優惠達成金額</label>
                                        <input id="coupon_line" type="text" name="coupon_line" value=""
                                            class="form-control" required>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="coupon_amount" class="col-form-label">優惠金額</label>
                                        <input id="coupon_amount" type="text" name="coupon_amount" value=""
                                            class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">送出</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.coupon-type-picker').on('change', function() {
            $('#coupon_type').val($(this).val());
        })
    </script>
@endsection
