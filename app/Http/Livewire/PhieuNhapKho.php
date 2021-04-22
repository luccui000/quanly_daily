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
    public $showModal = false;

    public $searchProduct = "";
    public $MaPH; 
    public $NgayLap;
    public $MoTa;
    public $TongTien;
    public int $Tong_VAT = 0;
    public float $Tong_ChietKhau;
    public float $TongThanhToan;
    public float $HinhThucThanhToan;
    public int $TrangThai; 
    public int $nhanvien_id;
    public int $kho_id;
    public int $nhacungcap_id;
    
    public Collection $soluong;
    public Collection $giamgia;
    public Collection $thanhtien;
    public Collection $mathangs;
    public Collection $nhacungcap;
    public PhieuHang $phieuhang;
    public Collection $kho;

    public $tongGiamGia = 0;
    public $TongTienHang = 0;
    public $TongTienTraNCC = 0; 
    public $idMatHang = [];

    public function rules()
    {
        return [
            'MaPH' => 'required', 
            'NgayLap' => 'required', 
            'TongTien' => 'required',
            'Tong_VAT' => 'required',
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
        abort_if(!auth()->user()->id, Response::HTTP_FORBIDDEN);
        $this->nhanvien_id = 1;// auth()->user()->id;
        $this->NgayLap = date_format(date_create(now()), 'd/m/Y');
        $this->soluong = collect();
        $this->giamgia = collect();
        $this->mathangs = collect();  
        $this->thanhtien = collect();  
        $this->nhacungcap = collect();  
        $this->phieuhang = new PhieuHang();  

        $this->TongThanhToan = 0;
        $this->HinhThucThanhToan = 1; 
        $this->kho_id = 1;
        $this->nhacungcap_id = 1;

        foreach(MatHang::all() as $item) {
            $this->soluong[$item->id] = 1;
            $this->giamgia[$item->id] = 0; 
            $this->thanhtien[$item->id] = 0;
        } 
        $this->MaPH = getCodeGenerator('MaPhieuNhap');

        $this->nhacungcap = NhaCungCap::all();   
        $this->kho = Kho::all();
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
        return $this->reset('MoTa', 'TongTien', 'Tong_VAT', 'Tong_ChietKhau', 'TongThanhToan', 'HinhThucThanhToan', 'TrangThai');
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
            try { 
                // $this->validate();
                $phieuhangMoi = new PhieuHang();
                $this->phieuhang->create([
                    'MaPH' => 'PH'.$this->MaPH,
                    'NgayLap' => now(),
                    'MoTa' => $this->MoTa ?? "",
                    'TongTien' => $this->TongTienHang,
                    'Tong_VAT' => $this->Tong_VAT,
                    'Tong_ChietKhau' => $this->TongTienHang * $this->tongGiamGia / 100,
                    'TongThanhToan' => $this->TongTienTraNCC,
                    'HinhThucThanhToan' => $this->HinhThucThanhToan,
                    'TrangThai' => 1,
                    'nhanvien_id' => $this->nhanvien_id,
                    'kho_id' => $this->kho_id,
                    'nhacungcap_id' => $this->nhacungcap_id,
                ]);
                
                // $phieuhangMoi->MaPH = 'PH'.$this->MaPH;
                // $phieuhangMoi->NgayLap = now();
                // $phieuhangMoi->MoTa = $this->MoTa ?? "";
                // $phieuhangMoi->TongTien = $this->TongTienHang;
                // $phieuhangMoi->Tong_VAT = $this->Tong_VAT;
                // $phieuhangMoi->Tong_ChietKhau = $this->TongTienHang * $this->tongGiamGia / 100;
                // $phieuhangMoi->TongThanhToan = $this->TongTienTraNCC;
                // $phieuhangMoi->HinhThucThanhToan = $this->HinhThucThanhToan;
                // $phieuhangMoi->TrangThai = 1;

                // $phieuhangMoi->nhanvien_id = $this->nhanvien_id;
                // $phieuhangMoi->kho_id = $this->kho_id;
                // $phieuhangMoi->nhacungcap_id = $this->nhacungcap_id;  
                // $phieuhangMoi->save();
                // $this-
                $this->showModal = false;
                $this->dispatchAlert('success', 'Thêm phiếu nhập hàng thành công');
            }catch(\Exception $e) {
                $this->dispatchAlert('warning', 'Xảy ra lỗi' . $e->getMessage()); 
            }
        }
    }
    public function store($phieuhang)
    {   
        $phieuhang->MaPH = 'PH'.$this->MaPH;
        $phieuhang->NgayLap = now();
        $phieuhang->MoTa = $this->MoTa ?? "";
        $phieuhang->TongTien = $this->TongTienHang;
        $phieuhang->Tong_VAT = $this->Tong_VAT;
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
    public function render()
    {    
        $mathangIndex = PhieuHang::with(['nhacungcap', 'nhanvien', 'kho'])->get();  
        $this->TongTienHang = 0;    
        if(count($this->idMatHang) > 0) {
            $this->mathangs = MatHang::whereKey($this->idMatHang)->get();
        }
        
        $this->mathangs->map(function($item) {
            $thanhtienItem  = $this->soluong[$item->id] * $item->GiaNhap - ($this->soluong[$item->id] * $item->GiaNhap * ($this->giamgia[$item->id] / 100));
            $this->TongTienHang += $thanhtienItem; 
            $this->thanhtien[$item->id] = $thanhtienItem; 
        });  

        // Tiền trả nhà cung cấp = Tổng tiền hàng - Tổng tiền VAT - Tổng tiền giảm giá
        $TienVAT = $this->TongTienHang * $this->Tong_VAT / 100; 
        $TienGiamGia = $this->TongTienHang  * $this->tongGiamGia / 100;
        
        $this->TongTienTraNCC = $this->tongGiamGia >= 0 ?  
                                    $this->TongTienHang + $TienVAT - $TienGiamGia
                                    : $this->TongTienHang;  
        return view('livewire.phieu-nhap-kho', [
            'mathangIndex' => $mathangIndex,
            'mathang' => $this->mathangs,
            'thanhtien' => $this->thanhtien,
            'TongTienHang' => $this->TongTienHang, 
            'tongtientrancc' => $this->TongTienTraNCC,
            'nhacungcap' => $this->nhacungcap, 
            'kho' => $this->kho, 
            'idMatHang' => $this->idMatHang
        ])->extends('layouts.app');
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
