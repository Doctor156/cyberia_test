<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class isAdmin
{
    use HandlesAuthorization;

    public function isAdmin(User $user) {
            $user->isAdmin();
    }
}
