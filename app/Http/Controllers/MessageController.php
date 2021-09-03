<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('order_id', null)->get();
        // dd($messages);
        
        return view('layouts.message.index', compact('messages'));
    }

    public function statusUpdate(Request $request)
    {
        $message = Message::find($request->message_id);
        $message['status'] = $request->status;
        $message->save();

        return redirect()->back();
    }

    public function detail($id)
    {
        $message = Message::find($id);

        return view('layouts.message.detail', compact('message'))
        ->with('message_types', $this->message_types);
    }

    public function update(Request $request, $id)
    {
        $message = Message::find($id);
        // $message->fill($request->all);
        $message->message_type = $request->message_type;
        $message->name = $request->name;
        $message->message_line = $request->message_line;
        $message->message_amount = $request->message_amount;
        // dd($message);
        $message->save();

        return redirect()->route('message-index');
    }
}
