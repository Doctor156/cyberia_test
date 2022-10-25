<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|required',
            'author' => 'numeric|exists:authors,id',
            'genres' => 'required|array',
            'genres.*' => 'required|integer|exists:genres,id',
        ];
    }

    public function getAuthorId(): int
    {
        return (int)$this->input('author');
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getGenres(): array
    {
        return array_values($this->input('genres'));
    }
}
