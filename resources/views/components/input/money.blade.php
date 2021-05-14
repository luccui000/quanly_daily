<div  
    x-data="{ 
        currency: @entangle($attributes->wire('model')), 
        formatCurrency(number) {
            var n = number.split('').reverse().join('');
            var n2 = n.replace(/\d\d\d(?!$)/g, '$&,');    
            return  n2.split('').reverse().join('');
        }, moneyValue: ''
    }"
    x-init="currency = formatCurrency($refs.data.value)"
    class="flex rounded-md" 
    > 

    <input  
        x-ref="data"
        x-on:input.debounce.30ms="
            moneyValue = $event.target.value;
            if(moneyValue.length) 
                moneyValue = moneyValue.split(',').join('')
            currency = formatCurrency(moneyValue)"
        x-bind:value="currency"
        {{ $attributes->merge(['class' => 'pl-5 w-full shadow-sm text-grey-darker border border-grey-lighter rounded py-2 px-2']) }} 
        placeholder="0.00" aria-describedby="price-currency">

    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
        <span class="text-gray-500 sm:text-sm sm:leading-5" id="price-currency">
            VNĐ
        </span>
    </div>
</div>

