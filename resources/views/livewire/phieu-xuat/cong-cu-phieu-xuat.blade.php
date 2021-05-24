<div>
    <x-toolbar>  
        <div class="py-2 flex justify-between">
            <x-input.text wire:model.debounce.500ms="search" placeholder="Tìm kiếm ..."></x-input.text> 
        </div>  
        <x-toolbar.button>  
            <x-button.success wire:click="$emitTo('phieu-xuat.them-moi-phieu-xuat', 'themmoi')" >Thêm mới</x-button.success>
        </x-toolbar.button>    
        <x-toolbar.button> 
            <x-button.primary wire:click="export('csv')" >Xuất CSV</x-button.primary>
        </x-toolbar.button>
        <x-toolbar.button> 
            <x-button.primary  wire:click="export('xlsx')" >Xuất XLSX</x-button.primary>
        </x-toolbar.button>
        <x-toolbar.button> 
            <x-button.indigo wire:click="import" >Nhập XLSX</x-button.indigo>
        </x-toolbar.button>   
        <x-toolbar.button> 
            <x-button.danger wire:click="deleteSelected">Xóa chọn</x-button.danger>
        </x-toolbar.button>  
    </x-toolbar> 
    @livewire('phieu-xuat.import')
</div>
