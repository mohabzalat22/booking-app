<div>     
    <div class="bg-slate-200 rounded-lg">
        <ul class="flex justify-center font-bold">
            <li wire:click="change('profile')" class="text-xl hover:bg-slate-300 p-5">
                <a href="{{route('dashboard')}}">Profile</a>
            </li>
            <li wire:click="change('tickets')" class="text-xl hover:bg-slate-300 p-5">
                <a href="{{route('reservations')}}">Reservations</a>
            </li>
            <li wire:click="change('Notifications')" class="text-xl hover:bg-slate-300 p-5">
                <a href="{{route('notifications')}}">Notifications</a>
            </li>
        </ul>
    </div>
</div>