<?php

namespace App\Http\Livewire;

use App\Models\MatHang;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchDropDown extends Component
{
    public $TimKiemMatHang = '';
    public Collection $mathang;

    public function mount()
    {
        $this->mathang = collect();
    }

    public function render()
    { 
        if(strlen($this->TimKiemMatHang) > 1) {
            $term = '%'. $this->TimKiemMatHang . '%';
            $this->mathang = MatHang::query()
                                ->latest()
                                ->where('MaMH', 'like', $term)
                                ->orWhere('TenMH', 'like', $term)
                                ->take(5)->get();
        }
        return view('livewire.search-drop-down', [
            'mathang' => $this->mathang,
            'timkiem' => strlen($this->TimKiemMatHang)
        ]);
    }
}
