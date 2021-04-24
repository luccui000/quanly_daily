<?php

namespace App\Http\Livewire\PhieuNhapKho;

use App\Models\Kho;
use App\Models\MatHang;
use Livewire\Component;
use App\Models\NhaCungCap;

class PhieuThongTin extends Component
{
    public $NgayLap;

    public MatHang $mathangs;
    public NhaCungCap $nhacungcap;
    public Kho $kho;

    public function mount()
    {
        $this->NgayLap = date_format(date_create(now()), 'd/m/Y');
    }
    public function render()
    {
        return view('livewire.phieu-nhap-kho.phieu-thong-tin');
    }
}
