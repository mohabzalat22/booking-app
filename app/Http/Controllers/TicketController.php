<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index(Request $request){
        return view('ticketDetails', [
            'ticket' => Ticket::where('id', $request->id)->with(['venue','types'])->first(),
            'types' => Ticket::with('types.price')->find($request->id)->types()->get()
        ]);
    }
}
