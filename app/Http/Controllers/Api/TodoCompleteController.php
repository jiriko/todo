<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Models\Todo;

class TodoCompleteController extends Controller
{
    public function store(Todo $todo)
    {
        return new TodoResource($todo->complete());
    }
}
