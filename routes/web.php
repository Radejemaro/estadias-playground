<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Loggin');
})->name('SEMRC-IT Data Automatization');

Route::get('Index', function () {
    return view('Index');
})->name('Index');

Route::resource('computers', Cat_Controller::class);

Route::get('Categorias/Computers', [Cat_Controller::class, 'index'])->name('Computers');
