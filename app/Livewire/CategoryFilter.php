<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;

class CategoryFilter extends Component
{
    public function update($e){
        $this->dispatch('add', $e , 'categories');
        $this->dispatch('add_category', $e);
    }
    
    public function render()
    {
        return view('livewire.category-filter', [
            'categories' => Ticket::pluck('category')->unique()
        ]);
    }
}
