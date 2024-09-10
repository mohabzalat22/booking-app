<div class="mt-10">
    {{-- type --}}
    @if ($selected_type != '')
        <div class="px-3 py-2 bg-slate-200 text-center font-bold rounded-full">{{$selected_type}}</div>
    @endif
    <p class="text-gray-800 font-bold my-4">Type</p>
    <ul>
        @foreach ($types as $type)
            <li wire:click="change_type('{{$type}}')" >
                <button type="button" class="text-blue-700 w-full hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                    {{$type}}
                </button>
            </li>
        @endforeach
    </ul>
    <p class="text-gray-800 font-bold mt-6 mb-2">Order</p>
    <div class="flex justify-between">
        <button wire:click="dec" class="hover:bg-gray-600 h-10 w-10 text-gray-400 bg-gray-200 rounded-full">-</button>
        <p class="text-2xl text-gray-700">{{$tickets}}</p>
        <button wire:click="inc" class="hover:bg-gray-600 h-10 w-10 text-gray-400 bg-gray-200 rounded-full">+</button>
    </div>
    {{-- total --}}
    <div class="flex justify-between mt-12 border-t items-center py-4">
        <p class="text-gray-800 font-bold my-2 text-2xl">Total</p>
        @php
            if($selected_type != ''){
                $price = App\Models\Ticket::with(['types.price'])->find($this->id)->types()->where('type', $this->selected_type)->with('price')->first()->price->price;
            }
        @endphp
        <p class="text-gray-800 font-bold my-2 text-2xl">{{$tickets * $price}}$</p>
    </div>
    <button class="bg-blue-700 w-full text-white p-4 hover:bg-blue-800">BUY</button>
</div>