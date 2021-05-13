<?php

namespace App\Http\Livewire\PhieuNhapKho;
 
use Livewire\Component;

class TaoMoi extends Component
{
    protected $listeners = ['create' => 'create', 'close' => 'close'];

    public $showModal = false; 
    public float $globalTongThanhToan = 0; 

    public function mount()
    {

    }

    public function create()
    {
        $this->showModal = true;
    } 
    public function close()
    {
        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.phieu-nhap-kho.tao-moi');
    }
}
