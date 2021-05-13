<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuHang extends Model
{
    use HasFactory;

    public $table = 'CHITIET_PHIEUHANG';
    
    public $fillable = [
        'LoaiPhieu',
        'SoLuong',
        'DonGia',
        'ThanhTien',
        'TienChietKhau',
        'TienVAT',
    ];
    public function mathang()
    {
        return $this->belongsToMany(MatHang::class);
    }
    public function phieuhang() 
    {
        $this->belongsToMany(PhieuHang::class);
    }
}
