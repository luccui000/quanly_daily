<?php

namespace App\Exports;

use App\Models\NguoiDung;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NguoiDungExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $nguoidungIds;
    public function __construct($nguoidungIds)
    {
        $this->nguoidungIds = $nguoidungIds; 
    }
    public function collection()
    {
        return NguoiDung::whereKey($this->nguoidungIds);
    }
    public function headings(): array
    {
        return [ 
            'Tên đăng nhập',
            'Mật khẩu',
            'Trạng thái',
            'Lần đăng nhập cuối',
        ];
    }
    public function map($row): array
    {
        return [
            $row->TenDangNhap,
            $row->MatKhau,
            $row->TrangThai,
            $row->LanDangNhapCuoi,
        ];
    }

}
