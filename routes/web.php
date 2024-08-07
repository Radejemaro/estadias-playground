<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cat_Controller;
use App\Http\Controllers\TabletController;
use App\Http\Controllers\YubiKeyController;
use App\Http\Controllers\PrintersController;
use App\Http\Controllers\ComputersController;
use App\Http\Controllers\SwitchesController;
use App\Http\Controllers\TCAController;
use App\Http\Controllers\UsersController;

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
Route::get('/switches/search', [SearchController::class, 'show']);
Route::get('/ab&tca_active_users/search', [SearchController::class, 'show']);

// Categorías
Route::resource('Categorias/Computers', Cat_Controller::class, ['names' => 'computers']);
Route::resource('Categorias/Tablets', Cat_Controller::class, ['names' => 'tablets']);
Route::resource('Categorias/Switches', Cat_Controller::class, ['names' => 'switches']);
Route::resource('Categorias/Printers', Cat_Controller::class, ['names' => 'printers']);
Route::resource('Categorias/Ab&TCA_Active_Users', Cat_Controller::class, ['names' => 'ab&tca_active_users']);

// CRUD
Route::resource('computers', ComputersController::class);
Route::resource('tablets', TabletController::class);
Route::resource('yubikeys', YubiKeyController::class);
Route::resource('printers', PrintersController::class);
Route::resource('tcausers', TCAController::class);
Route::resource('switches', SwitchesController::class);
Route::resource('users', UsersController::class);

// Users Login

Route::get('/login', [UsersController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [UsersController::class, 'register'])->name('register');
Route::post('/logout', [UsersController::class, 'logout'])->name('logout');

