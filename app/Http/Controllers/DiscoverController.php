<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Queries\BookmarkQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscoverController extends Controller
{
    public function index(Request $request)
    {
        $params = ['newest' => true];

        // exclude current users bookmarks
        if($userId = Auth::id()) {
            $params['excludeUsers'] = [Auth::id()];
        }

        $bookmarkQuery = new BookmarkQuery($params);
        $bookmarks = $bookmarkQuery->applyFilters(Bookmark::query())->get();

        return view('bookmarks.index', ['bookmarks' => $bookmarks]);
    }
}
