<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $member_status_array;

    public function __construct()
    {
        $this->member_status_array = [
            'active' => '啟用',
            'inactive' => '停用'
        ];
    }

    public function index()
    {
        $members = User::with('userLevel')->get();
        // dd($members);
        return view('layouts.member.index', compact('members'))
        ->with('member_status', $this->member_status_array);
    }

    public function statusUpdate(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->member_id);
        // dd($user);
        $user['status'] = $request->status;
        $user->save();

        return redirect()->back();
    }
}
