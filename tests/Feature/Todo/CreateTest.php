<?php

namespace Tests\Feature\Todo;

use App\Enums\TodoStatus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_todos()
    {
        $this->json('POST', '/api/todos', ['description' => 'Go to store'])
            ->assertStatus(201)
            ->assertJsonFragment([
                'data' => [
                    'id' => 1,
                    'description' => 'Go to store',
                    'status' => TodoStatus::TO_DO,
                    'status_text' => 'TO_DO'
                ]
            ]);

        $this->assertDatabaseHas('todos', [
            'description' => 'Go to store',
            'status' => TodoStatus::TO_DO
        ]);
    }

    /** @test */
    public function description_is_required()
    {
        $this->json('POST', '/api/todos', ['description' => ''])
        ->assertStatus(422)
        ->assertJsonFragment([
            'errors' => [
                'description' => ['The description field is required.'],
            ]
        ]);
    }
}
