<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Queries\BookmarkQuery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = new BookmarkQuery($request->all());
        $builder = $query->applyFilters(Bookmark::query());

        $bookmarks = $builder->get();

        return view('home', ['bookmarks'=>$bookmarks]);
    }
}
