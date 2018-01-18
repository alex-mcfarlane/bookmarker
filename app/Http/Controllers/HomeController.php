<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Category;
use App\Queries\BookmarkQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = ['owner' => Auth::id()] + $request->all() + ['read' => 0];

        $query = new BookmarkQuery($filters);

        $builder = $query->applyFilters(Bookmark::query());

        $bookmarks = $builder->get();
        $categories = Category::popular()->get();

        return view('home', ['bookmarks'=>$bookmarks, 'categories' => $categories]);
    }
}
