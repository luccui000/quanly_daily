<?php

namespace App\Imports;

use App\Models\PhieuXuat; 
use Maatwebsite\Excel\Concerns\ToModel;

class PhieuXuatImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    { 
        return new PhieuXuat([
            'MoTa' => $row[1],
            'TongTien' => $row[2],
            'TongVAT' => $row[3],
            'TongChietKhau' => $row[4],
            'TongThanhToan' => $row[5],
            'HinhThucThanhToan' => $row[6],
            'TrangThai' => $row[7] ,
    
            'nhanvien_id' => $row[10],
            'khachhang_id' => $row[11],
            'kho_id' => $row[12],
        ]);
    }
}
