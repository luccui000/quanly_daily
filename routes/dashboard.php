<?php
 
  
use App\Http\Livewire\HoSo;
use App\Http\Livewire\MatHang;
use App\Http\Livewire\NhanVien;
use App\Http\Livewire\KhachHang;
use App\Http\Livewire\BaoCao\Index;
use App\Http\Livewire\PhieuNhapKho;
use App\Mail\XacNhanDonHangMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
 

Route::get('dangnhap', [App\Http\Controllers\XacThucController::class, 'dangnhap'])->name('auth.dangnhap');
Route::post('dangnhap', [App\Http\Controllers\XacThucController::class, 'xacthuc'])->name('auth.xacthuc');
Route::get('dangxuat', [App\Http\Controllers\XacThucController::class, 'dangxuat'])->name('auth.dangxuat');


Route::group(['middleware' => 'isLogin', 'as' => 'dashboard.'], function() {
    Route::get('/hoso', HoSo::class)->name('hoso');
    Route::get('/nhanvien', NhanVien::class)->name('nhanvien');
    Route::get('/khachhang', KhachHang::class)->name('khachhang'); 
    Route::get('/mathang', MatHang::class)->name('mathang'); 
    Route::get('/phieunhapkho', PhieuNhapKho::class)->name('phieunhapkho'); 
    Route::get('/baocao', Index::class)->name('baocao'); 
    Route::post('/nhaphang', [App\Http\Controllers\NhapHangController::class, 'store'])->name('nhaphang.store');
    Route::get('pdf/{ext}', [App\Http\Controllers\NhapHangController::class, 'export'])->name('nhaphang.export');
    Route::get('/phieuxuat', [App\Http\Controllers\PhieuXuatController::class, 'index'])->name('phieuxuat.index');
    Route::post('/phieuxuat/nhap', [App\Http\Controllers\PhieuXuatController::class, 'import'])->name('phieuxuat.import');
    Route::get('/phieuxuat/{id}', [App\Http\Controllers\PhieuXuatController::class, 'show'])->name('phieuxuat.show');
    Route::put('/phieuxuat/{id}', [App\Http\Controllers\PhieuXuatController::class, 'update'])->name('phieuxuat.update');
    Route::post('/phieuxuat', [App\Http\Controllers\PhieuXuatController::class, 'store'])->name('phieuxuat.store');
    Route::get('/phieuchi', [App\Http\Controllers\PhieuChiController::class, 'index'])->name('phieuchi.index');
    Route::post('/phieuchi', [App\Http\Controllers\PhieuChiController::class, 'store'])->name('phieuchi.store');
});

Route::view('/pdf', 'pdf.hello');
Route::get('/mail', function() {
    Mail::to('user@gmail.com')->send(new XacNhanDonHangMail());
    return new XacNhanDonHangMail();
});
Route::get('/bieudo', [App\Http\Controllers\BieuDoController::class, 'index'])->name('bieudo');