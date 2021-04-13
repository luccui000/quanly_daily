<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
    <h3 class="ml-1 pb-3 text-gray-600 font-semibold">Thêm mới</h3> 
    <form class="-mx-3 md:flex mb-6" wire:submit.prevent="themMoiNguoiDung" method="POST">  
        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
            <x-input.group label="Tên đăng nhập" for="TenDangNhap" :error="$errors->first('TenDangNhap')" > 
                <x-input.text wire:model.lazy="TenDangNhap" id="TenDangNhap" placeholder="Nhập tên đăng nhập" />
            </x-input.group>
        </div>
        <div class="md:w-1/3 px-3 mb-6 md:mb-0">
            <x-input.group label="Mật khẩu" for="MatKhau" :error="$errors->first('MatKhau')" > 
                <x-input.text wire:model.lazy="MatKhau" type="password" id="MatKhau" placeholder="Nhập mật khẩu" />
            </x-input.group>
        </div> 
        <div class="md:w-1/3 px-3 mb-6 md:mb-0 flex">
            <div class="md:w-10/12 mb-6 md:mb-0">
                <x-input.group label="Trạng thái" for="inputTrangThai" :error="$errors->first('TrangThai')" > 
                    <x-input.select wire:model="TrangThai" id="inputTrangThai">
                        <option value="1" selected>Hoạt động</option>
                        <option value="0">Không hoạt động</option> 
                    </x-input.select>
                </x-input.group>
            </div>
            <div class="md:w-2/12 mb-6 md:mb-0">
                <x-input.group label="." for="email" > 
                    <x-button.primary type="submit" >Lưu</x-button.primary>
                </x-input.group>
            </div>
        </div>
    </form>   
</div> 