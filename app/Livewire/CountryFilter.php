<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Venue;

class CountryFilter extends Component
{
    public function update($e){
        $this->dispatch('add', $e, 'countries');
        $this->dispatch('add_country', $e);
    }

    public function render()
    {
        return view('livewire.country-filter', [
            'countries' => Venue::pluck('country')->unique()
        ]);
    }
}
