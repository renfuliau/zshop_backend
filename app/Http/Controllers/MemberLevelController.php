<?php

namespace App\Http\Controllers;

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
        $member_levels = UserLevel::get();
        
        return view('layouts.member-level.index', compact('member_levels'))
        ->with('member_level_status', $this->member_level_status);
    }

    public function statusUpdate(Request $request)
    {
        $member_level = UserLevel::find($request->member_level_id);
        $member_level['status'] = $request->status;
        $member_level->save();

        return redirect()->back();
    }

    public function create()
    {
        return view('layouts.member-level.create');
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'title' => 'required',
        //     'category_id' => 'required',
        //     'slug' => 'required',
        //     "summary" => "required",
        //     "stock" => "required",
        //     "price" => "required",
        //     "special_price" => "required",
        //     "description" => "required",
        //     "photos" => "required",
        // ]);
        UserLevel::create($request->all());
        return redirect()->route('member-level-index');
    }

    public function detail($id)
    {
        $member_level = UserLevel::find($id);

        return view('layouts.member-level.detail', compact('member_level'));
    }

    public function update(Request $request, $id)
    {
        $member_level = UserLevel::find($id);
        // $member_level->fill($request->all);
        $member_level->name = $request->name;
        $member_level->name_en = $request->name_en;
        $member_level->level_up_line = $request->level_up_line;
        $member_level->save();
        // dd($member_level);

        return redirect()->route('member-level-index');
    }
}
