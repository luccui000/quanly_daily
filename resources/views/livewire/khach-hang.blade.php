<div>       
    <div class="flex-col space-y-6">  
        <div class="flex ml-1">
            <div class="float-right py-2 flex justify-between">
                <x-input.text wire:model.debounce.500ms="search" placeholder="Search ..."></x-input.text> 
            </div>    
            <div class="py-2 mt-1 ml-2">
                <x-button.success wire:click="create" >New</x-button.success>
            </div>
          
            <div class="py-2 mt-1 ml-2">
                <x-button.primary wire:click="export('csv')" >export CSV</x-button.success>
            </div>
            <div class="py-2 mt-1 ml-2">
                <x-button.primary class="bg-green-200"  wire:click="export('xlsx')" >export XLSX</x-button.success>
            </div>
            <div class="py-2 mt-1 ml-2">
                <x-button.danger wire:click="deleteSelected">Delete</x-button.primary>
            </div> 
        </div>   
        <x-table>   
            <x-slot name="head"> 
                <x-table.heading >
                    <x-input.checkbox wire:click="selectAll" wire:model="checked"></x-input.checkbox>
                </x-table.heading >
                <x-table.heading >Mã khách hàng</x-table.heading>
                <x-table.heading >Họ tên khách hàng</x-table.heading> 
                <x-table.heading >Địa chỉ</x-table.heading>
                <x-table.heading >Điện thoại</x-table.heading>
                <x-table.heading >Email</x-table.heading>
                <x-table.heading >Số tài khoản</x-table.heading> 
            </x-slot>
            <x-slot name="body">    
                @forelse ($khachhang as $item) 
                    <x-table.row wire:loading.class.defer="opacity-50" wire:key="{{ $item->id }}" >
                            <x-table.cell class="pr-0 w-5" > 
                                <x-input.checkbox wire:model="selected" value="{{ $item->id }}" ></x-input.checkbox>
                            </x-table.cell >  
                            <x-table.cell >{{ $item->MaKH }}</x-table> 
                            <x-table.cell >{{ $item->HoTenKH }}</x-table> 
                            <x-table.cell >{{ $item->DiaChi }}</x-table> 
                            <x-table.cell >{{ $item->DienThoai }}</x-table> 
                                <x-table.cell >{{ $item->Email }}</x-table> 
                                    <x-table.cell >{{ $item->SoTaiKhoan }}</x-table> 
                            <x-table.cell>
                                <x-button.link wire:click="edit('{{ $item->id }}')" >Edit</x-button.link> 
                            </x-table>
                        </x-table.row> 
                    @empty
                        <x-table.row >
                            <x-table.cell colspan="6">
                                <div class="flex justify-center item-center">
                                    <span class="text-md text-gray-500 font-medium">Không tìm thấy người dùng .</span>
                                </div>
                            </x-table>
                        </x-table.row>
                @endforelse    
            </x-slot> 
        </x-table>  
        <div>
            {{ $khachhang->links('paginate-link') }}
        </div> 
        <form wire:submit.prevent="save">
            <x-modal.dialog wire:model.defer="showModal">
                <x-slot name="title">{{ $modalTitle }}</x-slot>
                <x-slot name="content"> 
                    <x-input.group label="Họ tên nhân viên" for="tendangnhap">
                        @if($isEdit == 1) 
                            <x-input.text id="HoTenNV" wire:model.lazy="HoTenNV" readonly :error="$errors->first('HoTenNV')"></x-input.text> 
                            @error('HoTenNV') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        @else 
                            <x-input.text id="HoTenNV" wire:model="HoTenNV" :error="$errors->first('HoTenNV')"></x-input.text> 
                            @error('HoTenNV') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        @endif
                    </x-input.group>
                     
                    <x-input.group label="Ngày sinh" for="NgaySinh">
                        <x-input.date wire:model="NgaySinh" id="NgaySinh" autocomplete="off"></x-input.date>
                        @error('NgaySinh') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror 
                    </x-input.group> 
                    <x-input.group label="Điện thoại" for="DienThoai"> 
                        <x-input.text id="HoTenNV" wire:model.lazy="DienThoai" :error="$errors->first('DienThoai')"></x-input.text> 
                        @error('DienThoai') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror 
                    </x-input.group>
                    <x-input.group label="Địa chỉ" for="DiaChi"> 
                        <x-input.text id="HoTenNV" wire:model.lazy="DiaChi" :error="$errors->first('DiaChi')"></x-input.text> 
                        @error('DiaChi') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror 
                    </x-input.group> 
                    <x-input.group label="Trạng thái" for="TrangThai">
                        <x-input.select id="TrangThai" wire:model="TrangThai" :error="$errors->first('TrangThai')">
                            <option value="1">Đang làm việc</option>
                            <option value="0">Đã chờ xử lý</option>
                        </x-input.select>
                        @error('TrangThai') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                    </x-input.group>
                </x-slot>
                <x-slot name="footer">
                    <x-button.secondary wire:click="$set('showModal', false)">close</x-button.secondary>
                    <x-button.success type="submit">Lưu</x-button.success>
                </x-slot>
            </x-modal.dialog>
        </form> 
    </div>    
</div> 
