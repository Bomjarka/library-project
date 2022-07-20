<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

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

    /**
     * @param Tag $tag
     * @return Application|Factory|View
     */
    public function viewTag(Tag $tag)
    {
        return view('pages.tags.view-tag', ['tag' => $tag]);
    }

    /**
     * @return Application|Factory|View
     */
    public function newTag()
    {
        return view('pages.tags.create-tag');
    }


    /**
     * @param Request $request
     * @param TagService $tagService
     * @return Application|RedirectResponse|Redirector
     */
    public function addTag(Request $request, TagService $tagService)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:tags'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['message' => $validator->getMessageBag()->all()]);
        }

        $tagService->createTag($request->get('name'));

        return redirect(route('viewTags'));
    }

    /**
     * @param Tag $tag
     * @param Request $request
     * @param TagService $tagService
     * @return Application|RedirectResponse|Redirector
     */
    public function editTag(Tag $tag, Request $request, TagService $tagService)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:tags'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['message' => $validator->getMessageBag()->all()]);
        }

        $tagService->editTag($tag, $request->get('name'));

        return redirect(route('viewTags'));
    }

    /**
     * @param Tag $tag
     * @param TagService $tagService
     * @return JsonResponse
     */
    public function deleteTag(Tag $tag, TagService $tagService): JsonResponse
    {
        $tagService->deleteCategory($tag);

        return response()->json([
            'msg' => 'success',
        ]);
    }
}
