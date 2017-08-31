<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Bookmark extends Model
{
    protected $guarded = [];

    /**
     * @param $url
     * @param $title
     * @param $description
     * @return Bookmark
     */
    public static function fromForm($url, $title, $description)
    {
        $bookmark = self::make([
            'title' => $title,
            'description' => $description,
        ]);

        $bookmark->setUrl($url);
        $bookmark->save();

        return $bookmark;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function addCategory(Category $category)
    {
        $this->categories()->save($category);
    }

    protected function setUrl($url)
    {
        $value = $url;

        if(substr($value, 0, 4) == 'www.') {
            $value = substr($value, 4);
        }

        if(substr($value, 0, 4) != 'http') {
            $value = "http://" . $value;
        }

        $this->url = $value;
    }
}
