<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ThemNhaCungCap extends Component
{
    protected $listeners = ['createNewUnit' => 'createNewUnitExec'];
 

    public function createNewUnitExec()
    {
        dd("OKE");
        // $this->modalTitle = "Thêm mới Nhà cung cấp";
        // $this->render();
    }
    public function render()
    {
        return view('livewire.them-nha-cung-cap');
    }
}
