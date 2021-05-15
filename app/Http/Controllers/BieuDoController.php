<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Models\MatHang;
use App\Models\PhieuXuat;
use Illuminate\Http\Request;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class BieuDoController extends Controller
{
    public function index()
    { 
        $TongDoanhThu = PhieuXuat::sum('TongThanhToan');
        $SoLuongKhachHang = KhachHang::count();
        $SoLuongPhieuXuat = PhieuXuat::count();
        $SoLuongMatHang = MatHang::count();
        return view('bieudo.index', [
            'TongDoanhThu' => $TongDoanhThu,
            'SoLuongKhachHang' => $SoLuongKhachHang,
            'SoLuongPhieuXuat' => $SoLuongPhieuXuat,
            'SoLuongMatHang' => $SoLuongMatHang,
        ]);
    }
}
