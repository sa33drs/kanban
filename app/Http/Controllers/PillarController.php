<?php

namespace App\Http\Controllers;

use App\Models\Pillar;
use Illuminate\Http\Request;

class PillarController extends Controller
{

    public function index($board_id)
    {
        $pillars = Pillar::where('board_id','=',$board_id)->with('cards')->get();
        return $pillars;
    }

    public function store(Request $request)
    {
        return Pillar::create([
            'title'  => $request->title,
            'description'  => $request->description,
            'order'  => $request->order,
            'color' => $request->color,
            'board_id'  => $request->board_id
        ]);
    }

    public function show(Pillar $pillar)
    {
        return $pillar;
    }

    public function update(Request $request, Pillar $pillar)
    {
        $pillar->title = $request->title;
        $pillar->description = $request->description;
        $pillar->color = $request->color;
        $pillar->save();
        return $pillar;
    }

    public function destroy(Pillar $pillar)
    {
        return $pillar->delete();
    }
}
