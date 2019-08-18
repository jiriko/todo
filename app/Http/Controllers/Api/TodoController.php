<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use App\Http\Requests\Todo\Create;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    public function index()
    {
        return TodoResource::collection(Todo::latest()->get());
    }

    public function store(Create $request)
    {
        return new TodoResource(Todo::create([
            'description' => $request->description
        ]));
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response([]);
    }
}
