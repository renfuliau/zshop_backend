@extends('layouts.app')

@section('content')

    <div class="table-responsive mt-5 pt-5">
        <div class="row justify-content-between">
            <h2>客服管理</h2>
        </div>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th></th>
                    <th>發問日期</th>
                    <th>發問人稱呼</th>
                    <th>發問人Email</th>
                    <th>發問內容</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $key => $message)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $message->created_at }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->message }}</td>
                        {{-- <td>
                            <form class="form-horizontal" method="POST" action="{{ route('message-update-status') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="message_id" value="{{ $message['id'] }}">
                                <input type="hidden" class="status-{{ $message['id'] }}" id="status" name="status"
                                    value="{{ $message['status'] }}">
                                <select class="selectpicker" data-message-id="{{ $message['id'] }}">
                                    <option class="status" value="{{ $message['status'] }}">
                                        {{ $message_status[$message['status']] }}</option>
                                    @foreach ($message_status as $key => $status)
                                        @if ($message_status[$message['status']] != $status)
                                            <option class="status" value="{{ $key }}">{{ $status }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <button class="btn border" type="submit">更改</button>
                            </form>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <span>{{ $messages->links() }}</span>
    </div>
@endsection
@section('scripts')
    <script>
        $('.selectpicker').on('change', function() {
            console.log($(this).attr('data-message-id'));
            var status_option = '.status-' + $(this).attr('data-message-id');
            console.log(status_option);
            $(status_option).val($(this).val());
        })
    </script>
@endsection
