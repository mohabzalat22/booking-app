<?php

namespace App\Livewire;

use Livewire\Component;

class OrderComponent extends Component
{
    public $tickets = 1;
    public $price = 0;

    public function inc(){
        if($this->tickets < 10){
            $this->tickets +=1;
        }
    }
    public function dec(){
        if($this->tickets > 1){
            $this->tickets -=1;
        }
    }
    public function render()
    {
        return view('livewire.order-component',[
            'tickets' => $this->tickets
        ]);
    }
    public function mount($price)
    {
        $this->price = $price;
    }
}
