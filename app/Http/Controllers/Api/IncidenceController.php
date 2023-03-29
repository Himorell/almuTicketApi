<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use App\Models\Room;
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
        $incidences = Incidence::all();
        foreach ($incidences as $incidence) {
            $incidence->user_name = User::find($incidence->user_id)->name;
            $incidence->area_name = Area::find($incidence->area_id)->name;
            $incidence->location_name = Location::find($incidence->location_id)->name;
            $incidence->category_name = Room::find($incidence->category_id)->name;
            $incidence->state_name = State::find($incidence->state_id)->name;
        }
        return response()->json($incidences, 200);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
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

        foreach ($incidence as $incidence) {
            $incidence->user_name = User::find($incidence->user_id)->name;
            $incidence->area_name = Area::find($incidence->area_id)->name;
            $incidence->location_name = Location::find($incidence->location_id)->name;
            $incidence->category_name = Room::find($incidence->category_id)->name;
            $incidence->state_name = State::find($incidence->state_id)->name;
        }

        return response()->json([
            'message' => 'Incidencia creada exitosamente',
            'data' => $incidence,
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $incidence = Incidence::findOrFail($id);
        
        return response()->json([
            'data' => $incidence,
            'message' => 'Incidence showed successfully'
        ], 200);
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

        // Verificar si el estado de la incidencia es "emitido"
        if ($incidence->state_id != 1) {
            return response()->json(['error' => 'No se puede eliminar la incidencia porque ha sido vista'], 400);
        }

        $incidence->delete();
        return response()->json(['message' => 'La incidencia fue eliminada correctamente']);
        }

    public function getIncidences()
    {
        // Obtener todas las incidencias de la base de datos
        $incidences = Incidence::all();

        // Devolver la colección de incidencias
        return $incidences;
    }
}