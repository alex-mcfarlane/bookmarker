<?php

namespace App\Http\Controllers;

use App\Exceptions\BaseException;
use App\Services\BookmarkCreator;
use App\Services\BookmarkUpdater;
use App\Visibility;
use Illuminate\Http\Request;
use App\Bookmark;
use App\Category;
use App\Queries\BookmarkQuery;

class BookmarksController extends Controller
{
    /**
     * @var BookmarkCreator
     */
    protected $bookmarkCreator;

    public function __construct(BookmarkCreator $bookmarkCreator, BookmarkUpdater $bookmarkUpdater)
    {
        $this->bookmarkCreator = $bookmarkCreator;
        $this->bookmarkUpdater = $bookmarkUpdater;
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->all();
        $query = new BookmarkQuery($filters);
        $builder = $query->applyFilters(Bookmark::query());

        $bookmarks = $builder->get();

        return view('bookmarks.index', ['bookmarks'=>$bookmarks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $visibilities = Visibility::all();

        return view('bookmarks.create', compact(['categories', 'visibilities']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['url', 'title', 'description', 'visibility_id']);
        $categories = $request->input('categories', []);

        try{
            $bookmark = $this->bookmarkCreator->create($input, $categories);
        } catch(BaseException $e) {
            return back()->withErrors($e->getErrors());
        }

        return redirect()->with('success', 'Bookmark has been created!')->route('bookmarks.show', ['id' => $bookmark->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bookmark = Bookmark::find($id);

        return view('bookmarks.view', ['bookmark' => $bookmark]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bookmark = Bookmark::find($id);
        $categories = Category::all();
        $visibilities = Visibility::all();

        return view('bookmarks.edit', ['bookmark' => $bookmark, 'categories' => $categories, 'visibilities' => $visibilities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bookmark = Bookmark::find($id);

        $input = $request->only(['url', 'title', 'description', 'visibility_id']);
        $categories = $request->input('categories', []);

        try {
            $updatedBookmark = $this->bookmarkUpdater->update($bookmark, $input, $categories);

            return redirect()->with('success', 'Bookmark has been successfully updated!')->route('bookmarks.show', ['id' => $updatedBookmark->id]);
        } catch(BaseException $e) {
            return back()->withInput($request->input())->withErrors($e->getErrors());
        }
    }

    public function partialUpdate(Request $request, $id)
    {
        $bookmark = Bookmark::find($id);

        if($request->has('read')) {
            $isRead = $request->input('read');

            if($isRead) {
                $bookmark->archive();
            }
            else {
                $bookmark->open();
            }
        }

        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
