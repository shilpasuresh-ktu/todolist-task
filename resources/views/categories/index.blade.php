@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Categories') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create New Category</a>

                        <ul class="list-group">
                            @forelse ($categories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $category->name }}</span>
                                    <div>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">No categories found.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection