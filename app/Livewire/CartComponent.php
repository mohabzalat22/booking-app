<?php

namespace App\Livewire;

use App\Jobs\ReserveTicketJob;
use App\Models\USer;
use Livewire\Component;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\Paymob;


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
        $ticketData = [
            'user_id' => Auth::user()->id,
            'ticket_id' => $this->id,
            'type' => $this->type,
            'number' => $this->number,
            'serial' => substr(hash('sha256', uniqid(rand(), true)), 0, 16),
        ]; 
        // payment
        $reservation_price = Ticket::with(['types.quantity'])->find($this->id)->types()->where('type', $this->type)->with('price')->first()->price->price;
        $reservation_price *=100; //because payment is in cents
        $expiration = 600;
        $currency = "EGP";
        $items = [];
        // 
        $billing_data = [
            "apartment"=> "803",
            "email"=> "user@example.com",
            "floor"=> "42",
            "first_name"=> "John",
            "street"=> "123 St",
            "building"=> "123",
            "phone_number"=> "+20123456789",
            "shipping_method"=> "PKG",
            "postal_code"=> "01898",
            "city"=> "Cairo",
            "country"=> "EG",
            "last_name"=> "Doe",
            "state"=> "Cairo"
        ];        
        // payment
        $p = new Paymob(
            env("PAYMOB_API_KEY"),
            env("INTEGRATION_ID"),
            $expiration,
        );
        $p->get_auth_token();
        $p->order([env("INTEGRATION_ID")], (int)$reservation_price, $currency, $items);
        $p->get_payment_token($billing_data, (int)$reservation_price, $currency);
        $auth_user_id = Auth::user()->id;
        ReserveTicketJob::dispatch(User::find($auth_user_id), $ticketData, $p);
        
        return redirect()->route('notifications');
    }

    public function render()
    {
        return view('livewire.cart-component',[
            'ticket' => Ticket::where('id', $this->id)->with(['venue','types'])->first(),
        ]);
    }
}
