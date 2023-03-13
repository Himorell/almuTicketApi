<?php

namespace App\Http\Controllers\Api;

use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = State::all();
        return response()->json($states,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $state = State::create([
            'name' => $request->name,
        ]);
        $state->save();
        return response()->json($state, 200);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $state = State::find($id);
        $state->update([
            'name' => $request->name,
        ]);
        $state->save();
        return response()->json($state, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $state = State::find($id);
        
        if (!$state) {
            return response()->json(['error' => 'State not found'], 404);
        }
        
        $state->delete();
        return response()->json(['message' => 'State deleted successfully']);
        }
}
