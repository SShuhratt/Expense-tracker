<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Category;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all'); // default filter

        $query = Expense::with('category');

        if ($filter === 'daily') {
            $query->whereDate('date', Carbon::today());
        } elseif ($filter === 'weekly') {
            $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter === 'monthly') {
            $query->whereMonth('date', Carbon::now()->month)
                ->whereYear('date', Carbon::now()->year);
        }

        $expenses = $query->latest()->get();

        $totalExpense = $expenses->sum('amount');

        return view('expenses.index', compact('expenses', 'filter', 'totalExpense'));
    }

    public function create()
    {
        $categories = Category::where('type', 'income')->get();
        return view('expenses.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category_name' => 'required|string|max:255',
        ]);

        $category = Category::firstOrCreate(['name' => $request->category_name,
            'type' => 'expense']);

        $expense = new Expense();
        $expense->name = $request->name;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $expense->category_id = $category->id;
        $expense->save();

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully.');
    }

    public function show(Expense $expense){
        $expense->load('category');
        return view('expenses.show', compact('expense'));
    }
}
