<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="http://127.0.0.1:8000/images/ticket.png">
        <title>TikBook</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="font-sans bg-gray-100 antialiased dark:bg-black dark:text-white/50 max-w-[1500px] mx-auto">
        @include('layouts.custom-navigation')
        <!-- carousel -->
        <div class="container mx-auto">
            @include('layouts.user-data')
            @include('layouts.dashboard-nav')
            <div class="my-4"></div>
            @if ($notifications) 
                <div class="flex flex-wrap">
                    @foreach ($notifications as $n)
                    <div class="max-w-xs my-1">
                        <img src="{{asset(App\Models\Ticket::find($n->data['ticket_data']['ticket_id'])->image)}}" alt="">
                        <div id="toast-success" class="flex items-center justify-between my-2 w-full p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                            <div class="ms-3 text-sm font-normal">{{ $n->data['message'] ?? 'No message'}}</div>
                            <a href="{{$n->data['url']}}" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">PAY</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <div class="flex flex-col items-center">
                        <div class="text-3xl text-gray-800 font-bold my-8">EMPTY NOTIFICATIONS</div>
                        <div class="bg-slate-200 rounded-full animate-pulse p-4">
                            <svg class="w-24 h-24 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- footer -->
        @include('layouts.footer')
    </body>
</html>
