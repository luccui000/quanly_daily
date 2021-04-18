<?php

namespace App\Http\Livewire;

use App\Models\PhieuHang;
use Livewire\Component;

class PhieuNhapKho extends Component
{
    public $showModal = false;

    public $searchProduct = "";
    
    public function create()
    { 
        $this->showModal = true;
    }
    public function render()
    { 
        return view('livewire.phieu-nhap-kho', [
            'phieuhang' => PhieuHang::query()
                            ->with('nhacungcap')
                            ->with('nhanvien')
                            ->with('kho')->get()
        ])->extends('layouts.app');
    }
}
