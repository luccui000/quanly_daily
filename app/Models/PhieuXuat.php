<?php

namespace App\Models;

use App\Models\KhachHang;
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
        'khachhang_id',
        'kho_id', 
    ];
     
    public function nhanvien() 
    {
        return $this->hasOne(NhanVien::class, 'id', 'nhanvien_id');
    }
    public function kho() 
    {
        return $this->hasOne(Kho::class, 'id', 'kho_id');
    }
    public function khachhang()
    {
        return $this->hasOne(KhachHang::class, 'id', 'khachhang_id');
    }
    public function mathang()
    {
        return $this->belongsToMany(MatHang::class, 'CHITIET_PHIEUXUAT','phieuxuat_id', 'mathang_id' )
                        ->withPivot(['SoLuong', 'DonGia', 'ThanhTien', 'TienChietKhau', 'TienVAT', 'LoaiPhieu']);
    } 
    public function getNgayLapAttribute()
    {
        return date_format(date_create($this->created_at), 'd/m/Y');
    }
    public function getNgaySuaAttribute()
    {
        return date_format(date_create($this->updated_at), 'd/m/Y');
    }
    public function getMauSacTrangThaiAttribute()
    {
        return [
            '0' => 'red', 
            '1' => 'green',
            '2' => 'indigo'
        ][$this->TrangThai] ?? 'cool-gray';
    }
}
