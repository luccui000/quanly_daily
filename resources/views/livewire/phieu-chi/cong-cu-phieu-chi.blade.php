<div>
    <x-toolbar>  
        <div class="py-2 flex justify-between">
            <x-input.text wire:model.debounce.500ms="search" placeholder="Tìm kiếm ..."></x-input.text> 
        </div>  
        <x-toolbar.button>  
            <x-button.success wire:click="$emitTo('phieu-chi.them-moi-phieu-chi', 'themmoi')" >Thêm mới</x-button.success>
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
