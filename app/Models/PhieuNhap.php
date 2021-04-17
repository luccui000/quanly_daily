<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuNhap extends Model
{
    use HasFactory;

    public $table = 'PHIEUNHAP';
    public function mathang()
    {
        return $this->belongsToMany(MatHang::class);
    }
}
