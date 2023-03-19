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

class IncidenceController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$incidences = Incidence::with(['users', 'areas', 'categories', 'locations', 'states'])->paginate();
        $incidences = Incidence::all();
        return response()->json($incidences);
    }

    public function create()
    {
        $incidences = new Incidence();
        $users = User::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $states = State::pluck('name', 'id');
        $locations = Location::pluck('name', 'id');
        $areas = Area::pluck('name', 'id');

        return response()->json([
            'incidences' => $incidences,
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
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'state_id' => 'required|exists:states,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

            $incidences = Incidence::create($request->all());
            $incidences->save();

            return response()->json([
            'success' => true,
            'message' => 'Incidencia creada correctamente.',
            'data' => $incidences
        ],200);
        
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    $incidence = Incidence::find($id);

    return response()->json($incidence);
    }

    public function edit($id)
    {
        $incidences = Incidence::find($id);
        $users = User::all();
        $areas = Area::all();
        $categories = Category::all();
        $locations = Location::all();
        $states = State::all();

            return response()->json([
            'incidences' => $incidences,
            'users' => $users,
            'areas' => $areas,
            'categories' => $categories,
            'locations' => $locations,
            'states' => $states
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Incidence $incidences, $id)
    {
            $request->validate([
            'state_id' => 'required|exists:states,id',
            'comment' => 'incidence is updated'
        ]);

            $incidence = Incidence::find($id);
            $incidence->update([
                'state_id' => $request->state_id,
                'comment' => $request->comment,
        ]);
        $incidence->save();

            return response()->json([
            'success' => true,
            'message' => 'Incidencia actualizada correctamente.',
            'data' => $incidences
        ],200);

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $incidences = Incidence::find($id)->delete();

            return response()->json([
            'success' => true,
            'message' => 'Incidencia eliminada correctamente.'
        ]);
    }
}