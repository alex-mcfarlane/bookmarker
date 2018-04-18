<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function access()
    {
        return $this->belongsToMany('App\Access');
    }

    /**
     * @param BookmarkContext $context
     * @param int $visibilityId
     * @return Bookmark
     */
    public function createBookmark(BookmarkContext $context, $visibilityId = 2)
    {
        $bookmark = Bookmark::forUser($context, $visibilityId, $this);
        $bookmark->setUser($this);

        return $bookmark;
    }
}
