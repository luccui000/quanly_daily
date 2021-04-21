<div class="align-middle min-w-full overflow-x-auto shadow-md overflow-hidden sm:rounded-lg">
    <table class="min-w-full divide-y divide-cool-gray-200" wire:loading.class.delay="opacity-70">
        <thead>
            <tr>
                {{ $head }}
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-cool-gray-200">
            {{ $body }}
        </tbody>
    </table>
</div>