<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;
    
    protected $table = 'KHACHHANG';

    public $fillable = [
        'MaKH',
        'HoTenKH',
        'DiaChi',
        'DienThoai',
        'Email',
        'SoTaiKhoan',
    ];
    public $timestamps = true;
    public function phieuxuat()
    {
        return $this->belongsTo(PhieuXuat::class);
    }
}
