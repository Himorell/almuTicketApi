<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\State;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiCRUDStatesTest extends TestCase
{
    Use RefreshDatabase;

    public function test_IfStatesListedInJsonFile()
    {
        State::factory(2)->create();
        $response = $this->get(route('statesApi'));
        $response->assertStatus(200)->assertJsonCount(2);
    }

    public function test_IfStatesDeletedInJsonFile()
    {
        $state = State::factory()->create();
        $response = $this->delete(route('destroyStateApi', $state->id));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('states', ['id' => $state->id]);
    }

    public function test_IfStatesCreatedAStateInJsonFile()
    {
        $response = $this->post(route('createStateApi'), [ 
            'name' => 'Emitido',
        ]);

        $data = ['name' => 'Emitido'];
        $response = $this->get(route('statesApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    }
}