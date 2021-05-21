<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 

use Illuminate\Notifications\Notifiable; 
use Illuminate\Foundation\Auth\User as Authenticatable; 

class NguoiDung extends Authenticatable 
{ 
    use Notifiable;
    use HasFactory; 
    protected $table = 'NGUOIDUNG'; 
    
    public $fillable = [ 
        'TenDangNhap',
        'MatKhau',
        'LanDangNhapCuoi',
        'TrangThai',
        'nhanvien_id'
    ];
    public $timestamps = true;
    protected $hidden = [
        'MatKhau'
    ];
    public function nhanvien()
    {
        return $this->hasOne(NhanVien::class, 'id', 'nhanvien_id');
    }
    protected $guarded = ['id'];
    public function getMauSacTrangThaiAttribute()
    {
        return [
            '0' => 'red',
            '1' => 'green'
        ][$this->TrangThai] ?? 'cool-gray';
    }
    public function getDateForHumansAttribute()
    {
        return date_format(date_create($this->LanDangNhapCuoi), 'd/m/Y');
    }
    public function getTimeForHumansAttribute()
    {
        return date_format(date_create($this->LanDangNhapCuoi), 'H:i:s');
    }
    public function getAuthIdentifierName()
    {
        return "TenDangNhap";
    }
    public function getAuthPassword()
    {
     return $this->MatKhau;
    } 
}
