<?php

namespace App\Http\Livewire;

use App\Exports\NguoiDungExport;
use App\Models\NguoiDung;
use App\Models\NhanVien;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;   

class HoSo extends Component
{
    use WithPagination;
    public NguoiDung $editing;
    public $search = '';
    public $sortDirection = 'asc';
    public $sortBy = 'TenDangNhap';
    public $selected = [];
    public $showEditModal = false; 
    public $modaTitle = "";
    public $TenDangNhap = "";
    public $MatKhau = "";
    public $LanDangNhapCuoi = "";
    public $TrangThai = 1;
    public $isEdit = false;
    public Collection $selectedNguoidung;
    public $nhanvien = [];
    public $nhanvien_id;

    public function mount()
    {  
        $this->editing = $this->makeBlankNguoiDung(); 
        $this->nhanvien = NhanVien::select('id', 'HoTenNV')->get(); 
    }
    public function rules()
    {
        return [
            'TenDangNhap' => 'required|unique:NGUOIDUNG|min:6|max:30',
            'MatKhau' => 'required|min:6|max:30', 
            'TrangThai' => 'in:0,1',
            'nhanvien_id' => 'unique:App\Models\NguoiDung,nhanvien_id'
        ];
    }
    public function sortBy($field)
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        return $this->sortBy = $field;
    }
    public function edit(NguoiDung $nguoidung)
    {    
        $this->editing = $nguoidung;
        $this->TenDangNhap = $nguoidung->TenDangNhap;
        $this->TrangThai = $nguoidung->TrangThai;
        $this->MatKhau = $nguoidung->MatKhau;
        $this->LanDangNhapCuoi = $nguoidung->LanDangNhapCuoi;
        $this->showEditModal = true;
        $this->isEdit = 1;
        $this->modaTitle = "Sửa thông tin người dùng";
    }
    public function create()
    {
        $this->isEdit = 0;
        $this->makeBlankNguoiDung();
        $this->showEditModal = true;
        $this->modaTitle = "Thêm mới người dùng";
    }
    public function save()
    {
        if($this->isEdit) { 
            NguoiDung::where('TenDangNhap', $this->TenDangNhap)
                ->update([
                    'TenDangNhap' => $this->TenDangNhap,
                    'MatKhau' => Hash::make($this->MatKhau),
                    'LanDangNhapCuoi' => $this->LanDangNhapCuoi,
                    'TrangThai' => $this->TrangThai
                ]);
        } else {
            $this->validate(); 
            $this->editing->create([
                'TenDangNhap' => $this->TenDangNhap,
                'MatKhau' => Hash::make($this->MatKhau),
                'LanDangNhapCuoi' => now(),
                'TrangThai' => $this->TrangThai,
                'nhanvien_id' => $this->nhanvien_id
            ]);
        }
        $this->showEditModal = false;
    }
    public function makeBlankNguoiDung()
    {
        $this->reset('TenDangNhap', 'TrangThai', 'MatKhau', 'LanDangNhapCuoi'); 
        return NguoiDung::make(['LanDangNhapCuoi' => now(), 'TrangThai' => 1]);
    }
    public function getSelectedNguoidung()
    {
        return $this->selectedNguoidung->filter(fn($p) => $p)->keys();
    }
    public function export($ext)
    { 
        if(count($this->selected)) {
            return response()->streamDownload(function() {
                echo NguoiDung::whereKey($this->selected)->toCsv();
            }, 'nguoidung.csv');
        } else  {
            $this->dispatchAlert("warning", "Vui lòng chọn một bản ghi");
        }
    }
    public function deleteSelected()
    { 
        if(count($this->selected)) { 
            $nguoidung = NguoiDung::whereKey($this->selected);
            $nguoidung->delete();
            $this->selected = [];
            $this->dispatchAlert("success", "Xóa thành công");
        } else  {
            $this->dispatchAlert("warning", "Vui lòng chọn một bản ghi");
        }
    } 
    public function dispatchAlert($type, $title, $content = null)
    {
        return $this->dispatchBrowserEvent('swal.modal', [
            'title' => $title,
            'content' => $content,
            'type' =>  $type
        ]);
    }
    public function render()
    { 
        return view('livewire.ho-so', [
                'hoso' => NguoiDung::query()
                        ->when($this->search, fn($query, $search) => $query->where('TenDangNhap', 'like', '%'.$search.'%'))
                        ->orderBy($this->sortBy, $this->sortDirection)
                        ->paginate(env('PAGINATE_PAGE') ?? 10)
            ])->extends('layouts.app');
    }
}
