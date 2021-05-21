@extends('layouts.index')
@section('content')
    @livewire('trang-chu.header')
    <div class="max-w-md mx-auto rounded-lg md:max-w-7xl">
        <div class="col-span-2 p-10"> 
            <div class="w-full flex"  style="margin-top: 50px;"> 
                <div
                    class="w-full h-auto bg-gray-400 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
                    style="background-image: url('{{ URL::asset('img/dangky.jpg') }}')"
                ></div> 
                <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
                    <h3 class="pt-4 text-2xl text-center">Tạo tài khoản mới</h3> 
                    <form action="{{ route('khachhang.auth') }}" method="POST" class="px-8 pt-6 pb-8 mb-4 bg-white rounded"> 
                        @csrf 
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="Email">
                                Email/Số điện thoại
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                name="Email"
                                type="text" 
                                placeholder="Email/Số điện thoại"
                            />
                            @error('Email')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                        </div>
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                Mật khẩu
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                name="MatKhau"
                                type="password" 
                                placeholder="******************"
                            />
                            @error('MatKhau')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                        </div>  
                        <div class="mb-6 text-center">
                            <button
                                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                type="submit"
                            >
                                Đăng nhập
                            </button>
                        </div>
                        <hr class="mb-6 border-t" />
                        <div class="text-center">
                            <a
                                class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="#"
                            >
                                Quên mật khẩu?
                            </a>
                        </div>
                        <div class="text-center">
                            <a
                                class="inline-block text-sm text-blue-500 align-baseline hover:text-blue-800"
                                href="#"
                            >
                                Đã có tài khoản? Đăng nhập!
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection