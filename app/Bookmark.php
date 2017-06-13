<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $guarded = [];

    public static function fromForm($url, $title, $description, array $categories = [])
    {
        $bookmark = self::create([
            'url' => $url,
            'title' => $title,
            'description' => $description,
        ]);

        foreach($categories as $category) {
            $bookmark->addCategory($category);
        }

        return $bookmark;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    private function addCategory(Category $category)
    {
        $this->categories()->save($category);
    }
}
