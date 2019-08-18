<?php

namespace App\Models;

use App\Enums\TodoStatus;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'status' => TodoStatus::TO_DO
    ];

    public function complete()
    {
        $this->update([
            'status' => TodoStatus::COMPLETED
        ]);

        return $this;
    }
}
