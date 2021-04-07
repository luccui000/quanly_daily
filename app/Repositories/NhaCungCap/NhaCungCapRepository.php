<?php

namespace App\Repositories\NhaCungCap;

use App\Models\NhaCungCap;

class NhaCungCapRepository implements NhaCungCapRepositoryConstract
{
    public function find($MaNCC)
    {
        return NhaCungCap::where("MaNCC", $MaNCC)->first();
    }
    
    public function getAll()
    {
        return NhaCungCap::select('MaNCC', 'TenNCC', 'DienThoai', 'Fax', 'DiaChi' ,'Email', 'SoTaiKhoan')->get();
    }

    public function create($request)
    {
        return NhaCungCap::create([
            'MaNCC'=> $request['MaNCC'],
            'TenNCC'=> $request['TenNCC'],
            'DienThoai'=> $request['DienThoai'],
            'Fax'=> $request['Fax'],
            'Email'=> $request['Email'],
            'DiaChi'=> $request['DiaChi'],
            'SoTaiKhoan'=> $request['SoTaiKhoan'],
            'MaSoThue'=> $request['MaSoThue'],
        ]);
    } 
    public function search($input)
    {
        return NhaCungCap::where('MaNCC', 'LIKE', '%', $input, '%');
    }
    public function update($request)
    {
        return NhaCungCap::where("MaNCC", $request["MaNCC"])
            ->update([ 
                'TenNCC'=> $request['TenNCC'],
                'DienThoai'=> $request['DienThoai'],
                'Fax'=> $request['Fax'],
                'Email'=> $request['Email'],
                'DiaChi'=> $request['DiaChi'],
                'SoTaiKhoan'=> $request['SoTaiKhoan'],
                'MaSoThue'=> $request['MaSoThue']
            ]);
    }

    public function destroy($request, $id)
    {
        
    }
}