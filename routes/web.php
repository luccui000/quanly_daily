<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Livewire\TrangChu\TrangChu;
use App\Http\Livewire\TrangChu\GioHang;


Route::get('/', TrangChu::class)->name('trangchu');
Route::get('/xemgiohang', GioHang::class)->name('trangchu.xemgiohang');


Route::get('/dangky', [App\Http\Controllers\KhachHangController::class, 'dangky'])->name('khachhang.dangky');
Route::post('/dangky', [App\Http\Controllers\KhachHangController::class, 'store'])->name('khachhang.store');
Route::get('/dangnhap', [App\Http\Controllers\KhachHangController::class, 'dangnhap'])->name('khachhang.dangnhap'); 
Route::post('/dangnhap', [App\Http\Controllers\KhachHangController::class, 'xacthuc'])->name('khachhang.xacthuc'); 

 
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
