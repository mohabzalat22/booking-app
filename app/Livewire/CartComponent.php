<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;



class CartComponent extends Component
{
    public $id;
    public $type;
    public $number;
    public $price;
    public $success_message;
    public $danger_message;
    public $end_time;

    public function get_data_local_storage($data){
        $cart_ticket = json_decode($data, true);
        $this->id = $cart_ticket["id"];
        $this->type = $cart_ticket["type"];
        $this->number = $cart_ticket["number"];
        $this->end_time = $cart_ticket["date_time"];
        // ticket
        if(Ticket::with('types.price')->find($this->id)->types()->where('type', $this->type)->first()){
            $this->price = Ticket::with('types.price')->find($this->id)->types()->where('type', $this->type)->first()->price->price;
        }

    }

    public function hide_success_toast(){
        $this->success_message = null;
    }

    public function hide_danger_toast(){
        $this->danger_message = null;
    }

    public function make_reservation(){
        if(!Auth::check()){
            $this->success_message = null;
            $this->danger_message = 'PLease Authenticate First.';
            return;
        }
        $found_ticket_bool = Ticket::find($this->id)->exists();
        $found_ticket_type_bool = Ticket::with(['types.quantity'])->find($this->id)->types()->where('type', $this->type)->exists();
        $found_ticket_Quantity = Ticket::with(['types.quantity'])->find($this->id)->types()->where('type', $this->type)->with('price')->first()->quantity->quantity;

        if(!$found_ticket_bool || !$found_ticket_type_bool || !($found_ticket_Quantity >= $this->number)){  
            $this->success_message = null;
            $this->danger_message = 'Error occured during Adding to Reservation';
            return;
        }
        // payment then reserve
        $record = Reservation::create([
            'user_id' => auth()->user()->id,
            'ticket_id' => $this->id,
            'type' => $this->type,
            'number' => $this->number,
            'serial' => substr(hash('sha256', uniqid(rand(), true)), 0, 16),
        ]);
        if($record->exists()){
            $this->danger_message = null;
            $this->success_message = 'Successfully Added to Reservation.';

        } else{
            $this->success_message = null;
            $this->danger_message = 'Error occured during Adding to Reservation';
        }
    }

    public function render()
    {
        return view('livewire.cart-component',[
            'ticket' => Ticket::where('id', $this->id)->with(['venue','types'])->first(),
        ]);
    }
}
