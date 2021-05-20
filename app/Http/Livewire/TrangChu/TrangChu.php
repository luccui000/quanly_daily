<?php

namespace App\Http\Livewire\TrangChu;

use App\Facades\GioHang;
use App\Models\LoaiMatHang;
use App\Models\MatHang;
use Livewire\Component;
use Livewire\WithPagination;

class TrangChu extends Component
{
    protected $listeners = ['xoaHang' => 'xoaMatHang'];
    use WithPagination;
    public $search = '';
    public $danhsachMatHang = [];
    public $matHangIds = [];
    public $loaiMatHang = [];
    public $loaiMatHangId = 0;

    public function mount()
    {
        if(request()->session()->get('giohang') == null) {
            $this->danhsachMatHang = [];
            $this->matHangIds = [];
        } else {
            if(count(request()->session()->get('giohang')) > 0) {
                $this->danhsachMatHang = request()->session()->get('giohang');  
                $this->matHangIds = $this->danhsachMatHangIds();
            }
        }
        $lmh = LoaiMatHang::all();
        $this->loaiMatHang = $lmh->toArray(); 
    }
    public function themVaoGioHang($mathangId)
    {   
        $matHangIds = $this->danhsachMatHangIds();
        if(in_array($mathangId, $matHangIds)) { 
            $index = array_search($mathangId, $matHangIds);
            $this->danhsachMatHang[$index]['soluong'] += 1; 
        } else {
            array_push($this->danhsachMatHang, [
                'mathang' => $mathangId,
                'soluong' => 1
            ]);
        } 
        $this->matHangIds = $this->danhsachMatHangIds();
        request()->session()->put('giohang', $this->danhsachMatHang); 
        $this->emit('themMoi');
    } 
    public function xoaMatHang($idMathang)
    {
        $matHangIds = $this->danhsachMatHangIds();
        if(in_array($idMathang, $matHangIds)) {
            $index = array_search($idMathang, $matHangIds);
            array_splice($this->danhsachMatHang, $index, 1); 
        }
        $this->matHangIds = $this->danhsachMatHangIds();
        request()->session()->put('giohang', $this->danhsachMatHang);
        $this->emit('themMoi');
    }
    public function danhsachMatHangIds()
    {
        return array_column($this->danhsachMatHang, 'mathang');
    }
    public function phanloai($id)
    {  
        $this->loaiMatHangId = $id;
    }
    public function render()
    {
        return view('livewire.trang-chu.trang-chu', [
            'mathangs' => MatHang::query()
                            ->latest()
                            ->when($this->search, fn($query, $search) => $query->where('TenMH', 'like', '%'.$search.'%')
                                ->orWhere('ThongSo', 'like', '%'.$search.'%')) 
                            ->paginate(15)
        ])->extends('layouts.index');
    }
}
