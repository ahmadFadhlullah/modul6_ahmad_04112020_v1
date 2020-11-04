<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view("index");
});
Route::post('/tampil','Proses@form');