@extends('layouts.app')

@section('content')

<h2>會員管理</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        @if (! $members->isEmpty())
        <thead>
            <tr>
                <th></th>
                <th>Email</th>
                <th>會員等級</th>
                {{-- <th>累積消費金額</th> --}}
                <th>現有購物金</th>
                <th>會員狀態</th>
                <th>詳細資料</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $key => $member)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $member['email'] }}</td>
                <td>{{ $member->userLevel['name'] }}</td>
                {{-- <td>{{ $member->user['email'] }}</td> --}}
                <td>$ {{ $member['reward_money'] }}</td>
                <td>
                    <form class="form-horizontal" method="POST" action="{{ route('member-update-status') }}">
                        {{ csrf_field() }}
                        <input type="hidden" id="member_id" name="member_id" value="{{ $member['id'] }}">
                        <input type="hidden" id="status{{ $member['id'] }}" name="status" value="{{ $member['status'] }}">
                        <select class="selectpicker">
                            <option class="status" value="{{ $member['status'] }}" data-member-id="{{ $member['id'] }}">
                                {{ $member_status[$member['status']] }}</option>
                            @foreach ($member_status as $key => $status)
                            @if ($member_status[$member['status']] != $status)
                            <option class="status" value="{{ $key }}" data-member-id="{{ $member['id'] }}>{{ $status }}</option>
                            @endif
                            @endforeach
                        </select>
                        <button class="btn" type="submit">更改</button>
                    </form>
                </td>
                {{-- <td>{{ $member_status[$member['status']] }}</td> --}}
                {{-- <td>
                    <form class="form-horizontal" method="POST" action="{{ route('order-update-status') }}">
                {{ csrf_field() }}
                <input type="hidden" name="member_id" value="{{ $member['id'] }}">
                <input type="hidden" id="status" name="status" value="{{ $member['status'] }}">
                <select class="selectpicker">
                    <option class="status" value="{{ $member_status[$member['status']] }}">
                        {{ $member_status[$member['status']] }}</option>
                    @foreach ($member_status as $key => $status)
                    @if ($member_status[$member['status']] != $status)
                    <option class="status" value="{{ $key }}">{{ $status }}</option>
                    @endif
                    @endforeach
                </select>
                <button class="btn" type="submit">更改</button>
                </form>
                </td> --}}
                <td><a class="btn" href="">明細</a></td>
            </tr>
            @endforeach
        </tbody>
        @endif

    </table>
    {{-- <div class="pagination">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div> --}}
</div>

<script>
    $('.selectpicker').on('change', function () {
        $('#status' + $(this).attr('data-member-id')).val($(this).val());
        console.log($('#status' + $(this).attr('data-member-id'));
    })
</script>
@endsection