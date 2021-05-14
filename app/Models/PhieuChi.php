<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuChi extends Model
{
    use HasFactory;
    public $table = 'PHIEUCHI';
    public $fillable = [
        'NoiDungChi',
        'TongTien',
        'nhanvien_id',
        'created_at',
        'updated_at'
    ]; 

    public const VALIDATION_RULES = [
        'NoiDungChi' => 'required',
        'TongTien' => 'required',
        'nhanvien_id' => 'required'
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
