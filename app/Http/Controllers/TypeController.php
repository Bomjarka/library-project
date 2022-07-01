<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function viewTypes()
    {
        $types = Type::all();

        return view('pages.types.types', ['types' => $types]);
    }
}
