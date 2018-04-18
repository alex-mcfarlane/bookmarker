<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'access';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function bookmark()
    {
        return $this->belongsTo('App\Bookmark');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public static function forBookmark($userId, Role $role, Bookmark $bookmark)
    {
        $access = self::create([
            'user_id' => $userId,
            'role_id' => $role->id,
            'bookmark_id' => $bookmark->id
        ]);

        return $access;
    }
}