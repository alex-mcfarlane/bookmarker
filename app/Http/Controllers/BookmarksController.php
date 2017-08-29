<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Exceptions\BaseException;
use App\Services\BookmarkCreator;
use Illuminate\Http\Request;

class BookmarksController extends Controller
{
    /**
     * @var BookmarkCreator
     */
    protected $bookmarkCreator;

    public function __construct(BookmarkCreator $bookmarkCreator)
    {
        $this->bookmarkCreator = $bookmarkCreator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookmarks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['url', 'title', 'description']);
        $categories = $request->input('category_ids', []);

        try{
            $bookmark = $this->bookmarkCreator->create($input, $categories);
        } catch(BaseException $e) {
            return back()->withErrors($e->getErrors());
        }

        return redirect()->route('bookmarks.show', ['id' => $bookmark->id]);
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
        //
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
        //
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
