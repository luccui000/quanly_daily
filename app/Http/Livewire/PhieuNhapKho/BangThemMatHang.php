<?php

namespace App\Http\Livewire\PhieuNhapKho;

use App\Models\DonViTinh;
use App\Models\MatHang;
use Illuminate\Support\Collection;
use Livewire\Component;

class BangThemMatHang extends Component
{
    protected $listeners = ['ThemMatHang' => 'ThemMatHang'];
   
    public Collection $giamgia;
    public Collection $thanhtien;

    
    public $soluongMatHangTheoIndex = [];
    public $giamgiaMatHangTheoIndex = [];
    public $thanhtienMatHangTheoIndex = [];
    public $danhSachIDMatHang = [];
    public $tatcaMatHang = [];
    public $danhsachNhapHang = [];
    public $danhsachMatHang = [];
    public $donvitinh = [];
    public $thongtinMatHang;

    public function mount()
    {   
        $this->giamgia = collect();
        $this->thanhtien = collect();    
        $this->danhsachMatHang = MatHang::with('donvitinh')->latest()->get();
        $this->danhsachNhapHang = [
            $this->mathangMoi(0) 
        ]; 
    }
    public function themMoiMatHang($index)
    {
        $this->danhsachNhapHang[] = $this->mathangMoi($index);
    }
    private function mathangMoi($index)
    {
        return [ 
            'id' => $this->danhsachMatHang[$index]['id'] ,
            'prevId' => $this->danhsachMatHang[$index]['id'] ,
            'MaMH' => $this->danhsachMatHang[$index]['MaMH'], 
            'TenMH' => $this->danhsachMatHang[$index]['TenMH'],  
            'TenDVT' => $this->danhsachMatHang[$index]['donvitinh']['TenDVT'], 
            'DonGia' => (float)$this->danhsachMatHang[$index]['GiaNhap'], 
            'SoLuong' => 1, 
            'GiamGia' => 0, 
            'ThanhTien' => $this->danhsachMatHang[$index]['GiaNhap']
        ];
    }
    public function ThemMatHang(MatHang $mathang)
    {  
        if(in_array($mathang->id, $this->idMatHangDachon())) {
            $index = array_search($mathang->id, $this->idMatHangDachon());
            $this->danhsachNhapHang[$index]['SoLuong'] += 1; 
        } else {
            $this->danhsachNhapHang[count($this->danhsachNhapHang)] = $this->capnhatThongTinMatHangDaChon($mathang);   
        }
    }
    public function boMatHang($index)
    {
        info($this->danhsachNhapHang);
        unset($this->danhsachNhapHang[$index]);
        array_values($this->danhsachNhapHang);
        info($this->danhsachNhapHang);
    }
    private function idMatHangDachon()
    {
        $ids = [];
        foreach($this->danhsachNhapHang as $index => $nhaphang) {
            $ids[$index] = $nhaphang['id'];
        }
        return $ids;
    }
    public function capnhatThongTinMatHangDaChon($mathang)
    {
        return [
            'id' => $mathang->id,
            'prevId' => $mathang->id,
            'MaMH' => $mathang->MaMH,
            'TenMH' => $mathang->TenMH,
            'TenDVT' => $mathang->donvitinh->TenDVT, 
            'DonGia' => (float)$mathang->GiaNhap, 
            'SoLuong' => 1, 
            'GiamGia' => 0, 
            'ThanhTien' => $mathang->GiaNhap
        ];
    }
    public function render()
    {      
        // $danhSachMatHang = MatHang::whereKey($this->danhSachIDMatHang)->with('donvitinh')->get();
        foreach($this->danhsachNhapHang as $index => $nhaphang) {  
            if($nhaphang['prevId'] != $nhaphang['id']) {
                $mathang = MatHang::where('id', $nhaphang['id'])->with('donvitinh')->first();   
                $this->danhsachNhapHang[$index] = $this->capnhatThongTinMatHangDaChon($mathang); 
            }  
        }  

        return view('livewire.phieu-nhap-kho.bang-them-mat-hang');
    }
}
