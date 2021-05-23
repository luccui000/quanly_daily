<?php

namespace App\Models;

use App\Models\KhachHang;
use App\MyApp;
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
        return MyApp::MAU_SAC_TRANG_THAI_DON_HANG[$this->TrangThai] ?? 'cool-gray';
    }
    public function getTenTrangThaiAttribute()
    {
        return MyApp::TRANG_THAI_PHIEU_XUAT[$this->TrangThai] ?? 'Đang chờ xác nhận';
    }
    public function getMaPhieuXuatAttribute()
    { 
        return 'PX000'. $this->id;
    }
    public function getTenHinhThucThanhToanAttribute()
    {
        return MyApp::HINH_THUC_THANH_TOAN[$this->HinhThucThanhToan];
    } 
}
