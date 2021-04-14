<div>
    @json($showModal)
    <x-toolbar>
        <x-toolbar.search wire:model.debounce.500ms="search"></x-toolbar.search> 
        <x-toolbar.dropdown label="Bộ lọc">
            <x-dropdown.item wire:click="" label="" class="flex item-center space-x-3">
                Mã NCC
            </x-dropdown.item>
            <x-dropdown.item wire:click="" class="flex item-center space-x-3">
                Tên NCC
            </x-dropdown.item> 
        </x-toolbar.dropdown>  
        <x-toolbar.dropdown label="Thêm thuộc tính ...">
            <x-dropdown.item wire:click="" label="" class="flex item-center space-x-3">
                <span>Thêm đơn vị tính</span>
            </x-dropdown.item>
            <x-dropdown.item wire:click="" class="flex item-center space-x-3">
                <span>Thêm nhà cung cấp</span> 
            </x-dropdown.item> 
        </x-toolbar.dropdown> 
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
            <x-button.danger wire:click="deleteSelected">Xóa chọn</x-button.primary>
        </x-toolbar.button>
    </x-toolbar>
    <x-table>    
        <x-slot name="head"> 
            <x-table.heading >
                <x-input.checkbox></x-input.checkbox>
            </x-table.heading >
            <x-table.heading >#</x-table.heading>
            <x-table.heading >Mã mặt hàng</x-table.heading>
            <x-table.heading >Tên mặt hàng</x-table.heading>
            <x-table.heading >Nhóm mặt hàng</x-table.heading>
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
                    <x-table.cell>{{  $item->TenMH }}</x-table.cell>
                    <x-table.cell>{{  $item->loaimathang->TenLoaiMH }}</x-table.cell>
                    <x-table.cell>{{  $item->nhacungcap->TenNCC }}</x-table.cell>
                    <x-table.cell>{{  $item->donvitinh->TenDVT }}</x-table.cell>
                    <x-table.cell>{{  $item->GiaNhap }}</x-table.cell>
                    <x-table.cell>{{  $item->GiaXuat }}</x-table.cell> 
                    <x-table.cell>
                        <x-button.link wire:click="edit(' ')" >Edit</x-button.link> 
                    </x-table.cell> 
                </x-table.row>
            @endforeach
        </x-slot>  
    </x-table>
    @foreach ($nhacungcap as $data)
        <p>{{ $data->TenNCC }} </p>
    @endforeach
    @foreach ($loaimathang as $data)
        <p>{{ $data->TenLoaiMH }} </p>
    @endforeach
    @foreach ($donvitinh as $data)
        <p>{{ $data->TenDVT }} </p>
    @endforeach
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showModal">
            <x-slot name="title">{{ $modalTitle }}</x-slot>
            <x-slot name="content"> 
                <x-input.group label="Mã mặt hàng" for="tendangnhap">
                    @if($isEdit == 1) 
                        <x-input.text id="MaMH" wire:model.lazy="MaMH" readonly :error="$errors->first('MaMH')" ></x-input.text> 
                        @error('MaMH') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                    @else 
                        <x-input.text id="MaMH" wire:model="MaMH" :error="$errors->first('MaMH')" placeholder="Tự động tạo"></x-input.text> 
                        @error('MaMH') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                    @endif
                </x-input.group> 
                <x-input.group label="Tên mặt hàng" for="MatKhau">
                    <x-input.text id="TenMH" wire:model.lazy="TenMH" :error="$errors->first('TenMH')"></x-input.text>
                    @error('TenMH') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </x-input.group>
                <x-input.group label="Mật khẩu" for="MatKhau">
                    <x-input.text type="password" id="MatKhau" wire:model.lazy="MatKhau" :error="$errors->first('MatKhau')"></x-input.text>
                    @error('MatKhau') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </x-input.group>
                <x-input.group label="Nhóm mặt hàng" for="loaimathang_id"> 
                    <div class="grid grid-cols-10 gap-1">
                        <div class="col-span-9">
                            <x-input.select wire.model="" for>
                                <option value="">Điện thoại</option>
                                <option value="">Laptop</option>
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
                            <x-input.select wire.model="" for>
                                <option value="">DMX - Công ty Điện máy xanh</option>
                                <option value="">TDDG - Công ty Thế giới di động</option>
                            </x-input>
                        </div>
                        <div class="bg-gray-200 rounded p-0 flex justify-center items-center hover:bg-gray-300 hover:cursor-pointer disabled:opacity-25 transition ml-2" style="width: 50px;">
                            <i class="fa fa-plus text-gray-600"></i>
                        </div>
                    </div> 
                </x-input.group>
                <x-input.group label="Đơn vị tính" for="donvitinh_id">
                    <div class="grid grid-cols-10 gap-1">
                        <div class="col-span-9">
                            <x-input.select wire.model="" for>
                                <option value="">Cái</option>
                                <option value="">Chiếc</option>
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