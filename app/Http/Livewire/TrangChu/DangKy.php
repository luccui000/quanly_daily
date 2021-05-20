<?php

namespace App\Http\Livewire\TrangChu;

use Livewire\Component;

class DangKy extends Component
{
    public function render()
    {
        return view('livewire.trang-chu.dang-ky')->extends('layouts.index');
    }
}
