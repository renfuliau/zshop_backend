@extends('layouts.app')

@section('content')

    <div class="table-responsive mt-5 pt-5">
        <h2>會員管理</h2>
        <table class="table table-striped table-sm">
            @if (!$members->isEmpty())
                <thead>
                    <tr>
                        <th></th>
                        <th>Email</th>
                        <th>會員等級</th>
                        <th>累積消費金額</th>
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
                            {{-- <td>{{ $member->userLevel['name'] }}</td> --}}
                            <td>
                                <form class="form-horizontal" method="POST" action="{{ route('member-update-level') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="member_id" value="{{ $member['id'] }}">
                                    <input type="hidden" class="level-{{ $member['id'] }}" id="level" name="level"
                                        value="{{ $member->userLevel['id'] }}">
                                    <select class="levelpicker" data-member-id="{{ $member['id'] }}">
                                        <option class="level" value="{{ $member->userLevel['id'] }}">
                                            {{ $member->userLevel['name'] }}</option>
                                        @foreach ($member_level as $key => $level)
                                            @if ($level['id'] != $member->userLevel['id'])
                                                <option class="level" value="{{ $level['id'] }}">
                                                    {{ $level['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <button class="btn border" type="submit">更改</button>
                                </form>
                            </td>
                            <td>$ {{ $member['total_shopping_amount'] }}</td>
                            <td>$ {{ $member['reward_money'] }}</td>
                            <td>
                                <form class="form-horizontal" method="POST" action="{{ route('member-update-status') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="member_id" value="{{ $member['id'] }}">
                                    <input type="hidden" class="status-{{ $member['id'] }}" id="status" name="status"
                                        value="{{ $member['status'] }}">
                                    <select class="selectpicker" data-member-id="{{ $member['id'] }}">
                                        <option class="status" value="{{ $member['status'] }}">
                                            {{ $member_status[$member['status']] }}</option>
                                        @foreach ($member_status as $key => $status)
                                            @if ($member_status[$member['status']] != $status)
                                                <option class="status" value="{{ $key }}">
                                                    {{ $status }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <button class="btn border" type="submit">更改</button>
                                </form>
                            </td>
                            <td><a class="btn border" href="{{ route('member-detail', $member['id']) }}">詳細</a></td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
        <span>{{ $members->links() }}</span>
    </div>


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.selectpicker').on('change', function() {
                console.log($(this).attr('data-member-id'));
                var status_option = '.status-' + $(this).attr('data-member-id');
                console.log(status_option);
                $(status_option).val($(this).val());
            })

            $('.levelpicker').on('change', function() {
                console.log($(this).attr('data-member-id'));
                var level_option = '.level-' + $(this).attr('data-member-id');
                console.log(level_option);
                $(level_option).val($(this).val());
            })
        });
        // $('.selectpicker').on('change', function() {
        //     console.log($(this).attr('data-member-id'));
        //     var status_option = '.status-' + $(this).attr('data-member-id');
        //     console.log(status_option);
        //     $(status_option).val($(this).val());
        // })

        // $('.levelpicker').on('change', function() {
        //     console.log($(this).attr('data-member-id'));
        //     var level_option = '.level-' + $(this).attr('data-member-id');
        //     console.log(level_option);
        //     $(level_option).val($(this).val());
        // })
    </script>
@endsection
