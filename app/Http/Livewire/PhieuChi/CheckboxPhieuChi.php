<?php

namespace App\Http\Livewire\PhieuChi;

use Livewire\Component;

class CheckboxPhieuChi extends Component
{
    public $idPhieuchi;
    public $checked = false;
    public function mount($idPhieuchi)
    { 
        $this->idPhieuchi = $idPhieuchi;
    }
    public function check()
    {
        $this->emitTo('phieu-chi.cong-cu-phieu-chi', 'detete', $this->idPhieuchi);
    }
    public function render()
    {
        return view('livewire.phieu-chi.checkbox-phieu-chi');
    }
}
