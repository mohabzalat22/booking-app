<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketDetailComponent extends Component
{
    public $id ;
    public $cart_type;
    public $cart_number;
    public $cart_total_price;
    public $show_modal = false;
    public $danger_message;
    public $success_message;

    protected $listeners = [
        'add_data_to_cart' => 'add_data_to_cart',
        'toast_danger' => 'toast_danger',
    ];
    
    public function toast_danger($message){
        $this->danger_message = $message;
        $this->success_message = null;

    }
    public function hide_toast_danger(){
        $this->danger_message = null;
    }
    public function hide_toast_success(){
        $this->success_message = null;
    }

    public function hide_modal(){
        $this->show_modal = false;
    }

    public function add_local_storage(){
        $this->success_message = 'Added to cart Successfully';
        $this->danger_message = null;
        $this->show_modal = false;
    }

    public function add_data_to_cart($id, $cart_type, $cart_number){
        $price = Ticket::with('types.price')->find($this->id)->types()->where('type', $cart_type)->first()->price->price;
        $this->cart_type = $cart_type;
        $this->cart_number = $cart_number;
        $this->cart_total_price = $price ;
        $this->show_modal = true;
    }

    public function render()
    {
        return view('livewire.ticket-detail-component',[
            'ticket' => Ticket::where('id', $this->id)->with(['venue','types'])->first(),
            'types' => Ticket::with('types.price')->find($this->id)->types()->get(),
            'id' => $this->id
        ]);
    }
    public function mount(Request $request){
        $this->id = $request->id;
    }
}
