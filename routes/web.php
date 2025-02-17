<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\DesignController::class, 'index']);
Route::get('/templates/{path}/preview.html', [\App\Http\Controllers\DesignController::class, 'preview']);
Route::get('/preview-with-builder/{path}', [\App\Http\Controllers\DesignController::class, 'previewWithBuilder']);