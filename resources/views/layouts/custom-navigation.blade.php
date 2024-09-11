    <!-- modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="mt-10 hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
             <!-- modal login -->
            <div class="relative bg-white rounded-lg shadow" id="login">
                <form class="max-w-sm mx-auto p-8" action="{{route('login')}}" method="POST">
                    @auth
                    <div class="flex justify-between items-center bg-gray-800 text-white px-4 rounded-full">
                        <p class="my-1">Welcome, {{ Auth::user()->name }}!</p>
                        <a href="{{route('dashboard')}}" class="text-red-500 p-2 rounded-full text-xl my-4 bg-white">dashboard</a>    
                    </div>
                    @endauth
                    @csrf
                    @guest        
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input name="email" type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@email.com" required />
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input name="password" type="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div class="flex items-start mb-5">
                        <div class="flex items-center h-5">
                        <input id="remember_me" type="checkbox" value="" name="remember" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" required />
                        </div>
                        <label for="remember_me" class="ms-2 text-sm font-medium text-gray-900">remember me</a></label>
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">submit</button>
                    <p id="register-button" class="float-right text-blue-700 mt-2 text-sm underline">Register here</p>
                    @endguest
                </form>
            </div>
            <!-- Modal body register -->
            <div class="relative hidden bg-white rounded-lg shadow" id="register">
                <form class="max-w-sm mx-auto p-8" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <input name="name" type="text" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name" required />
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input name="email" type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@email.com" required />
                    </div>
                    <div class="mb-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input name="password" type="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div class="mb-5">
                        <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900">Repeat password</label>
                        <input name="password_confirmation" type="password" id="repeat-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    </div>
                    <div class="flex items-start mb-5">
                        <div class="flex items-center h-5">
                        <input id="terms" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" required />
                        </div>
                        <label for="terms" class="ms-2 text-sm font-medium text-gray-900">I agree with the <a href="#" class="text-blue-600 hover:underline">terms and conditions</a></label>
                    </div>
                    <button  type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">submit</button>
                    <p id="login-button" class="float-right text-blue-700 mt-2 text-sm underline">Already registered?</p>
                    </form>
            </div>
        </div>
    </div>
    <!-- nav -->
    <nav class="bg-white border-gray-200 sticky top-0 z-40">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{route('home')}}" class="flex items-center space-x-3 rtl:space-x-reverse -mt-2">
                <img src="http://127.0.0.1:8000/images/ticket.png" class="h-12 w-12" alt="Flowbite Logo" />
                <span class="self-center text-3xl font-semibold whitespace-nowrap">TikBook</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white md:dark:bg-gray-900">
                <li class="my-auto">
                <a href="{{route('home')}}" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
                </li>
                <li class="my-auto">
                    <a href="{{route('tickets')}}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent">Tickets</a>
                </li>
                <li class="my-auto">
                    <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent">About</a>
                </li>
                <li class="my-auto">  
                    <button type="button" class="px-4 py-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <svg class="w-6 h-6 text-slate-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg>  
                    </button>
        
            
                </li>
                <li class="my-auto">
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal"  href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent">
                        <svg class="w-10 h-10 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#1d4ed8" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </li>
            </ul>
            </div>
        </div>
    </nav>