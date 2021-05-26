<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Rules\SoDienThoai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KhachHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function dangky()
    {
        return view('khachhang.dangky');
    }
    public function dangnhap()
    {
        return view('khachhang.dangnhap');
    }
    public function xacthuc()
    {
        $khachHang = KhachHang::where('Email', request('Email'))->orWhere('DienThoai', request('Email'))->first(); 
        if($khachHang) {  
            $email = filter_var(request('Email'), FILTER_SANITIZE_EMAIL);
            // Validate e-mail
            $credential = []; 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $credential = ['Email' => request('Email'), 'MatKhau' => request('MatKhau')];
            } else {
                $credential = ['DienThoai' => request('Email'), 'MatKhau' => request('MatKhau')];
            }   
            if (Hash::check($credential['MatKhau'], $khachHang->MatKhau)) {   
                $data = request()->session()->get('giohang') ?? [];
                Auth::guard('khachhangs')->login($khachHang);  
                if($data) request()->session()->put('giohang', $data);
                return redirect()->route('trangchu'); 
            }  else {
                return redirect()->back()->withErrors( ['Email' => 'Email không đúng', 'MatKhau' => 'MK không đúng']);
            } 
        }
    }
    public function dangxuat()
    {
        return auth()->guard('khachhangs')->logout();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(array_merge(KhachHang::VALIDATE_RULES, [
            'DienThoai' => [ 'required', 'numeric',  new SoDienThoai() ]
            ]), KhachHang::VALIDATE_MESSAGE);

        KhachHang::create(array_merge(request()->only('HoTenKH', 'DiaChi', 'DienThoai', 'Email', 'SoTaiKhoan'), [
            'MatKhau' => Hash::make(request('MatKhau'))
        ])); 
        return redirect()->route('khachhang.dangnhap');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
