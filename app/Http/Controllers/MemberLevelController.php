<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;

class MemberLevelController extends Controller
{
    protected $member_level_status = [
        'active' => '啟用',
        'inactive' => '停用'
    ];

    public function index()
    {
        $member_levels = UserLevel::orderBy('level_up_line', 'asc')->paginate(15);

        return view('layouts.member-level.index', compact('member_levels'))
            ->with('member_level_status', $this->member_level_status);
    }

    public function statusUpdate(Request $request)
    {
        $member_level = UserLevel::find($request->member_level_id);
        $member_level['status'] = $request->status;
        $member_level->save();
        $users = User::get();
        // dd($users);
        $this->checkUsersLevel($users);
        // dd($member_level);

        return redirect()->back();
    }

    public function create()
    {
        return view('layouts.member-level.create');
    }

    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute 不能為空',
            'integer' => ':attribute 只能為數字',
            'min' => ':attribute 必須大於 0',
        ];
        $attribute = [
            "name" => "會員等級名稱",
            'name_en' => '會員等級英文名稱',
            'level_up_line' => '升級金額',
        ];
        $this->validate($request, [
            'name' => 'required',
            'name_en' => 'required',
            'level_up_line' => 'required|integer|min:1',
        ], $message, $attribute);

        if (empty(UserLevel::where('level_up_line', $request->level_up_line)->first())) {
            $user_level = new UserLevel();
            $user_level->fill($request->all());
            UserLevel::create($request->all());
            $this->checkUsersLevel(User::where('status', 'active')->get());
            return redirect()->route('member-level-index');
        }

        $request->session()->flash('alert-danger', '新增會員失敗，此升級金額已存在');
        return redirect()->back();
    }

    public function detail($id)
    {
        $member_level = UserLevel::find($id);

        return view('layouts.member-level.detail', compact('member_level'));
    }

    public function update(Request $request, $id)
    {
        $message = [
            'required' => ':attribute 不能為空',
            'integer' => ':attribute 只能為數字',
            'min' => ':attribute 必須大於 0',
        ];
        $attribute = [
            "name" => "會員等級名稱",
            'name_en' => '會員等級英文名稱',
            'level_up_line' => '升級金額',
        ];
        $this->validate($request, [
            'name' => 'required',
            'name_en' => 'required',
            'level_up_line' => 'required|integer|min:1',
        ], $message, $attribute);

        if (empty(UserLevel::where('level_up_line', $request->level_up_line)->whereNotIn('id', [$id])->first())) {
            $member_level = UserLevel::find($id);
            $member_level->name = $request->name;
            $member_level->name_en = $request->name_en;
            $member_level->level_up_line = $request->level_up_line;
            $member_level->save();
            $users = User::where('status', 'active')->get();
            // dd($users);
            $this->checkUsersLevel($users);
            return redirect()->route('member-level-index');
        }

        $request->session()->flash('alert-danger', '新增會員失敗，此升級金額已存在');
        return redirect()->back();
    }

    protected function checkUsersLevel($users)
    {
        foreach ($users as $user) {
            $user_level = UserLevel::orderBy('level_up_line', 'desc')->where('level_up_line', '<=', $user->total_shopping_amount)->where('status', 'active')->first();
            // dd($user_level);
            if ($user_level->id != $user->user_level_id) {
                $user->user_level_id = $user_level->id;
                $user->save();
            }
        }
    }
}
