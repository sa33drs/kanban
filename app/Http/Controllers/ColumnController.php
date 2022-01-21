<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;

class ColumnController extends Controller
{

    public function index(Request $request,$board_id)
    {
        $columns = Column::where('board_id','=',$board_id)->get();
        return $columns;
    }

    public function store(Request $request)
    {

        return Column::create([
            'name'  => $request->name,
            'position'  => $request->position,
            'board_id'  => $request->board_id
        ]);
    }

    public function show($id)
    {
        return Column::find($id);
    }

    public function update(Request $request, $id)
    {
        $column = Column::find($id);
        $column->update($request->all());
        return $column;
    }

    public function destroy($id)
    {
        return Column::destroy($id);
    }
}
