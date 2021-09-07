@extends('layouts.app')

@section('content')

    <div class="col-12 mt-5 pt-5">
        <h2>新增會員等級</h2>

        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body mt-4">
                            <form class="border px-4 pt-2 pb-3" method="POST" action="{{ route('member-level-store') }}">
                                {{ csrf_field() }}
                                <div class="row d-flex justify-content-center">
                                    <div class="form-group col-12">
                                        <label for="name" class="col-form-label">會員等級名稱</label>
                                        <input id="name" type="text" name="name" value="" class="form-control" required>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="name_en" class="col-form-label">會員等級英文名稱</label>
                                        <input id="name_en" type="text" name="name_en" value="" class="form-control">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="level_up_line" class="col-form-label">升級金額</label>
                                        <input id="level_up_line" type="text" name="level_up_line" value="" class="form-control">
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
