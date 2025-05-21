<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Expense;
use Illuminate\Http\Request;

class HomeApiController extends Controller
{
    public function index(Request $request)
    {
        $incomes = Income::with('category')->latest()->get();
        $expenses = Expense::with('category')->latest()->get();

        $totalIncome = $incomes->sum('amount');
        $totalExpense = $expenses->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return response()->json([
            'success' => true,
            'data' => [
                'total_income' => $totalIncome,
                'total_expense' => $totalExpense,
                'balance' => $balance,
                'incomes' => $incomes,
                'expenses' => $expenses,
            ]
        ]);
    }
}
