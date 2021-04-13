<?php
 
  
use App\Http\Livewire\HoSo;
use App\Http\Livewire\DangNhap;
use App\Http\Livewire\KhachHang;
use App\Http\Livewire\NhanVien;

Route::view('/','welcome')->name('nguoidung.home');   
Route::get('/dangnhap', DangNhap::class);



Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'isLogin'], function() {
    Route::get('/hoso', HoSo::class)->name('hoso');
    Route::get('/nhanvien', NhanVien::class)->name('nhanvien');
    Route::get('/khachhang', KhachHang::class)->name('khachhang');
    Route::get('/', 'Dashboard\DashboardController@index')->name('index');
    Route::get('/search', 'Dashboard\DashboardController@search')->name('search');


    // =====================   NHAN VIEN     =====================
    Route::group(['prefix' => 'nhan-vien'], function() {
        Route::get('/', 'NhanVienController@index')->name('nhanvien.index');
        Route::get('/create', 'NhanVienController@create')->name('nhanvien.create');
        Route::post('/store', 'NhanVienController@store')->name('nhanvien.store');
        Route::put('/update', 'NhanVienController@update')->name('nhanvien.update');
        Route::get('/{id}', 'NhanVienController@show')->name('nhanvien.show');
        Route::get('/getNhanvienForUpdate/{id}', 'NhanVienController@getNhanvienForUpdate')->name('nhanvien.getNhanvienForUpdate');
    });

    // =====================   KHACH HANG    =====================
    Route::group(['prefix' => 'khach-hang'], function() {
        Route::get('/', 'KhachHangController@index')->name('khachhang.index');
        Route::get('/create', 'KhachHangController@create')->name('khachhang.create');
        Route::post('/store', 'KhachHangController@store')->name('khachhang.store');
        Route::get('/{id}/edit', 'KhachHangController@edit')->name('khachhang.edit');
        Route::put('/{id}/update', 'KhachHangController@update')->name('khachhang.update');
        Route::delete('/{id}', 'KhachHangController@delete')->name('khachhang.delete');
    });

    // =====================   CHUC VU     =====================
    Route::group(['prefix' => 'chuc-vu'], function() {
        Route::get('/', 'ChucVuController@index')->name('chucvu.index');
        Route::get('/getAllName', 'ChucVuController@getAllName')->name('chucvu.getAllName');
        Route::get('/create', 'ChucVuController@create')->name('chucvu.create');
        Route::post('/store', 'ChucVuController@store')->name('chucvu.store');
        Route::get('/{id}/edit', 'ChucVuController@edit')->name('chucvu.edit');
        Route::put('/{id}/update', 'ChucVuController@update')->name('chucvu.update');
        Route::delete('/{id}', 'ChucVuController@destroy')->name('chucvu.destroy');
    });
    Route::group(['prefix' => 'nha-cung-cap'], function() {
        Route::get('/', 'NhaCungCapController@index')->name('nhacungcap.index');
        Route::get('/create', 'NhaCungCapController@create')->name('nhacungcap.create');
        Route::post('/', 'NhaCungCapController@store')->name('nhacungcap.store');
        Route::put('/update', 'NhaCungCapController@update')->name('nhacungcap.update');
        Route::get('/{id}', 'NhaCungCapController@show')->name('nhacungcap.show'); 
    }); 
    Route::group(['prefix' => 'hoa-don'], function() {
        Route::get('/')->name('hoadon.index');
        Route::get('/nhap-hang', 'NhapHangController@index')->name('hoadon.nhaphang.index'); 
        Route::get('/nhap-hang/create', 'NhapHangController@create')->name('hoadon.nhaphang.create'); 
        Route::get('/mat-hang', 'MatHangController@index')->name('hoadon.themhang.index');
        Route::post('/mat-hang/store', 'MatHangController@store')->name('hoadon.themhang.store');
        Route::get('/xuat-hang', 'XuatHangController@index')->name('hoadon.xuathang.index'); 
    });
    Route::group(['prefix' => 'loai-hang-hoa'], function() {
        Route::get('/', 'LoaiHangHoaController@index')->name('loaimathang.index');
        Route::get('/create', 'LoaiHangHoaController@create')->name('loaimathang.create');
        Route::post('/store', 'LoaiHangHoaController@store')->name('loaimathang.store');
    });
});