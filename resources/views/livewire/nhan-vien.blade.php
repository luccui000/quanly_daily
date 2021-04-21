<div>       
    <div class="flex-col space-y-6">  
        <div class="flex ml-1">
            <div class="float-right py-2 flex justify-between">
                <x-input.text wire:model.debounce.500ms="search" placeholder="Search ..."></x-input.text> 
            </div>  
            <div class="py-2 mt-1 ml-2">
                <x-dropdown label="Bộ lọc"> 
                    <x-dropdown.item label="" class="flex item-center space-x-3">
                        <x-input.checkbox wire:model="selectColumnsView" value="MaNV" label="Mã Nhân Viên"></x-input.checkbox> 
                    </x-dropdown.item>
                    <x-dropdown.item value="HoTenNV" class="flex item-center space-x-3"> 
                        <x-input.checkbox wire:model="selectColumnsView" value="HoTenNV" label="Họ tên nhân viên"></x-input.checkbox> 
                    </x-dropdown.item> 
                    <x-dropdown.item value="NgaySinh" class="flex item-center space-x-3"> 
                        <x-input.checkbox wire:model="selectColumnsView" value="NgaySinh" label="Ngày sinh"></x-input.checkbox> 
                    </x-dropdown.item> 
                    <x-dropdown.item value="GioiTinh" class="flex item-center space-x-3"> 
                        <x-input.checkbox wire:model="selectColumnsView" value="GioiTinh" label="Giới tính"></x-input.checkbox> 
                    </x-dropdown.item> 
                    <x-dropdown.item value="DiaChi" class="flex item-center space-x-3"> 
                        <x-input.checkbox wire:model="selectColumnsView" value="DiaChi" label="Địa chỉ"></x-input.checkbox> 
                    </x-dropdown.item> 
                    <x-dropdown.item value="DienThoai" class="flex item-center space-x-3"> 
                        <x-input.checkbox wire:model="selectColumnsView" value="DienThoai" label="Điện thoại"></x-input.checkbox> 
                    </x-dropdown.item> 
                </x-dropdown> 
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
                <x-table.heading >Mã nhân viên</x-table.heading>
                <x-table.heading >Họ tên nhân viên</x-table.heading> 
                <x-table.heading >Chức vụ</x-table.heading>
                <x-table.heading >Giới tính</x-table.heading>
                <x-table.heading >Ngày sinh</x-table.heading>
                <x-table.heading >Điện thoại</x-table.heading>
                <x-table.heading >Địa chỉ</x-table.heading>
            </x-slot>
            <x-slot name="body">    
                @forelse ($nhanvien as $item) 
                    <x-table.row wire:loading.class.defer="opacity-50" wire:key="{{ $item->id }}" >
                            <x-table.cell class="pr-0 w-5" > 
                                <x-input.checkbox wire:model="selected" value="{{ $item->id }}" ></x-input.checkbox>
                            </x-table.cell >  
                            <x-table.cell >{{ $item->MaNV }}</x-table>
                            <x-table.cell >{{ $item->HoTenNV }}</x-table> 
                            <x-table.cell > 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $item->color_chuc_vu }}-200 text-{{ $item->mau_sac_trang_thai }}-800">
                                    {{ $item->chucvu->TenCV }}
                                </span> 
                            </x-table>
                            <x-table.cell >{{ $item->GioiTinh }}</x-table> 
                            <x-table.cell >{{ $item->date_for_humans }}</x-table> 
                            <x-table.cell >{{ $item->DienThoai }}</x-table> 
                            <x-table.cell >{{ $item->DiaChi }}</x-table>
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
            {{ $nhanvien->links('paginate-link') }}
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
                    <x-input.group label="Giới tính" for="GioiTinh"> 
                        <x-input.checkbox wire:click="setGioiTinh(1)" :checked="$GioiTinh === 1 ? true : null" checked label="Nam" for="Nam"></x-input.checkbox>  
                        <x-input.checkbox wire:click="setGioiTinh(0)" :checked="$GioiTinh === 0 ? true : null" label="Nữ" for="Nu"></x-input.checkbox>  
                    </x-input.group>
                    <x-input.group label="Ngày sinh" for="NgaySinh">
                        <x-input.date wire:model="NgaySinh" id="NgaySinh" autocomplete="off" leadingAddOn="true"></x-input.date>
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
                    <x-input.group label="Chức vụ" for="chucvu_id">
                        <x-input.select id="chucvu_id" wire:model="chucvu_id" :error="$errors->first('chucvu_id')">
                            @foreach ($chucvu as $item)
                                <option value="{{ $item->id }}">{{ $item->TenCV }}</option>
                            @endforeach
                        </x-input.select>
                        @error('chucvu_id') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
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
