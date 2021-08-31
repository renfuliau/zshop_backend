@extends('layouts.app')

@section('content')

    <div class="col-12 mt-5 pt-5">
        <h2>會員詳細資料</h2>

        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body mt-4">
                            <form class="border px-4 pt-2 pb-3" method="POST" action="{{ route('product-store') }}">
                                {{ csrf_field() }}
                                <div class="row d-flex justify-content-center">
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="category_id" class="col-form-label">商品類別</label>
                                        <input id="category_id" type="hidden" name="category_id" value="1"
                                            class="form-control">
                                        <select class="category-picker">
                                            @foreach ($categories as $key => $category)
                                                @if ($category['is_parent'])
                                                <option class="category" value="{{ $category['id'] }}">
                                                    {{ $category['title'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="title" class="col-form-label">商品名稱</label>
                                        <input id="title" type="text" name="title" value=""
                                            class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6 col-12">
                                        <label for="slug" class="col-form-label">型號</label>
                                        <input id="slug" type="text" name="slug" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="summary" class="col-form-label">商品簡述</label>
                                        <input id="summary" type="text" name="summary" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="stock" class="col-form-label">庫存</label>
                                        <input id="stock" type="text" name="stock" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="size" class="col-form-label">尺碼</label>
                                        <input id="size" type="text" name="size" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="price" class="col-form-label">原價</label>
                                        <input id="price" type="text" name="price" value=""
                                            class="form-control">
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
    </div>
@endsection

@push('scripts')
    <script>
        $('.category-picker').on('change', function() {
            $('#category').val($(this).val());
        })
    </script>
@endpush