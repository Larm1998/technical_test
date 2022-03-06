<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Report;
use App\Model\Location;
use App\Model\Item;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $reports = DB::table('items')
                      ->join('locations', 'items.location_id', '=', 'locations.id')
                      ->join('categories', 'items.category_id', '=', 'categories.id')
                      ->select('locations.name as Location', 'categories.name as Category', DB::raw('count(1)'))
                      ->groupBy('locations.id', 'categories.id')
                      ->orderBy('locations.name')
                      ->get();
        return $reports;
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
