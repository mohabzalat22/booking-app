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