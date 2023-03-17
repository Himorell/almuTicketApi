<?php

namespace App\Http\Controllers\Api;


use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::get();
        return response()->json($bookings,200);
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
        $booking = Booking::create([
            'user_id' => $request->user_id,
            'area_id' => $request->area_id,
            'location_id' => $request->location_id,
            'state_id' => $request->state_id,
            'date' => $request->date,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
            'numPeople' => $request->numPeople,
            'room' => $request->room,
            'description' => $request->description,
        ]);
        $booking->save();
        return response()->json($booking, 200);
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
            'user_id' => $request->user_id,
            'area_id' => $request->area_id,
            'location_id' => $request->location_id,
            'state_id' => $request->state_id,
            'date' => $request->date,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
            'numPeople' => $request->numPeople,
            'room' => $request->room,
            'description' => $request->description,
        ]);

        $booking->save();

        return response()->json($booking, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        $booking->delete();
        return response()->json(['message' => 'Booking deleted successfully']);
    }

}
