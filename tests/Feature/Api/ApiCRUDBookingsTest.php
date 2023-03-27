<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiCRUDBookingsTest extends TestCase
{
    use RefreshDatabase;

    // public function test_OnlyAdminCanAccessBookingFullListedInJsonFile()
    // {
    //     // Create an admin and regular users
    //     $admin = User::factory()->create([
    //         'isAdmin' => true,
    //         'email' => 'admin@example.com',
    //         'password' => bcrypt('password'),
    //     ]);
    //     $adminToken = $admin->createToken('admin-token')->plainTextToken;
        
    //     $user = User::factory()->create([
    //         'isAdmin' => false,
    //         'email' => 'user@example.com',
    //         'password' => bcrypt('password'),
    //     ]);
    //     $userToken = $user->createToken('user-token')->plainTextToken;

    //     $user2 = User::factory()->create([
    //         'isAdmin' => false,
    //         'email' => 'user2@example.com',
    //         'password' => bcrypt('password'),
    //     ]);
    //     $user2Token = $user2->createToken('user2-token')->plainTextToken;

    //     // Create bookings
    //     $booking1 = Booking::factory()->create([
    //         'user_id' => $user->id,
    //         'area_id' => 1,
    //         'room_id' => 1,
    //         'location_id' => 1,
    //         'state_id' => 1,
    //         'date' => '2023-01-01',
    //         'startTime' => '00:01',
    //         'endTime' => '00:01',
    //         'numPeople' => 30,
    //         'description' => 'Reserva de sala taller a Fem Coder P1',
    //         'comment' => 'comment',
    //     ]);

    //     $booking2 = Booking::factory()->create([
    //         'user_id' => $user->id,
    //         'area_id' => 8,
    //         'room_id' => 2,
    //         'location_id' => 3,
    //         'state_id' => 1,
    //         'date' => '2023-01-01',
    //         'startTime' => '00:01',
    //         'endTime' => '00:01',
    //         'numPeople' => 15,
    //         'description' => 'Reserva de sala taller de empleabilidad',
    //         'comment' => 'comment',
    //     ]);

    //     $booking3 = Booking::factory()->create([
    //         'user_id' => $user2->id,
    //         'area_id' => 1,
    //         'room_id' => 1,
    //         'location_id' => 1,
    //         'state_id' => 1,
    //         'date' => '2023-01-01',
    //         'startTime' => '00:01',
    //         'endTime' => '00:01',
    //         'numPeople' => 30,
    //         'description' => 'Reserva de sala taller a Fem Coder P1',
    //         'comment' => 'comment',
    //     ]);

    //     $booking4 = Booking::factory()->create([
    //         'user_id' => $user2->id,
    //         'area_id' => 5,
    //         'room_id' => 6,
    //         'location_id' => 2,
    //         'state_id' => 1,
    //         'date' => '2023-01-09',
    //         'startTime' => '09:01',
    //         'endTime' => '10:01',
    //         'numPeople' => 30,
    //         'description' => 'Reunion interna Arrabal',
    //         'comment' => 'comment',
    //     ]); 

    //     // Login as an admin
    //     $response = $this->json('POST', 'api/auth/login', [
    //         'isAdmin' => true,
    //         'email' => 'admin@example.com',
    //         'password' => 'password',
    //     ]);
    
    //     // Admin can access bookings full list of all users
    //     $response = $this->withHeaders([
    //         'Authorization' => $adminToken,
    //         'Accept' => '*/*'
    //     ])->postJson("api/auth/index");
    //     $response->assertStatus(200)
    //             ->assertJsonCount(4);

    //     // Login as a regular user
    //     $response = $this->json('POST', 'api/auth/login', [
    //         'isAdmin' => false,
    //         'email' => 'user@example.com',
    //         'password' => 'password',
    //     ]);

    //     // Regular user can access only regular user's bookings
    //     $response = $this->withHeaders([
    //         'Authorization' => $userToken,
    //         'Accept' => '*/*'
    //     ])->postJson("api/auth/index");
    //     $response->assertStatus(200)
    //             ->assertJsonCount(1);

    //     // Login as a regular user
    //     $response = $this->json('POST', 'api/auth/login', [
    //         'isAdmin' => false,
    //         'email' => 'user2@example.com',
    //         'password' => 'password',
    //     ]);

    //     // Regular user2 can access only regular user2's bookings
    //     $response = $this->withHeaders([
    //         'Authorization' => $user2Token,
    //         'Accept' => '*/*'
    //     ])->postJson("api/auth/index");
    //     $response->assertStatus(200)
    //             ->assertJsonCount(2);
    // }


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
