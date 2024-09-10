<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Venue;

class PlaceFilter extends Component
{
    public function update($e){
        $this->dispatch('add', $e, 'places');
        $this->dispatch('add_place', $e);
    }
    
    public function render()
    {
        return view('livewire.place-filter', [
            'places' => Venue::pluck('place')->unique()
        ]);
    }
}
