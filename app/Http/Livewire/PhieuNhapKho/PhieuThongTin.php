<?php

namespace App\Http\Livewire\PhieuNhapKho;

use App\Models\Kho; 
use Livewire\Component;
use App\Models\NhaCungCap;
use App\Models\CodeGenerator;   
use PDF;

class PhieuThongTin extends Component
{
    public $NgayLap;

    protected $listeners = ['capnhatTongTienHang' => 'capnhatTongTienHang'];
    public $mathangs =  [];
    public $nhacungcap = [];
    public $kho = [];
    public $MaTuDong;
    public $nhacungcap_id;
    public $kho_id;
    public $nhanvien_id;

    public $MaPH;
    public float $TongTienHang = 0;
    public float $Tong_VAT = 0;
    public float $Tong_ChietKhau = 0;
    public float $TongThanhToan = 0;
    public int $HinhThucThanhToan = 1;
    public $MoTa;

    public function capnhatTongTienHang($TongTienHang)
    { 
        $this->TongTienHang = $TongTienHang; 
    }
    public function mount()
    {
        $this->NgayLap = date_format(date_create(now()), 'd/m/Y');  
        $this->nhacungcap = NhaCungCap::all();
        $this->kho = Kho::all();
        $this->MaPH = CodeGenerator::layMa('MaPhieuNhap');
        // CodeGenerator::tangMa('MaPhieuaNhap');
    }
    public function thongBaoChonHang()
    {
        $this->dispatchBrowserEvent('swal.modal', [
            'title' => 'Vui lòng chọn một ít nhất 1 mặt hàng',
            'content' => '',
            'type' =>  'warning'
        ]);
    }
    public function export($ext) 
    { 
        return redirect()->route('dashboard.nhaphang.export', $ext);
    }
    public function render()
    { 
        $tienVAT = $this->TongTienHang * $this->Tong_VAT / 100;
        $tienGiamGia = $this->TongTienHang * $this->Tong_ChietKhau / 100;
        $this->TongThanhToan = $this->TongTienHang + $tienVAT - $tienGiamGia;
        return view('livewire.phieu-nhap-kho.phieu-thong-tin');
    }
}
