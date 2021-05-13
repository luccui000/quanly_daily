<?php

namespace App\Http\Livewire;

use App\Models\CodeGenerator;
use App\Models\Kho;
use App\Models\MatHang;
use App\Models\NhaCungCap;
use App\Models\PhieuHang;
use Carbon\Carbon;
use Illuminate\Support\Collection; 
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class PhieuNhapKho extends Component
{

    protected $listeners = ['ThemNhapKho' => 'ThemVaoNhapKho']; 
 
    
    public Collection $soluong;
    public Collection $giamgia;
    public Collection $thanhtien;
    public Collection $mathangs; 
    public PhieuHang $phieuhang; 

    public $tongGiamGia = 0;
    public $TongTienHang = 0;
    public $TongTienTraNCC = 0; 
    public float $TongVAT = 0;
    public $idMatHang = [];
    public $phieuhangs = [];
    public $showEditModal = false;
    public $mathangEditing = [];
    public PhieuHang $phieuhangEditing;

    public function rules()
    {
        return [
            'MaPH' => 'required', 
            'NgayLap' => 'required', 
            'TongTien' => 'required',
            'TongVAT' => 'required',
            'Tong_ChietKhau' => 'required',
            'TongThanhToan' => 'required',
            'HinhThucThanhToan' => 'required', 

            'nhanvien_id' => 'required',
            'kho_id' => 'required',
            'nhacungcap_id' => 'required',
        ];
    }
    public function mount()
    {
        $this->phieuhangs = PhieuHang::with(['nhacungcap', 'nhanvien', 'kho'])->get();   
    }
    public function ThemVaoNhapKho($id)
    {    
        if(!in_array($id, $this->idMatHang)) {
            array_push($this->idMatHang, $id);  
        }
    }
    public function refresh()
    {  
        $this->emit('search-drop-down', 'refreshSeachProduct');
        return $this->reset('MoTa', 'TongTien', 'TongVAT', 'Tong_ChietKhau', 'TongThanhToan', 'HinhThucThanhToan', 'TrangThai');
    }
    public function create()
    { 
        $this->showModal = true;
        $this->reset('tongGiamGia', 'TongTienHang', 'TongTienTraNCC');
    }

    public function save()
    {
        if(count($this->idMatHang) == 0)
            $this->dispatchAlert('warning', 'Vui lòng chọn mặt hàng'); 
        else { 
            $this->phieuhang->insert([
                'MaPH' => 'PH'.$this->MaPH,
                'NgayLap' => now(),
                'MoTa' => $this->MoTa ?? "",
                'TongTien' => $this->TongTienHang,
                'TongVAT' => $this->TongVAT,
                'Tong_ChietKhau' => $this->TongTienHang * $this->tongGiamGia / 100,
                'TongThanhToan' => $this->TongTienTraNCC,
                'HinhThucThanhToan' => $this->HinhThucThanhToan,
                'TrangThai' => 1,
                'nhanvien_id' => $this->nhanvien_id,
                'kho_id' => $this->kho_id,
                'nhacungcap_id' => $this->nhacungcap_id,
            ]); 
        }
    }
    public function store($phieuhang)
    {   
        $phieuhang->MaPH = 'PH'.$this->MaPH;
        $phieuhang->NgayLap = now();
        $phieuhang->MoTa = $this->MoTa ?? "";
        $phieuhang->TongTien = $this->TongTienHang;
        $phieuhang->TongVAT = $this->TongVAT;
        $phieuhang->Tong_ChietKhau = $this->TongTienHang * $this->tongGiamGia / 100;
        $phieuhang->TongThanhToan = $this->TongTienTraNCC;
        $phieuhang->HinhThucThanhToan = $this->HinhThucThanhToan;
        $phieuhang->TrangThai = 1;

        $phieuhang->nhanvien_id = $this->nhanvien_id;
        $phieuhang->kho_id = $this->kho_id;
        $phieuhang->nhacungcap_id = $this->nhacungcap_id; 
    }
    public function change()
    {
        $this->emit('searchProduct');
    } 
    public function showEditPhieuNhapKhoModal(PhieuHang $id)
    {
        $this->phieuhangEditing = $id;
        $this->mathangEditing = $id->mathang()->get();
        $this->showEditModal = true;
    }
    public function increment($index) {
        $this->phieuhangEditing->mathang()->get()[$index]->pivot->SoLuong++;
    }
    public function decrement($index) {
        $this->phieuhangEditing->mathang()->get()[$index]->pivot->SoLuong--;
    }
    public function render()
    {           
        return view('livewire.phieu-nhap-kho')->extends('layouts.app');
    }
    public function dispatchAlert($type, $title, $content = null)
    {
        $this->dispatchBrowserEvent('swal.modal', [
            'title' => $title,
            'content' => $content,
            'type' =>  $type
        ]);
    } 
}
