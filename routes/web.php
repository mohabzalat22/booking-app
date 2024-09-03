<?php

use App\Http\Controllers\ProfileController;
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
        'tickets' => Ticket::orderBy('created_at','desc')->paginate(2)
    ]);
})->name('home');


Route::get('/tickets', function () {
    return view('tickets',[
        'tickets' => Ticket::paginate(2),
        'countries' => Ticket::pluck('country')->unique(),
        'cities' => Ticket::pluck('city')->unique(),
        'places' => Ticket::pluck('place')->unique(),
        'categories' => Ticket::pluck('category')->unique(),
        
    ]);
})->name('tickets');