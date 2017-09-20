<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookmark;

class ArchivedBookmarksController extends Controller
{
    public function store($id)
    {
        $bookmark = Bookmark::find($id);

        $bookmark->archive();

        return back();
    }
}
