<?php

namespace App\Repositories\KhachHang;

interface KhachHangRepositoryConstract {
    public function find($id);
    
    public function getAll(); 

    public function create($request);

    public function update($request);

    public function destroy($request, $id);
}