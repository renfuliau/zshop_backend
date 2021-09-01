@extends('layouts.app')

@section('content')
    <div class="col-12 mt-5 pt-5">
        <h2>編輯商品 - {{ $product['title'] }}</h2>

        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body mt-4">
                            <form class="border px-4 pt-2 pb-3" method="POST" action="{{ route('product-store') }}"
                                enctype="multipart/form-data" novalidate="novalidate">
                                {{ csrf_field() }}
                                <div class="row d-flex justify-content-center">
                                    <div class="form-group col-lg-12 col-12">
                                        <label for="Product Name">商品圖片(可一次上傳多張):</label>
                                        <input type="file" class="form-control" name="photos[]" multiple />
                                        @foreach ($product->productImg as $img)
                                            <img class="w-25 py-2" src="{{ $img['filepath'] }}" alt="{{ $img['filepath'] }}">
                                            <button>刪除</button>
                                        @endforeach
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="category_id" class="col-form-label">商品類別</label>
                                        <input id="category_id" type="hidden" name="category_id"
                                            value="{{ $product['category_id'] }}" class="form-control">
                                        <select class="category-picker">
                                            <option class="category" value="{{ $product['category_id'] }}">
                                                {{ $product->category['title'] }}</option>
                                            @foreach ($categories as $key => $category)
                                                @if ($category['is_parent'] && $category['id'] != $product['category_id'])
                                                    <option class="category" value="{{ $category['id'] }}">
                                                        {{ $category['title'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="title" class="col-form-label">商品名稱</label>
                                        <input id="title" type="text" name="title" value="" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6 col-12">
                                        <label for="slug" class="col-form-label">型號</label>
                                        <input id="slug" type="text" name="slug" value="" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="summary" class="col-form-label">商品簡述</label>
                                        <input id="summary" type="text" name="summary" value="" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="stock" class="col-form-label">庫存</label>
                                        <input id="stock" type="text" name="stock" value="" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="size" class="col-form-label">尺碼</label>
                                        <input id="size" type="text" name="size" value="" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="price" class="col-form-label">原價</label>
                                        <input id="price" type="text" name="price" value="" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="special_price" class="col-form-label">特價</label>
                                        <input id="special_price" type="text" name="special_price" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="description" class="col-form-label">商品描述</label>
                                        <textarea id="description" type="text" name="description" value=""
                                            class="form-control">
                                                        </textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">送出</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2>庫存管理</h2>
        <h6>現有庫存：{{ $product['stock'] }}</h6>

        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body mt-4">
                            <form class="border px-4 pt-2 pb-3" method="POST"
                                action="{{ route('member-update-reward-money', $product->id) }}">
                                {{ csrf_field() }}
                                <div class="row d-flex justify-content-center">
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="inputTitle" class="col-form-label">調整原因</label>
                                        <input id="inputTitle" type="text" name="reward_item" placeholder="" value=""
                                            class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6 col-12">
                                        <label for="inputAmount" class="col-form-label">金額</label>
                                        <input id="inputAmount" type="number" name="amount" placeholder="" value=""
                                            class="form-control">
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

@push('scripts')
    <script>
        $('.qa-button').click(function() {
            console.log('hi');
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
    </script>
@endpush
