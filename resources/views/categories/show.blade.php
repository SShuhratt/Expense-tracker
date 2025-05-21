@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Category Details</h2>

        <div class="mb-4">
            <strong>Name:</strong> {{ $category->name }}<br>
            <strong>Type:</strong> {{ ucfirst($category->type) }}
        </div>

        @if ($category->type === 'income')
            <h4>Related Incomes</h4>
            <ul class="list-group mb-3">
                @forelse ($relatedIncomes as $income)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $income->name }}
                        <span class="badge bg-success">${{ number_format($income->amount, 2) }}</span>
                    </li>
                @empty
                    <li class="list-group-item">No incomes found.</li>
                @endforelse
            </ul>
        @elseif ($category->type === 'expense')
            <h4>Related Expenses</h4>
            <ul class="list-group mb-3">
                @forelse ($relatedExpenses as $expense)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $expense->name }}
                        <span class="badge bg-danger">${{ number_format($expense->amount, 2) }}</span>
                    </li>
                @empty
                    <li class="list-group-item">No expenses found.</li>
                @endforelse
            </ul>
        @endif

        <a href="{{ route('categories.index') }}" class="btn btn-secondary mt-3">← Back to Categories</a>
    </div>
@endsection

