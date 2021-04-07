<?php
 
 
use App\Http\Controllers\NhanVienController;
use App\Http\Livewire\DangNhap;

Route::view('/','welcome'); 
Route::get('/dang-nhap', DangNhap::class); 
Route::group(['prefix' => 'dashboard'], function() {
    Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard.index');
    Route::get('/search', 'Dashboard\DashboardController@search')->name('dashboard.search');


    // =====================   NHAN VIEN     =====================
    Route::group(['prefix' => 'nhan-vien'], function() {
        Route::get('/', 'NhanVienController@index')->name('dashboard.nhanvien.index');
        Route::get('/create', 'NhanVienController@create')->name('dashboard.nhanvien.create');
        Route::post('/store', 'NhanVienController@store')->name('dashboard.nhanvien.store');
        Route::put('/update', 'NhanVienController@update')->name('dashboard.nhanvien.update');
        Route::get('/{id}', 'NhanVienController@show')->name('dashboard.nhanvien.show');
        Route::get('/getNhanvienForUpdate/{id}', 'NhanVienController@getNhanvienForUpdate')->name('dashboard.nhanvien.getNhanvienForUpdate');
    });

    // =====================   KHACH HANG    =====================
    Route::group(['prefix' => 'khach-hang'], function() {
        Route::get('/', 'KhachHangController@index')->name('dashboard.khachhang.index');
        Route::get('/create', 'KhachHangController@create')->name('dashboard.khachhang.create');
        Route::post('/store', 'KhachHangController@store')->name('dashboard.khachhang.store');
        Route::get('/{id}/edit', 'KhachHangController@edit')->name('dashboard.khachhang.edit');
        Route::put('/{id}/update', 'KhachHangController@update')->name('dashboard.khachhang.update');
        Route::delete('/{id}', 'KhachHangController@delete')->name('dashboard.khachhang.delete');
    });

    // =====================   CHUC VU     =====================
    Route::group(['prefix' => 'chuc-vu'], function() {
        Route::get('/', 'ChucVuController@index')->name('dashboard.chucvu.index');
        Route::get('/getAllName', 'ChucVuController@getAllName')->name('dashboard.chucvu.getAllName');
        Route::get('/create', 'ChucVuController@create')->name('dashboard.chucvu.create');
        Route::post('/store', 'ChucVuController@store')->name('dashboard.chucvu.store');
        Route::get('/{id}/edit', 'ChucVuController@edit')->name('dashboard.chucvu.edit');
        Route::put('/{id}/update', 'ChucVuController@update')->name('dashboard.chucvu.update');
        Route::delete('/{id}', 'ChucVuController@destroy')->name('dashboard.chucvu.destroy');
    });
    Route::group(['prefix' => 'nha-cung-cap'], function() {
        Route::get('/', 'NhaCungCapController@index')->name('dashboard.nhacungcap.index');
        Route::get('/create', 'NhaCungCapController@create')->name('dashboard.nhacungcap.create');
        Route::post('/', 'NhaCungCapController@store')->name('dashboard.nhacungcap.store');
        Route::put('/update', 'NhaCungCapController@update')->name('dashboard.nhacungcap.update');
        Route::get('/{id}', 'NhaCungCapController@show')->name('dashboard.nhacungcap.show'); 
    }); 
    Route::group(['prefix' => 'hoa-don'], function() {
        Route::get('/')->name('dashboard.hoadon.index');
        Route::get('/nhap-hang', 'NhapHangController@index')->name('dashboard.hoadon.nhaphang.index'); 
        Route::get('/nhap-hang/create', 'NhapHangController@create')->name('dashboard.hoadon.nhaphang.create'); 
        Route::get('/mat-hang', 'MatHangController@index')->name('dashboard.hoadon.themhang.index');
        Route::post('/mat-hang/store', 'MatHangController@store')->name('dashboard.hoadon.themhang.store');
        Route::get('/xuat-hang', 'XuatHangController@index')->name('dashboard.hoadon.xuathang.index'); 
    });
    Route::group(['prefix' => 'loai-hang-hoa'], function() {
        Route::get('/', 'LoaiHangHoaController@index')->name('dashboard.loaimathang.index');
        Route::get('/create', 'LoaiHangHoaController@create')->name('dashboard.loaimathang.create');
        Route::post('/store', 'LoaiHangHoaController@store')->name('dashboard.loaimathang.store');
    });
});