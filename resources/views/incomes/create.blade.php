@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Income</h2>

        <form action="{{ route('incomes.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Amount</label>
                <input type="number" step="0.01" name="amount" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="category_name">Category</label>
                <input list="category_list" name="category_name" id="category_name" class="form-control" placeholder="Type or select a category" required>
                <datalist id="category_list">
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">
                    @endforeach
                </datalist>
            </div>

            <button type="submit" class="btn btn-success">Add Income</button>
        </form>
    </div>
@endsection
