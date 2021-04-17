<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kho extends Model
{
    use HasFactory;

    public $table = 'KHO';

    public $fillable = [
        'MaKho',
        'TenKho',
        'DiaChi'
    ];
}
