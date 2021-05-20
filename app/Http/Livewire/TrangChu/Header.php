<?php

namespace App\Http\Livewire\TrangChu;

use App\Facades\GioHang;
use Livewire\Component;

class Header extends Component
{
    public $soLuongHang = 0;
    public $showModal = 0;
    protected $listeners = [
        'themMoi' => 'themMoiGioHang', 
        'xoaMatHang' => 'xoaMatHang'
    ];
    public function mount()
    {
        if(request()->session()->get('giohang') != null) {
            $this->soLuongHang = count(request()->session()->get('giohang'));
        }
    }
    public function themMoiGioHang()
    {
        $this->soLuongHang = count(request()->session()->get('giohang'));
    }   
    public function xoaMatHang($id)
    {
        $this->emit('xoaHang', $id);
    }
    public function render()
    {
        return view('livewire.trang-chu.header');
    }
}
