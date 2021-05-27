<div> 
    <form wire:submit.prevent="save"> 
        <x-modal.dialog wire:model="showModal">
            <x-slot name="title">Thêm mới phiếu chi</x-slot>
            <x-slot name="content">  
                <div class="row">
                    <div class="col-md-6">  
                        <x-input.group label="Ngày lập" for="NgayLap">
                            <x-input.date wire:model="NgayLap"></x-input.date>
                        </x-input.group>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="mt-2 block text-sm font-medium leading-5 text-gray-700">Nhân viên lập</label> 
                        <select wire:model="nhanvien_id" class="w-64 block w-full px-2 py-2 text-black placeholder-gray-400 transition duration-100 ease-in-out bg-white border border-gray-300 rounded focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed">  
                            @foreach ($nhanvien as $nv)
                                <option value="{{ $nv->id }}">{{ $nv->HoTenNV }}</option>
                            @endforeach
                        </select> 
                    </div> 
                </div>
                <x-input.group label="Nội dung chi" for="NoiDungChi">
                    <textarea  class="p-2 border-2 border-gray-200 rounded-md w-full" wire:model="NoiDungChi" rows="5" placeholder="Mô tả... "></textarea>
                    @if ($errors->first('NoiDungChi'))
                        <div class="mt-1 text-red-500 text-sm">
                            @error('NoiDungChi') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                        </div>
                    @endif  
                </x-input.group> 
                <x-input.group label="Tổng tiền chi" for="TongTien">
                    <x-input.money wire:model="TongTien" :error="$errors->first('TongTien')"></x-input.text>
                    @error('TongTien') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </x-input.group>
                <x-input.group label="Mã phiếu" for="MaPN"> 
                    <select wire:model="mapn_id" class="w-64 block w-full px-2 py-2 text-black placeholder-gray-400 transition duration-100 ease-in-out bg-white border border-gray-300 rounded focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed">  
                        @foreach ($phieunhap as $pn)
                            <option value="{{ $pn->id }}">{{ $pn->ma_phieu_hang }} - {{ $pn->ngay_lap }} - {{ $pn->nhacungcap->TenNCC }}</option>
                        @endforeach
                    </select> 
                </x-input.group> 
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showModal', false)">close</x-button.secondary>
                <x-button.success type="submit">Lưu</x-button.success>
            </x-slot>
        </x-modal.dialog>
    </form>  
</div>
