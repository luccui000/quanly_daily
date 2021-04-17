<div>
    <form wire:submit.prevent="createNewUnit">
        <x-modal.dialog wire:model="showCreateNewUnit">
            <x-slot name="title">Thêm mới Nhà cung cấp</x-slot>
            <x-slot name="content">    
                <x-input.group label="Tên mặt hàng" for="TenMH">
                    <x-input.text id="TenMH" wire:model.lazy="TenMH" :error="$errors->first('TenMH')"></x-input.text>
                    @error('TenMH') <div class="mt-1 text-red-500 text-sm">{{ $message }}</div> @enderror
                </x-input.group> 
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showModal', false)">close</x-button.secondary>
                <x-button.success type="submit">Lưu</x-button.success>
            </x-slot>
        </x-modal.dialog>
    </form>  
</div>
