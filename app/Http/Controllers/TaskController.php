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
        return Task::create([
            'title' => $request->title,
            'description'  => $request->description,
            'order' => $request->order,
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
