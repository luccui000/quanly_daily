<?php

namespace App\Http\Livewire\PhieuXuat;

use Livewire\Component;

class CheckBox extends Component
{
    public $idPhieuXuat;
    public $checked = false;

    public function mount($idPhieuXuat)
    { 
        $this->idPhieuXuat = $idPhieuXuat;
    }
    public function check()
    {
        $this->emitTo('phieu-xuat.cong-cu-phieu-xuat', 'detete', $this->idPhieuXuat);
    }
    public function render()
    {
        return view('livewire.phieu-xuat.check-box');
    }
}
