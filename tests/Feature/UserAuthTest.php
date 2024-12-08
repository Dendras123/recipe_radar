<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_registers_successfully(): void
    {
        $userData = User::factory()->make()->toArray();
        $userData['password'] = 'password123';

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);
    }
}
