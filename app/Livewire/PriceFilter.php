<?php

namespace App\Livewire;

use Livewire\Component;

class PriceFilter extends Component
{
    public $price = 0;

    public function render()
    {
        if($this->price !=0) $this->dispatch('add_price', $this->price);;
        return view('livewire.price-filter');
    }
}
