<?php

namespace App\Http\Controllers;

use App\Category;
use App\Queries\BookmarkQuery;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        Category::create(['title' => $request->get('title')]);

        return redirect()->route('home');
    }

    public function show(Request $request, $id)
    {
        $category = Category::find($id);

        $bookmarks = $category->bookmarks;

        return view('categories.view', ['category' => $category, 'bookmarks' => $bookmarks]);
    }
}
