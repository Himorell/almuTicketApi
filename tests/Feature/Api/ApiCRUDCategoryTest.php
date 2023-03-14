<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiCRUDCategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    use RefreshDatabase;

    public function test_CheckIfCategoriesListedInJsonFile()
    {
        Category::factory(2)->create();
        $response = $this->get(route('categoriesApi'));
        $response->assertStatus(200)->assertJsonCount(2);
    }

    public function test_IfCategoryDeletedInJsonFile()
    {
        $category = Category::factory()->create();
        $response = $this->delete(route('destroyCategoryApi', $category->id));
        $response->assertStatus(200);
        $this->assertDatabaseMissing('areas', ['id' => $category->id]);
    }

    public function test_CheckIfCanCreateAnCategoryWhithJsonFile()
    {
        $response = $this->post(route('createCategoryApi'), [
            'name' => 'Limpieza',
        ]);

        $data = ['name' => 'Limpieza'];

        $response = $this->get(route('categoriesApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    }

    public function test_CheckIfCanUpdateAnCategoryWhithJsonFile()
    {
        $response = $this->post(route('createCategoryApi'), [
            'name' => 'Limpieza',
        ]);

        $data = ['name' => 'Limpieza'];

        $response = $this->get(route('categoriesApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);

        $response = $this->put('/api/updateCategory/1', ['name' => 'Limpieza',]);

        $data = ['name' => 'Limpieza',];

        $response = $this->get(route('categoriesApi'));
        $response->assertStatus(200)->assertJsonCount(1)->assertJsonFragment($data);
    }

}
