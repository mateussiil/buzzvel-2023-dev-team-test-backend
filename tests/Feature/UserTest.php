<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user(): void
    {

        // $user = User::factory()->create();

    $user = [
        'name' => 'John Doe',
        'linkedin_url' => 'https://www.linkedin.com/in/johndoe/',
        'github_url' => 'https://github.com/johndoe',
    ];

    $response = $this->postJson('/users', $user);

    $response->assertStatus(201)
        ->assertJson([
            'data' => [
                'name' => 'JOHN DOE',
                'linkedin_url' => 'https://www.linkedin.com/in/johndoe/',
                'github_url' => 'https://github.com/johndoe',
            ]
        ]);
    }

    public function test_create_user_already_created(): void
    {

        $user = User::factory()->create();

        $response = $this->postJson('/users', $user->toArray());

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'name' => ['The name has already been taken.'],
                ],
            ]);
    }

    public function test_store_with_invalid_data()
    {

        $userData = [
            'linkedin_url' => 'https://www.linkedin.com/in/johndoe/',
            'github_url' => 'https://github.com/johndoe',
        ];

        $response = $this->postJson('/users', $userData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
        }

    public function test_show_user(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson('/users/' . $user->name);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'identify',
                    'name',
                    'linkedin_url',
                    'github_url',
                    'created',
                ]
            ]);
    }
}
