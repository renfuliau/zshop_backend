@extends('layouts.app')

@section('content')
    <div class="col-12 mt-5 pt-5">
        <h2>編輯會員等級 - {{ $member_level['name'] }}</h2>

        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body mt-4">
                            <form class="border px-4 pt-2 pb-3" method="POST" action="{{ route('member-level-update', $member_level->id) }}">
                                {{ csrf_field() }}
                                <input type="hidden" id="member_level_id" name="member_level_id" value="{{ $member_level['id'] }}">
                                <div class="row d-flex justify-content-center">
                                    <div class="form-group col-12">
                                    <div class="form-group col-12">
                                        <label for="name" class="col-form-label">會員等級名稱</label>
                                        <input id="name" type="text" name="name" value="{{ $member_level['name'] }}"
                                            class="form-control">
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="name_en" class="col-form-label">會員等級英文名稱</label>
                                        <input id="name_en" type="text" name="name_en" value="{{ $member_level['name_en'] }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="level_up_line" class="col-form-label">升級金額</label>
                                        <input id="level_up_line" type="text" name="level_up_line" value="{{ $member_level['level_up_line'] }}"
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
