<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Booking;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiCRUDBookingsTest extends TestCase
{

    use RefreshDatabase;

    public function test_CheckIfBookingsListedInJsonFile()
    {
        Booking::factory(2)->create();
        $response = $this->get(route('bookingsApi'));
        $response->assertStatus(200)->assertJsonCount(2);
    }

    // public function test_IfBookingDeletedInJsonFile()
    // {
    //     $booking = Booking::factory()->create();
    //     $response = $this->delete(route('destroyBookingApi', $booking->id));
    //     $response->assertStatus(200);
    //     $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    // }

    // public function test_CheckIfCanCreateAnBookingWithJsonFile()
    // {
    //     $response = $this->post(route('createBookingApi'), [
    //         'user_id' => 'user_id',
    //         'area_id' => 'area_id',
    //         'location_id' => 'location_id',
    //         'state_id' => 'state_id',
    //         'date' => 'date',
    //         'startTime' => 'startTime',
    //         'endTime' => 'endTime',
    //         'numPeople' => 'numPeople',
    //         'room' => 'room',
    //         'description' => 'description',
    //     ]);

    //     $data = ['user_id' => 'user_id'];
    //     $data1 = ['area_id' => 'area_id'];
    //     $data2 = ['location_id' => 'location_id'];
    //     $data3 = ['state_id' => 'state_id'];
    //     $data4 = ['date' => 'date'];
    //     $data5 = ['startTime' => 'startTime'];
    //     $data6 = ['endTime' => 'endTime'];
    //     $data7 = ['numPeople' => 'numPeople'];
    //     $data8 = ['room' => 'room'];
    //     $data9 = ['description' => 'description'];

    //     $response = $this->get(route('bookingsApi'));
    //     $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9);
    // }

    // public function test_CheckIfCanUpdateAnBookingWithJsonFile()
    // {
    //     $response = $this->post(route('createBookingApi'), [
    //         'user_id' => 'user_id',
    //         'area_id' => 'area_id',
    //         'location_id' => 'location_id',
    //         'state_id' => 'state_id',
    //         'date' => 'date',
    //         'startTime' => 'startTime',
    //         'endTime' => 'endTime',
    //         'numPeople' => 'numPeople',
    //         'room' => 'room',
    //         'description' => 'description',
    //     ]);

    //     $data = ['user_id' => 'user_id'];
    //     $data1 = ['area_id' => 'area_id'];
    //     $data2 = ['location_id' => 'location_id'];
    //     $data3 = ['state_id' => 'state_id'];
    //     $data4 = ['date' => 'date'];
    //     $data5 = ['startTime' => 'startTime'];
    //     $data6 = ['endTime' => 'endTime'];
    //     $data7 = ['numPeople' => 'numPeople'];
    //     $data8 = ['room' => 'room'];
    //     $data9 = ['description' => 'description'];

    //     $response = $this->get(route('bookingsApi'));
    //     $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9);

    //     $response = $this->put('/api/updateBooking/1', ['user_id' => 'user_id','area_id' => 'area_id','location_id' => 'location_id','state_id' => 'state_id','date' => 'date','startTime' => 'startTime','endTime' => 'endTime','numPeople' => 'numPeople','room' => 'room','description' => 'description']);

    //     $data = ['user_id' => 'user_id'];
    //     $data1 = ['area_id' => 'area_id'];
    //     $data2 = ['location_id' => 'location_id'];
    //     $data3 = ['state_id' => 'state_id'];
    //     $data4 = ['date' => 'date'];
    //     $data5 = ['startTime' => 'startTime'];
    //     $data6 = ['endTime' => 'endTime'];
    //     $data7 = ['numPeople' => 'numPeople'];
    //     $data8 = ['room' => 'room'];
    //     $data9 = ['description' => 'description'];

    //     $response = $this->get(route('bookingsApi'));
    //     $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9);
    // }
}
