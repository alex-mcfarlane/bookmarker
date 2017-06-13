<?php
namespace App\Services;

use App\Bookmark;

class BookmarkCreator
{
    public function create($attrs, array $category_ids)
    {
        $categories = [];

        foreach($category_ids as $category_id) {
            if($category = Category::find($category_id)) {
                $categories[] = $category;
            }
        }

        $bookmark = Bookmark::fromForm($attrs['url'], $attrs['title'], $attrs['description'], categories);

        return $bookmark;
    }
}