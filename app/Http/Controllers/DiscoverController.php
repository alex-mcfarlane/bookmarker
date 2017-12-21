<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Queries\BookmarkQuery;
use Illuminate\Http\Request;

class DiscoverController extends Controller
{
    public function index(Request $request)
    {
        $bookmarkQuery = new BookmarkQuery(['newest' => true]);
        $bookmarks = $bookmarkQuery->applyFilters(Bookmark::query())->get();

        return view('bookmarks.index', ['bookmarks' => $bookmarks]);
    }
}
