<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\MaterialTags;
use App\Models\Tag;
use App\Models\Type;
use App\Services\MaterialService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

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
        $validator = Validator::make($request->all(), [
            'material-category' => ['required', 'int'],
            'material-type' => ['required', 'int'],
            'material-name' => ['required', 'string', 'max:255'],
            'material-author' => ['required', 'string', 'max:255'],
            'material-description' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect(route('viewMaterials'))->withErrors(['message' => $validator->getMessageBag()->all()]);
        }

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
        $validator = Validator::make($request->all(), [
            'needle' => ['nullable', 'string']
        ]);

        if ($validator->fails()) {
            return redirect(route('viewMaterials'))->withErrors(['message' => $validator->getMessageBag()->all()]);
        }
        $needle = $request->get('needle');

        if ($needle === null) {
            return view('pages.materials.materials', ['materials' => Material::all(), 'oldNeedle' => $needle]);
        }

        $categories = Category::where('name', 'ILIKE', '%' . $needle . '%')->get();
        $types = Type::where('name', 'ILIKE', '%' . $needle . '%')->get();
        $tags = Tag::where('name', 'ILIKE', '%' . $needle . '%')->get();
        $materialTags = MaterialTags::whereIn('tag_id', $tags->pluck('id'))->get();

        if ($request->get('byTag') && $request->get('byTag') === true) {
            $foundMaterials = Material::whereIn('id', $materialTags->pluck('material_id'))
                ->get();
        } else {
            $foundMaterials = Material::where('name', 'ILIKE', '%' . $needle . '%')
                ->orWhere('author', 'ilike', '%' . $needle . '%')
                ->orWhere('description', 'ilike', '%' . $needle . '%')
                ->orWhereIn('category_id', $categories->pluck('id'))
                ->orWhereIn('type_id', $types->pluck('id'))
                ->orWhereIn('id', $materialTags->pluck('material_id'))
                ->get();
        }

        if ($foundMaterials->isNotEmpty()) {
            return view('pages.materials.materials', ['materials' => $foundMaterials, 'oldNeedle' => $needle]);
        }

        return redirect()->route('viewMaterials')->withErrors(['message' => 'Materials not found']);
    }

    /**
     * @param Material $material
     * @param Request $request
     * @param MaterialService $materialService
     * @return JsonResponse|RedirectResponse
     */
    public function editMaterial(Material $material, Request $request, MaterialService $materialService)
    {
        $validator = Validator::make($request->all(), [
            'newCategory' => ['required', 'int'],
            'newType' => ['required', 'int'],
            'newName' => ['required', 'string', 'max:255'],
            'newAuthors' => ['required', 'string', 'max:255'],
            'newDescription' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect(route('viewMaterials'))->withErrors(['message' => $validator->getMessageBag()->all()]);
        }

        $newName = $request->get('newName');
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
     * @return Application|Factory|View
     */
    public function editMaterialPage(Material $material)
    {
        return view('pages.materials.edit-material', ['material' => $material]);
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
        $validator = Validator::make($request->all(), [
            'link-description' => ['nullable', 'string', 'max:255'],
            'link-url' => ['required', 'url'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['message' => $validator->getMessageBag()->all()]);
        }

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
    public function editLink(Material $material, Request $request, MaterialService $materialService): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'linkDesc' => ['nullable', 'string', 'max:255'],
            'linkURL' => ['required', 'url'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => $validator->getMessageBag()->all(),
            ]);
        }

        $newLinkDescription = $request->get('linkDesc');
        $newLinkUrl = $request->get('linkURL');
        $uuid = $request->get('linkUUID');

        $materialService->editLink($material, ['newLinkDescription' => $newLinkDescription, 'newLinkUrl' => $newLinkUrl, 'uuid' => $uuid]);

        return response()->json([
            'msg' => 'success',
        ]);
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

    /**
     * @param Request $request
     * @param Material $material
     * @return JsonResponse
     */
    public function deleteMaterialTag(Request $request, Material $material): JsonResponse
    {
        $tag = Tag::find((int)$request->get('tagId'));

        if ($tag) {
            $materialTag = MaterialTags::whereMaterialId($material->id)
                ->whereTagId($tag->id)
                ->first();

            $materialTag->delete();

            return response()->json([
                'msg' => 'success',
            ]);
        }
        return response()->json([
            'msg' => 'error',
        ]);
    }

    /**
     * @param Request $request
     * @param Material $material
     * @return JsonResponse
     */
    public function addMaterialTag(Request $request, Material $material): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tagId' => ['required', 'int'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'msg' => $validator->getMessageBag()->all(),
            ]);
        }
        $tag = Tag::find((int)$request->get('tagId'));

        if ($tag && !MaterialTags::whereMaterialId($material->id)
                ->whereTagId($tag->id)
                ->first()) {
            MaterialTags::create([
                'material_id' => $material->id,
                'tag_id' => $tag->id
            ]);

            return response()->json([
                'msg' => 'success',
            ]);
        }

        return response()->json(['msg' => 'error',]);
    }
}
