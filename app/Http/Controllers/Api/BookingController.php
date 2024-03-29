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
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class BookingController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'No está autorizado para visualizar esta ruta'], 401);
        }

        if ($request->user()->isAdmin) {
            $bookings = Booking::all();
        } else {
            $bookings = Booking::where('user_id', $request->user()->id)->get();
        }

        // Obtener los modelos de Area y Location correspondientes a cada Booking
        foreach ($bookings as $booking) {
            $booking->user_name = User::find($booking->user_id)->name;
            $booking->area_name = Area::find($booking->area_id)->name;
            $booking->location_name = Location::find($booking->location_id)->name;
            $booking->room_name = Room::find($booking->room_id)->name;
            $booking->state_name = State::find($booking->state_id)->name;
        }

        return response()->json($bookings, 200);
    }


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


    public function show(Request $request, $id)
    {

        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($request->user()->isAdmin) {

            $booking = Booking::find($id);
        } else {

            $booking = Booking::where('user_id', $request->user()->id)->where('id', $id)->first();
        }

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json($booking, 200);
    }


    public function update(Request $request, $id)
    {
        
        $user = auth()->user();
        if (!$user || !$user->isAdmin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        if ($user->isAdmin) {
        $booking = Booking::findOrFail($id);

        $validatedData = $request->validate([
            'state_id' => 'required|exists:states,id',
            'comment' => 'nullable|string',
        ]);

        
        $booking->update([
            'state_id' => $validatedData['state_id'],
            'comment' => $validatedData['comment'],
        ]);

        return response()->json([
            'message' => 'Reserva de sala actualizada correctamente.',
            'data' => $booking
        ], 200);
        }
    }


    public function destroy(Request $request, string $id)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'No estás autenticado'], 401);
        }

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
        $bookings = Booking::all();

        return $bookings;
    }
}