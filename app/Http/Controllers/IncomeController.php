<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all'); // default monthly

        $query = Income::query();

        if ($filter === 'daily') {
            $query->whereDate('date', Carbon::today());
        } elseif ($filter === 'weekly') {
            $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter === 'monthly') {
            $query->whereMonth('date', Carbon::now()->month)
                ->whereYear('date', Carbon::now()->year);
        }

        $incomes = $query->get();

        $totalIncome = $incomes->sum('amount');

        return view('incomes.index', compact('incomes', 'filter', 'totalIncome'));
    }

    public function create()
    {
        $categories = Category::where('type', 'income')->get();
        return view('incomes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category_name' => 'required|string|max:255',
        ]);

        $category = Category::firstOrCreate(
            ['name' => $request->category_name],
            ['type' => 'income']  // or 'expense', depending on context
        );

        $income = new Income();
        $income->name = $request->name;
        $income->amount = $request->amount;
        $income->date = $request->date;
        $income->category_id = $category->id;
        $income->save();

        return redirect()->route('incomes.index')->with('success', 'Income added successfully.');
    }

    public function show(Income $income)
    {
        $income->load('category');
        return view('incomes.show', compact('income'));
    }
}
