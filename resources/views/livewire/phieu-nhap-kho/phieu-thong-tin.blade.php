@if(Session::has('message')) 
    <p class="alert
    {{ Session::get('alert-class', 'alert-info') }}">{{Session::get('message') }}</p> 
@endif
<div class="flex-none w-96 bg-gray-50 p-4 rounded-md space-y-2 relative"  style="height: 900px">   
    <div class="relative mb-3"> 
        <h2 class="text-gray-800 mt-2 font-bold ">Nhân viên</h2>
        <p class="text-md border-b-2 border-gray-500 border-dashed cursor-pointer" '
            style="position: absolute; top: -8px; left: 90px;">{{ auth()->user()->TenDangNhap ?? "" }}</p> 
            <input type="hidden" name="nhanvien_id" value="{{ auth()->user()->id }}">
        <div  
            wire:model="NgayLap"
            class="block" 
            style="position: absolute; top: -5px; right: -25px;"
            x-data="{ value: @entangle('NgayLap'), picker: undefined }"
            x-init="new Pikaday({ 
                field: $refs.input,
                toString(date, format) {  
                    return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
                }, onOpen() { 
                    this.setDate($refs.input.value) 
                }, 
                firstDay: 1,
                minDate: new Date(),
                maxDate: new Date(2020, 12, 31),
                yearRange: [2000,2020]
            })"
            x-on:change="value = $event.target.value"
        >
            <input  
                name="NgayLap"
                style="width: 90px;"
                x-ref="input"
                x-bind:value="value"
                class="p-1 bg-transparent border-b-1 cursor-pointer w-20 border-gray-900 rounded-md absolute right-5 focus:border-2 focus:border-gray-600" > 
        </div>  
        <div class="mt-3 mb-3">
            <hr>
        </div>
        <x-input.group label="Mã phiếu nhập" for="MaPH">
            <x-input.text name="MaPH" wire:model="MaPH" placeholder="Mã tạo tự động..." readonly></x-input.text>
        </x-input.group> 
        <x-input.group label="Nhà cung cấp" for="NhaCungCap">
            <x-input.select name="nhacungcap_id" wire:model="nhacungcap_id">
                @foreach ($nhacungcap as $ncc)
                    <option value="{{ $ncc->id }}">{{ $ncc->TenNCC }}</option> 
                @endforeach 
            </x-input.select> 
        </x-input.group>   
        <x-input.group label="Kho hàng" for="KhoHang">
            <x-input.select name="kho_id" wire:model="kho_id">
                @foreach ($kho as $item)
                    <option value="{{ $item->id }}">{{ $item->TenKho }} - {{ $item->DiaChi }}</option> 
                @endforeach 
            </x-input.select> 
        </x-input.group> 
        <div class="mt-6 mb-6">
            <hr>
        </div>
        <div class="flex justify-between mt-3 mb-3">
            <h2 class="text-gray-800 font-bold">Trạng thái</h2>
            <p>Tạm tính</p>
        </div>
        <div class="flex justify-between mt-3 mb-3">
            <h2 class="text-gray-800 font-bold">Tổng tiền hàng</h2>
            <p class="font-bold">{{ money_format('%.0n', $TongTienHang) }}</p>
        </div>
        <div class="flex justify-between mb-3"> 
            <h2 class="text-gray-800 mt-2 font-bold">Tổng VAT</h2>
            <x-input.select wire:model="Tong_VAT" name="Tong_VAT">
                <option value="0" selected>0%</option>  
                <option value="5" >5%</option>  
                <option value="10" >10%</option>  
            </x-input.select> 
        </div>
        <div class="flex justify-between mb-3"> 
            <h2 class="text-gray-800 mt-2 font-bold">Tổng giảm giá</h2>
            <div class="relative">
                <div class="border-b-2 border-gray-400">
                    <input type="number" min="0" max="100" step="5"  wire:model="Tong_ChietKhau" class="pl-3 text-grey-darker bg-transparent border-grey-lighter focus:outline-none rounded p-2" >
                </div>
                <div class="absolute right-7 top-2 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">
                        %
                    </span>
                </div> 
            </div>
        </div>   
        <div class="flex justify-between mt-3 mb-3">
            <h2 class="text-gray-800 font-bold mt-1">Tiền trả nhà cung cấp</h2>
            <p class="text-lg text-blue-400 font-semibold">{{ money_format('%.0n', $TongThanhToan) }}</p>
        </div>
        <div class="mt-6 mb-6">
            <hr>
        </div>
        <x-input.group label="Hình thức thanh toán" for="HinhThucThanhToan">
            <x-input.select wire:model="HinhThucThanhToan" name="HinhThucThanhToan" >
                <option value="1">Chuyển khoản</option> 
                <option value="2">Tiền mặt</option> 
            </x-input.select> 
        </x-input.group> 
        <x-input.group label="Mô tả" for="MoTa">
            <textarea class="p-2 border-2 border-gray-200 rounded-md " wire:model="MoTa" name="MoTa" cols="38" rows="5" placeholder="Mô tả... "></textarea>
        </x-input.group> 
    </div>
    <input type="hidden" name="TongTien" value="{{ $TongTienHang }}">
    <input type="hidden" name="Tong_ChietKhau" value="{{ $TongTienHang * $Tong_ChietKhau / 100 }}">
    <input type="hidden" name="TongThanhToan" value="{{ $TongThanhToan }}">
    <input type="hidden" name="TrangThai" value="1">
    <div class="flex float-right mt-12 space-x-2"> 
        <x-button wire:click="$emitTo('phieu-nhap-kho.tao-moi', 'close', false)" type="button"><p class="text-gray-900">Hủy</p></x-button>
        @if($TongTienHang > 0)
            <x-button.success  type="submit">Hoàn thành</x-button.success>  
        @else   
            <x-button.secondary type="button" wire:click="thongBaoChonHang">Hoàn thành</x-button.secondary>  
        @endif
        <x-button.primary type="button" wire:click="export('pdf')">In phiếu</x-button.primary>
    </div> 
</div> 