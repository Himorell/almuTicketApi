<?php

namespace App\Http\Controllers;

use App\Models\Incidence;
use Illuminate\Http\Request;

class IncidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidences = Incidence::all()->with(['category', 'area', 'user', 'location'])->paginate();
        return response()->json($incidences);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(Incidence::$rules);

        $incidence = Incidence::create($validatedData);
        return response()->json($incidence);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incidence = Incidence::with(['area', 'category', 'location', 'state', 'user'])->find($id);
        if ($incidence) {
            return response()->json($incidence);
        } else {
            return response()->json(['error' => '<EUGPSCoordinates>not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $incidence = Incidence::find($id);
        if ($incidence) {
            // Agrega la regla "sometimes" a cada campo para que solo se valide si está presente en la solicitud
            foreach (Incidence::$rules as &$rule) {
                $rule = "sometimes|$rule";
            }
            unset($rule); // Elimina la referencia al último elemento

            $validatedData = $request->validate(Incidence::$rules);

            $incidence->update($validatedData);
            return response()->json($incidence);
        } else {
            return response()->json(['error' => '<EUGPSCoordinates>not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
