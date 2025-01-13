<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IngredientTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAsDefaultUser();
        $this->seed();
    }

    public function test_create_ingredient(): void
    {
        $ingredient = Ingredient::factory()->make()->toArray();
        $ingredients = ['ingredients' => [$ingredient]];

        $response = $this->postJson('/api/ingredients', $ingredients);

        $response->assertStatus(201);
        $this->assertDatabaseHas('ingredients', array_merge(
            $ingredient,
            [
                'expires_at' => Carbon::parse($ingredient['expires_at'])
                    ->format('Y-m-d H:i:s')
            ]
        ));
    }

    public function test_create_ingredient_validation_fails(): void
    {
        $invalidIngredient = [
            'ingredient_type_id' => 0,
            'description' => 'Test Ingredient',
        ];
        $ingredients = ['ingredients' => [$invalidIngredient]];

        $response = $this->postJson('/api/ingredients', $ingredients);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'ingredients.0.ingredient_type_id',
        ]);
    }

    public function test_list_ingredients(): void
    {
        $ingredient = Ingredient::factory()->create();

        $response = $this->get('/api/ingredients');

        $response->assertStatus(200);
        $this->assertEquals($ingredient->id, $response[0]['id']);
    }

    public function test_delete_ingredient(): void
    {
        $ingredient = Ingredient::factory()->create();

        $response = $this->deleteJson("/api/ingredients/{$ingredient->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('ingredients', [
            'id' => $ingredient->id,
        ]);
    }

    public function test_delete_expired_ingredients(): void
    {
        Ingredient::factory()->create([
            'expires_at' => now()->subDay(),
        ]);
        Ingredient::factory()->create([
            'expires_at' => now()->addDay(),
        ]);

        $response = $this->deleteJson('/api/ingredients/expired');

        $response->assertStatus(200);
        $this->assertDatabaseCount('ingredients', 1);
    }

    public function test_delete_all_ingredients(): void
    {
        Ingredient::factory()->count(5)->create();

        $response = $this->deleteJson('/api/ingredients');

        $response->assertStatus(200);
        $this->assertDatabaseCount('ingredients', 0);
    }
}
