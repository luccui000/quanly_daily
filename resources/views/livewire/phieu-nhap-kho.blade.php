 <div>     
     @json($mathangEditing)
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
            <x-button.indigo wire:click="import" >Nhập XLSX</x-button.indigo>
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
                    <x-table.cell>{{  $phieuhang->kho->TenKho }}</x-table.cell>    
                    <x-table.cell>{{  $phieuhang->nhanvien->HoTenNV }}</x-table.cell>    
                    <x-table.cell>{{  $phieuhang->nhanvien->HoTenNV }}</x-table.cell>    
                     
                    <x-table.cell class="font-semibold">{{  money_format('%.0n', $phieuhang->Tong_ChietKhau) ?? 0 }}</x-table.cell>    
                    <x-table.cell class="font-semibold">{{  money_format('%.0n', $phieuhang->TongThanhToan) }}</x-table.cell>     
                    <x-table.cell>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $phieuhang->mau_sac_trang_thai }}-100 text-{{ $phieuhang->mau_sac_trang_thai }}-800">
                            {{ $phieuhang->TrangThai == 1 ? 'Đã nhập hàng' : 'Bán hết' }}
                        </span>  
                    </x-table.cell>     
                    <x-table.cell>
                        <x-button.link >Edit</x-button.link> 
                    </x-table.cell> 
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table> 
    <x-modal.dialog wire:model="showEditModal" maxWidth="full" > 
        <x-slot name="content">   
            <form action="{{ route('dashboard.nhaphang.store') }}" method="POST" class="flex space-x-2 m-0 h-screen" >
                @csrf  
                <div class="flex-grow h-full" style=" overflow: auto">  
                    <div class=""> 
                        <div class="flex justify-between">
                            <div class="flex space-x-2">
                                <a href="{{ url()->previous() }}" class="hover:text-green-200 font-semibold" style="margin-top: 12px;" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                </a>
                                <div class=" inline flex space-between space-x-2" style="width: 500px;">
                                    <h2 class="flex-none text-md font-semibold mt-3 uppercase">Nhập hàng</h2>
                                    @livewire('search-drop-down',  ['loaiphieu' => 'phieunhap'])
                                </div>  
                            </div>
                            <div class="">  
                                <x-button  type="button" >
                                    <x-icon.upload class="text-gray-900"></x-icon.upload>  
                                </x-button>
                            </div>
                        </div>
                        <div class="mt-2">
                            <x-table>
                                <x-slot name="head">  
                                    <x-table.heading >STT</x-table.heading>
                                    <x-table.heading >Mã hàng</x-table.heading>
                                    <x-table.heading >Tên hàng</x-table.heading>
                                    <x-table.heading >Đơn vị tính</x-table.heading>
                                    <x-table.heading >Số lượng</x-table.heading>
                                    <x-table.heading >Đơn giá</x-table.heading>
                                    <x-table.heading >Giảm giá</x-table.heading> 
                                    <x-table.heading >Thành tiền</x-table.heading>   
                                    <x-table.heading ></x-table.heading>   
                                </x-slot>
                                <x-slot name="body">     
                                @foreach ($mathangEditing as $index => $nhaphang) 
                                    <x-table.row wire:key="">    
                                        <x-table.cell>{{  $loop->iteration }}</x-table.cell>
                                        <x-table.cell>{{  $nhaphang->MaMH }}</x-table.cell>
                                        <x-table.cell>{{  $nhaphang->TenMH }}</x-table.cell>
                                        <x-table.cell>{{  $nhaphang->donvitinh_id }}</x-table.cell>
                                        <x-table.cell>{{  $nhaphang->pivot->SoLuong ?? 0 }}</x-table.cell>
                                        <x-table.cell> 
                                            <div class="relative flex space-x-1">  
                                                <div style="margin-top: 7px;" class="cursor-pointer" wire:click="decrement({{ $index }})">
                                                    <x-icon.minus fill="#000" ></x-icon.minus>
                                                </div>
                                                <div class="">
                                                    <input type="number"
                                                        min="0"
                                                        style="width: 40px; "
                                                        name="danhsachNhapHang[{{ $index }}][SoLuong]"  
                                                        class="p-2 bg-gray-200 rounded-sm text-center"
                                                        value="{{ $nhaphang->pivot->SoLuong }}">
                                                </div>
                                                <div style="margin-top: 7px;" class="cursor-pointer" wire:click="increment({{ $index }})">
                                                    <x-icon.plus fill="#000"  ></x-icon.plus>
                                                </div>
                                            </div>
                                        </x-table.cell>
                                        <x-table.cell class="font-semibold">{{ money_format('%.0n', $nhaphang->pivot->DonGia ?? 0 )}}</x-table.cell>
                                        <x-table.cell class="font-semibold">{{  money_format('%.0n', $nhaphang->pivot->TienChietKhau ?? 0) }}</x-table.cell>
                                        <x-table.cell class="font-semibold">{{  money_format('%.0n', $nhaphang->pivot->ThanhTien ?? 0) }}</x-table.cell> 
                                    </x-table.row> 
                                @endforeach 
                                </x-slot>
                            </x-table> 
                        </div>
                    </div>
                </div> 
                <div class="flex-none w-96 bg-gray-50 p-4 rounded-md space-y-2 relative"  style="height: 900px">   
                    <div class="relative mb-3"> 
                        <h2 class="text-gray-800 mt-2 font-bold ">Nhân viên</h2>
                        <p class="text-md border-b-2 border-gray-500 border-dashed cursor-pointer" '
                            style="position: absolute; top: -8px; left: 90px;">{{ auth()->user()->TenDangNhap ?? "" }}</p> 
                            <input type="hidden" name="nhanvien_id" value="{{ auth()->user()->id }}"> 
                    </div>
                </div>
            </form>   
        </x-slot>
    </x-modal.dialog>  
    @livewire('phieu-nhap-kho.tao-moi')  
    <x-modal.dialog wire:model="showImportModal"  >
        <x-slot name="content">
            <form action="{{ route('dashboard.phieuxuat.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center justify-center bg-grey-lighte border-dashed border-2 border-gray-400r">
                    <label class="w-64 flex flex-col mt-2 items-center px-4 py-6 bg-white text-blue uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-base leading-normal">Chọn tập tin</span>
                        <input type='file' class="hidden" name="file" />
                    </label>
                </div>
                <x-button.success class="mt-2 float-right mb-2" type="submit">Tải lên</x-button.success>
            </form>
        </x-slot>
    </x-modal.dialog>
</div>
