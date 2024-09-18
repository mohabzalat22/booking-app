<?php

namespace App\Jobs;

use App\Notifications\TurnNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;
use App\Models\Ticket;
use App\Models\User;
use App\services\Paymob;
use Illuminate\Support\Facades\Auth;

class ReserveTicketJob implements ShouldQueue
{
    use Queueable;

    // public $timeout = 600;
    private $ticketData;
    private $paymob;
    private $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, Array $ticketData, Paymob $paymob)
    {
        $this->ticketData = $ticketData;
        $this->paymob = $paymob;
        $this->user = $user;
        // dump( $this->paymob->check());
    }

    /**
     * Execute the job.
     */
    public function handle() : void
    {
        // check if quantity still available
        $tickets_quantity = Ticket::with(['types.quantity'])->find($this->ticketData['ticket_id'])->types()->where('type', $this->ticketData['type'])->first()->quantity->quantity;
        if((int)$this->ticketData['number'] <= (int)$tickets_quantity){
            // redirect to payment here
            // PAYMENT CHECK HERE
            /////////EVENT PAY////////////
            $url = "https://accept.paymob.com/api/acceptance/iframes/804457?payment_token=" . $this->paymob->PAYMENT_TOKEN;
            $this->user->notify(new TurnNotification("YOU HAVE 10 MINUTES TO PAY.", $url, $this->ticketData));
            sleep(800); //wait 10 mins
            if($this->paymob->check()){
                Reservation::create($this->ticketData);
                // end
                Ticket::with(['types.quantity'])->find($this->ticketData['ticket_id'])->types()->where('type', $this->ticketData['type'])->first()->quantity->update(['quantity'=>(int)$tickets_quantity-1]);
            }
            else{
            }
        }
    }
}
