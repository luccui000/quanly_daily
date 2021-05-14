<?php

namespace App\Http\Livewire\PhieuChi;

use App\Models\PhieuChi;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class CongCuPhieuChi extends Component
{
    protected $listeners = ['detete' => 'Delete'];
    public $phieuchiDaChon = [];

    public function Delete($id)
    {
        if(!in_array($id, $this->phieuchiDaChon))
            array_push($this->phieuchiDaChon, $id);
        else {
            unset($this->phieuchiDaChon[array_search($id, $this->phieuchiDaChon)]);
            $this->phieuchiDaChon = array_values($this->phieuchiDaChon);
        }
    }
    public function deleteSelected()
    { 
        if(count($this->phieuchiDaChon) > 0) {  
            $nguoidung = PhieuChi::whereKey($this->phieuchiDaChon);
            $nguoidung->delete();
            $this->phieuchiDaChon = [];
            $this->dispatchBrowserEvent("swal.modal",[
                'type' => 'success',
                'title' => 'Xóa thành công'
            ]);
            return redirect()->route('dashboard.phieuchi.index');
        } else  {  
            $this->dispatchBrowserEvent("swal.modal",[
                'type' => 'warning',
                'title' => 'Vui lòng chọn một bản ghi'
            ]);   
        }
    }
    public function export($ext) 
    {
        abort_if(!in_array($ext, ['csv', 'xlsx']), Response::HTTP_NOT_IMPLEMENTED);
        if(count($this->phieuchiDaChon)) {
            return response()->streamDownload(function() {
                echo PhieuChi::whereKey($this->phieuchiDaChon)->toCsv();
            }, 'phieuchi_' . now() . '.' .$ext);
        } else  {
            $this->dispatchBrowserEvent("swal.modal",[
                'type' => 'warning',
                'title' => 'Vui lòng chọn một bản ghi'
            ]); 
        }
    }
    public function render()
    {
        return view('livewire.phieu-chi.cong-cu-phieu-chi');
    }
}
