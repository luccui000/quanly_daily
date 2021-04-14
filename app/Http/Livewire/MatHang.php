<?php

namespace App\Http\Livewire;

use App\Models\CodeGenerator;
use App\Models\DonViTinh;
use App\Models\LoaiMatHang;
use App\Models\MatHang as MatHangModel;
use App\Models\NhaCungCap;
use Livewire\Component;

class MatHang extends Component
{
    public $modalTitle = "";
    public $showModal = false;
    public $isEdit = false; 
    public MatHangModel $mathangs;

    public $MaMH;
    public $TenMH;
    public $ThongSo;
    public $BaoHanh;
    public $GiaNhap = '12345689';
    public $GiaXuat = '14121122';
    public $TrangThai = 0; 
    public $nhacungcap_id;
    public $loaimathang_id;
    public $donvitinh_id;

    public function rules()
    {  
        return [ 
            'TenMH' => 'required|max:100',
            'ThongSo' => 'required|max:500',
            'BaoHanh' => 'required|max:50',
            'GiaNhap' => 'required|numeric',
            'GiaXuat' => 'required|numeric'
        ];
    }
    public function mount()
    {
        $this->mathangs = $this->makeBlankMatHang();  
    }
    public function create()
    {
        $this->modalTitle = "Thêm mới mặt hàng";
        $this->showModal = true;
    }
    public function edit($mathang)
    {
        $this->makeBlankMatHang();
        $this->isEdit = 1;
        $this->modalTitle = "Thay đổi thông tin mặt hàng";
        $this->showModal = true;
    }
    public function save()
    {
        $this->GiaNhap = str_replace(',', '', $this->GiaNhap);
        $this->GiaXuat = str_replace(',', '', $this->GiaXuat);
 
        $this->validate();
        if($this->isEdit) {
            dd("Edit");
        } else {
            try {
                dd($this->donvitinh_id);
                $this->mathangs->create([
                    'MaMH' => $this->MaMH,
                    'TenMH' => $this->TenMH,
                    'ThongSo' => $this->ThongSo,
                    'BaoHanh' => $this->BaoHanh,
                    'GiaNhap' => $this->GiaNhap,
                    'GiaXuat' => $this->GiaXuat,
                    'TrangThai' => $this->TrangThai,
                    'nhacungcap_id' => $this->nhacungcap_id,
                    'loaimathang_id' => $this->loaimathang_id,
                    'donvitinh_id' => $this->donvitinh_id,
                ]);
                $code = $this->getCodeGenerator();
                CodeGenerator::find(1)->update(['MaKhachHang' => ++$code]);
                $this->dispatchAlert('success', 'Thêm thành công mặt hàng', '');
            } catch(\Exception $e) {
                $this->dispatchAlert('warning', 'Xảy ra lỗi' .$e->getMessage(), '');
            }
            $this->showModal = false;
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
    public function makeBlankMatHang()
    {
        $this->reset('MaMH', 'TenMH', 'ThongSo', 'BaoHanh', 'GiaNhap', 'GiaXuat', 'TrangThai', 'nhacungcap_id', 'donvitinh_id', 'loaimathang_id');
        return MatHangModel::make([]);
    } 
    public function getCodeGenerator()
    {
        $codegenerate = CodeGenerator::find(1)->MaMatHang; 
        $strCode = '';
        if($codegenerate < 10000) {
            for($i = 0; $i < 4 - strlen($codegenerate); $i++) $strCode .= '0';
            $strCode .= $codegenerate; 
        } else {
            $strCode = $codegenerate;
        }
        return $strCode;
    }
    public function render()
    { 
        $mathang = MatHangModel::query()
            ->with('loaimathang')
            ->with('donvitinh')
            ->with('nhacungcap') 
            ->paginate(env('PAGINATE_PAGE') ?? 10); 
        $nhacungcap = NhaCungCap::all();
        $donvitinh = DonViTinh::all();
        $loaimathang = LoaiMatHang::all(); 
        $this->MaMH = strlen($this->MaMH) > 0 ? $this->MaMH : 'MH' . $this->getCodeGenerator();
        return view('livewire.mat-hang', [
            'mathang' => $mathang,
            'nhacungcap' => $nhacungcap,
            'donvitinh' => $donvitinh,
            'loaimathang' => $loaimathang, 
        ])->extends('layouts.app');
    }
}
