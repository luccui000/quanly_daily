<?php

namespace App\Repositories\KhachHang;

use App\Models\KhachHang;
use App\Repositories\KhachHang\KhachHangRepositoryConstract;

class KhachHangRepository implements KhachHangRepositoryConstract
{
    public function find($id)
    {

    }
    
    public function getAll()
    {  
        return KhachHang::all();
    }

    public function create($request)
    {

    }

    public function update($request)
    {

    }

    public function destroy($request, $id)
    {

    }
}