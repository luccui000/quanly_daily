<?php

namespace App\Http\Livewire;

use App\Models\CodeGenerator;
use App\Models\KhachHang as KhachHangModel;
use App\Models\NguoiDung;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\Response;

class KhachHang extends Component 
{
    use WithPagination;   
    public $modalTitle = '';
    public $isEdit = false;
    public $showModal = false; 
    public $checked = false;
    public $search = '';  
    public $selected = [];
    public $khachhangs;

    public $MaKH; 
    public $HoTenKH; 
    public $DiaChi; 
    public $DienThoai; 
    public $Email; 
    public $SoTaiKhoan;

    public KhachHangModel $editing;

    public function rules()
    {
        return [ 
            'HoTenKH' => 'required|max:50',
            'DiaChi' => 'required|max:100',
            'DienThoai' => 'required|numeric',  
        ];
    }
    public function messages()
    {
        return [ 
            'HoTenKH.required' => 'Vui lòng nhập họ tên khách hàng',
            'HoTenKH.max' => 'Vui lòng nhập tên dưới 50 ký tự',
            'DiaChi.required' => 'Vui lòng nhập địa chỉ',
            'DiaChi.max' => 'Vui lòng nhập địa chỉ dưới 100 ký tự',
            'DienThoai.required' => 'Vui lòng nhập số điện thoại',  
            'DienThoai.numeric' => 'Số điện thoại không hợp lệ', 
        ];
    }
    public function mount()
    {
        $this->editing =  $this->makeBlankKhachHang();
        $this->khachhangs = collect();
    }
    public function create(){ 
        $this->showModal = true;
        $this->isEdit = 0;
        $this->makeBlankKhachHang(); 
        $this->modalTitle = "Thêm mới khách hàng"; 
    }
    public function save()
    {
        $this->validate(); 
        if($this->isEdit) {
            
        } else {
            $MaKHCodeGenerator = CodeGenerator::find(1)->MaKhachHang;
            $strCode = '';
            if($MaKHCodeGenerator < 10000) {
                for($i = 0; $i < 4 - strlen($MaKHCodeGenerator); $i++) $strCode .= '0';
                $strCode .= $MaKHCodeGenerator; 
            } else {
                $strCode = $MaKHCodeGenerator;
            }
            CodeGenerator::find(1)->update(['MaKhachHang' => ++$MaKHCodeGenerator]);
            $this->editing->create([ 
                'MaKH' =>  'KH'. $strCode,
                'HoTenKH' => $this->HoTenKH,
                'DiaChi' => $this->DiaChi,
                'DienThoai' => $this->DienThoai,
                'Email' => $this->Email ?? null, 
                'SoTaiKhoan' => $this->SoTaiKhoan ?? null
            ]);
            $this->dispatchBrowserEvent('swal.modal', $this->dispatchAlert('success', 'Tao moi'));
        }
        $this->showModal = false;
    }
    public function dispatchAlert($type, $title, $content = null)
    {
        return $this->dispatchBrowserEvent('swal.modal', [
            'title' => $title,
            'content' => $content,
            'type' =>  $type
        ]);
    } 
    public function selectAll()
    {
        $this->selected = count($this->selected) ?  [] : array_merge($this->selected, $this->khachhangs); 
        $this->checked = count(($this->selected)) ? true: false;
    }
    public function edit(KhachHangModel $khachHang)
    {
        $this->modalTitle = 'Thay đổi thông tin khách hàng'; 
        $this->makeBlankKhachHang(); 
        $this->HoTenKH = $khachHang->HoTenKH;
        $this->MaKH = $khachHang->MaKH;
        $this->DienThoai = $khachHang->DienThoai;
        $this->DiaChi = $khachHang->DiaChi;
        $this->SoTaiKhoan = $khachHang->SoTaiKhoan;
        $this->Email = $khachHang->Email; 
        $this->showModal = true;
        $this->isEdit = 1;
    }
    public function export($ext)
    { 
        abort_if(!in_array($ext, ['csv', 'xlsx']), Response::HTTP_NOT_FOUND);
        if(count($this->selected)) {
            return response()->streamDownload(function() {
                echo KhachHangModel::whereKey($this->selected)->toCsv();
            }, 'khachhang.csv'); 
        } else  {
            $this->dispatchAlert("warning", "Vui lòng chọn một bản ghi");
        }
    }
    public function deleteSelected()
    {
        if(count($this->selected)) { 
            $nguoidung = KhachHangModel::whereKey($this->selected);
            $nguoidung->delete();
            $this->selected = [];
            $this->dispatchAlert("success", "Xóa thành công");
        } else  {
            $this->dispatchAlert("warning", "Vui lòng chọn một bản ghi");
        }
    }
    public function makeBlankKhachHang()
    {
        $this->reset('MaKH', 'HoTenKH', 'DiaChi', 'DienThoai', 'Email', 'SoTaiKhoan'); 
        $this->resetErrorBag(); 
        return KhachHangModel::make([]);
    }
    public function multiSearch() 
    { 
    }
    public function render()
    { 
        $khachhang = KhachHangModel::query()
                ->when($this->search, fn($query, $search) => $query->where('HoTenKH', 'like', '%'. $search.'%'))
                ->paginate(env('PAGINATE_PAGE') ?? 10);
        $this->khachhangs = $khachhang->pluck('id')->toArray();
        return view('livewire.khach-hang', compact('khachhang'))->extends('layouts.app');
    }
}
