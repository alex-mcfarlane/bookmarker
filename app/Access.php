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

    public static function forBookmark($userId, $roleId, $bookmarkId)
    {
        $access = self::create([
            'user_id' => $userId,
            'role_id' => $roleId,
            'bookmark_id' => $bookmarkId
        ]);

        return $access;
    }
}
