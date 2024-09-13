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
        <!-- Main modal -->
        <div class="container mx-auto">
            <div class="flex flex-wrap items-center justify-between p-10">
                <div>
                    <p class="p-0 m-0 text-gray-700 text-5xl font-bold">{{Auth::user()->name}}</p>
                    <p class="p-0 m-2 text-gray-500 text-base font-semibold">{{Auth::user()->email}}</p>
                </div>
                <div class="mt-2 lg:mt-0">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-full px-5 py-4 text-center">Logout</button>
                    </form>
                </div>
            </div>
        <livewire:dashboard-dynamic-component>
        </div>
        @include('layouts.footer')
        @livewireScripts
    </body>
</html>