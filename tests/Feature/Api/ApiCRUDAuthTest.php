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

    public function testUserCanRegisterSuccessfully()
    {
        $userData = [
            'name' => 'Lola',
            'surname' => 'Garcia',
            'email' => 'lolagarcia@arrabalempleo.org',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->json('POST', '/api/auth/register', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'user' => [
                    'name',
                    'surname',
                    'email',
                    'created_at',
                    'updated_at',
                    'id'
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Lola',
            'surname' => 'Garcia',
            'email' => 'lolagarcia@arrabalempleo.org'
        ]);
    }

    public function testUserRegistrationFailsWithMissingInformation()
    {
        $userData = [
            'surname' => 'Garcia',
            'email' => 'lolagarcia@arrabalempleo.org',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->json('POST', '/api/auth/register', $userData);

        $response->assertStatus(400);
    }

    public function testUserRegistrationFailsWithExistingEmail()
    {
        $existingUser = User::factory()->create([
            'email' => 'lola@arrabalempleo.org'
        ]);

        $userData = [
            'name' => 'Lola',
            'surname' => 'Navarro',
            'email' => 'lola@arrabalempleo.org',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->json('POST', '/api/auth/register', $userData);

        $response->assertStatus(400);
    }

    public function testUserRegistrationFailsWithShortPassword()
    {
        $userData = [
            'name' => 'Lola',
            'surname' => 'Garcia',
            'email' => 'lolagarcia@arrabalempleo.org',
            'password' => 'pass',
            'password_confirmation' => 'pass'
        ];

        $response = $this->json('POST', '/api/auth/register', $userData);

        $response->assertStatus(400);
    }
}
