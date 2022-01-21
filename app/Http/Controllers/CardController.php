<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index(Request $request)
    {
        $cards = Card::where('column_id',$request->column_id)->get();
        return $cards;
    }

    public function store(Request $request)
    {
        $request->validate([
            'text'  => 'required',
            'column_id' => 'required'
        ]);
        return Card::create([$request->all()]);
    }

    public function show($id)
    {
        return Card::find($id);
    }

    public function update(Request $request, $id)
    {
        $card = Card::find($id);
        $card->update($request->all());
        return $card;
    }

    public function destroy($id)
    {
        return Card::destroy($id);
    }
}
