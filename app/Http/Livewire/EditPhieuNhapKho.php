<?php

namespace App\Http\Livewire;

use App\Models\PhieuHang;
use App\Models\PhieuNhap;
use Illuminate\Support\Collection;
use Livewire\Component;

class EditPhieuNhapKho extends Component
{
    protected $listeners = ['edit' => 'showModalEdit'];
    public $showEditPhieuNhapKhoModal = 0;

    public Collection $mathangs;
    
    public function mount()
    {
        $this->mathangs = collect();
    }
    public function showModalEdit(PhieuHang $id)
    {
        $this->mathangs = $id->mathang()->get();
        $this->showEditPhieuNhapKhoModal = 1; 
    }
    public function render()
    { 
        return view('livewire.edit-phieu-nhap-kho',[
            'phieumathang' => $this->mathangs
        ]);
    }
}
