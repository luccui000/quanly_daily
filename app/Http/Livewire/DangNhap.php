<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DangNhap extends Component
{
    public $email = '';
    public $select = '';
    public $password = '';
    public $passwordConfirmation = '';

    public function render()
    {
        return view('livewire.dang-nhap')
            ->extends('layouts.app');
    }
}
