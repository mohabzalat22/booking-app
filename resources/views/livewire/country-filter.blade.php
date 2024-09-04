<div>
    <button id="dropdownDefaultButton" data-dropdown-toggle="country" class="text-white m-1 h-10 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">Country <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>
    <div id="country" class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
        <ul class="py-2 text-sm text-gray-700 overflow-y-scroll h-60 scrollbar-hide" aria-labelledby="dropdownDefaultButton">
            @foreach ($countries as $country)
                <li wire:click="update('{{$country}}')">
                    <a class="block px-4 py-2 hover:bg-gray-100">{{$country}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

