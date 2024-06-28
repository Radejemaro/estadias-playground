<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cat_Controller;

Route::get('/', function () {
    return view('Loggin');
})->name('SEMRC-IT Data Automatization');

Route::get('Index', function () {
    return view('Index');
})->name('Index');

// Index
Route::get('Categorias/Computers', [Cat_Controller::class, 'index'])->name('computers.index');

// Show
Route::get('Categorias/Computers/{id}', [Cat_Controller::class, 'show'])->name('computers.show');
