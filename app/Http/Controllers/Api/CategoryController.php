<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::get());
    }

    public function store(Request $request)
    {
        Category::create(['name' => $request->input('name')]);
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        $category->update($request->all());
        return response()->json('Category Updated!');
    }   

    public function destroy(Category $category)
    {
        $category->delete();
    }
}