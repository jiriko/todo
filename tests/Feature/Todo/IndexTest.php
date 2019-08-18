<?php

namespace Tests\Feature\Todo;

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_fetch_todos()
    {
        $todo1 = create(Todo::class);
        $todo2 = create(Todo::class);
        $todo3 = create(Todo::class);

        $response = $this->json('GET', '/api/todos')
            ->assertOk()
            ->getData()
            ->data;

        tap(collect($response), function ($response) use ($todo1, $todo2, $todo3) {
            $this->assertTrue($response->contains('id', $todo1->id));
            $this->assertTrue($response->contains('id', $todo2->id));
            $this->assertTrue($response->contains('id', $todo3->id));

            $this->assertCount(3, $response);
        });
    }
}
