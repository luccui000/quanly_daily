<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiTroNguoiDung extends Model
{
    use HasFactory;
    public $table = 'NGUOIDUNG_VAITRO';
    public $fillable = [
        'vaitro_id',
        'nguoidung_id'
    ];
    public function nguoidung()
    {
        return $this->belongsToMany(NguoiDung::class);
    }
    public function vaitro()
    {
        return $this->belongsToMany(VaiTro::class);
    }
}
