<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function viewTags()
    {
        $tags = Tag::all();

        return view('pages.tags.tags', ['tags' => $tags]);
    }
}
