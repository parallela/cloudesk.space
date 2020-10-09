<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'upload']);
});

