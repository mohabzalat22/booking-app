<div class="flex flex-wrap justify-center p-10">
    @if($success_message)
        <div class="fixed top-30 right-0" wire:click="hide_success_toast">
            <livewire:toast-success-component message="{{$success_message}}">
        </div>
    @endif
    @if($danger_message)
        <div class="fixed top-30 right-0" wire:click="hide_danger_toast">
            <livewire:toast-danger-component message="{{$danger_message}}">
        </div>
    @endif
    {{-- 1 --}}
    @if($id)
        <div>
            <div class="flex justify-center">
                <livewire:toast-warning-component message="you have only 10 mins to pay.">
            </div>
            <div class="my-10 text-center">
                {{-- counter --}}
                <div id="countdown" class="font-mono text-3xl text-gray-700 bg-slate-200 py-2 rounded-full"></div>
            </div>
            <a  class="hover:scale-110 ease-in-out flex flex-wrap items-center w-full max-w-sm duration-100 m-2 bg-white border border-gray-200 rounded-lg shadow">
                <div class="relative"> 
                    <img class="hidden lg:block rounded-t-lg w-full" src="{{asset($ticket->image)}}" alt="">
                    <div class="absolute top-2 right-2 rounded-full w-10 h-10 bg-slate-800 text-white p-2 font-semibold flex justify-center items-center">X{{$number}}</div>
                </div>
                <div class="flex flex-wrap justify-between w-full">
                <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 text-center">minus assumenda</h5>
                    <div class="mb-2 text-xl bg-gray-800 text-white font-bold capitalize text-center rounded-full py-1">{{$type}}</div>
                    <div class="flex items-center my-2">
                        <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"></path>
                        </svg>                              
                        <p class="ms-4 text-sm text-gray-500 font-bold">{{Carbon\Carbon::parse($ticket->date_time)->format('d')}} {{Carbon\Carbon::parse($ticket->date_time)->format('F')}} onwards | {{Carbon\Carbon::parse($ticket->date_time)->format('Y')}}</p>
                    </div>
                    <div class="flex items-center my-2">
                        <svg class="w-6 h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z"></path>
                        </svg>                                                          
                        <p class="ms-4 text-sm text-gray-500 font-bold capitalize">{{$ticket->venue->city}} {{$ticket->venue->place}} {{$ticket->venue->country}}</p>
                    </div>
                </div>
                <div class="border-s flex items-center justify-between ms-auto">
                    <p class="font-bold text-dark-800 m-2 p-0 text-2xl">{{$price * $number}}$</p>
                </div>
                </div>
                <button wire:click="make_reservation" type="button" class="w-full text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium text-sm px-5 py-2.5 text-center">BUY</button>
            </a>
        </div>
    @else
        <div class="text-center py-20">
            <div class="flex flex-col items-center">
                <div class="text-3xl text-gray-800 font-bold my-8">EMPTY CART</div>
                <div class="bg-slate-200 rounded-full animate-pulse p-4">
                    <svg class="w-24 h-24 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                    </svg>
                </div>
            </div>
        </div>
          
    @endif
</div>
@livewireScripts 
<script>
    window.addEventListener('load', function() {
        const data = localStorage.getItem('ticket');
        if(data){
            @this.get_data_local_storage(data);
            // Example input date string in 'YYYY-MM-DD HH:MM:SS' format
            const inputDateString = JSON.parse(data).date_time;
    
            // Parse the ISO formatted date string into a Date object
            const targetDate = new Date(inputDateString);
    
            // Check if the input date is valid
            if (isNaN(targetDate.getTime())) {
                document.getElementById('countdown').innerHTML = 'Invalid date format';
            } else {
                // Update the countdown every 1 second
                const countdownInterval = setInterval(() => {
                    const now = new Date();
                    const timeRemaining = targetDate - now;
                    // console.log(targetDate,'---------' , now);
    
                    if (timeRemaining <= 0) {
                        localStorage.removeItem('ticket');
                         location.reload();
                        clearInterval(countdownInterval);
                        return;
                    }
    
                    // Calculate minutes and seconds
                    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
    
                    // Update the countdown display
                    document.getElementById('countdown').innerHTML =
                        `${minutes}:${seconds}`;
                }, 1000);
            }
        }
    });
</script>
