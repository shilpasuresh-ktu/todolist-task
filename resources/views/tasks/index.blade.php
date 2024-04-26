@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('My Tasks') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create New Task</a>

                        <ul class="list-group">
                            @forelse ($tasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5>{{ $task->title }}</h5>
                                        <p>{{ $task->description }}</p>
                                        <p>
                                            Categories:
                                            @foreach($task->categories as $category)
                                                <span class="badge badge-primary">{{ $category->name }}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                    <div>
                                        @if (!$task->completed)
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('tasks.mark-completed', $task->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">Mark as Completed</button>
                                            </form>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @else
                                            <span class="badge badge-success">Completed</span>
                                        @endif
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item">No tasks found.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection