<?php

namespace App\Repositories\ChucVu;

use App\Models\ChucVu;

class ChucVuRepository implements ChucVuRepositoryConstract
{
    public function find($id)
    {
        return ChucVu::findOrFail($id);
    }
    public function getAll()
    {
        return ChucVu::all();
    }
    public function create($requestData)
    {

    }
    public function update($id, $requestData)
    {

    }
    public function destroy($request, $id)
    {

    }
}