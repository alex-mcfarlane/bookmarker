<?php

namespace App\Policies;

use App\Bookmark;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookmarkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Bookmark  $bookmark
     * @return bool
     */
    public function update(User $user, Bookmark $bookmark)
    {
        return $user->id === $bookmark->user_id;
    }
}
