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
            'date' => '2023-01-01',
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
        $data4 = ['date' => '2023-01-01'];
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
            'date' => '2023-01-01',
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
        $data4 = ['date' => '2023-01-01'];
        $data5 = ['startTime' => '00:00:00'];
        $data6 = ['endTime' => '00:00:00'];
        $data7 = ['numPeople' => '1'];
        $data8 = ['room' => 'sala'];
        $data9 = ['description' => 'description'];

        $response = $this->get(route('bookingsApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9);

        $response = $this->put('/api/updateBooking/1', ['user_id' => '1','area_id' => '1','location_id' => '1','state_id' => '1','date' => '2023-01-01','startTime' => '00:00:00','endTime' => '00:00:00','numPeople' => '1','room' => 'sala','description' => 'description']);

        $data = ['user_id' => '1'];
        $data1 = ['area_id' => '1'];
        $data2 = ['location_id' => '1'];
        $data3 = ['state_id' => '1'];
        $data4 = ['date' => '2023-01-01'];
        $data5 = ['startTime' => '00:00:00'];
        $data6 = ['endTime' => '00:00:00'];
        $data7 = ['numPeople' => '1'];
        $data8 = ['room' => 'sala'];
        $data9 = ['description' => 'description'];

        $response = $this->get(route('bookingsApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data, $data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9);
    }

    //del primo
    public function testIndex()
    {
        // Usar un factory para crear algunas reservas
        $bookings = factory(Booking::class, 3)->create();

        // Realizar una solicitud GET a la ruta del índice
        $response = $this->get('/api/bookings');

        // Asegurarse de que la respuesta tenga un código de estado 200
        $response->assertStatus(200);

        // Asegurarse de que los datos devueltos sean correctos
        $response->assertJson($bookings->toArray());
    }
    public function testStore()
    {
        // Crear datos ficticios para la solicitud
        $data = [
            'user_id' => 1,
            'area_id' => 1,
            'location_id' => 1,
            'state_id' => 1,
            'date' => '2023-03-15',
            'startTime' => '09:00:00',
            'endTime' => '17:00:00',
            'numPeople' => 5,
            'room' => 'Sala de conferencias',
            'description' => 'Reunión de equipo'
        ];

        // Realizar una solicitud POST a la ruta de la tienda
        $response = $this->post('/api/bookings', $data);

        // Asegurarse de que la respuesta tenga un código de estado 200
        $response->assertStatus(200);

        // Asegurarse de que los datos devueltos sean correctos
        $response->assertJson($data);
    }

    public function testShow()
    {
        // Usar un factory para crear una reserva
        $booking = factory(Booking::class)->create();

        // Realizar una solicitud GET a la ruta show
        $response = $this->get("/api/bookings/{$booking->id}");

        // Asegurarse de que la respuesta tenga un código de estado 200
        $response->assertStatus(200);

        // Asegurarse de que los datos devueltos sean correctos
        $response->assertJson($booking->toArray());
    }
    public function testUpdate()
    {
        // Usar un factory para crear una reserva y datos para actualizar
        $booking = factory(Booking::class)->create();
        $data = [
            'date' => '2023-03-16',
            'startTime' => '10:00:00',
            'endTime' => '18:00:00',
            'numPeople' => 6,
            'room' => 'Sala de juntas',
            'description' => 'Reunión con el cliente'
        ];

        // Realizar una solicitud PUT a la ruta update
        $response = $this->put("/api/bookings/{$booking->id}", $data);

        // Asegurarse de que la respuesta tenga un código de estado 200
        $response->assertStatus(200);

        // Asegurarse de que los datos devueltos sean correctos
        //(esto dependerá del registro actualizado en tu base dedatos)
        $response->assertJson($data);
    }

    public function testDestroy()
{
  	// Usar un factory para crear una reserva
  	$booking = factory(Booking::class)->create();

  	// Realizar una solicitud DELETE a la ruta destroy
  	$response = this>delete("/api/bookings/{$booking>id}");

  	// Asegúrate deque el códigode estado sea204
  	$response>assertStatus(204);
}
}
