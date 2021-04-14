@props([
    'label'
])
<div class="py-2 mt-1 ml-2">
    <x-dropdown label="{{ $label }}"> 
        {{ $slot }} 
    </x-dropdown> 
</div>