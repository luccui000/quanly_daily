<div>
    <x-table>
        <x-slot name="head"> 
            <x-table.heading >
                <x-input.checkbox></x-input.checkbox>
            </x-table.heading >
            <x-table.heading >#</x-table.heading> 
            <x-table.heading >Ngày lập</x-table.heading>  
            <x-table.heading >Nhân viên lập</x-table.heading>
            <x-table.heading >Nội dung chi</x-table.heading>
            <x-table.heading >Tổng chi</x-table.heading> 
            <x-table.heading></x-table.heading>  
        </x-slot>
        <x-slot name="body">
            @json($phieuchi)
            {{-- @foreach ($phieuchi as $pc)
                
            @endforeach --}}
        </x-slot>
    </x-table>
</div>
