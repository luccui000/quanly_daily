<?php

namespace App\Http\Livewire\PhieuNhapKho;

use App\Models\CodeGenerator;
use App\Models\Kho;
use App\Models\MatHang;
use Livewire\Component;
use App\Models\NhaCungCap;

class PhieuThongTin extends Component
{
    public $NgayLap;

    public $mathangs =  [];
    public $nhacungcap = [];
    public $kho = [];
    public $MaTuDong;
    public $nhacungcap_id;
    public $kho_id;
    public $nhanvien_id;
    
    public $MaPH;
    public float $TongTienHang = 0;
    public float $TongVAT = 0;
    public float $TongGiamGia = 0;
    public float $TongThanhToan = 0;
    public int $HinhThucThanhToan = 1;
    public $MoTa;

    public function mount()
    {
        $this->NgayLap = date_format(date_create(now()), 'd/m/Y');
        $this->nhacungcap = NhaCungCap::all();
        $this->kho = Kho::all();
        $this->MaPH = CodeGenerator::layMa('MaPhieuNhap');
        // CodeGenerator::tangMa('MaPhieuaNhap');
    }
    public function render()
    {
        return view('livewire.phieu-nhap-kho.phieu-thong-tin');
    }
}
