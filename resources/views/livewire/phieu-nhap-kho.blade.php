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
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showModal" maxWidth="full" >
            <x-slot name="title">
                <a href="{{ url()->previous() }}" class="hover:text-green-200 p-0 font-semibold float-left" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
            </x-slot>
            <x-slot name="content">    
                 <div class="flex space-x-2" style="height: 900px;"> 
                    <div class="flex-grow h-5/6">  
                        <div class="flex justify-between">
                            <div class=" inline flex space-between space-x-2" style="width: 500px;">
                                <h2 class="flex-none text-md font-semibold mt-3 uppercase">Nhập hàng</h2>
                                <x-input.text wire:model.debounce.500ms="searchProduct" style="width: 300px;" placeholder="Tìm kiếm ..."></x-input.text> 
                            </div> 
                            <div class="">
                                <x-toolbar.button> 
                                    <x-button.danger wire:click="deleteSelected">Xóa chọn</x-button.danger>
                                </x-toolbar.button>
                            </div>
                        </div>
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
                            </x-slot>
                        </x-table> 
                    </div> 
                    <div class="flex-none w-96 bg-green-100" style="height: 900px">  
                        Right
                    </div>
                 </div>
            </x-slot> 
        </x-modal.dialog>
    </form> 
</div>
