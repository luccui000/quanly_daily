<div class="flex-none w-96 bg-gray-50 p-4 rounded-md space-y-2 relative"  style="height: 900px"> 
    <div class="relative mb-3">
        <h2 class="text-gray-800 mt-2 font-bold ">Nhân viên</h2>
        <p class="text-md border-b-2 border-gray-500 border-dashed cursor-pointer" '
            style="position: absolute; top: -5px; left: 80px;">{{ auth()->user()->TenDangNhap ?? "" }}</p>
        <div 
            wire:model="NgayLap"
            class="w-24 block" 
            style="position: absolute; top: -5px; right: -25px"
            x-data="{ value: @entangle('NgayLap').defer, picker: undefined }"
            x-init="new Pikaday({ 
                field: $refs.input,
                toString(date, format) {  
                    return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
                }, onOpen() { 
                    this.setDate($refs.input.value) 
                } 
            })"
            x-on:change="value = $event.target.value"
        >
            <input  
                x-ref="input"
                x-bind:value="value"
                class="p-1 bg-transparent border-b-1 cursor-pointer w-20 border-gray-900 rounded-md absolute right-5 focus:border-2 focus:border-gray-600" > 
        </div> 
    </div>
    
    <div class="flex float-right mt-12"> 
        <x-button wire:click="$emitTo('phieu-nhap-kho.tao-moi', 'close', false)" type="button"><p class="text-gray-900">Hủy</p></x-button>
        <x-button.success wire:click="save" type="submit">Hoàn thành</x-button.success>  
    </div> 
</div> 