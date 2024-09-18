<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TicketController;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use App\Models\Ticket;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/', function () {
    return view('welcome',[
        'tickets' => Ticket::orderBy('created_at','desc')->with(['venue','types'])->paginate(9)
    ]);
})->name('home');


Route::get('/tickets', function () {
    return view('tickets');
})->name('tickets');

Route::get('/ticket/{id}', [TicketController::class, 'index'])->name('ticket.index');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::middleware('auth')->group(function(){
    Route::get('/reservations',[ReservationController::class, 'index'])->name('reservations');
    Route::get('/notifications',[NotificationController::class, 'index'])->name('notifications');
});
