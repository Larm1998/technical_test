<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return response()->json(Item::get());
    }

    public function store(Request $request)
    {
        Item::create([
            'name'          => $request->input('name'),
            'category_id'   => $request->input('category'),
            'location_id'   => $request->input('location'),
            'price'         => $request->input('price'),
        ]);
    }

    public function update($id, Request $request){
        $item = Item::find($id);
        $item->update($request->all());
        return response()->json('Item Updated!');
    }   

    public function destroy(Item $item)
    {
        $item->delete();
    }
}
