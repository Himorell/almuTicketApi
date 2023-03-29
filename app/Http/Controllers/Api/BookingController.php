<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use App\Models\Room;
use App\Models\User;
use App\Models\State;
use App\Models\Booking;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();

        foreach ($bookings as $booking) {
            $booking->user_name = User::find($booking->user_id)->name;
            $booking->area_name = Area::find($booking->area_id)->name;
            $booking->location_name = Location::find($booking->location_id)->name;
            $booking->room_name = Room::find($booking->room_id)->name;
            $booking->state_name = State::find($booking->state_id)->name;
        }
        return response()->json($bookings, 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'area_id' => 'required|exists:areas,id',
            'room_id' => 'required|exists:rooms,id',
            'location_id' => 'required|exists:locations,id',
            'date' => 'required|date|after_or_equal:today',
            'startTime' => 'required',
            'endTime' => 'required|after:startTime',
            'numPeople' => 'required|integer|min:1',
            'description' => 'required',
            'comment' => 'nullable',
        ]);
    
        $booking = Booking::create($validatedData);
    
        return response()->json([
            'message' => 'Reserva creada con éxito',
            'data' => $booking
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        
        return response()->json([
            'data' => $booking,
            'message' => 'Booking showed successfully'
        ], 200);
    }

    

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'state_id' => 'required|exists:states,id',
            'comment' => 'nullable|string',
        ]);

        $booking->update([
            'state_id' => $request->state_id,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'message' => 'Reserva de sala actualizada correctamente.',
            'data' => $booking
        ], 200);
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

        if ($booking->state_id != 1) {
            return response()->json(['error' => 'No se puede eliminar la reserva porque ha sido vista'], 400);
        }

        $booking->delete();
        return response()->json(['message' => 'La reserva fue eliminada correctamente']);
    }

    public function getBookings()
    {
        // Obtener todas las incidencias de la base de datos
        $bookings = Booking::all();

        // Devolver la colección de incidencias
        return $bookings;
    }
}
