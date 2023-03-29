<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\User;
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
    //         'user_id' => '1',
    //         'area_id' => '1',
    //         'location_id' => '1',
    //         'state_id' => '1',
    //         'date' => '2023-01-01',
    //         'startTime' => '00:00:00',
    //         'endTime' => '00:00:00',
    //         'numPeople' => '1',
    //         'room' => 'sala 10',
    //         'description' => 'description de booking'
    //     ]);

    //     $data = [
    //         'user_id' => '1',
    //         'area_id' => '1',
    //         'location_id' => '1',
    //         'state_id' => '1',
    //         'date' => '2023-03-15',
    //         'startTime' => '09:00:00',
    //         'endTime' => '17:00:00',
    //         'numPeople' => '5',
    //         'room' => 'Sala 10',
    //         'description' => 'descripcion de booking'
    //     ];

    //     $response = $this->get(route('bookingsApi'));
    //     $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    // }

    // public function test_CheckIfCanUpdateAnBookingWithJsonFile()
    // {
    //     $response = $this->post(route('createBookingApi'), [
    //         'user_id' => '1',
    //         'area_id' => '1',
    //         'location_id' => '1',
    //         'state_id' => '1',
    //         'date' => '2023-01-01',
    //         'startTime' => '00:00:00',
    //         'endTime' => '00:00:00',
    //         'numPeople' => '1',
    //         'room' => 'sala 10',
    //         'description' => 'descripcion de booking'
    //     ]);

    //     $data = [
    //         'user_id' => '1',
    //         'area_id' => '1',
    //         'location_id' => '1',
    //         'state_id' => '1',
    //         'date' => '2023-03-15',
    //         'startTime' => '09:00:00',
    //         'endTime' => '17:00:00',
    //         'numPeople' => '5',
    //         'room' => 'Sala 10',
    //         'description' => 'descripcion de booking'
    //     ];

    //     // $response = $this->get(route('bookingsApi'));
    //     // $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);

    //     $response = $this->put('/api/updateBooking/1', ['user_id' => '1','area_id' => '1','location_id' => '1','state_id' => '1','date' => '2023-01-01','startTime' => '00:00:00','endTime' => '00:00:00','numPeople' => '1','room' => 'sala 10','description' => 'descripcion de booking']);

    //     $data = [
    //         'user_id' => '1',
    //         'area_id' => '1',
    //         'location_id' => '1',
    //         'state_id' => '1',
    //         'date' => '2023-03-15',
    //         'startTime' => '09:00:00',
    //         'endTime' => '17:00:00',
    //         'numPeople' => '5',
    //         'room' => 'Sala 10',
    //         'description' => 'descripcion de booking'
    //     ];

    //     $response = $this->get(route('bookingsApi'));
    //     $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    // }


    // public function test_CheckIfCanCreateAnBookingWithJsonFile()
    // {
    //     $data = [
    //         'user_id' => '1',
    //         'area_id' => '1',
    //         'location_id' => '1',
    //         'state_id' => '1',
    //         'date' => '2023-01-01',
    //         'startTime' => '00:00:00',
    //         'endTime' => '00:00:00',
    //         'numPeople' => '1',
    //         'room' => 'sala 10',
    //         'description' => 'descripcion de booking'
    //     ];

    //     $response = $this->post(route('createBookingApi'), $data);

    //     $response = $this->get(route('bookingsApi'));
    //     $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    // }
}
