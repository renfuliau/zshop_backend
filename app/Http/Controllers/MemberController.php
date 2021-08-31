<?php

namespace App\Http\Controllers;

use App\Models\RewardMoneyHistory;
use App\Models\UserLevel;
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
        $member_level = UserLevel::get();
        // dd($member_level);
        return view('layouts.member.index', compact('members', 'member_level'))
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

    public function levelUpdate(Request $request)
    {
        $user = User::find($request->member_id);
        // dd($request->all());
        $user['user_level_id'] = $request->level;
        $user->save();

        return redirect()->back();
    }

    public function detail($id)
    {
        $member = User::find($id);
        // dd($member);

        return view('layouts.member.detail', compact('member'));
    }

    public function profileUpdate(Request $request, $id)
    {
        // return $request->all();
        $user = User::findOrFail($id);
        // $data = $request->all();
        // dd($request->all());
        $user->fill($request->all())->save();
        return redirect()->back();
    }

    public function rewardMoneyUpdate(Request $request, $id)
    {
        // return $request->all();
        $user = User::findOrFail($id);
        $user['reward_money'] += $request->amount;
        $user->save();

        $reward_money_history = new RewardMoneyHistory();
        $reward_money_history['user_id'] = $id;
        $reward_money_history['total'] = $user['reward_money'];
        $reward_money_history->fill($request->all())->save();
        // $data = $request->all();
        // dd($request->all());
        // $user
        return redirect()->back();
    }
}
