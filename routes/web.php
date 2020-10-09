<?php

use Illuminate\Support\Facades\Route;

Route::any('/{any}', [\App\Http\Controllers\IndexController::class, 'page'])->where('any', '.*');

