<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cat_Controller;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('Loggin');
})->name('SEMRC-IT Data Automatization');

Route::get('Index', function () {
    return view('Index');
})->name('Index');

//Index
Route::get('/computers/search', [SearchController::class, 'show']);

// Index
Route::get('Categorias/Computers', [Cat_Controller::class, 'index'])->name('computers.index');
Route::get('Categorias/Tablets', [Cat_Controller::class, 'index'])->name('tablets.index');

// Show
Route::get('Categorias/Computers/{id}', [Cat_Controller::class, 'show'])->name('computers.show');
Route::get('Categorias/Tablets/{id}', [Cat_Controller::class, 'show'])->name('tablets.show');

// Edit and Delete
Route::delete('/computers/delete/{id}', [Cat_Controller::class, 'destroy'])->name('computers.destroy');
Route::get('/computers/edit/{id}', [Cat_Controller::class, 'edit'])->name('computers.edit');
Route::post('/computers/update/{id}', [Cat_Controller::class, 'update'])->name('computers.update');
