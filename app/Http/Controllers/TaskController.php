<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::where('column_id',$request->column_id)->get();
        return $tasks;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required',
            'pillar_id' => 'required'
        ]);
        return Task::create([
            'title' => $request->title,
            'pillar_id' => $request->pillar_id
        ]);
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());
        return $task;
    }

    public function destroy(Task $task)
    {
        return $task->delete();
    }
}
