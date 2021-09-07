<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginSubmit(Request $request)
    {
        $data = $request->all();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 'active', 'role' => 'admin'])) {
            Session::put('user', $data['email']);
            request()->session()->flash('success', '登入成功');
            return redirect()->route('z-admin');
        } else {
            request()->session()->flash('error', '無效 Email 或密碼');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success', '成功登出');
        return redirect()->route('z-admin');
    }
}
