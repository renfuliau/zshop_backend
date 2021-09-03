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
        $coupons = Coupon::get();
        
        return view('layouts.coupon.index', compact('coupons'))
        ->with('coupon_status', $this->coupon_status)
        ->with('coupon_types', $this->coupon_types);
    }

    public function statusUpdate(Request $request)
    {
        $coupon = Coupon::find($request->coupon_id);
        $coupon['status'] = $request->status;
        $coupon->save();

        return redirect()->back();
    }

    public function create()
    {
        return view('layouts.coupon.create')
        ->with('coupon_types', $this->coupon_types);
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
        Coupon::create($request->all());
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
        $coupon->save();

        return redirect()->route('coupon-index');
    }
}
