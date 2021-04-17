 <div>        
    <x-toolbar>  
        <div class="py-2 flex justify-between">
            <x-input.text wire:model.debounce.500ms="search" placeholder="Tìm kiếm ..."></x-input.text> 
        </div> 
        <div class=" flex justify-between mt-3 px-3">
            <x-button.link wire:click="toggleFilterPrice" >Tìm theo mức giá</x-button.link> 
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
        @if(count($selected) > 0)
        <x-toolbar.button> 
            <x-button.info wire:click="importProducts">Tiến hành nhập hàng</x-button.info>
        </x-toolbar.button>
        @endif
    </x-toolbar>
    @if($showPriceFilter)
    <div class="grid grid-cols-2 max-w-md space-x-4">
        <x-input.group label="Mức giá thấp nhất" for="MucGiaThapNhap">
            <x-input.money wire:model.debounce.200ms="MucGia.ThapNhat" id="MucGiaThapNhap" :error="$errors->first('MucGiaThapNhap')"></x-input.money>
            @error('MucGiaThapNhap') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
        </x-input.group>
        <x-input.group label="Mức giá cao nhất" for="MucGiaCaoNhat">
            <x-input.money wire:model.debounce.200ms="MucGia.CaoNhat" id="MucGiaCaoNhat" :error="$errors->first('MucGiaCaoNhat')"></x-input.money>
            @error('MucGiaCaoNhat') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
        </x-input.group>
    </div>
    @endif
    <x-table>    
        <x-slot name="head"> 
            <x-table.heading >
                <x-input.checkbox></x-input.checkbox>
            </x-table.heading >
            <x-table.heading >#</x-table.heading>
            <x-table.heading >Mã mặt hàng</x-table.heading>
            <x-table.heading >Tên mặt hàng</x-table.heading>
            <x-table.heading >Loại mặt hàng</x-table.heading>
            <x-table.heading >Nhà cung cấp</x-table.heading>
            <x-table.heading >Đơn vị tính</x-table.heading>
            <x-table.heading >Giá nhập</x-table.heading>
            <x-table.heading colspan="2">Giá bán </x-table.heading>
        </x-slot>
        <x-slot name="body">  
            @foreach ($mathang as $item)
                <x-table.row wire:loading.class.defer="opacity-50" wire:key=""> 
                    <x-table.cell class="pr-0 w-5" > 
                        <x-input.checkbox wire:model="selected" value="{{ $item->id }}"></x-input.checkbox>
                    </x-table.cell > 
                    <x-table.cell>{{  $loop->iteration }}</x-table.cell>
                    <x-table.cell>{{  $item->MaMH }}</x-table.cell>
                    <x-table.cell style="max-width: 100px;" title="{{  $item->TenMH }}" class="truncate">{{  $item->TenMH }}</x-table.cell>
                    <x-table.cell>{{  $item->loaimathang->TenLoaiMH }}</x-table.cell>
                    <x-table.cell>{{  $item->nhacungcap->TenNCC }}</x-table.cell>
                    <x-table.cell>{{  $item->donvitinh->TenDVT }}</x-table.cell> 
                    <x-table.cell class="font-semibold">{{ money_format('%.0n', $item->GiaNhap) }}</x-table.cell>
                    <x-table.cell class="font-semibold">{{ money_format('%.0n', $item->GiaXuat) }}</x-table.cell> 
                    <x-table.cell>
                        <x-button.link wire:click="edit('{{ $item->id }}')" >Edit</x-button.link> 
                    </x-table.cell> 
                </x-table.row>
            @endforeach
        </x-slot>  
    </x-table>  
    <div class="mt-4">
        {{ $mathang->links('paginate-link') }}
    </div>
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showModal">
            <x-slot name="title">{{ $modalTitle }}</x-slot>
            <x-slot name="content">   
                <x-input.group label="Mã mặt hàng" for="MaMH">
                    @if($isEdit == 1) 
                        <x-input.text id="MaMH" wire:model.lazy="MaMH" readonly :error="$errors->first('MaMH')" ></x-input.text> 
                        @error('MaMH') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                    @else 
                        <x-input.text id="MaMH" wire:model.lazy="MaMH" :error="$errors->first('MaMH')"></x-input.text>
                        @error('MaMH') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror 
                    @endif 
                </x-input.group>
                <x-input.group label="Tên mặt hàng" for="TenMH">
                    <x-input.text id="TenMH" wire:model.lazy="TenMH" :error="$errors->first('TenMH')"></x-input.text>
                    @error('TenMH') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </x-input.group>
                <x-input.group label="Bảo hành" for="BaoHanh">
                    <x-input.text type="text" id="BaoHanh" wire:model.lazy="BaoHanh" :error="$errors->first('BaoHanh')"></x-input.text>
                    @error('BaoHanh') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </x-input.group>
                <x-input.group label="Thông số" for="ThongSo">
                    <x-input.text type="text" id="ThongSo" wire:model.lazy="ThongSo" :error="$errors->first('ThongSo')"></x-input.text>
                    @error('ThongSo') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </x-input.group>
                <x-input.group label="Loại mặt hàng" for="loaimathang_id"> 
                    <div class="grid grid-cols-10 gap-1">
                        <div class="col-span-9">
                            <x-input.select wire:model="loaimathang_id" > 
                                <option value="0">-- Chọn loại mặt hàng --</option> 
                                @foreach ($loaimathang as $data) 
                                    <option value="{{ $data->id }}">{{ $data->TenLoaiMH }}</option> 
                                @endforeach
                            </x-input>
                        </div>
                        <div class="bg-gray-200 rounded p-0 flex justify-center items-center hover:bg-gray-300 hover:cursor-pointer disabled:opacity-25 transition ml-2" style="width: 50px;">
                            <i class="fa fa-plus text-gray-600"></i>
                        </div>
                    </div>  
                </x-input.group>
                <x-input.group label="Nhà cung cấp" for="nhacungcap_id">
                    <div class="grid grid-cols-10 gap-1">
                        <div class="col-span-9">
                            <x-input.select wire:model="nhacungcap_id" >
                                <option value="0">-- Chọn nhà cung cấp --</option> 
                                @foreach ($nhacungcap as $data) 
                                    <option value="{{ $data->id }}">{{ $data->MaNCC }} - {{ $data->TenNCC }}</option> 
                                @endforeach
                            </x-input>
                        </div>
                        <div wire:click="alert('1212')" class="bg-gray-200 rounded p-0 flex justify-center items-center hover:bg-gray-300 hover:cursor-pointer disabled:opacity-25 transition ml-2" style="width: 50px;">
                            <i class="fa fa-plus text-gray-600"></i>
                        </div>
                    </div> 
                </x-input.group> 
                <x-input.group label="Đơn vị tính" for="donvitinh_id">
                    <div class="grid grid-cols-10 gap-1">
                        <div class="col-span-9">
                            <x-input.select wire:model="donvitinh_id" >
                                <option value="0">-- Chọn đơn vị tính --</option> 
                                @foreach ($donvitinh as $data) 
                                    <option value="{{ $data->id }}">{{ $data->TenDVT }} </option> 
                                @endforeach 
                            </x-input>
                        </div>
                        <div class="bg-gray-200 rounded p-0 flex justify-center items-center hover:bg-gray-300 hover:cursor-pointer disabled:opacity-25 transition ml-2" style="width: 50px;">
                            <i class="fa fa-plus text-gray-600"></i>
                        </div>
                    </div>  
                </x-input.group> 
                
                <x-input.group label="Giá nhập" for="GiaNhap">
                    <x-input.money id="GiaNhap" wire:model.lazy="GiaNhap" :error="$errors->first('GiaNhap')"></x-input.text>
                    @error('GiaNhap') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </x-input.group>
                <x-input.group label="Giá bán" for="GiaXuat">
                    <x-input.money id="GiaXuat" wire:model.lazy="GiaXuat" :error="$errors->first('GiaXuat')"></x-input.text>
                    @error('GiaXuat') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </x-input.group>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showModal', false)">close</x-button.secondary>
                <x-button.success type="submit">Lưu</x-button.success>
            </x-slot>
        </x-modal.dialog>
    </form>    
</div>