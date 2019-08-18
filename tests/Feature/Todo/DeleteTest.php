<?php

namespace Tests\Feature\Todo;

use Tests\TestCase;
use App\Models\Todo;
use App\Enums\TodoStatus;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_delete_todo()
    {
        $todo = create(Todo::class);
        $this->json('DELETE', '/api/todos/' . $todo->id)
            ->assertOk();

        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id
        ]);
    }
}
