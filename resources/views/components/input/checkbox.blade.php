@props([
    'for' => false,
    'label' => false,
])
<div class="flex rounded-md">
    <input {{ $attributes }} id="{{ $for }}"
        type="checkbox"
        class="m-1 form-checkbox border-cool-gray-300 block transition duration-150 ease-in-out sm:text-sm sm:leading-5 "
    />
    <label for="{{ $for }}" style="margin-top: 1px;" class="text-sm font-normal" >{{ $label }}</label>
</div>