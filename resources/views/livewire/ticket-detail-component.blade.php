<div>
    @if ($danger_message)
        <div class="fixed top-20 right-0 z-50" wire:click="hide_toast_danger">
            <livewire:toast-danger-component message="{{$danger_message}}">
        </div>
    @endif
    @if ($success_message)
        <div class="fixed top-20 right-0 z-50" wire:click="hide_toast_success">
            <livewire:toast-success-component message="{{$success_message}}">
        </div>
    @endif
    {{-- modal --}}
    @if ($show_modal)
        <div wire:click="hide_modal" id="add-cart-modal" tabindex="-1" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full flex"  aria-modal="true" role="dialog">
            <div @click.stop class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button wire:click="hide_modal" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" wire:click="hide_modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto w-12 h-12 text-gray-600  dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg>                          
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Add to Cart</h3>
                        <ul>
                            @if ($cart_type)
                                <li class="bg-slate-200 rounded-lg w-full py-2 my-1 text-gray-600 font-bold capitalize">{{$cart_type}}</li>
                                
                            @endif

                            @if ($cart_number)
                                <li class="bg-slate-200 rounded-lg w-full py-2 my-1 text-gray-600 font-bold capitalize">X{{$cart_number}}</li>
                            @endif

                            @if ($cart_total_price)
                                <li class="bg-slate-200 rounded-lg w-full py-2 my-1 text-gray-600 font-bold capitalize">{{$cart_total_price}}</li>
                            @endif
                            
                        </ul>
                        <div class="py-4">
                            <button wire:click="hide_modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                            <button wire:click="add_local_storage" x-on:click="save_to_local_storage('{{$id}}', '{{$cart_type}}' , '{{$cart_number}}')" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- overlay --}}
        <div class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40"></div>
    @endif
    {{-- dashboard --}}
    <div class="p-10">
        <div class="flex flex-wrap justify-evenly">
            <div>
                <div class="max-w-2xl rounded-xl overflow-hidden">
                    <img src="{{$ticket->image}}" alt="" class="w-full">
                </div>
                <p class="text-2xl font-semibold text-gray-800 mt-4 capitalize underline">description</p>
                <p class="text-gray-500 max-w-2xl my-2">
                    {{$ticket->description}}
                </p>
                {{-- place --}}
                <p class="text-2xl font-semibold text-gray-800 mt-10 capitalize underline">Venue</p>
                <p class="text-gray-500 max-w-2xl my-2">
                    {{$ticket->venue->city}} {{$ticket->venue->place}} {{$ticket->venue->country}}
                </p>
                <p class="text-gray-500 max-w-2xl my-2">
                    {{$ticket->venue->location}}
                </p>
                {{-- number of tickets --}}
                <div class="flex flex-wrap mt-12">
                    @foreach ($types as $type)          
                        <div class="m-2">
                            <div class="text-center hover:bg-gray-700 hover:scale-105 text-white bg-gray-500 rounded-full py-2 px-4 text-xl capitalize">{{$type->type}}</div>
                            <div class="text-center text-gray-800 border border-gray-500 rounded-2xl -mt-2 py-4 px-4 text-xl">{{$type->price->price}} EGP</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="w-full mt-2 lg:mt-0 lg:max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$ticket->title}}</h5>
                <div class="flex items-center my-2">
                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z"/>
                    </svg>
                    <span class="ms-2 capitalize text-gray-500 font-medium">{{$ticket->category}}</span>
                </div>

                <div class="flex items-center my-2">
                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                    </svg> 
                    <span class="ms-2 capitalize text-gray-500 font-medium">{{Carbon\Carbon::parse($ticket->date_time)->format('d')}} {{Carbon\Carbon::parse($ticket->date_time)->format('F')}} onwards | {{Carbon\Carbon::parse($ticket->date_time)->format('Y')}}</span>
                </div>

                <div class="flex items-center my-2">
                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z"/>
                    </svg> 
                    <span class="ms-2 capitalize text-gray-500 font-medium">{{$ticket->venue->city}} {{$ticket->venue->place}} {{$ticket->venue->country}}</span>
                </div>
                {{-- order --}}
                <livewire:order-component :price="$ticket->price - ( $ticket->discount * $ticket->price)">
            </div>
        </div>
    </div>
    
</div>
<script>
    // var tickets = [];
    const save_to_local_storage = (id, type, number)=>{
        console.log(id, type, number)
        if(id != null && type != null && number != null){
            const data_record = {
                'id': id,
                'type': type, 
                'number': number, 
            }
            try{
                // tickets.push(data_record);
                localStorage.setItem('tickets', JSON.stringify(data_record));
            }
            catch ($e){
                console.error($e);
            }
        }
    }
</script>