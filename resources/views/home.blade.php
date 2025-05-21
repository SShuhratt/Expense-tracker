@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Dashboard</h2>

        <div class="mb-4 p-3 bg-light rounded shadow-sm">
            <h4>💰 Balance: ${{ number_format($balance, 2) }}</h4>
            <p>Total Income: ${{ number_format($totalIncome, 2) }}</p>
            <p>Total Expense: ${{ number_format($totalExpense, 2) }}</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4>Incomes</h4>
                <ul class="list-group mb-3">
                    @forelse ($incomes as $income)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('incomes.show', $income->id) }}" class="flex-grow-1 text-decoration-none text-dark">
                                {{ $income->name }}
                            </a>
                            <span class="badge bg-success me-3">${{ number_format($income->amount, 2) }}</span>
                            <a href="{{ route('incomes.show', $income->id) }}" class="btn btn-sm btn-info">View</a>
                        </li>
                    @empty
                        <li class="list-group-item">No incomes found.</li>
                    @endforelse
                </ul>
                <a href="{{ route('incomes.create') }}" class="btn btn-success">+ Add Income</a>
            </div>

            <div class="col-md-6">
                <h4>Expenses</h4>
                <ul class="list-group mb-3">
                    @forelse ($expenses as $expense)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('expenses.show', $expense->id) }}" class="flex-grow-1 text-decoration-none text-dark">
                                {{ $expense->name }}
                            </a>
                            <span class="badge bg-danger me-3">${{ number_format($expense->amount, 2) }}</span>
                            <a href="{{ route('expenses.show', $expense->id) }}" class="btn btn-sm btn-info">View</a>
                        </li>
                    @empty
                        <li class="list-group-item">No expenses found.</li>
                    @endforelse
                </ul>
                <a href="{{ route('expenses.create') }}" class="btn btn-danger">- Add Expense</a>
            </div>
        </div>
    </div>
@endsection
