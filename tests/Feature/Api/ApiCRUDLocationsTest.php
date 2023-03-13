<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Location;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiCRUDlocationsTest extends TestCase
{
    Use RefreshDatabase;

    public function test_IfLocationsListedInJsonFile()
    {
        Location::factory(2)->create();
        $response = $this->get(route('locationsApi'));
        $response->assertStatus(200)->assertJsonCount(2);
    }

    public function test_IfLocationDeletedInJsonFile()
    {
        $location = Location::factory()->create();
        $response = $this->delete(route('destroyLocationApi', $location->id));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('locations', ['id' => $location->id]);
    }

    public function test_IfLocationsCreatedALocationInJsonFile()
    {
        $response = $this->post(route('createLocationApi'), [
            'name' => 'Dos Aceras',
        ]);

        $data = ['name' => 'Dos Aceras'];
        $response = $this->get(route('locationsApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    }

    public function test_IfLocationsUpdatedALocationInJsonFile()
    {
        $response = $this->post(route('createLocationApi'), [
            'name' => 'Dos Aceras',
        ]);

        $data = ['name' => 'Dos Aceras'];
        $response = $this->get(route('locationsApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);

        // Agregamos el id del estado creado para poder realizar la actualización.
        $locationId = json_decode($response->getContent())[0]->id;

        // Actualizamos el estado con el nuevo nombre.
        $response = $this->put(route('updateLocationApi', $locationId), [
            'name' => 'Nuevo',
        ]);

        // Verificamos que se haya actualizado correctamente el estado.
        $data = ['name' => 'Nuevo'];
        $response = $this->get(route('locationsApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    }

}
