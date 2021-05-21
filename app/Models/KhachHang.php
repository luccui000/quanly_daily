<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class KhachHang extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    
    protected $table = 'KHACHHANG';

    public $fillable = [ 
        'HoTenKH',
        'DiaChi',
        'DienThoai',
        'Email',
        'SoTaiKhoan',
        'MatKhau'
    ];
    public $timestamps = true;
    public function phieuxuat()
    {
        return $this->belongsTo(PhieuXuat::class);
    } 
    public const VALIDATE_RULES = [
        'HoTenKH' => 'required',
        'DiaChi' => 'required',
        'DienThoai' => 'required|numeric',
        'Email' => 'required|email|unique:App\Models\KhachHang,Email', 
        'SoTaiKhoan' => 'numeric', 
        'MatKhau' => 'required',
        'XacNhanMatKhau' => 'required|same:MatKhau'
    ];
    public const VALIDATE_MESSAGE = [
        'HoTenKH.required' => 'Vui lòng nhập họ tên',
        'DiaChi.required' => '',
        'DienThoai.required' => 'Vui lòng nhập số điện thoại',
        'DiaChi.required' => 'Vui lòng nhập địa chỉ',
        'DienThoai.numeric' => 'Số điện thoại không hợp lệ',
        'SoTaiKhoan.numeric' => 'Số tài khoản không hợp lệ', 
        'Email.required' => 'Vui lòng nhập email', 
        'Email.unique' => 'Email đã được sử dụng', 
        'MatKhau.required' => 'Vui lòng nhập mật khẩu',
        'XacNhanMatKhau.required' => 'Vui lòng nhập lại mật khẩu',
        'XacNhanMatKhau.same' => 'Mật khẩu không trùng nhau'
    ];
    
}
