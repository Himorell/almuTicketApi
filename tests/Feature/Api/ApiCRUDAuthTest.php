<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiCRUDAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_userCanLogin() 
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
        
        $response = $this->json('POST', 'api/auth/login', [
            'email' => 'user@example.com',
            'password' => 'password',
        ]);
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
        ]);
    }

    public function test_userCanLogout()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);

        $token = auth()->login($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer' . $token,
        ])->json('POST', 'api/auth/logout');

        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Ha cerrado sesión con éxito',
                ]);

        $this->assertGuest();
    }


}
