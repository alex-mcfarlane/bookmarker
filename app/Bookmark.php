<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        $bookmark = self::create([
            'url' => $url,
            'title' => $title,
            'description' => $description,
        ]);

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
}
