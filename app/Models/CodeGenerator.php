<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeGenerator extends Model
{
    use HasFactory;
    public $table = 'CODE_GENERATOR';
    public $fillable = [
        'MaNhanVien',
        'MaQuanLy',
        'MaThuKhu',
        'MaVanPhong',
        'MaKhachHang',
        'MaNhaCungCap',
        'MaMatHang',
        'MaHoaDon',
    ]; 
    public $timestamps = false;
}
