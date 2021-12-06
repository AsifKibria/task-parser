<?php

use Task\CollectionParser\Http\Controllers\ParserController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('parser', [ParserController::class, 'index'])->name('parser');
    Route::post('parser', [ParserController::class, 'parse'])->name('parser.post');
});
