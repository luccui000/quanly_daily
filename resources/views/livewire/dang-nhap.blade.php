<div> 
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
        <div class="-mx-3 md:flex mb-6">
          <div class="md:w-1/3 px-3 mb-6 md:mb-0">
            <x-input.group label="Username" for="email" :error="$errors->first('email')" > 
                <x-input.text wire:model.lazy="email" id="email" placeholder="input" />
            </x-input.group>
          </div>
          <div class="md:w-1/3 px-3 mb-6 md:mb-0">
            <x-input.group label="password" for="password" :error="$errors->first('password')" > 
                <x-input.text wire:model.lazy="password" id="password" placeholder="password" />
            </x-input.group>
          </div> 
          <div class="md:w-1/3 px-3 mb-6 md:mb-0">
            <x-input.group label="passwordConfirmation" for="passwordConfirmation" :error="$errors->first('passwordConfirmation')" > 
                <x-input.text wire:model.lazy="passwordConfirmation" id="passwordConfirmation" placeholder="passwordConfirmation" />
            </x-input.group>
          </div>
        </div>
        <div class="-mx-3 md:flex mb-6">
            <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                <x-input.group label="Username" for="email" :error="$errors->first('email')" > 
                    <x-input.select wire:model="select" id="email">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </x-input.select>
                </x-input.group>
            </div>
        </div> 
        <div class="-mx-3 md:flex mb-6">
            <x-table.heading sortable="asd"  direction="12"  multiColumn="dssdf">
               Heading
            </x-table.heading> 
            
        </div>
        <div class="md:w-1/3 flex-grow pl-2 ">
            <label for="TSelect" class="mb-1 text-sm font-medium leading-5 text-gray-700">Select</label> 
            <div class="mt-1">
                <select class="w-64 block w-full pl-3 pr-10 py-2 text-black placeholder-gray-400 transition duration-100 ease-in-out bg-white border border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed">
                    <option value="">...</option>
                    <option value="">...</option>
                    <option value="">...</option>
                    <option value="">...</option>
                </select>
            </div>
        </div>
    </div>
    <x-table>
        <x-slot name="head">
            <x-table.heading sortable >heading 1</x-table>
            <x-table.heading >heading 2</x-table>
            <x-table.heading >heading 2</x-table>
            <x-table.heading >heading 2</x-table>
            <x-table.heading >heading 2</x-table>
        </x-slot>
        <x-slot name="body">
            <x-table.row >
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
            </x-table.row>
            <x-table.row >
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
            </x-table.row>
            <x-table.row >
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
            </x-table.row>
            <x-table.row >
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
            </x-table.row>
            <x-table.row >
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
                <x-table.cell >cell 1</x-table>
            </x-table.row>
        </x-slot>
    </x-table>
</div> 