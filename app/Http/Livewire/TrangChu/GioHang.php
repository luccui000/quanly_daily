<?php

namespace App\Http\Livewire\TrangChu;

use App\Models\MatHang;
use Livewire\Component;
use App\Models\PhieuXuat;  

class GioHang extends Component
{
    public $danhsachGioHang = [];
    public $danhsachSoLuong = []; 
    protected $listeners = ['themMoi' => 'capNhatGioHang'];
      
    public function mount()
    {
        $this->capNhatGioHang();
    }
    public function xoaHang($idMh)
    {
        $this->emit('xoaMatHang', $idMh);
    } 
    public function render()
    {
        $tienHang = 0;  
        $data = $this->danhsachGioHang->toArray();
        if(count($this->danhsachGioHang) > 0) {
            foreach($data as $index => $item) {
                $tienHang += $item['GiaXuat'] * $this->danhsachSoLuong[$index];
            } 
        } 
        return view('livewire.trang-chu.gio-hang', compact('tienHang'))
                ->extends('layouts.index');
    }
    public function thanhtoan()
    {
        $khachhang = auth()->guard('khachhangs')->user();
        if($khachhang == null) {
            return redirect()->route('khachhang.dangnhap');
        }
        $diachiKhachHang = $khachhang->DiaChi;
        $dienthoaiKhachHang = $khachhang->DienThoai;
        if($diachiKhachHang == "" || $dienthoaiKhachHang == "") {
            dd('Vui long cap nhat thong tin');
        }
        $khachhangId = $khachhang->id;
        $tongTienHang = 0;
        $tongGiamGia = 0;
        $tongVAT = 0;
        foreach($this->danhsachGioHang as $index => $giohang) {
            $tongTienHang += $giohang['GiaXuat'] * (+$this->danhsachSoLuong[$index]); 
        } 
        $phieuxuat = PhieuXuat::create([  
            'MoTa' => " ",
            'TongTien' => $tongTienHang,
            'TongVAT' => $tongVAT,
            'TongChietKhau' => $tongGiamGia,
            'TongThanhToan' => $tongTienHang + $tongVAT - $tongGiamGia,
            'HinhThucThanhToan' => 1,
            'TrangThai' => 0, 
            'nhanvien_id' => 1,
            'kho_id' => 1,
            'khachhang_id' => $khachhangId
        ]); 

        foreach ($this->danhsachGioHang as $index => $mathang) {
            $dongiaMatHang = MatHang::where('id', $mathang['id'])->first()->GiaXuat;
            $phieuxuat->mathang()->attach($mathang['id'], [
                'SoLuong' => $this->danhsachSoLuong[$index],
                'DonGia' => $dongiaMatHang,
                'TienChietKhau' => 0,
                'TienVAT' => 0,
                'ThanhTien' => $dongiaMatHang * (+$this->danhsachSoLuong[$index]),
                'LoaiPhieu' => 1
            ]);
        }
        request()->session()->put('giohang', null); 
        $this->dispatchBrowserEvent('swal.modal', [
            'type' => 'success',
            'title' => 'Đặt hàng thành công'
        ]);
    }
    public function capNhatGioHang()
    {
        $mathang = request()->session()->get('giohang');
        $mathangIds = array_column($mathang ?? [], 'mathang');
        $this->danhsachSoLuong = array_column($mathang  ?? [], 'soluong');
        $this->danhsachGioHang = MatHang::whereKey($mathangIds)->get();
    }
} 