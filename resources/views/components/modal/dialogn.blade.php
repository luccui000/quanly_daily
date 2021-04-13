 <x-modal2  {{ $attributes }}>  
    <div class="modal-dialog relative w-auto pointer-events-none max-w-lg my-8 mx-auto px-4 sm:px-0" role="document">
        <div class="relative flex flex-col w-full pointer-events-auto bg-white border border-gray-300 rounded-lg">
          <div class="px-6 py-4">  
            <div class="text-lg">
                {{ $title }}
            </div>
    
            <div class="mt-4">
                {{ $content }}
            </div>
          </div>
          <div class="px-6 py-4 bg-gray-100 text-right">
            {{ $footer }}
          </div>
        </div>
    </div>
</x-modal2>
