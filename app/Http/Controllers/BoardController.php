<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\TaskField;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BoardController extends Controller
{

    public function index()
    {
        return Board::select('id','title','description')->where('creator_id', auth()->user()->id)->get();
    }

    public function store(Request $request)
    {
        Log::info($request->all());
        $board =  Board::create([
            'title' => $request->title,
            'description' => $request->description,
            'creator_id' => auth()->user()->id,
        ]);
        foreach($request->task_fields as $task_field){
            TaskField::create([
                'title' => $task_field['title'],
                'type'  => $task_field['type'],
                'board_id'  => $board->id
            ]);
        }
        return response([
            'board_id' => $board->id,
            'message'   => 'create successfully'
        ],200);
    }

    public function show($id)
    {
        return Board::find($id);
    }

    public function update(Request $request, Board $board)
    {
        $board->update($request->all());
        return $board;
    }

    public function destroy(Board $board)
    {
        return $board->delete();
    }

    public function assign_user(Board $board, string $user){
        $user = User::where('email',$user)->firstOrFail();
        $user->where('username',$user)->firstOrFail();
        if (!empty($user) && $user->exists()){
            $board->users()->attach($user);
        }
    }

    public function users(Board $board){

    }
}
