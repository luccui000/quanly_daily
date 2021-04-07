<?php

namespace App\Repositories\NhanVien;


interface NhanVienRepositoryConstract
{ 
    public function find($id);
    
    public function getAll(); 

    public function create($requestData);

    public function update($requestData);

    public function destroy($request, $id);
}