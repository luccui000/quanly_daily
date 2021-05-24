<div x-data="{ openTab: 1 }"  data-tabs-active-tab="-mb-px border-l border-t border-r rounded-t" data-tabs-index="2">
    <ul class="flex border-b">
      <li @click="openTab = 1" class="-mb-px mr-1">
        <a class= "inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold" style="background-color: #f4f6f9;">Tab 1</a>
      </li>
      <li @click="openTab = 2" class="mr-1">
        <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" >Tab 2</a>
      </li>
      <li @click="openTab = 3" class="mr-1">
        <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" >Tab 3</a>
      </li>
    </ul>

    <div class="w-full pt-4" >
      <div x-show="openTab === 1">Tab #1</div>
      <div x-show="openTab === 2">Tab #2</div>
      <div x-show="openTab === 3">Tab #3</div>
    </div>
  </div>