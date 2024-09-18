<div>
    {{-- filtered --}}
    <div class="flex justify-between">
        <p class="text-3xl font-semibold text-gray-800">
            Tickets
        </p>
        <button wire:click="clear_filters"  type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Clear</button>
    </div>
    <div class="flex flex-wrap p-4">
        @foreach (array_keys($filters) as $filter_key)
            <p wire:click="delete_filter('{{$filter_key}}')" class="my-1 text-sm mx-1 text-gray-600 font-semibold px-4 py-2 rounded-full border bg-gray-200">{{$filter_key}}</p>
        @endforeach
    </div>
    {{-- filters --}}
    <div class="flex flex-wrap items-center justify-between sticky top-[90px] bg-gray-100 z-30">
    {{-- date time --}}
    <div class="mx-auto lg:mx-0">
        <livewire:datetime-filter >
    </div>
    <div class="flex mx-auto lg:mx-0 flex-wrap justify-center">
        {{-- country --}}
        <livewire:country-filter >
        {{-- city --}}
        <livewire:city-filter >
        {{-- place --}}
        <livewire:place-filter >
        {{-- category --}}
        <livewire:category-filter >
    </div>
    </div>
    <!-- cards-section -->
    <div class="p-6 flex flex-col z-10">
        @foreach ($tickets as $ticket)   
        <!-- card -->
            <a href="{{route('ticket.index',['id'=>$ticket->id])}}" class="mx-auto hover:scale-110 ease-in-out flex items-center w-full duration-100 m-2 bg-white border border-gray-200 rounded-lg shadow">
                <div> <img class="hidden lg:block rounded-t-lg max-w-sm" src="{{$ticket->image}}" alt="" /></div>
                <div class="flex flex-wrap justify-between w-full">
                <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{$ticket->title}}</h5>
                    <div class="flex items-center my-2">
                        <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                        </svg>                              
                        <p class="ms-4 text-sm text-gray-500 font-bold">{{Carbon\Carbon::parse($ticket->date_time)->format('d')}} {{Carbon\Carbon::parse($ticket->date_time)->format('F')}} onwards | {{Carbon\Carbon::parse($ticket->date_time)->format('Y')}}</p>
                    </div>
                    <div class="flex items-center my-2">
                        <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z"/>
                        </svg>                                                          
                        <p class="ms-4 text-sm text-gray-500 font-bold capitalize">{{$ticket->venue->city}} {{$ticket->venue->place}} {{$ticket->venue->country}}</p>
                    </div>
                </div>
                <div class="flex items-center justify-between ms-auto">
                    {{-- <p class="font-bold text-dark-800 m-2 p-0 text-2xl">{{$ticket->price - ($ticket->price * $ticket->discount)}}$</p> --}}
                </div>
                </div>
            </a>
        @endforeach
    </div>
    <!-- pagination -->
    <div class="p-10">
        {{ $tickets->links() }}
    </div> 
</div>
