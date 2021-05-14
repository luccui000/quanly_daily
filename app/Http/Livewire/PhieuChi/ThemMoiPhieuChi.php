<?php

namespace App\Http\Livewire\PhieuChi;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\NhanVien;
use App\Models\PhieuChi as PhieuChiModel;

class ThemMoiPhieuChi extends Component
{
    protected $listeners = ['themmoi' => 'ThemMoi', 'edit' => 'Edit'];
    public $showModal = false;
    
    public $NgayLap;
    public $NoiDungChi;
    public $nhanvien_id; 
    public $TongTien = 0;
    public $laCapNhat = false;
    public $idCapNhat = false;

    public PhieuChiModel $phieuchi;
    
    public $nhanvien = [];
    
    public function mount()
    {
        $this->NgayLap = now()->format('d/m/Y'); 
        $this->nhanvien = NhanVien::all();
        $this->phieuchi = PhieuChiModel::make();
        $this->nhanvien_id = NhanVien::first()->id;
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
        $TongTien = str_replace(',', '', $this->TongTien); 
        $this->validate(PhieuChiModel::VALIDATION_RULES);
        if(!$this->laCapNhat) {
            PhieuChiModel::create([
                'NoiDungChi' => $this->NoiDungChi,
                'TongTien' => +$TongTien,
                'nhanvien_id' => $this->nhanvien_id,
                'created_at' => Carbon::createFromFormat('d/m/Y', $this->NgayLap)->format('d-m-Y'),
                'updated_at' => Carbon::createFromFormat('d/m/Y', $this->NgayLap)->format('d-m-Y'),
            ]);
        } else {
            $phieuchi = PhieuChiModel::where('id', $this->idCapNhat)->first();
            $phieuchi->update([
                'NoiDungChi' => $this->NoiDungChi,
                'TongTien' => +$TongTien,
                'nhanvien_id' => $this->nhanvien_id,
                'created_at' => Carbon::createFromFormat('d/m/Y', $this->NgayLap)->format('d-m-Y'),
                'updated_at' => Carbon::createFromFormat('d/m/Y', $this->NgayLap)->format('d-m-Y'),
            ]);
        }
        
        $this->showModal = false; 
        return redirect()->route('dashboard.phieuchi.index');
    }
    public function render()
    {
        return view('livewire.phieu-chi.them-moi-phieu-chi');
    }
}
