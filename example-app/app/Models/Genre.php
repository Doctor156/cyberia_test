<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Genre extends Pivot
{
    use HasFactory;

    protected $table = "genres";

    public function books() {
        return $this->belongsToMany(Book::class,'genre_book', 'genre_id', 'book_id');
    }
}
