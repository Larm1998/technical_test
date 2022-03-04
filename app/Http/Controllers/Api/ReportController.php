<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $blog = DB::table(DB::raw('categories, locations, items')) 
            ->select(DB::raw('locations.name Location, categories.name Category, count(1)'))
            ->where(DB::raw('items.location_id = locations.id'))
            ->where(DB::raw('items.category_id = categories.id'))
            ->groupBy('items.id', 'categories.id', 'locations.name')
            ->orderBy('locations.name')->get();
        // $blogs = DB::select('CALL sp_report()');
        echo "<pre>";
        print_r($blog);
        // // return response()->json(Item::get());
        // return $blogs;
        return $blog;
    }

    public function store(Request $request)
    {

    }

    public function update($id, Request $request){

    }   

    public function destroy(Item $item)
    {

    }
}
