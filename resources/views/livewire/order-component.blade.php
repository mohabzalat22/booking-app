<div class="mt-10">
    <p class="text-gray-800 font-bold my-2">Order</p>
    <div class="flex justify-between">
        <button wire:click="dec" class="hover:bg-gray-600 h-10 w-10 text-gray-400 bg-gray-200 rounded-full">-</button>
        <p class="text-2xl text-gray-700">{{$tickets}}</p>
        <button wire:click="inc" class="hover:bg-gray-600 h-10 w-10 text-gray-400 bg-gray-200 rounded-full">+</button>
    </div>
    {{-- total --}}
    <div class="flex justify-between mt-12 border-t items-center py-4">
        <p class="text-gray-800 font-bold my-2 text-2xl">Total</p>
        <p class="text-gray-800 font-bold my-2 text-2xl">{{$tickets * $price}}$</p>
    </div>
    <button class="bg-blue-700 w-full text-white p-4 hover:bg-blue-800">BUY</button>
</div>