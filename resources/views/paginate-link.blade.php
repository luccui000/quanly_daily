@if ($paginator->hasPages())
    <ul class="flex justify-between">
        <!-- prev -->
        @if ($paginator->onFirstPage())
            <li class="w-16 px-2 py-1 text-center rounded border bg-gray-200">Prev</li>
        @else
        <li class="w-16 px-2 py-1 text-center rounded border shadow-sm bg-white cursor-pointer" wire:click="previousPage">Prev</li>
        @endif
        <!-- prev end -->

        <!-- numbers -->
        @json($elements)
        @foreach ($elements as $element)
        <div class="flex">
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="mx-2 w-10 px-2 py-1 text-center rounded border shadow-sm bg-indigo-500 text-white cursor-pointer" wire:click="gotoPage({{$page}})">{{$page}}</li>
                    @else
                        <li class="mx-2 w-10 px-2 py-1 text-center rounded border shadow-sm bg-white cursor-pointer" wire:click="gotoPage({{$page}})">{{$page}}</li>
                    @endif
                @endforeach
            @endif
        </div>
        @endforeach
        <!-- end numbers -->


        <!-- next  -->
        @if ($paginator->hasMorePages())
        <li class="w-16 px-2 py-1 text-center rounded border shadow-sm bg-white cursor-pointer" wire:click="nextPage">Next</li>
        @else
        <li class="w-16 px-2 py-1 text-center rounded border bg-gray-200">Next</li>
        @endif
        <!-- next end -->
    </ul>
@endif