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

    /**
     * @param $url
     *
     * Two uses cases for invalid URL's that need formatting:
     * URL starts with only www AND/OR URL does not start with http (this can be http, https, etc...)
     */
    protected function setUrl($url)
    {
        $value = $url;

        if($this->urlHeadHasString('www.', $value)) {
            $value = substr($value, 4);
        }

        if(!$this->urlHeadHasString('http', $value)) {
            $value = "http://" . $value;
        }

        $this->url = $value;
    }

    private function urlHeadHasString($needle, $haystack)
    {
        return substr($haystack, 0, strlen($needle)) == $needle;
    }
}
