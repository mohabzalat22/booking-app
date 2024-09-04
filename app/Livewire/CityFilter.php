<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;

class CityFilter extends Component
{
    public function update($e){
        $this->dispatch('add', $e, 'cities');;
        $this->dispatch('add_city', $e);
    }
    
    public function render()
    {
        return view('livewire.city-filter', [
            'cities' => Ticket::pluck('city')->unique()
        ]);
    }
}
