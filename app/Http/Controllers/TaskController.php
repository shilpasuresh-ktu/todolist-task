<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks;
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'deadline' => 'nullable|date',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        $task = new Task($validatedData);
        $task->user_id = Auth::user()->id;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $categories = Category::all();
        return view('tasks.edit', compact('task' , 'categories'));
    }

    public function update(Request $request, Task $task)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'deadline' => 'nullable|date',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function markAsCompleted(Task $task)
    {
        $task->update(['completed' => true]);
        return redirect()->route('tasks.index')->with('success', 'Task marked as completed.');
    }
}
