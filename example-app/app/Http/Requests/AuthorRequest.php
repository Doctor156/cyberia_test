<?php

namespace App\Http\Requests;

use App\Rules\hasntAuthor;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required',
            'user_id' => ['nullable', new hasntAuthor],
            'books' => 'nullable|array',
            'books.*' => 'nullable|numeric|exists:books,id',
        ];
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getBooks(): ?array
    {
        if (empty($this->input('books'))) {
            return null;
        }

        return array_values($this->input('books'));
    }

    public function getUserId(): ?int
    {
        return $this->input('user_id');
    }
}
