<?php

namespace App\Repositories\NhaCungCap;


interface NhaCungCapRepositoryConstract
{ 
    public function find($id);
    
    public function getAll(); 

    public function create($request);

    public function search($input);

    public function update($request);

    public function destroy($request, $id);
}