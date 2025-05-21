<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeApiController extends Controller
{
    public function index()
    {
        $incomes = Income::with('category')->latest()->get();
        return response()->json($incomes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $income = Income::create($validated);
        return response()->json($income, 201);
    }

    public function show(Income $income)
    {
        $income->load('category');
        return response()->json($income);
    }

    public function update(Request $request, Income $income)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'amount' => 'sometimes|required|numeric',
            'date' => 'sometimes|required|date',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $income->update($validated);
        return response()->json($income);
    }

    public function destroy(Income $income)
    {
        $income->delete();
        return response()->json(null, 204);
    }
}
