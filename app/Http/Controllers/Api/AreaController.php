<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::get();
        return response()->json($areas,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $area = Area::create([
            'name' => $request->name,
        ]);

        $area->save();

        return response()->json($area, 200);
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
        $area = Area::find($id);

        $area ->update([
            'name' => $request->name,
        ]);

        $area->save();

        return response()->json($area, 200);
    }

    /**
     * Remove the specified resource from storage.
     */

        //este es nuestro y lo he cambiado por el del primo probando los test

    // public function destroy(string $id)
    // {
    //     $area = Area::find($id);

    //     if (!$area) {
    //         return response()->json(['error' => 'Area not found'], 404);
    //     }

    //     $area->delete();
    //     return response()->json(['message' => 'Area deleted successfully']);
    // }

        //este me lo ha dado el primo con el ha pasado uno de sus test
    public function destroy(Area $area)
    {
        try {
            $area->delete();
            return response()->noContent();
        } catch (ModelNotFoundException $e) {
            return response()->notFound('Area not found');
        } catch (\Exception $e) {
            return response()->serverError('Unable to delete area');
        }
    }

}
