<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cat_Controller;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SearchYubiController;
use App\Http\Controllers\SearchTabletController;

Route::get('/', function () {
    return view('Loggin');
})->name('SEMRC-IT Data Automatization');

Route::get('Index', function () {
    return view('Index');
})->name('Index');

// Search
Route::get('/computers/search', [SearchController::class, 'show']);
Route::get('/search/yubi', [SearchYubiController::class, 'show'])->name('search.yubi');
Route::get('search/tablets', [SearchTabletController::class, 'show'])->name('search.tablets');
Route::get('/switches/search', [SearchController::class, 'show']);
Route::get('/printers/search', [SearchController::class, 'show']);
Route::get('/ab&tca_active_users/search', [SearchController::class, 'show']);


// Index
Route::get('Categorias/Computers', [Cat_Controller::class, 'index'])->name('computers.index');
Route::get('Categorias/Tablets', [Cat_Controller::class, 'index'])->name('tablets.index');
Route::get('Categorias/YubiKeys', [Cat_Controller::class, 'index'])->name('yubikeys.index');
Route::get('Categorias/Switches', [Cat_Controller::class, 'index'])->name('switches.index');
Route::get('Categorias/Printers', [Cat_Controller::class, 'index'])->name('printers.index');
Route::get('Categorias/Ab&TCA_Active_Users', [Cat_Controller::class, 'index'])->name('ab&tca_active_users.index');

// Show
Route::get('Categorias/Computers/{id}', [Cat_Controller::class, 'show'])->name('computers.show');
Route::get('Categorias/Tablets/{id}', [Cat_Controller::class, 'show'])->name('tablets.show');
Route::get('Categorias/YubiKeys/{id}', [Cat_Controller::class, 'show'])->name('yubikeys.show');
Route::get('Categorias/Switches/{id}', [Cat_Controller::class, 'show'])->name('switches.show');
Route::get('Categorias/Printers/{id}', [Cat_Controller::class, 'show'])->name('printers.show');
Route::get('Categorias/Ab&TCA_Active_Users/{id}', [Cat_Controller::class, 'show'])->name('ab&tca_active_users.show');

// Edit
Route::get('/computers/edit/{id}', [Cat_Controller::class, 'edit'])->name('computers.edit');
Route::get('/tablets/edit/{id}', [Cat_Controller::class, 'edit'])->name('tablets.edit');
Route::get('/yubikeys/edit/{id}', [Cat_Controller::class, 'edit'])->name('yubikeys.edit');
Route::get('/switches/edit/{id}', [Cat_Controller::class, 'edit'])->name('switches.edit');
Route::get('/printers/edit/{id}', [Cat_Controller::class, 'edit'])->name('printers.edit');
Route::get('/ab&tca_active_users/edit/{id}', [Cat_Controller::class, 'edit'])->name('ab&tca_active_users.edit');

// Update (PUT)
Route::post('/computers/update/{id}', [Cat_Controller::class, 'update'])->name('computers.update');
Route::post('/tablets/update/{id}', [Cat_Controller::class, 'update'])->name('tablets.update');
Route::post('/yubikeys/update/{id}', [Cat_Controller::class, 'update'])->name('yubikeys.update');
Route::post('/switches/update/{id}', [Cat_Controller::class, 'update'])->name('switches.update');
Route::post('/printers/update/{id}', [Cat_Controller::class, 'update'])->name('printers.update');
Route::post('/ab&tca_active_users/update/{id}', [Cat_Controller::class, 'update'])->name('ab&tca_active_users.update');

// Delete
Route::delete('/computers/delete/{id}', [Cat_Controller::class, 'destroy'])->name('computers.destroy');
Route::delete('/tablets/delete/{id}', [Cat_Controller::class, 'destroy'])->name('tablets.destroy');
Route::delete('/yubikeys/delete/{id}', [Cat_Controller::class, 'destroy'])->name('yubikeys.destroy');
Route::delete('/switches/delete/{id}', [Cat_Controller::class, 'destroy'])->name('switches.destroy');
Route::delete('/printers/delete/{id}', [Cat_Controller::class, 'destroy'])->name('printers.destroy');
Route::delete('/ab&tca_active_users/delete/{id}', [Cat_Controller::class, 'destroy'])->name('ab&tca_active_users.destroy');

// Create
Route::get('/jupiter/create', function(){
    return view('Categorias.Agregar');
})->name('jupiter.create');
Route::get('/tablets/create', [Cat_Controller::class, 'create'])->name('tablets.create');

// Store (POST)
Route::post('/jupiter/store', [Cat_Controller::class, 'store'])->name('jupiter.store');
