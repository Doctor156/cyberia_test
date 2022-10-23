<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class GenreBookSeeder extends Seeder
{
    public function run()
    {
      /** @var Collection|Book[] $books */
      $books = Book::all();
        /** @var Collection|Genre[] $genres */
      $genres = Genre::all();

      foreach ($books as $book) {
          $currentGenres = $genres->random(2)->pluck('id');
          foreach ($currentGenres as $genre) {
              $book->genres()->attach($genre);
          }
      }

        foreach ($genres as $genre) {
            $currentBooks = $books->random(2)->pluck('id');
            foreach ($currentBooks as $book) {
                $genre->books()->attach($book);
            }
        }
    }
}
