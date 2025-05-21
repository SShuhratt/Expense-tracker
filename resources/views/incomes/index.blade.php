@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Incomes -
            @if ($filter === 'daily') Today
            @elseif ($filter === 'weekly') This Week
            @elseif ($filter === 'monthly') This Month
            @else All
            @endif
        </h2>

        <p><strong>Total Income: ${{ number_format($totalIncome, 2) }}</strong></p>

        <form method="GET" action="{{ route('incomes.index') }}" class="mb-3">
            <label for="filter">Filter:</label>
            <select name="filter" id="filter" onchange="this.form.submit()" class="form-select w-auto d-inline-block ms-2">
                <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>All</option>
                <option value="daily" {{ $filter === 'daily' ? 'selected' : '' }}>Daily</option>
                <option value="weekly" {{ $filter === 'weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="monthly" {{ $filter === 'monthly' ? 'selected' : '' }}>Monthly</option>
            </select>
        </form>

        @if($incomes->count())
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
                @foreach ($incomes as $income)
                    <tr>
                        <td>
                            <a href="{{ route('incomes.show', $income->id) }}">
                                {{ $income->name }}
                            </a>
                        </td>
                        <td>${{ number_format($income->amount, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($income->date)->format('Y-m-d') }}</td>
                        <td>{{ $income->category->name ?? 'Uncategorized or Deleted' }}</td>
                        <td>
                            <a href="{{ route('incomes.show', $income->id) }}" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No incomes found for this period.</p>
        @endif

        <a href="{{ route('incomes.create') }}" class="btn btn-primary mt-3">Add Income</a>
    </div>
@endsection
