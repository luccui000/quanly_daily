<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonViTinh extends Model
{
    use HasFactory;
    public $table = 'DONVITINH';
    
    public $fillable = [
        'MaDVT',
        'TenDVT',
        'MoTa',
    ];
}
