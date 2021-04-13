<?php

namespace App\Http\Livewire;
 
use App\Models\KhachHang as ModelsKhachHang;
use Livewire\Component;
use Livewire\WithPagination;
use App\Trait\ToolComponent;

class KhachHang extends Component 
{
    use WithPagination; 
    use ToolComponent;

    public $search = ''; 
    public function create(){
        $this->dispatchBrowserEvent('swal.modal', $this->dispatchAlert('success', 'Tao moi'));
    }
    public function render()
    { 
        $khachhang = ModelsKhachHang::query()
                ->when($this->search, fn($query, $search) => $query->where('HoTenKH', 'like', '%'. $search.'%'))
                ->paginate(10);
        return view('livewire.khach-hang', compact('khachhang'))->extends('layouts.app');
    }
}
