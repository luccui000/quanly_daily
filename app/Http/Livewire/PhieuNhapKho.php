<?php

namespace App\Http\Livewire;

use App\Models\MatHang;
use App\Models\NhaCungCap;
use App\Models\PhieuHang;
use Illuminate\Support\Collection;
use Livewire\Component;

class PhieuNhapKho extends Component
{

    protected $listeners = ['ThemNhapKho' => 'ThemVaoNhapKho'];
    public $showModal = false;

    public $searchProduct = "";
    public $MaPH; 
    public $NgayLap;
    public $MoTa;
    public $TongTien;
    public $Tong_VAT;
    public $Tong_ChietKhau;
    public $TongThanhToan;
    public $HinhThucThanhToan;
    public $TrangThai; 


    public $nhanvien_id;
    public $kho_id;
    public $nhacungcap_id;
    public Collection $soluong;
    public Collection $giamgia;
    public Collection $thanhtien;
    public Collection $mathangs;
    public Collection $nhacungcap;
    public $tongGiamGia = 0;
    public $tongtienhang = 0;
    public $tongtientrancc = 0;
    public $idMatHang = [];

    public function mount()
    {
        $this->NgayLap = date_format(date_create(now()), 'd/m/Y');
        $this->soluong = collect();
        $this->giamgia = collect();
        $this->mathangs = collect();  
        $this->thanhtien = collect();  
        $this->nhacungcap = collect();  
        foreach(MatHang::all() as $item) {
            $this->soluong[$item->id] = 1;
            $this->giamgia[$item->id] = 0; 
            $this->thanhtien[$item->id] = 0;
        } 
        $this->nhacungcap = NhaCungCap::all(); 
    }
    public function ThemVaoNhapKho($id)
    {   
        // dd(in_array($id, $this->idMatHang));
        if(!in_array($id, $this->idMatHang)) {
            array_push($this->idMatHang, $id);  
        }
    }
    public function create()
    { 
        $this->showModal = true;
        $this->reset('tongGiamGia', 'tongtienhang', 'tongtientrancc');
    }

    public function save()
    {
        dd("OKE");
    }
    public function change()
    {
        $this->emit('searchProduct');
    } 
    public function render()
    {    
        $phieuhang = PhieuHang::query()
                    ->with('nhacungcap')
                    ->with('nhanvien')
                    ->with('kho')->get();
        $term = '%'. $this->searchProduct .'%'; 
        $this->tongtienhang = 0;   
          

        
        $this->mathangs = MatHang::whereKey($this->idMatHang)->get();
        
        $this->mathangs->map(function($item) {
            $thanhtienItem  = $this->soluong[$item->id] * $item->GiaNhap - ($this->soluong[$item->id] * $item->GiaNhap * ($this->giamgia[$item->id] / 100));
            $this->tongtienhang += $thanhtienItem; 
            $this->thanhtien[$item->id] = $thanhtienItem; 
        });  
        $this->tongtientrancc = $this->tongGiamGia > 0 ?  
                                    $this->tongtienhang - ($this->tongtienhang * ($this->tongGiamGia / 100)) 
                                    : $this->tongtienhang;  
        return view('livewire.phieu-nhap-kho', [
            'phieuhang' => $phieuhang,
            'mathang' => $this->mathangs,
            'thanhtien' => $this->thanhtien,
            'tongtienhang' => $this->tongtienhang, 
            'tongtientrancc' => $this->tongtientrancc,
            'nhacungcap' => $this->nhacungcap, 
            'idMatHang' => $this->idMatHang
        ])->extends('layouts.app');
    }
}
