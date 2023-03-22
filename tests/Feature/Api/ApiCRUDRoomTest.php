<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Room;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiCRUDRoomTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    use RefreshDatabase;

    public function test_CheckIfRoomsListedInJsonFile()
    {
        Room::factory(2)->create();
        $response = $this->get(route('roomsApi'));
        $response->assertStatus(200)->assertJsonCount(2);
    }

    public function test_IfRoomDeletedInJsonFile()
    {
        $room = Room::factory()->create();
        $response = $this->delete(route('destroyRoomApi', $room->id));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('rooms', ['id' => $room->id]);
    }

    public function test_CheckIfCanCreateAnRoomWithJsonFile()
    {
        $response = $this->post(route('createRoomApi'), [
            'name' => 'Sala Galaxia',
        ]);

        $data = ['name' => 'Sala Galaxia'];

        $response = $this->get(route('roomsApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    }

    public function test_CheckIfCanUpdateAnRoomWithJsonFile()
    {
        $response = $this->post(route('createRoomApi'), [
            'name' => 'Sala Galaxia',
        ]);

        $data = ['name' => 'Sala Galaxia'];

        $response = $this->get(route('roomsApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);

        $response = $this->put('/api/updateRoom/1', ['name' => 'Sala Galaxia',]);

        $data = ['name' => 'Sala Galaxia',];

        $response = $this->get(route('roomsApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    }
}
