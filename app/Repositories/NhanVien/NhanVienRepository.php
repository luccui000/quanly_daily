<?php


namespace App\Repositories\NhanVien;
 
use App\Models\NhanVien;
use App\Repositories\NhanVien\NhanVienRepositoryConstract;


class NhanVienRepository implements NhanVienRepositoryConstract
{
    public function find($id)
    {
        return NhanVien::where('MaNV', $id)->first();
    }  
    public function getAll()
    {
        return NhanVien::all();
    } 
    public function create($requestData) 
    {  
        return NhanVien::create($requestData);
    } 
    public function update($requestData)
    { 
        return NhanVien::where("MaNV", $requestData["MaNV"]) 
            ->update([
                'HoTenNV' => $requestData["HoTenNV"],
                'DienThoai' => $requestData["DienThoai"],
                'NgaySinh' => $requestData["NgaySinh"],
                'Email' => $requestData["Email"],
                'DiaChi' => $requestData["DiaChi"],
                'GioiTinh' => $requestData["GioiTinh"], 
                'MaChucVu' => $requestData["MaChucVu"],
            ]);
    } 
    public function destroy($request, $id)
    {

    }
}