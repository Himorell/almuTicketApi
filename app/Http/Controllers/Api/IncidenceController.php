<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use App\Models\User;
use App\Models\State;
use App\Models\Category;
use App\Models\Location;
use App\Models\Incidence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class incidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incidences = Incidence::all();
        return response()->json($incidences);//revisar si incluir status 200
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $incidence = new Incidence();
        $users = User::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $states = State::pluck('name', 'id');
        $locations = Location::pluck('name', 'id');
        $areas = Area::pluck('name', 'id');

        return response()->json([
            'incidence' => $incidence,
            'users' => $users,
            'categories' => $categories,
            'states' => $states,
            'locations' => $locations,
            'areas' => $areas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'area_id' => 'required|exists:areas,id',
            'location_id' => 'required|exists:locations,id',
            'state_id' => 'required|exists:states,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'comment' => 'string|max:255',
            
        ]);
        
        $incidence = Incidence::create($request->all());
        $incidence->save();

            return response()->json([
            'success' => true,
            'message' => 'Incidencia creada correctamente.',
            'data' => $incidence
        ],200);

    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $incidence = Incidence::find($id);

        $incidence ->update([
            
            'state_id' => $request->state_id,
            'comment' => $request->comment,
        ]);

        $incidence->save();

        return response()->json($incidence, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $incidence = Incidence::find($id);

        if (!$incidence) {
            return response()->json(['error' => 'incidence not found'], 404);
        }

        $incidence->delete();
        return response()->json(['message' => 'La reserva fue eliminada correctamente']);
    }
}