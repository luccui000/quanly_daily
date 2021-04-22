 <div>        
    <x-toolbar>  
        <div class="py-2 flex justify-between">
            <x-input.text wire:model.debounce.500ms="search" placeholder="Tìm kiếm ..."></x-input.text> 
        </div>  
        <x-toolbar.button>  
            <x-button.success wire:click="create" >Thêm mới</x-button.success>
        </x-toolbar.button>    
        <x-toolbar.button> 
            <x-button.primary wire:click="export('csv')" >Xuất CSV</x-button.success>
        </x-toolbar.button>
        <x-toolbar.button> 
            <x-button.primary class="bg-green-200"  wire:click="export('xlsx')" >Xuất XLSX</x-button.success>
        </x-toolbar.button>
        <x-toolbar.button> 
            <x-button.danger wire:click="deleteSelected">Xóa chọn</x-button.danger>
        </x-toolbar.button> 
    </x-toolbar>
    <x-table>
        <x-slot name="head"> 
            <x-table.heading >
                <x-input.checkbox></x-input.checkbox>
            </x-table.heading >
            <x-table.heading >#</x-table.heading>
            <x-table.heading >Mã phiếu hàng</x-table.heading>
            <x-table.heading >Ngày lập</x-table.heading>
            <x-table.heading >Nhà cung cấp</x-table.heading>
            <x-table.heading >Kho</x-table.heading>
            <x-table.heading >Nhân viên lập</x-table.heading>
            <x-table.heading >Tổng giảm giá</x-table.heading>
            <x-table.heading >Tổng thanh toán</x-table.heading>
            <x-table.heading>Trạng thái</x-table.heading>  
            <x-table.heading></x-table.heading>  
        </x-slot>
        <x-slot name="body">   
            @foreach ($phieuhang as $item)
                <x-table.cell class="pr-0 w-5" > 
                    <x-input.checkbox wire:model="selected" value="{{ $item->id }}"></x-input.checkbox>
                </x-table.cell > 
                <x-table.cell>{{  $loop->iteration }}</x-table.cell>
                <x-table.cell>{{  $item->MaPH }}</x-table.cell>    
                <x-table.cell>{{  $item->date_for_humans }}</x-table.cell>    
                <x-table.cell>{{  $item->nhacungcap->TenNCC }}</x-table.cell>    
                <x-table.cell>{{  $item->kho->TenKho }}</x-table.cell>    
                <x-table.cell>{{  $item->nhanvien->HoTenNV }}</x-table.cell>    
                <x-table.cell class="font-semibold">{{  money_format('%.0n', $item->Tong_ChietKhau) }}</x-table.cell>    
                <x-table.cell class="font-semibold">{{  money_format('%.0n', $item->TongThanhToan) }}</x-table.cell>     
                <x-table.cell>{{  $item->TrangThai }}</x-table.cell>     
                <x-table.cell>
                    <x-button.link wire:click="$emitTo('edit-phieu-nhap-kho', 'edit', {{ $item->id }})" >Edit</x-button.link> 
                </x-table.cell> 
            @endforeach
        </x-slot>
    </x-table> 
    @livewire('edit-phieu-nhap-kho') 
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showModal" maxWidth="full" > 
            <x-slot name="content">     
                 <div class="flex space-x-2 m-0" style="height: 900px;"> 
                    {{-- Body --}}  
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
                                    </x-slot>
                                    <x-slot name="body">  
                                        @foreach ($mathangs as $mh)
                                            <x-table.row>    
                                                <x-table.cell>{{  $loop->iteration }}</x-table.cell>
                                                <x-table.cell>{{  $mh->MaMH }}</x-table.cell>
                                                <x-table.cell style="max-width: 100px;" title="{{  $mh->TenMH }}" class="truncate">{{  $mh->TenMH }}</x-table.cell>  
                                                <x-table.cell>{{  $mh->donvitinh->TenDVT }}</x-table.cell> 
                                                <x-table.cell class="w-1/12">
                                                    <x-input.text type="number" min="0" wire:model="soluong.{{ $mh->id }}">1</x-input.text>
                                                </x-table.cell>
                                                <x-table.cell class="font-semibold">{{  money_format('%.0n', $mh->GiaNhap) }} </x-table.cell> 
                                                <x-table.cell> 
                                                    <div class="relative">
                                                        <div class="border-b-2 border-gray-400" style="width: 70px">
                                                            <input type="number" min="0" max="100" step="5" wire:model="giamgia.{{ $mh->id }}" class="pl-3 text-grey-darker bg-transparent border-grey-lighter focus:outline-none rounded p-2" >
                                                        </div>
                                                        <div class="absolute right-12 top-2 flex items-center pointer-events-none">
                                                            <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">
                                                                %
                                                            </span>
                                                        </div> 
                                                    </div>
                                                </x-table.cell>  
                                                <x-table.cell class="font-semibold text-md"> 
                                                    {{ money_format('%.0n',  $thanhtien[$mh->id]) }}
                                                </x-table.cell> 
                                            </x-table.row> 
                                        @endforeach    
                                    </x-slot>
                                </x-table> 
                            </div>
                        </div>
                    </div>
                    <div class="flex-none w-96 bg-gray-50 p-4 rounded-md space-y-2 relative"  style="height: 900px"> 
                        <div 
                            wire:model="NgayLap"
                            class="w-24 block" 
                            x-data="{ value: @entangle('NgayLap').defer, picker: undefined }"
                            x-init="new Pikaday({ field: $refs.input,
                            toString(date, format) { 
                                const day = date.getDate();
                                const month = date.getMonth() + 1;
                                const year = date.getFullYear();
                                return `${day}/${month}/${year}`;
                            }, onOpen() { this.setDate($refs.input.value) } })"
                            x-on:change="value = $event.target.value"
                        >
                            <input  
                                x-ref="input"
                                x-bind:value="value"
                                class="p-1 bg-transparent border-b-1 w-20 border-gray-900 rounded-md absolute right-5 focus:border-2 focus:border-gray-600" > 
                        </div> 
                        <x-input.group label="Mã phiếu nhập" for="MaPN">
                            <x-input.text wire:model="MaPH" placeholder="Mã tạo tự động..."></x-input.text>
                        </x-input.group>
                        <x-input.group label="Nhân viên" for="NhanVien">
                            <x-input.select wire:model="nhanvien_id">
                                <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->TenDangNhap }}</option>
                                <option value="">Nhân viên 1</option>
                                <option value="">Nhân viên 2</option>
                                <option value="">Nhân viên 3</option>
                            </x-input.select>
                        </x-input.group>
                        <x-input.group label="Nhà cung cấp" for="NhaCungCap">
                            <x-input.select wire:model="nhacungcap_id">
                                @foreach ($nhacungcap as $ncc)
                                    <option value="{{ $ncc->id }}">{{ $ncc->TenNCC }}</option> 
                                @endforeach 
                            </x-input.select> 
                        </x-input.group>   
                        <div class="flex justify-between mt-3 mb-3">
                            <h2 class="text-gray-800 font-bold">Trạng thái</h2>
                            <p>Tạm tính</p>
                        </div>
                        <div class="flex justify-between mt-3 mb-3">
                            <h2 class="text-gray-800 font-bold">Tổng tiền hàng</h2>
                            <p>{{ money_format('%.0n', $tongtienhang) }}</p>
                        </div>
                        <div class="flex justify-between mb-3"> 
                            <h2 class="text-gray-800 mt-2 font-bold">Giảm giá</h2>
                            <div class="relative">
                                <div class="border-b-2 border-gray-400">
                                    <input type="number" min="0" max="100" step="5" wire:model="tongGiamGia" class="pl-3 text-grey-darker bg-transparent border-grey-lighter focus:outline-none rounded p-2" >
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
                            <p class="text-lg text-blue-400 font-semibold">{{ money_format('%.0n', $tongtientrancc) }}</p>
                        </div>
                        <x-input.group label="Hình thức thanh toán" for="HinhThucThanhToan">
                            <x-input.select wire:model="HinhThucThanhToan" >
                                <option value="1">Chuyển khoản</option> 
                                <option value="2">Tiền mặt</option> 
                            </x-input.select> 
                        </x-input.group> 
                        <div class="flex float-right mt-12"> 
                            <x-button wire:click="$set('showModal', false)" type="button"><p class="text-gray-900">Hủy</p></x-button>
                            <x-button.success wire:click="$emit('searchProduct')" type="button">Hoàn thành</x-button.success>  
                        </div> 
                    </div>
                 </div>
            </x-slot> 
        </x-modal.dialog>
    </form> 
</div>
