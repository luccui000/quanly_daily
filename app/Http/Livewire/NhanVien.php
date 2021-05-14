<?php

namespace App\Http\Livewire;

use App\Models\ChucVu;
use App\Models\NhanVien as ModelsNhanVien;
use Illuminate\Database\Eloquent\Model; 
use Livewire\Component;
use Livewire\WithPagination;

class NhanVien extends Component
{
    use WithPagination;
    public $search = '';
    public $nhanviens;
    public $selectColumnsView = [];
    public $selected = [];
    public $checked = false;
    public $modalTitle = '';
    public $isEdit = false;
    public $showModal = false; 

    public $MaNV;
    public $HoTenNV;
    public $DienThoai;
    public $DiaChi;
    public $NgaySinh;
    public $GioiTinh;
    public $Email;
    public $TrangThai;
    public $chucvu_id;

    public function rules()
    {
        return [
            'HoTenNV' => 'required|min:6|max:70',
            'DienThoai' => 'required|min:10|max:11',
            'DiaChi' => 'required|max:100',
            'NgaySinh' => 'required|date',
            'GioiTinh' => 'required|in:0,1',  
            'chucvu_id' => 'required:in'. ChucVu::pluck('id'),
        ];
    }
    public function messages()
    {
        return [
            'HoTenNV.required' => 'Vui lòng nhập họ tên',
            'HoTenNV.min' => 'Vui lòng nhập họ tên trên 6 ký tự',
            'HoTenNV.max' => 'Vui lòng nhập họ tên dưới 70 ký tự',
            'DienThoai.required' => 'Vui lòng nhập số điện thoại', 
            'DienThoai.min' => 'Vui lòng nhập đúng số điện thoại',
            'DienThoai.max' => 'Vui lòng nhập đúng số điện thoại',
            'DiaChi.required' => 'Vui lòng nhập địa chỉ',
            'DiaChi.max' => 'Vui lòng nhập địa chỉ dưới 100 ký tự',
            'NgaySinh.required' => 'Vui lòng nhập ngày sinh',
            'NgaySinh.date' => 'Vui lòng chọn ngày sinh trước hôm nay',
            'GioiTinh.required' => 'Vui lòng chọn giới tính',
            'GioiTinh.in' => 'Vui lòng chọn đúng giới tính',
        ];
    }
    public function mount() 
    {
        $this->nhanviens = collect();  
        $this->GioiTinh = 1;
    }
    public function deleteSelected()
    {
        if(count($this->selected)) { 
            $nguoidung = ModelsNhanVien::whereKey($this->selected);
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
    public function export($ext)
    { 
        if(count($this->selected)) {
            return response()->streamDownload(function() {
                echo ModelsNhanVien::whereKey($this->selected)->toCsv();
            }, 'nhanvien.csv');
        } else  {
            $this->dispatchAlert("warning", "Vui lòng chọn một bản ghi");
        }
    }
    public function selectAll()
    {
        $this->selected = count($this->selected) ?  [] : array_merge($this->selected, $this->nhanviens); 
        $this->checked = count(($this->selected)) ? true: false;
    }
    public function create()
    {
        $this->modalTitle = "Thêm mới nhân viên"; 
        $this->showModal = true;
    }
    public function save()
    { 
        $this->validate();
        $items = NhanVien::create([ 
            'MaNV' => $this->MaNV,
            'HoTenNV' => $this->HoTenNV,
            'DienThoai' => $this->DienThoai,
            'DiaChi' => $this->DiaChi,
            'NgaySinh' => $this->NgaySinh,
            'GioiTinh' => $this->GioiTinh,
            'Email' => $this->Email,
            'TrangThai' => $this->TrangThai,
            'chucvu_id' => $this->chucvu_id
        ]);  
        $this->showModal = false;
        $this->dispatchAlert('success', 'Tạo nhân viên thành công');
    }
    public function setGioiTinh($gt) {
        $this->GioiTinh = $gt;
    }
    public function makeBlankNhanVien()
    {
        $this->reset('HoTenNV', 'DienThoai', 'DiaChi', 'NgaySinh', 'GioiTinh', 'Email', 'TrangThai');
    }
    public function render()
    {
        $nhanvien = ModelsNhanVien::query()->with('chucvu')
                    ->when($this->selectColumnsView, fn($query, $selectColumnsView) => $query->select(array_merge($selectColumnsView, ['chucvu_id'])))
                    ->when($this->search, fn($query) => $query->where('HoTenNV', 'like', '%'. $this->search .'%'))
                    ->paginate(env('PAGINATE_PAGE') ?? 10);
        $chucvu = ChucVu::all();
        $this->nhanviens = $nhanvien->pluck('id')->toArray();
        return view('livewire.nhan-vien', compact('nhanvien', 'chucvu'))->extends('layouts.app');;
    }
}
