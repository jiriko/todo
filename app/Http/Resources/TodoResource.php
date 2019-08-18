<?php

namespace App\Http\Resources;

use App\Enums\TodoStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status_text' => TodoStatus::getKey($this->status),
            'status' => $this->status,
            'description' => $this->description 
        ];
    }
}
