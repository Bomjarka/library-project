<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{

    public function viewMaterials()
    {
        $materials = Material::all();

        return view('pages.materials.materials', ['materials' => $materials]);
    }

    public function viewMaterial(Material $material)
    {
        return view('pages.materials.view-material', ['material' => $material]);
    }
}
