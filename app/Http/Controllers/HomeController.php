<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;

class HomeController extends Controller
{
    public function index()
    {
        $incomes = Income::latest()->get();
        $expenses = Expense::latest()->get();

        $totalIncome = $incomes->sum('amount');
        $totalExpense = $expenses->sum('amount');

        $realBalance = $totalIncome - $totalExpense;
        $balance = $realBalance >= 0 ? $realBalance : 0;

        return view('home', compact('incomes', 'expenses', 'balance', 'realBalance', 'totalIncome', 'totalExpense'));
    }
}
