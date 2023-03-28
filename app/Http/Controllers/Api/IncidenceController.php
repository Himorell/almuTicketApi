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
    public function index(Request $request)
    {
            if (!$request->user()) {
            return response()->json(['message' => 'No esta autorizado para visualizar esta ruta'], 401);
        }

            if ($request->user()->isAdmin) {

            $incidences = Incidence::all();
        } else {

            $incidences = Incidence::where('user_id', $request->user()->id)->get();
        }

        return response()->json($incidences, 200);
    }
    // /**
    //  * Store a newly created resource in storage.
    //  */

    public function store(Request $request)
    {

        $user = auth()->user();

        $validatedData = $request->validate(['user_id' => 'required|exists:users,id',
            'area_id' => 'required|exists:areas,id',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $incidence = Incidence::create([
            'user_id' => $validatedData['user_id'],
            'area_id' => $validatedData['area_id'],
            'category_id' => $validatedData['category_id'],
            'location_id' => $validatedData['location_id'],
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
        ]);

        return response()->json([
            'message' => 'Incidencia creada con éxito',
            'data' => $incidence
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($request->user()->isAdmin) {

            $incidence = Incidence::find($id);
        } else {

            $incidence = Incidence::where('user_id', $request->user()->id)->where('id', $id)->first();
        }

        if (!$incidence) {
            return response()->json(['message' => 'Incidence not found'], 404);
        }

        return response()->json($incidence, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $incidence = Incidence::findOrFail($id);

        $request->validate([
            'state_id' => 'required|exists:states,id',
            'comment' => 'nullable|string',
        ]);

        $incidence->update([
            'state_id' => $request->state_id,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Reserva de sala actualizada correctamente.',
            'data' => $incidence
        ], 200);
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

        if ($incidence->state_id != 1) {
            return response()->json(['error' => 'No se puede eliminar la incidencia porque ha sido vista'], 400);
        }

        $incidence->delete();
        return response()->json(['message' => 'La incidencia fue eliminada correctamente']);
        }

    public function getIncidences()
    {
        $incidences = Incidence::all();

        return $incidences;
    }
}
