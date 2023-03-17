<?php

namespace Tests\Feature\Api;

use App\Models\Incidence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiCRUDIncidenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_CheckIfIncidencesListedInJsonFile()
    {

        Incidence::factory()->count(2)->create();
        $response = $this->getJson('incidences');
        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }

    
}
