<div>
    @livewire('trang-chu.header')
    <div class="max-w-md mx-auto rounded-lg md:max-w-7xl">
        <div class="col-span-2 p-10"> 
            <div class="w-full  flex"  style="margin-top: 50px;"> 
                <div
                    class="w-full h-auto bg-gray-400 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
                    style="background-image: url('{{ URL::asset('img/dangky.jpg') }}')"
                ></div> 
                <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
                    <h3 class="pt-4 text-2xl text-center">Đăng nhập</h3> 
                    <form action="{{ route('khachhang.store') }}" method="POST" class="px-8 pt-6 pb-8 mb-4 bg-white rounded"> 
                        @csrf
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="HoTenKH">
                                Họ tên
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                name="HoTenKH"
                                type="text" 
                                placeholder="Họ và tên khách hàng..."
                            />
                            @error('HoTenKH')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                        </div>
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="Email">
                                Email
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                name="Email"
                                type="text" 
                                placeholder="Email"
                            />
                            @error('Email')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                        </div>
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="DiaChi">
                                Địa chỉ
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                name="DiaChi"
                                type="text" 
                                placeholder="Địa chỉ khách hàng..."
                            />
                            @error('DiaChi')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                        </div> 
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="DiaChi">
                                    Điện thoại
                                </label>
                                <input
                                    class="w-72 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                    name="DienThoai"
                                    type="text" 
                                    placeholder="Điện thoại khách hàng..."
                                />
                                @error('DienThoai')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                            </div>
                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="DiaChi">
                                    Số tài khoản
                                </label>
                                <input
                                    class="w-72 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                    name="SoTaiKhoan" 
                                    placeholder="Số tài khoản ngân hàng..."
                                />
                                @error('SoTaiKhoan')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                    Mật khẩu
                                </label>
                                <input
                                    class="w-72 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                    name="MatKhau"
                                    type="password" 
                                    placeholder="******************"
                                />
                                @error('MatKhau')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                            </div>
                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="c_password">
                                    Xác nhận lại mật khẩu
                                </label>
                                <input
                                    class="w-72 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                    type="password"
                                    name="XacNhanMatKhau" 
                                    placeholder="******************"
                                />
                                @error('XacNhanMatKhau')<p class="text-xs italic text-red-500"> {{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="mb-6 text-center">
                            <button
                                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                type="submit"
                            >
                                Đăng ký tài khoản
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
                                href="{{ route('auth.dangnhap') }}"
                            >
                                Chưa có tài khoản? Đăng ký!
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
