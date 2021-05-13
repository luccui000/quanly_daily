<?php

namespace App\Http\Controllers;

use App\Models\PhieuXuat;
use Illuminate\Http\Request;

class PhieuXuatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('phieuxuat.index');
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
        dd($request->input());
        $phieuhang = PhieuXuat::create([
            'MaPH' => $request->input('MaPH'),  
            'MoTa' => $request->input('MoTa') ?? " ",
            'TongTien' => $request->input('TongTien'),
            'TongVAT' => $request->input('Tong_VAT'),
            'TongChietKhau' => $request->input('Tong_ChietKhau'),
            'TongThanhToan' => $request->input('TongThanhToan'),
            'HinhThucThanhToan' => $request->input('HinhThucThanhToan'),
            'TrangThai' => $request->input('TrangThai'), 

            'nhanvien_id' => 1,
            'kho_id' => $request->input('kho_id')
        ]); 

        foreach ($request->danhsachBanHang as $mathang) {
            $phieuhang->mathang()->attach($mathang['id'],[
                'SoLuong' => $mathang['SoLuong'],
                'TienChietKhau' => $mathang['GiamGia'],
                'DonGia' => $mathang['DonGia'],
                'ThanhTien' => $mathang['ThanhTien'],
                'TienVAT' => 0,
                'LoaiPhieu' => 0
            ]);
        }
        CodeGenerator::tangMa('MaPhieuNhap');
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
