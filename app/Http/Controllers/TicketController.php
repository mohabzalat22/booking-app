<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index(Request $request){
        return view('ticketDetails', [
            'ticket' => Ticket::find($request->id)
        ]);
    }
}
