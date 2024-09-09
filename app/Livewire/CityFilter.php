<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Venue;

class CityFilter extends Component
{
    public function update($e){
        $this->dispatch('add', $e, 'cities');;
        $this->dispatch('add_city', $e);
    }
    
    public function render()
    {
        return view('livewire.city-filter', [
            'cities' => Venue::pluck('city')->unique()
        ]);
    }
}
