<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietPhieuXuat extends Model
{
    use HasFactory;
    public $table = 'CHITIET_PHIEUXUAT';
    
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
    public function phieuxuat() 
    {
        $this->belongsToMany(PhieuXuat::class);
    }
}
