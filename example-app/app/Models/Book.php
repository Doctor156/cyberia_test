<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

/** @property int $id */
class Book extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $table = "books";
    // this is a monster
    public $incrementing = true;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'name',
        'author_id',
    ];

    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function genres() {
        return $this->belongsToMany(Genre::class, 'genre_book', 'book_id', 'genre_id');
    }
}
