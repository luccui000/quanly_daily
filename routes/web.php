<?php

use App\Http\Controllers\KhachHangController;
use Carbon\Carbon;
use App\Models\NguoiDung;
use App\Http\Livewire\HoSo;
use App\Http\Livewire\BaoCao; 
use App\Http\Livewire\MatHang;
use App\Http\Livewire\DangNhap;
use App\Http\Livewire\NhanVien;
use App\Http\Livewire\KhachHang;
use App\Http\Livewire\PhieuNhapKho;
use App\Http\Livewire\TrangChu\DangKy;
use Illuminate\Support\Facades\Auth; 
use App\Http\Livewire\TrangChu\TrangChu;
use App\Http\Livewire\TrangChu\GioHang;


Route::get('/', TrangChu::class)->name('trangchu');
Route::get('/xemgiohang', GioHang::class)->name('trangchu.xemgiohang');


Route::get('/dangky', [App\Http\Controllers\KhachHangController::class, 'dangky'])->name('khachhang.dangky');
Route::post('/dangky', [App\Http\Controllers\KhachHangController::class, 'store'])->name('khachhang.store');
Route::get('/dangnhap', [App\Http\Controllers\KhachHangController::class, 'dangnhap'])->name('khachhang.dangnhap'); 
Route::post('/dangnhap', [App\Http\Controllers\KhachHangController::class, 'xacthuc'])->name('khachhang.xacthuc'); 


Route::view('/pdf', 'pdf.hello');
Route::get('/bieudo', [App\Http\Controllers\BieuDoController::class, 'index'])->name('bieudo');
 
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
