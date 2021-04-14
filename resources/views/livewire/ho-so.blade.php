<div>   
    <div class="flex-col space-y-6">  
        <div class="flex ml-1">
            <div class="float-right py-2 flex justify-between">
                <x-input.text wire:model.debounce.500ms="search" placeholder="Search ..."></x-input.text> 
            </div>   
            <div class="py-2 mt-1 ml-2">
                <x-button.success wire:click="create" >Thêm mới</x-button.success>
            </div>
            <div class="py-2 mt-1 ml-2">
                <x-button.primary wire:click="export('csv')" >Xuất CSV</x-button.primary>
            </div>
            <div class="py-2 mt-1 ml-2">
                <x-button.primary wire:click="export('xlsx')" >Xuất Excel</x-button.primary>
            </div>
            <div class="py-2 mt-1 ml-2">
                <x-button.danger wire:click="deleteSelected">Xóa</x-button.primary>
            </div>  
        </div>   
        <x-table>   
            <x-slot name="head"> 
                <x-table.heading >
                    <x-input.checkbox></x-input.checkbox>
                </x-table.heading >
                <x-table.heading >#</x-table.heading>
                <x-table.heading wire:click="sortBy('TenDangNhap')" :direction="$sortBy === 'TenDangNhap' ? $sortDirection : null" sortable>Tên đăng nhập</x-table.heading>
                <x-table.heading >Mật khẩu</x-table.heading>
                <x-table.heading wire:click="sortBy('TrangThai')" :direction="$sortBy === 'TrangThai' ? $sortDirection : null" sortable>Trạng thái</x-table.heading>
                <x-table.heading wire:click="sortBy('LanDangNhapCuoi')" :direction="$sortBy === 'LanDangNhapCuoi' ? $sortDirection : null" sortable>Lần đăng nhập cuối</x-table.heading>
            </x-slot>
            <x-slot name="body">    
                @forelse ($hoso as $item) 
                    <x-table.row wire:loading.class.defer="opacity-50" wire:key="{{ $item->id }}" >
                            <x-table.cell class="pr-0 w-5" > 
                                <x-input.checkbox wire:model="selected" value="{{ $item->id }}"></x-input.checkbox>
                            </x-table.cell > 
                            <x-table.cell >{{ $loop->iteration }}</x-table>
                            <x-table.cell >{{ $item->TenDangNhap }}</x-table>
                            <x-table.cell >{{ $item->MatKhau }}</x-table>
                            <x-table.cell > 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $item->mau_sac_trang_thai }}-100 text-{{ $item->mau_sac_trang_thai }}-800">
                                    {{ $item->TrangThai ? 'active' : 'inactive' }}
                                </span>  
                            </x-table>
                            <x-table.cell >{{ $item->date_for_humans }}</x-table>
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
            {{ $hoso->links('paginate-link') }}
        </div> 
        <form wire:submit.prevent="save">
            <x-modal.dialog wire:model.defer="showEditModal">
                <x-slot name="title">{{ $modaTitle }}</x-slot>
                <x-slot name="content"> 
                    <x-input.group label="Tên đăng nhập" for="tendangnhap">
                        @if($isEdit == 1) 
                            <x-input.text id="tendangnhap" wire:model.lazy="TenDangNhap" readonly :error="$errors->first('TenDangNhap')"></x-input.text> 
                            @error('TenDangNhap') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        @else 
                            <x-input.text id="tendangnhap" wire:model="TenDangNhap" :error="$errors->first('TenDangNhap')"></x-input.text> 
                            @error('TenDangNhap') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        @endif
                    </x-input.group>
                    <x-input.group label="Mật khẩu" for="MatKhau">
                        <x-input.text type="password" id="MatKhau" wire:model.lazy="MatKhau" :error="$errors->first('MatKhau')"></x-input.text>
                        @error('MatKhau') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                    </x-input.group>
                    <x-input.group label="Trạng thái" for="TrangThai">
                        <x-input.select id="TrangThai" wire:model="TrangThai" :error="$errors->first('TrangThai')">
                            <option value="1">Hoạt động</option>
                            <option value="0">Không hoạt động</option>
                        </x-input.select>
                        @error('TrangThai') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                    </x-input.group>
                </x-slot>
                <x-slot name="footer">
                    <x-button.secondary wire:click="$set('showEditModal', false)">close</x-button.secondary>
                    <x-button.success type="submit">Lưu</x-button.success>
                </x-slot>
            </x-modal.dialog>
        </form> 
    </div>    
</div> 
