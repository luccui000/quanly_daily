<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use App\Models\PhieuXuat;
use Illuminate\Http\Request;
use App\Models\CodeGenerator;

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
            'phieuxuat' => PhieuXuat::with(['nhanvien', 'kho', 'khachhang'])->get()
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
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
