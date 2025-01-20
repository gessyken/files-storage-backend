<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KenFileController;

Route::apiResource('files', KenFileController::class);
