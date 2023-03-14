<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiCRUDUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_CheckIfUsersListedInJsonFile()
    {
        User::factory(2)->create();
        $response = $this->get(route('usersApi'));
        $response->assertStatus(200)->assertJsonCount(2);
    }

    public function test_IfUserDeletedInJsonFile()
    {
        $user = User::factory()->create();
        $response = $this->delete(route('destroyUserApi', $user->id));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_CheckIfCanCreateAnUserWithJsonFile()
    {
        $response = $this->post(route('createUserApi'), [
            'name' => 'Coders',
            'email' => 'coders@arrabalempleo.org',
            'password' => 'contraseña_segura'
        ]);

        $data = ['name' => 'Coders'];
        $data1 = ['email' => 'coders@arrabalempleo.org'];
        $data2 = ['password' =>'contraseña_segura'];

        $response = $this->get(route('usersApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data, $data1, $data2);
    }

    public function test_CheckIfCanUpdateAnUserWithJsonFile()
    {
        $response = $this->post(route('createUserApi'), [
            'name' => 'Coders',
            'email' => 'coders@arrabalempleo.org',
            'password' => 'contraseña_segura'
    ]);

        $data = ['name' => 'Coders'];
        $data1 = ['email' => 'coders@arrabalempleo.org'];
        $data2 = ['password' => 'contraseña_segura'];

        $response = $this->get(route('usersApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data, $data1, $data2);

        $response = $this->put('/api/updateUser/1', ['name' => 'Coders', 'email' => 'coders@arrabalempleo.org', 'password' => 'contraseña_segura']);

        $data = ['name' => 'Coders',];
        $data1 = ['email' => 'coders@arrabalempleo.org'];
        $data2 = ['password' => 'contraseña_segura'];

        $response = $this->get(route('usersApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data, $data1, $data2);
    }
}
