<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Employee;

class TaskController extends Controller
{
    public function index() {

        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function create() {

        $employees = Employee::all();

        return view('tasks.create', compact('employees'));
    }

    public function store(Request $request) {

        // CEK VALIDASI TERLEBIH DAHULU
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|string',
        ]);

        // JIKA BERHASIL
        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
    
    public function edit(Task $task) {
        $employees =  Employee::all();

        return view('tasks.edit', compact('task', 'employees'));
    }

    
    public function update(Request $request, Task $task) {

        // CEK VALIDASI TERLEBIH DAHULU
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|string',
        ]);

        // JIKA BERHASIL validasi maka update data
        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
}
