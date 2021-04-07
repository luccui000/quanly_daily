<?php 

namespace App\Repositories\MatHang;

use App\Models\MatHang;

class MatHangRepository implements MatHangRepositoryConstract
{
    public function find($id)
    {

    }
    
    public function getAll()
    {
        return MatHang::all();
    }


    public function create($request)
    {

    }

    public function search($input)
    {

    }

    public function update($request)
    {

    }

    public function destroy($request, $id)
    {

    }
}