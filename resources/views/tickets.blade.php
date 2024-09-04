<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        @livewireStyles
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="font-sans bg-gray-100 antialiased max-w-[1500px] mx-auto">
        @include('layouts.custom-navigation')
        <!-- tickets -->
         <div class="mt-12 p-10">
            <p class="text-3xl font-semibold text-gray-800">
                Tickets
            </p>
            {{-- tickets-section --}}
            @livewire('tickets-section')
         </div>
        <!-- footer -->
        @include('layouts.footer')
        @livewireScripts
    </body>
</html>
