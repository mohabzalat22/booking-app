<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\TIcket;
use Illuminate\Support\Facades\Auth;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class ReservationController extends Controller
{
    public function index (){
        if(!Auth::check()){
            return;
        }
        $reservations = Reservation::where('user_id', Auth::user()->id)->get();
        foreach($reservations as $r){
            $writer = new PngWriter();
            $serial = $r->serial;
            $qrCode = QrCode::create($serial)
                ->setSize(300)
                ->setMargin(10);
    
            $result = $writer->write($qrCode);
            $filePath = 'public/qrcodes/'.$r->id.'.png';
            Storage::put($filePath, $result->getString());
        }

        return view('reservations',[
            'reservations' =>  $reservations,
        ]);
    }
}

