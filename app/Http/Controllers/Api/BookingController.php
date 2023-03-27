<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use App\Models\User;
use App\Models\State;
use App\Models\Booking;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class BookingController extends Controller
{

    public function index(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (!$request->user()) {
            return response()->json(['message' => 'No esta autorizado para visualizar esta ruta'], 401);
        }

        // Verificar si el usuario es un administrador
        if ($request->user()->isAdmin) {
            // Recuperar todas las reservas
            $bookings = Booking::all();
        } else {
            // Recuperar solo las reservas del usuario autenticado
            $bookings = Booking::where('user_id', $request->user()->id)->get();
        }

        // Devolver la respuesta correspondiente en formato JSON
        return response()->json($bookings, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = auth()->user();

        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
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
        
            $booking = Booking::create([
            'user_id' => $user->id,
            'area_id' => $validatedData['area_id'],
            'room_id' => $validatedData['room_id'],
            'location_id' => $validatedData['location_id'],
            'state_id' => 1,
            'date' => $validatedData['date'],
            'startTime' => $validatedData['startTime'],
            'endTime' => $validatedData['endTime'],
            'numPeople' => $validatedData['numPeople'],
            'description' => $validatedData['description'],
            
        ]);
    
        return response()->json([
            'message' => 'Reserva creada con éxito',
            'data' => $booking
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        // Verificar si el usuario está autenticado
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Verificar si el usuario es un administrador
        if ($request->user()->isAdmin) {
            // Recuperar cualquier reserva
            $booking = Booking::find($id);
        } else {
            // Recuperar solo las reservas del usuario autenticado
            $booking = Booking::where('user_id', $request->user()->id)->where('id', $id)->first();
        }

        // Verificar si la reserva existe
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // Devolver la respuesta correspondiente en formato JSON
        return response()->json($booking, 200);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {

        // Verificar si el usuario está autenticado
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Verificar si el usuario tiene permisos para actualizar la reserva
        if (!$request->user()->isAdmin) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Recuperar la reserva a actualizar
        $booking = Booking::findOrFail($id);

        $request->validate([
            'state_id' => 'required|exists:states,id',
            'comment' => 'nullable|string',
        ]);

        $booking->update([
            'state_id' => $request->state_id,
            'comment' => $request->comment,
        ]);

        // Actualizar la reserva
        //$booking->update($validatedData);

        return response()->json([
            'message' => 'Reserva de sala actualizada correctamente.',
            'data' => $booking
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($request,string $id)
    {
        // Verificar si el usuario está autenticado
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['error' => 'No se pudo encontrar la reserva'], 404);
        }

        if ($booking->user_id != $request->user()->id) {
            return response()->json(['message' => 'No tiene autorización de eliminar esta reserva'], 403);
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
