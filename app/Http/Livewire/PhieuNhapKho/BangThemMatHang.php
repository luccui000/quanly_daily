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
    public function ThemMatHang(MatHang $nhaphang)
    {  
        if(in_array($nhaphang->id, $this->idMatHangDachon())) {
            $index = array_search($nhaphang->id, $this->idMatHangDachon());
            $this->danhsachNhapHang[$index]['SoLuong'] += 1; 
        } else {
            $this->danhsachNhapHang[count($this->danhsachNhapHang)] = [
                'id' => $nhaphang['id'],
                'prevId' => $nhaphang['id'],
                'MaMH' => $nhaphang->MaMH,
                'TenMH' => $nhaphang->TenMH,
                'TenDVT' => $nhaphang->donvitinh->TenDVT, 
                'DonGia' => (float)$nhaphang->GiaNhap, 
                'SoLuong' => 1, 
                'GiamGia' => 0, 
                'ThanhTien' => $nhaphang->GiaNhap
            ];   
        }
    }
    public function boMatHang($index)
    {

    }
    private function idMatHangDachon()
    {
        $ids = [];
        foreach($this->danhsachNhapHang as $index => $nhaphang) {
            $ids[$index] = $nhaphang['id'];
        }
        return $ids;
    }
    public function render()
    {      
        // $danhSachMatHang = MatHang::whereKey($this->danhSachIDMatHang)->with('donvitinh')->get();
        foreach($this->danhsachNhapHang as $index => $nhaphang) {  
            if($nhaphang['prevId'] != $nhaphang['id']) {
                $mathang = MatHang::where('id', $nhaphang['id'])->with('donvitinh')->first();   
                $this->danhsachNhapHang[$index] = [
                    'id' => $nhaphang['id'],
                    'prevId' => $nhaphang['id'],
                    'MaMH' => $mathang->MaMH,
                    'TenMH' => $mathang->TenMH,
                    'TenDVT' => $mathang->donvitinh->TenDVT, 
                    'DonGia' => (float)$mathang->GiaNhap, 
                    'SoLuong' => 1, 
                    'GiamGia' => 0, 
                    'ThanhTien' => $mathang->GiaNhap
                ]; 
            }  
        } 

        return view('livewire.phieu-nhap-kho.bang-them-mat-hang');
    }
}
