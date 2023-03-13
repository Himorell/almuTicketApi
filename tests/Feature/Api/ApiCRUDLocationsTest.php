<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class ApiCRUDLocationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_IfLocationsListedInJsonFile()
    {
        Location::factory(2)->create();
        $response = $this->get(route('locationsApi'));
        $response->assertStatus(200)->assertJsonCount(2);
    }

    public function test_IfLocationsDeletedInJsonFile()
    {
        $location = Location::factory()->create();
        $response = $this->delete(route('destroyLocationApi', $location->id));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('locations', ['id' => $location->id]);
    }

    // public function test_IfLocationsCreatedALocationInJsonFile()
    // {
    //     $response = $this->post(route('createLocationApi'), [
    //         'name' => 'Dos Aceras',
    //     ]);

    //     $data = ['name' => 'Dos Aceras'];
    //     $response = $this->get(route('locationsApi'));
    //     $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    // }

    public function test_can_create_location()
    {
        $data = [
            'name' => 'Dos Aceras',
        ];
        $response = $this->postJson('/api/locations', $data);
        $response->assertStatus(201)
            ->assertJson($data);
    }

    public function test_can_show_location()
    {
        $location = Location::factory()->create();
        $response = $this->getJson("/api/locations/{$location->id}");
        $response->assertStatus(200)
            ->assertJson($location->toArray());
    }

    public function test_can_update_location()
    {
        $location = Location::factory()->create();
        $data = [
            'name' => 'Dos Aceras',
        ];
        $response = $this->putJson("/api/locations/{$location->id}", $data);
        $response->assertStatus(200)
            ->assertJson($data);
    }

    // public function test_can_destroy_location()
    // {
    //     $location = Location::factory()->create();

    //     $response = $this->deleteJson("/api/locations/{$location->id}");

    //     $response->assertStatus(200)
    //         ->assertJson(['message' => 'Location deleted']);
    // }
}
