<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Todo;
use App\Enums\TodoStatus;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_marks_the_item_to_completed()
    {
        $todo = create(Todo::class, ['status' => TodoStatus::TO_DO]);
        $todo->complete();

        $this->assertEquals(TodoStatus::COMPLETED, $todo->status);
    }
}
