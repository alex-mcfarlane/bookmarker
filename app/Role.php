<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static $rolesMap = [
        'editor' => 1,
        'reader' => 2
    ];

    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }
}
