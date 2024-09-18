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
        {{-- modal --}}
        <div id="qr-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <img class="max-w-md max-h-md mx-auto" src="http://127.0.0.1:8000/images/1.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
        {{-- dashboard --}}
        @include('layouts.custom-navigation')
   
        <div class="container mx-auto">
            @include('layouts.user-data')
            @include('layouts.dashboard-nav')
            {{-- reservation --}}
            @if (count($reservations) > 0)
                <div class="flex flex-wrap">
                    @foreach ($reservations as $reservation)
                        <a href="/storage/qrcodes/{{$reservation->id}}.png" class="hover:scale-110 ease-in-out duration-100 max-w-sm m-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <img class="rounded-t-lg" src="{{App\Models\Ticket::find($reservation->ticket_id)->image}}" alt="" />
                            <div class="p-5">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{App\Models\Ticket::find($reservation->ticket_id)->title}}</h5>
                                <div class="flex items-center my-2">
                                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                                    </svg>                              
                                    <p class="ms-4 text-sm text-gray-500 font-bold">{{Carbon\Carbon::parse(App\Models\Ticket::find($reservation->ticket_id)->date_time)->format('d')}} {{Carbon\Carbon::parse(App\Models\Ticket::find($reservation->ticket_id)->date_time)->format('F')}} onwards | {{Carbon\Carbon::parse(App\Models\Ticket::find($reservation->ticket_id)->date_time)->format('Y')}}</p>
                                </div>
                                <div class="flex items-center my-2">
                                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z"/>
                                    </svg>                                                          
                                    <p class="ms-4 text-sm text-gray-500 font-bold capitalize">{{App\Models\Ticket::find($reservation->ticket_id)->venue->city}} {{App\Models\Ticket::find($reservation->ticket_id)->venue->place}} {{App\Models\Ticket::find($reservation->ticket_id)->venue->country}}</p>
                                </div>
                                <p class="py-2 mt-1 px-3 w-full text-center text-2xl bg-gray-700 text-white rounded-full m-1font font-semibold">{{$reservation->type}}</p>
                                <p class="py-2 mt-1 px-3 w-full text-center text-2xl bg-gray-700 text-white rounded-full m-1font font-semibold">X{{$reservation->number}}</p>
                                <p class="py-2 mt-1 px-3 w-full text-center text-2xl bg-gray-700 text-white rounded-full m-1font font-semibold">{{$reservation->serial}}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <div class="flex flex-col items-center">
                        <div class="text-3xl text-gray-800 font-bold my-8">EMPTY RESERVATIONS</div>
                        <div class="bg-slate-200 rounded-full animate-pulse p-4">
                            <svg class="w-24 h-24 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @include('layouts.footer')
        @livewireScripts
    </body>
</html>