<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncidenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'area' => $this->area->name,
            'category' => $this->category->name,
            'location' => $this->location->name,
            'title' => $this->title,
            'description' => $this->description,
            'state' => $this->state->name,
        ];
    }
}
