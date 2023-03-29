<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\IncidenceController;
use App\Http\Controllers\Api\BookingController;

class TicketController extends Controller
{

    public function index()
    {
        $incidences = (new IncidenceController)->getIncidences();
        $bookings = (new BookingController)->getBookings();

        return response()->json([
            'incidences' => $incidences,
            'bookings' => $bookings,
        ]);

    }


    public function create()
    {
        
    }


    public function store(Request $request)
    {
        
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
    
    }


    public function update(Request $request, string $id)
    {
    
    }


    public function destroy(string $id)
    {
        //
    }
}
