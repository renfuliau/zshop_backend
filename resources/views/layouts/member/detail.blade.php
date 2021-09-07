@extends('layouts.app')

@section('content')
    {{-- <div class="container"> --}}
    {{-- <div class="row"> --}}
    <div class="col-12 mt-5 pt-5">
        <h2>會員詳細資料</h2>

        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body mt-4">
                            <form class="border px-4 pt-2 pb-3" method="POST"
                                action="{{ route('member-update-profile', $member->id) }}">
                                {{ csrf_field() }}
                                <div class="row d-flex justify-content-center">
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="inputTitle" class="col-form-label">姓名</label>
                                        <input id="inputTitle" type="text" name="name" placeholder=""
                                            value="{{ $member->name }}" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6 col-12">
                                        <label for="inputEmail" class="col-form-label">Email</label>
                                        <input id="inputEmail" type="email" name="email" placeholder=""
                                            value="{{ $member->email }}" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="inputPhone" class="col-form-label">電話</label>
                                        <input id="inputPhone" type="phone" name="phone" placeholder=""
                                            value="{{ $member->phone }}" class="form-control">
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="inputAddress" class="col-form-label">地址</label>
                                        <input id="inputAddress" type="address" name="address" placeholder=""
                                            value="{{ $member->address }}" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">送出</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2>購物金管理</h2>
        <h6>目前購物金：{{ $member['reward_money'] }}</h6>

        <div class="card-body">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body mt-4">
                            <form class="border px-4 pt-2 pb-3" method="POST"
                                action="{{ route('member-update-reward-money', $member->id) }}">
                                {{ csrf_field() }}
                                <div class="row d-flex justify-content-center">
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="inputTitle" class="col-form-label">調整原因</label>
                                        <input id="inputTitle" type="text" name="reward_item" placeholder=""
                                            value="" class="form-control">
                                    </div>

                                    <div class="form-group col-lg-6 col-12">
                                        <label for="inputAmount" class="col-form-label">金額</label>
                                        <input id="inputAmount" type="number" name="amount" placeholder=""
                                            value="" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm">送出</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table shopping-summery">
            <thead>
                <tr class="main-hading">
                    <th class="text-center">日期</th>
                    <th class="text-center">購物金項目</th>
                    <th class="text-center">購物金款項</th>
                    <th class="text-center">購物金餘額</th>
                </tr>
            </thead>
            <tbody>
                @if ($reward_history)
                @foreach ($reward_history as $value)
                <tr>
                    <td class="date text-center" data-title="date"><span>{{ $value->created_at }}</span></td>
                    <td class="reward_item text-center" data-title="reward_item">
                        <span>{{ $value->reward_item }}</span>
                    </td>
                    <td class="amount text-center" data-title="amount"><span>${{ $value->amount }}</span></td>
                    <td class="total text-center" data-title="total"><span>${{ $value->total }}</span></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <span>{{ $reward_history->links() }}</span>
    </div>
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
@endsection
