<?php

namespace App\Http\Livewire\PhieuXuat;

use Livewire\Component;
use App\Models\PhieuXuat;
use Symfony\Component\HttpFoundation\Response;

class CongCuPhieuXuat extends Component
{
    protected $listeners = ['detete' => 'Delete'];

    public $phieuXuatDaChon = [];

    public function Delete($id)
    {
        if(!in_array($id, $this->phieuXuatDaChon))
            array_push($this->phieuXuatDaChon, $id);
        else {
            unset($this->phieuXuatDaChon[array_search($id, $this->phieuXuatDaChon)]);
            $this->phieuXuatDaChon = array_values($this->phieuXuatDaChon);
        }
    }

    public function deleteSelected()
    {
        if(count($this->phieuXuatDaChon) > 0) {  
            $nguoidung = PhieuXuat::whereKey($this->phieuXuatDaChon);
            $nguoidung->update(['TrangThai' => -1]);
            $this->phieuXuatDaChon = [];
            $this->dispatchBrowserEvent("swal.modal",[
                'type' => 'success',
                'title' => 'Xóa thành công'
            ]);
            return redirect()->route('dashboard.phieuxuat.index');
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
        if(count($this->phieuXuatDaChon)) {
            return response()->streamDownload(function() {
                echo PhieuXuat::whereKey($this->phieuXuatDaChon)->toCsv();
            }, date('dmYhms') . '_phieuxuat.' .$ext);
        } else  {
            $this->dispatchBrowserEvent("swal.modal",[
                'type' => 'warning',
                'title' => 'Vui lòng chọn một bản ghi'
            ]); 
        }
    }
    public function import()
    {
        $this->emitTo('phieu-xuat.import', 'import');
    }
    public function render()
    {
        return view('livewire.phieu-xuat.cong-cu-phieu-xuat');
    }
}
