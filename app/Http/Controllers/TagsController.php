<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function viewTags()
    {
        $tags = Tag::all();

        return view('pages.tags.tags', ['tags' => $tags]);
    }

//    public function createTag()
//    {
//
//    }
}
