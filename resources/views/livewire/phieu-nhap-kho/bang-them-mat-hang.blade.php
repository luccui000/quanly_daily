<div class="flex-grow h-full" style=" overflow: auto"> 
    <div class="">
        <div class="flex justify-between">
            <div class="flex space-x-2">
                <a href="{{ url()->previous() }}" class="hover:text-green-200 font-semibold" style="margin-top: 12px;" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div class=" inline flex space-between space-x-2" style="width: 500px;">
                    <h2 class="flex-none text-md font-semibold mt-3 uppercase">Nhập hàng</h2>
                    @livewire('search-drop-down')
                </div>  
            </div>
            <div class=""> 
                <x-button type="button" wire:click="themMoiMatHang({{ count($danhsachNhapHang) + 1}})">
                    <x-icon.plus></x-icon.plus>
                </x-button>
                <x-button type="button">
                    <x-icon.upload class="text-gray-900"></x-icon.upload>  
                </x-button>
            </div>
        </div>
        <div class="mt-2">
            <x-table>
                <x-slot name="head">  
                    <x-table.heading >STT</x-table.heading>
                    <x-table.heading >Mã hàng</x-table.heading>
                    <x-table.heading >Tên hàng</x-table.heading>
                    <x-table.heading >Đơn vị tính</x-table.heading>
                    <x-table.heading >Số lượng</x-table.heading>
                    <x-table.heading >Đơn giá</x-table.heading>
                    <x-table.heading >Giảm giá</x-table.heading> 
                    <x-table.heading >Thành tiền</x-table.heading>   
                    <x-table.heading ></x-table.heading>   
                </x-slot>
                <x-slot name="body">       
                    @foreach ($danhsachNhapHang as $index => $nhaphang)
                        <x-table.row>    
                            <x-table.cell>{{  $loop->iteration }}</x-table.cell>
                            <x-table.cell>
                                <select wire:model="danhsachNhapHang.{{ $index }}.id" class="p-2 rounded-sm w-24">
                                    @foreach ($danhsachMatHang as $item)
                                        <option value="{{ $item->id }}">{{ $item->MaMH }}</option>
                                    @endforeach
                                </select> 
                            </x-table.cell>
                            <x-table.cell>
                                <select wire:model="danhsachNhapHang.{{ $index }}.id" class="p-2 rounded-sm w-60">
                                    @foreach ($danhsachMatHang as $item)
                                        <option value="{{ $item->id }}">{{ $item->TenMH }}</option>
                                    @endforeach
                                </select> 
                            </x-table.cell>
                            <x-table.cell title="" class="truncate">
                                {{ $nhaphang['TenDVT'] }}
                            </x-table.cell>  
                            <x-table.cell class="w-1/12"> 
                                <x-input.text type="number" min="0" wire:model="danhsachNhapHang.{{ $index }}.SoLuong"></x-input.text>
                            </x-table.cell> 
                            <x-table.cell >
                                <p class="text-md font-bold text-gray-500"> {{ money_format('%.0n', $nhaphang['DonGia'])}}</p>
                            </x-table.cell> 
                            <x-table.cell> 
                                <div class="relative">
                                    <input type="number" min="0" max="100" step="5" value="0" wire:model="danhsachNhapHang.{{ $index }}.GiamGia" class="text-grey-darker border border-grey-lighter rounded p-2 shadow-sm" style="width: 80px;">
                                    <div style="position: absolute; top: 10px; right: 45px;" class="text-gray-600 font-bold">
                                        %
                                    </div>
                                </div> 
                            </x-table.cell>  
                            <x-table.cell class="font-semibold text-md">   
                                {{ money_format('%.0n', $nhaphang['SoLuong'] * (float)$nhaphang['DonGia'] - (
                                    $nhaphang['SoLuong'] * (float)$nhaphang['DonGia'] * ($nhaphang['GiamGia'] / 100)
                                )) }}
                            </x-table.cell>  
                            <x-table.cell >  
                                <div class="cursor-pointer font-bold" wire:click="boMatHang({{ $index }})">
                                    <i class="fa fa-trash text-gray-600"></i>
                                </div>
                            </x-table.cell>  
                        </x-table.row> 
                    @endforeach  
                </x-slot>
            </x-table> 
        </div>
    </div>
</div>