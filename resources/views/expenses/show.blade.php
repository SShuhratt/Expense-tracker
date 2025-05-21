@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Expense Details</h2>
        <p><strong>Name:</strong> {{ $expense->name }}</p>
        <p><strong>Amount:</strong> ${{ $expense->amount }}</p>
        <p><strong>Date:</strong> {{ $expense->date }}</p>
        <p><strong>Category:</strong> {{ $expense->category->name ?? 'Uncategorized or Deleted' }}</p>
        <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
