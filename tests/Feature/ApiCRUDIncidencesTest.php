<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Area;
use App\Models\User;
use App\Models\State;
use App\Models\Category;
use App\Models\Location;
use App\Models\Incidence;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiCRUDIncidencesTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_IfIncidenceCreatedAIncidencesInJsonFile()
    {
        // Crear datos de prueba
    $category = Category::factory()->create();
    $area = Area::factory()->create();
    $user = User::factory()->create();
    $location = Location::factory()->create();
    $state = State::factory()->create();
    
    Incidence::factory()->count(3)->create([
        'category_id' => $category->id,
        'area_id' => $area->id,
        'user_id' => $user->id,
        'location_id' => $location->id,
        'title' => 'title',
        'description' => 'description',
        'state_id' => $state->id,
    ]);

    // Realizar la solicitud al método index
    $response = $this->getJson(route('incidences.index'));

    // Asegurarse de que la respuesta tenga un código de estado 200 (éxito)
    $response->assertStatus(200);

    // Asegurarse de que la respuesta contenga los datos esperados
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'category',
                'area',
                'user',
                'location',
                'title',
                'description',
                'state'
            ]
        ]
    ]);

    }
}
