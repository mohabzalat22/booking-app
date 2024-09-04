<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;

class CountryFilter extends Component
{
    public function update($e){
        $this->dispatch('add', $e, 'countries');
        $this->dispatch('add_country', $e);
    }

    public function render()
    {
        return view('livewire.country-filter', [
            'countries' => Ticket::pluck('country')->unique()
        ]);
    }
}
