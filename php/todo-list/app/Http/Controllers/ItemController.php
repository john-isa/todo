<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function showAll()
    {
        return response()->json(Item::all());
    }

    public function create(Request $request)
    {
        $item = Item::create($request->all());

        return response()->json($item, 201);
    }

    public function update($id, Request $request)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());

        return response()->json($item, 200);
    }

    public function delete($id)
    {
        Item::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}