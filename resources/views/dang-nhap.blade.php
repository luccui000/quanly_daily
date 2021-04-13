    <div>      
        <div class="flex-col space-y-6">  
            <div class="flex ml-1">
                <div class="float-right py-2 flex justify-between">
                    <x-input.text wire:model="filters.search" placeholder="Search ..."></x-input.text> 
                </div>
                <div class="py-2 mt-1 ml-2">
                    <x-dropdown label=" Bộ lọc tìm kiếm">
                        @foreach ($filterColumns as $value => $label)
                            <x-dropdown.item wire:click="setFilter('{{ $value }}')" >{{ $label }}</x-dropdown.item>   
                        @endforeach
                    </x-dropdown> 
                </div>  
                <div class="py-2 mt-1 ml-2">
                    <x-button.primary wire:click="deleteSelected" id="deleteSelected">Delete</x-button.primary>
                </div>  
                <div class="py-2 mt-1 ml-2">
                    <x-button.success wire:click="create" >New</x-button.success>
                </div>
            </div>   
            <x-table>   
                <x-slot name="head"> 
                    <x-table.heading >
                        <x-input.checkbox></x-input.checkbox>
                    </x-table.heading >
                    <x-table.heading >#</x-table>
                    <x-table.heading wire:click="sortBy('TenDangNhap')" sortable :direction="$sortField === 'TenDangNhap' ? $sortDirection : null" >Tên đăng nhập</x-table>
                    <x-table.heading >Mật khẩu</x-table>
                    <x-table.heading wire:click="sortBy('TrangThai')" :direction="$sortField === 'TrangThai' ? $sortDirection : null" >Trạng thái</x-table>
                    <x-table.heading wire:click="sortBy('LanDangNhapCuoi')" sortable :direction="$sortField === 'LanDangNhapCuoi' ? $sortDirection : null" col-span="2">Lần đăng nhập cuối</x-table> 
                </x-slot>
                <x-slot name="body">   
                    @forelse ($hoso as $item) 
                    <x-table.row wire:loading.class.defer="opacity-50" wire:key="{{ $item->TenDangNhap }}" >
                            <x-table.cell class="pr-0 w-5" > 
                                <x-input.checkbox wire:model="selected" value="{{ $item->TenDangNhap }}"></x-input.checkbox>
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
                                <x-button.link wire:click="edit('{{ $item->TenDangNhap }}')" >Edit</x-button.link> 
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
            <div class="pb-4">
                {{ $nguoidung->links()  }}
            </div> 
        </div>   
        @json($editing)  
        <form wire:submit.prevent="save">
            <x-modal.dialog wire:model.defer="showEditModal" > 
                <x-slot name="title">Sửa thông tin</x-slot>
                <x-slot name="content"> 
                    <x-input.group label="Tên đăng nhập" for="TenDangNhap">
                        <x-input.text wire:model="editing.TenDangNhap" id="TenDangNhap" readonly></x-input.text>
                    </x-input.group> 
                    <x-input.group label="Mật khẩu" for="MatKhau">
                        <x-input.text type="password" wire:model.lazy="editing.MatKhau" id="MatKhau"></x-input.text>
                    </x-input.group> 
                    <x-input.group label="Trạng thái" for="TrangThai" :error="$errors->first('TrangThai')" > 
                        <x-input.select wire:model="editing.TrangThai" id="TrangThai">
                            <option value="1">Hoạt động</option>
                            <option value="0">Không hoạt động</option> 
                        </x-input.select>
                    </x-input.group>
                </x-slot>
                <x-slot name="footer">
                    <x-button.secondary wire:click="$set('showEditModal', false)"> close</x-button>
                    <x-button.primary type="submit"> Lưu</x-button>
                </x-slot>
            </x-modal.dialog >
        </form>  
    </div> 