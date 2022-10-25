<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property-read Book $resource */
class BookResource extends JsonResource
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
            'genres' => implode(', ', $this->resource->genres->pluck('name')->toArray()),
            'author' => $this->resource?->author->name ?? 'John Doe',
            'delete route' => route('destroy.book', $this->resource->id),
        ];
    }
}
