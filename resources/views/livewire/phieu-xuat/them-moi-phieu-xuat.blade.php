<div>
    <x-modal.dialog wire:model="showModal" maxWidth="full" > 
        <x-slot name="content">   
            <form action="{{ route('dashboard.phieuxuat.store') }}" method="POST" class="flex space-x-2 m-0 h-screen" >
                @csrf  
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
                                    <h2 class="flex-none text-md font-semibold mt-3 uppercase">Bán  hàng</h2>
                                    @livewire('search-drop-down', ['loaiphieu' => 'phieuxuat'])
                                </div>  
                            </div>
                            <div class="">
                                <x-button.primary type="button" wire:click="ThemMoi({{ count($danhsachBanHang) + 1}})">
                                    <x-icon.plus fill="#fff"></x-icon.plus>
                                </x-button.primary>  
                                <x-button type="button" >
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
                                    @foreach ($danhsachBanHang as $index => $nhaphang)
                                        <x-table.row wire:key="danhsachBanHang[{{ $index }}][id]">    
                                            <x-table.cell>{{  $loop->iteration }}</x-table.cell>
                                            <x-table.cell>
                                                <select 
                                                    name="danhsachBanHang[{{ $index }}][id]"
                                                    wire:model="danhsachBanHang.{{ $index }}.id" 
                                                    class="p-2 rounded-sm w-24 bg-gray-200">
                                                    @foreach ($danhsachMatHang as $item)
                                                        <option value="{{ $item->id }}">{{ $item->MaMH }}</option>
                                                    @endforeach
                                                </select> 
                                            </x-table.cell>
                                            <x-table.cell>
                                                <select 
                                                    wire:model="danhsachBanHang.{{ $index }}.id"  
                                                    class="p-2 rounded-sm w-60 bg-gray-200">
                                                    @foreach ($danhsachMatHang as $item)
                                                        <option value="{{ $item->id }}">{{ $item->TenMH }}</option>
                                                    @endforeach
                                                </select> 
                                            </x-table.cell>
                                            <x-table.cell title="" class="truncate">
                                                {{ $nhaphang['TenDVT'] }}
                                            </x-table.cell>  
                                            <x-table.cell> 
                                                <div class="relative flex space-x-1">  
                                                    <div style="margin-top: 7px;" class="cursor-pointer" wire:click="decrement({{ $index }})">
                                                        <x-icon.minus fill="#000" ></x-icon.minus>
                                                    </div>
                                                    <div class="">
                                                        <input type="number"
                                                            min="0"
                                                            style="width: 40px; "
                                                            name="danhsachBanHang[{{ $index }}][SoLuong]"  
                                                            class="p-2 bg-gray-200 rounded-sm text-center"
                                                            wire:model="danhsachBanHang.{{ $index }}.SoLuong">
                                                    </div>
                                                    <div style="margin-top: 7px;" class="cursor-pointer" wire:click="increment({{ $index }})">
                                                        <x-icon.plus fill="#000"  ></x-icon.plus>
                                                    </div>
                                                </div>
                                            </x-table.cell> 
                                            <x-table.cell >
                                                <p class="text-md font-bold text-gray-500"> {{ money_format('%.0n', $nhaphang['DonGia'])}}</p>
                                            </x-table.cell> 
                                            <x-table.cell> 
                                                <div class="relative">
                                                    <input  type="number" min="0" max="100" step="5" value="0" 
                                                        class="p-2 outline-none border-b-2 border-gray-400  border-dashed"
                                                        wire:model="danhsachBanHang.{{ $index }}.GiamGia" style="width: 40px">
                                                    <div style="position: absolute; top: 8px; right: 40px;" class="text-gray-600 font-bold">
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
                                            <input type="hidden" name="danhsachBanHang[{{ $index }}][GiamGia]" value="{{ $nhaphang['SoLuong'] * (float)$nhaphang['DonGia'] * ($nhaphang['GiamGia'] / 100) }}">
                                            <input type="hidden" name="danhsachBanHang[{{ $index }}][DonGia]" value="{{ $nhaphang['DonGia'] }}">
                                            <input type="hidden" name="danhsachBanHang[{{ $index }}][ThanhTien]" value="{{ $nhaphang['SoLuong'] * (float)$nhaphang['DonGia'] - ($nhaphang['SoLuong'] * (float)$nhaphang['DonGia'] * ($nhaphang['GiamGia'] / 100)) }}">
                                        </x-table.row> 
                                    @endforeach  
                                </x-slot>
                            </x-table>  
                        </div>
                    </div>
                </div> 
                <div class="flex-none w-96 bg-gray-50 p-4 rounded-md space-y-2 relative"  style="height: 900px">   
                    <div class="relative mb-3"> 
                        <h2 class="text-gray-800 mt-2 font-bold ">Nhân viên</h2>
                        <p class="text-md border-b-2 border-gray-500 border-dashed cursor-pointer" '
                            style="position: absolute; top: -8px; left: 90px;">{{ auth()->user()->TenDangNhap ?? "" }}</p> 
                            <input type="hidden" name="nhanvien_id" value="{{ auth()->user()->id }}"> 
                    </div>  
                    <div class="mt-3 mb-3">
                        <hr>
                    </div>
                    <x-input.group label="Mã phiếu bán hàng" for="MaPH">
                        <x-input.text name="MaPX" wire:model="MaPX"  placeholder="Mã tạo tự động..." readonly></x-input.text>
                    </x-input.group> 
                    <x-input.group label="Khách hàng" for="KhachHang">
                        <x-input.select name="khachhang_id">
                            @foreach ($khachhang as $kh)
                                <option value="{{ $kh->id }}">{{ $kh->HoTenKH }}</option> 
                            @endforeach 
                        </x-input.select> 
                    </x-input.group>   
                    <x-input.group label="Kho hàng" for="KhoHang">
                        <x-input.select name="kho_id">
                            @foreach ($kho as $item)
                                <option value="{{ $item->id }}">{{ $item->TenKho }} - {{ $item->DiaChi }}</option> 
                            @endforeach 
                        </x-input.select> 
                    </x-input.group> 
                    <div class="mt-6 mb-6">
                        <hr>
                    </div>
                    <div class="flex justify-between mt-3 mb-3">
                        <h2 class="text-gray-800 font-bold">Trạng thái</h2>
                        <p>Tạm tính</p>
                    </div>
                    <div class="flex justify-between mt-3 mb-3">
                        <h2 class="text-gray-800 font-bold">Tổng tiền hàng</h2>
                        <p class="font-bold">{{ money_format('%.0n', $TongTienHang) }}</p>
                    </div>
                    <div class="flex justify-between mb-3"> 
                        <h2 class="text-gray-800 mt-2 font-bold">Tổng VAT</h2>
                        <x-input.select name="TongVAT" wire:model="PTVAT">
                            <option value="0" selected>0%</option>  
                            <option value="5" >5%</option>  
                            <option value="10" >10%</option>  
                        </x-input.select> 
                    </div>
                    <div class="flex justify-between mb-3"> 
                        <h2 class="text-gray-800 mt-2 font-bold">Tổng giảm giá</h2>
                        <div class="relative">
                            <div class="border-b-2 border-gray-400">
                                <input type="number" wire:model="PTGiamGia" min="0" max="100" step="5"  class="pl-3 text-grey-darker bg-transparent border-grey-lighter focus:outline-none rounded p-2" >
                            </div>
                            <div class="absolute right-7 top-2 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">
                                    %
                                </span>
                            </div> 
                        </div>
                    </div>   
                    <div class="flex justify-between mt-3 mb-3">
                        <h2 class="text-gray-800 font-bold mt-1">Tiền trả nhà cung cấp</h2>
                        <p class="text-lg text-blue-400 font-semibold">{{ money_format('%.0n', $TongThanhToan) }}</p>
                    </div>
                    @json($NgayLap)
                    <div style="position: absolute; top: 10px; right: -10px;" >
                        <input  
                            name="NgayLap"  
                            type="date"
                            value="{{ $NgayLap }}"
                            style="width: 100px; padding: 5px;" 
                            class="p-1 bg-transparent border-b-1 cursor-pointer w-20 border-gray-900 rounded-md absolute right-5 focus:border-2 focus:border-gray-600" > 
                    </div> 
                    <div class="mt-6 mb-6">
                        <hr>
                    </div> 
                    <x-input.group label="Hình thức thanh toán" for="HinhThucThanhToan">
                        <x-input.select name="HinhThucThanhToan" >
                            <option value="1">Chuyển khoản</option> 
                            <option value="2">Tiền mặt</option> 
                        </x-input.select> 
                    </x-input.group> 
                    <x-input.group label="Mô tả" for="MoTa">
                        <textarea class="p-2 border-2 border-gray-200 rounded-md " name="MoTa" cols="38" rows="5" placeholder="Mô tả... "></textarea>
                    </x-input.group> 
                    <div class="flex float-right mt-12 space-x-2"> 
                        <x-button wire:click="$set('showModal',false)" type="button"><p class="text-gray-900">Hủy</p></x-button>
                        @if(count($danhsachBanHang) > 0)
                            <x-button.success type="submit">Hoàn thành</x-button.success>  
                        @else   
                            <x-button.secondary type="button" wire:click="thongBaoChonHang">Hoàn thành</x-button.secondary>  
                        @endif
                        <input type="hidden" name="inPhieu" value="{{ $inPhieu }}">
                        <x-button.primary type="button" wire:click="export('pdf')">In phiếu</x-button.primary>
                    </div> 
                </div>
            </form>   
        </x-slot>
    </x-modal.dialog>  
</div>
