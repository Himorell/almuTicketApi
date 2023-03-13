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
        // Crear algunas incidencias en la base de datos
    $incidences = Incidence::factory()->count(3)->create();

    // Enviar una solicitud GET a la ruta 'incidencesApi'
    $response = $this->get(route('incidencesApi'));

    // Afirmar que la respuesta tiene un código de estado 200 (OK)
    $response->assertStatus(200);

    // Afirmar que la respuesta contiene las incidencias creadas
    foreach ($incidences as $incidence) {
        $response->assertJsonFragment([
            'id' => $incidence->id,
            'foreign_key_1' => $incidence->foreign_key_1,
            'foreign_key_2' => $incidence->foreign_key_2,
            
        ]);
    }
    }
}
