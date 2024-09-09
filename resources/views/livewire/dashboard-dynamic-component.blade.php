<div>     
    <div class="bg-slate-200 rounded-lg">
        <ul class="flex justify-center font-bold">
            <li wire:click="change('profile')" class="text-xl hover:bg-slate-300 p-5">Profile</li>
            <li wire:click="change('tickets')" class="text-xl hover:bg-slate-300 p-5">Tickets</li>
            <li wire:click="change('wallets')" class="text-xl hover:bg-slate-300 p-5">Wallets</li>
        </ul>
    </div>
    {{-- profile --}}
    @switch($component)
        @case('profile')
            <div class="p-10">
                {{-- profile information --}}
                <div class="w-full my-4 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <form x-on:submit.prevent class="space-y-6" action="{{route('profile.update')}}" method="POST">
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
                    <form wire.submit.prevent class="space-y-6" action="{{route('profile.destroy')}}" method="post">
                        @csrf
                        @method('delete')
                        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Delete Account</h5>
                        <p class="text-sm text-gray-500 max-w-lg">
                            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                        </p>
                        <input type="password" name="password" id="password_for_delete" class="max-w-lg bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="password" />
                        <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Delete</button>
                    </form>
                </div>
            </div>
            @break

        @case('tickets')
            <div class="flex flex-wrap justify-center p-10">
                {{-- 1 --}}
                <a data-modal-target="qr-modal" data-modal-toggle="qr-modal" class="hover:scale-110 ease-in-out flex flex-wrap items-center w-full max-w-sm duration-100 m-2 bg-white border border-gray-200 rounded-lg shadow">
                    <div class="relative"> 
                        <img class="hidden lg:block rounded-t-lg w-full" src="http://127.0.0.1:8000/images/2.png" alt="">
                        <div class="absolute top-2 right-2 rounded-full w-10 h-10 bg-slate-800 text-white p-2 font-semibold flex justify-center items-center">X5</div>
                    </div>
                    <div class="flex flex-wrap justify-between w-full">
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">minus assumenda</h5>
                        <div class="flex items-center my-2">
                            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"></path>
                            </svg>                              
                            <p class="ms-4 text-sm text-gray-500 font-bold">30 September onwards | 1978</p>
                        </div>
                        <div class="flex items-center my-2">
                            <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z"></path>
                            </svg>                                                          
                            <p class="ms-4 text-sm text-gray-500 font-bold capitalize">Fadelchester facere South Dakota</p>
                        </div>
                    </div>
                    <div class="border-s flex items-center justify-between ms-auto">
                        <p class="font-bold text-dark-800 m-2 p-0 text-2xl">200$</p>
                    </div>
                    </div>
                </a>
            </div>
        @break
    @endswitch
</div>