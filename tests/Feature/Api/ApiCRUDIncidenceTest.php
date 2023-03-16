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

    public function test_CheckIfCanCreateAnIncidenceWhithJsonFile()
    {
        $response = $this->post(route('createIncidenceApi'), [
            'title' => 'Limpieza',
        ]);

        $data = ['title' => 'Limpieza'];

        $response = $this->get(route('incidencesApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    
    }

    public function test_CheckIfCanUpdateAnIncidenceWhithJsonFile()
    {
        $response = $this->post(route('createIncidenceApi'), [
            'title' => 'Limpieza',
        ]);

        $data = ['title' => 'Limpieza'];

        $response = $this->get(route('incidencesApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);

        $response = $this->put('/api/updateIncidences/1', ['title' => 'Limpieza',]);

        $data = ['title' => 'Limpieza',];

        $response = $this->get(route('incidencesApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    
    }
}
