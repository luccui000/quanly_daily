<?php

namespace App\Http\Livewire;

use App\Models\MatHang;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchDropDown extends Component
{
    public $TimKiemMatHang = '';
    public Collection $mathang;
    protected $listeners = ['refreshSeachProduct' => 'refresh'];
    public $loaiphieu;
    
    public function mount($loaiphieu)
    {
        $this->loaiphieu = $loaiphieu;
        $this->mathang = collect();
    }

    public function refresh()
    { 
        $this->reset('TimKiemMatHang');
    }
    public function themMatHang($id) { 
        if($this->loaiphieu == 'phieunhap') {
            $this->emitTo('phieu-nhap-kho.bang-them-mat-hang', 'ThemMatHang', $id );
        }
        if($this->loaiphieu == 'phieuxuat') {
            $this->emitTo('phieu-xuat.them-moi-phieu-xuat', 'ThemMatHang', $id);
        }
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
        ]);
    }
}
