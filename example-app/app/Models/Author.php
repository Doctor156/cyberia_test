<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Author extends Pivot
{
    use HasFactory;

    protected $table = "authors";

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function books() {
        return $this->hasMany(Book::class, 'author_id');
    }
}
