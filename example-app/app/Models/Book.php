<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Book extends Pivot
{
    use HasFactory;

    protected $table = "books";


    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function genres() {
        return $this->belongsToMany(Genre::class, 'genre_book', 'book_id', 'genre_id');
    }
}
