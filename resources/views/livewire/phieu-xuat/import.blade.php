<div>
    <x-modal.dialog wire:model="showModal"  >
        <x-slot name="content">
            <form action="{{ route('dashboard.phieuxuat.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center justify-center bg-grey-lighte border-dashed border-2 border-gray-400r">
                    <label class="w-64 flex flex-col mt-2 items-center px-4 py-6 bg-white text-blue uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-base leading-normal">Select a file</span>
                        <input type='file' class="hidden" name="file" />
                    </label>
                </div>
                <x-button.success class="mt-2 float-right mb-2" type="submit">Tải lên</x-button.success>
            </form>
        </x-slot>
    </x-modal.dialog>
</div>
