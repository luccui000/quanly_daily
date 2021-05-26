<?php

namespace App\Models;

use App\Models\NguoiDung;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VaiTro extends Model
{
    use HasFactory;
    public $table = 'VAITRO';
    public $fillable = [
        'TenVT',
        'MoTa'
    ];
    public function nguoidung()
    {
        return $this->belongsToMany(NguoiDung::class, 'NGUOIDUNG_VAITRO', 'vaitro_id', 'nguoidung_id');
    }
}
