<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhaCungCap extends Model
{
    use HasFactory;
    public $table = 'NHACUNGCAP';
    public function mathang()
    {
        return $this->hasMany(MatHang::class);
    }
}
