<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaoCao extends Model
{
    use HasFactory;
    public $table = 'BAOCAO';

    public $fillable = [
        'nhanvien_id',
        'TenBC',
        'NoiDungBC'
    ];
    public function nhanvien()
    {
        return $this->hasOne(NhanVien::class, 'id', 'nhanvien_id');
    }
    public function getNgayLapAttribute()
    {
        return date_format(date_create($this->created_at), 'd/m/Y');
    }
    public function getNgaySuaAttribute()
    {
        return date_format(date_create($this->updated_at), 'd/m/Y');
    }
}
