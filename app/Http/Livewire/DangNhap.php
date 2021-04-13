<?php

namespace App\Http\Livewire;

use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class DangNhap extends Component
{ 

    public $TenDangNhap;
    public $MatKhau;
 
    public function login()
    { 
        $credentials = $this->validate([
            'TenDangNhap' => 'required',
            'MatKhau' => 'required',
        ]);  
        $user = NguoiDung::where("TenDangNhap", $this->TenDangNhap)->first(); 
        if($user) {
            if (Hash::check($this->MatKhau, $user->MatKhau)) {   
                Auth::login($user);
                $user->update([
                    'TrangThai' => 1,
                    'LanDangNhapCuoi' => now()
                ]); 
                $user->save(); 
                return redirect()->route('dashboard.hoso'); 
            }  else {
                $this->addError('MatKhau', "Mật khẩu không đúng !");  
                return;
            }
        } else {
            $this->addError('TenDangNhap', "Tên đăng nhập không đúng !");
        }
    }
    public function render()
    {
        return view('livewire.dang-nhap', [
            'nguoidung' => NguoiDung::query()
                        ->select('id', 'TenDangNhap', 'TrangThai', 'LanDangNhapCuoi')
                        ->orderBy('TrangThai', 'desc')
                        ->orderBy('LanDangNhapCuoi', 'desc')
                        ->paginate(15)
        ])
            ->extends('layouts.auth');
    }
}
