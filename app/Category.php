<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $fillable = ['title'];

    public function bookmarks()
    {
        return $this->belongsToMany(Bookmark::class);
    }

    public function scopePopular($query)
    {
        return $query->select('categories.*', DB::raw('count(bookmarks.id) as bookmarks_count'))
            ->join('bookmark_category', 'bookmark_category.category_id', '=', 'categories.id')
            ->join('bookmarks', 'bookmarks.id', '=', 'bookmark_category.bookmark_id')
            ->whereNotNull('bookmarks.id')
            ->groupBy('categories.id')
            ->orderBy('bookmarks_count', 'desc')
            ->limit(3);
    }
}
