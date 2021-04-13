<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;

    protected $table = 'NHANVIEN';

    public $fillable = [
        'MaNV',
        'HoTenNV',
        'DienThoai',
        'DiaChi',
        'NgaySinh',
        'GioiTinh',
        'Email',
        'TrangThai',
    ];
    public function getDateForHumansAttribute()
    {
        return date_format(date_create($this->NgaySinh), 'd/m/Y');
    }
    public function chucvu()
    {
        return $this->hasOne(ChucVu::class, 'id', 'chucvu_id');
    }
    public function getColorChucVuAttribute()
    {
        return [
            '1' => 'green',
            '2' => 'red',
            '3' => 'blue',
            '4' => 'indigo'
        ][$this->chucvu->id] ?? 'cool-gray';
    }
    public function setMaNVAttribute($chucvuId)
    { 
        $data = collect($this->chucvu)->map(fn($q) => $q->id);
        $convertDataToArray = explode(" ", $data);
        array_map(function($word) { return ucwords($word); }, $convertDataToArray);
        $this->MaNV = 'NV001'; 
    }
}
