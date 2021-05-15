<?php
 
use App\Http\Livewire\HoSo;
use App\Http\Livewire\DangNhap;
use App\Http\Livewire\KhachHang;
use App\Http\Livewire\MatHang;
use App\Http\Livewire\NhanVien;
use App\Http\Livewire\PhieuNhapKho; 
use App\Http\Livewire\BaoCao;
use App\Models\NguoiDung;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

Route::get('/',function() {
    return redirect('/dangnhap');
})->name('nguoidung.home');   
Route::get('/dangnhap', DangNhap::class)->name('auth.dangnhap');
Route::get('/dangxuat', function() {
    $userId = Auth::user()->id;
    NguoiDung::where('id', $userId)->update(['LanDangNhapCuoi' => Carbon::now(), 'TrangThai' => 0]); 
    Auth::logout();
    return redirect()->route('auth.dangnhap');
})->name('auth.dangxuat');



Route::group(['as' => 'dashboard.', 'middleware' => 'isLogin'], function() {
    Route::get('/hoso', HoSo::class)->name('hoso');
    Route::get('/nhanvien', NhanVien::class)->name('nhanvien');
    Route::get('/khachhang', KhachHang::class)->name('khachhang'); 
    Route::get('/mathang', MatHang::class)->name('mathang'); 
    Route::get('/phieunhapkho', PhieuNhapKho::class)->name('phieunhapkho'); 
    Route::get('/baocao', BaoCao\Index::class)->name('baocao'); 
    Route::post('/nhaphang', [App\Http\Controllers\NhapHangController::class, 'store'])->name('nhaphang.store');
    Route::get('pdf/{ext}', [App\Http\Controllers\NhapHangController::class, 'export'])->name('nhaphang.export');
    Route::get('/phieuxuat', [App\Http\Controllers\PhieuXuatController::class, 'index'])->name('phieuxuat.index');
    Route::post('/phieuxuat', [App\Http\Controllers\PhieuXuatController::class, 'store'])->name('phieuxuat.store');
    Route::get('/phieuchi', [App\Http\Controllers\PhieuChiController::class, 'index'])->name('phieuchi.index');
    Route::post('/phieuchi', [App\Http\Controllers\PhieuChiController::class, 'store'])->name('phieuchi.store');

});


Route::view('/pdf', 'pdf.hello');
Route::get('/bieudo', [App\Http\Controllers\BieuDoController::class, 'index'])->name('bieudo');
 