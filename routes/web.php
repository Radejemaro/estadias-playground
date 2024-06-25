<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Loggin');
})->name('SEMRC-IT Data Automatization');

Route::get('Index', function () {
    return view('Index');
})->name('Index');

Route::get('Computers', function () {
    return view('Computers');
})->name('Computers');
