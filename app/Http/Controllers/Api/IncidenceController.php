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
        public function __construct()
    {
        $this->middleware('auth:api');
    }

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

        foreach ($incidences as $incidence) {
            $incidence->user_name = User::find($incidence->user_id)->name;
            $incidence->area_name = Area::find($incidence->area_id)->name;
            $incidence->location_name = Location::find($incidence->location_id)->name;
            $incidence->category_name = Room::find($incidence->category_id)->name;
            $incidence->state_name = State::find($incidence->state_id)->name;
        }

        return response()->json($incidences, 200);
    }

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

    public function update(Request $request, $id)
    {

        $user = auth()->user();
        if (!$user || !$user->isAdmin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($user->isAdmin) {
            $incidence = Incidence::findOrFail($id);

            $validatedData = $request->validate([
                'state_id' => 'required|exists:states,id',
                'comment' => 'nullable|string',
            ]);


            $incidence->update([
                'state_id' => $validatedData['state_id'],
                'comment' => $validatedData['comment'],
            ]);

            return response()->json([
                'message' => 'Incidencia de sala actualizada correctamente.',
                'data' => $incidence
            ], 200);
        }
    }

    public function destroy(Request $request, string $id)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'No estás autenticado'], 401);
        }

        $incidence = Incidence::find($id);

        if (!$incidence) {
            return response()->json(['error' => 'Incidence not found'], 404);
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