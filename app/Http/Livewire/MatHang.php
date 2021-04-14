<?php

namespace App\Http\Livewire;

use App\Models\DonViTinh;
use App\Models\LoaiMatHang;
use App\Models\MatHang as MatHangModel;
use App\Models\NhaCungCap;
use Livewire\Component;

class MatHang extends Component
{
    public $modalTitle = "";
    public $showModal = false;
    public $isEdit = false; 
    public MatHangModel $mathangs;

    public $MaMH;
     public $TenMH;
     public $ThongSo;
     public $BaoHanh;
     public $GiaNhap;
     public $GiaXuat;
     public $TrangThai; 

    public function mount()
    {
        $this->mathangs = $this->makeBlankMatHang(); 
    }
    public function create()
    {
        $this->modalTitle = "Thêm mới mặt hàng";
        $this->showModal = true;
    }
    public function edit($mathang)
    {
        $this->isEdit = 1;
        $this->modalTitle = "Thay đổi thông tin mặt hàng";
        $this->showModal = true;
    }
    public function save()
    {

    }
    public function makeBlankMatHang()
    {
        $this->reset('MaMH', 'TenMH', 'ThongSo', 'BaoHanh', 'GiaNhap', 'GiaXuat', 'TrangThai');
        return MatHangModel::make([]);
    }
    public function render()
    { 
        $mathang = MatHangModel::query()
            ->with('loaimathang')
            ->with('donvitinh')
            ->with('nhacungcap') 
            ->paginate(env('PAGINATE_PAGE') ?? 10); 
        $nhacungcap = NhaCungCap::all();
        $donvitinh = DonViTinh::all();
        $loaimathang = LoaiMatHang::all();
        return view('livewire.mat-hang', [
            'mathang' => $mathang,
            'nhacungcap' => $nhacungcap,
            'donvitinh' => $donvitinh,
            'loaimathang' => $loaimathang
        ])->extends('layouts.app');
    }
}
