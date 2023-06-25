<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'name' => $this->get('name'),
            'wp_id' => $this->get('id'),
            'slug' => $this->get('slug'),
            'description' => $this->get('description'),
            'display' => $this->get('display'),
            'image' => $this->get('image'),
        ];
    }
}
