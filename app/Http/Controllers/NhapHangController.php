<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PhieuHang;
use Illuminate\Http\Request;
use PDF;

class NhapHangController extends Controller
{
    public function store(Request $request)
    {  

        if(!$request->input('danhsachNhapHang')) {
            
        }  
        // if(count($request->c)) 
 
        $date_parts = explode('/', $request->input('NgayLap'));
        $phieuhang = PhieuHang::create([
            'MaPH' => $request->input('MaPH'), 
            'NgayLap' => $date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0],
            'MoTa' => $request->input('MoTa') ?? " ",
            'TongTien' => $request->input('TongTien'),
            'Tong_VAT' => $request->input('Tong_VAT'),
            'Tong_ChietKhau' => $request->input('Tong_ChietKhau'),
            'TongThanhToan' => $request->input('TongThanhToan'),
            'HinhThucThanhToan' => $request->input('HinhThucThanhToan'),
            'TrangThai' => $request->input('TrangThai'), 

            'nhanvien_id' => 1,
            'kho_id' => $request->input('kho_id'),
            'nhacungcap_id' => $request->input('nhacungcap_id'),
        ]); 

        foreach ($request->danhsachNhapHang as $mathang) {
            $phieuhang->mathang()->attach($mathang['id'],[
                'SoLuong' => $mathang['SoLuong'],
                'PT_ChietKhau' => $mathang['GiamGia'],
                'DonGia' => $mathang['DonGia'],
                'ThanhTien' => $mathang['ThanhTien'],
                'PT_VAT' => 0
            ]);
        }
        return redirect()->route('dashboard.phieunhapkho');
    }
    public function export($ext)
    {
        $pdf = PDF::loadView('pdf.hello');
        return $pdf->download('test.pdf');
    }
}
