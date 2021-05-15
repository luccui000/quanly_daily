<?php

namespace App\Http\Livewire\BaoCao;

use Carbon\Carbon;
use App\Models\BaoCao;
use Livewire\Component;
use App\Models\NhanVien;
use Symfony\Component\HttpFoundation\Response;

class Index extends Component
{
    
    public $nhanvien_id;
    public $showModal = false;
    public $nhanvien = [];
    public $NgayLap;
    public $NoiDungBC;
    public $TenBC;
    public $isEditing = false;
    public BaoCao $baocao;
    public $danhsachBaoCao = [];
    public $baocaoEditId = [];

    public $danhsachBaoCaoDaChon = [];

    public function mount() 
    {
        $this->nhanvien = NhanVien::select('id', 'HoTenNV')->get();
        $this->NgayLap = now()->format('d/m/Y');
        $this->baocao = BaoCao::make();
        $this->nhanvien_id = NhanVien::all()->first()->id; 
        $this->danhsachBaoCao = BaoCao::with('nhanvien')->get();
    } 
    public function save()
    { 
        if(!$this->isEditing) {
            $this->baocao->create([
                'nhanvien_id' => $this->nhanvien_id,
                'TenBC' => $this->TenBC,
                'NoiDungBC' => $this->NoiDungBC,
                'created_at' => Carbon::createFromFormat('d/m/Y', $this->NgayLap)->format('d-m-Y'),
                'updated_at' => Carbon::createFromFormat('d/m/Y', $this->NgayLap)->format('d-m-Y'),
            ]); 
        } else {
            BaoCao::where('id', $this->baocaoEditId)
                ->update([
                    'nhanvien_id' => $this->nhanvien_id,
                    'TenBC' => $this->TenBC,
                    'NoiDungBC' => $this->NoiDungBC,
                    'created_at' => Carbon::createFromFormat('d/m/Y', $this->NgayLap)->format('d-m-Y'),
                    'updated_at' => Carbon::createFromFormat('d/m/Y', $this->NgayLap)->format('d-m-Y'),
                ]);
        }
        $this->showModal = false;
        $this->dispatchBrowserEvent("swal.modal",[
            'type' => 'success',
            'title' => 'Thêm thành công'
        ]);
        return redirect()->route('dashboard.baocao');
    }
    public function xoaBaoCao()
    {
        if(count($this->danhsachBaoCaoDaChon) > 0) {  
            $baocao = BaoCao::whereKey($this->danhsachBaoCaoDaChon);
            $baocao->delete();
            $this->danhsachBaoCaoDaChon = [];
            $this->dispatchBrowserEvent("swal.modal",[
                'type' => 'success',
                'title' => 'Xóa thành công'
            ]); 
            return redirect()->route('dashboard.baocao');
        } else  {  
            $this->dispatchBrowserEvent("swal.modal",[
                'type' => 'warning',
                'title' => 'Vui lòng chọn một bản ghi'
            ]);   
        }
    }
    public function edit(BaoCao $bc) 
    { 
        $this->nhanvien_id = $bc->nhanvien_id;
        $this->TenBC = $bc->TenBC;
        $this->NoiDungBC = $bc->NoiDungBC;
        $this->NgayLap = $bc->ngay_lap; 
        $this->showModal = true;
        $this->isEditing = true;
        $this->baocaoEditId = $bc->id;
    }
    public function xuatBaoCao($ext)
    {
        abort_if(!in_array($ext, ['csv', 'xlsx']), Response::HTTP_NOT_IMPLEMENTED);
        if(count($this->danhsachBaoCaoDaChon)) {
            return response()->streamDownload(function() {
                echo BaoCao::whereKey($this->danhsachBaoCaoDaChon)->toCsv();
            }, 'baocao_' . now() . '.' .$ext);
        } else  {
            $this->dispatchBrowserEvent("swal.modal",[
                'type' => 'warning',
                'title' => 'Vui lòng chọn một bản ghi'
            ]); 
        }
    }
    public function render()
    {
        return view('livewire.bao-cao.index')->extends('layouts.app');
    }
}
