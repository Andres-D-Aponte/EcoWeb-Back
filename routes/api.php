<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculateController;

Route::post('/calculate', [CalculateController::class, 'calculate']);