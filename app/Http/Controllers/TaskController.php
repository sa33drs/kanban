<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskField;
use App\Models\TaskMetaData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            'pillar_id' => $request->pillar_id,
            'color' => $request->color,
        ]);
    }

    public function show(Task $task)
    {
        $board_id = $task->pillar->board_id;
        $fields = TaskField::query()->where('board_id' , $board_id)->with(['metaData'=>function($query)use ($task){
            $query->where('task_id',$task->id);
        }])->get();
        return response()->json([
            'task' => $task ,
            'fields' => $fields
        ]);
    }

    public function update(Request $request, Task $task)
    {
        if ($request->pillar_id != -1){
            $task->pillar_id = $request->pillar_id;
            $task->save();
            return;
        }
        Log::debug($request->all());
        $task->title = $request->title;
        $task->description = $request->description;
        $task->color = $request->color;
        $task->save();
        $task->fields()->detach();
        if ($request->has('fields')){
            foreach($request->fields as $field){
                if (empty($field['meta_data'][0]['value'])){
                    continue;
                }
                TaskMetaData::create([
                    'task_field_id' => $field['id'],
                    'task_id'  => $task->id,
                    'value'  => $field['meta_data'][0]['value']
                ]);
            }
        }
        return $task;
    }

    public function destroy(Task $task)
    {
        return $task->delete();
    }
}
