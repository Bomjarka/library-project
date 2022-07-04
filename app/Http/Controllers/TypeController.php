<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function viewTypes()
    {
        $types = Type::all();

        return view('pages.types.types', ['types' => $types]);
    }
}
