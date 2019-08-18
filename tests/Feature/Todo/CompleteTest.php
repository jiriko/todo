<?php

namespace Tests\Feature\Todo;

use Tests\TestCase;
use App\Models\Todo;
use App\Enums\TodoStatus;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_complete_todo()
    {
        $todo = create(Todo::class, ['status' => TodoStatus::TO_DO]);
        $this->json('POST', '/api/todos/' . $todo->id .'/complete/')
            ->assertOk()
            ->assertJsonFragment([
                'data' => [
                    'id' => $todo->id,
                    'description' => $todo->description,
                    'status' => TodoStatus::COMPLETED,
                    'status_text' => 'COMPLETED'
                ]
            ]);
    }
}
