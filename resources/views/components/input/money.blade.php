<div 
    style="height: 38px; margin-top: 4px;" 
    class="flex rounded-md" 
    x-data="{ value: @entangle($attributes->wire('model')), formatCurrency(number) {
        var n = number.split('').reverse().join('');
        var n2 = n.replace(/\d\d\d(?!$)/g, '$&,');    
        return  n2.split('').reverse().join('');
    } }"  
    x-init="value = formatCurrency(value)"
    x-on:change="
        if($event.target.value) {
            value = $event.target.value.split(',').join('')
        }
        value = formatCurrency(value)"
    >
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <span class="text-gray-500 sm:text-sm sm:leading-5">
            đ
        </span>
    </div>

    <input {{ $attributes }} 
        x-ref="money"
        x-bind:value="value"
        class="pl-5 w-full shadow-sm text-grey-darker border border-grey-lighter rounded py-1 px-2" />

    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
        <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">
            VNĐ
        </span>
    </div>
</div>
 