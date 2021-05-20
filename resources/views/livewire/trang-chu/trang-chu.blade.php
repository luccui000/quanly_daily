<div>
    @livewire('trang-chu.header')
    <div class=" bg-gray-50">
        <div class="py-12">
            <div class="max-w-md mx-auto rounded-lg md:max-w-7xl mt-10">
                <div class="w-full flex justify-end pr-6 space-x-2"> 
                    @foreach ($loaiMatHang as $lmh)
                        <a wire:click="phanloai({{ $lmh['id'] }})" class="cursor-pointer inline-block text-md px-2 py-2 leading-none border rounded text-gray-600 border-gray-200 hover:border-transperent hover:text-white hover:bg-green-400 lg:mt-0">{{ $lmh['TenLoaiMH'] }}</a>
                    @endforeach
                    <input wire:model.debounce.500ms="search" type="text" class="shadow-sm appearance-none border rounded w-72 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Tìm kiếm mặt hàng theo tên...">
                    <div class="absolute pin-r pin-t mt-3 mr-1 pr-2 text-purple-lighter">
                        <x-icon.search></x-icon.search> 
                    </div>
                </div> 
                <div class="md:flex ">
                    <div class="w-full flex justify-center">
                        <div class="flex flex-col md:flex-wrap md:flex-row p-5"> 
                            @foreach ($mathangs as $mathang) 
                                <div class="w-full md:w-1/2 lg:w-1/4 md:px-2 py-2" wire:loading.class.defer="opacity-50">
                                    <div class="bg-white rounded hover:shadow-md  p-5 h-full relative">
                                        <h5 class="font-black text-xl mb-4 cursor-pointer">
                                            {{ $mathang->TenMH }}
                                        </h5>
                                        <div class="prod-img cursor-pointer">
                                            <img src="{{ asset('img/'.$mathang->HinhAnh) }}"
                                                class="w-full object-cover object-center" />
                                        </div>
                                        <h6 class="font-bold text-gray-700 text-xl mt-3">Giá bán: {{ money_format('%.0n', $mathang->GiaXuat) }}</h6>
                                        <p class="text-gray-600 mb-10 mt-4 truncate-2-lines">
                                            {{ $mathang->ThongSo }}
                                        </p> 
                                        
                                        <div class="flex justify-end mt-5 absolute w-full bottom-0 left-0 pb-5">
                                            @if(!in_array($mathang->id, $matHangIds))
                                                <button wire:click="themVaoGioHang({{ $mathang->id }})" class="block uppercase font-bold text-green-600 p-1 rounded-md hover:text-gray-50 mr-4 hover:bg-green-500 text-gray-50">
                                                    Thêm vào giỏ hàng
                                                </button>
                                            @else 
                                                <button wire:click="xoaMatHang({{ $mathang->id }})" class="block uppercase font-bold text-red-600 p-1 rounded-md hover:text-gray-50 hover:bg-red-500 text-gray-50 mr-4">
                                                    Xoá khỏi giỏ hàng
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                            <div class="w-full flex justify-center pt-12 pb-12">
                                {{ $mathangs->links('paginate-link') }}
                            </div>  
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>