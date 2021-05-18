<button style="margin-top: 1px;" {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-200 active:bg-gray-200 focus:outline-none focus:border-gray-100 focus:shadow-outline-gray disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>