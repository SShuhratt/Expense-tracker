<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ExpenseApiController;
use App\Http\Controllers\Api\V1\IncomeApiController;
use App\Http\Controllers\Api\V1\CategoryApiController;
use App\Http\Controllers\Api\V1\HomeApiController;

Route::prefix('v1')->group(function () {

    Route::apiResource('incomes', IncomeApiController::class);
    Route::apiResource('expenses', ExpenseApiController::class);
    Route::apiResource('categories', CategoryApiController::class);
    Route::get('home', [HomeApiController::class, 'index']);
});

