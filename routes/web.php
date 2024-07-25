<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Cat_Controller;
use App\Http\Controllers\TabletController;
use App\Http\Controllers\YubikeyController;
use App\Http\Controllers\SwitchesController;

use App\Http\Controllers\SearchController;
use App\Http\Controllers\SearchYubiController;
use App\Http\Controllers\SearchTabletController;
use App\Http\Controllers\SearchPrinterController;


// Página principal
Route::get('/', function () {
    return view('Loggin');
})->name('SEMRC-IT Data Automatization');

Route::get('Index', function () {
    return view('Index');
})->name('Index');

// Búsquedas
Route::get('/computers/search', [SearchController::class, 'show']);
Route::get('/search/yubi', [SearchYubiController::class, 'show'])->name('search.yubi');
Route::get('/search/tablets', [SearchTabletController::class, 'show'])->name('search.tablets');
Route::get('/switches/search', [SearchController::class, 'show']);
Route::get('/search/printers', [SearchPrinterController::class, 'searchPrinters']);
Route::get('/ab&tca_active_users/search', [SearchController::class, 'show']);

// Categorías
Route::resource('Categorias/Computers', Cat_Controller::class, ['names' => 'computers']);
Route::resource('Categorias/Tablets', Cat_Controller::class, ['names' => 'tablets']);
Route::resource('Categorias/YubiKeys', Cat_Controller::class, ['names' => 'yubikeys']);
Route::resource('Categorias/Switches', Cat_Controller::class, ['names' => 'switches']);
Route::resource('Categorias/Printers', Cat_Controller::class, ['names' => 'printers']);
Route::resource('Categorias/Ab&TCA_Active_Users', Cat_Controller::class, ['names' => 'ab&tca_active_users']);

// Tablets CRUD
Route::resource('tablets', TabletController::class);
Route::resource('computers', Cat_Controller::class);
Route::resource('yubikeys', YubikeyController::class);
