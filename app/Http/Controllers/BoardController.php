<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{

    public function index()
    {
        return Board::where('creator_id', auth()->user()->id)->get();
    }

    public function store(Request $request)
    {
        return Board::create([
            'name' => $request->name,
            'creator_id' => auth()->user()->id,
        ]);
    }

    public function show($id)
    {
        return Board::find($id);
    }

    public function update(Request $request, $id)
    {
        $board = Board::find($id);
        $board->update($request->all());
        return $board;
    }

    public function destroy($id)
    {
        return Board::destroy($id);
    }
}
