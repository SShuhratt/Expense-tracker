<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Category;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('incomes', IncomeController::class);
Route::resource('expenses', ExpenseController::class);
Route::resource('categories', CategoryController::class);

