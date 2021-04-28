<?php

namespace App\Http\Livewire\PhieuNhapKho;

use App\Models\DonViTinh;
use App\Models\MatHang;
use Illuminate\Support\Collection;
use Livewire\Component;

class BangThemMatHang extends Component
{
    protected $listeners = ['ThemMatHang' => 'ThemMatHang'];
    
    public $ThanhTien = []; 
       
    public $danhsachNhapHang = [];
    public $danhsachMatHang = [];  
  

    public function mount()
    {        
        $this->danhsachMatHang = MatHang::with('donvitinh')->latest()->get();
        $this->danhsachNhapHang = [ ]; 
    }
    public function themMoiMatHang($index)
    {
        $mathang = MatHang::with('donvitinh')->inRandomOrder()->first();
        $this->danhsachNhapHang[] = [ 
            'id' => $mathang->id,
            'prevId' => $mathang->id,
            'MaMH' => $mathang->MaMH,
            'TenMH' => $mathang->TenMH,
            'TenDVT' => $mathang->donvitinh->TenDVT,
            'DonGia' => (float)$mathang->GiaNhap,
            'SoLuong' => 1, 
            'GiamGia' => 0, 
            'ThanhTien' => $mathang->GiaNhap,
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
        unset($this->ThanhTien[$index]);
        $this->ThanhTien =  array_values($this->ThanhTien); 
        unset($this->danhsachNhapHang[$index]);
        $this->danhsachNhapHang = array_values($this->danhsachNhapHang); 
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
            'DonGia' => $mathang->GiaNhap, 
            'SoLuong' => 1, 
            'GiamGia' => 0, 
            'ThanhTien' => $mathang->GiaNhap
        ];
    } 
    public function decrement($index) 
    {
        $this->danhsachNhapHang[$index]['SoLuong'] > 0 ? $this->danhsachNhapHang[$index]['SoLuong']-- : 0;
    }
    public function increment($index) 
    {   
        $this->danhsachNhapHang[$index]['SoLuong']++;
    }
    public function render()
    {      
        // $danhSachMatHang = MatHang::whereKey($this->danhSachIDMatHang)->with('donvitinh')->get();  
        $TongTienHang = 0; 
        foreach($this->danhsachNhapHang as $index => $nhaphang) {   
            if($nhaphang['prevId'] != $nhaphang['id']) {   
                $mathang = MatHang::where('id', $nhaphang['id'])->with('donvitinh')->first(); 
                $nhaphang = $this->capnhatThongTinMatHangDaChon($mathang);   
            }   
            $GiaGoc =  $nhaphang['SoLuong'] * $nhaphang['DonGia'];
            $nhaphang['ThanhTien'] = $GiaGoc - ($GiaGoc * $nhaphang['GiamGia'] / 100);
            $this->danhsachNhapHang[$index] = $nhaphang;
            $TongTienHang += $nhaphang['ThanhTien'];
        }   
        $this->emitTo('phieu-nhap-kho.phieu-thong-tin', 'capnhatTongTienHang', $TongTienHang);
        return view('livewire.phieu-nhap-kho.bang-them-mat-hang');
    }
}
