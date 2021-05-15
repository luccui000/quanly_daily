<div> 
    <x-toolbar>  
        <div class="py-2 flex justify-between">
            <x-input.text wire:model.debounce.500ms="search" placeholder="Tìm kiếm ..."></x-input.text> 
        </div>  
        <x-toolbar.button>  
            <x-button.success wire:click="$set('showModal', true)" >Thêm mới</x-button.success>
        </x-toolbar.button>    
        <x-toolbar.button> 
            <x-button.primary wire:click="xuatBaoCao('csv')" >Xuất CSV</x-button.primary>
        </x-toolbar.button>
        <x-toolbar.button> 
            <x-button.primary class="bg-green-200"  wire:click="xuatBaoCao('xlsx')" >Xuất XLSX</x-button.primary>
        </x-toolbar.button>
        <x-toolbar.button> 
            <x-button.danger wire:click="xoaBaoCao">Xóa chọn</x-button.danger>
        </x-toolbar.button> 
    </x-toolbar> 
    <x-table>
        <x-slot name="head"> 
            <x-table.heading >
                <x-input.checkbox></x-input.checkbox>
            </x-table.heading >
            <x-table.heading >#</x-table.heading> 
            <x-table.heading >Ngày lập</x-table.heading>  
            <x-table.heading >Nhân viên lập</x-table.heading>
            <x-table.heading >Tên báo cáo</x-table.heading>
            <x-table.heading >Nội dung báo cáo</x-table.heading> 
            <x-table.heading></x-table.heading>  
        </x-slot>
        <x-slot name="body"> 
             @foreach ($danhsachBaoCao as $bc)
                <x-table.row>
                    <x-table.cell style="width: 10px">
                        <x-input.checkbox wire:model="danhsachBaoCaoDaChon" value="{{ $bc->id }}" ></x-input.checkbox>
                    </x-table.cell> 
                    <x-table.cell style="width: 20px;">{{ $loop->iteration }}</x-table.cell>
                    <x-table.cell>{{ $bc->nhanvien->HoTenNV }}</x-table.cell>
                    <x-table.cell>{{ $bc->ngay_lap }}</x-table.cell>
                    <x-table.cell>{{ $bc->TenBC }}</x-table.cell>
                    <x-table.cell>{{ $bc->NoiDungBC }}</x-table.cell>
                    <x-table.cell>
                        <button wire:click="edit({{ $bc->id }})"  class="text-cool-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-cool-gray-800 focus:underline transition duration-150 ease-in-out" >
                            Edit
                        </button>
                    </x-table.cell>
                </x-table.row>
             @endforeach
        </x-slot>
    </x-table>  
    <form wire:submit.prevent="save"> 
        <x-modal.dialog wire:model="showModal">
            <x-slot name="title">Thêm mới phiếu chi</x-slot>
            <x-slot name="content">  
                <x-input.group label="Ngày lập" for="NgayLap">
                    <x-input.date wire:model="NgayLap" ></x-input.date>
                </x-input.group>
                <x-input.group label="Tài khoản của nhân viên" for="nhanvien_id">
                    <x-input.select id="nhanvien_id" wire:model="nhanvien_id" :error="$errors->first('nhanvien_id')">
                        @foreach ($nhanvien as $nv)
                            <option value="{{ $nv->id }}" >{{ $nv->HoTenNV }}</option>
                        @endforeach
                    </x-input.select>
                    @error('nhanvien_id') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror 
                </x-input.group>
                <x-input.group label="Tên báo cáo" for="TenBC">
                    <x-input.text id="TenBC" wire:model.lazy="TenBC" :error="$errors->first('TenBC')"></x-input.text>
                    @error('TenBC') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </x-input.group>  
                <x-input.group label="Nội dung báo cáo" for="NoiDungBC">
                    <textarea  class="p-2 border-2 border-gray-200 rounded-md w-full" wire:model="NoiDungBC" rows="5" placeholder="Mô tả... "></textarea>
                    @if ($errors->first('NoiDungBC'))
                        <div class="mt-1 text-red-500 text-sm">
                            @error('NoiDungBC') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>
                    @endif  
                </x-input.group>  
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">close</x-button.secondary>
                <x-button.success type="submit">Lưu</x-button.success>
            </x-slot>
        </x-modal.dialog>
    </form>  
</div>
