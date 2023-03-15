<?php

// namespace Tests\Feature\Api;

// use Tests\TestCase;
// use App\Models\Incidence;
// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

// class ApiCRUDIncidencesTest extends TestCase
// {
//     Use RefreshDatabase;

//     public function test_IfIncidencesListedInJsonFile()
//     {
//         // Crear algunas incidencias en la base de datos
//     $incidences = Incidence::factory()->count(3)->create();

//     // Enviar una solicitud GET a la ruta 'incidencesApi'
//     $response = $this->get(route('incidencesApi'));

//     // Afirmar que la respuesta tiene un código de estado 200 (OK)
//     $response->assertStatus(200);

//     // Afirmar que la respuesta contiene las incidencias creadas
//     foreach ($incidences as $incidence) {
//         $response->assertJsonFragment([
//             'id' => $incidence->id,
//             'foreign_key_1' => $incidence->foreign_key_1,
//             'foreign_key_2' => $incidence->foreign_key_2,

//         ]);
//     }
//     }
// }
namespace Tests\Feature;

use App\Models\Incidence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiCRUDIncidencesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_all_incidences()
    {
        //Creamos algunas incidencias de prueba
        Incidence::factory()->count(3)->create();

        //Hacemos una solicitud GET a la ruta del índice del controlador de API
        $response = $this->getJson(route('api.incidences.index'));

        //Aseguramos que la respuesta tenga un código de estado 200 y contenga los datos esperados
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    /** @test */
    public function it_can_get_a_single_incidence()
    {
        //Creamos una incidencia de prueba
        $incidence = Incidence::factory()->create();

        //Hacemos una solicitud GET a la ruta show del controlador de API
        $response = $this->getJson(route('api.incidences.show', $incidence));

        //Aseguramos que la respuesta tenga un código de estado 200 y contenga los datos esperados
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $incidence->id,
                'title' => $incidence->title,
                'description' => $incidence->description,
            ]
        ]);
    }
}
