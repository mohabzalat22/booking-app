<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Ticket;

class OrderComponent extends Component
{
    public $tickets = 1;
    public $selected_type = '';
    public $id;
    public $price = 0;

    public function change_type($e){
        $this->selected_type = $e;
    }
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
            'tickets' => $this->tickets,
            'types' => Ticket::find($this->id)->types->pluck('type')->unique(),
            'selected_type' => $this->selected_type,
        ]);
    }
    public function mount(Request $request)
    {
        $this->id = $request->id;
    }
}
