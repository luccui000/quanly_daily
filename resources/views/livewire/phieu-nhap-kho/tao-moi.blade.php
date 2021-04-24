<div>
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model="showModal" maxWidth="full" > 
            <x-slot name="content">
                <div class="flex space-x-2 m-0 h-screen">
                    @livewire('phieu-nhap-kho.bang-them-mat-hang') 
                    @livewire('phieu-nhap-kho.phieu-thong-tin')      
                </div>
            </x-slot> 
        </x-modal.dialog>
    </form> 
</div>
