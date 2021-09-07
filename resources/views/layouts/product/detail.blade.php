@extends('layouts.app')

@section('content')
    <div class="col-12 mt-5 pt-5">
        <h2>編輯商品 - {{ $product['title'] }}</h2>

        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body mt-4">
                            <form class="border px-4 pt-2 pb-3" method="POST" action="{{ route('product-update') }}"
                                enctype="multipart/form-data" novalidate="novalidate">
                                {{ csrf_field() }}
                                <input type="hidden" id="product_id" name="product_id" value="{{ $product['id'] }}">
                                <div class="row d-flex justify-content-center">
                                    <div class="form-group col-12">
                                        <label for="product_imgs">商品圖片(可一次上傳多張):</label>
                                        <input type="file" class="form-control" name="photos[]" multiple />
                                        <div class="row">
                                            @foreach ($product->productImg as $img)
                                                {{-- <img class="w-25 py-2" src="{{ $img['filepath'] }}" alt="{{ $img['filepath'] }}">
                                            <a class="btn border img-remove" data-product-img-id="{{ $img['id'] }}">刪除</a> --}}
                                                <div class="col-4">
                                                    <img class="w-100 py-2" src="{{ $img['filepath'] }}"
                                                        alt="{{ $img['filepath'] }}">
                                                    <a class="btn border img-remove"
                                                        data-product-img-id="{{ $img['id'] }}">刪除</a>
                                                    <label for="img_sort">圖片排序(數字越大，排序越前面)):</label>
                                                    <input class="sort-input" type="number" value="{{ $img['sort'] }}"
                                                        data-product-img-id="{{ $img['id'] }}">
                                                    <a class="btn border img-sort-button{{ $img['id'] }} sort-button"
                                                        data-product-img-id="{{ $img['id'] }}"
                                                        data-product-img-sort="{{ $img['sort'] }}">送出</a>
                                                </div>
                                            @endforeach
                                        </div>
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
                                        <input id="title" type="text" name="title" value="{{ $product['title'] }}"
                                            class="form-control" place-holder="商品名稱">
                                    </div>

                                    <div class="form-group col-lg-6 col-12">
                                        <label for="slug" class="col-form-label">型號</label>
                                        <input id="slug" type="text" name="slug" value="{{ $product['slug'] }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="summary" class="col-form-label">商品簡述</label>
                                        <input id="summary" type="text" name="summary" value="{{ $product['summary'] }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="stock" class="col-form-label">庫存</label>
                                        <input id="stock" type="text" name="stock" value="{{ $product['stock'] }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="size" class="col-form-label">尺碼</label>
                                        <input id="size" type="text" name="size" value="{{ $product['size'] }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="price" class="col-form-label">原價</label>
                                        <input id="price" type="text" name="price" value="{{ $product['price'] }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="special_price" class="col-form-label">特價</label>
                                        <input id="special_price" type="text" name="special_price"
                                            value="{{ $product['special_price'] }}" class="form-control">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="description" class="col-form-label">商品描述</label>
                                        <input id="description" type="text" name="description"
                                            value="{{ $product['description'] }}" class="form-control">
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
        $('.img-remove').on('click', function() {
            // console.log(this.getAttribute("data-productid"));
            var img_id = this.getAttribute("data-product-img-id");
            // var product_id = this.getAttribute("data-product_id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/admin/product-img-delete',
                data: {
                    id: img_id,
                },
                success: function(response) {
                    // document.location.reload(true);
                    // console.log(response);
                    alert(response);
                    document.location.reload(true);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus + " " + errorThrown);
                    // console.error(textStatus + " " + errorThrown);
                }
            });
        })

        $('.sort-input').on('change', function() {
            var img_id = this.getAttribute("data-product-img-id");
            var button_name = '.img-sort-button' + img_id;
            $(button_name).attr('data-product-img-sort', $(this).val());
        })

        $('.sort-button').click(function() {
            var img_id = this.getAttribute("data-product-img-id");
            var img_sort = this.getAttribute("data-product-img-sort");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/admin/product-sort-update',
                data: {
                    id: img_id,
                    sort: img_sort,
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
