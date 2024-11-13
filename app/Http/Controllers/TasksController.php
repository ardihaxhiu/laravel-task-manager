<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function create()
    {
        return view('templates.tasks.create');
    }

    public function store(StoreUpdateTaskRequest $request)
    {
        auth()->user()->tasks()->create($request->validated());
        return redirect()->route('home');
    }

    public function edit(Task $task)
    {
        return view('templates.tasks.create', [
            'item' => $task
        ]);
    }

    public function update(Task $task, StoreUpdateTaskRequest $request)
    {
        $task->update($request->validated());

        return redirect()->route('home');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->back();
    }
}
