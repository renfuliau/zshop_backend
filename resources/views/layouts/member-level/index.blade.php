@extends('layouts.app')

@section('content')

    <div class="table-responsive mt-5 pt-5">
        <div class="row justify-content-between">
            <h2>會員等級管理</h2>
            <a href="{{ route('member-level-create') }}">新增會員等級</a>
        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th></th>
                    <th>會員等級</th>
                    <th>會員等級（英文）</th>
                    <th>升級金額</th>
                    <th>狀態</th>
                    <th>選項</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($member_levels as $key => $member_level)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $member_level->name }}</td>
                        <td>{{ $member_level->name_en }}</td>
                        <td>$ {{ $member_level->level_up_line }}</td>
                        {{-- <td>{{ $member_level->status }}</td> --}}
                        <td>
                            <form class="form-horizontal" method="POST" action="{{ route('member-level-update-status') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="member_level_id" value="{{ $member_level['id'] }}">
                                <input type="hidden" class="status-{{ $member_level['id'] }}" id="status" name="status"
                                    value="{{ $member_level['status'] }}">
                                <select class="selectpicker" data-member-level-id="{{ $member_level['id'] }}">
                                    <option class="status" value="{{ $member_level['status'] }}">
                                        {{ $member_level_status[$member_level['status']] }}</option>
                                    @foreach ($member_level_status as $key => $status)
                                        @if ($member_level_status[$member_level['status']] != $status)
                                            <option class="status" value="{{ $key }}">{{ $status }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <button class="btn border" type="submit">更改</button>
                            </form>
                        </td>
                        <td><a class="btn border" href="{{ route('member-level-detail', $member_level['id']) }}">編輯</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <span>{{ $member_levels->links() }}</span>
    </div>
@endsection
@section('scripts')
    <script>
        $('.selectpicker').on('change', function() {
            console.log($(this).attr('data-member-level-id'));
            var status_option = '.status-' + $(this).attr('data-member-level-id');
            console.log(status_option);
            $(status_option).val($(this).val());
        })
    </script>
@endsection
