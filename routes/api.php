<?php

use App\Http\Controllers\AverageController;
use App\Http\Controllers\SubmitController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])
    ->get('/average-length', AverageController::class);

Route::post('submit', SubmitController::class);
