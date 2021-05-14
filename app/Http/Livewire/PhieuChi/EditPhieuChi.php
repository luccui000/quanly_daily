<?php

namespace App\Http\Livewire\PhieuChi;

use Livewire\Component;

class EditPhieuChi extends Component
{
    
    public $idPhieuChi;
    public function mount($id) 
    {
        $this->idPhieuChi = $id;
    }
    public function edit()
    {
        $this->emitTo('phieu-chi.them-moi-phieu-chi', 'edit', $this->idPhieuChi);
    }
    public function render()
    {
        return view('livewire.phieu-chi.edit-phieu-chi');
    }
}
