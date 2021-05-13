<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuHang extends Model
{
    use HasFactory;
    protected $table = 'PHIEUHANG';
    protected $fillable = [
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
    protected $casts = [
        'NgayLap' => 'datetime:d/m/Y', // Change your format
    ]; 
    public function getMauSacTrangThaiAttribute()
    {
        return [
            '0' => 'red',
            '1' => 'green',
            '2' => 'red',
        ][$this->TrangThai] ?? 'cool-gray';
    }
    public function mathang()
    {
        return $this->belongsToMany(MatHang::class, 'CHITIET_PHIEUHANG','phieuhang_id', 'mathang_id' )
                        ->withPivot(['SoLuong', 'DonGia', 'ThanhTien', 'TienChietKhau', 'TienVAT', 'LoaiPhieu']);
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
