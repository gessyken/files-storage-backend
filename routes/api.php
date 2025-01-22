<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KenFileController;

Route::view('/', 'welcome');
Route::apiResource('files', KenFileController::class);
