
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

<div class="modal-content">
    <div class="quick-search">
        <div class="container">
            <div class="row">
                <div class="col-md-4 ml-auto mr-auto">
                    <div class="input-wrap">
                        <input type="text" id="quick-search" class="form-control" placeholder="Search...">
                        <i class="ik ik-search"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-body d-flex align-items-center">
        
    </div>
</div>