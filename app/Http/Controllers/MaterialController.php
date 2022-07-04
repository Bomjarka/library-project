<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\Type;
use App\Services\MaterialService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MaterialController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function viewMaterials()
    {
        $materials = Material::all();

        return view('pages.materials.materials', ['materials' => $materials]);
    }

    /**
     * @param Material $material
     * @return Application|Factory|View
     */
    public function viewMaterial(Material $material)
    {
        return view('pages.materials.view-material', ['material' => $material]);
    }

    /**
     * @param Request $request
     * @param MaterialService $materialService
     * @return Application|Factory|View|RedirectResponse
     */
    public function createMaterial(Request $request, MaterialService $materialService)
    {
        $category = Category::find($request->get('material-category'));
        $type = Type::find($request->get('material-type'));
        $materialName = $request->get('material-name');
        $materialAuthors = $request->get('material-author');
        $materialDescription = $request->get('material-description');

        if ($category && $type && $materialName && $materialAuthors) {
            $material = $materialService->createMaterial([
                'category' => $category,
                'type' => $type,
                'materialName' => $materialName,
                'materialAuthors' => $materialAuthors,
                'materialDescription' => $materialDescription,
            ]);

            return view('pages.materials.view-material', ['material' => $material]);
        }

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function findMaterials(Request $request)
    {
        $needle = $request->get('needle');

        $foundMaterials = Material::where('name', 'ILIKE', '%' . $needle . '%')
            ->orWhere('author', 'ilike', '%' . $needle . '%')
            ->orWhere('description', 'ilike', '%' . $needle . '%')
            ->get();

        if ($foundMaterials->isNotEmpty()) {
            return view('pages.materials.materials', ['materials' => $foundMaterials, 'oldNeedle' => $needle]);
        }

        return redirect()->back()->withErrors(['message' => 'Materials not found']);
    }

    /**
     * @param Material $material
     * @param Request $request
     * @param MaterialService $materialService
     * @return JsonResponse|RedirectResponse
     */
    public function editMaterial(Material $material, Request $request, MaterialService $materialService)
    {
        $newName = $request->get('newName') ;
        $newAuthors = $request->get('newAuthors');
        $newType = Type::find($request->get('newType'));
        $newCategory = Category::find($request->get('newCategory'));
        $newDescription = $request->get('newDescription');

        if ($materialService->editMaterial($material, [
            'category' => $newCategory,
            'type' => $newType,
            'materialName' => $newName,
            'materialAuthors' => $newAuthors,
            'materialDescription' => $newDescription,
        ])) {
            return response()->json([
                'msg' => 'success',
            ]);
        }

        return redirect()->back()->withErrors(['message' => 'Something wrong']);


    }

    /**
     * @param Material $material
     * @param MaterialService $materialService
     * @return JsonResponse
     */
    public function deleteMaterial(Material $material, MaterialService $materialService): JsonResponse
    {
        $materialService->deleteMaterial($material);

        return response()->json([
            'msg' => 'success',
        ]);
    }


    /**
     * @param Material $material
     * @param Request $request
     * @param MaterialService $materialService
     * @return RedirectResponse
     */
    public function addLink(Material $material, Request $request, MaterialService $materialService): RedirectResponse
    {
        $linkDescription = $request->get('link-description');
        $linkUrl = $request->get('link-url');

        $materialService->addLink($material, ['link-description' => $linkDescription, 'link-url' => $linkUrl]);

        return redirect()->back();

    }

    /**
     * @param Material $material
     * @param Request $request
     * @param MaterialService $materialService
     * @return JsonResponse
     */
    public function deleteLink(Material $material, Request $request, MaterialService $materialService): JsonResponse
    {
        $uuid = $request->get('linkUUID');
        $materialService->deleteLink($material, $uuid);

        return response()->json([
            'msg' => 'success',
        ]);
    }
}
