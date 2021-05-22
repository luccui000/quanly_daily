<?php
 
use App\Http\Livewire\HoSo;
use Illuminate\Support\Facades\Route;
 

Route::get('hoso', HoSo::class)->name('hoso');