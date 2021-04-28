 <div>        
    <x-toolbar>  
        <div class="py-2 flex justify-between">
            <x-input.text wire:model.debounce.500ms="search" placeholder="Tìm kiếm ..."></x-input.text> 
        </div>  
        <x-toolbar.button>  
            <x-button.success wire:click="$emitTo('phieu-nhap-kho.tao-moi', 'create')" >Thêm mới</x-button.success>
        </x-toolbar.button>    
        <x-toolbar.button> 
            <x-button.primary wire:click="export('csv')" >Xuất CSV</x-button.primary>
        </x-toolbar.button>
        <x-toolbar.button> 
            <x-button.primary class="bg-green-200"  wire:click="export('xlsx')" >Xuất XLSX</x-button.primary>
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
            <x-table.heading >Tổng số lượng nhập</x-table.heading>
            <x-table.heading >Tổng giảm giá</x-table.heading>
            <x-table.heading >Tổng thanh toán</x-table.heading>
            <x-table.heading>Trạng thái</x-table.heading>  
            <x-table.heading></x-table.heading>  
        </x-slot>
        <x-slot name="body">   
            @foreach ($phieuhangs as $phieuhang)
                <x-table.row wire:loading.class.defer="opacity-50" wire:key="">
                    <x-table.cell class="pr-0 w-5" > 
                        <x-input.checkbox wire:model="selected" value="{{ $phieuhang->id }}"></x-input.checkbox>
                    </x-table.cell > 
                    <x-table.cell>{{  $loop->iteration }}</x-table.cell>
                    <x-table.cell>{{  $phieuhang->MaPH }}</x-table.cell>    
                    <x-table.cell>{{  $phieuhang->date_for_humans }}</x-table.cell>    
                    <x-table.cell>{{  $phieuhang->nhacungcap->TenNCC }}</x-table.cell>    
                    <x-table.cell>{{  $phieuhang->nhacungcap->TenNCC }}</x-table.cell>    
                    <x-table.cell>{{  $phieuhang->kho->TenKho }}</x-table.cell>    
                    <x-table.cell>{{  $phieuhang->nhanvien->HoTenNV }}</x-table.cell>    
                    <x-table.cell class="font-semibold">{{  money_format('%.0n', $phieuhang->Tong_ChietKhau) }}</x-table.cell>    
                    <x-table.cell class="font-semibold">{{  money_format('%.0n', $phieuhang->TongThanhToan) }}</x-table.cell>     
                    <x-table.cell>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $phieuhang->mau_sac_trang_thai }}-100 text-{{ $phieuhang->mau_sac_trang_thai }}-800">
                            {{ $phieuhang->TrangThai == 1 ? 'Đã nhập hàng' : 'Bán hết' }}
                        </span>  
                    </x-table.cell>     
                    <x-table.cell>
                        <x-button.link wire:click="$emitTo('edit-phieu-nhap-kho', 'edit', {{ $phieuhang->id }})" >Edit</x-button.link> 
                    </x-table.cell> 
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table> 
    @livewire('edit-phieu-nhap-kho')  
    @livewire('phieu-nhap-kho.tao-moi')  
</div>
