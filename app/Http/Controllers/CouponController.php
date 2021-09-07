<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $coupon_types = [
        '1' => '現折結帳金額',
        '2' => '贈送購物金'
    ];
    protected $coupon_status = [
        'active' => '啟用',
        'inactive' => '停用'
    ];

    public function index()
    {
        $coupons = Coupon::paginate();
        
        return view('layouts.coupon.index', compact('coupons'))
        ->with('coupon_status', $this->coupon_status)
        ->with('coupon_types', $this->coupon_types);
    }

    public function statusUpdate(Request $request)
    {
        $coupon = Coupon::find($request->coupon_id);
        $coupon['status'] = $request->status;

        if ($coupon->save()) {
            $request->session()->flash('alert-success', '狀態更改成功');
            return redirect()->back();
        }
        $request->session()->flash('alert-danger', '狀態更改失敗');
        return redirect()->back();
    }

    public function create()
    {
        return view('layouts.coupon.create')
        ->with('coupon_types', $this->coupon_types);
    }

    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute 不能為空'
        ];
        $attribute = [
            "name" => "優惠名稱",
            'coupon_line' => '優惠達成金額',
            'coupon_amount' => '優惠金額',
        ];
        $this->validate($request, [
            'name' => 'required',
            'coupon_line' => 'required',
            'coupon_amount' => 'required',
        ], $message, $attribute);
        if (Coupon::create($request->all())) {
            $request->session()->flash('alert-success', '新增優惠成功');
            return redirect()->route('coupon-index');
        }
        $request->session()->flash('alert-danger', '新增優惠失敗');
        return redirect()->route('coupon-index');
    }

    public function detail($id)
    {
        $coupon = Coupon::find($id);

        return view('layouts.coupon.detail', compact('coupon'))
        ->with('coupon_types', $this->coupon_types);
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        // $coupon->fill($request->all);
        $coupon->coupon_type = $request->coupon_type;
        $coupon->name = $request->name;
        $coupon->coupon_line = $request->coupon_line;
        $coupon->coupon_amount = $request->coupon_amount;
        // dd($coupon);
        if ($coupon->save()) {
            $request->session()->flash('alert-success', '編輯優惠成功');
            return redirect()->route('coupon-index');
        }
        $request->session()->flash('alert-danger', '編輯優惠失敗');
        return redirect()->route('coupon-index');
    }
}
