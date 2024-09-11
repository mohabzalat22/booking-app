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
    public $type_danger;

    public function show_cart(){ //modal
        if($this->id != null && $this->selected_type != null)$this->dispatch('add_data_to_cart', $this->id ,$this->selected_type, $this->tickets);
        if( $this->selected_type == '')
        {
            $this->type_danger = true;
            $this->dispatch('toast_danger','Please select type first');
        }
        else{
            $this->type_danger = false;
        }
    }

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
