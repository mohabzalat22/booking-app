<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="http://127.0.0.1:8000/images/ticket.png">
        <title>TikBook</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
        @livewireStyles
        @livewireScripts
    </head>
    <body class="font-sans bg-gray-100 antialiased dark:bg-black dark:text-white/50 max-w-[1500px] mx-auto">
        @include('layouts.custom-navigation')
        <livewire:cart-component>
        <!-- footer -->
        @include('layouts.footer')
    </body>
</html>
