@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        @if(isset($title))
            <div class="text-lg">
                {{ $title }}
            </div>
        @endif 
        <div class="">
            {{ $content }}
        </div>
    </div>

    @if(isset($footer))
        <div class="px-6 py-4 bg-gray-100 text-right">
            {{ $footer }}
        </div> 
    @endif
</x-modal>
