<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visibility extends Model
{
    public function bookmark()
    {
        return $this->hasMany('App\Bookmark');
    }
}
