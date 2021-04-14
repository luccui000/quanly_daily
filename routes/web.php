<?php
 
  
use App\Http\Livewire\HoSo;
use App\Http\Livewire\DangNhap;
use App\Http\Livewire\KhachHang;
use App\Http\Livewire\MatHang;
use App\Http\Livewire\NhanVien;

Route::view('/','welcome')->name('nguoidung.home');   
Route::get('/dangnhap', DangNhap::class);



Route::group(['as' => 'dashboard.', 'middleware' => 'isLogin'], function() {
    Route::get('/hoso', HoSo::class)->name('hoso');
    Route::get('/nhanvien', NhanVien::class)->name('nhanvien');
    Route::get('/khachhang', KhachHang::class)->name('khachhang'); 
    Route::get('/mathang', MatHang::class)->name('mathang'); 
});