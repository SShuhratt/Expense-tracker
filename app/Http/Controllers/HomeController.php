<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $incomes = Income::latest()->get();
        $expenses = Expense::latest()->get();

        $totalIncome = $incomes->sum('amount');
        $totalExpense = $expenses->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('home', compact('incomes', 'expenses', 'balance', 'totalIncome', 'totalExpense'));
    }
}
