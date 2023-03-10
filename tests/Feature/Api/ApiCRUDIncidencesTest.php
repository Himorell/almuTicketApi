<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Incidence;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiCRUDIncidencesTest extends TestCase
{
    Use RefreshDatabase;

    public function test_IfIncidencesListedInJsonFile()
    {
        Incidence::factory(2)->create();
        $response = $this->get(route('incidencesApi'));
        $response->assertStatus(200)
        ->assertJsonCount(2);
    }
}
