<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param User $user
     * @return  void|bool
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response
     */
    public function update(User $user, Book $book): Response
    {
        if (empty($user->author)) {
            return Response::deny('That\'s not ur book :)');
        }

        return $user?->author->id === $book->author_id
            ? Response::allow()
            : Response::deny('That\'s not ur book :)');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Book $book)
    {
        return $user?->author->id === $book->author_id
            ? Response::allow()
            : Response::deny('Thats not ur book. Are there is now author on ur acc');
    }
}
