<form wire:submit.prevent="login" class="flex flex-row w-full h-30 rounded-md text-md p-4 mb-5 space-x-7"> 
    <x-input.group label="Tên đăng nhập" for="TenDangNhap" >
        <x-input.text wire:model="TenDangNhap" class="text-grey-800"></x-input.text>
        @error('TenDangNhap') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
    </x-input.group>
    <x-input.group label="Mật khẩu" for="TenDangNhap">
        <x-input.text wire:model="MatKhau" type="password" class="text-grey-800"></x-input.text> 
        @error('MatKhau') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
    </x-input.group>
    <x-input.group for="" label="." >
        <x-button.success type="submit" class="w-36">Đăng nhập</x-button.success>
    </x-input.group>  
</form>
<div class="grid grid-cols-5 gap-4 p-2"> 
    @foreach ($nguoidung as $item)
        <div class="relative bg-gray-100 text-gray-400 text-md border-2 border-gray-200 rounded-sm hover:shadow-md h-48 p-3">
            <div class="inner p-3">
                <h3 class="text-lg font-semibold text-gray-600">{{ $item->TenDangNhap }}</h3> 
                <p class="py-2">Lần đăng nhập cuối nhất: {{ $item->date_for_humans }}</p>
                <p>Thời gian: {{ $item->time_for_humans }}</p>
            </div> 
            @if($item->TrangThai) 
                <div class="triangle">
                    <a href="#"><i class="fas fa-check"></i></a>
                </div>
            @endif 
        </div> 
    @endforeach 
</div>