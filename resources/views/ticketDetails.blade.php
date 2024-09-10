<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="http://127.0.0.1:8000/images/ticket.png">
        <title>TikBook</title>
        @livewireStyles
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="font-sans bg-gray-100 antialiased dark:bg-black dark:text-white/50 max-w-[1500px] mx-auto">
        {{-- dashboard --}}
        @include('layouts.custom-navigation')
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

        @include('layouts.footer')
        @livewireScripts
    </body>
</html>