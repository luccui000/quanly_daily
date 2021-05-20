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
                    <h3 class="pt-4 text-2xl text-center">Tạo tài khoản mới</h3>
                    <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded"> 
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="HoTenKH">
                                Họ tên
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                id="HoTenKH"
                                type="HoTenKH"
                                placeholder="Họ và tên khách hàng..."
                            />
                        </div>
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="Email">
                                Email
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                id="Email"
                                type="Email"
                                placeholder="Email"
                            />
                        </div>
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="DiaChi">
                                Địa chỉ
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                id="DiaChi"
                                type="DiaChi"
                                placeholder="Địa chỉ khách hàng..."
                            />
                        </div>
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="DiaChi">
                                Điện thoại
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                id="DienThoai"
                                type="DienThoai"
                                placeholder="Điện thoại khách hàng..."
                            />
                        </div>
                        <div class="mb-2">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="DiaChi">
                                Số tài khoản
                            </label>
                            <input
                                class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
                                id="SoTaiKhoan"
                                type="SoTaiKhoan"
                                placeholder="Số tài khoản khách hàng..."
                            />
                        </div>
                        
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                    Mật khẩu
                                </label>
                                <input
                                    class="w-72 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border border-red-500 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="MatKhau"
                                    type="MatKhau"
                                    placeholder="******************"
                                />
                                <p class="text-xs italic text-red-500">Vui lòng điền mật khẩu.</p>
                            </div>
                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="c_password">
                                    Xác nhận lại mật khẩu
                                </label>
                                <input
                                    class="w-72 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    type="password"
                                    placeholder="******************"
                                />
                            </div>
                        </div>
                        <div class="mb-6 text-center">
                            <button
                                class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                                type="button"
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
                                href="./index.html"
                            >
                                Đã có tài khoản? Đăng nhập!
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</div>
