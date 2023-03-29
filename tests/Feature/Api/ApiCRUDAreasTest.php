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

    public function test_IfAreaDeletedInJsonFile()
    {
        $area = Area::factory()->create();
        $response = $this->delete(route('destroyAreaApi', $area->id));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('areas', ['id' => $area->id]);
    }

    public function test_CheckIfCanCreateAnAreaWithJsonFile()
    {
        $response = $this->post(route('createAreaApi'), [
            'name' => 'Internacional',
        ]);

        $data = ['name' => 'Internacional'];

        $response = $this->get(route('areasApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    }

    public function test_CheckIfCanUpdateAnAreaWithJsonFile()
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
