<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class XacThucController extends Controller
{
    public function dangnhap()
    {
        return view('xacthuc.dangnhap');
    }
    public function xacthuc()
    {
        request()->validate([
            'TenDangNhap' => 'required',
            'MatKhau' => 'required',
        ]);
        
        $user = NguoiDung::where("TenDangNhap", request('TenDangNhap'))->first(); 
        if($user) { 
            if (Hash::check(request('MatKhau'), $user->MatKhau)) {   
                Auth::guard('web')->login($user);
                $user->update([
                    'TrangThai' => 1,
                    'LanDangNhapCuoi' => now()
                ]); 
                $user->save(); 
                return redirect()->route('dashboard.hoso'); 
            }  else {
                return redirect()->back()->withErrors(['MatKhau' => 'Mật khẩu không đúng']);
            }
        } else {
            return redirect()->back()->withErrors(['TenDangNhap' => 'Tên đăng nhập không đúng']);
        }
    }
    public function dangxuat()
    {
        $userId = Auth::user()->id;
        NguoiDung::where('id', $userId)->update(['LanDangNhapCuoi' => Carbon::now(), 'TrangThai' => 0]); 
        Auth::logout();
        return redirect()->route('auth.dangnhap');
    }
}
