@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Income Details</h2>
        <p><strong>Name:</strong> {{ $income->name }}</p>
        <p><strong>Amount:</strong> ${{ $income->amount }}</p>
        <p><strong>Date:</strong> {{ $income->date }}</p>
        <p><strong>Category:</strong> {{ $income->category->name ?? 'Uncategorized or Deleted' }}</p>
        <a href="{{ route('incomes.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
