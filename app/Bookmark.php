<?php

namespace App;

use App\Exceptions\BaseException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Bookmark extends Model
{
    protected $guarded = [];

    /**
     * @param BookmarkContext $context
     * @param int $visibilityId
     * @param User $user
     * @return Bookmark
     */
    public static function forUser(BookmarkContext $context, $visibilityId, User $user)
    {
        $bookmark = self::make([
            'title' => $context->getTitle(),
            'description' => $context->getDescription(),
            'read' => 0
        ]);

        $bookmark->setUrl($context->getUrl());
        $bookmark->setVisibility($visibilityId);
        $bookmark->setUser($user);
        $bookmark->save();

        return $bookmark;
    }

    public function edit(BookmarkContext $context, $categoryIds, $visibilityId)
    {
        $this->title = $context->getTitle();
        $this->description = $context->getDescription();

        $this->setUrl($context->getUrl());
        $this->setCategories($categoryIds);
        $this->setVisibility($visibilityId);

        return $this->save();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function visibility()
    {
        return $this->belongsTo('App\Visibility', 'visibility_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
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

    protected function setVisibility($visibilityId)
    {
        if($visibility = Visibility::find($visibilityId)) {
            $this->visibility()->associate($visibility);
        } else {
            throw new BaseException('Unable to find an entry with the visibility id ' . $visibilityId, []);
        }
    }

    public function setCategories(array $categoryIds)
    {
        $existingCategoryIds = $this->categories->map(function($item, $key) {
            return $item['id'];
        });

        $categoriesToAdd = array_diff($categoryIds, $existingCategoryIds->toArray());
        $categoriesToRemove = array_diff($existingCategoryIds->toArray(), $categoryIds);

        foreach($categoriesToAdd as $categoryId) {
            if($category = Category::find($categoryId)) {
                $this->addCategory($category);
            }
        }

        foreach($categoriesToRemove as $categoryId) {
            if($category = Category::find($categoryId)) {
                $this->removeCategory($category);
            }
        }
    }

    public function archive()
    {
        $this->read = true;

        return $this->save();
    }

    public function open()
    {
        $this->read = false;

        return $this->save();
    }

    public function getHostName()
    {
        $parsedUrl = parse_url($this->url);

        return $parsedUrl['host'];
    }

    public function addCategory(Category $category)
    {
        $this->categories()->save($category);
    }

    public function setUser(User $user)
    {
        $this->user()->associate($user);
    }

    protected function removeCategory(Category $category)
    {
        $this->categories()->detach($category->id);
    }

    private function urlHeadHasString($needle, $haystack)
    {
        return substr($haystack, 0, strlen($needle)) == $needle;
    }

    /**
     * Query scopes
     */
    public function scopeWithVisibility(Builder $query, $name)
    {
        return $query->whereHas('visibility', function($q) use ($name) {
            return $q->where('name', $name);
        });
    }
}
