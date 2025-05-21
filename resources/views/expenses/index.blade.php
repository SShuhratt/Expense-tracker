@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Expenses -
            @if ($filter === 'daily') Today
            @elseif ($filter === 'weekly') This Week
            @elseif ($filter === 'monthly') This Month
            @else All
            @endif
        </h2>

        <p><strong>Total Expense: ${{ number_format($totalExpense, 2) }}</strong></p>

        <form method="GET" action="{{ route('expenses.index') }}" class="mb-3">
            <label for="filter">Filter:</label>
            <select name="filter" id="filter" onchange="this.form.submit()" class="form-select w-auto d-inline-block ms-2">
                <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>All</option>
                <option value="daily" {{ $filter === 'daily' ? 'selected' : '' }}>Daily</option>
                <option value="weekly" {{ $filter === 'weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="monthly" {{ $filter === 'monthly' ? 'selected' : '' }}>Monthly</option>
            </select>
        </form>

        @if($expenses->count())
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($expenses as $expense)
                    <tr>
                        <td>
                            <a href="{{ route('expenses.show', $expense->id) }}">
                                {{ $expense->name }}
                            </a>
                        </td>
                        <td>${{ number_format($expense->amount, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}</td>
                        <td>{{ $expense->category->name ?? 'Uncategorized or Deleted' }}</td>
                        <td>
                            <a href="{{ route('expenses.show', $expense->id) }}" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No expenses found for this period.</p>
        @endif

        <a href="{{ route('expenses.create') }}" class="btn btn-primary mt-3">Add Expense</a>
    </div>
@endsection
