<div class="relative" x-data="{ show: true }">
    <x-input.text wire:model.debounce.500ms="TimKiemMatHang" @click="show = true" class="focus:outline-none focus:ring-2 focus:ring-blue-200" style="width: 300px;"  placeholder="Tìm kiếm ..."></x-input.text>
    @if(strlen($TimKiemMatHang) > 0)
        <div class="absolute bg-gray-100 rounded mt-2 shadow-md" style="width: 300px;" x-show="show" @click.away="show = false" >
            <ul>   
                @forelse ($mathang as $item)
                    <li class="border-b-2 border-gray-300 p-3 text-md text-gray-600 truncate cursor-pointer hover:bg-gray-50" 
                        wire:loading.class.defer="opacity-50" 
                        wire:click="$emitTo('phieu-nhap-kho', 'ThemNhapKho', {{ $item->id }})"
                        style="max-width: 300px;" 
                        title="{{  $item->TenMH }}">
                        {{ $item->TenMH }}  <span class="font-bold float-right">{{ $item->MaMH }}  </span> 
                        <p class="text-sm">Giá: {{ money_format('%.0n', $item->GiaNhap) }}</p>
                        <p class="text-sm">Tồn kho: 1</p>
                    </li>  
                @empty
                    <li class="p-3 text-md text-center text-gray-600">Không tìm thấy kết quả nào phù hợp.</li> 
                @endforelse
            </ul>
        </div>
    @endif
</div>
