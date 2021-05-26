<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use PDF;
use App\Models\NguoiDung;
use App\Models\PhieuXuat;
use Illuminate\Http\Request;
use App\Models\CodeGenerator;
use App\Imports\PhieuXuatImport;
use Maatwebsite\Excel\Facades\Excel;

class PhieuXuatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('phieuxuat.index', [
            'DangChoXacNhan' => PhieuXuat::where('TrangThai', 0)->with(['nhanvien', 'kho', 'khachhang'])->get(),
            'DangGiaoHang' => PhieuXuat::where('TrangThai', 1)->with(['nhanvien', 'kho', 'khachhang'])->get(),
            'DaThanhToan' => PhieuXuat::where('TrangThai', 2)->with(['nhanvien', 'kho', 'khachhang'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nhanvienId = optional(optional(NguoiDung::where('id', $request->input('nhanvien_id')))->first())->nhanvien_id;
        
        // dd($request->input());
        $phieuxuat = PhieuXuat::create([
            'MaPH' => $request->input('MaPH'),  
            'MoTa' => $request->input('MoTa') ?? " ",
            'TongTien' => $request->input('TongTienHang'),
            'TongVAT' => $request->input('TongVAT'),
            'TongChietKhau' => $request->input('TongChietKhau'),
            'TongThanhToan' => $request->input('TongThanhToan'),
            'HinhThucThanhToan' => $request->input('HinhThucThanhToan'),
            'TrangThai' => 1, 

            'nhanvien_id' => $nhanvienId,
            'kho_id' => $request->input('kho_id'),
            'khachhang_id' => $request->input('khachhang_id')
        ]); 

        foreach ($request->danhsachBanHang as $mathang) {
            $phieuxuat->mathang()->attach($mathang['id'],[
                'SoLuong' => $mathang['SoLuong'],
                'TienChietKhau' => $mathang['GiamGia'],
                'DonGia' => $mathang['DonGia'],
                'ThanhTien' => $mathang['ThanhTien'],
                'TienVAT' => 0,
                'LoaiPhieu' => 1
            ]);
        }
        CodeGenerator::tangMa('MaPhieuNhap');
        return redirect()->route('dashboard.phieuchi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nhanviens = NhanVien::all();
        $phieuxuat = PhieuXuat::where('id', $id)->with(['nhanvien', 'kho', 'khachhang'])->first(); 
        return view('phieuxuat.show', ['phieuxuat' => $phieuxuat, 'nhanviens' => $nhanviens]);
    }

    public function import()
    {
        Excel::import(new PhieuXuatImport(), request()->file);
        return redirect()->route('dashboard.phieuxuat.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {  
        $phieuxuat = PhieuXuat::where('id', $id)->first();
        
        if(request('TrangThai') == 0) {
            $phieuxuat->update([
                'nhanvien_id' => request('nhanvien_id'),
                'MoTa' => request('MoTa') ?? "",
                'TrangThai' => 1
            ]);
        }
        if(request('TrangThai') == 1) 
        {
            $phieuxuat->update([
                'nhanvien_id' => request('nhanvien_id'),
                'MoTa' => request('MoTa') ?? "",
                'TrangThai' => 2
            ]);
        } 
        return redirect()->route('dashboard.phieuxuat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exportPdf($id)
    { 
        $phieuxuat = PhieuXuat::where('id', $id)->with(['nhanvien', 'mathang', 'khachhang'])->first();
        // return view('pdf.phieugiaohang', compact('phieuxuat'));
        $DanhSach = [0 => "Phiếu Xuất Kho", 1 => 'Phiếu Giao Hàng', 2 => 'Phiếu thanh toán'];
        $tenphieu = $DanhSach[$phieuxuat->TrangThai];
        
        $pdf = PDF::loadView('pdf.phieugiaohang', compact('phieuxuat', 'tenphieu'));
        return $pdf->download('test.pdf');
    }
    public function destroy($id)
    {
        //
    }
}
