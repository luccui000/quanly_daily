<?php

namespace App\Http\Livewire\PhieuXuat;

use Livewire\Component;

class Import extends Component
{
    public $showModal = false;
    protected $listeners = ['import' => 'importData'];
    public function importData()
    {
        $this->showModal = true;
    }
    public function render()
    {
        return view('livewire.phieu-xuat.import');
    }
}
