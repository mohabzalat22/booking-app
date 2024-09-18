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
        <!-- Main container -->
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
            {{-- dynamic component --}}
            @include('layouts.dashboard-nav')
            {{-- profile --}}
            <div id="profile-info" class="p-10">
                {{-- profile information --}}
                <div class="w-full my-4 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <form class="space-y-6" action="{{route('profile.update')}}" method="POST">
                        @method('patch')
                        @csrf
                        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Profile Information</h5>
                        <p class="text-sm text-gray-500">
                            Update your account's profile information and email address.
                        </p>
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
                            <input type="text" name="name" id="name" value="{{Auth::user()->name}}" class="max-w-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name" />
                            @error('name')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" value="{{Auth::user()->email}}"  class="max-w-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" />
                            @error('email')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                    </form>
                </div>
                {{-- password --}}
                <div class="w-full my-4 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <form class="space-y-6" action="{{ route('password.update') }}" method="post">
                        @csrf
                        @method('put')
                        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Update Password</h5>
                        <p class="text-sm text-gray-500">
                            Ensure your account is using a long, random password to stay secure.
                        </p>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Password</label>
                            <input type="password" name="current_password" id="password" class="max-w-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="current password" />
                            @if($errors->updatePassword->has('current_password'))
                                <div class="text-sm text-red-500">{{ $errors->updatePassword->first('current_password') }}</div>
                            @endif
                        </div>
                        <div>
                            <label for="newpassword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                            <input type="password" name="password" id="newpassword" class="max-w-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="new password" />
                            @if($errors->updatePassword->has('password'))
                                <div class="text-sm text-red-500">{{ $errors->updatePassword->first('password') }}</div>
                            @endif
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="max-w-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="confirm password" />
                            @if($errors->updatePassword->has('password_confirmation'))
                                <div class="text-sm text-red-500">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                            @endif
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                    </form>
                </div>
                {{-- delete account --}}
                <div class="w-full my-4 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <form class="space-y-6" action="{{route('profile.destroy')}}" method="post">
                        @csrf
                        @method('delete')
                        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Delete Account</h5>
                        <p class="text-sm text-gray-500 max-w-lg">
                            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                        </p>
                        <input type="password" name="password" id="password_for_delete" class="max-w-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="password" />
                        <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Delete</button>
                    </form>
                    @if($errors->userDeletion->has('password'))
                        <div class="text-sm text-red-500">{{ $errors->userDeletion->first('password') }}</div>
                    @endif
                </div>
            </div>
        </div>
        @include('layouts.footer')
        @livewireScripts
    </body>
</html>