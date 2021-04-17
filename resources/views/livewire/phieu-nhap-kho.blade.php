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
            <x-table.heading colspan="2">Trạng thái</x-table.heading>  
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
                    <x-button.link wire:click="edit('{{ $item->id }}')" >Edit</x-button.link> 
                </x-table.cell> 
            @endforeach
        </x-slot>
    </x-table>
</div>
