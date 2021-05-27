<?php

namespace App\Http\Livewire\PhieuChi;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\NhanVien;
use App\Models\PhieuChi as PhieuChiModel;
use App\Models\PhieuHang;

class ThemMoiPhieuChi extends Component
{
    protected $listeners = ['themmoi' => 'ThemMoi', 'edit' => 'Edit'];
    public $showModal = false;
    
    public $NgayLap;
    public $NoiDungChi;
    public $nhanvien_id; 
    public $mapn_id;
    public $TongTien = 0;
    public $laCapNhat = false;
    public $idCapNhat = false;

    public PhieuChiModel $phieuchi;
    
    public $nhanvien = [];
    public $phieunhap = [];
    
    public function mount()
    {
        $this->NgayLap = now()->format('d/m/Y'); 
        $this->nhanvien = NhanVien::all();
        $this->phieuchi = PhieuChiModel::make();
        $this->nhanvien_id = NhanVien::first()->id;
        $this->phieunhap = PhieuHang::with('nhacungcap')->get();
    }

    public function ThemMoi()
    { 
        $this->showModal = true;
    }
    public function Edit(PhieuChiModel $phieuchi) 
    { 
        $this->showModal = true;
        $this->NgayLap = date_format(date_create($phieuchi->updated_at), 'd/m/Y');
        $this->NoiDungChi = $phieuchi->NoiDungChi;
        $this->nhanvien_id = $phieuchi->nhanvien_id; 
        $this->TongTien = money_format('%.0n', $phieuchi->TongTien);
        $this->laCapNhat = true;
        $this->idCapNhat = $phieuchi->id;
    }
    public function save()
    {
        $TienChiPhi = str_replace(',', '', $this->TongTien); 
        $TienChiPhi = str_replace('.', '', $TienChiPhi);
        $TienChiPhi = str_replace('₫', '', $TienChiPhi);
        // $TienChiPhi = substr($TienChiPhi,  -1, 1); 
        $this->validate(PhieuChiModel::VALIDATION_RULES);
        if(!$this->laCapNhat) {
            PhieuChiModel::create([
                'NoiDungChi' => $this->NoiDungChi,
                'TongTien' => +$TienChiPhi,
                'nhanvien_id' => $this->nhanvien_id,
                'mapn_id' => $this->mapn_id,
                'created_at' => Carbon::createFromFormat('d/m/Y', $this->NgayLap)->format('d-m-Y'),
                'updated_at' => Carbon::createFromFormat('d/m/Y', $this->NgayLap)->format('d-m-Y'),
            ]);
        } else {
            $phieuchi = PhieuChiModel::where('id', $this->idCapNhat)->first();
            $phieuchi->update([
                'NoiDungChi' => $this->NoiDungChi,
                'TongTien' => +$TienChiPhi,
                'nhanvien_id' => $this->nhanvien_id,
                'mapn_id' => $this->mapn_id,
                'created_at' => Carbon::createFromFormat('d/m/Y', $this->NgayLap)->format('d-m-Y'),
                'updated_at' => Carbon::createFromFormat('d/m/Y', $this->NgayLap)->format('d-m-Y'),
            ]);
        }
        
        $this->showModal = false; 
        return redirect()->route('dashboard.phieuchi.index');
    }
    public function render()
    {
        if($this->mapn_id != null) {
            $tien = PhieuHang::where('id', $this->mapn_id)->first()->TongThanhToan;
            $this->TongTien = money_format('%.0n', $tien);
        }
        return view('livewire.phieu-chi.them-moi-phieu-chi');
    }
}
