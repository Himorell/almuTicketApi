<?php

namespace App\Http\Controllers;

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
        $incidence = new Incidence();
        return view('incidence.create', compact('incidence'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Incidence::$rules);

        $incidence = Incidence::create($request->all());

        return redirect()->route('incidences.index')
            ->with('success', 'Incidence created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incidence = Incidence::find($id);

        return view('incidence.show', compact('incidence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incidence = Incidence::find($id);

        return view('incidence.edit', compact('incidence'));
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
        request()->validate(Incidence::$rules);

        $incidence->update($request->all());

        return redirect()->route('incidences.index')
            ->with('success', 'Incidence updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $incidence = Incidence::find($id)->delete();

        return redirect()->route('incidences.index')
            ->with('success', 'Incidence deleted successfully');
    }
}
