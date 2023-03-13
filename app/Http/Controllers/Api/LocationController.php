<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function index()
    {
        $locations = Location::all();
        return response()->json($locations);
    }

    public function create()
    {
        // This method is not used for an API
        // You can remove it if you want
    }

    public function store(Request $request)
    {
        $location = Location::create([
            'name' => $request->name,
        ]);
        $location->save();
        return response()->json($location, 200);
    }

    public function show($id)
    {
        $location = Location::find($id);
        return response()->json($location);
    }

    public function edit($id)
    {
        // This method is not used for an API
        // You can remove it if you want
    }

    public function update(Request $request, $id)
    {
        $location = Location::find($id);
        $location->name = $request->input('name');
        // Add other fields as needed
        $location->save();

        return response()->json($location);
    }

}
