<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="http://127.0.0.1:8000/images/ticket.png">
        <title>TikBook</title>
        @livewireStyles
        @livewireScripts
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="font-sans bg-gray-100 antialiased max-w-[1500px] mx-auto">
        @include('layouts.custom-navigation')
        <!-- tickets -->
         <div class="mt-10 lg:mt-12 p-2 lg:p-10">
            {{-- tickets-section --}}
            @livewire('tickets-section')
         </div>
        <!-- footer -->
        @include('layouts.footer')
    </body>
</html>
