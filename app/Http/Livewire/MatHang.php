<?php

namespace App\Http\Livewire;

use App\Models\CodeGenerator;
use App\Models\DonViTinh;
use App\Models\LoaiMatHang;
use App\Models\MatHang as MatHangModel;
use App\Models\NhaCungCap;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\Response;

class MatHang extends Component
{
    use WithPagination;
    public $search;
    public $modalTitle = "";
    public $showModal = false;
    public $isEdit = false; 
    public $showPriceFilter = false;
    public MatHangModel $mathangs; 

    public $MaMH;
    public $TenMH;
    public $ThongSo;
    public $BaoHanh;
    public $GiaNhap;
    public $GiaXuat;
    public $TrangThai = 0; 
    public $nhacungcap_id;
    public $loaimathang_id;
    public $donvitinh_id;
    public $mathang_id;

    public Collection $searchField;
    public $selected = [];
    public Collection $newUnit;
    public $showCreateNewUnit = false;

    public Collection $MucGia;

    protected $listenters = ['searchProduct' => 'change'];
    public function change()
    {
        dd("Change");
    }
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
        $this->MaMH = 'MH' . $this->getCodeGenerator();  
        $this->searchField = collect([
            'MaMH' => false,
            'TenMH' => true
        ]);
        $this->newUnit = collect(['DonViTinh' => false, 'NhaCungCap' => false ]);
        $this->MucGia = collect([
            'ThapNhat' => "",
            'CaoNhat' => "",
        ]);
    }
    public function createNewUnit($unit)
    {
        abort_if(!in_array($unit, ['DonViTinh', 'NhaCungCap']), Response::HTTP_NOT_MODIFIED);
        $this->showCreateNewUnit = true;
    }
    public function toggleFilterPrice()
    {  
        $this->showPriceFilter = !$this->showPriceFilter; 
    }
    public function create()
    {
        $this->isEdit = 0; 
        $this->makeBlankMatHang();
        $this->modalTitle = "Thêm mới mặt hàng";
        $this->MaMH = 'MH' . $this->getCodeGenerator();
        $this->showModal = true;
    }
    public function edit(MatHangModel $mathang)
    {
        $this->makeBlankMatHang();  
        $this->mathangs = $mathang;
        $this->MaMH = $mathang->MaMH;
        $this->TenMH = $mathang->TenMH;
        $this->ThongSo = $mathang->ThongSo;
        $this->BaoHanh = $mathang->BaoHanh; 
        $this->GiaNhap = $this->moneyFormat($mathang->GiaNhap); 
        $this->GiaXuat = $this->moneyFormat($mathang->GiaXuat);  
        $this->TrangThai = $mathang->TrangThai; 
        $this->nhacungcap_id = $mathang->nhacungcap_id;
        $this->loaimathang_id = $mathang->loaimathang_id;
        $this->donvitinh_id = $mathang->donvitinh_id;
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
            $this->store($this->mathangs);
            $this->mathangs->save(); 
            $this->dispatchAlert('success', 'Thay đổi thông tin thành công', '');
        } else {
            try {
                // dd($this->nhacungcap_id);
                $code = $this->getCodeGenerator();
                $code = $code + 1;
                $mathang = new MatHangModel();
                $mathang->MaMH = $this->MaMH;
                $this->store($mathang);
                $mathang->save(); 
                CodeGenerator::find(1)->update(['MaMatHang' => $code]);
                $this->MaMH = 'MH' . $this->getCodeGenerator();
                $this->dispatchAlert('success', 'Thêm thành công mặt hàng', '');
            } catch(\Exception $e) {
                $this->dispatchAlert('warning', 'Xảy ra lỗi' . $e->getMessage(), '');
            }
        }
        $this->showModal = false;
    }
    private function store(MatHangModel $mathang)
    {  
        $mathang->TenMH = $this->TenMH;
        $mathang->ThongSo = $this->ThongSo;
        $mathang->BaoHanh = $this->BaoHanh;
        $mathang->GiaNhap = $this->GiaNhap;
        $mathang->GiaXuat = $this->GiaXuat;
        $mathang->nhacungcap_id = $this->nhacungcap_id;
        $mathang->loaimathang_id = $this->loaimathang_id;
        $mathang->donvitinh_id = $this->donvitinh_id;
    }
    private function moneyFormat($value)
    {
        // thay the . thanh , 
        $value = str_replace('.', ',', money_format('%.0n', $value));
        // xoa ky tu dong ra khoi format
        return str_replace('₫', '', $value);
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
        abort_if(!in_array($ext, ['csv', 'xlsx']), Response::HTTP_NOT_FOUND);
        if(count($this->selected)) {
            return response()->streamDownload(function() {
                echo MatHangModel::whereKey($this->selected)->toCsv();
            }, 'mathang_' .now().'.'. $ext);
        } else  {
            $this->dispatchAlert("warning", "Vui lòng chọn một bản ghi");
        }
    }
    public function deleteSelected()
    {
        if(count($this->selected)) { 
            $nguoidung = MatHangModel::whereKey($this->selected);
            $nguoidung->delete();
            $this->selected = [];
            $this->dispatchAlert("success", "Xóa thành công");
        } else  {
            $this->dispatchAlert("warning", "Vui lòng chọn một bản ghi");
        }
    }
    public function importProducts()
    {
        dd($this->selected);
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
    private function getSelectedNewUnitFieldKeys()
    {
        return $this->newUnit->filter(fn($i, $q) => $i === true ? $q : '' )->keys();
    }
    
    public function render()
    {     
        if(!$this->showPriceFilter)  {
            $this->MucGia['ThapNhat'] = "";
            $this->MucGia['CaoNhat'] = "";
        } 
        $MucGiaThapNhat = str_replace(',', '', $this->MucGia['ThapNhat']);
        $MucGiaCaoNhat = str_replace(',', '', $this->MucGia['CaoNhat']); 
        $term =  '%' .$this->search. '%';
        $mathang = MatHangModel::query()
            ->with('loaimathang')
            ->with('donvitinh')
            ->with('nhacungcap')  
            ->when($this->showPriceFilter && strlen($MucGiaThapNhat) > 0 && strlen($MucGiaCaoNhat) > 0, 
                function($query) use ($MucGiaThapNhat, $MucGiaCaoNhat) { 
                    return $query->where('GiaNhap', '<=', $MucGiaCaoNhat)->where('GiaNhap', '>=', $MucGiaThapNhat);
                })
            ->where('TenMH', 'like', $term)
            ->orWhere('MaMH', 'like', $term)
            ->orWhere('MaMH', 'like', $term)
            ->orWhereHas('donvitinh', function($query) use ($term) { return $query->where('TenDVT', 'like', $term); })
            ->orWhereHas('nhacungcap', function($query) use ($term) { return $query->where('TenNCC', 'like', $term); })
            ->orWhereHas('loaimathang', function($query) use ($term) { return $query->where('TenLoaiMH', 'like', $term); })  
            ->paginate(env('PAGINATE_PAGE') ?? 10);  
        $nhacungcap = NhaCungCap::all();
        $donvitinh = DonViTinh::all();
        $loaimathang = LoaiMatHang::all();   
        return view('livewire.mat-hang', [
            'mathang' => $mathang,
            'nhacungcap' => $nhacungcap,
            'donvitinh' => $donvitinh,
            'loaimathang' => $loaimathang, 
            'MucGiaThapNhat' => $MucGiaThapNhat,
            'MucGiaCaoNhat' =>  $MucGiaCaoNhat
        ])->extends('layouts.app');
    }
}
