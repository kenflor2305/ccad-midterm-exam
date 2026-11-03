<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShelterAnimalController;
use App\Http\Controllers\AdoptionController;

Route::get('/', function () {
    return redirect('/shelter-animals');
});

Route::resource('shelter-animals', ShelterAnimalController::class)
    ->only(['index', 'create', 'store', 'update']);

Route::resource('adoptions', AdoptionController::class)
    ->only(['index', 'create', 'store', 'update']);