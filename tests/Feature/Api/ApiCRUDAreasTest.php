<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Area;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiCRUDAreasTest extends TestCase
{
    /**
     * A basic feature test example.
     */

Use RefreshDatabase;

    public function test_CheckIfAreasListedInJsonFile()
    {
        Area::factory(2)->create();
        $response = $this->get(route('areasApi'));
        $response->assertStatus(200)->assertJsonCount(2);
    }

    //este seria el nuestro que no pasa
    // public function test_IfAreasDeletedInJsonFile()
    // {
    //     $area = Area::factory()->create();
    //     $response = $this->delete(route('destroyAreaApi', $area->id));
    //     $response->assertStatus(200);
    //     $this->assertDatabaseMissing('areas', ['id' => $area->id]);
    // }

    //y este es que me da el primo, es doble y pasa el segundo
    public function testDestroy()
    {
        $area = Area::factory()->create();

        $response = $this->deleteJson("/api/areas/{$area->id}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('areas', ['id' => $area->id]);
    }

    public function testDestroyNonExistingArea()
    {
        $response = $this->deleteJson('/api/areas/123');

        $response->assertNotFound();
    }

    public function test_CheckIfCanCreateAnAreaWhithJsonFile()
    {
        $response = $this->post(route('createAreaApi'), [
            'name' => 'Internacional',
        ]);

        $data = ['name' => 'Internacional'];

        $response = $this->get(route('areasApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    }

    public function test_CheckIfCanUpdateAnAreaWhithJsonFile()
    {
        $response = $this->post(route('createAreaApi'), [
            'name' => 'Internacional',
        ]);

        $data = ['name' => 'Internacional'];

        $response = $this->get(route('areasApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);

        $response = $this->put('/api/updateArea/1', ['name' => 'Internacional',]);

        $data = ['name' => 'Internacional',];

        $response = $this->get(route('areasApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    }
}
