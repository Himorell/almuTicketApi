<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\State;
use App\Models\Category;
use App\Models\Location;
use App\Models\Incidence;
use Illuminate\Http\Request;

/**
 * Class IncidenceController
 * @package App\Http\Controllers
 */
class IncidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$incidences = Incidence::with(['user', 'area', 'category', 'location', 'state'])->paginate();
        //return view('incidence.index')->with('incidences', $incidences);

        $incidences = Incidence::paginate();

        return view('incidence.index', compact('incidences'))
            ->with('i', (request()->input('page', 1) - 1) * $incidences->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $incidences = new Incidence();
        $users = User::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $states = State::pluck('name', 'id');
        $locations = Location::pluck('name', 'id');
        $areas = Area::pluck('name', 'id');
        
        return view('incidence.create', compact('incidences','users','categories','areas','locations','states'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
    
        //Si la validación pasa, creamos la incidencia con los datos del request
        $incidence = Incidence::create($request->all());
    
        //Retornamos una redirección a la vista show.blade.php con un mensaje de éxito
        return redirect()->route('incidences.index', $incidence)->with('success', 'Incidencia creada correctamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($incidence)
    {
        //Obtenemos la incidencia con sus relaciones
        //$incidence->with(['user', 'area', 'category', 'location', 'state']);
        $incidence = Incidence::with(['user', 'area', 'category', 'location', 'state'])->findOrFail($incidence);
    //Retornamos la vista show.blade.php con los datos
        return view('incidence.show')->with(compact('incidence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incidence = Incidence::findOrFail($id);
        //Obtenemos los datos de las tablas relacionadas
        $users = User::all();
        $areas = Area::all();
        $categories = Category::all();
        $locations = Location::all();
        $states = State::all();

        //Retornamos la vista edit.blade.php con los datos
        return view('incidences.edit')->with(compact('incidence', 'users', 'areas', 'categories', 'locations', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Incidence $incidence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidence $incidence)
    {
        //Validamos los datos del request con las reglas que definamos
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'area_id' => 'required|exists:areas,id',
        'category_id' => 'required|exists:categories,id',
        'location_id' => 'required|exists:locations,id',
        'state_id' => 'required|exists:states,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string'
    ]);

    //Si la validación pasa, creamos la incidencia con los datos del request
    $incidence->update($request->all());

    //Retornamos una redirección a la vista show.blade.php con un mensaje de éxito
    return redirect()->route('incidences.index', $incidence)->with('success', 'Incidencia actualizada correctamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $incidence = Incidence::find($id)->delete();

        return redirect()->route('incidence.index')
            ->with('success', 'Incidence deleted successfully');
    }
}
