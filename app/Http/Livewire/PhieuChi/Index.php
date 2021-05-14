<?php

namespace App\Http\Livewire\PhieuChi;

use Livewire\Component;

class Index extends Component
{
    public $phieuchi = [];
    public function mount($phieuchi)
    {
        $this->phieuchi = $phieuchi;
    }
    public function render()
    {
        return view('livewire.phieu-chi.index');
    }
}
