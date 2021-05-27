@extends('layouts.index')
@section('content')
<div>
    @livewire('trang-chu.header') 
    <div class=" bg-gray-50">
        <div class="py-14"> 
            <div class="md:flex flex-col md:flex-row md:min-h-screen w-full">
                <div @click.away="open = false" class=" flex flex-col w-full md:w-64 text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800 flex-shrink-0" x-data="{ open: false }"> 
                    <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
                        <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-200 text-gray-900 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Thông tin tài khoản</a>
                        <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Quản lý đơn hàng</a> 
                    </nav>
                </div>
                <div class="p-4 space-y-1">
                    <h2 class="font-bold text-xl">Thông tin tài khoản</h2> 
                    <div class="bg-white rounded-md">
                        <form action="{{ route('khachhang.update', ['id' => $thongtin->id]) }}" method="POST" class="bg-white rounded w-96"> 
                            @csrf
                            @method('PUT')
                            <div class="md:inline-flex md:space-y-0 w-full p-2 text-gray-700 items-center">
                                <h2 class="md:w-1/3 max-w-sm mx-auto text-sm">Họ tên</h2>
                                <div class="w-full inline-flex border"> 
                                  <input placeholder="Nguyen Van A"
                                      name="HoTenKH" value="{{ $thongtin->HoTenKH }}"
                                    class="bg-white h-6 text-sm focus:outline-none w-full p-2" />
                                @error('HoTenKH')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                                </div> 
                            </div> 
                            <div class="md:inline-flex md:space-y-0 w-full p-2 text-gray-700 items-center">
                                <h2 class="md:w-1/3 max-w-sm mx-auto text-sm">Số điện thoại</h2>
                                <div class="w-full inline-flex border">  
                                  <input name="SoDienThoai" value="{{ $thongtin->DienThoai }}"
                                    class="bg-white h-6 text-sm focus:outline-none w-full p-2" />
                                    @error('SoDienThoai')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                                </div> 
                            </div>
                            <div class="md:inline-flex md:space-y-0 w-full p-2 text-gray-700 items-center">
                                <h2 class="md:w-1/3 max-w-sm mx-auto text-sm">Email</h2>
                                <div class="w-full inline-flex border"> 
                                  <input name="Email" value="{{ $thongtin->Email }}" placeholder="email@gmail.com"
                                    class="bg-gray-200 h-6 text-sm focus:outline-none w-full p-2" readonly />
                                </div> 
                            </div>
                            <div class="md:inline-flex md:space-y-0 w-full p-2 text-gray-700 items-center">
                                <h2 class="md:w-1/3 max-w-sm mx-auto text-sm">Địa chỉ</h2>
                                <div class="w-full inline-flex border"> 
                                  <input type="text" name="DiaChi" value="{{ $thongtin->DiaChi }}"
                                    class="bg-white h-6 text-sm focus:outline-none w-full p-2" />
                                    @error('DiaChi')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                                </div> 
                            </div>
                            <div class="md:inline-flex md:space-y-0 w-full p-2 text-gray-700 items-center">
                                <h2 class="md:w-1/3 max-w-sm mx-auto text-sm">Số tài khoản</h2>
                                <div class="w-full inline-flex border"> 
                                  <input type="text" name="SoTaiKhoan" value="{{ $thongtin->SoTaiKhoan }}" placeholder="0608xxxxxxx" 
                                    class="bg-white h-6 text-sm focus:outline-none w-full p-2"  />
                                    @error('SoTaiKhoan')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                                </div> 
                            </div>
                            <div class="md:inline-flex md:space-y-0 w-full p-2 text-gray-700 items-center">
                                <button type="submit" class="inline-block px-2 text-xs font-medium leading-6 text-center text-white transition bg-green-500 rounded shadow ripple hover:bg-green-600 focus:outline-none" > Cập nhật </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('trang-chu.footer')
</div>
@endsection