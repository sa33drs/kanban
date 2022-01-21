<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Illuminate\Http\Request;

class ColumnController extends Controller
{

    public function index()
    {
        return Column::all();
    }

    public function store(Request $request)
    {
        return Column::create([
            'name'  => $request->name,
            'position'  => $request->position,
        ]);
    }

    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
