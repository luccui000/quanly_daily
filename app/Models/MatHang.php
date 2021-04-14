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
    ];
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
}
