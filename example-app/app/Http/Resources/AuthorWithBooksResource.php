<?php

namespace App\Http\Resources;

use App\Models\Author;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property-read Author $resource */
class AuthorWithBooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'books' => $this->resource->books->toArray(),
        ];
    }
}
