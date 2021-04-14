<div>    
    <div class="flex-col space-y-6">  
        <div class="flex ml-1">
            <div class="float-right py-2 flex justify-between">
                <x-input.text wire:model.debounce.500ms="search" placeholder="Tìm kiếm ..."></x-input.text> 
            </div>    
            <div class="py-2 mt-1 ml-2">
                <x-dropdown label="Bộ lọc"> 
                    <x-dropdown.item wire:click="" label="" class="flex item-center space-x-3">
                        <x-icon.csv ></x-icon.csv><span>csv</span>
                    </x-dropdown.item>
                    <x-dropdown.item wire:click="" class="flex item-center space-x-3">
                        <x-icon.xlsx></x-icon.xlsx><span>xlsx</span>
                    </x-dropdown.item> 
                </x-dropdown> 
            </div>
            <div class="py-2 mt-1 ml-2">
                <x-button.success wire:click="create" >Thêm mới</x-button.success>
            </div>
            <div class="py-2 mt-1 ml-2">
                <x-button.primary wire:click="export('csv')" >Xuất CSV</x-button.success>
            </div>
            <div class="py-2 mt-1 ml-2">
                <x-button.primary class="bg-green-200"  wire:click="export('xlsx')" >Xuất XLSX</x-button.success>
            </div>
            <div class="py-2 mt-1 ml-2">
                <x-button.danger wire:click="deleteSelected">Xóa chọn</x-button.primary>
            </div> 
        </div>
    </div>
</div>