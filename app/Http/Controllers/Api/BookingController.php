<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Models\Area;
use App\Models\User;
use App\Models\State;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all();
        return response()->json($bookings);//revisar si incluir status 200
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $booking = new Booking();
        $users = User::pluck('name', 'id');
        $states = State::pluck('name', 'id');
        $locations = Location::pluck('name', 'id');
        $areas = Area::pluck('name', 'id');

        return response()->json([
            'booking' => $booking,
            'users' => $users,
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
            'date' => 'required',
            'startTime' => 'required',
            'endTime' => 'required',
            'numPeople' => 'required',
            'room' => 'required',
            'description' => 'required|string',
            'comment' => 'string|max:255',

        ]);

        $booking = Booking::create($request->all());
        $booking->save();

            return response()->json([
            'success' => true,
            'message' => 'Incidencia creada correctamente.',
            'data' => $booking
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
        $booking = Booking::find($id);

        $booking ->update([
            
            'state_id' => $request->state_id,
            'comment' => $request->comment,
        ]);

        $booking->save();

        return response()->json($booking, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        $booking->delete();
        return response()->json(['message' => 'La reserva fue eliminada correctamente']);
    }
}