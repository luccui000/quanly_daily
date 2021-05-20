<?php

namespace App\Http\Livewire\TrangChu;

use App\Facades\GioHang as GioHangFacade;
use App\Models\MatHang;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GioHang extends Component
{
    public $danhsachGioHang = [];
    public $danhsachSoLuong = []; 
    protected $listeners = ['themMoi' => 'capNhatGioHang'];
      
    public function mount()
    {
        $this->capNhatGioHang();
    }
    public function xoaHang($idMh)
    {
        $this->emit('xoaMatHang', $idMh);
    } 
    public function render()
    {
        $tienHang = 0;  
        $data = $this->danhsachGioHang->toArray();
        if(count($this->danhsachGioHang) > 0) {
            foreach($data as $index => $item) {
                $tienHang += $item['GiaXuat'] * $this->danhsachSoLuong[$index];
            } 
        } 
        return view('livewire.trang-chu.gio-hang', compact('tienHang'))
                ->extends('layouts.index');
    }
    public function thanhtoan()
    {
        dd(Auth::user());
    }
    public function capNhatGioHang()
    {
        $mathang = request()->session()->get('giohang');
        $mathangIds = array_column($mathang, 'mathang');
        $this->danhsachSoLuong = array_column($mathang, 'soluong');
        $this->danhsachGioHang = MatHang::whereKey($mathangIds)->get();
    }
}
