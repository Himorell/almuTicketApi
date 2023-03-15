<?php

namespace Tests\Feature\Api;

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

    public function test_IfBookingDeletedInJsonFile()
    {
        $booking = Booking::factory()->create();
        $response = $this->delete(route('destroyBookingApi', $booking->id));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }

    public function test_CheckIfCanCreateAnBookingWithJsonFile()
    {
        $response = $this->post(route('createBookingApi'), [
            'user_id' => '1',
            'area_id' => '1',
            'location_id' => '1',
            'state_id' => '1',
            'date' => 'YY-MM-DD',
            'startTime' => '00:00:00',
            'endTime' => '00:00:00',
            'numPeople' => '1',
            'room' => 'sala',
            'description' => 'description'
        ]);

        $data = ['user_id' => '1'];
        $data1 = ['area_id' => '1'];
        $data2 = ['location_id' => '1'];
        $data3 = ['state_id' => '1'];
        $data4 = ['date' => 'YYYY-MM-DD'];
        $data5 = ['startTime' => '00:00:00'];
        $data6 = ['endTime' => '00:00:00'];
        $data7 = ['numPeople' => '1'];
        $data8 = ['room' => 'sala'];
        $data9 = ['description' => 'description'];

        $response = $this->get(route('bookingsApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9);
    }

    public function test_CheckIfCanUpdateAnBookingWithJsonFile()
    {
        $response = $this->post(route('createBookingApi'), [
            'user_id' => '1',
            'area_id' => '1',
            'location_id' => '1',
            'state_id' => '1',
            'date' => 'YYYY-MM-DD',
            'startTime' => '00:00:00',
            'endTime' => '00:00:00',
            'numPeople' => '1',
            'room' => 'sala',
            'description' => 'description'
        ]);

        $data = ['user_id' => '1'];
        $data1 = ['area_id' => '1'];
        $data2 = ['location_id' => '1'];
        $data3 = ['state_id' => '1'];
        $data4 = ['date' => 'YYY-MM-DD'];
        $data5 = ['startTime' => '00:00:00'];
        $data6 = ['endTime' => '00:00:00'];
        $data7 = ['numPeople' => '1'];
        $data8 = ['room' => 'sala'];
        $data9 = ['description' => 'description'];

        $response = $this->get(route('bookingsApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9);

        $response = $this->put('/api/updateBooking/1', ['user_id' => '1','area_id' => '1','location_id' => '1','state_id' => '1','date' => 'YYY-MM-DD','startTime' => '00:00:00','endTime' => '00:00:00','numPeople' => '1','room' => 'sala','description' => 'description']);

        $data = ['user_id' => '1'];
        $data1 = ['area_id' => '1'];
        $data2 = ['location_id' => '1'];
        $data3 = ['state_id' => '1'];
        $data4 = ['date' => 'YYYY-MM-DD'];
        $data5 = ['startTime' => '00:00:00'];
        $data6 = ['endTime' => '00:00:00'];
        $data7 = ['numPeople' => '1'];
        $data8 = ['room' => 'sala'];
        $data9 = ['description' => 'description'];

        $response = $this->get(route('bookingsApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9);
    }
}
