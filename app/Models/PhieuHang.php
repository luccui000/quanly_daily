<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuHang extends Model
{
    use HasFactory;
    public $table = 'PHIEUHANG';
    public $fillable = [
        'MaPH', 
        'NgayLap',
        'MoTa',
        'TongTien',
        'Tong_VAT',
        'Tong_ChietKhau',
        'TongThanhToan',
        'HinhThucThanhToan',
        'TrangThai', 

        'nhanvien_id',
        'kho_id',
        'nhacungcap_id',
    ];
    public function mathang()
    {
        return $this->belongsToMany(MatHang::class, 'PHIEUNHAP', 'mathang_id' ,'phieuhang_id');
    }
    public function getDateForHumansAttribute()
    {
        return date_format(date_create($this->NgayLap), 'd/m/Y');
    }
    public function nhacungcap()
    {
        return $this->hasOne(NhaCungCap::class, 'id', 'nhacungcap_id');
    }
    public function kho()
    {
        return $this->hasOne(Kho::class, 'id', 'kho_id');
    }
    public function nhanvien()
    {
        return $this->hasOne(NhanVien::class, 'id', 'nhanvien_id');
    }
}
