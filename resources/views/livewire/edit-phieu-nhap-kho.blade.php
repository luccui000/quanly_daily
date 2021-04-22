<div>
    
    <x-modal.dialog wire:model="showEditPhieuNhapKhoModal" maxWidth="full" > 
        <x-slot name="content"> 
            @json($phieumathang)
        </x-slot>
    </x-modal.dialog>
</div>
