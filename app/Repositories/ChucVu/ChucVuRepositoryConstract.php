<?php

namespace App\Repositories\ChucVu;

interface ChucVuRepositoryConstract  
{
    public function find($id);  
    public function getAll();  
    public function create($requestData); 
    public function update($id, $requestData); 
    public function destroy($request, $id);
}