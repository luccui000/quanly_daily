<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuXuat extends Model
{
    use HasFactory;
    public $table = 'PHIEUXUAT';
    
    public $fillable = [  
        'MoTa',
        'TongTien',
        'TongVAT',
        'TongChietKhau',
        'TongThanhToan',
        'HinhThucThanhToan',
        'TrangThai', 

        'nhanvien_id',
        'kho_id', 
    ];
    const CREATED_AT = 'NgayLap';
    const UPDATED_AT = 'NgaySuaDoi';
    public function nhanvien() 
    {
        return $this->hasOne(NhanVien::class, 'id', 'nhanvien_id');
    }
    public function kho() 
    {
        return $this->hasOne(Kho::class, 'id', 'kho_id');
    }
    public function mathang()
    {
        return $this->belongsToMany(MatHang::class, 'CHITIET_PHIEUHANG','phieuhang_id', 'mathang_id' )
                        ->withPivot(['SoLuong', 'DonGia', 'ThanhTien', 'TienChietKhau', 'TienVAT', 'LoaiPhieu']);
    } 
}
