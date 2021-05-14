<div
    x-data="{ value: @entangle($attributes->wire('model')), picker: undefined }"
    x-init="new Pikaday({ field: $refs.input, format: 'DD/MM/YYYY', onOpen() { this.setDate($refs.input.value) } })"
    x-on:change="value = $event.target.value"
    class="rounded-md"
> 
    <input
        {{ $attributes->whereDoesntStartWith('wire:model') }}
        x-ref="input"
        x-bind:value="value"
        style="height: 32px;"
        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-1 px-2"
    />
</div>