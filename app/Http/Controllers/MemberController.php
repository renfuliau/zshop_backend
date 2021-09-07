<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use App\Models\RewardMoneyHistory;

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
        $members = User::with('userLevel')->where('role', 'user')->paginate(15);
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
        $user['total_shopping_amount'] = UserLevel::find($request->level)->level_up_line;
        $user->save();

        return redirect()->back();
    }

    public function detail($id)
    {
        $member = User::with('rewardMoneyHistory')->find($id);
        // dd($member->rewardMoneyHistory);
        $reward_history = RewardMoneyHistory::orderBy('id', 'desc')->where('user_id', $id)->paginate(5);
        // dd($reward_history);

        return view('layouts.member.detail', compact('member', 'reward_history'));
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
