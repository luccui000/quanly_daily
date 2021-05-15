<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatHang extends Model
{
    use HasFactory;
    public $table = 'MATHANG';
    public $fillable = [
        'MaMH',
        'TenMH',
        'ThongSo',
        'BaoHanh',
        'GiaNhap',
        'GiaXuat',
        'TrangThai',
        'nhacungcap_id',
        'loaimathang_id',
        'donvitinh_id'
    ];
    public $timestamps = true;
    public function donvitinh()
    {
        return $this->hasOne(DonViTinh::class, 'id', 'donvitinh_id');
    }
    public function loaimathang()
    {
        return $this->hasOne(LoaiMatHang::class, 'id', 'loaimathang_id');
    }
    public function nhacungcap()
    {
        return $this->hasOne(NhaCungCap::class, 'id', 'nhacungcap_id');
    }
    public function phieuhang()
    {
        return $this->belongsToMany(PhieuHang::class, 'CHITIET_PHIEUHANG', 'mathang_id' ,'phieuhang_id')
                        ->withPivot(['SoLuong', 'DonGia', 'ThanhTien', 'TienChietKhau', 'TienVAT', 'LoaiPhieu']);
    }
    public function phieuxuat()
    {
        return $this->belongsToMany(PhieuXuat::class, 'CHITIET_PHIEUXUAT', 'mathang_id' ,'phieuxuat_id')
                        ->withPivot(['SoLuong', 'DonGia', 'ThanhTien', 'TienChietKhau', 'TienVAT', 'LoaiPhieu']);
    }
}
